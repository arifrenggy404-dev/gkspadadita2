@extends('public.layouts.app')

@section('title', 'Pendaftaran Katekesasi')

@section('styles')
<style>
    /* ── Hero ── */
    .hero-daftar {
        background: linear-gradient(135deg, #1a3c6e 0%, #2563eb 100%);
        color: white;
        padding: 60px 0 50px;
    }
    .hero-daftar h1 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }
    .hero-daftar p {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.75);
        margin-bottom: 0;
    }
    .hero-daftar .breadcrumb-item a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
    }
    .hero-daftar .breadcrumb-item a:hover { color: white; }
    .hero-daftar .breadcrumb-item.active { color: rgba(255,255,255,0.55); }
    .hero-daftar .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

    /* ── Form Card ── */
    .daftar-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        overflow: hidden;
        border: none;
    }
    .daftar-card-header {
        background: linear-gradient(135deg, #1a3c6e, #2563eb);
        color: white;
        padding: 20px 28px;
    }
    .daftar-card-header h5 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
    }
    .daftar-card-body { padding: 32px 28px; }

    /* ── Section Label ── */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        margin-top: 8px;
    }
    .section-divider span {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #2563eb;
        white-space: nowrap;
    }
    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    /* ── Form Controls ── */
    .form-label {
        font-size: 0.825rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }
    .form-control,
    .form-select {
        font-size: 0.9rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        background: #fafafa;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
        background: white;
        outline: none;
    }
    .form-control::placeholder { color: #b0b7c3; }
    textarea.form-control { resize: vertical; min-height: 90px; }

    /* ── Radio Pills ── */
    .radio-group { display: flex; gap: 10px; flex-wrap: wrap; }
    .radio-pill input[type="radio"] { display: none; }
    .radio-pill label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 20px;
        border: 1.5px solid #e5e7eb;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        cursor: pointer;
        background: #fafafa;
        transition: all 0.15s;
        user-select: none;
    }
    .radio-pill input[type="radio"]:checked + label {
        border-color: #2563eb;
        background: #eff6ff;
        color: #2563eb;
    }
    .radio-pill label:hover { border-color: #2563eb; color: #2563eb; }

    /* ── Radio Pills Jenis Katekesasi ── */
    .radio-group-jenis { display: flex; gap: 10px; flex-wrap: wrap; }
    .radio-pill-jenis input[type="radio"] { display: none; }
    .radio-pill-jenis label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 16px 20px;
        border: 1.5px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #6b7280;
        cursor: pointer;
        background: #fafafa;
        transition: all 0.15s;
        text-align: center;
        flex: 1;
        min-width: 110px;
        user-select: none;
    }
    .radio-pill-jenis label i { font-size: 1.4rem; }
    .radio-pill-jenis input[type="radio"]:checked + label {
        border-color: #2563eb;
        background: #eff6ff;
        color: #2563eb;
    }
    .radio-pill-jenis label:hover { border-color: #2563eb; color: #2563eb; }

    @media (max-width: 575.98px) {
        .radio-group-jenis { flex-direction: column; }
        .radio-pill-jenis label { flex-direction: row; justify-content: flex-start; }
    }

    /* ── Info Box ── */
    .info-box {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 16px 18px;
        font-size: 0.85rem;
        color: #1e40af;
    }
    .info-box i { font-size: 1rem; }

    /* ── Submit Button ── */
    .btn-daftar {
        background: linear-gradient(135deg, #1a3c6e, #2563eb);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: opacity 0.2s, transform 0.1s;
        width: 100%;
        justify-content: center;
    }
    .btn-daftar:hover { opacity: 0.88; color: white; }
    .btn-daftar:active { transform: scale(0.98); }

    @media (max-width: 575.98px) {
        .hero-daftar h1 { font-size: 1.5rem; }
        .hero-daftar { padding: 40px 0 32px; }
        .daftar-card-body { padding: 24px 18px; }
    }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="hero-daftar">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0" style="background:none; padding:0;">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pendaftaran Katekesasi</li>
            </ol>
        </nav>
        <h1><i class="bi bi-journal-bookmark-fill me-2"></i>Pendaftaran Katekesasi</h1>
        <p>Isi formulir di bawah ini untuk mendaftar program katekesasi jemaat</p>
    </div>
</section>

{{-- Konten --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                {{-- Alert Sukses --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Info Box --}}
                <div class="info-box mb-4">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Pastikan semua data yang diisi sudah benar. Panitia akan menghubungi Anda melalui nomor telepon yang didaftarkan.
                </div>

                {{-- Form Card --}}
                <div class="daftar-card">
                    <div class="daftar-card-header">
                        <h5><i class="bi bi-pencil-square me-2"></i>Formulir Pendaftaran Katekesasi</h5>
                    </div>
                    <div class="daftar-card-body">

                        {{-- Error Global --}}
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" role="alert">
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

                        <form action="{{ route('user.simpan-pendaftaran') }}" method="POST">
                            @csrf

                            {{-- Jenis Katekesasi --}}
                            <div class="section-divider"><span>Jenis Katekesasi</span></div>

                            <div class="mb-4">
                                <label class="form-label">
                                    Pilih Jenis Katekesasi <span class="text-danger">*</span>
                                </label>
                                <div class="radio-group-jenis">
                                    <div class="radio-pill-jenis">
                                        <input type="radio" id="baptis"  name="katekesasi" value="Baptis" 
                                        {{ old('katekesasi') == 'Baptis' ? 'checked' : '' }} required>
                                       <label for="baptis">
                                            <i class="bi bi-droplet-fill"></i>
                                            Baptis
                                        </label>
                                    </div>
                                    <div class="radio-pill-jenis">
                                        <input type="radio" id="sidi"    name="katekesasi" value="Sidi"   
                                        {{ old('katekesasi') == 'Sidi'   ? 'checked' : '' }}>
                                        <label for="sidi">
                                            <i class="bi bi-patch-check-fill"></i>
                                            Sidi
                                        </label>
                                    </div>
                                    <div class="radio-pill-jenis">
                                        <input type="radio" id="nikah"   name="katekesasi" value="Nikah"  
                                        {{ old('katekesasi') == 'Nikah'  ? 'checked' : '' }}>
                                       <label for="nikah">
                                            <i class="bi bi-heart-fill"></i>
                                            Nikah
                                        </label>
                                    </div>
                                </div>
                                @error('jenis_katekesasi')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Data Diri --}}
                            <div class="section-divider"><span>Data Diri</span></div>

                            {{-- Nama Lengkap --}}
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control @error('nama_lengkap') is-invalid @enderror"
                                       id="nama_lengkap" name="nama_lengkap"
                                       value="{{ old('nama_lengkap') }}"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tempat & Tanggal Lahir --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="tempat_lahir" class="form-label">
                                        Tempat Lahir <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('tempat_lahir') is-invalid @enderror"
                                           id="tempat_lahir" name="tempat_lahir"
                                           value="{{ old('tempat_lahir') }}"
                                           placeholder="Contoh: Manado"
                                           required>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="tanggal_lahir" class="form-label">
                                        Tanggal Lahir <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                           id="tanggal_lahir" name="tanggal_lahir"
                                           value="{{ old('tanggal_lahir') }}"
                                           required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <div class="radio-group">
                                    <div class="radio-pill">
                                        <input type="radio" id="laki" name="jenis_kelamin" value="L"
                                            {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                                        <label for="laki">
                                            <i class="bi bi-gender-male"></i> Laki-laki
                                        </label>
                                    </div>
                                    <div class="radio-pill">
                                        <input type="radio" id="perempuan" name="jenis_kelamin" value="P"
                                            {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                        <label for="perempuan">
                                            <i class="bi bi-gender-female"></i> Perempuan
                                        </label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label for="alamat" class="form-label">
                                    Alamat Lengkap <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          id="alamat" name="alamat"
                                          rows="3"
                                          placeholder="Jl. Contoh No. 1, Kelurahan, Kecamatan, Kota"
                                          required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kontak & Orang Tua --}}
                            <div class="section-divider"><span>Kontak & Orang Tua</span></div>

                            {{-- No Telepon & Nama Orang Tua --}}
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="no_telepon" class="form-label">
                                        No. Telepon / WA <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('no_telepon') is-invalid @enderror"
                                           id="telepon" name="telepon"
                                           value="{{ old('no_telepon') }}"
                                           placeholder="08xxxxxxxxxx"
                                           required>
                                    @error('no_telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="nama_ayah" class="form-label">
                                        Nama Ayah <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('nama_ayah') is-invalid @enderror"
                                           id="nama_ayah" name="nama_ayah"
                                           value="{{ old('nama_ayah') }}"
                                           placeholder="Nama Ayah"
                                           required>
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="nama_ibu" class="form-label">
                                        Nama Ibu <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('nama_ibu') is-invalid @enderror"
                                           id="nama_ibu" name="nama_ibu"
                                           value="{{ old('nama_ibu') }}"
                                           placeholder="Nama ibu"
                                           required>
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                    

                            {{-- Tombol Submit --}}
                            <button type="submit" class="btn-daftar">
                                <i class="bi bi-send-fill"></i> Kirim Pendaftaran
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection