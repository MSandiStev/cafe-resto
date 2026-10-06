@extends('layouts.public')

@section('title', 'Checkout - ' . config('app.name'))

@section('content')
<section class="mx-auto max-w-5xl px-4 py-12">
    <h1 class="text-3xl font-bold text-neutral-900">Checkout</h1>

    <form method="POST" action="{{ route('checkout.store') }}"
          x-data="{ type: '{{ old('type', 'pickup') }}', fee: {{ $deliveryFee }}, subtotal: {{ $subtotal }} }"
          class="mt-8 grid gap-8 lg:grid-cols-3">
        @csrf

        <div class="space-y-6 lg:col-span-2">
            {{-- Tipe pesanan --}}
            <div class="rounded-xl bg-white p-6 ring-1 ring-neutral-100">
                <h2 class="font-semibold text-neutral-900">Cara menerima pesanan</h2>
                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                    @foreach ($types as $value => $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="{{ $value }}" x-model="type" class="peer sr-only">
                            <span class="block rounded-lg border border-neutral-200 px-4 py-3 text-center text-sm font-medium transition peer-checked:border-brand-600 peer-checked:bg-brand-50 peer-checked:text-brand-700">
                                {{ $label }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('type') <p class="mt-2 text-sm text-brand-600">{{ $message }}</p> @enderror
            </div>

            {{-- Data pemesan --}}
            <div class="rounded-xl bg-white p-6 ring-1 ring-neutral-100">
                <h2 class="font-semibold text-neutral-900">Data pemesan</h2>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-neutral-700">Nama</label>
                        <input type="text" id="customer_name" name="customer_name"
                               value="{{ old('customer_name', auth()->user()?->name) }}"
                               class="mt-1 w-full rounded-lg border-neutral-300 text-sm focus:border-brand-600 focus:ring-brand-600">
                        @error('customer_name') <p class="mt-1 text-sm text-brand-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="customer_phone" class="block text-sm font-medium text-neutral-700">Nomor HP / WhatsApp</label>
                        <input type="tel" id="customer_phone" name="customer_phone"
                               value="{{ old('customer_phone') }}" placeholder="081234567890"
                               class="mt-1 w-full rounded-lg border-neutral-300 text-sm focus:border-brand-600 focus:ring-brand-600">
                        @error('customer_phone') <p class="mt-1 text-sm text-brand-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div x-show="type === 'dine_in'" x-cloak class="mt-4">
                    <label for="table_number" class="block text-sm font-medium text-neutral-700">Nomor meja</label>
                    <input type="text" id="table_number" name="table_number" value="{{ old('table_number') }}"
                           class="mt-1 w-full rounded-lg border-neutral-300 text-sm focus:border-brand-600 focus:ring-brand-600 sm:w-40">
                    @error('table_number') <p class="mt-1 text-sm text-brand-600">{{ $message }}</p> @enderror
                </div>

                <div x-show="type === 'delivery'" x-cloak class="mt-4">
                    <label for="delivery_address" class="block text-sm font-medium text-neutral-700">Alamat pengantaran</label>
                    <textarea id="delivery_address" name="delivery_address" rows="3"
                              class="mt-1 w-full rounded-lg border-neutral-300 text-sm focus:border-brand-600 focus:ring-brand-600">{{ old('delivery_address') }}</textarea>
                    @error('delivery_address') <p class="mt-1 text-sm text-brand-600">{{ $message }}</p> @enderror
                </div>

                <div class="mt-4">
                    <label for="notes" class="block text-sm font-medium text-neutral-700">Catatan untuk pesanan (opsional)</label>
                    <input type="text" id="notes" name="notes" value="{{ old('notes') }}" maxlength="300"
                           class="mt-1 w-full rounded-lg border-neutral-300 text-sm focus:border-brand-600 focus:ring-brand-600">
                </div>
            </div>
        </div>

        {{-- Ringkasan --}}
        <aside class="h-fit rounded-xl bg-white p-6 ring-1 ring-neutral-100 lg:sticky lg:top-24">
            <h2 class="font-semibold text-neutral-900">Ringkasan</h2>

            <ul class="mt-4 space-y-3 text-sm">
                @foreach ($lines as $line)
                    <li class="flex justify-between gap-4">
                        <span class="text-neutral-600">{{ $line->qty }}× {{ $line->product->name }}</span>
                        <span class="font-medium">Rp {{ number_format($line->subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <dl class="mt-5 space-y-2 border-t border-neutral-100 pt-4 text-sm">
                <div class="flex justify-between">
                    <dt class="text-neutral-600">Subtotal</dt>
                    <dd>Rp {{ number_format($subtotal, 0, ',', '.') }}</dd>
                </div>
                <div class="flex justify-between" x-show="type === 'delivery'" x-cloak>
                    <dt class="text-neutral-600">Ongkir</dt>
                    <dd>Rp {{ number_format($deliveryFee, 0, ',', '.') }}</dd>
                </div>
                <div class="flex justify-between border-t border-neutral-100 pt-3 text-base font-bold">
                    <dt>Total</dt>
                    <dd class="text-brand-600"
                        x-text="'Rp ' + (subtotal + (type === 'delivery' ? fee : 0)).toLocaleString('id-ID')"></dd>
                </div>
            </dl>

            <button type="submit"
                    class="mt-6 w-full rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white transition hover:bg-brand-700">
                Buat Pesanan
            </button>
            <a href="{{ route('cart.index') }}" class="mt-3 block text-center text-sm text-neutral-500 hover:text-brand-600">
                ← Kembali ke keranjang
            </a>
        </aside>
    </form>
</section>
@endsection