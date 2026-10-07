<x-filament-widgets::widget>
    <div class="fi-dashboard-banner">
        <div class="fi-dashboard-banner-content">
            <div class="fi-dashboard-banner-badge">
                <span class="fi-dashboard-banner-pulse"></span>
                <span>Sistem Operasional Aktif · Terhubung Real-Time</span>
            </div>

            <h1 class="fi-dashboard-banner-title">
                Halo, {{ $firstName }}! 👋
            </h1>

            <p class="fi-dashboard-banner-desc">
                Berikut ikhtisar kinerja operasional dan penjualan cafe hari ini ({{ now()->locale('id')->translatedFormat('l, j F Y') }}).
            </p>

            <div class="fi-dashboard-banner-chips">
                <div class="fi-dashboard-chip {{ $pendingCount > 0 ? 'fi-chip-warning' : 'fi-chip-success' }}">
                    <span class="fi-chip-icon">⏳</span>
                    <span><strong>{{ $pendingCount }}</strong> Pesanan Menunggu</span>
                </div>

                <div class="fi-dashboard-chip fi-chip-info">
                    <span class="fi-chip-icon">🍳</span>
                    <span><strong>{{ $processingCount }}</strong> Sedang Diproses</span>
                </div>

                <div class="fi-dashboard-chip fi-chip-neutral">
                    <span class="fi-chip-icon">☕</span>
                    <span><strong>{{ $activeProducts }}</strong> dari {{ $totalProducts }} Menu Aktif</span>
                </div>
            </div>
        </div>

        <div class="fi-dashboard-banner-actions">
            <a href="{{ $createMenuUrl }}" class="fi-dash-btn fi-dash-btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Menu</span>
            </a>

            <a href="{{ $ordersListUrl }}" class="fi-dash-btn fi-dash-btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span>Kelola Pesanan</span>
            </a>

            <a href="{{ url('/') }}" target="_blank" class="fi-dash-btn fi-dash-btn-glass" title="Buka website cafe di tab baru">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                <span>Lihat Website</span>
            </a>
        </div>
    </div>
</x-filament-widgets::widget>
