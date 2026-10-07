<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe & Resto - Kelezatan Rasa, Kenyamanan Suasana</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased">

    <!-- 1. NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl bg-red-700 flex items-center justify-center text-white font-bold text-base shadow-sm">
                        ☕
                    </div>
                    <span class="font-bold text-stone-900 text-base tracking-tight">CAFE & RESTO</span>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 text-xs font-medium text-stone-600">
                    <a href="#beranda" class="text-red-700 font-semibold">Beranda</a>
                    <a href="#menu" class="hover:text-red-700 transition-colors">Menu Utama</a>
                    <a href="#promo" class="hover:text-red-700 transition-colors">Promo Hari Ini</a>
                    <a href="#tentang" class="hover:text-red-700 transition-colors">Tentang Kami</a>
                </nav>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
                    <!-- Search Bar Simple -->
                    <div class="hidden sm:flex items-center bg-stone-100 rounded-lg px-3 py-1.5 border border-stone-200">
                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" placeholder="Cari kopi atau makanan..." class="bg-transparent border-none text-xs text-stone-800 focus:outline-none ml-2 w-36 lg:w-48 placeholder-stone-400">
                    </div>

                    <!-- Cart Icon -->
                    <a href="#" class="relative p-2 rounded-lg text-stone-600 hover:bg-stone-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span class="absolute top-1 right-1 w-4 h-4 rounded-full bg-red-700 text-white text-[10px] font-bold flex items-center justify-center">3</span>
                    </a>

                    <!-- Auth Button -->
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-3.5 py-1.5 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-medium transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-3.5 py-1.5 rounded-lg bg-red-700 hover:bg-red-800 text-white text-xs font-medium transition-colors shadow-sm">Masuk</a>
                        @endauth
                    @endif
                </div>

            </div>
        </div>
    </header>

    <!-- 2. HERO BANNER -->
    <section id="beranda" class="py-12 md:py-16 bg-stone-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            
            <div class="md:col-span-7 space-y-4 z-10">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-red-950/80 text-red-400 border border-red-800/50">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Spesial Racikan Barista
                </span>
                <h1 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                    Nikmati Kopi Terbaik & <br class="hidden sm:inline" />
                    <span class="text-red-500">Hidangan Lezat</span> Tanpa Antre.
                </h1>
                <p class="text-stone-300 text-xs sm:text-sm leading-relaxed max-w-lg">
                    Pesan secara online untuk Dine-In, Takeaway, atau pengiriman langsung ke tempat Anda dengan jaminan kualitas bahan segar setiap hari.
                </p>
                <div class="pt-2 flex flex-wrap gap-3">
                    <a href="#menu" class="px-5 py-2.5 rounded-lg bg-red-700 hover:bg-red-800 text-white text-xs font-medium transition-colors shadow-sm flex items-center gap-2">
                        Pesan Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#promo" class="px-5 py-2.5 rounded-lg border border-stone-700 hover:bg-stone-800 text-stone-200 text-xs font-medium transition-colors">
                        Lihat Promo
                    </a>
                </div>
            </div>

            <div class="md:col-span-5 flex justify-center z-10">
                <div class="relative w-full max-w-sm aspect-square rounded-2xl overflow-hidden border border-stone-800 shadow-2xl bg-stone-800 flex items-center justify-center">
                    <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80" alt="Kopi Artisan" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </section>

    <!-- 3. KATEGORI MENU -->
    <section class="py-10 border-b border-stone-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xs font-bold text-red-700 uppercase tracking-wider mb-4">Kategori pilihan</h2>
            
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700/50 hover:bg-red-50/30 transition-all cursor-pointer flex items-center gap-3">
                    <span class="text-2xl">☕</span>
                    <div>
                        <h3 class="text-xs font-bold text-stone-800">Espresso & Kopi</h3>
                        <p class="text-[11px] text-stone-500">12 Pilihan</p>
                    </div>
                </div>
                <div class="p-4 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700/50 hover:bg-red-50/30 transition-all cursor-pointer flex items-center gap-3">
                    <span class="text-2xl">🍽️</span>
                    <div>
                        <h3 class="text-xs font-bold text-stone-800">Makanan Berat</h3>
                        <p class="text-[11px] text-stone-500">18 Pilihan</p>
                    </div>
                </div>
                <div class="p-4 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700/50 hover:bg-red-50/30 transition-all cursor-pointer flex items-center gap-3">
                    <span class="text-2xl">🥐</span>
                    <div>
                        <h3 class="text-xs font-bold text-stone-800">Pastry & Roti</h3>
                        <p class="text-[11px] text-stone-500">8 Pilihan</p>
                    </div>
                </div>
                <div class="p-4 rounded-xl border border-stone-200 bg-stone-50 hover:border-red-700/50 hover:bg-red-50/30 transition-all cursor-pointer flex items-center gap-3">
                    <span class="text-2xl">🍹</span>
                    <div>
                        <h3 class="text-xs font-bold text-stone-800">Minuman Non-Kopi</h3>
                        <p class="text-[11px] text-stone-500">10 Pilihan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. PRODUK UNGGULAN -->
    <section id="menu" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-stone-900">Menu Paling Populer</h2>
                <p class="text-xs text-stone-500 mt-1">Pilihan terfavorit dari para pelanggan setia kami.</p>
            </div>
            <a href="#" class="text-xs font-semibold text-red-700 hover:underline">Lihat Semua Menu →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Item Card 1 -->
            <div class="bg-white rounded-xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&w=500&q=80" alt="Latte" class="w-full h-full object-cover">
                        <span class="absolute top-2 left-2 bg-stone-900/80 text-white text-[10px] font-medium px-2 py-0.5 rounded">Terlaris</span>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Espresso Base</span>
                            <span class="text-amber-500 font-semibold">★ 4.9</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Caramel Macchiato</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Perpaduan espresso mantap, susu segar, dan sirup karamel manis gurih.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between mt-2">
                    <span class="text-sm font-bold text-red-700">Rp 32.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

            <!-- Item Card 2 -->
            <div class="bg-white rounded-xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=500&q=80" alt="Nasi Goreng" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Makanan Berat</span>
                            <span class="text-amber-500 font-semibold">★ 4.8</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Nasi Goreng Rempah</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Nasi goreng khas resto dengan bumbu rempah pilihan, telur, dan sate ayam.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between mt-2">
                    <span class="text-sm font-bold text-red-700">Rp 42.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

            <!-- Item Card 3 -->
            <div class="bg-white rounded-xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=500&q=80" alt="Croissant" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Pastry</span>
                            <span class="text-amber-500 font-semibold">★ 4.7</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Butter Croissant</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Croissant renyah berlapis dengan aroma butter mentega Prancis yang kaya.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between mt-2">
                    <span class="text-sm font-bold text-red-700">Rp 25.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

            <!-- Item Card 4 -->
            <div class="bg-white rounded-xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-stone-100 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=500&q=80" alt="Cold Brew" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-center justify-between text-[11px] text-stone-500 mb-1">
                            <span>Cold Brew</span>
                            <span class="text-amber-500 font-semibold">★ 5.0</span>
                        </div>
                        <h3 class="text-sm font-bold text-stone-800">Signature Cold Brew</h3>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2">Kopi peram 12 jam dengan rasa yang halus, rendah asam, dan menyegarkan.</p>
                    </div>
                </div>
                <div class="p-4 pt-0 flex items-center justify-between mt-2">
                    <span class="text-sm font-bold text-red-700">Rp 28.000</span>
                    <button class="px-3 py-1.5 bg-red-700 hover:bg-red-800 text-white rounded-lg text-xs font-medium transition-colors">
                        + Tambah
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- 5. FOOTER -->
    <footer class="bg-stone-900 text-stone-400 text-xs border-t border-stone-800 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-white font-bold text-sm">
                    <div class="w-7 h-7 rounded-lg bg-red-700 flex items-center justify-center text-xs">☕</div>
                    <span>CAFE & RESTO</span>
                </div>
                <p class="text-stone-400 text-xs leading-relaxed">Pesan racikan kopi terbaik dan hidangan lezat langsung dari tempat Anda.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">Menu Makanan</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Daftar Minuman</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Lokasi Cabang</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Jam Operasional</h4>
                <p>Senin - Jumat: 08:00 - 22:00 WIB</p>
                <p class="mt-1">Sabtu - Minggu: 07:00 - 23:00 WIB</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kontak & Lokasi</h4>
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