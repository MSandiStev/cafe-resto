@props(['product'])

<a href="{{ route('menu.show', $product) }}"
   class="group block overflow-hidden rounded-xl bg-white ring-1 ring-neutral-100 transition hover:shadow-lg">
    <div class="aspect-[4/3] overflow-hidden bg-brand-50">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                 loading="lazy" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
        @endif
    </div>
    <div class="p-4">
        <p class="text-xs font-medium uppercase tracking-wide text-brand-600">{{ $product->category->name }}</p>
        <h3 class="mt-1 font-semibold text-neutral-900">{{ $product->name }}</h3>
        <p class="mt-1 line-clamp-2 text-sm text-neutral-500">{{ $product->description }}</p>
        <p class="mt-3 font-semibold text-brand-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    </div>
</a>