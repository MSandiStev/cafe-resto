<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function __construct(private CartService $cart)
    {
    }

    public function create()
    {
        $lines = $this->cart->lines();

        if ($lines->isEmpty()) {
            return redirect()->route('cart.index');
        }

        return view('checkout.create', [
            'lines'       => $lines,
            'subtotal'    => $this->cart->total(),
            'deliveryFee' => config('cafe.delivery_fee'),
            'types'       => Order::TYPES,
        ]);
    }

    public function store(Request $request)
    {
        $lines = $this->cart->lines();

        if ($lines->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $data = $request->validate([
            'customer_name'    => ['required', 'string', 'max:100'],
            'customer_phone'   => ['required', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],
            'type'             => ['required', Rule::in(array_keys(Order::TYPES))],
            'table_number'     => ['nullable', 'required_if:type,dine_in', 'string', 'max:10'],
            'delivery_address' => ['nullable', 'required_if:type,delivery', 'string', 'max:500'],
            'notes'            => ['nullable', 'string', 'max:300'],
        ], [
            'customer_phone.regex'              => 'Nomor HP tidak valid. Contoh: 081234567890.',
            'table_number.required_if'          => 'Nomor meja wajib diisi untuk makan di tempat.',
            'delivery_address.required_if'      => 'Alamat wajib diisi untuk pesanan antar.',
        ]);

        $subtotal    = $this->cart->total();
        $deliveryFee = $data['type'] === 'delivery' ? config('cafe.delivery_fee') : 0;

        $order = DB::transaction(function () use ($data, $lines, $subtotal, $deliveryFee, $request) {
            $order = Order::create([
                'user_id'          => $request->user()?->id,
                'customer_name'    => $data['customer_name'],
                'customer_phone'   => $data['customer_phone'],
                'type'             => $data['type'],
                'table_number'     => $data['type'] === 'dine_in' ? $data['table_number'] : null,
                'delivery_address' => $data['type'] === 'delivery' ? $data['delivery_address'] : null,
                'notes'            => $data['notes'] ?? null,
                'subtotal'         => $subtotal,
                'delivery_fee'     => $deliveryFee,
                'total'            => $subtotal + $deliveryFee,
            ]);

            foreach ($lines as $line) {
                $order->items()->create([
                    'product_id'   => $line->product->id,
                    'product_name' => $line->product->name,
                    'price'        => $line->product->price,
                    'qty'          => $line->qty,
                    'note'         => $line->note,
                    'subtotal'     => $line->subtotal,
                ]);
            }

            return $order;
        });

        $this->cart->clear();

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        $order->load('items');

        return view('checkout.success', compact('order'));
    }
}