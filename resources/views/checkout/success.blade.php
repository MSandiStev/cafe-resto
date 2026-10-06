@extends('layouts.public')

@section('title', 'Pesanan ' . $order->order_number . ' - ' . config('app.name'))

@section('content')
@php
    $steps = $order->trackingSteps();
    $current = $order->currentStepIndex();
    $lastIndex = count($steps) - 1;
    $cancelled = $order->status === 'cancelled';
@endphp

{{-- Selama pesanan belum selesai, halaman dimuat ulang tiap 30 detik. --}}
<section class="mx-auto max-w-2xl px-4 py-12"
         @unless ($order->isFinal()) x-data x-init="setTimeout(() => window.location.reload(), 30000)" @endunless>

    <div class="rounded-2xl bg-white p-6 ring-1 ring-neutral-100 sm:p-8">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-brand-600">Status pesanan</p>
                <h1 class="mt-2 text-3xl font-bold text-neutral-900">{{ $order->order_number }}</h1>
            </div>
            <x-status-badge :status="$order->status" />
        </div>

        <p class="mt-4 leading-relaxed text-neutral-600">{{ $order->statusMessage() }}</p>

        @unless ($cancelled)
            <div class="mt-8">
                <div class="h-1.5 rounded-full bg-neutral-100">
                    <div class="h-full rounded-full bg-brand-600 transition-all"
                         style="width: {{ $lastIndex > 0 ? round(($current / $lastIndex) * 100) : 0 }}%"></div>
                </div>

                <ol class="mt-4 grid grid-cols-4 gap-2">
                    @foreach ($steps as $label)
                        @php
                            $reached = $loop->index <= $current;
                            $checked = $loop->index < $current || $order->status === 'completed';
                        @endphp
                        <li class="text-center">
                            <div class="mx-auto flex h-9 w-9 items-center justify-center rounded-full text-sm font-semibold {{ $reached ? 'bg-brand-600 text-white' : 'bg-neutral-100 text-neutral-400' }}">
                                {{ $checked ? '✓' : $loop->iteration }}
                            </div>
                            <p class="mt-2 text-xs font-medium leading-tight {{ $reached ? 'text-neutral-900' : 'text-neutral-400' }}">
                                {{ $label }}
                            </p>
                        </li>
                    @endforeach
                </ol>
            </div>
        @endunless

        @if ($order->payment_status !== 'paid' && ! $cancelled)
            <p class="mt-8 rounded-lg bg-brand-50 px-4 py-3 text-sm text-brand-700">
                Pembayaran dilakukan di kasir. Tunjukkan nomor pesanan ini kepada kasir kami.
            </p>
        @endif

        <p class="mt-4 text-xs text-neutral-500">
            Simpan halaman ini atau nomor pesanan Anda untuk melihat status kapan saja.
        </p>
    </div>

    <div class="mt-6 rounded-2xl bg-white p-6 ring-1 ring-neutral-100 sm:p-8">
        <h2 class="font-semibold text-neutral-900">Rincian pesanan</h2>

        <dl class="mt-4 space-y-2 text-sm">
            <div class="flex justify-between gap-6">
                <dt class="text-neutral-500">Atas nama</dt>
                <dd class="font-medium">{{ $order->customer_name }}</dd>
            </div>
            <div class="flex justify-between gap-6">
                <dt class="text-neutral-500">Waktu pesan</dt>
                <dd class="font-medium">{{ $order->created_at->locale('id')->translatedFormat('j M Y, H:i') }}</dd>
            </div>
            <div class="flex justify-between gap-6">
                <dt class="text-neutral-500">Tipe</dt>
                <dd class="font-medium">{{ $order->typeLabel() }}</dd>
            </div>
            @if ($order->table_number)
                <div class="flex justify-between gap-6">
                    <dt class="text-neutral-500">Meja</dt>
                    <dd class="font-medium">{{ $order->table_number }}</dd>
                </div>
            @endif
            @if ($order->delivery_address)
                <div class="flex justify-between gap-6">
                    <dt class="text-neutral-500">Alamat</dt>
                    <dd class="text-right font-medium">{{ $order->delivery_address }}</dd>
                </div>
            @endif
            <div class="flex justify-between gap-6">
                <dt class="text-neutral-500">Pembayaran</dt>
                <dd class="font-medium">{{ \App\Models\Order::PAYMENT_STATUSES[$order->payment_status] ?? $order->payment_status }}</dd>
            </div>
        </dl>

        <ul class="mt-6 space-y-3 border-t border-neutral-100 pt-5 text-sm">
            @foreach ($order->items as $item)
                <li class="flex justify-between gap-4">
                    <span>
                        {{ $item->qty }}× {{ $item->product_name }}
                        @if ($item->note)
                            <span class="block text-xs text-neutral-500">Catatan: {{ $item->note }}</span>
                        @endif
                    </span>
                    <span class="font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>

        <dl class="mt-5 space-y-2 border-t border-neutral-100 pt-4 text-sm">
            @if ($order->delivery_fee > 0)
                <div class="flex justify-between">
                    <dt class="text-neutral-600">Ongkir</dt>
                    <dd>Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}</dd>
                </div>
            @endif
            <div class="flex justify-between text-base font-bold">
                <dt>Total</dt>
                <dd class="text-brand-600">Rp {{ number_format($order->total, 0, ',', '.') }}</dd>
            </div>
        </dl>
    </div>

    <div class="mt-8 flex flex-wrap gap-3">
        <a href="{{ route('menu.index') }}"
           class="rounded-lg border border-neutral-300 px-6 py-3 font-semibold transition hover:border-brand-600 hover:text-brand-600">
            Pesan lagi
        </a>
        <a href="{{ route('tracking.create') }}"
           class="rounded-lg px-6 py-3 font-semibold text-neutral-600 transition hover:text-brand-600">
            Lacak pesanan lain
        </a>
    </div>
</section>
@endsection
