@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<style>
    /* ===== HEADER ===== */
    .header-gradient {
        background: #1a2744;
        border-radius: 14px;
        padding: 28px 32px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .header-gradient::before {
        content: '✝';
        position: absolute;
        right: 32px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 80px;
        color: rgba(200,169,110,0.12);
        line-height: 1;
        pointer-events: none;
    }
    .header-gradient h2 {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 6px;
    }
    .header-gradient h2 span {
        color: #c8a96e;
    }
    .header-gradient p {
        color: rgba(255,255,255,0.55);
        font-size: 13.5px;
        margin: 0;
        max-width: 520px;
    }

    /* ===== SECTION TITLE ===== */
    .section-title {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: #888;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    /* ===== GRID ===== */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 14px;
    }

    /* ===== CARDS ===== */
    .card-link {
        text-decoration: none;
    }
    .card-link:hover {
        text-decoration: none;
    }
    .card.card-stat {
        border: 1px solid #eef0f4;
        border-radius: 12px;
        transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
        overflow: hidden;
        position: relative;
    }
    .card.card-stat::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: transparent;
        transition: background 0.18s ease;
        border-radius: 0 0 12px 12px;
    }
    .card-link:hover .card.card-stat {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.10) !important;
        border-color: #dde1ea;
    }
    .card-link:hover .card.card-stat.accent-purple::after { background: #7c3aed; }
    .card-link:hover .card.card-stat.accent-blue::after   { background: #2563eb; }
    .card-link:hover .card.card-stat.accent-green::after  { background: #16a34a; }
    .card-link:hover .card.card-stat.accent-amber::after  { background: #d97706; }
    .card-link:hover .card.card-stat.accent-teal::after   { background: #0891b2; }
    .card-link:hover .card.card-stat.accent-gold::after   { background: #c8a96e; }

    .card.card-stat .card-body {
        padding: 18px 18px !important;
    }
    .card.card-stat h6 {
        font-size: 14px;
        font-weight: 600;
        color: #1a2744;
        margin-bottom: 4px;
    }
    .card.card-stat small {
        font-size: 12px;
        color: #9ca3af;
    }

    /* ===== ICON BOXES ===== */
    .icon-box {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .bg-purple-light  { background: #ede9fe; color: #7c3aed; }
    .bg-info-light    { background: #e0f2fe; color: #0284c7; }
    .bg-success-light { background: #dcfce7; color: #16a34a; }
    .bg-warning-light { background: #fef3c7; color: #d97706; }
    .bg-teal-light    { background: #ccfbf1; color: #0f766e; }
    .bg-gold-light    { background: #fef9ee; color: #c8a96e; }
</style>

<div class="header-gradient">
    <h2 class="fw-bold mb-1">Shalom, <span>{{ Auth::user()->nama }}</span>!</h2>
    <p class="mb-0">Sistem siap digunakan. Semua fungsi pengelolaan sudah disesuaikan dengan hak akses Administrator.</p>
</div>

<div class="section-title">Akses Cepat Pengelolaan</div>

<div class="dashboard-grid">

    <a href="{{ route('jemaat.index') }}" class="card-link">
        <div class="card card-stat accent-purple">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Data Jemaat</h6>
                    <small>Kelola data kependudukan</small>
                </div>
                <div class="icon-box bg-purple-light"><i class="bi bi-people-fill"></i></div>
            </div>
        </div>
    </a>

    <a href="{{ route('ibadah.index') }}" class="card-link">
        <div class="card card-stat accent-blue">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Jadwal Ibadah</h6>
                    <small>Atur sesi & jam ibadah</small>
                </div>
                <div class="icon-box bg-info-light"><i class="bi bi-calendar3"></i></div>
            </div>
        </div>
    </a>

    <a href="{{ route('pelayan.index') }}" class="card-link">
        <div class="card card-stat accent-green">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Jadwal Pelayanan</h6>
                    <small>Petugas & majelis</small>
                </div>
                <div class="icon-box bg-success-light"><i class="bi bi-person-workspace"></i></div>
            </div>
        </div>
    </a>

    <a href="{{ route('pendaftaran_katekesasi.index') }}" class="card-link">
        <div class="card card-stat accent-amber">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Katekesasi</h6>
                    <small>Calon peserta sidi</small>
                </div>
                <div class="icon-box bg-warning-light"><i class="bi bi-journal-check"></i></div>
            </div>
        </div>
    </a>

    <a href="{{ route('jadwal-kegiatan.index') }}" class="card-link">
        <div class="card card-stat accent-teal">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Jadwal Kegiatan</h6>
                    <small>Agenda & event gereja</small>
                </div>
                <div class="icon-box bg-teal-light"><i class="bi bi-calendar-event"></i></div>
            </div>
        </div>
    </a>

    <a href="{{ route('jadwal_pa.index') }}" class="card-link">
        <div class="card card-stat accent-purple">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Jadwal PA</h6>
                    <small>Pendalaman Alkitab</small>
                </div>
                <div class="icon-box bg-purple-light"><i class="bi bi-book-half"></i></div>
            </div>
        </div>
    </a>

    <a href="{{ route('warta.index') }}" class="card-link">
        <div class="card card-stat accent-gold">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Warta Mimbar</h6>
                    <small>Informasi jemaat</small>
                </div>
                <div class="icon-box bg-gold-light"><i class="bi bi-megaphone-fill"></i></div>
            </div>
        </div>
    </a>

</div>

@endsection