<x-filament-widgets::widget>
    <div class="fi-dashboard-banner">
        <div>
            <h1 class="fi-dashboard-banner-title">Halo, {{ $firstName }}</h1>
            <p class="fi-dashboard-banner-desc">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</p>

            <ul class="fi-dashboard-banner-stats">
                <li><strong>{{ $pendingCount }}</strong> pesanan menunggu</li>
                <li><strong>{{ $processingCount }}</strong> sedang diproses</li>
                <li><strong>{{ $activeProducts }}</strong> dari {{ $totalProducts }} menu tampil</li>
            </ul>
        </div>

        <div class="fi-dashboard-banner-actions">
            <a href="{{ $createMenuUrl }}" class="fi-dash-btn fi-dash-btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Menu</span>
            </a>

            <a href="{{ $ordersListUrl }}" class="fi-dash-btn fi-dash-btn-secondary">
                <span>Kelola Pesanan</span>
            </a>

            <a href="{{ url('/') }}" target="_blank" class="fi-dash-btn fi-dash-btn-glass" title="Buka website cafe di tab baru">
                <span>Lihat Website</span>
            </a>
        </div>
    </div>
</x-filament-widgets::widget>
