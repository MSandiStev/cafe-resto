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
@endphp

@section('content')

{{-- Hero --}}
<section class="mx-auto grid max-w-6xl gap-10 px-4 pb-16 pt-12 md:grid-cols-12 md:items-end md:pt-20">
    <div class="md:col-span-7">
        <p class="flex items-center gap-2 text-sm text-neutral-600">
            <span class="h-2 w-2 rounded-full {{ $isOpen ? 'bg-emerald-600' : 'bg-neutral-400' }}"></span>
            @if ($isOpen)
                Buka sekarang, tutup pukul {{ $closeAt }}
            @else
                Sedang tutup, buka lagi pukul {{ $nextOpen }}
            @endif
        </p>

        <h1 class="mt-6 text-4xl font-semibold leading-[1.1] tracking-tight text-neutral-900 sm:text-5xl md:text-6xl">
            Pesan kopi dan makanan tanpa antre di kasir.
        </h1>

        <p class="mt-6 max-w-md leading-relaxed text-neutral-600">
            Pilih menu, isi data pesanan di halaman checkout, lalu pantau statusnya dari ponsel.
        </p>

        <div class="mt-8 flex flex-wrap items-center gap-6">
            <a href="{{ route('menu.index') }}"
               class="rounded-md bg-brand-600 px-6 py-3 font-medium text-white transition hover:bg-brand-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
                Lihat menu
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

{{-- Promo (hanya tampil kalau ada promo yang sedang berjalan) --}}
@if ($promos->isNotEmpty())
<section class="border-t border-neutral-200">
    <div class="mx-auto max-w-6xl px-4 py-10">
        <h2 class="text-lg font-semibold text-neutral-900">Promo yang sedang berjalan</h2>

        <ul class="mt-4 divide-y divide-neutral-200 border-y border-neutral-200">
            @foreach ($promos as $promo)
                <li>
                    <a href="{{ $promo->product ? route('menu.show', $promo->product) : route('menu.index') }}"
                       class="flex flex-wrap items-baseline gap-x-6 gap-y-1 py-4 transition hover:bg-white">
                        @if ($promo->badge)
                            <span class="shrink-0 font-semibold text-brand-600 sm:w-40">{{ $promo->badge }}</span>
                        @endif

                        <span class="min-w-0 flex-1">
                            <span class="block font-medium text-neutral-900">{{ $promo->title }}</span>
                            @if ($promo->description)
                                <span class="block text-sm text-neutral-500">{{ $promo->description }}</span>
                            @endif
                        </span>

                        @if ($promo->ends_on)
                            <span class="text-sm text-neutral-500">
                                Sampai {{ $promo->ends_on->locale('id')->translatedFormat('j F Y') }}
                            </span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

{{-- Menu --}}
<section class="border-t border-neutral-200 bg-white">
    <div class="mx-auto grid max-w-6xl gap-12 px-4 py-16 md:grid-cols-12">

        <div class="md:col-span-4 md:sticky md:top-24 md:self-start">
            <h2 class="text-2xl font-semibold text-neutral-900">Menu favorit</h2>
            <p class="mt-3 max-w-xs text-sm leading-relaxed text-neutral-600">
                Pilihan dari dapur kami. Tambahkan ke keranjang langsung dari daftar ini.
            </p>

            @if (isset($categories) && $categories->isNotEmpty())
                <ul class="mt-8 divide-y divide-neutral-200 border-y border-neutral-200 text-sm">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('menu.index', ['category' => $category->slug]) }}"
                               class="flex items-center justify-between py-3 transition hover:text-brand-600">
                                <span class="font-medium">{{ $category->name }}</span>
                                <span class="text-neutral-500">{{ $category->products_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <a href="{{ route('menu.index') }}"
               class="mt-6 inline-block text-sm font-medium text-brand-600 underline underline-offset-4">
                Lihat semua menu
            </a>
        </div>

        <div class="md:col-span-8">
            @if (!isset($featured) || $featured->isEmpty())
                <p class="text-neutral-500">
                    Belum ada menu favorit. Tandai menu sebagai unggulan lewat panel admin.
                </p>
            @else
                <ul class="divide-y divide-neutral-200 border-y border-neutral-200">
                    @foreach ($featured as $product)
                        <li class="flex items-center gap-4 py-5">
                            <a href="{{ route('menu.show', $product) }}" aria-hidden="true" tabindex="-1"
                               class="block h-16 w-16 shrink-0 overflow-hidden rounded-md bg-brand-50">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="" loading="lazy"
                                         class="h-full w-full object-cover">
                                @else
                                    <span class="flex h-full w-full items-center justify-center text-xl font-semibold text-brand-600">
                                        {{ mb_substr($product->name, 0, 1) }}
                                    </span>
                                @endif
                            </a>

                            <div class="min-w-0 flex-1">
                                <div class="flex items-baseline gap-3">
                                    <a href="{{ route('menu.show', $product) }}"
                                       class="font-semibold text-neutral-900 hover:text-brand-600">
                                        {{ $product->name }}
                                    </a>
                                    <span class="flex-1 border-b border-dotted border-neutral-300"></span>
                                    <span class="whitespace-nowrap font-semibold text-neutral-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="mt-1 line-clamp-1 text-sm text-neutral-500">{{ $product->description }}</p>
                            </div>

                            <form method="POST" action="{{ route('cart.store', $product) }}">
                                @csrf
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" aria-label="Tambah {{ $product->name }} ke keranjang"
                                        class="rounded-md border border-neutral-300 px-3 py-1.5 text-sm font-medium text-neutral-800 transition hover:border-brand-600 hover:bg-brand-600 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
                                    Tambah
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</section>

{{-- Kata pelanggan (hanya tampil kalau ada testimoni yang dipublikasikan) --}}
@if ($testimonials->isNotEmpty())
<section class="border-t border-neutral-200">
    <div class="mx-auto max-w-6xl px-4 py-16">
        <h2 class="text-2xl font-semibold text-neutral-900">Kata pelanggan</h2>

        <div class="mt-8 grid gap-10 md:grid-cols-3">
            @foreach ($testimonials as $testimonial)
                <figure class="border-l-2 border-brand-600 pl-5">
                    <blockquote class="leading-relaxed text-neutral-700">{{ $testimonial->body }}</blockquote>
                    <figcaption class="mt-3 text-sm font-medium text-neutral-900">{{ $testimonial->name }}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Jam buka dan lokasi --}}
<section id="kunjungi" class="border-t border-neutral-200">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 py-16 md:grid-cols-12">

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