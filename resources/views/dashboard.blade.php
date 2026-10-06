@extends('layouts.public')

@section('title', 'Akun Saya - ' . config('app.name'))

@section('content')
<section class="mx-auto max-w-4xl px-4 py-12">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-brand-600">Akun saya</p>
            <h1 class="mt-2 text-3xl font-bold text-neutral-900">
                Halo, {{ explode(' ', trim(auth()->user()->name))[0] }}
            </h1>
            <p class="mt-1 text-sm text-neutral-500">{{ auth()->user()->email }}</p>
        </div>

        <div class="flex flex-wrap items-center gap-3 text-sm font-medium">
            @if (auth()->user()->role === 'admin')
                <a href="{{ url('/admin') }}" class="rounded-lg bg-neutral-900 px-4 py-2 text-white transition hover:bg-neutral-700">
                    Buka panel admin
                </a>
            @endif
            <a href="{{ route('profile.edit') }}"
               class="rounded-lg border border-neutral-300 px-4 py-2 transition hover:border-brand-600 hover:text-brand-600">
                Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-2 py-2 text-neutral-500 transition hover:text-brand-600">Keluar</button>
            </form>
        </div>
    </div>

    <h2 class="mt-12 text-xl font-bold text-neutral-900">Riwayat pesanan</h2>

    @if ($orders->isEmpty())
        <div class="mt-4 rounded-2xl bg-white p-10 text-center ring-1 ring-neutral-100">
            <p class="text-neutral-600">Belum ada pesanan di akun ini.</p>
            <a href="{{ route('menu.index') }}"
               class="mt-6 inline-block rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white transition hover:bg-brand-700">
                Lihat Menu
            </a>
        </div>
    @else
        <div class="mt-4 divide-y divide-neutral-100 rounded-2xl bg-white ring-1 ring-neutral-100">
            @foreach ($orders as $order)
                <a href="{{ route('checkout.success', $order) }}"
                   class="flex flex-wrap items-center justify-between gap-3 p-5 transition first:rounded-t-2xl last:rounded-b-2xl hover:bg-neutral-50">
                    <div>
                        <p class="font-semibold text-neutral-900">{{ $order->order_number }}</p>
                        <p class="mt-1 text-xs text-neutral-500">
                            {{ $order->created_at->locale('id')->translatedFormat('j M Y, H:i') }}
                            · {{ $order->typeLabel() }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <p class="font-semibold text-brand-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <x-status-badge :status="$order->status" />
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif

    <p class="mt-8 text-xs text-neutral-500">
        Pesanan yang dibuat tanpa login tidak tampil di sini. Pakai menu
        <a href="{{ route('tracking.create') }}" class="text-brand-600 hover:underline">Lacak Pesanan</a>
        untuk melihat statusnya.
    </p>
</section>
@endsection
