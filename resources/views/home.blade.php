@extends('layouts.public')

@section('title', config('app.name') . ' - Pesan kopi dan makanan online')

@php
    $now     = now('Asia/Jakarta');
    $hours   = config('cafe.hours');
    $days    = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

    [$openAt, $closeAt] = $hours[$now->isoWeekday()];
    $current  = $now->format('H.i');
    $isOpen   = $current >= $openAt && $current < $closeAt;
    $nextOpen = $current < $openAt ? $openAt : $hours[$now->copy()->addDay()->isoWeekday()][0];

    // Kategori yang masih punya menu tersedia.
    $shownCategories = $categories->where('products_count', '>', 0);
@endphp

@section('content')

{{-- Hero --}}
<section class="mx-auto grid max-w-6xl gap-10 px-4 pb-14 pt-10 md:grid-cols-12 md:items-center md:pt-16">
    <div class="md:col-span-7">
        <p class="flex items-center gap-2 text-sm text-neutral-600">
            <span class="h-2 w-2 rounded-full {{ $isOpen ? 'bg-emerald-600' : 'bg-neutral-400' }}"></span>
            @if ($isOpen)
                Buka sekarang, tutup pukul {{ $closeAt }}
            @else
                Sedang tutup, buka lagi pukul {{ $nextOpen }}
            @endif
        </p>

        <h1 class="mt-5 text-4xl font-semibold leading-[1.1] tracking-tight text-neutral-900 sm:text-5xl">
            Pesan kopi dan makanan tanpa antre di kasir.
        </h1>

        <p class="mt-5 max-w-md leading-relaxed text-neutral-600">
            Pilih menu, isi data pesanan di halaman checkout, lalu pantau statusnya dari ponsel.
        </p>

        <form method="GET" action="{{ route('menu.index') }}" role="search" class="mt-8 flex max-w-md gap-2">
            <label for="hero-search" class="sr-only">Cari menu</label>
            <input id="hero-search" type="search" name="q" placeholder="Cari menu"
                   class="min-w-0 flex-1 rounded-md border-neutral-300 px-4 py-3 text-sm placeholder-neutral-400 focus:border-brand-600 focus:ring-brand-600">
            <button type="submit"
                    class="rounded-md bg-brand-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-brand-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
                Cari
            </button>
        </form>

        @if ($shownCategories->isNotEmpty())
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($shownCategories->take(5) as $category)
                    <a href="{{ route('menu.index', ['category' => $category->slug]) }}"
                       class="rounded-full bg-white px-3.5 py-1.5 text-sm text-neutral-700 ring-1 ring-neutral-200 transition hover:ring-brand-600 hover:text-brand-600">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <div class="mt-8 flex flex-wrap items-center gap-6">
            <a href="{{ route('menu.index') }}"
               class="rounded-md bg-neutral-900 px-6 py-3 font-medium text-white transition hover:bg-neutral-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-900">
                Lihat semua menu
            </a>
            <a href="{{ route('tracking.index') }}"
               class="font-medium text-neutral-900 underline decoration-neutral-300 underline-offset-4 transition hover:decoration-brand-600">
                Lacak pesanan
            </a>
        </div>
    </div>

    <div class="md:col-span-5">
        <div class="aspect-[4/5] overflow-hidden rounded-lg">
            @if (file_exists(public_path('images/hero.jpg')))
                <img src="{{ asset('images/hero.jpg') }}" alt="Suasana {{ config('app.name') }}"
                     class="h-full w-full object-cover">
            @else
                <div class="flex h-full w-full items-end bg-brand-900 p-6">
                    <span class="text-3xl font-semibold leading-tight text-brand-100">{{ config('app.name') }}</span>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- Cara pesan --}}
