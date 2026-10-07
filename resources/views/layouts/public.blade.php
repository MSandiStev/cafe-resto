@php
    // Bilah keranjang di bawah layar HP: muncul kalau keranjang berisi, kecuali di halaman keranjang/checkout.
    $cartService = app(\App\Services\CartService::class);
    $barCount = $cartService->count();
    $barTotal = ($barCount > 0 && ! request()->routeIs('cart.*', 'checkout.*')) ? $cartService->total() : 0;
    $showCartBar = $barTotal > 0;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Cafe & Resto'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800 {{ $showCartBar ? 'pb-16 md:pb-0' : '' }}">

    @include('layouts.navigation')

    @if (session('error') || session('success'))
        <div class="mx-auto max-w-5xl px-4 pt-6">
            <div role="alert"
                 class="rounded-lg px-4 py-3 text-sm font-medium {{ session('error') ? 'bg-red-50 text-red-700 ring-1 ring-red-200' : 'bg-green-50 text-green-700 ring-1 ring-green-200' }}">
                {{ session('error') ?? session('success') }}
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    @if ($showCartBar)
        <a href="{{ route('cart.index') }}"
           class="fixed inset-x-0 bottom-0 z-40 flex items-center justify-between bg-brand-600 px-5 py-4 text-white md:hidden">
            <span class="text-sm">{{ $barCount }} item di keranjang</span>
            <span class="text-sm font-semibold">Rp {{ number_format($barTotal, 0, ',', '.') }} · Lihat keranjang</span>
        </a>
    @endif

</body>
</html>
