@extends('admin.layouts.admin')

@section('title', 'Jadwal Kegiatan')

@section('styles')
<style>
    @media (max-width: 767.98px) {
        .table-desktop { display: none; }
        .card-mobile   { display: block; }
    }
    @media (min-width: 768px) {
        .table-desktop { display: table; }
        .card-mobile   { display: none; }
    }

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
        color: #fff; font-weight: 700; font-size: 1.25rem;
        margin-bottom: 4px; position: relative; z-index: 1;
    }
    .page-header p {
        color: #e8e0d0; font-size: 13px;
        margin: 0; position: relative; z-index: 1;
    }
    .btn-tambah {
        background: linear-gradient(135deg, #c8a96e, #b08d4f);
        border: none; color: #1a2744; font-weight: 600;
        padding: 8px 18px; border-radius: 9px; font-size: 13px;
        display: inline-flex; align-items: center; gap: 7px;
        position: relative; z-index: 1; text-decoration: none;
        transition: opacity 0.15s, transform 0.15s;
    }
    .btn-tambah:hover { opacity: 0.9; transform: translateY(-1px); color: #1a2744; }

    .data-card {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 16px rgba(26,39,68,0.08);
        border: 1px solid #E5E7EB; overflow: hidden;
    }
    .data-card::before {
        content: ''; display: block; height: 3px;
        background: linear-gradient(90deg, #1a2744 0%, #c8a96e 50%, #1a2744 100%);
    }

    .table-kegiatan { margin: 0; }
    .table-kegiatan thead th {
        background: #1a2744;
        color: rgba(255,255,255,0.75);
        font-weight: 600; font-size: 0.72rem;
        text-transform: uppercase; letter-spacing: 0.06em;
        border: none; padding: 13px 14px; white-space: nowrap;
    }
    .table-kegiatan thead th:first-child { padding-left: 20px; }
    .table-kegiatan thead th:last-child  { padding-right: 20px; }

    .table-kegiatan tbody tr {
        border-bottom: 1px solid #F3F4F6;
        transition: background 0.12s;
    }
    .table-kegiatan tbody tr:last-child { border-bottom: none; }
    .table-kegiatan tbody tr:hover { background: #f8f7ff; }
    .table-kegiatan tbody td {
        padding: 12px 14px; vertical-align: middle;
        font-size: 0.875rem; color: #374151;
    }
    .table-kegiatan tbody td:first-child { padding-left: 20px; }
    .table-kegiatan tbody td:last-child  { padding-right: 20px; }

    .no-badge {
        width: 28px; height: 28px; border-radius: 50%;
        background: #f0f3fa; border: 1px solid #DDE1EA;
        color: #1a2744; font-size: 0.72rem; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }

    .nama-cell { font-weight: 600; color: #1a2744; }

    .info-row {
        display: inline-flex; align-items: center;
        gap: 5px; font-size: 0.8rem; color: #6b7280;
    }
    .info-row i { font-size: 0.8rem; color: #c8a96e; }

    .jam-cell {
        font-weight: 700; color: #1a2744;
        background: #f0f3fa; border: 1px solid #DDE1EA;
        padding: 4px 10px; border-radius: 8px;
        font-size: 0.8rem; display: inline-block; white-space: nowrap;
    }

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

    /* ===== MOBILE CARD ===== */
    .kegiatan-card {
        border-radius: 12px !important;
        border: 1px solid #E5E7EB !important;
        box-shadow: 0 2px 8px rgba(26,39,68,0.06) !important;
        margin-bottom: 12px;
        transition: transform 0.15s;
        overflow: hidden;
    }
    .kegiatan-card::before {
        content: ''; display: block; height: 3px;
        background: linear-gradient(90deg, #1a2744, #c8a96e);
    }
    .kegiatan-card:hover { transform: translateY(-2px); }
    .kegiatan-card .meta-row {
        display: flex; align-items: flex-start; gap: 8px;
        font-size: 0.85rem; color: #6b7280; margin-bottom: 6px;
    }
    .kegiatan-card .meta-row i {
        width: 16px; flex-shrink: 0; color: #c8a96e; margin-top: 2px;
    }
</style>
@endsection

@section('content')

<div class="container-fluid py-3">

    {{-- Page Header --}}
    <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="page-header-dots"></div>
        <div style="position:relative; z-index:1;">
            <h4>Jadwal Kegiatan</h4>
            <p>Daftar agenda dan kegiatan gereja.</p>
        </div>
        <a href="{{ route('jadwal-kegiatan.create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle-fill"></i>
            <span class="d-none d-sm-inline">Tambah Jadwal Kegiatan</span>
            <span class="d-inline d-sm-none">Tambah</span>
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ===================== DESKTOP (tabel) ===================== --}}
    <div class="data-card">
        <div class="table-responsive">
            <table class="table table-hover table-kegiatan table-desktop w-100">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Jenis Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width:110px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalKegiatans as $index => $jadwal)
                    <tr>
                        <td><div class="no-badge">{{ $index + 1 }}</div></td>
                        <td class="nama-cell">{{ $jadwal->nama_kegiatan }}</td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}
                            </span>
                        </td>
                        <td><span class="jam-cell">{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB</span></td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $jadwal->lokasi }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $jadwal->deskripsi ? Str::limit($jadwal->deskripsi, 50) : '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('jadwal-kegiatan.edit', $jadwal->id_kegiatan) }}"
                                   class="btn-aksi btn-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('jadwal-kegiatan.destroy', $jadwal->id_kegiatan) }}"
                                      method="POST" class="m-0"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="bi bi-calendar-x"></i>
                                <p>Belum ada jadwal kegiatan yang dikonfigurasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ===================== MOBILE (kartu) ===================== --}}
    <div class="card-mobile">
        @forelse($jadwalKegiatans as $index => $jadwal)
        <div class="kegiatan-card card">
            <div class="card-body pb-2">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="no-badge">{{ $index + 1 }}</div>
                    <div class="nama-cell" style="font-size:0.95rem;">
                        {{ $jadwal->nama_kegiatan }}
                    </div>
                </div>

                <div class="meta-row">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="meta-row">
                    <i class="bi bi-clock"></i>
                    <span>{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB</span>
                </div>
                <div class="meta-row">
                    <i class="bi bi-geo-alt"></i>
                    <span>{{ $jadwal->lokasi }}</span>
                </div>
                @if($jadwal->deskripsi)
                <div class="meta-row mt-1">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="text-muted">{{ $jadwal->deskripsi }}</span>
                </div>
                @endif

                <div class="d-flex gap-2 mt-3 pt-2 border-top">
                    <a href="{{ route('jadwal-kegiatan.edit', $jadwal->id_kegiatan) }}"
                       class="btn-aksi btn-edit flex-fill" style="width:auto;">
                        <i class="bi bi-pencil-square me-1"></i>Edit
                    </a>
                    <form action="{{ route('jadwal-kegiatan.destroy', $jadwal->id_kegiatan) }}"
                          method="POST" class="flex-fill"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-aksi btn-hapus-icon w-100" style="width:auto;">
                            <i class="bi bi-trash-fill me-1"></i>Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-calendar-x"></i>
            <p>Belum ada jadwal kegiatan yang dikonfigurasi.</p>
        </div>
        @endforelse
    </div>

</div>

@endsection