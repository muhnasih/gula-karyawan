@extends('layouts.app')

@section('title', 'Pengaturan Jatah Gula')

@section('content')

<style>
    /* =========================================================
       PENGATURAN JATAH GULA
    ========================================================== */

    .jatah-page {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================================================
       PAGE HEADER
    ========================================================== */

    .jatah-page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 24px;
    }

    .jatah-page-title {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #212529;
        letter-spacing: -0.4px;
    }

    .jatah-page-description {
        margin: 6px 0 0;
        color: #6c757d;
        font-size: 14px;
        line-height: 1.5;
    }

    /* =========================================================
       SUMMARY
    ========================================================== */

    .jatah-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .jatah-summary-card {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 16px 18px;
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .jatah-summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
    }

    .jatah-summary-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .jatah-summary-icon.total {
        background: #eef2f7;
        color: #495057;
    }

    .jatah-summary-icon.aktif {
        background: #e9f7ef;
        color: #198754;
    }

    .jatah-summary-icon.nonaktif {
        background: #f1f3f5;
        color: #6c757d;
    }

    .jatah-summary-label {
        font-size: 12px;
        color: #6c757d;
        margin-bottom: 2px;
    }

    .jatah-summary-value {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
        line-height: 1.2;
    }

    /* =========================================================
       MAIN CARD
    ========================================================== */

    .jatah-main-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 14px;
        overflow: hidden;
    }

    .jatah-main-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 18px 20px;
        border-bottom: 1px solid #edf0f2;
    }

    .jatah-main-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #212529;
    }

    .jatah-main-subtitle {
        margin: 3px 0 0;
        color: #6c757d;
        font-size: 12px;
    }

    .jatah-main-body {
        padding: 20px;
    }

    /* =========================================================
       GRID
    ========================================================== */

    .jatah-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    /* =========================================================
       ITEM / CARD
    ========================================================== */

    .jatah-item {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        padding: 18px;
        background: #f8f9fa;
        border: 1px solid #e7eaed;
        border-radius: 12px;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-color 0.2s ease;
    }

    .jatah-item:hover {
        transform: translateY(-2px);
        border-color: #d9dee3;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .jatah-item.punya-jatah {
        border-top: 3px solid #198754;
    }

    .jatah-item.tidak-punya-jatah {
        border-top: 3px solid #adb5bd;
    }

    /* =========================================================
       CARD HEADER
    ========================================================== */

    .jatah-item-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 18px;
    }

    .jatah-item-label {
        margin-bottom: 4px;
        font-size: 10px;
        font-weight: 700;
        color: #8a9299;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .jatah-item-status {
        font-size: 16px;
        font-weight: 700;
        color: #212529;
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
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .jatah-badge.success {
        color: #146c43;
        background: #d1e7dd;
    }

    .jatah-badge.secondary {
        color: #5c636a;
        background: #e9ecef;
    }

    /* =========================================================
       INPUT
    ========================================================== */

    .jatah-input-label {
        display: block;
        margin-bottom: 7px;
        font-size: 12px;
        font-weight: 600;
        color: #495057;
    }

    .jatah-input-group {
        display: flex;
        width: 100%;
    }

    .jatah-input {
        min-width: 0;
        height: 42px;
        font-size: 15px;
        font-weight: 700;
        text-align: center;
        border-color: #ced4da;
        background: #fff;
    }

    .jatah-input:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.12);
    }

    .jatah-input-unit {
        height: 42px;
        display: flex;
        align-items: center;
        padding: 0 12px;
        background: #f1f3f5;
        color: #495057;
        font-size: 12px;
        font-weight: 700;
        border-color: #ced4da;
    }

    .jatah-save-btn {
        width: 44px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0 6px 6px 0;
    }

    /* =========================================================
       INFO
    ========================================================== */

    .jatah-info {
        display: flex;
        align-items: flex-start;
        gap: 6px;
        margin-top: 12px;
        padding-top: 11px;
        border-top: 1px dashed #dee2e6;
        color: #6c757d;
        font-size: 11px;
        line-height: 1.45;
    }

    .jatah-info strong {
        color: #495057;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .jatah-empty {
        padding: 45px 20px;
        text-align: center;
    }

    .jatah-empty-icon {
        width: 54px;
        height: 54px;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fff3cd;
        color: #856404;
        font-size: 23px;
    }

    .jatah-empty-title {
        margin-bottom: 5px;
        font-size: 16px;
        font-weight: 700;
        color: #343a40;
    }

    .jatah-empty-text {
        max-width: 500px;
        margin: 0 auto;
        color: #6c757d;
        font-size: 13px;
        line-height: 1.6;
    }

    /* =========================================================
       ALERT
    ========================================================== */

    .jatah-alert {
        border: 0;
        border-radius: 10px;
        font-size: 13px;
    }

    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 991.98px) {

        .jatah-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .jatah-summary {
            grid-template-columns: repeat(3, 1fr);
        }

        .jatah-page-title {
            font-size: 23px;
        }
    }

    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 767.98px) {

        .jatah-page-header {
            margin-bottom: 18px;
        }

        .jatah-page-title {
            font-size: 21px;
        }

        .jatah-page-description {
            font-size: 13px;
        }

        .jatah-summary {
            grid-template-columns: 1fr;
            gap: 9px;
            margin-bottom: 18px;
        }

        .jatah-summary-card {
            padding: 13px 15px;
        }

        .jatah-summary-icon {
            width: 38px;
            height: 38px;
            font-size: 17px;
        }

        .jatah-summary-value {
            font-size: 18px;
        }

        .jatah-main-header {
            padding: 15px;
        }

        .jatah-main-body {
            padding: 12px;
        }

        .jatah-grid {
            grid-template-columns: 1fr;
            gap: 11px;
        }

        .jatah-item {
            padding: 15px;
        }

        .jatah-item:hover {
            transform: none;
        }

        .jatah-item-status {
            font-size: 15px;
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
            gap: 7px;
        }

        .jatah-item-status {
            font-size: 14px;
        }

        .jatah-badge {
            padding: 4px 7px;
            font-size: 9px;
        }

        .jatah-main-body {
            padding: 9px;
        }

        .jatah-item {
            padding: 13px;
        }
    }
