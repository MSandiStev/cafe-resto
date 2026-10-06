@extends('layouts.public')

@section('title', 'Keranjang - ' . config('app.name'))

@section('content')
<section class="mx-auto max-w-4xl px-4 py-12">
    <h1 class="text-3xl font-bold text-neutral-900">Keranjang</h1>

    @if ($lines->isEmpty())
        <div class="mt-10 rounded-xl bg-white p-10 text-center ring-1 ring-neutral-100">
            <p class="text-neutral-600">Keranjang Anda masih kosong.</p>
            <a href="{{ route('menu.index') }}"
               class="mt-6 inline-block rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white transition hover:bg-brand-700">
                Lihat Menu
            </a>
        </div>
    @else
        <div class="mt-8 divide-y divide-neutral-100 rounded-xl bg-white ring-1 ring-neutral-100">
            @foreach ($lines as $line)
                <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center">
                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg bg-brand-50">
                        @if ($line->product->image)
                            <img src="{{ asset('storage/' . $line->product->image) }}"
                                 alt="{{ $line->product->name }}" class="h-full w-full object-cover">
                        @endif
                    </div>

                    <div class="flex-1">
                        <a href="{{ route('menu.show', $line->product) }}"
                           class="font-semibold text-neutral-900 hover:text-brand-600">
                            {{ $line->product->name }}
                        </a>
                        <p class="text-sm text-neutral-500">
                            Rp {{ number_format($line->product->price, 0, ',', '.') }}
                        </p>
                        @if ($line->note)
                            <p class="mt-1 text-xs text-neutral-500">Catatan: {{ $line->note }}</p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('cart.update', $line->product) }}"
                          class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="qty" value="{{ $line->qty }}" min="0" max="99"
                               class="w-16 rounded-lg border-neutral-300 text-center text-sm focus:border-brand-600 focus:ring-brand-600">
                        <button type="submit"
                                class="rounded-lg border border-neutral-300 px-3 py-2 text-sm font-medium transition hover:border-brand-600 hover:text-brand-600">
                            Ubah
                        </button>
                    </form>

                    <p class="w-28 font-semibold text-brand-600 sm:text-right">
                        Rp {{ number_format($line->subtotal, 0, ',', '.') }}
                    </p>

                    <form method="POST" action="{{ route('cart.destroy', $line->product) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-neutral-400 transition hover:text-brand-600"
                                aria-label="Hapus {{ $line->product->name }}">
                            Hapus
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex flex-col items-end gap-4">
            <p class="text-lg">
                Total:
                <span class="text-2xl font-bold text-brand-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </p>

            <div class="flex gap-3">
                <a href="{{ route('menu.index') }}"
                   class="rounded-lg border border-neutral-300 px-6 py-3 font-semibold transition hover:border-brand-600 hover:text-brand-600">
                    Tambah Menu
                </a>
                {{-- Checkout dikerjakan di tahap berikutnya --}}
                <a href="{{ route('checkout.create') }}"
   class="rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white transition hover:bg-brand-700">
    Lanjut ke Checkout
</a>
            </div>
        </div>
    @endif
</section>
@endsection