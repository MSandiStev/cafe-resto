<style>
    /* ===== Umum ===== */
    html:not(.dark) .fi-body { background-color: #fffaf7; }

    .fi-section,
    .fi-wi-stats-overview-stat,
    .fi-ta-ctn { border-radius: 1rem; }

    .fi-wi-stats-overview-stat-value { font-weight: 700; letter-spacing: -0.01em; }

    .fi-sidebar-item-btn { border-radius: 0.75rem; }

    .fi-sidebar-group-label {
        font-size: 0.7rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    /* ===== Halaman login ===== */
    html:not(.dark) .fi-simple-layout { background-color: #fffaf7; }

    .fi-simple-main { border-radius: 1rem; }

    .fi-simple-header-heading { font-weight: 700; letter-spacing: -0.01em; }

    .fi-login-brand { display: none; }

    @media (min-width: 1024px) {
        .fi-simple-layout:has(.fi-login-brand) {
            display: grid;
            grid-template-columns: minmax(0, 5fr) minmax(0, 6fr);
            min-height: 100vh;
        }

        .fi-simple-layout:has(.fi-login-brand) .fi-simple-main-ctn { align-self: center; }

        .fi-login-brand {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            padding: 3rem 3.5rem;
            background-color: #c81e1e;
            color: #ffffff;
        }
    }

    .fi-login-brand-kicker {
        margin: 0;
        font-size: 0.75rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        opacity: 0.8;
    }

    .fi-login-brand-name {
        margin: 0.75rem 0 0;
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .fi-login-brand-tagline {
        margin: 0;
        max-width: 26rem;
        font-size: 1.05rem;
        line-height: 1.6;
    }

    .fi-login-brand-list {
        margin: 1.5rem 0 0;
        padding: 0;
        list-style: none;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    .fi-login-brand-list li {
        padding: 0.75rem 0;
        font-size: 0.9rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* ===== Widget menu terlaris ===== */
    .cafe-top-row { margin-bottom: 1rem; }
    .cafe-top-row:last-child { margin-bottom: 0; }

    .cafe-top-head {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
    }

    .cafe-top-rank {
        display: inline-flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 9999px;
        background-color: #fee2e2;
        color: #a31515;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .cafe-top-name { flex: 1; font-weight: 500; }
    .cafe-top-qty { font-weight: 600; color: #c81e1e; }

    .cafe-top-bar {
        height: 0.375rem;
        margin-top: 0.5rem;
        margin-left: 2.25rem;
        border-radius: 9999px;
        background-color: #f3f4f6;
    }

    .cafe-top-bar span {
        display: block;
        height: 100%;
        border-radius: 9999px;
        background-color: #c81e1e;
    }

    .cafe-top-empty { margin: 0; font-size: 0.875rem; opacity: 0.7; }

    .dark .cafe-top-rank { background-color: rgba(220, 38, 38, 0.25); color: #fecaca; }
    .dark .cafe-top-qty { color: #f87171; }
    .dark .cafe-top-bar { background-color: rgba(255, 255, 255, 0.1); }
</style>
