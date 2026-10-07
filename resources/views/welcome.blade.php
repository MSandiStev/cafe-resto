<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe & Resto - Kelezatan Rasa, Kenyamanan Suasana</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased selection:bg-red-700 selection:text-white">

    <!-- 1. NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-red-700 flex items-center justify-center text-white font-bold text-sm shadow-sm transition-transform group-hover:scale-105">
                        ☕
                    </div>
                    <div>
                        <span class="font-bold text-stone-900 text-sm tracking-tight block leading-none">CAFE & RESTO</span>
                        <span class="text-[10px] text-stone-500 font-medium">Artisan Coffee & Food</span>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-7 text-xs font-medium text-stone-600">
                    <a href="#beranda" class="text-red-700 font-semibold">Beranda</a>
                    <a href="#menu" class="hover:text-red-700 transition-colors">Menu Utama</a>
                    <a href="#kategori" class="hover:text-red-700 transition-colors">Kategori</a>
                    <a href="#tentang" class="hover:text-red-700 transition-colors">Tentang Kami</a>
                </nav>

                <!-- Search & Actions -->
                <div class="flex items-center gap-3">
                    <!-- Search Input -->
                    <div class="hidden lg:flex items-center bg-stone-100 rounded-lg px-3 py-1.5 border border-stone-200 focus-within:border-stone-400 transition-colors">
                        <svg class="w-4 h-4 text-stone-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" placeholder="Cari kopi, makanan..." class="bg-transparent border-none text-xs text-stone-800 focus:outline-none ml-2 w-40 placeholder-stone-400">
                    </div>

                    <!-- Cart -->
                    <a href="#" class="relative p-2 rounded-lg text-stone-700 hover:bg-stone-100 transition-colors" title="Keranjang">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span class="absolute top-1 right-1 w-4 h-4 rounded-full bg-red-700 text-white text-[10px] font-bold flex items-center justify-center">2</span>
                    </a>

                    <div class="h-4 w-px bg-stone-200 hidden sm:block"></div>

                    <!-- Auth Button -->
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-3.5 py-2 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-red-700 hover:bg-red-800 text-white text-xs font-semibold transition-colors shadow-sm">Masuk</a>
                        @endauth
                    @endif
                </div>

            </div>
        </div>
    </header>

    <!-- 2. HERO SECTION -->
    <section id="beranda" class="bg-stone-900 text-white py-12 md:py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            
            <div class="md:col-span-7 space-y-4 z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-800 border border-stone-700 text-xs font-medium text-stone-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Buka Hari Ini: 08.00 - 22.00 WIB
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-white leading-tight">
                    Kelezatan Rasa, <br />
                    <span class="text-stone-300">Kenyamanan Suasana.</span>
                </h1>
                <p class="text-stone-400 text-xs sm:text-sm leading-relaxed max-w-lg">
                    Pesan racikan kopi terbaik, aneka hidangan lezat, dan minuman segar langsung dari genggamanmu tanpa perlu antre.
                </p>
                <div class="pt-2 flex flex-wrap gap-3">
                    <a href="#menu" class="px-5 py-2.5 rounded-lg bg-red-700 hover:bg-red-800 text-white text-xs font-medium transition-colors shadow-sm flex items-center gap-2">
                        Pesan Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#kategori" class="px-5 py-2.5 rounded-lg border border-stone-700 hover:bg-stone-800 text-stone-300 text-xs font-medium transition-colors">
                        Eksplor Menu
                    </a>
                </div>
            </div>

            <div class="md:col-span-5 flex justify-center z-10">
                <div class="relative w-full max-w-md aspect-4/3 rounded-xl overflow-hidden border border-stone-800 shadow-2xl bg-stone-800">
                    <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&q=80" alt="Cafe & Resto Interior" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </section>

    <!-- 3. KATEGORI PILIHAN -->
    <section id="kategori" class="py-10 bg-white border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-base font-bold text-stone-900">Kategori Menu</h2>
                    <p class="text-xs text-stone-500 mt-0.5">Pilih hidangan sesuai keinginanmu</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="#" class="p-3.5 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700 hover:bg-white transition-all group flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-stone-200/60 group-hover:bg-red-50 text-stone-700 group-hover:text-red-700 flex items-center justify-center text-lg transition-colors">
                        ☕
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-stone-800 group-hover:text-red-700 transition-colors">Kopi & Espresso</h3>
                        <p class="text-[11px] text-stone-500">14 Varian</p>
                    </div>
                </a>

                <a href="#" class="p-3.5 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700 hover:bg-white transition-all group flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-stone-200/60 group-hover:bg-red-50 text-stone-700 group-hover:text-red-700 flex items-center justify-center text-lg transition-colors">
                        🍽️
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-stone-800 group-hover:text-red-700 transition-colors">Makanan Berat</h3>
                        <p class="text-[11px] text-stone-500">20 Varian</p>
                    </div>
                </a>

                <a href="#" class="p-3.5 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700 hover:bg-white transition-all group flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-stone-200/60 group-hover:bg-red-50 text-stone-700 group-hover:text-red-700 flex items-center justify-center text-lg transition-colors">
                        🥐
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-stone-800 group-hover:text-red-700 transition-colors">Pastry & Roti</h3>
                        <p class="text-[11px] text-stone-500">10 Varian</p>
                    </div>
                </a>

                <a href="#" class="p-3.5 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700 hover:bg-white transition-all group flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-stone-200/60 group-hover:bg-red-50 text-stone-700 group-hover:text-red-700 flex items-center justify-center text-lg transition-colors">
                        🍹
                    </div>
                    <div>
                        <h3 class="text-xs font-semibold text-stone-800 group-hover:text-red-700 transition-colors">Non-Coffee</h3>
                        <p class="text-[11px] text-stone-500">12 Varian</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- 4. PRODUK UNGGULAN -->
    <section id="menu" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-stone-900">Menu Rekomendasi</h2>
                <p class="text-xs text-stone-500 mt-1">Sajian terfavorit pelanggan minggu ini.</p>
            </div>
            <a href="#" class="text-xs font-semibold text-red-700 hover:underline inline-flex items-center gap-1">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Product 1 -->
            <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=500&q=80" alt="Caramel Macchiato" class="w-full h-full object-cover">
                        <span class="absolute top-2 left-2 bg-stone-900/80 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded">Favorite</span>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Kopi & Espresso</span>
                            <span class="text-amber-500 font-medium">★ 4.9 (120+)</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Caramel Macchiato</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Espresso ganda dengan susu segar hangat dan lelehan sirup karamel gurih.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between">
                    <span class="text-sm font-bold text-stone-900">Rp 32.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=500&q=80" alt="Nasi Goreng Rempah" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Makanan Berat</span>
                            <span class="text-amber-500 font-medium">★ 4.8 (85+)</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Nasi Goreng Rempah</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Nasi goreng khas resto kaya rempah dengan topping telur, sate ayam, dan kerupuk.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between">
                    <span class="text-sm font-bold text-stone-900">Rp 42.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=500&q=80" alt="Butter Croissant" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Pastry</span>
                            <span class="text-amber-500 font-medium">★ 4.7 (60+)</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Butter Croissant</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Croissant renyah berlapis dengan aroma butter mentega khas Prancis.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between">
                    <span class="text-sm font-bold text-stone-900">Rp 25.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=500&q=80" alt="Cold Brew" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Cold Brew</span>
                            <span class="text-amber-500 font-medium">★ 5.0 (40+)</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Signature Cold Brew</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Kopi seduh dingin peram 12 jam dengan rasa yang halus dan segar.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between">
                    <span class="text-sm font-bold text-stone-900">Rp 28.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- 5. FOOTER -->
    <footer class="bg-stone-900 text-stone-400 text-xs border-t border-stone-800 pt-10 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-white font-bold text-sm">
                    <div class="w-7 h-7 rounded-lg bg-red-700 flex items-center justify-center text-xs">☕</div>
                    <span>CAFE & RESTO</span>
                </div>
                <p class="text-stone-400 text-xs leading-relaxed">Menyajikan hidangan berkualitas tinggi dengan kenyamanan pemesanan serba digital.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Menu</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">Kopi & Espresso</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Makanan Berat</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Pastry & Dessert</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Operasional</h4>
                <p>Senin - Jumat: 08:00 - 22:00 WIB</p>
                <p class="mt-1">Sabtu - Minggu: 07:00 - 23:00 WIB</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kontak</h4>
                <p>Jl. Cafe No. 123, Bandung</p>
                <p class="mt-1">WhatsApp: +62 812-3456-7890</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-6 border-t border-stone-800 text-center text-stone-500">
            © {{ date('Y') }} Cafe & Resto. All rights reserved.
        </div>
    </footer>

</body>
</html>