<section class="border-y border-neutral-200 bg-white">
    <div class="mx-auto grid max-w-6xl gap-6 px-4 py-6 text-sm md:grid-cols-3 md:gap-10">
        <p class="text-neutral-600">
            <span class="font-semibold text-neutral-900">Tiga cara menikmati.</span>
            Makan di tempat, ambil sendiri, atau diantar ke alamat.
        </p>
        <p class="text-neutral-600">
            <span class="font-semibold text-neutral-900">Ongkir Rp {{ number_format(config('cafe.delivery_fee'), 0, ',', '.') }}.</span>
            Berlaku flat untuk pesanan antar. Dua tipe lainnya gratis.
        </p>
        <p class="text-neutral-600">
            <span class="font-semibold text-neutral-900">Pantau pesanan.</span>
            Status diperbarui dari dapur, bisa dicek lewat
            <a href="{{ route('tracking.index') }}" class="text-neutral-900 underline decoration-neutral-300 underline-offset-4 hover:decoration-brand-600">halaman lacak</a>.
        </p>
    </div>
</section>

{{-- Kategori --}}
@if ($shownCategories->isNotEmpty())
<section class="mx-auto max-w-6xl px-4 pt-14">
    <h2 class="text-2xl font-semibold text-neutral-900">Belanja per kategori</h2>

    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($shownCategories as $category)
            <a href="{{ route('menu.index', ['category' => $category->slug]) }}"
               class="group flex items-center justify-between rounded-lg bg-white px-5 py-4 ring-1 ring-neutral-200 transition hover:ring-brand-600">
                <span>
                    <span class="block font-semibold text-neutral-900 group-hover:text-brand-600">{{ $category->name }}</span>
                    <span class="block text-sm text-neutral-500">{{ $category->products_count }} menu</span>
                </span>
                <span class="text-neutral-400 transition group-hover:translate-x-0.5 group-hover:text-brand-600" aria-hidden="true">→</span>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- Promo (hanya tampil kalau ada promo yang sedang berjalan) --}}
@if ($promos->isNotEmpty())
<section class="mx-auto max-w-6xl px-4 pt-14">
    <h2 class="text-2xl font-semibold text-neutral-900">Promo yang sedang berjalan</h2>

    <div class="mt-6 grid gap-4 md:grid-cols-3">
        @foreach ($promos as $promo)
            <a href="{{ $promo->product ? route('menu.show', $promo->product) : route('menu.index') }}"
               class="flex flex-col overflow-hidden rounded-lg bg-white ring-1 ring-neutral-200 transition hover:ring-brand-600">
                @if ($promo->product && $promo->product->image)
                    <div class="aspect-[16/9] overflow-hidden bg-brand-50">
                        <img src="{{ asset('storage/' . $promo->product->image) }}" alt="{{ $promo->product->name }}"
                             loading="lazy" class="h-full w-full object-cover">
                    </div>
                @endif

                <div class="flex flex-1 flex-col p-5">
                    @if ($promo->badge)
                        <span class="self-start rounded-md bg-brand-600 px-2 py-1 text-xs font-semibold text-white">{{ $promo->badge }}</span>
                    @endif

                    <p class="mt-3 font-semibold text-neutral-900">{{ $promo->title }}</p>

                    @if ($promo->description)
                        <p class="mt-1 text-sm text-neutral-500">{{ $promo->description }}</p>
                    @endif

                    <p class="mt-auto pt-4 text-sm text-neutral-500">
                        @if ($promo->ends_on)
                            Sampai {{ $promo->ends_on->locale('id')->translatedFormat('j F Y') }}
                        @else
                            Berlaku selama persediaan ada
                        @endif
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- Menu terlaris (berdasarkan pesanan yang masuk; kosong untuk toko baru) --}}
@if ($bestSellers->isNotEmpty())
<section class="mx-auto max-w-6xl px-4 pt-14">
    <div class="flex items-end justify-between gap-4">
        <h2 class="text-2xl font-semibold text-neutral-900">Menu terlaris</h2>
        <a href="{{ route('menu.index') }}"
           class="text-sm font-medium text-brand-600 underline underline-offset-4">Lihat semua</a>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($bestSellers as $product)
            <x-product-card :product="$product" badge="Terlaris" />
        @endforeach
    </div>