</style>


<div class="jatah-page">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="jatah-page-header">

        <div>
            <h1 class="jatah-page-title">
                Pengaturan Jatah Gula
            </h1>

            <p class="jatah-page-description">
                Atur jumlah jatah gula yang diterima berdasarkan status karyawan.
            </p>
        </div>

    </div>


    {{-- =========================================================
        ALERT SUCCESS
    ========================================================== --}}
    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm jatah-alert mb-3">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERROR
    ========================================================== --}}
    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible fade show shadow-sm jatah-alert mb-3">

            <div class="fw-semibold mb-1">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Terjadi kesalahan
            </div>

            <ul class="mb-0 ps-4">

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}
    @php

        $totalStatus = $aturanJatahGula->count();

        $statusDapatGula = $aturanJatahGula
            ->where('jumlah_gula', '>', 0)
            ->count();

        $statusTidakDapatGula = $aturanJatahGula
            ->where('jumlah_gula', '=', 0)
            ->count();

    @endphp


    <div class="jatah-summary">

        {{-- TOTAL --}}
        <div class="jatah-summary-card">

            <div class="jatah-summary-icon total">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>
                <div class="jatah-summary-label">
                    Total Status
                </div>

                <div class="jatah-summary-value">
                    {{ $totalStatus }}
                </div>
            </div>

        </div>


        {{-- MENDAPAT GULA --}}
        <div class="jatah-summary-card">

            <div class="jatah-summary-icon aktif">
                <i class="bi bi-check-circle-fill"></i>
            </div>

            <div>
                <div class="jatah-summary-label">
                    Mendapat Gula
                </div>

                <div class="jatah-summary-value">
                    {{ $statusDapatGula }}
                </div>
            </div>

        </div>


        {{-- TIDAK MENDAPAT --}}
        <div class="jatah-summary-card">

            <div class="jatah-summary-icon nonaktif">
                <i class="bi bi-dash-circle-fill"></i>
            </div>

            <div>
                <div class="jatah-summary-label">
                    Tidak Mendapat
                </div>

                <div class="jatah-summary-value">
                    {{ $statusTidakDapatGula }}
                </div>
            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="jatah-main-card">

        <div class="jatah-main-header">

            <div>

                <h2 class="jatah-main-title">
                    Daftar Aturan Jatah
                </h2>

                <p class="jatah-main-subtitle">
                    Klik tombol simpan setelah mengubah jumlah jatah.
                </p>

            </div>

        </div>


        <div class="jatah-main-body">

            <div class="jatah-grid">

                @forelse ($aturanJatahGula as $aturan)

                    <form
                        action="{{ route('admin.jatah-gula.update') }}"
                        method="POST"
                        class="jatah-item
                        {{ $aturan->jumlah_gula > 0
                            ? 'punya-jatah'
                            : 'tidak-punya-jatah' }}"
                    >

                        @csrf


                        <input
                            type="hidden"
                            name="status"
                            value="{{ $aturan->status }}"
                        >


                        {{-- HEADER CARD --}}
                        <div class="jatah-item-header">

                            <div>

                                <div class="jatah-item-label">
                                    Status Karyawan
                                </div>

                                <div class="jatah-item-status">
                                    {{ $aturan->status }}
                                </div>

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
                        <label
                            for="jumlahGula{{ $aturan->id }}"
                            class="jatah-input-label"
                        >
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

                            <span class="input-group-text jatah-input-unit">
                                KG
                            </span>

                            <button
                                type="submit"
                                class="btn btn-success jatah-save-btn"
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
                                    <strong>
                                        {{ $aturan->jumlah_gula }} KG
                                    </strong>
                                </span>

                            @else

                                <i class="bi bi-info-circle"></i>

                                <span>
                                    Status ini tidak mendapatkan jatah gula.
                                </span>

                            @endif

                        </div>

                    </form>

                @empty

                    <div class="jatah-empty">

                        <div class="jatah-empty-icon">
                            <i class="bi bi-inbox"></i>
                        </div>

                        <div class="jatah-empty-title">
                            Belum Ada Aturan Jatah
                        </div>

                        <p class="jatah-empty-text">
                            Belum terdapat aturan jatah gula berdasarkan
                            status karyawan. Aturan akan muncul setelah
                            status karyawan tersedia.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection