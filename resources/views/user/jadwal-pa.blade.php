@extends('public.layouts.app')

@section('title', 'Jadwal PA')

@section('styles')
<style>
    .hero-pa {
        background: linear-gradient(135deg, #1a0533 0%, #4a1080 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
    }
    .hero-pa h1 { font-size: 2.2rem; font-weight: 800; margin-bottom: 10px; }
    .hero-pa p  { font-size: 1rem; opacity: 0.8; margin: 0; }

    /* Card */
    .pa-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 100%;
    }
    .pa-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(74,16,128,0.15) !important;
    }

    .pa-card-header {
        background: linear-gradient(135deg, #1a0533 0%, #4a1080 100%);
        padding: 20px 22px 16px;
    }

    .nama-badge {
        background: rgba(255,255,255,0.18);
        color: #fff;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 600;
        border: 1px solid rgba(255,255,255,0.3);
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .icon-pa {
        width: 38px;
        height: 38px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 12px;
    }
    .info-row:last-child { margin-bottom: 0; }

    .info-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .info-label {
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #adb5bd;
        display: block;
        margin-bottom: 1px;
    }
    .info-value {
        font-size: 0.88rem;
        font-weight: 600;
        color: #2d3748;
    }

    .ayat-box {
        background: #f3f0fa;
        border-left: 3px solid #6f42c1;
        border-radius: 0 8px 8px 0;
        padding: 10px 14px;
        margin: 12px 0;
    }
    .ayat-box small { font-size: 0.7rem; color: #6f42c1; font-weight: 700; text-transform: uppercase; }
    .ayat-box p { font-size: 0.88rem; color: #4a1080; font-weight: 600; margin: 2px 0 0; }

    .pelayan-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-top: 1px solid #f1f3f5;
    }
    .avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #4a1080;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.78rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* Countdown badge */
    .countdown-wrap { padding: 12px 16px 16px; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #adb5bd;
    }
    .empty-state i { font-size: 4rem; display: block; margin-bottom: 16px; }

    /* Pagination */
    .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 2px;
        color: #4a1080;
        border-color: #dee2e6;
    }
    .pagination .page-item.active .page-link {
        background-color: #4a1080;
        border-color: #4a1080;
    }

    @media (max-width: 575.98px) {
        .hero-pa h1   { font-size: 1.6rem; }
        .hero-pa      { padding: 40px 16px; }
    }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="hero-pa">
    <div class="container">
        <h1>📖 Jadwal Pendalaman Alkitab</h1>
        <p>Jadwal kunjungan dan pelaksanaan PA jemaat GKS Padadita</p>
    </div>
</section>

{{-- Konten --}}
<section class="py-5 bg-light">
    <div class="container">

        @if($jadwalPa->isEmpty())
        <div class="empty-state">
            <i class="bi bi-book text-secondary"></i>
            <h5>Belum ada jadwal PA yang tersedia.</h5>
            <p class="small">Silakan cek kembali nanti.</p>
        </div>
        @else

        <div class="row g-4">
            @foreach($jadwalPa as $item)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card pa-card shadow-sm">

                    {{-- Header --}}
                    <div class="pa-card-header">
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <span class="nama-badge">{{ $item->nama }}</span>
                            <div class="icon-pa">
                                <i class="bi bi-book-half"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 pb-2">

                        {{-- Ayat Bacaan --}}
                        <div class="ayat-box">
                            <small>Ayat Bacaan</small>
                            <p>{{ $item->ayat_bacaan }}</p>
                        </div>

                        {{-- Tanggal --}}
                        <div class="info-row">
                            <div class="info-icon" style="background:#e8f0fe;">
                                <i class="bi bi-calendar3 text-primary"></i>
                            </div>
                            <div>
                                <span class="info-label">Tanggal</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Jam --}}
                        <div class="info-row">
                            <div class="info-icon" style="background:#e8f5e9;">
                                <i class="bi bi-clock text-success"></i>
                            </div>
                            <div>
                                <span class="info-label">Waktu</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                                </span>
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="info-row">
                            <div class="info-icon" style="background:#fff8e1;">
                                <i class="bi bi-geo-alt" style="color:#f57f17;"></i>
                            </div>
                            <div>
                                <span class="info-label">Lokasi</span>
                                <span class="info-value">{{ $item->lokasi }}</span>
                            </div>
                        </div>

                        {{-- Pelayan & Pendamping --}}
                        <div class="pelayan-row">
                            <div class="avatar">
                                {{ strtoupper(substr($item->pelayan, 0, 2)) }}
                            </div>
                            <div>
                                <span class="info-label">Pelayan Firman</span>
                                <span class="info-value d-block">{{ $item->pelayan }}</span>
                            </div>
                        </div>

                        @if($item->pendamping)
                        <div class="pelayan-row">
                            <div class="avatar" style="background:#2e7d32;">
                                {{ strtoupper(substr($item->pendamping, 0, 2)) }}
                            </div>
                            <div>
                                <span class="info-label">Pendamping</span>
                                <span class="info-value d-block">{{ $item->pendamping }}</span>
                            </div>
                        </div>
                        @endif

                    </div>

                    {{-- Countdown --}}
                    <div class="countdown-wrap">
                        @php
                            $tanggal = \Carbon\Carbon::parse($item->tanggal);
                            $hari    = now()->startOfDay()->diffInDays($tanggal->startOfDay(), false);
                        @endphp

                        @if($hari == 0)
                            <span class="badge bg-success px-3 py-2 rounded-pill w-100 text-center">
                                <i class="bi bi-circle-fill me-1" style="font-size:0.55rem;"></i>Hari Ini
                            </span>
                        @elseif($hari == 1)
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill w-100 text-center">
                                <i class="bi bi-clock me-1"></i>Besok
                            </span>
                        @elseif($hari > 1)
                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill w-100 text-center">
                                <i class="bi bi-hourglass-split me-1"></i>{{ $hari }} hari lagi
                            </span>
                        @else
                            <span class="badge bg-secondary px-3 py-2 rounded-pill w-100 text-center">
                                <i class="bi bi-check-circle me-1"></i>Sudah berlalu
                            </span>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($jadwalPa->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $jadwalPa->links() }}
        </div>
        @endif

        @endif
    </div>
</section>

@endsection