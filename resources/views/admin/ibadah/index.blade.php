@extends('admin.layouts.admin')

@section('title', 'Jadwal Ibadah')

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
        color: #2e2a85; font-weight: 700; font-size: 1.25rem;
        margin-bottom: 4px; position: relative; z-index: 1;
    }
    .page-header p {
         color: #2e2a85; font-size: 13px;
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

    .table-jadwal { margin: 0; }
    .table-jadwal thead th {
        background: #1a2744;
        color: rgba(255,255,255,0.75);
        font-weight: 600; font-size: 0.72rem;
        text-transform: uppercase; letter-spacing: 0.06em;
        border: none; padding: 13px 14px; white-space: nowrap;
    }
    .table-jadwal thead th:first-child { padding-left: 20px; }
    .table-jadwal thead th:last-child  { padding-right: 20px; }

    .table-jadwal tbody tr {
        border-bottom: 1px solid #F3F4F6;
        transition: background 0.12s;
    }
    .table-jadwal tbody tr:last-child { border-bottom: none; }
    .table-jadwal tbody tr:hover { background: #f8f7ff; }
    .table-jadwal tbody td {
        padding: 12px 14px; vertical-align: middle;
        font-size: 0.875rem; color: #374151;
    }
    .table-jadwal tbody td:first-child { padding-left: 20px; }
    .table-jadwal tbody td:last-child  { padding-right: 20px; }

    .badge-tema {
        background: #ede9fe; color: #5b21b6;
        font-size: 0.75rem; padding: 5px 12px;
        border-radius: 20px; font-weight: 600;
        display: inline-block;
    }
    .badge-pelayan {
        background: #f0f3fa; color: #1a2744;
        font-size: 0.75rem; padding: 5px 12px;
        border-radius: 20px; font-weight: 600;
        border: 1px solid #DDE1EA;
        display: inline-block;
    }

    .info-row {
        display: inline-flex; align-items: center;
        gap: 5px; font-size: 0.8rem; color: #6b7280;
    }
    .info-row i { font-size: 0.8rem; color: #c8a96e; }

    .jam-cell {
        font-weight: 700; color: #1a2744;
        background: #f0f3fa; border: 1px solid #DDE1EA;
        padding: 4px 10px; border-radius: 8px;
        font-size: 0.8rem; display: inline-block;
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
</style>
@endsection

@section('content')

<div class="container-fluid py-3">

    {{-- Page Header --}}
     <div class="page-header mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="page-header-dots"></div>
        <div style="position:relative; z-index:1;">
            <h4>Jadwal Ibadah</h4>
            <p>Informasi dan pengaturan waktu pelaksanaan ibadah jemaat.</p>
        </div>
        <a href="{{ route('ibadah.create') }}" class="btn-tambah">
           <i class="bi bi-plus-circle-fill"></i>
            <span class="d-none d-sm-inline">Tambah Jadwal</span>
            <span class="d-inline d-sm-none">Tambah</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Data Card --}}
    <div class="data-card">
        <div class="table-responsive">
            <table class="table table-hover table-jadwal w-100">
                <thead>
                    <tr>
                        <th>Tema Ibadah</th>
                        <th>Pelayan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Tempat / Lokasi</th>
                        <th>Keterangan</th>
                        <th class="text-center" style="width:120px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $item)
                    <tr>
                        <td><span class="badge-tema">{{ $item->tema }}</span></td>
                        <td><span class="badge-pelayan">{{ $item->pelayan }}</span></td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-calendar3"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </span>
                        </td>
                        <td><span class="jam-cell">{{ $item->jam }}</span></td>
                        <td>
                            <span class="info-row">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $item->tempat }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $item->keterangan ?: '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('ibadah.edit', $item->id_ibadah) }}"
                                   class="btn-aksi btn-edit" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('ibadah.destroy', $item->id_ibadah) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus jadwal ibadah ini?')" class="m-0">
                                    @csrf
                                    @method('DELETE')
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
                                <p>Belum ada jadwal ibadah yang dikonfigurasi.</p>
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