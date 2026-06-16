<style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

    .navbar {
        background: #003366;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 50px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo { font-size: 22px; font-weight: bold; color: white; text-decoration: none; }

    .nav-links { display: flex; list-style: none; align-items: center; gap: 5px; }
    .nav-links li { position: relative; }
    .nav-links a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 5px;
        transition: color 0.2s, background 0.2s;
        display: block;
    }
    .nav-links a:hover { color: #ffd700; background: rgba(255,255,255,0.08); }
    .nav-links a.active-link { color: #ffd700; }

    /* Dropdown */
    .dropdown-menu-custom {
        display: none;
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        background: #002244;
        list-style: none;
        border-radius: 8px;
        width: 200px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        overflow: hidden;
        z-index: 999;
    }
    .dropdown:hover .dropdown-menu-custom { display: block; }
    .dropdown-menu-custom li a {
        padding: 10px 18px;
        border-radius: 0;
        font-size: 0.9rem;
        color: #e0e8ff;
    }
    .dropdown-menu-custom li a:hover { background: #003880; color: #ffd700; }

    /* Login Button */
    .login-btn {
        background: #ffd700;
        color: #003366;
        padding: 9px 22px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        transition: background 0.2s, transform 0.1s;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .login-btn:hover { background: #e6c200; transform: scale(1.03); }

    /* Hamburger */
    .menu-toggle {
        display: none;
        flex-direction: column;
        cursor: pointer;
        gap: 5px;
        padding: 4px;
    }
    .menu-toggle span {
        width: 25px;
        height: 3px;
        background: white;
        border-radius: 3px;
        transition: all 0.3s;
        display: block;
    }

    /* ===== MOBILE ===== */
    @media (max-width: 950px) {
        .navbar { padding: 15px 20px; }

        .menu-toggle { display: flex; }

        .nav-links {
            display: none;
            flex-direction: column;
            width: 100%;
            position: absolute;
            top: 60px;
            left: 0;
            background: #003366;
            padding: 16px 0;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            gap: 0;
        }
        .nav-links.active { display: flex; }

        .nav-links li { width: 100%; }
        .nav-links a { padding: 12px 20px; border-radius: 0; }

        /* Dropdown mobile */
        .dropdown-menu-custom {
            position: static;
            background: #002244;
            width: 100%;
            border-radius: 0;
            box-shadow: none;
            display: none;
        }
        .dropdown.open .dropdown-menu-custom { display: block; }
        .dropdown-menu-custom li a { padding: 10px 30px; font-size: 0.88rem; }

        .login-btn { display: none; }
        .login-btn-mobile {
            display: block;
            text-align: center;
            margin: 12px 20px 4px;
            padding: 10px;
            border-radius: 6px;
        }
    }

    @media (min-width: 951px) {
        .login-btn-mobile { display: none; }
    }
</style>

<nav class="navbar">
    <a href="/" class="logo">✝ GKS Padadita</a>

    {{-- Hamburger --}}
    <div class="menu-toggle" id="menuToggle" onclick="toggleMenu()">
        <span></span><span></span><span></span>
    </div>

    <ul class="nav-links" id="navLinks">

        <li>
            <a href="/"
               class="">
                Beranda
            </a>
        </li>

        <li class="dropdown" id="dropdownJadwal">
            <a onclick="toggleDropdown(event, 'dropdownJadwal')"
               class=""
               style="cursor:pointer;">
                Jadwal ▾
            </a>
            <ul class="dropdown-menu-custom">
                <li>
                    <a href="jadwal_ibadah">
                        📅 Jadwal Ibadah
                    </a>
                </li>
                <li>
                    <a href="jadwal-pa">
                        📖 Jadwal PA
                    </a>
                </li>
                <li>
                    <a href="kegiatan">
                        🗓️ Jadwal Kegiatan
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="warta-mimbar"
               class="">
                Warta Mimbar
            </a>
        </li>

        <li>
            <a href="pendaftaran-katekesasi"
               class="">
                Pendaftaran Katekesasi
            </a>
        </li>

        {{-- Login khusus mobile --}}

    </ul>

    <a href="{{ route('login') }}" class="login-btn">Login</a>
</nav>

<script>
    function toggleMenu() {
        const nav    = document.getElementById('navLinks');
        const toggle = document.getElementById('menuToggle');
        nav.classList.toggle('active');
        toggle.classList.toggle('open');
    }

    function toggleDropdown(e, id) {
        if (window.innerWidth <= 950) {
            e.preventDefault();
            document.getElementById(id).classList.toggle('open');
        }
    }

    // Tutup menu saat klik di luar
    document.addEventListener('click', function(e) {
        const nav    = document.getElementById('navLinks');
        const toggle = document.getElementById('menuToggle');
        if (!nav.contains(e.target) && !toggle.contains(e.target)) {
            nav.classList.remove('active');
            toggle.classList.remove('open');
        }
    });
</script>