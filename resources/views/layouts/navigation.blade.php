@php
    $navLinks = [
        ['Beranda', route('home'), request()->routeIs('home')],
        ['Menu', route('menu.index'), request()->routeIs('menu.*')],
        ['Lacak pesanan', route('tracking.index'), request()->routeIs('tracking.*')],
        ['Lokasi', '#lokasi', false],
    ];
    $cartCount = app(\App\Services\CartService::class)->count();
@endphp

<header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-neutral-200 bg-white/95 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-6 px-4">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="shrink-0 text-lg font-semibold text-neutral-900">
            {{ config('app.name') }}
        </a>

        {{-- Link utama --}}
        <nav class="hidden items-center gap-7 text-sm font-medium md:flex">
            @foreach ($navLinks as [$label, $url, $active])
                <a href="{{ $url }}"
                   class="{{ $active ? 'text-brand-600' : 'text-neutral-600 hover:text-neutral-900' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        {{-- Kanan: pencarian, keranjang, akun --}}
        <div class="hidden items-center gap-5 md:flex">
            <form method="GET" action="{{ route('menu.index') }}" role="search" class="hidden lg:block">
                <label for="nav-search" class="sr-only">Cari menu</label>
                <input id="nav-search" type="search" name="q" value="{{ request('q') }}" placeholder="Cari menu"
                       class="w-44 rounded-md border border-neutral-300 bg-white px-3 py-1.5 text-sm placeholder-neutral-400 focus:border-brand-600 focus:ring-brand-600">
            </form>

            <a href="{{ route('cart.index') }}" class="relative p-1 text-neutral-700 hover:text-brand-600" aria-label="Keranjang, {{ $cartCount }} item">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H5.4M7 13L5.4 5M7 13l-1.5 3a1 1 0 00.9 1.5H18M9 20.5a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                </svg>
                @if ($cartCount > 0)
                    <span class="absolute -right-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-brand-600 px-1 text-xs font-semibold text-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth
                <div x-data="{ menu: false }" @keydown.escape="menu = false" class="relative text-sm font-medium">
                    <button @click="menu = !menu" :aria-expanded="menu"
                            class="flex items-center gap-1 text-neutral-700 hover:text-neutral-900">
                        <span class="max-w-[8rem] truncate">{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.3 7.3a1 1 0 011.4 0L10 10.6l3.3-3.3a1 1 0 111.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 010-1.4z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div x-show="menu" x-cloak @click.outside="menu = false"
                         class="absolute right-0 mt-3 w-48 rounded-md border border-neutral-200 bg-white py-1 shadow-lg">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-neutral-700 hover:bg-neutral-50">Akun saya</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-neutral-700 hover:bg-neutral-50">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-left text-neutral-700 hover:bg-neutral-50">Keluar</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-4 text-sm font-medium">
                    <a href="{{ route('login') }}" class="text-neutral-600 hover:text-neutral-900">Masuk</a>
                    <a href="{{ route('register') }}"
                       class="rounded-md bg-brand-600 px-4 py-2 text-white transition hover:bg-brand-700">Daftar</a>
                </div>
            @endauth
        </div>

        {{-- Tombol menu mobile --}}
        <div class="flex items-center gap-4 md:hidden">
            <a href="{{ route('cart.index') }}" class="relative p-1 text-neutral-700" aria-label="Keranjang, {{ $cartCount }} item">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H5.4M7 13L5.4 5M7 13l-1.5 3a1 1 0 00.9 1.5H18M9 20.5a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                </svg>
                @if ($cartCount > 0)
                    <span class="absolute -right-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-brand-600 px-1 text-xs font-semibold text-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
            <button @click="open = !open" :aria-expanded="open" aria-label="Buka menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div x-show="open" x-cloak class="border-t border-neutral-200 bg-white px-4 py-4 md:hidden">
        <form method="GET" action="{{ route('menu.index') }}" role="search" class="mb-4">
            <label for="nav-search-mobile" class="sr-only">Cari menu</label>
            <input id="nav-search-mobile" type="search" name="q" value="{{ request('q') }}" placeholder="Cari menu"
                   class="w-full rounded-md border border-neutral-300 px-3 py-2 text-sm placeholder-neutral-400 focus:border-brand-600 focus:ring-brand-600">
        </form>

        <div class="flex flex-col gap-4 text-sm font-medium">
            @foreach ($navLinks as [$label, $url, $active])
                <a href="{{ $url }}" @click="open = false" class="{{ $active ? 'text-brand-600' : 'text-neutral-700' }}">{{ $label }}</a>
            @endforeach

            @auth
                <a href="{{ route('dashboard') }}" class="text-neutral-700">Akun saya</a>
                <a href="{{ route('profile.edit') }}" class="text-neutral-700">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-neutral-700">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-neutral-700">Masuk</a>
                <a href="{{ route('register') }}"
                   class="rounded-md bg-brand-600 px-4 py-2.5 text-center text-white">Daftar</a>
            @endauth
        </div>
    </div>
</header>