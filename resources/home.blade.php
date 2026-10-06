@extends('layouts.public')

@section('content')
<section class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-16 md:grid-cols-2 md:py-24">
    <div>
        <p class="text-sm font-semibold uppercase tracking-widest text-brand-600">Cafe & Resto</p>
        <h1 class="mt-3 text-4xl font-bold leading-tight text-neutral-900 md:text-5xl">
            Judul khas brand Anda di sini
        </h1>
        <p class="mt-5 max-w-md text-neutral-600">
            Satu atau dua kalimat yang menjelaskan keunikan cafe Anda.
        </p>
        <div class="mt-8 flex gap-3">
            <a href="{{ route('menu.index') }}"
               class="rounded-lg bg-brand-600 px-6 py-3 font-semibold text-white transition hover:bg-brand-700">
                Lihat Menu
            </a>
            <a href="#lokasi"
               class="rounded-lg border border-neutral-300 px-6 py-3 font-semibold transition hover:border-brand-600 hover:text-brand-600">
                Lokasi Kami
            </a>
        </div>
    </div>

    {{-- Ganti dengan foto asli cafe Anda: public/images/hero.jpg --}}
    <div class="aspect-[4/3] overflow-hidden rounded-2xl bg-brand-50">
        <img src="{{ asset('images/hero.jpg') }}" alt="Suasana cafe" class="h-full w-full object-cover"
             onerror="this.style.display='none'">
    </div>
</section>

<section class="mx-auto max-w-6xl px-4">
    <div class="flex items-end justify-between">
        <h2 class="text-2xl font-bold text-neutral-900">Menu Favorit</h2>
        <a href="{{ route('menu.index') }}" class="text-sm font-semibold text-brand-600 hover:underline">Semua menu →</a>
    </div>

    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($featured as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</section>
@endsection