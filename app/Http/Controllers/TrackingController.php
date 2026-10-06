<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function create()
    {
        return view('tracking.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_number'   => ['required', 'string', 'max:30'],
            'customer_phone' => ['required', 'string', 'max:20'],
        ], [
            'order_number.required'   => 'Nomor pesanan wajib diisi.',
            'customer_phone.required' => 'Nomor HP wajib diisi.',
        ]);

        $order = Order::where('order_number', strtoupper(trim($data['order_number'])))->first();

        // Pesan error sengaja sama untuk "nomor salah" dan "HP salah",
        // supaya orang tidak bisa menebak nomor pesanan milik pelanggan lain.
        if (! $order || $this->normalizePhone($order->customer_phone) !== $this->normalizePhone($data['customer_phone'])) {
            return back()
                ->withInput()
                ->withErrors(['order_number' => 'Pesanan tidak ditemukan. Periksa nomor pesanan dan nomor HP Anda.']);
        }

        return redirect()->route('checkout.success', $order);
    }

    /** 0812..., 62812..., dan +62812... dianggap sama. */
    private function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', $phone);

        return str_starts_with($digits, '62') ? '0' . substr($digits, 2) : $digits;
    }
}
