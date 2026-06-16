@extends('admin.layouts.admin')

@section('title', 'Tambah Jadwal Ibadah')

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
        transform: translateY(-50%); font-size: 1rem; pointer-events: none; z-index: 5;
    }
    .input-group-icon .form-control,
    .input-group-icon .form-select { padding-left: 38px; }

    .icon-tema    { color: #3B5BDB; }
    .icon-pelayan { color: #7c3aed; }
    .icon-tanggal { color: #0891b2; }
    .icon-jam     { color: #d97706; }
    .icon-tempat  { color: #16a34a; }
    .icon-ket     { color: #6B7280; }

    /* ===== CUSTOM SELECT ===== */
    .cs-wrapper { position: relative; }

    .cs-trigger {
        width: 100%;
        display: flex; align-items: center; justify-content: space-between;
        border: 1px solid #E5E7EB; border-radius: 9px;
        padding: 7px 12px 7px 38px;
        font-size: 0.9rem; background: #fff;
        cursor: pointer; user-select: none;
        transition: border-color 0.15s, box-shadow 0.15s;
        color: #1a2744; min-height: 38px;
    }
    .cs-trigger.placeholder { color: #9CA3AF; }
    .cs-trigger:focus { outline: none; border-color: #1a2744; box-shadow: 0 0 0 3px rgba(26,39,68,0.08); }
    .cs-trigger.open {
        border-color: #1a2744;
        box-shadow: 0 0 0 3px rgba(26,39,68,0.08);
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .cs-trigger.is-invalid { border-color: #dc3545; }
    .cs-chevron {
        font-size: 0.75rem; color: #9CA3AF;
        transition: transform 0.2s;
        flex-shrink: 0; margin-left: 8px;
    }
    .cs-trigger.open .cs-chevron { transform: rotate(180deg); }

    .cs-dropdown {
        display: none;
        position: absolute; top: 100%; left: 0; right: 0;
        background: #fff;
        border: 1px solid #1a2744; border-top: none;
        border-bottom-left-radius: 9px; border-bottom-right-radius: 9px;
        box-shadow: 0 8px 24px rgba(26,39,68,0.12);
        z-index: 999; overflow: hidden;
    }
    .cs-dropdown.open { display: block; }

    .cs-search-box {
        position: relative;
        border-bottom: 1px solid #E5E7EB;
        background: #FAFAFA;
    }
    .cs-search-box::before {
        content: '\F52A'; font-family: 'bootstrap-icons';
        position: absolute; left: 11px; top: 50%;
        transform: translateY(-50%);
        font-size: 0.85rem; color: #9CA3AF;
        pointer-events: none; z-index: 2;
    }
    .cs-search-box input {
        width: 100%; border: none; outline: none;
        padding: 9px 12px 9px 32px;
        font-size: 0.875rem; background: transparent;
        color: #1a2744; display: block;
    }
    .cs-search-box input::placeholder { color: #9CA3AF; }
    .cs-search-box input:focus { background: #f0f3fa; }

    .cs-options {
        max-height: 200px; overflow-y: auto;
        padding: 4px 0;
    }
    .cs-option {
        padding: 9px 14px; font-size: 0.875rem;
        cursor: pointer; color: #1a2744;
        transition: background 0.1s;
    }
    .cs-option:hover, .cs-option.focused { background: #f0f3fa; }
    .cs-option.selected { font-weight: 600; }
    .cs-option.hidden { display: none; }
    .cs-no-results {
        padding: 9px 14px; font-size: 0.875rem;
        color: #9CA3AF; display: none;
    }

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
        <a href="{{ route('ibadah.index') }}" class="btn-back">
            <i class="bi bi-arrow-left-circle-fill"></i> Kembali ke Jadwal
        </a>
    </div>

    {{-- Page Header --}}
    <div class="page-header mb-4">
        <div class="page-header-dots"></div>
        <div class="page-header-lines"></div>
        <div class="page-header-circle"></div>
        <span class="page-header-cross">✝</span>
        <div class="page-header-badge">
            <i class="bi bi-calendar-week" style="font-size:11px"></i>
            Jadwal Ibadah
        </div>
        <h4>Tambah Jadwal Ibadah Baru</h4>
        <p>Isi data lengkap jadwal ibadah baru di bawah ini.</p>
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
            <form action="{{ route('ibadah.store') }}" method="POST">
                @csrf

                {{-- Informasi Ibadah --}}
                <div class="field-section">
                    <div class="section-label">Informasi Ibadah</div>

                    <div class="mb-3">
                        <label for="tema" class="form-label fw-semibold small">Tema Ibadah</label>
                        <div class="input-group-icon">
                            <i class="bi bi-bookmark-fill input-icon icon-tema"></i>
                            <input type="text"
                                   class="form-control @error('tema') is-invalid @enderror"
                                   id="tema" name="tema"
                                   value="{{ old('tema') }}"
                                   placeholder="Contoh: Ibadah Minggu Pagi" required>
                        </div>
                        @error('tema')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label fw-semibold small">Pelayan</label>

                        {{-- Hidden input untuk dikirim ke server --}}
                        <input type="hidden" name="pelayan" id="pelayan-value"
                               value="{{ old('pelayan') }}">

                        <div class="input-group-icon">
                            <i class="bi bi-person-badge-fill input-icon icon-pelayan"></i>
                            <div class="cs-wrapper">
                                <button type="button"
                                        class="cs-trigger {{ old('pelayan') ? '' : 'placeholder' }} {{ $errors->has('pelayan') ? 'is-invalid' : '' }}"
                                        id="cs-pelayan">
                                    <span class="cs-label">{{ old('pelayan') ?: '-- Pilih Pelayan --' }}</span>
                                    <i class="bi bi-chevron-down cs-chevron"></i>
                                </button>
                                <div class="cs-dropdown" id="cs-pelayan-dropdown">
                                    <div class="cs-search-box">
                                        <input type="text" placeholder="Cari pelayan..."
                                               id="cs-pelayan-search" autocomplete="off">
                                    </div>
                                    <div class="cs-options" id="cs-pelayan-options">
                                        @foreach($pelayans as $p)
                                            <div class="cs-option {{ old('pelayan') == $p->nama ? 'selected' : '' }}"
                                                 data-value="{{ $p->nama }}">
                                                {{ $p->nama }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="cs-no-results" id="cs-pelayan-noresult">Tidak ditemukan</div>
                                </div>
                            </div>
                        </div>
                        @error('pelayan')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Waktu & Lokasi --}}
                <div class="field-section">
                    <div class="section-label">Waktu & Lokasi</div>

                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="tanggal" class="form-label fw-semibold small">Tanggal</label>
                            <div class="input-group-icon">
                                <i class="bi bi-calendar3 input-icon icon-tanggal"></i>
                                <input type="date"
                                       class="form-control @error('tanggal') is-invalid @enderror"
                                       id="tanggal" name="tanggal"
                                       value="{{ old('tanggal') }}" required>
                            </div>
                            @error('tanggal')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="jam" class="form-label fw-semibold small">Waktu / Jam</label>
                            <div class="input-group-icon">
                                <i class="bi bi-clock-fill input-icon icon-jam"></i>
                                <input type="time"
                                       class="form-control @error('jam') is-invalid @enderror"
                                       id="jam" name="jam"
                                       value="{{ old('jam') }}" required>
                            </div>
                            @error('jam')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="tempat" class="form-label fw-semibold small">Tempat / Lokasi</label>
                        <div class="input-group-icon">
                            <i class="bi bi-geo-alt-fill input-icon icon-tempat"></i>
                            <input type="text"
                                   class="form-control @error('tempat') is-invalid @enderror"
                                   id="tempat" name="tempat"
                                   value="{{ old('tempat') }}"
                                   placeholder="Contoh: Gedung Utama / Aula" required>
                        </div>
                        @error('tempat')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="field-section">
                    <div class="section-label">Keterangan</div>

                    <div>
                        <label for="keterangan" class="form-label fw-semibold small">Keterangan Tambahan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan" name="keterangan"
                                  rows="3"
                                  placeholder="Contoh: Ibadah Pemuda / Pelayan Firman: Pdt. X">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-actions">
                    <a href="{{ route('ibadah.index') }}" class="btn btn-cancel">
                        <i class="bi bi-x-circle-fill"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save">
                        <i class="bi bi-check-circle-fill"></i>Simpan Jadwal
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
function makeCustomSelect(triggerId, dropdownId, searchId, optionsId, noResultId, hiddenId) {
    const trigger     = document.getElementById(triggerId);
    const dropdown    = document.getElementById(dropdownId);
    const searchInput = document.getElementById(searchId);
    const optionsCont = document.getElementById(optionsId);
    const noResult    = document.getElementById(noResultId);
    const hidden      = document.getElementById(hiddenId);
    const label       = trigger.querySelector('.cs-label');

    function openDropdown() {
        document.querySelectorAll('.cs-dropdown.open').forEach(d => {
            if (d !== dropdown) {
                d.classList.remove('open');
                d.previousElementSibling.classList.remove('open');
            }
        });
        trigger.classList.add('open');
        dropdown.classList.add('open');
        searchInput.value = '';
        filterOptions('');
        setTimeout(() => searchInput.focus(), 30);
    }

    function closeDropdown() {
        trigger.classList.remove('open');
        dropdown.classList.remove('open');
    }

    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.contains('open') ? closeDropdown() : openDropdown();
    });

    function filterOptions(keyword) {
        const q = keyword.toLowerCase().trim();
        let visibleCount = 0;
        optionsCont.querySelectorAll('.cs-option').forEach(opt => {
            const match = opt.textContent.toLowerCase().includes(q);
            opt.classList.toggle('hidden', !match);
            if (match) visibleCount++;
        });
        noResult.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', function () {
        filterOptions(this.value);
    });

    optionsCont.querySelectorAll('.cs-option').forEach(opt => {
        opt.addEventListener('click', function () {
            const val = this.dataset.value;
            label.textContent = val;
            hidden.value = val;
            trigger.classList.remove('placeholder');
            optionsCont.querySelectorAll('.cs-option').forEach(o => o.classList.remove('selected'));
            this.classList.add('selected');
            closeDropdown();
        });
    });

    document.addEventListener('click', function (e) {
        if (!trigger.contains(e.target) && !dropdown.contains(e.target)) {
            closeDropdown();
        }
    });
}

makeCustomSelect(
    'cs-pelayan', 'cs-pelayan-dropdown', 'cs-pelayan-search',
    'cs-pelayan-options', 'cs-pelayan-noresult', 'pelayan-value'
);
</script>
@endsection
@endsection