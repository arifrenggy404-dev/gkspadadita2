@extends('public.layouts.app')

@section('title', 'Jadwal Kegiatan')

@section('styles')
<style>
    .hero-kegiatan {
        background: linear-gradient(135deg, #003366 0%, #0055aa 100%);
        color: white;
        padding: 60px 0;
        text-align: center;
    }
    .hero-kegiatan h1 { font-size: 2.2rem; font-weight: 800; margin-bottom: 10px; }
    .hero-kegiatan p  { font-size: 1rem; opacity: 0.8; margin: 0; }

    /* Card */
    .kegiatan-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 100%;
    }
    .kegiatan-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(0,51,102,0.15) !important;
    }

    .kegiatan-card-header {
        background: linear-gradient(135deg, #003366 0%, #0055aa 100%);
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

    .icon-kegiatan {
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

    .deskripsi-box {
        background: #eef4ff;
        border-left: 3px solid #0055aa;
        border-radius: 0 8px 8px 0;
        padding: 10px 14px;
        margin: 12px 0;
    }
    .deskripsi-box small { font-size: 0.7rem; color: #0055aa; font-weight: 700; text-transform: uppercase; }
    .deskripsi-box p { font-size: 0.88rem; color: #003366; font-weight: 500; margin: 2px 0 0; line-height: 1.5; }

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
        color: #003366;
        border-color: #dee2e6;
    }
    .pagination .page-item.active .page-link {
        background-color: #003366;
        border-color: #003366;
    }

    @media (max-width: 575.98px) {
        .hero-kegiatan h1 { font-size: 1.6rem; }
        .hero-kegiatan    { padding: 40px 16px; }
    }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="hero-kegiatan">
    <div class="container">
        <h1>🗓️ Jadwal Kegiatan</h1>
        <p>Daftar kegiatan jemaat GKS Padadita</p>
    </div>
</section>

{{-- Konten --}}
<section class="py-5 bg-light">
    <div class="container">

        @if($jadwalKegiatan->isEmpty())
        <div class="empty-state">
            <i class="bi bi-calendar-x text-secondary"></i>
            <h5>Belum ada jadwal kegiatan yang tersedia.</h5>
            <p class="small">Silakan cek kembali nanti.</p>
        </div>
        @else

        <div class="row g-4">
            @foreach($jadwalKegiatan as $item)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kegiatan-card shadow-sm">

                    {{-- Header --}}
                    <div class="kegiatan-card-header">
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <span class="nama-badge">{{ $item->nama_kegiatan }}</span>
                            <div class="icon-kegiatan">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 pb-2">

                        {{-- Deskripsi --}}
                        @if($item->deskripsi)
                        <div class="deskripsi-box">
                            <small>Keterangan</small>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                        @endif

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
                        @if($item->jam)
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
                        @endif

                        {{-- Lokasi --}}
                        @if($item->lokasi)
                        <div class="info-row">
                            <div class="info-icon" style="background:#fff8e1;">
                                <i class="bi bi-geo-alt" style="color:#f57f17;"></i>
                            </div>
                            <div>
                                <span class="info-label">Lokasi</span>
                                <span class="info-value">{{ $item->lokasi }}</span>
                            </div>
                        </div>
                        @endif

                        {{-- Penanggung Jawab --}}
                        @if($item->penanggung_jawab)
                        <div class="info-row">
                            <div class="info-icon" style="background:#fce4ec;">
                                <i class="bi bi-person-check" style="color:#c62828;"></i>
                            </div>
                            <div>
                                <span class="info-label">Penanggung Jawab</span>
                                <span class="info-value">{{ $item->penanggung_jawab }}</span>
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
        @if($jadwalKegiatan->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $jadwalKegiatan->links() }}
        </div>
        @endif

        @endif
    </div>
</section>

@endsection