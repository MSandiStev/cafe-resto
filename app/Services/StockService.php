<?php

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockMovement;
use Closure;
use Illuminate\Support\Facades\DB;

/**
 * Satu-satunya pintu untuk mengubah stok. Setiap perubahan dikunci (lockForUpdate)
 * dan dicatat di stock_movements, jadi angka stok selalu punya riwayat.
 */
class StockService
{
    /** Tambah (delta positif) atau kurangi (delta negatif) stok. Null kalau delta = 0. */
    public function adjust(
        Product $product,
        int $delta,
        string $type,
        ?string $note = null,
        ?Order $order = null,
    ): ?StockMovement {
        return $this->move($product, fn (int $current) => $delta, $type, $note, $order);
    }

    /** Set stok ke angka tertentu (stok opname). Null kalau angkanya sudah sama. */
    public function setTo(Product $product, int $target, ?string $note = null): ?StockMovement
    {
        return $this->move($product, fn (int $current) => $target - $current, 'adjustment', $note);
    }

    /** Kurangi stok sesuai isi pesanan. Melempar InsufficientStockException kalau ada yang tidak cukup. */
    public function deductForOrder(Order $order): void
    {
        $order->loadMissing('items');

        // Urut berdasarkan product_id supaya urutan kunci konsisten dan tidak saling menunggu (deadlock).
        $items = $order->items->whereNotNull('product_id')->sortBy('product_id');

        foreach ($items as $item) {
            $product = Product::find($item->product_id);

            if (! $product) {
                continue;
            }

            $this->adjust($product, -$item->qty, 'sale', "Pesanan {$order->order_number}", $order);
        }
    }

    /** Kembalikan stok pesanan yang dibatalkan. Aman dipanggil berulang: hanya mengembalikan yang belum kembali. */
    public function restoreForOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $perProduct = StockMovement::where('order_id', $order->id)
                ->whereIn('type', ['sale', 'return'])
                ->get()
                ->groupBy('product_id');

            foreach ($perProduct as $productId => $rows) {
                $net = (int) $rows->sum('quantity'); // sale negatif, return positif

                if ($net >= 0) {
                    continue; // sudah dikembalikan
                }

                $product = Product::find($productId);

                if (! $product) {
                    continue;
                }

                $this->adjust($product, -$net, 'return', "Pesanan {$order->order_number} dibatalkan", $order);
            }
        });
    }

    private function move(Product $product, Closure $delta, string $type, ?string $note, ?Order $order = null): ?StockMovement
    {
        return DB::transaction(function () use ($product, $delta, $type, $note, $order) {
            $locked = Product::query()->whereKey($product->getKey())->lockForUpdate()->firstOrFail();

            $before = (int) $locked->stock;
            $change = (int) $delta($before);

            if ($change === 0) {
                return null;
            }

            $after = $before + $change;

            if ($after < 0) {
                throw new InsufficientStockException($locked->name, $before, abs($change));
            }

            $locked->stock = $after;
            $locked->save();

            $user = auth()->user();
            // Penjualan dilakukan pelanggan, jadi tidak dicatat atas nama user. Perubahan lain atas nama admin.
            $userId = ($type !== 'sale' && $user && $user->role === 'admin') ? $user->id : null;

            $movement = StockMovement::create([
                'product_id'   => $locked->id,
                'order_id'     => $order?->id,
                'user_id'      => $userId,
                'type'         => $type,
                'quantity'     => $change,
                'stock_before' => $before,
                'stock_after'  => $after,
                'note'         => $note,
            ]);

            $product->refresh();

            return $movement;
        });
    }
}
