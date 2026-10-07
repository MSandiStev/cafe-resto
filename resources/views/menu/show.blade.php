@extends('layouts.public')

@section('title', $product->name . ' - ' . config('app.name'))

@section('content')
<section class="mx-auto grid max-w-5xl gap-10 px-4 py-12 md:grid-cols-2">
    <div class="aspect-square overflow-hidden rounded-2xl bg-brand-50">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                 class="h-full w-full object-cover">
        @endif
    </div>

    <div>
        <a href="{{ route('menu.index') }}" class="text-sm text-neutral-500 hover:text-brand-600">← Kembali ke menu</a>

        <p class="mt-4 text-xs font-medium uppercase tracking-wide text-brand-600">{{ $product->category->name }}</p>
        <h1 class="mt-1 text-3xl font-bold text-neutral-900">{{ $product->name }}</h1>
        <p class="mt-4 text-2xl font-semibold text-brand-600">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>

        @if ($product->description)
            <p class="mt-5 leading-relaxed text-neutral-600">{{ $product->description }}</p>
        @endif

        @if ($product->is_available && $product->isSoldOut())
            <p class="mt-8 rounded-lg bg-neutral-100 px-4 py-3 text-sm font-medium text-neutral-600">
                Stok menu ini sedang habis.
            </p>
        @elseif ($product->is_available)
            @if ($product->isLowStock())
                <p class="mt-6 text-sm font-medium text-amber-600">Stok tinggal {{ $product->stock }}, segera pesan.</p>
            @endif

            <form method="POST" action="{{ route('cart.store', $product) }}" class="mt-8 space-y-4">
                @csrf

                <div>
                    <label for="note" class="block text-sm font-medium text-neutral-700">Catatan (opsional)</label>
                    <input type="text" id="note" name="note" maxlength="200" value="{{ old('note') }}"
                           placeholder="Contoh: less sugar, tanpa bawang"
                           class="mt-1 w-full rounded-lg border-neutral-300 text-sm focus:border-brand-600 focus:ring-brand-600">
                    @error('note')
                        <p class="mt-1 text-sm text-brand-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <input type="number" name="qty" value="{{ old('qty', 1) }}" min="1" max="{{ min(99, $product->stock) }}"
                           aria-label="Jumlah"
                           class="w-20 rounded-lg border-neutral-300 text-center focus:border-brand-600 focus:ring-brand-600">
                    <button type="submit"
                            class="rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white transition hover:bg-brand-700">
                        Tambah ke Keranjang
                    </button>
                </div>
                @error('qty')
                    <p class="text-sm text-brand-600">{{ $message }}</p>
                @enderror
            </form>
        @else
            <p class="mt-8 rounded-lg bg-neutral-100 px-4 py-3 text-sm font-medium text-neutral-600">
                Menu ini sedang tidak tersedia.
            </p>
        @endif
    </div>
</section>
@endsection
