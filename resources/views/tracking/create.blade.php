@extends('layouts.public')

@section('title', 'Lacak Pesanan - ' . config('app.name'))

@section('content')
<section class="mx-auto max-w-md px-4 py-16">
    <h1 class="text-3xl font-bold text-neutral-900">Lacak pesanan</h1>
    <p class="mt-2 text-sm leading-relaxed text-neutral-600">
        Masukkan nomor pesanan dan nomor HP yang Anda pakai saat memesan.
    </p>

    <form method="POST" action="{{ route('tracking.store') }}"
          class="mt-8 space-y-5 rounded-2xl bg-white p-6 ring-1 ring-neutral-100 sm:p-8">
        @csrf

        <div>
            <label for="order_number" class="block text-sm font-medium text-neutral-700">Nomor pesanan</label>
            <input type="text" id="order_number" name="order_number" value="{{ old('order_number') }}"
                   placeholder="CR-261006-AB12" autocomplete="off" required
                   class="mt-1 w-full rounded-lg border-neutral-300 text-sm uppercase placeholder:normal-case focus:border-brand-600 focus:ring-brand-600">
            @error('order_number')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="customer_phone" class="block text-sm font-medium text-neutral-700">Nomor HP</label>
            <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}"
                   placeholder="081234567890" required
                   class="mt-1 w-full rounded-lg border-neutral-300 text-sm focus:border-brand-600 focus:ring-brand-600">
            @error('customer_phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white transition hover:bg-brand-700">
            Cari pesanan
        </button>
    </form>
</section>
@endsection
