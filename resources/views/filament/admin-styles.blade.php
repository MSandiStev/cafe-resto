<style>
    /* ==========================================================================
       1. GLOBAL & SHELL THEME
       ========================================================================== */
    html:not(.dark) .fi-body {
        background-color: #faf6f2 !important;
        font-family: 'Poppins', system-ui, -apple-system, sans-serif;
    }

    /* Modern Card & Section Containers */
    .fi-section,
    .fi-wi-stats-overview-stat,
    .fi-ta-ctn {
        border-radius: 1.25rem !important;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        box-shadow: 0 4px 20px -2px rgba(40, 10, 10, 0.03), 0 2px 6px -1px rgba(0, 0, 0, 0.02) !important;
        transition: all 0.2s ease-in-out;
    }

    .dark .fi-section,
    .dark .fi-wi-stats-overview-stat,
    .dark .fi-ta-ctn {
        border-color: rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.4) !important;
    }

    /* Top Navigation Bar Glassmorphism */
    .fi-topbar {
        backdrop-filter: blur(12px) !important;
        background-color: rgba(255, 255, 255, 0.88) !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06) !important;
    }

    .dark .fi-topbar {
        background-color: rgba(24, 24, 27, 0.88) !important;
        border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }

    /* Sidebar Refinement */
    .fi-sidebar-item-btn {
        border-radius: 0.75rem !important;
        font-weight: 500 !important;
        transition: all 0.15s ease-in-out !important;
    }

    .fi-sidebar-item.fi-active .fi-sidebar-item-btn {
        background: linear-gradient(135deg, #c81e1e 0%, #991b1b 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(200, 30, 30, 0.25) !important;
    }

    .fi-sidebar-group-label {
        font-size: 0.68rem !important;
        letter-spacing: 0.08em !important;
        text-transform: uppercase !important;
        font-weight: 700 !important;
        opacity: 0.65;
    }

    /* ==========================================================================
       2. DASHBOARD BANNER COMPONENT
       ========================================================================== */
    .fi-dashboard-banner {
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
        background: linear-gradient(135deg, #180707 0%, #2f0b0b 50%, #450c0c 100%);
        padding: 2rem 2.25rem;
        color: #ffffff;
        box-shadow: 0 20px 40px -15px rgba(40, 10, 10, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
    }

    @media (min-width: 1024px) {
        .fi-dashboard-banner {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    .fi-dashboard-banner::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 240px;
        height: 240px;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.2) 0%, transparent 70%);
        pointer-events: none;
    }

    .fi-dashboard-banner-content {
        position: relative;
        z-index: 1;
        max-width: 42rem;
    }

    .fi-dashboard-banner-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.85rem;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #fef3c7;
        backdrop-filter: blur(8px);
        margin-bottom: 0.75rem;
    }

    .fi-dashboard-banner-pulse {
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 9999px;
        background-color: #10b981;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulseDot 2s infinite;
    }

    @keyframes pulseDot {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    .fi-dashboard-banner-title {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.02em;
        color: #ffffff;
        margin: 0;
    }

    .fi-dashboard-banner-desc {
        margin: 0.5rem 0 0;
        font-size: 0.875rem;
        line-height: 1.5;
        color: rgba(255, 255, 255, 0.8);
    }

    .fi-dashboard-banner-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-top: 1.25rem;
    }

    .fi-dashboard-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.4rem 0.85rem;
        border-radius: 0.75rem;
        font-size: 0.75rem;
        font-weight: 500;
        backdrop-filter: blur(8px);
    }

    .fi-chip-warning {
        background: rgba(245, 158, 11, 0.16);
        border: 1px solid rgba(245, 158, 11, 0.35);
        color: #fef3c7;
    }

    .fi-chip-info {
        background: rgba(14, 165, 233, 0.16);
        border: 1px solid rgba(14, 165, 233, 0.35);
        color: #e0f2fe;
    }

    .fi-chip-success {
        background: rgba(16, 185, 129, 0.16);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #d1fae5;
    }

    .fi-chip-neutral {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #f3f4f6;
    }

    .fi-dashboard-banner-actions {
        position: relative;
        z-index: 1;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .fi-dash-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.65rem 1.15rem;
        border-radius: 0.85rem;
        font-size: 0.825rem;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.2s ease-in-out;
    }

    .fi-dash-btn-primary {
        background: linear-gradient(135deg, #c81e1e 0%, #991b1b 100%);
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(200, 30, 30, 0.35);
    }

    .fi-dash-btn-primary:hover {
        background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(200, 30, 30, 0.45);
    }

    .fi-dash-btn-secondary {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.22);
        color: #ffffff !important;
        backdrop-filter: blur(8px);
    }

    .fi-dash-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
    }

    .fi-dash-btn-glass {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #f3f4f6 !important;
        backdrop-filter: blur(8px);
    }

    .fi-dash-btn-glass:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* ==========================================================================
       3. STATS OVERVIEW CARDS
       ========================================================================== */
    .fi-wi-stats-overview-stat {
        position: relative;
        overflow: hidden;
        border-radius: 1.25rem !important;
    }

    .fi-wi-stats-overview-stat:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(200, 30, 30, 0.08) !important;
    }

    .fi-wi-stats-overview-stat-value {
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
        font-size: 1.85rem !important;
    }

    /* ==========================================================================
       4. TOP PRODUCTS WIDGET
       ========================================================================== */
    .fi-top-products-list {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .fi-top-product-card {
        padding: 0.75rem 0.85rem;
        border-radius: 0.9rem;
        background: rgba(0, 0, 0, 0.015);
        border: 1px solid rgba(0, 0, 0, 0.04);
        transition: all 0.15s ease-in-out;
    }

    .fi-top-product-card:hover {
        background: rgba(200, 30, 30, 0.03);
        border-color: rgba(200, 30, 30, 0.12);
    }

    .dark .fi-top-product-card {
        background: rgba(255, 255, 255, 0.03);
        border-color: rgba(255, 255, 255, 0.06);
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 0.65rem;
        font-size: 0.75rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .fi-rank-1 {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
        box-shadow: 0 3px 10px rgba(245, 158, 11, 0.35);
    }

    .fi-rank-2 {
        background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
        color: #ffffff;
        box-shadow: 0 3px 10px rgba(100, 116, 139, 0.25);
    }

    .fi-rank-3 {
        background: linear-gradient(135deg, #b45309 0%, #78350f 100%);
        color: #ffffff;
        box-shadow: 0 3px 10px rgba(180, 83, 9, 0.25);
    }

    .fi-top-rank-badge:not(.fi-rank-1):not(.fi-rank-2):not(.fi-rank-3) {
        background: #f3f4f6;
        color: #6b7280;
    }

    .dark .fi-top-rank-badge:not(.fi-rank-1):not(.fi-rank-2):not(.fi-rank-3) {
        background: rgba(255, 255, 255, 0.1);
        color: #9ca3af;
    }

    .fi-top-product-info {
        min-width: 0;
    }

    .fi-top-product-name {
        margin: 0;
        font-size: 0.875rem;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .fi-top-product-sales {
        display: block;
        font-size: 0.72rem;
        color: #6b7280;
    }

    .dark .fi-top-product-sales {
        color: #9ca3af;
    }

    .fi-top-qty-pill {
        display: inline-block;
        padding: 0.25rem 0.6rem;
        border-radius: 9999px;
        background: #fee2e2;
        color: #991b1b;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .dark .fi-top-qty-pill {
        background: rgba(220, 38, 38, 0.25);
        color: #fca5a5;
    }

    .fi-top-progress-track {
        height: 0.35rem;
        border-radius: 9999px;
        background-color: #f3f4f6;
        margin-top: 0.65rem;
        overflow: hidden;
    }

    .dark .fi-top-progress-track {
        background-color: rgba(255, 255, 255, 0.08);
    }

    .fi-top-progress-fill {
        height: 100%;
        border-radius: 9999px;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fi-fill-1 {
        background: linear-gradient(90deg, #f59e0b, #ef4444);
    }

    .fi-fill-2 {
        background: linear-gradient(90deg, #64748b, #ef4444);
    }

    .fi-fill-3 {
        background: linear-gradient(90deg, #b45309, #ef4444);
    }

    .fi-top-progress-fill:not(.fi-fill-1):not(.fi-fill-2):not(.fi-fill-3) {
        background: #ef4444;
    }

    .fi-top-empty-state {
        text-align: center;
        padding: 2.5rem 1rem;
    }

    .fi-top-empty-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .fi-top-empty-title {
        font-weight: 600;
        font-size: 0.9rem;
        margin: 0;
    }

    .fi-top-empty-desc {
        font-size: 0.75rem;
        color: #6b7280;
        margin: 0.25rem 0 0;
    }

    /* ==========================================================================
       5. ADMIN LOGIN PAGE (SPLIT SCREEN PORTAL)
       ========================================================================== */
    html:not(.dark) .fi-simple-layout {
        background-color: #faf6f2 !important;
    }

    .fi-simple-main {
        border-radius: 1.5rem !important;
        box-shadow: 0 20px 50px -15px rgba(40, 10, 10, 0.08) !important;
        border: 1px solid rgba(0, 0, 0, 0.06) !important;
    }

    .fi-simple-header-heading {
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
        font-size: 1.75rem !important;
    }

    .fi-login-brand {
        display: none;
    }

    @media (min-width: 1024px) {
        .fi-simple-layout:has(.fi-login-brand) {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 6fr);
            min-height: 100vh;
        }

        .fi-simple-layout:has(.fi-login-brand) .fi-simple-main-ctn {
            align-self: center;
            padding: 3rem 2rem;
        }

        .fi-login-brand {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            padding: 3.5rem;
            background: linear-gradient(145deg, #160606 0%, #2e0909 50%, #450c0c 100%);
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .fi-login-brand::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 320px;
            height: 320px;
            border-radius: 9999px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }
    }

    .fi-login-brand-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        z-index: 1;
    }

    .fi-login-brand-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 0.95rem;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.75rem;
        font-weight: 500;
        text-decoration: none !important;
        transition: all 0.15s ease-in-out;
    }

    .fi-login-brand-back:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
    }

    .fi-login-brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.35rem 0.8rem;
        border-radius: 9999px;
        background: rgba(16, 185, 129, 0.15);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #a7f3d0;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .fi-login-brand-dot {
        width: 0.45rem;
        height: 0.45rem;
        border-radius: 9999px;
        background-color: #10b981;
    }

    .fi-login-brand-center {
        position: relative;
        z-index: 1;
        margin: auto 0;
        padding: 2rem 0;
    }

    .fi-login-brand-logo-wrap {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .fi-login-brand-icon {
        width: 3.5rem;
        height: 3.5rem;
        color: #f59e0b;
        flex-shrink: 0;
    }

    .fi-login-brand-kicker {
        margin: 0;
        font-size: 0.72rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #fde68a;
        font-weight: 700;
    }

    .fi-login-brand-name {
        margin: 0.2rem 0 0;
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.02em;
        color: #ffffff;
    }

    .fi-login-brand-tagline {
        margin: 0;
        max-width: 28rem;
        font-size: 0.95rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.85);
    }

    .fi-login-brand-features {
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .fi-login-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 0.9rem;
        padding: 0.85rem 1rem;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
    }

    .fi-login-feature-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.65rem;
        background: rgba(245, 158, 11, 0.2);
        color: #fde68a;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .fi-login-feature-icon svg {
        width: 1.15rem;
        height: 1.15rem;
    }

    .fi-login-feature-title {
        display: block;
        font-size: 0.825rem;
        font-weight: 700;
        color: #ffffff;
    }

    .fi-login-feature-desc {
        display: block;
        font-size: 0.72rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 0.15rem;
    }

    .fi-login-brand-footer {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.72rem;
        color: rgba(255, 255, 255, 0.55);
    }
</style>
