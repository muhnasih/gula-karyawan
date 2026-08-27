@extends('layouts.app')

@section('title', 'Pengaturan Jatah Gula')

@section('content')

<style>
    /* =========================================================
       PENGATURAN JATAH GULA - REDESIGN
    ========================================================== */

    .jatah-page {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    /* =========================================================
       HEADER
    ========================================================== */

    .jatah-page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 28px;
    }

    .jatah-page-title {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .jatah-page-description {
        margin: 8px 0 0;
        color: #6b7280;
        font-size: 15px;
        line-height: 1.55;
        max-width: 520px;
    }

    /* =========================================================
       SUMMARY CARDS
    ========================================================== */

    .jatah-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .jatah-summary-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px 22px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: all 0.25s ease;
    }

    .jatah-summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        border-color: #d1d5db;
    }

    .jatah-summary-icon {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .jatah-summary-icon.total {
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        color: #374151;
    }

    .jatah-summary-icon.aktif {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #047857;
    }

    .jatah-summary-icon.nonaktif {
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        color: #6b7280;
    }

    .jatah-summary-label {
        font-size: 13px;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 2px;
    }

    .jatah-summary-value {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        line-height: 1.15;
        letter-spacing: -0.3px;
    }

    /* =========================================================
       MAIN CARD
    ========================================================== */

    .jatah-main-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .jatah-main-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 22px 24px;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .jatah-main-title {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #111827;
    }

    .jatah-main-subtitle {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .jatah-main-body {
        padding: 24px;
    }

    /* =========================================================
       GRID
    ========================================================== */

    .jatah-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    /* =========================================================
       ITEM CARD
    ========================================================== */

    .jatah-item {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        padding: 20px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        transition: all 0.25s ease;
    }

    .jatah-item:hover {
        transform: translateY(-3px);
        border-color: #d1d5db;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
    }

    .jatah-item.punya-jatah {
        border-top: 3px solid #10b981;
    }

    .jatah-item.tidak-punya-jatah {
        border-top: 3px solid #9ca3af;
    }

    /* =========================================================
       CARD HEADER
    ========================================================== */

    .jatah-item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px;
    }

    .jatah-item-label {
        margin-bottom: 5px;
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.07em;
    }

    .jatah-item-status {
        font-size: 17px;
        font-weight: 700;
        color: #111827;
        line-height: 1.3;
        word-break: break-word;
    }

    /* =========================================================
       BADGE
    ========================================================== */

    .jatah-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        flex-shrink: 0;
        padding: 6px 11px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        letter-spacing: 0.01em;
    }

    .jatah-badge.success {
        color: #065f46;
        background: #d1fae5;
    }

    .jatah-badge.secondary {
        color: #4b5563;
        background: #f3f4f6;
    }

    /* =========================================================
       INPUT
    ========================================================== */

    .jatah-input-label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .jatah-input-group {
        display: flex;
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
    }

    .jatah-input {
        min-width: 0;
        height: 46px;
        font-size: 16px;
        font-weight: 700;
        text-align: center;
        border: 1px solid #d1d5db;
        border-right: none;
        background: #fff;
        color: #111827;
        border-radius: 10px 0 0 10px !important;
    }

    .jatah-input:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        outline: none;
        z-index: 2;
    }

    .jatah-input-unit {
        height: 46px;
        display: flex;
        align-items: center;
        padding: 0 14px;
        background: #f9fafb;
        color: #4b5563;
        font-size: 13px;
        font-weight: 700;
        border: 1px solid #d1d5db;
        border-left: none;
        border-right: none;
    }

    .jatah-save-btn {
        width: 48px;
        height: 46px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #10b981;
        color: #fff;
        border-radius: 0 10px 10px 0 !important;
        transition: all 0.2s ease;
    }

    .jatah-save-btn:hover {
        background: #059669;
        color: #fff;
    }

    .jatah-save-btn:active {
        transform: scale(0.96);
    }

    /* =========================================================
       INFO
    ========================================================== */

    .jatah-info {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px dashed #e5e7eb;
        color: #6b7280;
        font-size: 12.5px;
        line-height: 1.5;
    }

    .jatah-info strong {
        color: #111827;
        font-weight: 700;
    }

    .jatah-info i {
        margin-top: 1px;
        flex-shrink: 0;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .jatah-empty {
        grid-column: 1 / -1;
        padding: 60px 24px;
        text-align: center;
    }

    .jatah-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fef3c7;
        color: #b45309;
        font-size: 28px;
    }

    .jatah-empty-title {
        margin-bottom: 8px;
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    .jatah-empty-text {
        max-width: 420px;
        margin: 0 auto;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.65;
    }

    /* =========================================================
       ALERT
    ========================================================== */

    .jatah-alert {
        border: 0;
        border-radius: 12px;
        font-size: 14px;
        padding: 14px 18px;
    }

    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 991.98px) {
        .jatah-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .jatah-page-title {
            font-size: 24px;
        }
    }

    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 767.98px) {
        .jatah-page-header {
            margin-bottom: 22px;
        }

        .jatah-page-title {
            font-size: 22px;
        }

        .jatah-page-description {
            font-size: 14px;
        }

        .jatah-summary {
            grid-template-columns: 1fr;
            gap: 12px;
            margin-bottom: 22px;
        }

        .jatah-summary-card {
            padding: 16px 18px;
        }

        .jatah-summary-icon {
            width: 44px;
            height: 44px;
            font-size: 20px;
        }

        .jatah-summary-value {
            font-size: 22px;
        }

        .jatah-main-header {
            padding: 18px 18px;
        }

        .jatah-main-body {
            padding: 16px;
        }

        .jatah-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .jatah-item {
            padding: 18px;
        }

        .jatah-item:hover {
            transform: none;
        }

        .jatah-item-status {
            font-size: 16px;
        }
    }

    /* =========================================================
       SMALL MOBILE
    ========================================================== */

    @media (max-width: 400px) {
        .jatah-page-title {
            font-size: 20px;
        }

        .jatah-item-header {
            gap: 8px;
        }

        .jatah-item-status {
            font-size: 15px;
        }

        .jatah-badge {
            padding: 5px 9px;
            font-size: 10px;
        }

        .jatah-main-body {
            padding: 12px;
        }

        .jatah-item {
            padding: 16px;
        }
    }
</style>


<div class="jatah-page">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="jatah-page-header">
        <div>
            <h1 class="jatah-page-title">Pengaturan Jatah Gula</h1>
            <p class="jatah-page-description">
                Atur jumlah jatah gula yang diterima karyawan berdasarkan status mereka.
            </p>
        </div>
    </div>


    {{-- =========================================================
        ALERT SUCCESS
    ========================================================== --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm jatah-alert mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- =========================================================
        VALIDATION ERROR
    ========================================================== --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm jatah-alert mb-4">
            <div class="fw-semibold mb-1">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Terjadi kesalahan
            </div>
            <ul class="mb-0 ps-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}
    @php
        $totalStatus = $aturanJatahGula->count();
        $statusDapatGula = $aturanJatahGula->where('jumlah_gula', '>', 0)->count();
        $statusTidakDapatGula = $aturanJatahGula->where('jumlah_gula', '=', 0)->count();
    @endphp

    <div class="jatah-summary">
        {{-- TOTAL --}}
        <div class="jatah-summary-card">
            <div class="jatah-summary-icon total">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="jatah-summary-label">Total Status</div>
                <div class="jatah-summary-value">{{ $totalStatus }}</div>
            </div>
        </div>

        {{-- MENDAPAT GULA --}}
        <div class="jatah-summary-card">
            <div class="jatah-summary-icon aktif">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <div class="jatah-summary-label">Mendapat Gula</div>
                <div class="jatah-summary-value">{{ $statusDapatGula }}</div>
            </div>
        </div>

        {{-- TIDAK MENDAPAT --}}
        <div class="jatah-summary-card">
            <div class="jatah-summary-icon nonaktif">
                <i class="bi bi-dash-circle-fill"></i>
            </div>
            <div>
                <div class="jatah-summary-label">Tidak Mendapat</div>
                <div class="jatah-summary-value">{{ $statusTidakDapatGula }}</div>
            </div>
        </div>
    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="jatah-main-card">
        <div class="jatah-main-header">
            <div>
                <h2 class="jatah-main-title">Daftar Aturan Jatah</h2>
                <p class="jatah-main-subtitle">
                    Ubah jumlah jatah, lalu klik tombol simpan pada masing-masing status.
                </p>
            </div>
        </div>

        <div class="jatah-main-body">
            <div class="jatah-grid">
                @forelse ($aturanJatahGula as $aturan)
                    <form
                        action="{{ route('admin.jatah-gula.update') }}"
                        method="POST"
                        class="jatah-item {{ $aturan->jumlah_gula > 0 ? 'punya-jatah' : 'tidak-punya-jatah' }}"
                    >
                        @csrf

                        <input type="hidden" name="status" value="{{ $aturan->status }}">

                        {{-- HEADER CARD --}}
                        <div class="jatah-item-header">
                            <div>
                                <div class="jatah-item-label">Status Karyawan</div>
                                <div class="jatah-item-status">{{ $aturan->status }}</div>
                            </div>

                            @if ($aturan->jumlah_gula > 0)
                                <span class="jatah-badge success">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Dapat Gula
                                </span>
                            @else
                                <span class="jatah-badge secondary">
                                    <i class="bi bi-dash-circle-fill"></i>
                                    Tidak Dapat
                                </span>
                            @endif
                        </div>

                        {{-- INPUT --}}
                        <label for="jumlahGula{{ $aturan->id }}" class="jatah-input-label">
                            Jumlah Jatah Gula
                        </label>

                        <div class="jatah-input-group">
                            <input
                                type="number"
                                id="jumlahGula{{ $aturan->id }}"
                                name="jumlah_gula"
                                value="{{ $aturan->jumlah_gula }}"
                                class="form-control jatah-input"
                                min="0"
                                max="1000"
                                step="1"
                                required
                            >

                            <span class="jatah-input-unit">KG</span>

                            <button
                                type="submit"
                                class="jatah-save-btn"
                                title="Simpan jatah gula"
                            >
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </div>

                        {{-- INFO --}}
                        <div class="jatah-info">
                            @if ($aturan->jumlah_gula > 0)
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>
                                    Jatah saat ini:
                                    <strong>{{ $aturan->jumlah_gula }} KG</strong>
                                </span>
                            @else
                                <i class="bi bi-info-circle"></i>
                                <span>Status ini tidak mendapatkan jatah gula.</span>
                            @endif
                        </div>
                    </form>
                @empty
                    <div class="jatah-empty">
                        <div class="jatah-empty-icon">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <div class="jatah-empty-title">Belum Ada Aturan Jatah</div>
                        <p class="jatah-empty-text">
                            Belum terdapat aturan jatah gula berdasarkan status karyawan.
                            Aturan akan muncul setelah status karyawan tersedia.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection  