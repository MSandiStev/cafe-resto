<header x-data="{ open: false }" class="sticky top-0 z-40 border-b border-neutral-100 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
        <a href="{{ route('home') }}" class="text-xl font-bold text-brand-600">
            {{ config('app.name') }}
        </a>

        <nav class="hidden items-center gap-8 text-sm font-medium md:flex">
            <a href="{{ route('home') }}" class="hover:text-brand-600">Beranda</a>
            <a href="{{ route('menu.index') }}" class="hover:text-brand-600">Menu</a>
            <a href="{{ route('tracking.create') }}" class="hover:text-brand-600">Lacak Pesanan</a>
            <a href="#lokasi" class="hover:text-brand-600">Lokasi</a>
        </nav>

        <div class="hidden items-center gap-3 md:flex">
            <a href="{{ route('cart.index') }}" class="relative text-sm font-medium hover:text-brand-600">
    Keranjang
    @if ($cartCount > 0)
        <span class="absolute -right-4 -top-2 flex h-5 min-w-5 items-center justify-center rounded-full bg-brand-600 px-1 text-xs font-semibold text-white">
            {{ $cartCount }}
        </span>
    @endif
</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-brand-600">Akun</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-brand-600">Masuk</a>
            @endauth
            <a href="{{ route('menu.index') }}"
               class="rounded-lg bg-brand-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-700">
                Pesan Sekarang
            </a>
        </div>

        <button @click="open = !open" class="md:hidden" aria-label="Buka menu">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div x-show="open" x-cloak class="border-t border-neutral-100 px-4 py-4 md:hidden">
        <div class="flex flex-col gap-4 text-sm font-medium">
            <a href="{{ route('cart.index') }}">Keranjang @if ($cartCount > 0)({{ $cartCount }})@endif</a>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('menu.index') }}">Menu</a>
            <a href="{{ route('tracking.create') }}">Lacak Pesanan</a>
            <a href="#lokasi">Lokasi</a>
            <a href="{{ route('menu.index') }}" class="rounded-lg bg-brand-600 px-5 py-2.5 text-center font-semibold text-white">
                Pesan Sekarang
            </a>
        </div>
    </div>
</header>