@extends('admin.layouts.admin')

@section('title', 'Data Pendaftaran Katekesasi')

@section('styles')
<style>
    /* ===== PAGE HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, #1a2744 0%, #0f1e3d 100%);
        border-radius: 14px;
        padding: 24px 28px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    .page-header-dots {
        position: absolute; inset: 0; border-radius: 14px;
        background-image: radial-gradient(circle, rgba(200,169,110,0.08) 1px, transparent 1px);
        background-size: 20px 20px; pointer-events: none;
    }
    .page-header-lines {
        position: absolute; inset: 0;
        pointer-events: none; overflow: hidden; border-radius: 14px;
    }
    .page-header-lines::before {
        content: ''; position: absolute;
        top: -20px; left: 55%; width: 2px; height: 200%;
        background: linear-gradient(180deg, transparent, rgba(200,169,110,0.10), transparent);
        transform: rotate(20deg);
    }
    .page-header-lines::after {
        content: ''; position: absolute;
        top: -20px; left: 58%; width: 1px; height: 200%;
        background: linear-gradient(180deg, transparent, rgba(200,169,110,0.06), transparent);
        transform: rotate(20deg);
    }
    .page-header-cross {
        position: absolute; right: 24px; top: 50%;
        transform: translateY(-50%); font-size: 72px;
        color: rgba(200,169,110,0.09); line-height: 1;
        pointer-events: none; user-select: none;
    }
    .page-header-circle {
        position: absolute; width: 180px; height: 180px;
        border-radius: 50%; border: 32px solid rgba(200,169,110,0.06);
        top: -60px; right: 60px; pointer-events: none;
    }
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(200,169,110,0.12); border: 1px solid rgba(200,169,110,0.28);
        color: #c8a96e; font-size: 11px; font-weight: 600;
        letter-spacing: 0.09em; text-transform: uppercase;
        padding: 4px 12px; border-radius: 100px;
        margin-bottom: 10px; position: relative; z-index: 1;
    }
    .page-header h4 {
        color: #3448ad; font-weight: 700; font-size: 1.25rem;
        margin-bottom: 4px; position: relative; z-index: 1;
    }
    .page-header p {
        color: #3448ad; font-size: 13px;
        margin: 0; position: relative; z-index: 1;
    }

    /* ===== TOOLBAR ===== */
    .toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }
    .toolbar-left {
        display: flex; align-items: center; gap: 8px;
    }
    .count-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f0f3fa; border: 1px solid #DDE1EA;
        color: #1a2744; font-size: 12px; font-weight: 600;
        padding: 5px 12px; border-radius: 100px;
    }
    .count-badge i { color: #c8a96e; }
    .btn-pdf {
        display: inline-flex; align-items: center; gap: 7px;
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #fff; font-size: 13px; font-weight: 600;
        padding: 8px 18px; border-radius: 9px; border: none;
        cursor: pointer; transition: opacity 0.15s, transform 0.15s;
        text-decoration: none;
    }
    .btn-pdf:hover { opacity: 0.88; transform: translateY(-1px); color: #fff; }

    /* ===== CARD ===== */
    .data-card {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 16px rgba(26,39,68,0.08);
        border: 1px solid #E5E7EB; overflow: hidden;
    }
    .data-card::before {
        content: ''; display: block; height: 3px;
        background: linear-gradient(90deg, #1a2744 0%, #c8a96e 50%, #1a2744 100%);
    }

    /* ===== TABLE ===== */
    .table-katekesasi { margin: 0; }
    .table-katekesasi thead th {
        background: #1a2744;
        color: rgba(255,255,255,0.75);
        font-weight: 600; font-size: 0.72rem;
        text-transform: uppercase; letter-spacing: 0.06em;
        border: none; padding: 13px 14px; white-space: nowrap;
    }
    .table-katekesasi thead th:first-child { padding-left: 20px; }
    .table-katekesasi thead th:last-child  { padding-right: 20px; }

    .table-katekesasi tbody tr {
        border-bottom: 1px solid #F3F4F6;
        transition: background 0.12s;
    }
    .table-katekesasi tbody tr:last-child { border-bottom: none; }
    .table-katekesasi tbody tr:hover { background: #f8f7ff; }
    .table-katekesasi tbody td {
        padding: 12px 14px; vertical-align: middle;
        font-size: 0.875rem; color: #374151;
    }
    .table-katekesasi tbody td:first-child { padding-left: 20px; }
    .table-katekesasi tbody td:last-child  { padding-right: 20px; }

    /* Nomor urut */
    .no-badge {
        width: 28px; height: 28px; border-radius: 50%;
        background: #f0f3fa; border: 1px solid #DDE1EA;
        color: #1a2744; font-size: 0.72rem; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }

    /* Nama */
    .nama-cell { font-weight: 600; color: #1a2744; }

    /* Gender badges */
    .badge-laki {
        background: #ede9fe; color: #5b21b6;
        font-size: 0.72rem; padding: 4px 10px;
        border-radius: 20px; font-weight: 600;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .badge-perempuan {
        background: #fce7f3; color: #9d174d;
        font-size: 0.72rem; padding: 4px 10px;
        border-radius: 20px; font-weight: 600;
        display: inline-flex; align-items: center; gap: 4px;
    }

    /* Info row (telepon, lokasi) */
    .info-row {
        display: inline-flex; align-items: center;
        gap: 5px; font-size: 0.8rem; color: #6b7280;
    }
    .info-row i { font-size: 0.8rem; color: #c8a96e; }

    /* Hapus button */
    .btn-hapus {
        background: #fee2e2; color: #b91c1c;
        border: none; border-radius: 8px;
        padding: 6px 14px; font-size: 0.78rem; font-weight: 600;
        display: inline-flex; align-items: center; gap: 5px;
        transition: background 0.15s, transform 0.1s; cursor: pointer;
        white-space: nowrap;
    }
    .btn-hapus:hover { background: #fca5a5; color: #7f1d1d; transform: scale(1.03); }

    /* Empty state */
    .empty-state {
        text-align: center; padding: 48px 20px; color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; color: #c4b5fd; display: block; margin-bottom: 10px; }
    .empty-state p  { font-size: 0.875rem; margin: 0; }

    /* ===== MOBILE CARDS ===== */
    .mobile-card {
        border-radius: 12px !important;
        border: 1px solid #E5E7EB !important;
        box-shadow: 0 2px 8px rgba(26,39,68,0.06) !important;
        transition: transform 0.15s;
        overflow: hidden;
    }
    .mobile-card::before {
        content: ''; display: block; height: 3px;
        background: linear-gradient(90deg, #1a2744, #c8a96e);
    }
    .mobile-card:hover { transform: translateY(-2px); }
    .mobile-card .card-body { padding: 14px 16px; }

    /* ===== PRINT ===== */
    @media print {
        .sidebar, .navbar, .toolbar, .btn-hapus,
        .d-md-none, .page-header-badge { display: none !important; }
        .table-katekesasi thead th:last-child,
        .table-katekesasi tbody td:last-child { display: none !important; }
        .data-card { box-shadow: none !important; border: none !important; }
        .data-card::before { display: none; }
        .table-katekesasi th, .table-katekesasi td {
            border: 1px solid #ccc !important;
            color: #000 !important;
        }
    }
</style>
@endsection

@section('content')

<div class="container-fluid py-3">

    {{-- Page Header --}}
    <div class="page-header mb-4">
        <div class="page-header-dots"></div>
        <div class="page-header-lines"></div>
        <div class="page-header-circle"></div>
        <span class="page-header-cross">✝</span>
        <div class="page-header-badge">
            <i class="bi bi-journal-text" style="font-size:11px"></i>
            Katekesasi
        </div>
        <h4>Data Pendaftar Katekesasi</h4>
        <p>Daftar seluruh peserta yang mendaftar program katekesasi gereja.</p>
    </div>

    {{-- Toolbar --}}
    <div class="toolbar">
        <div class="toolbar-left">
            <div class="count-badge">
                <i class="bi bi-people-fill"></i>
                {{ $pendaftarans->count() }} Pendaftar
            </div>
        </div>
        <button onclick="window.print()" class="btn-pdf">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            Ekspor PDF
        </button>
    </div>

    {{-- Data Card --}}
    <div class="data-card">

        {{-- Desktop Table --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table table-katekesasi">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Nama Lengkap</th>
                        <th>Katekesasi</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Telepon</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarans as $index => $item)
                    <tr>
                        <td><div class="no-badge">{{ $index + 1 }}</div></td>
                        <td class="nama-cell">{{ $item->nama_lengkap }}</td>
                         <td class="nama-cell">{{ $item->katekesasi }}</td>
                        <td>
                            @if($item->jenis_kelamin == 'L')
                                <span class="badge-laki">
                                    <i class="bi bi-gender-male"></i> Laki-laki
                                </span>
                            @else
                                <span class="badge-perempuan">
                                    <i class="bi bi-gender-female"></i> Perempuan
                                </span>
                            @endif
                        </td>
                        <td>{{ $item->tempat_lahir }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}</td>
                        <td>{{ $item->nama_ayah }}</td>
                        <td>{{ $item->nama_ibu }}</td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-telephone-fill"></i>
                                {{ $item->telepon }}
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('pendaftaran_katekesasi.destroy', $item->id_kesasi) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                  class="m-0 d-flex justify-content-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>Belum ada data pendaftar katekesasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Cards --}}
        <div class="d-md-none p-3">
            @forelse($pendaftarans as $index => $item)
            <div class="card mobile-card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="no-badge">{{ $index + 1 }}</div>
                            <div>
                                <div class="nama-cell" style="font-size:0.9rem;">{{ $item->nama_lengkap }}</div>
                                @if($item->jenis_kelamin == 'L')
                                    <span class="badge-laki"><i class="bi bi-gender-male"></i> Laki-laki</span>
                                @else
                                    <span class="badge-perempuan"><i class="bi bi-gender-female"></i> Perempuan</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="info-row">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $item->tempat_lahir }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-row">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-row">
                                <i class="bi bi-person-fill"></i>
                                Ayah: {{ $item->nama_ayah }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-row">
                                <i class="bi bi-person-heart"></i>
                                Ibu: {{ $item->nama_ibu }}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-row">
                                <i class="bi bi-telephone-fill"></i>
                                {{ $item->telepon }}
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('pendaftaran_katekesasi.destroy', $item->id_kesasi) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                          class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus w-100 justify-content-center">
                            <i class="bi bi-trash-fill"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <p>Belum ada data pendaftar katekesasi.</p>
            </div>
            @endforelse
        </div>

    </div>

</div>

@endsection