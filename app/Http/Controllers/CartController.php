<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cart)
    {
    }

    public function index()
    {
        return view('cart.index', [
            'lines' => $this->cart->lines(),
            'total' => $this->cart->total(),
        ]);
    }

    public function store(Request $request, Product $product)
    {
        abort_unless($product->is_available, 404);

        $data = $request->validate([
            'qty'  => ['required', 'integer', 'min:1', 'max:99'],
            'note' => ['nullable', 'string', 'max:200'],
        ]);

        if ($product->isSoldOut()) {
            return back()->with('error', $product->name . ' sedang habis.');
        }

        $inCart = (int) ($this->cart->items()[$product->id]['qty'] ?? 0);

        if ($inCart + $data['qty'] > $product->stock) {
            return back()
                ->withInput()
                ->with('error', "Stok {$product->name} hanya tersisa {$product->stock} (di keranjang Anda sudah ada {$inCart}).");
        }

        $this->cart->add($product, $data['qty'], $data['note'] ?? null);

        return redirect()
            ->route('cart.index')
            ->with('success', $product->name . ' ditambahkan ke keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $qty = $data['qty'];
        $flash = [];

        if ($qty > $product->stock) {
            $qty = max((int) $product->stock, 0);
            $flash['error'] = $qty > 0
                ? "Stok {$product->name} hanya tersisa {$qty}, jumlah disesuaikan."
                : "{$product->name} sedang habis dan dihapus dari keranjang.";
        }

        $this->cart->update($product, $qty);

        return back()->with($flash);
    }

    public function destroy(Product $product)
    {
        $this->cart->remove($product);

        return back()->with('success', $product->name . ' dihapus dari keranjang.');
    }
}