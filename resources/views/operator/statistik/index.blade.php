@extends('layouts.app')

@section('title', 'Statistik Operator')

@section('content')

<style>
    /* =========================================================
       OPERATOR STATISTIK - CLEAN MODERN
    ========================================================= */

    .operator-statistik {
        width: 100%;
        min-height: 100%;
        background: #f6f8fb;
        overflow-x: hidden;
    }

    .operator-statistik *,
    .operator-statistik *::before,
    .operator-statistik *::after {
        box-sizing: border-box;
    }

    /* =========================================================
       CONTAINER
    ========================================================= */

    .operator-statistik .dashboard-container {
        width: 100%;
        max-width: 1450px;
        margin: 0 auto;
        padding: 28px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .dashboard-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .header-title {
        margin: 0;
        color: #172033;
        font-size: clamp(1.35rem, 1.1rem + .5vw, 1.7rem);
        font-weight: 800;
        letter-spacing: -.03em;
    }

    .header-description {
        margin: 5px 0 0;
        color: #8a94a3;
        font-size: .84rem;
    }

    .header-description strong {
        color: #586578;
        font-weight: 700;
    }

    .header-period {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 13px;
        border: 1px solid #e4e9ef;
        border-radius: 10px;
        background: #fff;
        color: #596678;
        font-size: .76rem;
        font-weight: 700;
        box-shadow: 0 3px 12px rgba(30, 45, 70, .03);
        white-space: nowrap;
    }

    .header-period i {
        color: #0d6efd;
        font-size: .9rem;
    }

    /* =========================================================
       STATISTICS
    ========================================================= */

    .statistics-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 18px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5eaf0;
        border-radius: 15px;
        padding: 18px;
        box-shadow: 0 4px 18px rgba(25, 42, 70, .035);
        transition: .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 25px rgba(25, 42, 70, .07);
    }

    .stat-card-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .stat-label {
        display: block;
        margin-bottom: 7px;
        color: #8d97a6;
        font-size: .73rem;
        font-weight: 600;
    }

    .stat-number {
        color: #172033;
        font-size: 1.6rem;
        line-height: 1;
        font-weight: 800;
        letter-spacing: -.035em;
    }

    .stat-unit {
        color: #7d8796;
        font-size: .75rem;
        font-weight: 700;
        margin-left: 2px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .stat-icon.blue {
        background: #edf5ff;
        color: #0d6efd;
    }

    .stat-icon.green {
        background: #edf9f2;
        color: #198754;
    }

    .stat-icon.orange {
        background: #fff8e8;
        color: #c58700;
    }

    .stat-icon.purple {
        background: #f3efff;
        color: #6f42c1;
    }

    /* =========================================================
       DASHBOARD CARD
    ========================================================= */

    .dashboard-card {
        background: #fff;
        border: 1px solid #e5eaf0;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(25, 42, 70, .035);
    }

    .dashboard-card + .dashboard-card {
        margin-top: 18px;
    }

    .dashboard-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 17px 20px;
        border-bottom: 1px solid #edf0f4;
    }

    .card-title-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .card-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #edf5ff;
        color: #0d6efd;
    }

    .card-icon.warning {
        background: #fff8e8;
        color: #c58700;
    }

    .card-title {
        margin: 0;
        color: #202b3d;
        font-size: .9rem;
        font-weight: 750;
    }

    .card-subtitle {
        margin: 3px 0 0;
        color: #98a1ae;
        font-size: .69rem;
    }

    /* =========================================================
       BADGE
    ========================================================= */

    .count-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 8px;
        background: #f4f6f9;
        color: #667386;
        font-size: .68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .count-badge.blue {
        background: #edf5ff;
        color: #0d6efd;
    }

    /* =========================================================
       CARD BODY
    ========================================================= */

    .dashboard-card-body {
        padding: 18px 20px 20px;
    }

    /* =========================================================
       FILTER
    ========================================================= */

    .filter-box {
        padding: 13px;
        margin-bottom: 16px;
        background: #f8fafc;
        border: 1px solid #edf0f4;
        border-radius: 11px;
    }

    .filter-form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) auto;
        gap: 10px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        margin-bottom: 5px;
        color: #697588;
        font-size: .69rem;
        font-weight: 700;
    }

    .filter-control {
        width: 100%;
        height: 40px;
        padding: 0 11px;
        border: 1px solid #dfe5ec;
        border-radius: 9px;
        background: #fff;
        color: #3d495b;
        font-size: .78rem;
        outline: none;
        transition: .2s ease;
    }

    .filter-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .09);
    }

    .filter-button {
        height: 40px;
        padding: 0 16px;
        border: 0;
        border-radius: 9px;
        background: #0d6efd;
        color: #fff;
        font-size: .76rem;
        font-weight: 700;
        transition: .2s ease;
        white-space: nowrap;
    }

    .filter-button:hover {
        background: #0b5ed7;
    }

    /* =========================================================
       RESULT SUMMARY
    ========================================================= */

    .result-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
    }

    .result-text {
        color: #8993a2;
        font-size: .7rem;
    }

    .result-text strong {
        color: #536074;
    }

    .kg-summary {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 9px;
        border-radius: 8px;
        background: #edf5ff;
        color: #0d6efd;
        font-size: .68rem;
        font-weight: 800;
        white-space: nowrap;
    }

    /* =========================================================
       DATA LIST
    ========================================================= */

    .data-list {
        border: 1px solid #edf0f4;
        border-radius: 11px;
        overflow: hidden;
    }

    .data-list-scroll {
        max-height: 360px;
        overflow-y: auto;
    }

    .data-list-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .data-list-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .data-list-scroll::-webkit-scrollbar-thumb {
        background: #d9dee6;
        border-radius: 10px;
    }

    .data-item {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 13px;
        border-bottom: 1px solid #f0f2f5;
        transition: background .15s ease;
    }

    .data-item:last-child {
        border-bottom: 0;
    }

    .data-item:hover {
        background: #fafbfd;
    }

    .data-number {
        width: 28px;
        height: 28px;
        min-width: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f5f8;
        color: #7d8796;
        font-size: .65rem;
        font-weight: 700;
    }

    .data-avatar {
        width: 35px;
        height: 35px;
        min-width: 35px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #edf5ff;
        color: #0d6efd;
        font-size: .72rem;
        font-weight: 800;
    }

    .data-avatar.warning {
        background: #fff8e8;
        color: #b27c00;
    }

    .data-content {
        flex: 1;
        min-width: 0;
    }

    .data-name {
        color: #293548;
        font-size: .77rem;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .data-meta {
        margin-top: 3px;
        color: #99a2af;
        font-size: .65rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .data-right {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 7px;
        background: #f4f6f8;
        border: 1px solid #e7eaf0;
        color: #657286;
        font-size: .59rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge::before {
        content: "";
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-badge.warning {
        background: #fff8e8;
        border-color: #f5e3ad;
        color: #b27c00;
    }

    .kg-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 8px;
        border-radius: 7px;
        background: #edf5ff;
        color: #0d6efd;
        font-size: .6rem;
        font-weight: 800;
        white-space: nowrap;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        min-height: 210px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 25px;
    }

    .empty-icon {
        width: 52px;
        height: 52px;
        margin-bottom: 11px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f4f6f8;
        color: #a0a8b4;
        font-size: 1.3rem;
    }

    .empty-icon.success {
        background: #edf9f2;
        color: #198754;
    }

    .empty-title {
        color: #687488;
        font-size: .78rem;
        font-weight: 700;
    }

    .empty-description {
        margin-top: 4px;
        color: #a0a8b4;
        font-size: .66rem;
    }

    /* =========================================================
       RESPONSIVE TABLET
    ========================================================= */

    @media (max-width: 1000px) {

        .statistics-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    /* =========================================================
       RESPONSIVE MOBILE
    ========================================================= */

    @media (max-width: 650px) {

        .operator-statistik .dashboard-container {
            padding: 18px 12px 28px;
        }

        .dashboard-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
        }

        .header-period {
            width: 100%;
            justify-content: center;
        }

        .statistics-grid {
            grid-template-columns: 1fr 1fr;
            gap: 9px;
        }

        .stat-card {
            padding: 14px 12px;
            border-radius: 13px;
        }

        .stat-card-content {
            align-items: flex-start;
        }

        .stat-label {
            font-size: .63rem;
        }

        .stat-number {
            font-size: 1.25rem;
        }

        .stat-unit {
            font-size: .65rem;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 9px;
            font-size: .9rem;
        }

        .dashboard-card-header {
            padding: 14px;
        }

        .dashboard-card-body {
            padding: 14px;
        }

        .card-title {
            font-size: .8rem;
        }

        .card-subtitle {
            font-size: .62rem;
        }

        .filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .filter-submit {
            grid-column: 1 / -1;
        }

        .filter-button {
            width: 100%;
        }

        .result-summary {
            align-items: flex-start;
            flex-direction: column;
        }

        .data-item {
            gap: 8px;
            padding: 10px;
        }

        .data-number {
            width: 24px;
            height: 24px;
            min-width: 24px;
            font-size: .58rem;
        }

        .data-avatar {
            width: 32px;
            height: 32px;
            min-width: 32px;
            font-size: .65rem;
        }

        .data-name {
            font-size: .7rem;
        }

        .data-meta {
            font-size: .59rem;
        }

        .status-badge {
            display: none;
        }

    }

    /* =========================================================
       SMALL MOBILE
    ========================================================= */

    @media (max-width: 390px) {

        .operator-statistik .dashboard-container {
            padding-left: 10px;
            padding-right: 10px;
        }

        .statistics-grid {
            gap: 7px;
        }

        .stat-card {
            padding: 12px 9px;
        }

        .stat-label {
            font-size: .57rem;
        }

        .stat-number {
            font-size: 1.1rem;
        }

        .stat-icon {
            width: 32px;
            height: 32px;
            min-width: 32px;
            font-size: .8rem;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .filter-submit {
            grid-column: auto;
        }

        .data-right .kg-badge {
            font-size: .55rem;
            padding: 4px 6px;
        }

    }
</style>


<div class="operator-statistik">

    <div class="dashboard-container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="dashboard-header">

            <div>

                <h1 class="header-title">
                    Statistik Operator
                </h1>

                <p class="header-description">
                    Monitoring pengambilan gula periode

                    <strong>
                        {{ \Carbon\Carbon::createFromFormat('Y-m', $periode)->translatedFormat('F Y') }}
                    </strong>
                </p>

            </div>


            <div class="header-period">

                <i class="bi bi-calendar3"></i>

                {{ \Carbon\Carbon::createFromFormat('Y-m', $periode)->translatedFormat('F Y') }}

            </div>

        </div>


        {{-- =====================================================
             4 STATISTIK UTAMA
        ====================================================== --}}

        <div class="statistics-grid">


            {{-- TOTAL KARYAWAN --}}

            <div class="stat-card">

                <div class="stat-card-content">

                    <div>

                        <span class="stat-label">
                            Total Karyawan
                        </span>

                        <div class="stat-number">
                            {{ number_format($statistik['total_karyawan'] ?? 0) }}
                        </div>

                    </div>

                    <div class="stat-icon blue">
                        <i class="bi bi-people-fill"></i>
                    </div>

                </div>

            </div>


            {{-- SUDAH MENGAMBIL --}}

            <div class="stat-card">

                <div class="stat-card-content">

                    <div>

                        <span class="stat-label">
                            Sudah Mengambil
                        </span>

                        <div class="stat-number">
                            {{ number_format($statistik['sudah_ambil'] ?? 0) }}
                        </div>

                    </div>

                    <div class="stat-icon green">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                </div>

            </div>


            {{-- BELUM MENGAMBIL --}}

            <div class="stat-card">

                <div class="stat-card-content">

                    <div>

                        <span class="stat-label">
                            Belum Mengambil
                        </span>

                        <div class="stat-number">
                            {{ number_format($statistik['belum_ambil'] ?? 0) }}
                        </div>

                    </div>

                    <div class="stat-icon orange">
                        <i class="bi bi-clock-history"></i>
                    </div>

                </div>

            </div>


            {{-- TOTAL GULA --}}

            <div class="stat-card">

                <div class="stat-card-content">

                    <div>

                        <span class="stat-label">
                            Total Gula Diambil
                        </span>

                        <div class="stat-number">

                            {{ number_format($statistik['total_kg'] ?? 0, 0, ',', '.') }}

                            <span class="stat-unit">
                                Kg
                            </span>

                        </div>

                    </div>

                    <div class="stat-icon purple">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             SUDAH MENGAMBIL
        ====================================================== --}}

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <div class="card-title-wrapper">

                    <div class="card-icon">
                        <i class="bi bi-person-check-fill"></i>
                    </div>

                    <div>

                        <h2 class="card-title">
                            Sudah Mengambil
                        </h2>

                        <p class="card-subtitle">
                            Daftar karyawan yang sudah mengambil gula
                        </p>

                    </div>

                </div>


                @if($daftarSudahAmbil->count() > 0)

                    <div class="count-badge blue">

                        <i class="bi bi-people"></i>

                        {{ $daftarSudahAmbil->count() }} orang

                    </div>

                @endif

            </div>


            <div class="dashboard-card-body">


                {{-- FILTER --}}

                <div class="filter-box">

                    <form method="GET"
                          action="{{ route('operator.statistik') }}"
                          class="filter-form">


                        {{-- TANGGAL AWAL --}}

                        <div class="filter-group">

                            <label for="tanggal_awal">
                                Dari Tanggal
                            </label>

                            <input
                                type="date"
                                id="tanggal_awal"
                                name="tanggal_awal"
                                value="{{ $tanggalAwal ?? '' }}"
                                class="filter-control"
                            >

                        </div>


                        {{-- TANGGAL AKHIR --}}

                        <div class="filter-group">

                            <label for="tanggal_akhir">
                                Sampai Tanggal
                            </label>

                            <input
                                type="date"
                                id="tanggal_akhir"
                                name="tanggal_akhir"
                                value="{{ $tanggalAkhir ?? '' }}"
                                class="filter-control"
                            >

                        </div>


                        {{-- BUTTON --}}

                        <div class="filter-submit">

                            <button type="submit"
                                    class="filter-button">

                                <i class="bi bi-search me-1"></i>

                                Filter

                            </button>

                        </div>

                    </form>

                </div>


                {{-- =================================================
                     RINGKASAN HASIL
                ================================================== --}}

                @if($daftarSudahAmbil->count() > 0)

                    <div class="result-summary">

                        <div class="result-text">

                            Menampilkan

                            <strong>
                                {{ $daftarSudahAmbil->count() }}
                            </strong>

                            data pengambilan

                        </div>


                        <div class="kg-summary">

                            <i class="bi bi-box-seam"></i>

                            Total

                            {{ number_format($totalGulaSudahAmbil ?? 0, 0, ',', '.') }}

                            Kg

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     LIST SUDAH MENGAMBIL
                ================================================== --}}

                @if($daftarSudahAmbil->count() > 0)

                    <div class="data-list">

                        <div class="data-list-scroll">

                            @foreach($daftarSudahAmbil as $index => $item)

                                <div class="data-item">


                                    {{-- NOMOR --}}

                                    <div class="data-number">
                                        {{ $index + 1 }}
                                    </div>


                                    {{-- AVATAR --}}

                                    <div class="data-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $item->karyawan->nama ?? 'K',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>


                                    {{-- INFORMASI --}}

                                    <div class="data-content">

                                        <div class="data-name">

                                            {{ $item->karyawan->nama ?? '-' }}

                                        </div>


                                        <div class="data-meta">

                                            {{ $item->karyawan->nik ?? '-' }}

                                            &nbsp;•&nbsp;

                                            {{ $item->karyawan->bagian ?? '-' }}

                                            &nbsp;•&nbsp;

                                            {{ $item->tanggal_ambil?->translatedFormat('d F Y') ?? '-' }}

                                        </div>

                                    </div>


                                    {{-- STATUS + KG --}}

                                    <div class="data-right">

                                        <span class="status-badge">

                                            {{ $item->karyawan->status ?? '-' }}

                                        </span>


                                        <span class="kg-badge">

                                            {{ $item->jumlah_gula ?? 0 }}

                                            Kg

                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @else


                    {{-- EMPTY --}}

                    <div class="empty-state">

                        <div class="empty-icon">

                            <i class="bi bi-inbox"></i>

                        </div>

                        <div class="empty-title">
                            Belum ada data pengambilan
                        </div>

                        <div class="empty-description">
                            Tidak ditemukan data pada rentang tanggal yang dipilih.
                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
             KARYAWAN BELUM MENGAMBIL
        ====================================================== --}}

        <div class="dashboard-card">

            <div class="dashboard-card-header">

                <div class="card-title-wrapper">

                    <div class="card-icon warning">

                        <i class="bi bi-person-exclamation"></i>

                    </div>

                    <div>

                        <h2 class="card-title">
                            Karyawan Belum Mengambil
                        </h2>

                        <p class="card-subtitle">
                            Karyawan yang belum mengambil jatah gula
                        </p>

                    </div>

                </div>


                @if($karyawanBelumAmbil->count() > 0)

                    <div class="count-badge">

                        <i class="bi bi-clock"></i>

                        {{ $karyawanBelumAmbil->count() }}

                        orang

                    </div>

                @endif

            </div>


            <div class="dashboard-card-body">

                @if($karyawanBelumAmbil->count() > 0)

                    <div class="data-list">

                        <div class="data-list-scroll">

                            @foreach($karyawanBelumAmbil as $index => $karyawan)

                                <div class="data-item">


                                    {{-- NOMOR --}}

                                    <div class="data-number">
                                        {{ $index + 1 }}
                                    </div>


                                    {{-- AVATAR --}}

                                    <div class="data-avatar warning">

                                        {{ strtoupper(
                                            substr(
                                                $karyawan->nama ?? 'K',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>


                                    {{-- INFORMASI --}}

                                    <div class="data-content">

                                        <div class="data-name">

                                            {{ $karyawan->nama ?? '-' }}

                                        </div>


                                        <div class="data-meta">

                                            {{ $karyawan->nik ?? '-' }}

                                            &nbsp;•&nbsp;

                                            {{ $karyawan->bagian ?? '-' }}

                                        </div>

                                    </div>


                                    {{-- STATUS --}}

                                    <div class="data-right">

                                        <span class="status-badge warning">

                                            Belum Mengambil

                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @else


                    {{-- SEMUA SUDAH MENGAMBIL --}}

                    <div class="empty-state">

                        <div class="empty-icon success">

                            <i class="bi bi-check-circle-fill"></i>

                        </div>

                        <div class="empty-title">

                            Semua karyawan sudah mengambil

                        </div>

                        <div class="empty-description">

                            Tidak ada karyawan yang masih menunggu pengambilan gula.

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