</section>
@endif

{{-- Menu pilihan --}}
<section class="mx-auto max-w-6xl px-4 pt-14">
    <div class="flex items-end justify-between gap-4">
        <h2 class="text-2xl font-semibold text-neutral-900">Menu pilihan</h2>
        <a href="{{ route('menu.index') }}"
           class="text-sm font-medium text-brand-600 underline underline-offset-4">Lihat semua</a>
    </div>

    @if ($featured->isEmpty())
        <p class="mt-6 text-neutral-500">
            Belum ada menu untuk ditampilkan. Tambahkan menu lewat panel admin.
        </p>
    @else
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($featured as $product)
                <x-product-card :product="$product"
                                :badge="$product->created_at && $product->created_at->gt(now()->subDays(14)) ? 'Baru' : null" />
            @endforeach
        </div>
    @endif
</section>

{{-- Kata pelanggan (hanya tampil kalau ada testimoni yang dipublikasikan) --}}
@if ($testimonials->isNotEmpty())
<section class="mx-auto max-w-6xl px-4 pt-16">
    <h2 class="text-2xl font-semibold text-neutral-900">Kata pelanggan</h2>

    <div class="mt-8 grid gap-10 md:grid-cols-3">
        @foreach ($testimonials as $testimonial)
            <figure class="border-l-2 border-brand-600 pl-5">
                <blockquote class="leading-relaxed text-neutral-700">{{ $testimonial->body }}</blockquote>
                <figcaption class="mt-3 text-sm font-medium text-neutral-900">{{ $testimonial->name }}</figcaption>
            </figure>
        @endforeach
    </div>
</section>
@endif

{{-- Jam buka dan lokasi --}}
<section id="lokasi" class="mx-auto mt-16 max-w-6xl scroll-mt-20 border-t border-neutral-200 px-4 pt-14">
    <div class="grid gap-10 md:grid-cols-12">

        <div class="md:col-span-5">
            <h2 class="text-2xl font-semibold text-neutral-900">Kunjungi kami</h2>

            @if (config('cafe.about'))
                <p class="mt-3 max-w-sm text-sm leading-relaxed text-neutral-600">{{ config('cafe.about') }}</p>
            @endif

            <p class="mt-6 text-sm text-neutral-700">{{ config('cafe.address') }}</p>

            <ul class="mt-6 divide-y divide-neutral-200 border-y border-neutral-200 text-sm">
                @foreach ($days as $no => $dayName)
                    @php $isToday = $no === $now->isoWeekday(); @endphp
                    <li class="flex justify-between py-2.5 {{ $isToday ? 'font-semibold text-neutral-900' : 'text-neutral-600' }}">
                        <span>
                            {{ $dayName }}
                            @if ($isToday)
                                (hari ini)
                            @endif
                        </span>
                        <span>{{ $hours[$no][0] }} – {{ $hours[$no][1] }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 flex flex-wrap items-center gap-6">
                <a href="https://wa.me/{{ config('cafe.whatsapp') }}" target="_blank" rel="noopener"
                   class="rounded-md bg-brand-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-brand-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
                    Chat WhatsApp
                </a>
                <a href="https://www.google.com/maps/search/?api=1&amp;query={{ urlencode(config('cafe.address')) }}"
                   target="_blank" rel="noopener"
                   class="text-sm font-medium text-neutral-900 underline decoration-neutral-300 underline-offset-4 transition hover:decoration-brand-600">
                    Buka di Google Maps
                </a>
            </div>
        </div>

        <div class="md:col-span-7">
            <iframe title="Peta lokasi {{ config('app.name') }}"
                    src="https://www.google.com/maps?q={{ urlencode(config('cafe.address')) }}&amp;output=embed"
                    class="h-80 w-full rounded-lg border-0 md:h-full md:min-h-[24rem]"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
</section>

@endsection
