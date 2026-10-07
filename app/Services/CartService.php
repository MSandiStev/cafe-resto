<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    private const KEY = 'cart';

    /** Data mentah di session: [product_id => ['qty' => int, 'note' => ?string]] */
    public function items(): array
    {
        return session(self::KEY, []);
    }

    public function add(Product $product, int $qty = 1, ?string $note = null): void
    {
        $cart = $this->items();
        $id = $product->id;

        $cart[$id] = [
            'qty'  => min(($cart[$id]['qty'] ?? 0) + $qty, 99),
            'note' => $note ?? ($cart[$id]['note'] ?? null),
        ];

        session([self::KEY => $cart]);
    }

    public function update(Product $product, int $qty): void
    {
        if ($qty <= 0) {
            $this->remove($product);
            return;
        }

        $cart = $this->items();

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = min($qty, 99);
            session([self::KEY => $cart]);
        }
    }

    public function remove(Product $product): void
    {
        $cart = $this->items();
        unset($cart[$product->id]);
        session([self::KEY => $cart]);
    }

    /** Samakan isi session dengan keranjang yang valid (buang menu habis/dimatikan, batasi jumlah sesuai stok). */
    public function prune(): void
    {
        $cart = [];

        foreach ($this->lines() as $id => $line) {
            $cart[$id] = ['qty' => $line->qty, 'note' => $line->note];
        }

        session([self::KEY => $cart]);
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    public function count(): int
    {
        return (int) collect($this->items())->sum('qty');
    }

    /** Baris keranjang lengkap dengan data produk dan subtotal (harga diambil dari database). */
    public function lines(): Collection
    {
        $cart = $this->items();

        if (empty($cart)) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($cart))
            ->where('is_available', true)
            ->where('stock', '>', 0)
            ->get()
            ->keyBy('id');

        return collect($cart)
            ->map(function ($row, $id) use ($products) {
                $product = $products->get($id);

                if (! $product) {
                    return null; // menu sudah dihapus, dimatikan, atau stoknya habis
                }

                // Jumlah di keranjang tidak boleh melebihi stok yang tersisa.
                $qty = min((int) $row['qty'], (int) $product->stock);

                return (object) [
                    'product'  => $product,
                    'qty'      => $qty,
                    'adjusted' => $qty < (int) $row['qty'],
                    'note'     => $row['note'] ?? null,
                    'subtotal' => $product->price * $qty,
                ];
            })
            ->filter();
    }

    public function total(): int
    {
        return (int) $this->lines()->sum('subtotal');
    }
}