<style>
    /* ===== SIDEBAR OVERLAY ===== */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 999;
    }
    .sidebar-overlay.show {
        display: block;
    }

    /* ===== SIDEBAR CONTAINER ===== */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 245px;
        height: 100vh;
        background: #1a2744;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        transition: transform 0.25s ease;
    }

    /* ===== BRAND ===== */
    .sidebar-brand {
        padding: 20px 18px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 0.5px solid rgba(255,255,255,0.08);
        text-decoration: none;
    }
    .brand-icon {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.08);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #c8a96e;
        flex-shrink: 0;
    }
    .brand-text-name {
        font-weight: 700;
        font-size: 13px;
        color: #ffffff;
        line-height: 1.3;
    }
    .brand-text-sub {
        font-size: 10.5px;
        color: rgba(255,255,255,0.4);
        margin-top: 1px;
    }

    /* ===== SCROLL AREA ===== */
    .sidebar-scroll {
        flex: 1;
        overflow-y: auto;
        padding: 8px 0 8px;
    }
    .sidebar-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.1);
        border-radius: 4px;
    }

    /* ===== SECTION HEADER ===== */
    .sidebar-menu-header {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.28);
        padding: 16px 18px 5px;
    }

    /* ===== NAV LINKS ===== */
    .sidebar .nav-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 18px;
        font-size: 13px;
        color: rgba(255,255,255,0.62);
        border-left: 3px solid transparent;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
        margin: 1px 0;
        border-radius: 0;
    }
    .sidebar .nav-link:hover {
        background: rgba(255,255,255,0.07);
        color: #ffffff;
        text-decoration: none;
    }
    .sidebar .nav-link.active {
        background: rgba(200,169,110,0.15);
        color: #c8a96e;
        border-left-color: #c8a96e;
    }
    .sidebar .nav-link i {
        font-size: 16px;
        width: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    /* ===== FOOTER ===== */
    .sidebar-footer {
        padding: 10px 18px 14px;
        border-top: 0.5px solid rgba(255,255,255,0.08);
    }
    .sidebar-footer .nav-link {
        color: rgba(255,255,255,0.4);
        border-left: 3px solid transparent;
        padding: 9px 0;
    }
    .sidebar-footer .nav-link:hover {
        background: transparent;
        color: #f87171;
    }
</style>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="sidebar" id="sidebarNav">

    <a class="sidebar-brand" href="/dashboard">
        <div class="brand-icon">✝</div>
        <div>
            <div class="brand-text-name">GKS Padadita</div>
            <div class="brand-text-sub">Sistem Informasi Gereja</div>
        </div>
    </a>

    <div class="sidebar-scroll">
        <div class="sidebar-menu-header">Menu Utama</div>
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
            <i class="bi bi-speedometer2"></i> Beranda Utama
        </a>
        <a class="nav-link {{ request()->routeIs('jemaat.*') ? 'active' : '' }}" href="{{ route('jemaat.index') }}">
            <i class="bi bi-people-fill"></i> Data Jemaat
        </a>

        <div class="sidebar-menu-header">Data Pelayan</div>
        <a class="nav-link {{ request()->routeIs('pelayan.*') ? 'active' : '' }}" href="{{ route('pelayan.index') }}">
            <i class="bi bi-person-badge"></i> Data Pelayan
        </a>
        <a class="nav-link {{ request()->routeIs('pendaftaran_katekesasi.*') ? 'active' : '' }}" href="{{ route('pendaftaran_katekesasi.index') }}">
            <i class="bi bi-mortarboard-fill"></i> Pendaftaran Katekesasi
        </a>

        <div class="sidebar-menu-header">Agenda & Kegiatan</div>
        <a class="nav-link {{ request()->routeIs('ibadah.*') ? 'active' : '' }}" href="{{ route('ibadah.index') }}">
            <i class="bi bi-calendar3"></i> Jadwal Ibadah
        </a>
        <a class="nav-link {{ request()->routeIs('jadwal_pa.*') ? 'active' : '' }}" href="{{ route('jadwal_pa.index') }}">
            <i class="bi bi-book-half"></i> Jadwal PA Sektor
        </a>
        <a class="nav-link {{ request()->routeIs('jadwal-kegiatan.*') ? 'active' : '' }}" href="{{ route('jadwal-kegiatan.index') }}">
            <i class="bi bi-calendar-event"></i> Jadwal Kegiatan
        </a>
        <a class="nav-link {{ request()->routeIs('warta.*') ? 'active' : '' }}" href="{{ route('warta.index') }}">
            <i class="bi bi-megaphone-fill"></i> Warta Mimbar
        </a>
    </div>

    <div class="sidebar-footer">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

</div>