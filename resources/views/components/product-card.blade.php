@props(['product'])

<div class="flex flex-col overflow-hidden rounded-lg bg-white ring-1 ring-neutral-200">
    <a href="{{ route('menu.show', $product) }}" class="block aspect-[4/3] overflow-hidden bg-brand-50">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                 loading="lazy" class="h-full w-full object-cover">
        @else
            <span class="flex h-full w-full items-center justify-center text-4xl font-semibold text-brand-600">
                {{ mb_substr($product->name, 0, 1) }}
            </span>
        @endif
    </a>

    <div class="flex flex-1 flex-col p-4">
        <p class="text-xs text-neutral-500">{{ $product->category->name }}</p>
        <a href="{{ route('menu.show', $product) }}"
           class="mt-1 font-semibold text-neutral-900 hover:text-brand-600">{{ $product->name }}</a>
        <p class="mt-1 line-clamp-2 text-sm text-neutral-500">{{ $product->description }}</p>

        <div class="mt-auto flex items-center justify-between pt-4">
            <p class="font-semibold text-neutral-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <form method="POST" action="{{ route('cart.store', $product) }}">
                @csrf
                <input type="hidden" name="qty" value="1">
                <button type="submit" aria-label="Tambah {{ $product->name }} ke keranjang"
                        class="rounded-md border border-neutral-300 px-3 py-1.5 text-sm font-medium transition hover:border-brand-600 hover:bg-brand-600 hover:text-white">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</div>