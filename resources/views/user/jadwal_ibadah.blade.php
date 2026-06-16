@extends('public.layouts.app')

@section('title', 'Jadwal Ibadah')

@section('content')

{{-- Hero Section --}}
<section style="background: linear-gradient(135deg, #0d2b6b 0%, #1a4a9f 100%);"
         class="text-white py-5">
    <div class="container text-center py-3">
        <h1 class="fw-bold mb-2">
            <i class="bi bi-calendar3 me-2"></i>Jadwal Ibadah
        </h1>
        <p class="mb-0 opacity-75">Informasi waktu dan tempat pelaksanaan ibadah jemaat GKS Padadita</p>
    </div>
</section>

{{-- Konten --}}
<section class="py-5 bg-light">
    <div class="container">

        @if($jadwalIbadah->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-calendar-x display-1 text-secondary d-block mb-3"></i>
            <h5 class="text-muted">Belum ada jadwal ibadah yang tersedia.</h5>
        </div>
        @else

        <div class="row g-4">
            @foreach($jadwalIbadah as $item)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 ibadah-card">

                    {{-- Card Header warna tema --}}
                    <div class="card-header-custom">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="badge-tema">{{ $item->tema }}</span>
                            <div class="icon-ibadah">
                                <i class="bi bi-church"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        {{-- Tanggal --}}
                        <div class="info-row mb-3">
                            <div class="info-icon bg-blue-light">
                                <i class="bi bi-calendar3 text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.5px;">Tanggal</small>
                                <span class="fw-semibold text-dark" style="font-size:0.92rem;">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Jam --}}
                        <div class="info-row mb-3">
                            <div class="info-icon bg-green-light">
                                <i class="bi bi-clock text-success"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.5px;">Waktu</small>
                                <span class="fw-semibold text-dark" style="font-size:0.92rem;">
                                    {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                                </span>
                            </div>
                        </div>

                        {{-- Tempat --}}
                        <div class="info-row mb-3">
                            <div class="info-icon bg-orange-light">
                                <i class="bi bi-geo-alt text-warning"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.5px;">Tempat</small>
                                <span class="fw-semibold text-dark" style="font-size:0.92rem;">
                                    {{ $item->tempat }}
                                </span>
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        @if($item->keterangan)
                        <div class="info-row">
                            <div class="info-icon bg-purple-light">
                                <i class="bi bi-chat-left-text text-purple"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block" style="font-size:0.72rem; text-transform:uppercase; letter-spacing:0.5px;">Keterangan</small>
                                <span class="text-muted" style="font-size:0.88rem;">
                                    {{ $item->keterangan }}
                                </span>
                            </div>
                        </div>
                        @endif

                    </div>

                    {{-- Card Footer --}}
                    <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                        <div class="countdown-badge">
                            @php
                                $tanggal = \Carbon\Carbon::parse($item->tanggal);
                                $hari    = now()->startOfDay()->diffInDays($tanggal->startOfDay(), false);
                            @endphp

                            @if($hari == 0)
                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    <i class="bi bi-circle-fill me-1" style="font-size:0.6rem;"></i>Hari Ini
                                </span>
                            @elseif($hari == 1)
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                    <i class="bi bi-clock me-1"></i>Besok
                                </span>
                            @elseif($hari > 1)
                                <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                                    <i class="bi bi-hourglass-split me-1"></i>{{ $hari }} hari lagi
                                </span>
                            @else
                                <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                    <i class="bi bi-check-circle me-1"></i>Sudah berlalu
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($jadwalIbadah->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $jadwalIbadah->links() }}
        </div>
        @endif

        @endif
    </div>
</section>

@endsection

@section('styles')
<style>
    .ibadah-card {
        border-radius: 16px !important;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .ibadah-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(0,0,0,0.12) !important;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #0d2b6b 0%, #1a4a9f 100%);
        padding: 20px 24px 16px;
    }

    .badge-tema {
        background: rgba(255,255,255,0.2);
        color: #ffffff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .icon-ibadah {
        width: 38px;
        height: 38px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .info-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .bg-blue-light   { background-color: #e8f0fe; }
    .bg-green-light  { background-color: #e8f5e9; }
    .bg-orange-light { background-color: #fff8e1; }
    .bg-purple-light { background-color: #f3f0fa; }
    .text-purple     { color: #6f42c1; }

    /* Pagination Bootstrap 5 */
    .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 2px;
        color: #0d2b6b;
        border: 1px solid #dee2e6;
    }
    .pagination .page-item.active .page-link {
        background-color: #0d2b6b;
        border-color: #0d2b6b;
    }

    @media (max-width: 575.98px) {
        .card-header-custom { padding: 16px 18px 14px; }
        .card-body          { padding: 18px !important; }
    }
</style>
@endsection