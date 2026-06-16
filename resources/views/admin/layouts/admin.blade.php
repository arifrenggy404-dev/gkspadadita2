<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem Informasi Gereja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        * { box-sizing: border-box; }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        /* ===== WRAPPER ===== */
        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background-color: #ffffff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.06);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1040;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 20px 16px 16px;
            border-bottom: 1px solid #f1f1f1;
            flex-shrink: 0;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background-color: #f3f0fa;
            color: #6f42c1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
            margin-right: 10px;
        }

        .sidebar-menu-header {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            font-weight: 700;
            color: #b0bec5;
            padding: 14px 20px 4px;
        }

        .sidebar .nav-link {
            color: #6c757d;
            padding: 9px 16px;
            border-radius: 8px;
            margin: 2px 10px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            font-size: 0.88rem;
            text-decoration: none;
        }

        .sidebar .nav-link i {
            font-size: 1rem;
            margin-right: 10px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #f3f0fa;
            color: #6f42c1;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 12px 10px;
            border-top: 1px solid #f1f1f1;
            flex-shrink: 0;
        }

        .sidebar-footer .nav-link { color: #e53e3e !important; }
        .sidebar-footer .nav-link:hover {
            background-color: #fff5f5 !important;
            color: #c53030 !important;
        }

        /* ===== OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1030;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.show { display: block; }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex-grow: 1;
            margin-left: 240px;
            padding: 24px;
            min-height: 100vh;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* ===== TOPBAR (mobile) ===== */
        .topbar {
            display: none;
            align-items: center;
            background: #ffffff;
            padding: 12px 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 900;
            margin: -24px -24px 20px -24px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 767.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }
            .sidebar.show { transform: translateX(0); }

            .main-content {
                margin-left: 0;
                padding: 16px;
            }

            .topbar { display: flex; }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
        }

        /* ===== HEADER GRADIENT ===== */
        .header-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        @media (max-width: 767.98px) {
            .header-gradient { padding: 18px; border-radius: 10px; }
            .header-gradient h2 { font-size: 1.2rem; }
        }

        /* ===== DASHBOARD GRID ===== */
        .dashboard-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(3, 1fr);
        }

        @media (max-width: 991.98px) {
            .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 480px) {
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        /* ===== CARD ===== */
        .card-stat {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        .icon-box {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .bg-purple-light { background-color: #f3f0fa; color: #6f42c1; }
        .bg-success-light { background-color: #e8f5e9; color: #2e7d32; }
        .bg-warning-light { background-color: #fff8e1; color: #f57f17; }
        .bg-info-light    { background-color: #e0f7fa; color: #00838f; }

        .card-link { text-decoration: none; display: block; }

        @yield('styles')
    </style>
</head>
<body>

@include('admin.nav')

<div class="wrapper">
    <main class="main-content">

        {{-- Topbar mobile --}}
        <div class="topbar">
            <button class="btn btn-sm btn-outline-secondary me-3"
                    onclick="toggleSidebar()" aria-label="Buka menu">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div class="brand-icon me-2"
                 style="width:32px;height:32px;font-size:0.9rem;flex-shrink:0;">
                <i class="bi bi-church"></i>
            </div>
            <div>
                <div style="font-weight:700;font-size:0.9rem;color:#2d3748;">Sistem Gereja</div>
                <div style="font-size:0.72rem;color:#a0aec0;">Panel Admin</div>
            </div>
        </div>

        @yield('content')

    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar  = document.getElementById('sidebarNav');
        const overlay  = document.getElementById('sidebarOverlay');
        const isOpen   = sidebar.classList.toggle('show');
        overlay.classList.toggle('show', isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
    }

    // Tutup sidebar saat klik link di mobile
    document.querySelectorAll('.sidebar .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) toggleSidebar();
        });
    });
</script>
@yield('scripts')
</body>
</html>