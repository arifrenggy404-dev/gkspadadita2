@extends('admin.layouts.admin')

@section('title', 'Edit Data Pelayan')

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
    .form-card::before {
        content: ''; display: block; height: 3px;
        background: linear-gradient(90deg, #1a2744 0%, #c8a96e 50%, #1a2744 100%);
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
        border-color: #E5E7EB; border-radius: 9px;
        font-size: 0.9rem; background: #FAFBFD;
        transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #c8a96e;
        box-shadow: 0 0 0 3px rgba(200,169,110,0.12);
        background: #fff;
    }
    .input-group-icon { position: relative; }
    .input-group-icon .input-icon {
        position: absolute; top: 50%; left: 12px;
        transform: translateY(-50%); font-size: 1rem; pointer-events: none;
    }
    .input-group-icon .form-control { padding-left: 38px; }
    .icon-nama  { color: #3B5BDB; }
    .icon-phone { color: #0891b2; }

    /* Select dengan ikon kiri */
    .select-wrap { position: relative; }
    .select-wrap .select-icon {
        position: absolute; top: 50%; left: 12px;
        transform: translateY(-50%); font-size: 1rem;
        pointer-events: none; z-index: 5;
    }
    .select-wrap .form-select { padding-left: 38px; }
    .icon-status { color: #7c3aed; }
    .icon-gender { color: #e879a0; }

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
    .btn-save i { color: #c8a96e; }
    .btn-save:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }
    .btn-cancel {
        background: #F9FAFB; border: 1.5px solid #E5E7EB; color: #6B7280;
        font-weight: 500; border-radius: 9px; padding: 10px 24px;
        display: inline-flex; align-items: center; gap: 7px;
        transition: border-color 0.15s, color 0.15s;
    }
    .btn-cancel i { color: #EF4444; }
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
        <a href="{{ route('pelayan.index') }}" class="btn-back">
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
            <i class="bi bi-pencil-square" style="font-size:11px"></i>
            Edit Data Pelayan
        </div>
        <h4>Perbarui Data Pelayan</h4>
        <p>Ubah informasi pelayan yang diperlukan, lalu simpan perubahan.</p>
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
            <form action="{{ route('pelayan.update', $Pelayan->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Identitas --}}
                <div class="field-section">
                    <div class="section-label">Identitas</div>

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold small">Nama Lengkap</label>
                        <div class="input-group-icon">
                            <i class="bi bi-person-circle input-icon icon-nama"></i>
                            <input type="text"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama"
                                   value="{{ old('nama', $Pelayan->nama) }}"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>
                        @error('nama')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="form-label fw-semibold small">Jenis Kelamin</label>
                        <div class="select-wrap">
                            <i class="bi bi-gender-ambiguous select-icon icon-gender"></i>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki"  {{ old('jenis_kelamin', $Pelayan->jenis_kelamin) == 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan"  {{ old('jenis_kelamin', $Pelayan->jenis_kelamin) == 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Status Pelayanan --}}
                <div class="field-section">
                    <div class="section-label">Status Pelayanan</div>

                    <div>
                        <label for="status" class="form-label fw-semibold small">Status</label>
                        <div class="select-wrap">
                            <i class="bi bi-book-fill select-icon icon-status"></i>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="Pendeta" {{ old('status', $Pelayan->status) == 'Pendeta' ? 'selected' : '' }}>Pendeta</option>
                                <option value="Vic"     {{ old('status', $Pelayan->status) == 'Vic'     ? 'selected' : '' }}>Vic</option>
                                <option value="Majelis" {{ old('status', $Pelayan->status) == 'Majelis' ? 'selected' : '' }}>Majelis</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kontak & Alamat --}}
                <div class="field-section">
                    <div class="section-label">Kontak & Alamat</div>

                    <div class="mb-3">
                        <label for="nomor_tlpn" class="form-label fw-semibold small">No. WhatsApp / Telepon</label>
                        <div class="input-group-icon">
                            <i class="bi bi-telephone-fill input-icon icon-phone"></i>
                            <input type="text"
                                   class="form-control @error('nomor_tlpn') is-invalid @enderror"
                                   id="nomor_tlpn" name="nomor_tlpn"
                                   value="{{ old('nomor_tlpn', $Pelayan->nomor_tlpn) }}"
                                   placeholder="08xxxxxxxxxx" required>
                        </div>
                        @error('nomor_tlpn')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat" class="form-label fw-semibold small">Alamat Rumah</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat" rows="3"
                                  placeholder="Jl. Contoh No. 1, Kota..." required>{{ old('alamat', $Pelayan->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-actions">
                    <a href="{{ route('pelayan.index') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle-fill"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle-fill"></i> Perbarui Data
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection