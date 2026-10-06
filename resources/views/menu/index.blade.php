@extends('layouts.public')

@section('title', 'Menu - ' . config('app.name'))

@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
    <h1 class="text-3xl font-bold text-neutral-900">Menu</h1>

    <div class="mt-6 flex flex-wrap gap-2">
        <a href="{{ route('menu.index') }}"
           class="rounded-full px-4 py-2 text-sm font-medium {{ request('category') ? 'bg-white ring-1 ring-neutral-200 hover:ring-brand-600' : 'bg-brand-600 text-white' }}">
            Semua
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('menu.index', ['category' => $category->slug]) }}"
               class="rounded-full px-4 py-2 text-sm font-medium {{ request('category') === $category->slug ? 'bg-brand-600 text-white' : 'bg-white ring-1 ring-neutral-200 hover:ring-brand-600' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <p class="text-neutral-500">Belum ada menu di kategori ini.</p>
        @endforelse
    </div>
</section>
@endsection