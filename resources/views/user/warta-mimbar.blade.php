@extends('public.layouts.app')

@section('title', 'Warta Mimbar')

@section('styles')
<style>
    /* ── Hero ── */
    .hero-warta {
        background: linear-gradient(135deg, #7b2d00 0%, #c0501a 100%);
        color: white;
        padding: 60px 0 50px;
    }
    .hero-warta h1 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }
    .hero-warta p {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.75);
        margin-bottom: 0;
    }
    .hero-warta .breadcrumb-item a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
    }
    .hero-warta .breadcrumb-item a:hover { color: white; }
    .hero-warta .breadcrumb-item.active { color: rgba(255,255,255,0.55); }
    .hero-warta .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

    /* ── Card ── */
    .warta-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.07);
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .warta-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 28px rgba(192,80,26,0.15);
    }

    .warta-card-top {
        background: linear-gradient(135deg, #7b2d00, #c0501a);
        padding: 20px 22px 16px;
        color: white;
    }
    .warta-card-top .tanggal {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        opacity: 0.8;
        text-transform: uppercase;
        margin-bottom: 6px;
    }
    .warta-card-top .judul {
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .warta-card-body {
        padding: 18px 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .warta-card-body .isi {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.7;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .warta-card-body .isi-kosong {
        font-size: 0.875rem;
        color: #adb5bd;
        font-style: italic;
        flex: 1;
        margin-bottom: 16px;
    }

    /* File badge */
    .file-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fff3ee;
        color: #c0501a;
        border: 1px solid #fcd5bc;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 14px;
        text-decoration: none;
        transition: background 0.15s;
        width: fit-content;
    }
    .file-badge:hover { background: #ffe8db; color: #7b2d00; }

    .btn-lihat {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #7b2d00, #c0501a);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 18px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: opacity 0.2s;
        width: 100%;
        justify-content: center;
    }
    .btn-lihat:hover { opacity: 0.88; color: white; }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #adb5bd;
    }
    .empty-state i { font-size: 3.5rem; margin-bottom: 16px; display: block; }
    .empty-state p { font-size: 0.95rem; }

    /* ── Responsive ── */
    @media (max-width: 575.98px) {
        .hero-warta h1 { font-size: 1.5rem; }
        .hero-warta { padding: 40px 0 36px; }
    }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="hero-warta">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0" style="background:none; padding:0;">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Warta Mimbar</li>
            </ol>
        </nav>
        <h1><i class="bi bi-megaphone-fill me-2"></i>Warta Mimbar</h1>
        <p>Informasi dan pengumuman jemaat terkini</p>
    </div>
</section>

{{-- Konten --}}
<section class="py-5 bg-light">
    <div class="container">

        @if($wartaMimbar->isEmpty())
            <div class="empty-state">
                <i class="bi bi-newspaper"></i>
                <p>Belum ada warta mimbar yang tersedia saat ini.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($wartaMimbar as $warta)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="warta-card card">

                        {{-- Top gradient --}}
                        <div class="warta-card-top">
                            <div class="tanggal">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($warta->tanggal_terbit)->translatedFormat('d F Y') }}
                            </div>
                            <div class="judul">{{ $warta->judul }}</div>
                        </div>

                        {{-- Body --}}
                        <div class="warta-card-body">
                            @if($warta->isi_warta)
                                <div class="isi">{{ $warta->isi_warta }}</div>
                            @else
                                <div class="isi-kosong">Tidak ada isi warta.</div>
                            @endif

                            {{-- File lampiran --}}
                            @if($warta->file)
                                <a href="{{ Storage::url($warta->file) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="file-badge">
                                    <i class="bi bi-file-earmark-text"></i> Lihat File Lampiran
                                </a>
                            @endif

                            {{-- Tombol detail --}}
                            {{-- <a href="{{ route('user.warta-mimbar.show', $warta->id_warta) }}"
                               class="btn-lihat">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a> --}}
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

@endsection