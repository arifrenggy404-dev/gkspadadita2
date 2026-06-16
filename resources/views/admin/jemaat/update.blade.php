@extends('admin.layouts.admin')

@section('title', 'Edit Data Jemaat')

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
    .input-group-icon .form-control,
    .input-group-icon .form-select { padding-left: 38px; }

    /* Warna ikon per field */
    .icon-nama   { color: #3B5BDB; }
    .icon-tgl    { color: #0891b2; }
    .icon-phone  { color: #0891b2; }
    .icon-alamat { color: #16a34a; }

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

    /* ===== RADIO PILLS ===== */
    .radio-group { display: flex; gap: 10px; flex-wrap: wrap; }
    .radio-pill input[type="radio"] { display: none; }
    .radio-pill label {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 9px 20px;
        border: 1.5px solid #E5E7EB; border-radius: 50px;
        font-size: 0.875rem; font-weight: 500; color: #6B7280;
        cursor: pointer; background: #FAFAFA; transition: all 0.15s;
    }
    .radio-pill label i { font-size: 1rem; }
    .radio-pill.pill-laki label i      { color: #3B5BDB; }
    .radio-pill.pill-perempuan label i { color: #e879a0; }
    .radio-pill input[type="radio"]:checked + label {
        border-color: #1a2744; background: #f0f3fa; color: #1a2744;
    }
    .radio-pill.pill-laki input[type="radio"]:checked + label i      { color: #3B5BDB; }
    .radio-pill.pill-perempuan input[type="radio"]:checked + label i  { color: #e879a0; }
    .radio-pill label:hover { border-color: #1a2744; color: #1a2744; }

    /* ===== STATUS GRID ===== */
    .status-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
    .status-option input[type="radio"] { display: none; }
    .status-option label {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 8px; padding: 16px 10px;
        border: 1.5px solid #E5E7EB; border-radius: 12px;
        font-size: 0.8rem; font-weight: 600; color: #6B7280;
        cursor: pointer; background: #FAFAFA;
        transition: all 0.15s; text-align: center;
        position: relative; overflow: hidden;
    }
    .status-option label .status-icon {
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem; transition: all 0.15s;
    }
    .status-option.opt-aktif     label .status-icon { background: #dcfce7; color: #16a34a; }
    .status-option.opt-pindah    label .status-icon { background: #e0f2fe; color: #0284c7; }
    .status-option.opt-meninggal label .status-icon { background: #f3f4f6; color: #6B7280; }

    .status-option label::after {
        content: ''; position: absolute;
        bottom: 0; left: 0; right: 0; height: 3px;
        background: transparent; transition: background 0.15s;
        border-radius: 0 0 12px 12px;
    }

    .status-option.opt-aktif input[type="radio"]:checked + label {
        border-color: #16a34a; background: #f0fdf4; color: #16a34a;
    }
    .status-option.opt-aktif input[type="radio"]:checked + label::after { background: #16a34a; }
    .status-option.opt-aktif input[type="radio"]:checked + label .status-icon {
        background: #16a34a; color: #fff;
    }

    .status-option.opt-pindah input[type="radio"]:checked + label {
        border-color: #0284c7; background: #f0f9ff; color: #0284c7;
    }
    .status-option.opt-pindah input[type="radio"]:checked + label::after { background: #0284c7; }
    .status-option.opt-pindah input[type="radio"]:checked + label .status-icon {
        background: #0284c7; color: #fff;
    }

    .status-option.opt-meninggal input[type="radio"]:checked + label {
        border-color: #6B7280; background: #f9fafb; color: #374151;
    }
    .status-option.opt-meninggal input[type="radio"]:checked + label::after { background: #6B7280; }
    .status-option.opt-meninggal input[type="radio"]:checked + label .status-icon {
        background: #6B7280; color: #fff;
    }

    .status-option label:hover { border-color: #1a2744; color: #1a2744; }

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
        .status-grid { grid-template-columns: repeat(3, 1fr); }
    }
</style>
@endsection

@section('content')

<div class="page-wrapper">

    {{-- Kembali --}}
    <div class="mb-3">
        <a href="{{ route('jemaat.index') }}" class="btn-back">
            <i class="bi bi-arrow-left-circle-fill"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- Page Header --}}
    <div class="page-header mb-4">
        <div class="page-header-dots"></div>
        <div class="page-header-lines"></div>
        <div class="page-header-circle"></div>
        <span class="page-header-cross">✝</span>
        <div class="page-header-badge">
            <i class="bi bi-people-fill" style="font-size:11px"></i>
            Data Jemaat
        </div>
        <h4>Edit Data Jemaat</h4>
        <p>Perbarui informasi data jemaat di bawah ini.</p>
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
            <form action="{{ route('jemaat.update', $jemaat->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Identitas --}}
                <div class="field-section">
                    <div class="section-label">Identitas</div>

                    <div class="mb-3">
                        <label for="nama_jemaat" class="form-label fw-semibold small">Nama Lengkap Jemaat</label>
                        <div class="input-group-icon">
                            <i class="bi bi-person-circle input-icon icon-nama"></i>
                            <input type="text"
                                   class="form-control @error('nama_jemaat') is-invalid @enderror"
                                   id="nama_jemaat" name="nama_jemaat"
                                   value="{{ old('nama_jemaat', $jemaat->nama_jemaat) }}"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>
                        @error('nama_jemaat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Jenis Kelamin</label>
                        <div class="radio-group">
                            <div class="radio-pill pill-laki">
                                <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki"
                                    {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }} required>
                                <label for="laki">
                                    <i class="bi bi-gender-male"></i> Laki-laki
                                </label>
                            </div>
                            <div class="radio-pill pill-perempuan">
                                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                                    {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }}>
                                <label for="perempuan">
                                    <i class="bi bi-gender-female"></i> Perempuan
                                </label>
                            </div>
                        </div>
                        @error('jenis_kelamin')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="form-label fw-semibold small">Tanggal Lahir</label>
                        <div class="input-group-icon">
                            <i class="bi bi-calendar3 input-icon icon-tgl"></i>
                            <input type="date"
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   id="tanggal_lahir" name="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', $jemaat->tanggal_lahir) }}" required>
                        </div>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kontak & Alamat --}}
                <div class="field-section">
                    <div class="section-label">Kontak & Alamat</div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label fw-semibold small">No. Telepon / WA</label>
                        <div class="input-group-icon">
                            <i class="bi bi-telephone-fill input-icon icon-phone"></i>
                            <input type="text"
                                   class="form-control @error('telepon') is-invalid @enderror"
                                   id="telepon" name="telepon"
                                   value="{{ old('telepon', $jemaat->telepon) }}"
                                   placeholder="Contoh: 081234567890" required>
                        </div>
                        @error('telepon')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat" class="form-label fw-semibold small">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat" rows="3"
                                  placeholder="Masukkan alamat lengkap jemaat" required>{{ old('alamat', $jemaat->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Status Jemaat --}}
                <div class="field-section">
                    <div class="section-label">Status Jemaat</div>

                    <div class="status-grid">
                        <div class="status-option opt-aktif">
                            <input type="radio" id="aktif" name="status" value="Aktif"
                                {{ old('status', $jemaat->status) == 'Aktif' ? 'checked' : '' }} required>
                            <label for="aktif">
                                <div class="status-icon"><i class="bi bi-check-circle-fill"></i></div>
                                Aktif
                            </label>
                        </div>
                        <div class="status-option opt-pindah">
                            <input type="radio" id="pindah" name="status" value="Pindah"
                                {{ old('status', $jemaat->status) == 'Pindah' ? 'checked' : '' }}>
                            <label for="pindah">
                                <div class="status-icon"><i class="bi bi-box-arrow-right"></i></div>
                                Pindah
                            </label>
                        </div>
                        <div class="status-option opt-meninggal">
                            <input type="radio" id="meninggal" name="status" value="Meninggal"
                                {{ old('status', $jemaat->status) == 'Meninggal' ? 'checked' : '' }}>
                            <label for="meninggal">
                                <div class="status-icon"><i class="bi bi-moon-stars-fill"></i></div>
                                Meninggal
                            </label>
                        </div>
                    </div>
                    @error('status')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-actions">
                    <a href="{{ route('jemaat.index') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle-fill"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle-fill"></i>Perbarui Data
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection