<aside class="fi-login-brand">
    <div class="fi-login-brand-top">
        <a href="{{ url('/') }}" class="fi-login-brand-back">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kunjungi Website Publik</span>
        </a>

        <div class="fi-login-brand-badge">
            <span class="fi-login-brand-dot"></span>
            <span>Panel Manajemen Resto &amp; Kasir</span>
        </div>
    </div>

    <div class="fi-login-brand-center">
        <div class="fi-login-brand-logo-wrap">
            <svg class="fi-login-brand-icon" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="48" height="48" rx="14" fill="currentColor" fill-opacity="0.15"/>
                <path d="M18 11C18 11 17 13 18 15C19 17 18 18 18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M24 9C24 9 23 12 24 14C25 16 24 18 24 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                <path d="M30 11C30 11 29 13 30 15C31 17 30 18 30 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M12 21H36V28C36 33.5228 31.5228 38 26 38H22C16.4772 38 12 33.5228 12 28V21Z" fill="currentColor"/>
                <path d="M35 24H37.5C39.433 24 41 25.567 41 27.5C41 29.433 39.433 31 37.5 31H35" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M10 40H38" stroke="currentColor" stroke-width="2.8" stroke-linecap="round"/>
            </svg>
            <div>
                <p class="fi-login-brand-kicker">CONTROL CENTER</p>
                <h1 class="fi-login-brand-name">{{ config('app.name') }}</h1>
            </div>
        </div>

        <p class="fi-login-brand-tagline">
            Pusat kendali operasional restoran. Kelola pesanan masuk secara real-time, pantau omzet penjualan harian, dan mutasi ketersediaan menu dari satu dashboard.
        </p>

        <div class="fi-login-brand-features">
            <div class="fi-login-feature-item">
                <div class="fi-login-feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <strong class="fi-login-feature-title">Analisis Omzet &amp; Penjualan</strong>
                    <span class="fi-login-feature-desc">Grafik tren pendapatan 7 hari &amp; menu terlaris otomatis terhitung.</span>
                </div>
            </div>

            <div class="fi-login-feature-item">
                <div class="fi-login-feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                <div>
                    <strong class="fi-login-feature-title">Manajemen Antrean Pesanan</strong>
                    <span class="fi-login-feature-desc">Pantau status pesanan pelanggan dari antrean hingga siap saji.</span>
                </div>
            </div>

            <div class="fi-login-feature-item">
                <div class="fi-login-feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <strong class="fi-login-feature-title">Katalog &amp; Ketersediaan Menu</strong>
                    <span class="fi-login-feature-desc">Perbarui harga, status ketersediaan, serta kategori dalam hitungan detik.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="fi-login-brand-footer">
        <span>© {{ date('Y') }} {{ config('app.name') }} Control System</span>
        <span>v2.5 Enterprise Edition</span>
    </div>
</aside>
