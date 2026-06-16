@extends('admin.layouts.admin')

@section('title', 'Edit Jadwal PA')

@section('styles')
<style>
    .page-wrapper { max-width: 680px; margin: 0 auto; }

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
        color: #fff; font-weight: 700; font-size: 1.25rem;
        margin-bottom: 4px; position: relative; z-index: 1;
    }
    .page-header p {
        color: rgba(255,255,255,0.5); font-size: 13px;
        margin: 0; position: relative; z-index: 1;
    }

    /* ===== FORM CARD ===== */
    .form-card {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 16px rgba(26,39,68,0.08);
        border: 1px solid #E5E7EB; overflow: hidden;
    }
    .form-card-body { padding: 32px 36px; }

    .field-section {
        padding-bottom: 24px; margin-bottom: 24px;
        border-bottom: 1px solid #F3F4F6;
    }
    .field-section:last-of-type {
        border-bottom: none; padding-bottom: 0; margin-bottom: 0;
    }

    .section-label {
        font-size: 0.68rem; font-weight: 700;
        letter-spacing: 0.09em; text-transform: uppercase;
        color: #1a2744; margin-bottom: 16px;
        display: flex; align-items: center; gap: 8px;
    }
    .section-label::before {
        content: ''; display: inline-block;
        width: 3px; height: 14px;
        background: #c8a96e; border-radius: 2px; flex-shrink: 0;
    }
    .section-label::after {
        content: ''; flex: 1; height: 1px; background: #F3F4F6;
    }

    /* ===== INPUTS ===== */
    .form-control, .form-select {
        border-color: #E5E7EB; border-radius: 9px; font-size: 0.9rem;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #1a2744; box-shadow: 0 0 0 3px rgba(26,39,68,0.08);
    }
    .input-group-icon { position: relative; }
    .input-group-icon .input-icon {
        position: absolute; top: 50%; left: 12px;
        transform: translateY(-50%); font-size: 1rem; pointer-events: none;
    }
    .input-group-icon .form-control { padding-left: 38px; }

    /* Warna ikon per field */
    .icon-jemaat  { color: #3B5BDB; }
    .icon-pelayan { color: #7c3aed; }
    .icon-pendamp { color: #0891b2; }
    .icon-ayat    { color: #c8a96e; }
    .icon-tanggal { color: #0891b2; }
    .icon-jam     { color: #d97706; }
    .icon-lokasi  { color: #16a34a; }

    /* ===== BACK BUTTON ===== */
    .btn-back {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 500;
        color: #6B7280; background: #F9FAFB;
        border: 1.5px solid #E5E7EB; border-radius: 8px;
        padding: 7px 14px; text-decoration: none;
        transition: all 0.15s;
    }
    .btn-back i { color: #1a2744; font-size: 14px; }
    .btn-back:hover { border-color: #1a2744; color: #1a2744; background: #f0f3fa; }

    /* ===== FORM ACTIONS ===== */
    .form-actions {
        display: flex; justify-content: flex-end; gap: 10px;
        padding-top: 28px; border-top: 1px solid #F3F4F6;
        margin-top: 28px; flex-wrap: wrap;
    }
    .btn-save {
        background: linear-gradient(135deg, #1a2744, #2a3f6f);
        border: none; color: #fff; font-weight: 600;
        border-radius: 9px; padding: 10px 28px;
        display: inline-flex; align-items: center; gap: 7px;
        transition: opacity 0.15s, transform 0.15s;
    }
    .btn-save i { color: #c8a96e; font-size: 1rem; }
    .btn-save:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

    .btn-cancel {
        background: #F9FAFB; border: 1.5px solid #E5E7EB; color: #6B7280;
        font-weight: 500; border-radius: 9px; padding: 10px 24px;
        display: inline-flex; align-items: center; gap: 7px;
        transition: border-color 0.15s, color 0.15s;
    }
    .btn-cancel i { color: #EF4444; font-size: 1rem; }
    .btn-cancel:hover { border-color: #1a2744; color: #1a2744; }

    @media (max-width: 576px) {
        .form-card-body { padding: 24px 20px; }
        .form-actions { justify-content: stretch; }
        .form-actions .btn { width: 100%; justify-content: center; }
    }
</style>
@endsection

@section('content')

<div class="page-wrapper">

    {{-- Kembali --}}
    <div class="mb-3">
        <a href="{{ route('jadwal_pa.index') }}" class="btn-back">
            <i class="bi bi-arrow-left-circle-fill"></i> Kembali ke Jadwal PA
        </a>
    </div>

    {{-- Page Header --}}
    <div class="page-header mb-4">
        <div class="page-header-dots"></div>
        <div class="page-header-lines"></div>
        <div class="page-header-circle"></div>
        <span class="page-header-cross">✝</span>
        <div class="page-header-badge">
            <i class="bi bi-book-half" style="font-size:11px"></i>
            Pendalaman Alkitab
        </div>
        <h4>Edit Jadwal PA</h4>
        <p>Perbarui informasi jadwal Pendalaman Alkitab di bawah ini.</p>
    </div>

    {{-- Error Global --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terdapat kesalahan input:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-card-body">
            <form action="{{ route('jadwal_pa.update', $jadwalpas->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Peserta --}}
                <div class="field-section">
                    <div class="section-label">Peserta</div>

                    <div>
                        <label for="nama" class="form-label fw-semibold small">Nama Penerima PA</label>
                        <div class="input-group-icon">
                            <i class="bi bi-person-circle input-icon icon-jemaat"></i>
                            <input type="text"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama"
                                   value="{{ old('nama', $jadwalpas->nama) }}"
                                   placeholder="Contoh: Keluarga Bpk. Yohanes" required>
                        </div>
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Pelayan --}}
                <div class="field-section">
                    <div class="section-label">Pelayan</div>

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="pelayan" class="form-label fw-semibold small">Pelayan Firman</label>
                            <div class="input-group-icon">
                                <i class="bi bi-person-badge-fill input-icon icon-pelayan"></i>
                                <input type="text"
                                       class="form-control @error('pelayan') is-invalid @enderror"
                                       id="pelayan" name="pelayan"
                                       value="{{ old('pelayan', $jadwalpas->pelayan) }}" required>
                            </div>
                            @error('pelayan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="pendamping" class="form-label fw-semibold small">Pendamping</label>
                            <div class="input-group-icon">
                                <i class="bi bi-people-fill input-icon icon-pendamp"></i>
                                <input type="text"
                                       class="form-control @error('pendamping') is-invalid @enderror"
                                       id="pendamping" name="pendamping"
                                       value="{{ old('pendamping', $jadwalpas->pendamping) }}" required>
                            </div>
                            @error('pendamping')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Materi & Waktu --}}
                <div class="field-section">
                    <div class="section-label">Materi & Waktu</div>

                    <div class="mb-3">
                        <label for="ayat_bacaan" class="form-label fw-semibold small">Ayat Bacaan</label>
                        <div class="input-group-icon">
                            <i class="bi bi-book-fill input-icon icon-ayat"></i>
                            <input type="text"
                                   class="form-control @error('ayat_bacaan') is-invalid @enderror"
                                   id="ayat_bacaan" name="ayat_bacaan"
                                   value="{{ old('ayat_bacaan', $jadwalpas->ayat_bacaan) }}"
                                   placeholder="Contoh: Yohanes 3:16" required>
                        </div>
                        @error('ayat_bacaan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="tanggal" class="form-label fw-semibold small">Tanggal</label>
                            <div class="input-group-icon">
                                <i class="bi bi-calendar3 input-icon icon-tanggal"></i>
                                <input type="date"
                                       class="form-control @error('tanggal') is-invalid @enderror"
                                       id="tanggal" name="tanggal"
                                       value="{{ old('tanggal', $jadwalpas->tanggal) }}" required>
                            </div>
                            @error('tanggal')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="jam" class="form-label fw-semibold small">Jam</label>
                            <div class="input-group-icon">
                                <i class="bi bi-clock-fill input-icon icon-jam"></i>
                                <input type="time"
                                       class="form-control @error('jam') is-invalid @enderror"
                                       id="jam" name="jam"
                                       value="{{ old('jam', \Carbon\Carbon::parse($jadwalpas->jam)->format('H:i')) }}"
                                       required>
                            </div>
                            @error('jam')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Lokasi --}}
                <div class="field-section">
                    <div class="section-label">Lokasi</div>

                    <div>
                        <label for="lokasi" class="form-label fw-semibold small">Lokasi / Sektor</label>
                        <div class="input-group-icon">
                            <i class="bi bi-geo-alt-fill input-icon icon-lokasi"></i>
                            <input type="text"
                                   class="form-control @error('lokasi') is-invalid @enderror"
                                   id="lokasi" name="lokasi"
                                   value="{{ old('lokasi', $jadwalpas->lokasi) }}"
                                   placeholder="Contoh: Sektor 3 / Jl. Anggrek No. 5" required>
                        </div>
                        @error('lokasi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-actions">
                    <a href="{{ route('jadwal_pa.index') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle-fill"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle-fill"></i>Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection