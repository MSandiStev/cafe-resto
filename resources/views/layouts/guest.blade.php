@php
    $heading = $attributes->get('heading');
    $subheading = $attributes->get('subheading');
    $activeTab = $attributes->get('activeTab');
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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-cream font-sans text-neutral-800 antialiased selection:bg-brand-500 selection:text-white">
        <div class="min-h-screen lg:grid lg:grid-cols-12">
            {{-- Panel Kiri: Hero & Brand Atmosphere (Layar Besar) --}}
            <aside class="relative hidden flex-col justify-between overflow-hidden bg-gradient-to-br from-[#160606] via-[#2c0808] to-[#450a0a] p-12 text-white lg:col-span-5 xl:col-span-5 lg:flex">
                {{-- Ambient Light Accents --}}
                <div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-amber-500/15 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-brand-600/25 blur-3xl"></div>
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-[0.03]"></div>

                {{-- Header Kiri --}}
                <div class="relative z-10 flex items-center justify-between">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-medium text-white/90 backdrop-blur-md transition hover:bg-white/20 hover:text-white">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Website</span>
                    </a>

                    <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/15 px-3 py-1 text-xs font-medium text-emerald-300 backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Buka Hari Ini
                    </span>
                </div>

                {{-- Konten Utama Kiri --}}
                <div class="relative z-10 my-auto py-8">
                    <div class="mb-5 inline-flex items-center gap-2.5 rounded-full border border-amber-400/25 bg-amber-400/10 px-3.5 py-1.5 text-xs font-semibold tracking-wider text-amber-200 uppercase backdrop-blur-md">
                        <x-application-logo class="h-4 w-4 text-amber-300" />
                        <span>Artisan Cafe &amp; Resto</span>
                    </div>

                    <h2 class="text-3xl font-extrabold leading-tight text-white xl:text-4xl">
                        Kelezatan Rasa, <br>
                        <span class="bg-gradient-to-r from-amber-200 via-rose-200 to-white bg-clip-text text-transparent">
                            Kenyamanan Suasana.
                        </span>
                    </h2>

                    <p class="mt-4 max-w-md text-sm leading-relaxed text-white/80 xl:text-base">
                        Pesan racikan kopi terbaik, aneka hidangan lezat, dan minuman segar langsung dari genggamanmu tanpa perlu antre.
                    </p>

                    {{-- Fitur Unggulan (Glass Cards) --}}
                    <div class="mt-8 space-y-3.5">
                        <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-3.5 backdrop-blur-md transition hover:bg-white/10">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-amber-400/20 text-amber-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Pesan Cepat &amp; Praktis</h3>
                                <p class="text-xs text-white/70">Dine-in langsung diantar ke meja, atau takeaway siap diambil.</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-3.5 backdrop-blur-md transition hover:bg-white/10">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-rose-400/20 text-rose-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-white">Lacak Pesanan Real-time</h3>
                                <p class="text-xs text-white/70">Pantau proses dari racikan barista sampai pesanan siap saji.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Testimonial / Social Proof --}}
                    <div class="mt-8 rounded-2xl border border-white/10 bg-gradient-to-r from-white/10 to-transparent p-4 backdrop-blur-md">
                        <div class="flex items-center gap-1 text-amber-300">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ms-2 text-xs font-bold text-white">4.9 / 5.0</span>
                        </div>
                        <p class="mt-2 text-xs italic text-white/80">"Kopinya nikmat, tempatnya nyaman, dan pesan lewat website sangat menghemat waktu."</p>
                        <p class="mt-1 text-[11px] font-medium text-amber-200/90">— Pilihan favorit lebih dari 2.500+ pelanggan</p>
                    </div>
                </div>

                {{-- Footer Kiri --}}
                <div class="relative z-10 flex items-center justify-between text-xs text-white/60">
                    <span>© {{ date('Y') }} {{ config('app.name') }}</span>
                    <span>Fresh · Authentic · Cozy</span>
                </div>
            </aside>

            {{-- Panel Kanan: Form Area --}}
            <main class="relative flex min-h-screen flex-col items-center justify-center bg-[#fdfbf9] px-4 py-10 sm:px-6 lg:col-span-7 xl:col-span-7 lg:px-12">
                {{-- Ambient Accent Light --}}
                <div class="pointer-events-none absolute right-0 top-0 h-80 w-80 rounded-full bg-brand-500/5 blur-3xl"></div>
                <div class="pointer-events-none absolute bottom-0 left-0 h-80 w-80 rounded-full bg-amber-500/5 blur-3xl"></div>

                <div class="relative z-10 w-full max-w-md">
                    {{-- Mobile Top Navigation --}}
                    <div class="mb-6 flex items-center justify-between lg:hidden">
                        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand-600 text-white shadow-md shadow-brand-600/20">
                                <x-application-logo class="h-5 w-5" />
                            </span>
                            <span class="text-lg font-bold text-neutral-900">{{ config('app.name') }}</span>
                        </a>

                        <a href="{{ route('home') }}" class="text-xs font-semibold text-neutral-600 hover:text-brand-600">
                            ← Website
                        </a>
                    </div>

                    {{-- Kartu Form Utama --}}
                    <div class="rounded-3xl border border-neutral-100 bg-white p-7 shadow-[0_20px_50px_-15px_rgba(40,10,10,0.06)] sm:p-9">
                        {{-- Brand Header Icon di dalam Card --}}
                        <div class="mb-6 hidden items-center gap-3 lg:flex">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-600 to-brand-700 text-white shadow-lg shadow-brand-600/25">
                                <x-application-logo class="h-6 w-6" />
                            </div>
                            <div>
                                <span class="text-xs font-semibold uppercase tracking-wider text-brand-600">Cafe &amp; Resto</span>
                                <h2 class="text-lg font-bold text-neutral-900">{{ config('app.name') }}</h2>
                            </div>
                        </div>

                        {{-- Segmented Tab Switcher (Jika activeTab didefinisikan) --}}
                        @if ($activeTab)
                            <div class="mb-6 grid grid-cols-2 rounded-2xl bg-neutral-100/90 p-1.5 text-center text-sm font-semibold">
                                <a href="{{ route('login') }}"
                                   class="rounded-xl py-2.5 transition duration-150 {{ $activeTab === 'login' ? 'bg-white text-neutral-900 shadow-sm' : 'text-neutral-500 hover:text-neutral-900' }}">
                                    Masuk
                                </a>
                                <a href="{{ route('register') }}"
                                   class="rounded-xl py-2.5 transition duration-150 {{ $activeTab === 'register' ? 'bg-white text-neutral-900 shadow-sm' : 'text-neutral-500 hover:text-neutral-900' }}">
                                    Daftar Akun
                                </a>
                            </div>
                        @endif

                        {{-- Judul dan Subjudul Form --}}
                        @if ($heading)
                            <h1 class="text-2xl font-bold tracking-tight text-neutral-900 sm:text-3xl">{{ $heading }}</h1>
                        @endif
                        @if ($subheading)
                            <p class="mt-2 text-sm leading-relaxed text-neutral-500">{{ $subheading }}</p>
                        @endif

                        <div class="mt-6">
                            {{ $slot }}
                        </div>
                    </div>

                    {{-- Security Badge Footer --}}
                    <div class="mt-6 flex items-center justify-center gap-2 text-xs text-neutral-400">
                        <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Koneksi aman dengan enkripsi SSL 256-bit</span>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
