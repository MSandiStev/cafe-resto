<style>
    /* ==========================================================================
       Tema admin: putih + satu warna merah. Datar, tanpa gradien, bayangan, atau efek kaca.
       Merah dipakai hanya untuk: menu aktif, tombol utama, header dashboard, dan grafik.
       ========================================================================== */
    :root {
        --brand: #b91c1c;        /* merah utama */
        --brand-dark: #991b1b;
        --brand-tint: #fef2f2;   /* latar merah sangat muda */
        --line: #e5e7eb;
    }

    /* 1. Dasar */
    html:not(.dark) .fi-body {
        background-color: #f9fafb !important;
    }

    .fi-section,
    .fi-wi-stats-overview-stat,
    .fi-ta-ctn {
        border-radius: 0.625rem !important;
        border: 1px solid var(--line) !important;
        box-shadow: none !important;
    }

    .dark .fi-section,
    .dark .fi-wi-stats-overview-stat,
    .dark .fi-ta-ctn {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    /* Topbar putih dengan garis merah tipis di atas */
    html:not(.dark) .fi-topbar {
        background-color: #ffffff !important;
        border-top: 3px solid var(--brand);
        border-bottom: 1px solid var(--line) !important;
        box-shadow: none !important;
    }

    /* 2. Sidebar: item aktif = latar merah muda + garis merah di kiri */
    .fi-sidebar-item-btn {
        border-radius: 0.5rem !important;
    }

    html:not(.dark) .fi-sidebar-item.fi-active .fi-sidebar-item-btn {
        background: var(--brand-tint) !important;
        box-shadow: inset 3px 0 0 var(--brand) !important;
    }

    html:not(.dark) .fi-sidebar-item.fi-active .fi-sidebar-item-btn * {
        color: var(--brand) !important;
        font-weight: 600;
    }

    .fi-sidebar-group-label {
        font-size: 0.7rem !important;
        letter-spacing: 0.05em !important;
        text-transform: uppercase !important;
        font-weight: 600 !important;
    }

    /* 3. Kartu statistik */
    .fi-wi-stats-overview-stat-value {
        font-weight: 600 !important;
        font-size: 1.6rem !important;
        letter-spacing: 0 !important;
    }

    /* 4. Header dashboard: blok merah polos */
    .fi-dashboard-banner {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        padding: 1.5rem;
        border-radius: 0.625rem;
        background: var(--brand);
        color: #ffffff;
    }

    @media (min-width: 1024px) {
        .fi-dashboard-banner {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    .fi-dashboard-banner-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        line-height: 1.25;
        color: #ffffff;
    }

    .fi-dashboard-banner-desc {
        margin: 0.25rem 0 0;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .fi-dashboard-banner-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem 1.5rem;
        margin: 1rem 0 0;
        padding: 0;
        list-style: none;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .fi-dashboard-banner-stats strong {
        font-weight: 600;
        color: #ffffff;
    }

    .fi-dashboard-banner-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .fi-dash-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none !important;
        border: 1px solid transparent;
    }

    .fi-dash-btn svg {
        width: 1rem;
        height: 1rem;
    }

    .fi-dash-btn-primary {
        background: #ffffff;
        color: var(--brand) !important;
    }

    .fi-dash-btn-primary:hover {
        background: var(--brand-tint);
    }

    .fi-dash-btn-secondary,
    .fi-dash-btn-glass {
        background: transparent;
        border-color: rgba(255, 255, 255, 0.55);
        color: #ffffff !important;
    }

    .fi-dash-btn-secondary:hover,
    .fi-dash-btn-glass:hover {
        background: rgba(255, 255, 255, 0.12);
    }

    /* 5. Menu terlaris */
    .fi-top-products-list {
        display: flex;
        flex-direction: column;
    }

    .fi-top-product-card {
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--line);
    }

    .fi-top-product-card:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .fi-top-product-card:first-child {
        padding-top: 0;
    }

    .dark .fi-top-product-card {
        border-bottom-color: rgba(255, 255, 255, 0.08);
    }

    .fi-top-product-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .fi-top-product-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 0;
    }

    .fi-top-rank-badge {
        width: 1.5rem;
        flex-shrink: 0;
        font-size: 0.85rem;
        font-weight: 600;
        color: #9ca3af;
        text-align: center;
    }

    .fi-top-rank-badge.fi-rank-1 {
        color: var(--brand);
    }

    .fi-top-product-name {
        margin: 0;
        font-size: 0.875rem;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .fi-top-product-sales {
        display: block;
        font-size: 0.75rem;
        color: #6b7280;
    }

    .fi-top-qty-pill {
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
        color: #111827;
    }

    .dark .fi-top-qty-pill {
        color: #f3f4f6;
    }

    .fi-top-progress-track {
        height: 0.25rem;
        margin-top: 0.6rem;
        border-radius: 9999px;
        background: #f3f4f6;
        overflow: hidden;
    }

    .dark .fi-top-progress-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .fi-top-progress-fill {
        height: 100%;
        border-radius: 9999px;
        background: var(--brand);
    }

    .fi-top-empty-state {
        padding: 2rem 1rem;
        text-align: center;
    }

    .fi-top-empty-title {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .fi-top-empty-desc {
        margin: 0.25rem 0 0;
        font-size: 0.75rem;
        color: #6b7280;
    }

    /* 6. Halaman login */
    html:not(.dark) .fi-simple-layout {
        background-color: #f9fafb !important;
    }

    .fi-simple-main {
        border-radius: 0.625rem !important;
        border: 1px solid var(--line) !important;
        box-shadow: none !important;
    }

    .fi-simple-header-heading {
        font-weight: 600 !important;
        font-size: 1.5rem !important;
    }
</style>
