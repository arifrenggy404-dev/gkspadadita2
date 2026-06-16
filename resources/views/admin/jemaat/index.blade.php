@extends('admin.layouts.admin')

@section('title', 'Data Jemaat')

@section('styles')
<style>
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
    .page-header h4 {
         color: #3e328b; font-weight: 700; font-size: 1.25rem;
        margin-bottom: 4px; position: relative; z-index: 1;
    }
    .page-header p {
        color: #3e328b; font-size: 13px;
        margin: 0; position: relative; z-index: 1;
    }
    .header-actions { position: relative; z-index: 1; }
    .btn-tambah {
        background: linear-gradient(135deg, #c8a96e, #b08d4f);
        border: none; color: #1a2744; font-weight: 600;
        padding: 8px 18px; border-radius: 9px; font-size: 13px;
        display: inline-flex; align-items: center; gap: 7px;
        text-decoration: none; transition: opacity 0.15s, transform 0.15s;
    }
    .btn-tambah:hover { opacity: 0.9; transform: translateY(-1px); color: #1a2744; }
    .btn-pdf {
        display: inline-flex; align-items: center; gap: 7px;
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #fff; font-size: 13px; font-weight: 600;
        padding: 8px 18px; border-radius: 9px; border: none;
        cursor: pointer; transition: opacity 0.15s, transform 0.15s;
        text-decoration: none;
    }
    .btn-pdf:hover { opacity: 0.88; transform: translateY(-1px); color: #fff; }

    /* ===== TOOLBAR / SEARCH ===== */
    .toolbar { margin-bottom: 18px; }
    .search-box { display: flex; gap: 8px; max-width: 420px; }
    .search-box .form-control {
        border-radius: 9px; border: 1px solid #DDE1EA;
        font-size: 0.875rem; padding: 8px 14px;
    }
    .search-box .form-control:focus {
        border-color: #c8a96e; box-shadow: 0 0 0 0.2rem rgba(200,169,110,0.15);
    }
    .btn-search {
        background: #1a2744; color: #fff; border: none;
        border-radius: 9px; padding: 8px 14px;
    }
    .btn-search:hover { background: #0f1e3d; color: #fff; }
    .btn-reset { border-radius: 9px; padding: 8px 14px; font-size: 0.875rem; }

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

    .table-jemaat { margin: 0; }
    .table-jemaat thead th {
        background: #1a2744;
        color: rgba(255,255,255,0.75);
        font-weight: 600; font-size: 0.72rem;
        text-transform: uppercase; letter-spacing: 0.06em;
        border: none; padding: 13px 14px; white-space: nowrap;
    }
    .table-jemaat thead th:first-child { padding-left: 20px; }
    .table-jemaat thead th:last-child  { padding-right: 20px; }

    .table-jemaat tbody tr {
        border-bottom: 1px solid #F3F4F6;
        transition: background 0.12s;
    }
    .table-jemaat tbody tr:last-child { border-bottom: none; }
    .table-jemaat tbody tr:hover { background: #f8f7ff; }
    .table-jemaat tbody td {
        padding: 12px 14px; vertical-align: middle;
        font-size: 0.875rem; color: #374151;
    }
    .table-jemaat tbody td:first-child { padding-left: 20px; }
    .table-jemaat tbody td:last-child  { padding-right: 20px; }

    .no-badge {
        width: 28px; height: 28px; border-radius: 50%;
        background: #f0f3fa; border: 1px solid #DDE1EA;
        color: #1a2744; font-size: 0.72rem; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }

    .nama-cell { font-weight: 600; color: #1a2744; }

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

    .status-badge {
        font-size: 0.72rem; padding: 4px 12px;
        border-radius: 20px; font-weight: 600;
        display: inline-block;
    }
    .status-aktif     { background: #d1fae5; color: #065f46; }
    .status-pindah    { background: #fef3c7; color: #92400e; }
    .status-meninggal { background: #fee2e2; color: #991b1b; }

    .info-row {
        display: inline-flex; align-items: center;
        gap: 5px; font-size: 0.8rem; color: #6b7280;
    }
    .info-row i { font-size: 0.8rem; color: #c8a96e; }

    .btn-aksi {
        width: 34px; height: 34px; border-radius: 8px;
        display: inline-flex; align-items: center; justify-content: center;
        border: none; transition: transform 0.1s, opacity 0.15s;
    }
    .btn-aksi:hover { transform: scale(1.05); }
    .btn-edit { background: #fef3c7; color: #92400e; }
    .btn-edit:hover { background: #fde68a; color: #78350f; }
    .btn-hapus-icon { background: #fee2e2; color: #b91c1c; }
    .btn-hapus-icon:hover { background: #fca5a5; color: #7f1d1d; }

    .empty-state {
        text-align: center; padding: 48px 20px; color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; color: #c4b5fd; display: block; margin-bottom: 10px; }
    .empty-state p  { font-size: 0.875rem; margin: 0; }

    @media print {
        body * { visibility: hidden; }
        .data-card, .data-card * { visibility: visible; }
        .data-card {
            position: absolute; left: 0; top: 0; width: 100% !important;
            box-shadow: none !important; border: none !important;
        }
        .data-card::before { display: none; }
        .table-jemaat thead th:last-child,
        .table-jemaat tbody td:last-child { display: none !important; }
        .table-jemaat th, .table-jemaat td {
            border: 1px solid #ccc !important; color: #000 !important;
        }
        .no-badge {
            background: transparent !important; border: none !important;
        }
    }
</style>
@endsection

@section('content')

<div class="container-fluid py-3">

    {{-- Page Header --}}
    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="page-header-dots"></div>
        <div style="position:relative; z-index:1;">
            <h4>Data Jemaat</h4>
            <p>Daftar seluruh anggota jemaat gereja.</p>
        </div>
        <div class="header-actions d-flex gap-2">
            <button onclick="window.print()" class="btn-pdf">
                <i class="bi bi-file-earmark-pdf-fill"></i> Ekspor PDF
            </button>
            <a href="{{ route('jemaat.create') }}" class="btn-tambah">
                <i class="bi bi-plus-circle-fill"></i> Tambah Data
            </a>
        </div>
    </div>

    {{-- Filter Pencarian --}}
    <div class="toolbar">
        <form action="{{ route('jemaat.index') }}" method="GET" class="search-box">
            <input type="text" name="search" class="form-control" placeholder="Cari nama jemaat..." value="{{ request('search') }}">
            <button type="submit" class="btn-search">
                <i class="bi bi-search"></i>
            </button>
            @if(request('search'))
                <a href="{{ route('jemaat.index') }}" class="btn btn-outline-danger btn-reset">Reset</a>
            @endif
        </form>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel --}}
    <div class="data-card">
        <div class="table-responsive">
            <table class="table table-hover table-jemaat w-100">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Nama Jemaat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th class="text-center" style="width:110px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jemaat as $index => $item)
                    <tr>
                        <td><div class="no-badge">{{ $index + 1 }}</div></td>
                        <td class="nama-cell">{{ $item->nama_jemaat }}</td>
                        <td>
                            @if($item->jenis_kelamin == 'Laki-laki' || $item->jenis_kelamin == 'L')
                                <span class="badge-laki"><i class="bi bi-gender-male"></i> Laki-laki</span>
                            @else
                                <span class="badge-perempuan"><i class="bi bi-gender-female"></i> Perempuan</span>
                            @endif
                        </td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}
                            </span>
                        </td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $item->alamat }}
                            </span>
                        </td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-telephone-fill"></i>
                                {{ $item->telepon }}
                            </span>
                        </td>
                        <td>
                            @if($item->status == 'Aktif')
                                <span class="status-badge status-aktif">Aktif</span>
                            @elseif($item->status == 'Pindah')
                                <span class="status-badge status-pindah">Pindah</span>
                            @else
                                <span class="status-badge status-meninggal">Meninggal</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('jemaat.edit', $item->id) }}" class="btn-aksi btn-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('jemaat.destroy', $item->id) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-aksi btn-hapus-icon" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <p>Data jemaat tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection