@php
    $heading = $attributes->get('heading');
    $subheading = $attributes->get('subheading');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $heading ? $heading . ' - ' : '' }}{{ config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-cream font-sans text-neutral-800 antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-[5fr_6fr]">
            {{-- Panel kiri (hanya di layar lebar) --}}
            <aside class="hidden flex-col justify-between bg-brand-600 p-12 text-white lg:flex">
                <a href="{{ route('home') }}" class="text-sm font-medium text-white/80 transition hover:text-white">
                    ← Kembali ke website
                </a>

                <div>
                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-white/80">Cafe &amp; Resto</p>
                    <h2 class="mt-3 text-4xl font-bold leading-tight">{{ config('app.name') }}</h2>
                    <p class="mt-4 max-w-sm leading-relaxed text-white/90">
                        Masuk untuk memesan lebih cepat dan melihat riwayat pesanan Anda.
                    </p>
                </div>

                <p class="text-xs text-white/70">© {{ date('Y') }} {{ config('app.name') }}</p>
            </aside>

            {{-- Form --}}
            <main class="flex min-h-screen items-center justify-center px-4 py-10">
                <div class="w-full max-w-md">
                    <a href="{{ route('home') }}" class="mb-8 block text-xl font-bold text-brand-600 lg:hidden">
                        {{ config('app.name') }}
                    </a>

                    @if ($heading)
                        <h1 class="text-2xl font-bold text-neutral-900">{{ $heading }}</h1>
                    @endif
                    @if ($subheading)
                        <p class="mt-2 text-sm leading-relaxed text-neutral-600">{{ $subheading }}</p>
                    @endif

                    <div class="mt-8 rounded-2xl bg-white p-6 ring-1 ring-neutral-100 sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
