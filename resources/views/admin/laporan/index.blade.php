@extends('layouts.app')

@section('title', 'Laporan Pengambilan Gula')

@section('content')

<style>
    /* =========================================================
       LAPORAN PENGAMBILAN GULA
       DESKTOP + ANDROID RESPONSIVE
    ========================================================= */

    .laporan-page {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        padding-bottom: 20px;
    }

    .laporan-page * {
        box-sizing: border-box;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .laporan-header {
        margin-bottom: 22px;
    }

    .laporan-header h2 {
        font-size: 1.45rem;
        line-height: 1.3;
        font-weight: 700;
        color: #198754;
        margin-bottom: 4px;
    }

    .laporan-header p {
        font-size: .84rem;
        color: #6c757d;
        margin: 0;
    }

    .export-actions {
        display: flex;
        gap: 8px;
    }

    .export-actions .btn {
        min-height: 40px;
        border-radius: 8px;
        font-size: .78rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .summary-card {
        border: 1px solid #e9ecef !important;
        border-radius: 11px;
        background: #fff;
        transition: .2s ease;
    }

    .summary-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 .3rem .8rem rgba(0, 0, 0, .06) !important;
    }

    .summary-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .summary-label {
        font-size: .71rem;
        color: #6c757d;
        margin-bottom: 2px;
        line-height: 1.2;
    }

    .summary-number {
        font-size: 1.25rem;
        line-height: 1.2;
        font-weight: 700;
    }

    .summary-card-link {
        text-decoration: none;
        color: inherit;
    }

    /* =========================================================
       FILTER
    ========================================================= */

    .filter-card {
        border: 1px solid #e9ecef !important;
        border-radius: 11px;
        background: #fff;
    }

    .filter-title {
        font-size: .88rem;
        font-weight: 700;
        color: #343a40;
    }

    .filter-subtitle {
        font-size: .72rem;
        color: #6c757d;
        margin-top: 2px;
    }

    .filter-card label {
        display: block;
        font-size: .75rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
    }

    .filter-card .form-control,
    .filter-card .form-select {
        min-height: 41px;
        border-radius: 7px;
        font-size: .79rem;
    }

    .filter-card .btn {
        min-height: 41px;
        border-radius: 7px;
        font-size: .78rem;
    }

    .filter-toggle-btn {
        display: none;
    }

    .filter-body-collapsible {
        display: block;
    }

    /* =========================================================
       FILTER AKTIF
    ========================================================= */

    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 14px;
    }

    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 20px;
        background: #e8f5e9;
        color: #198754;
        border: 1px solid #c8e6c9;
        font-size: .68rem;
        font-weight: 500;
    }

    /* =========================================================
       HASIL LAPORAN
    ========================================================= */

    .hasil-header {
        margin-bottom: 14px;
    }

    .hasil-title {
        font-size: 1rem;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 3px;
    }

    .hasil-description {
        font-size: .75rem;
        color: #6c757d;
        margin: 0;
    }

    .periode-box {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 11px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 7px;
        color: #495057;
        font-size: .72rem;
        white-space: nowrap;
    }

    .periode-box i {
        color: #198754;
    }

    .periode-box strong {
        color: #343a40;
    }

    /* =========================================================
       TABLE DESKTOP
    ========================================================= */

    .table-card {
        border: 1px solid #e9ecef !important;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }

    .laporan-table {
        margin: 0;
        font-size: .79rem;
        min-width: 900px;
    }

    .laporan-table thead th {
        background: #198754;
        color: #fff;
        border-color: rgba(255, 255, 255, .15);
        font-size: .72rem;
        font-weight: 600;
        white-space: nowrap;
        padding: 11px 10px;
        vertical-align: middle;
    }

    .laporan-table tbody td {
        padding: 10px;
        border-color: #edf0f2;
        vertical-align: middle;
    }

    .laporan-table tbody tr {
        transition: .15s ease;
    }

    .laporan-table tbody tr:hover {
        background: #f8fbf9;
    }

    .laporan-table .nik {
        font-weight: 600;
        white-space: nowrap;
    }

    .laporan-table .nama {
        font-weight: 600;
        color: #343a40;
        min-width: 160px;
    }

    .jumlah-gula {
        font-weight: 700;
        color: #198754;
        white-space: nowrap;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: .66rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-sudah {
        background: #d1e7dd;
        color: #146c43;
    }

    .status-belum {
        background: #fff3cd;
        color: #997404;
    }

    /* =========================================================
       FOOTER TABLE
    ========================================================= */

    .table-footer {
        padding: 11px 15px;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .table-footer-label {
        font-size: .72rem;
        color: #6c757d;
    }

    .table-footer-value {
        font-size: .84rem;
        font-weight: 700;
        color: #198754;
    }

    /* =========================================================
       MOBILE CARD
    ========================================================= */

    .laporan-mobile-list {
        display: none;
    }

    .mobile-report-card {
        border: 1px solid #e9ecef !important;
        border-radius: 11px;
        background: #fff;
        overflow: hidden;
    }

    .mobile-report-card .card-body {
        padding: 14px;
    }

    .mobile-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf0f2;
    }

    .mobile-employee {
        min-width: 0;
    }

    .mobile-employee-name {
        font-size: .88rem;
        line-height: 1.3;
        font-weight: 700;
        color: #343a40;
        word-break: break-word;
    }

    .mobile-employee-nik {
        font-size: .68rem;
        color: #6c757d;
        margin-top: 2px;
    }

    .mobile-number {
        min-width: 27px;
        height: 27px;
        padding: 0 7px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f3f5;
        color: #6c757d;
        font-size: .67rem;
        font-weight: 600;
    }

    .mobile-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 15px;
        margin-top: 13px;
    }

    .mobile-info-item {
        min-width: 0;
    }

    .mobile-info-label {
        display: block;
        font-size: .65rem;
        color: #8a9299;
        margin-bottom: 3px;
    }

    .mobile-info-value {
        display: block;
        font-size: .75rem;
        line-height: 1.3;
        font-weight: 500;
        color: #343a40;
        word-break: break-word;
    }

    .mobile-gula {
        color: #198754;
        font-weight: 700;
    }

    .mobile-status-row {
        margin-top: 13px;
        padding-top: 11px;
        border-top: 1px solid #edf0f2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .mobile-status-label {
        font-size: .65rem;
        color: #8a9299;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 55px 20px;
        text-align: center;
        color: #6c757d;
    }

    .empty-state i {
        display: block;
        font-size: 2.7rem;
        color: #adb5bd;
        margin-bottom: 11px;
    }

    .empty-state-title {
        font-size: .88rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 3px;
    }

    .empty-state-text {
        font-size: .73rem;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .laporan-pagination {
        margin-top: 15px;
    }

    .laporan-pagination .pagination {
        margin-bottom: 0;
        gap: 4px;
        flex-wrap: wrap;
    }

    .laporan-pagination .page-link {
        min-width: 36px;
        min-height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px !important;
        font-size: .73rem;
        color: #198754;
        border-color: #dee2e6;
    }

    .laporan-pagination .page-item.active .page-link {
        background: #198754;
        border-color: #198754;
        color: #fff;
    }

    /* =========================================================
       ANDROID / MOBILE
    ========================================================= */

    @media (max-width: 767.98px) {

        .laporan-page {
            padding-bottom: 15px;
        }

        /* HEADER */

        .laporan-header {
            margin-bottom: 17px;
        }

        .laporan-header h2 {
            font-size: 1.13rem;
            margin-bottom: 3px;
        }

        .laporan-header p {
            font-size: .7rem;
            line-height: 1.4;
        }

        .export-actions {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 7px;
        }

        .export-actions .btn {
            width: 100%;
            min-height: 40px;
            font-size: .73rem;
        }

        /* SUMMARY */

        .summary-card {
            border-radius: 9px;
        }

        .summary-card .card-body {
            padding: 11px !important;
        }

        .summary-icon {
            width: 34px;
            min-width: 34px;
            height: 34px;
            border-radius: 8px;
            font-size: .9rem;
        }

        .summary-label {
            font-size: .62rem;
        }

        .summary-number {
            font-size: 1rem;
        }

        /* FILTER */

        .filter-card {
            border-radius: 9px;
        }

        .filter-card .card-body {
            padding: 12px !important;
        }

        .filter-toggle-btn {
            display: flex;
            width: 100%;
            min-height: 40px;
            align-items: center;
            justify-content: space-between;
            border-radius: 7px;
            font-size: .74rem;
            margin: 0;
        }

        .filter-body-collapsible {
            display: none;
        }

        .filter-body-collapsible.show {
            display: block;
            padding-top: 13px;
        }

        .filter-title {
            font-size: .82rem;
        }

        .filter-subtitle {
            font-size: .66rem;
            line-height: 1.4;
        }

        .filter-card label {
            font-size: .7rem;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            min-height: 40px;
            font-size: .75rem;
        }

        .filter-card .btn {
            min-height: 40px;
            font-size: .73rem;
        }

        .active-filters {
            margin-bottom: 10px;
        }

        .filter-chip {
            font-size: .62rem;
            padding: 4px 8px;
        }

        /* HASIL LAPORAN */

        .hasil-header {
            margin-bottom: 11px;
        }

        .hasil-title {
            font-size: .9rem;
        }

        .hasil-description {
            font-size: .67rem;
            line-height: 1.4;
        }

        .periode-box {
            width: 100%;
            margin-top: 9px;
            min-height: 35px;
            font-size: .66rem;
            white-space: normal;
        }

        /* DESKTOP TABLE HIDDEN */

        .laporan-desktop-table {
            display: none !important;
        }

        /* MOBILE CARD SHOWN */

        .laporan-mobile-list {
            display: block;
        }

        /* PAGINATION */

        .laporan-pagination {
            justify-content: center !important;
        }

        .laporan-pagination .page-link {
            min-width: 34px;
            min-height: 34px;
            font-size: .69rem;
        }
    }

    /* =========================================================
       VERY SMALL ANDROID
    ========================================================= */

    @media (max-width: 380px) {

        .summary-card .card-body {
            padding: 9px !important;
        }

        .summary-icon {
            width: 31px;
            min-width: 31px;
            height: 31px;
            font-size: .8rem;
        }

        .summary-label {
            font-size: .58rem;
        }

        .summary-number {
            font-size: .92rem;
        }

        .mobile-info-grid {
            gap: 10px;
        }

        .mobile-info-label {
            font-size: .61rem;
        }

        .mobile-info-value {
            font-size: .71rem;
        }
    }
</style>


<div class="laporan-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="laporan-header
                d-flex flex-column flex-lg-row
                justify-content-between
                align-items-lg-center
                gap-3">

        <div>

            <h2>
                <i class="bi bi-file-earmark-bar-graph-fill me-2"></i>
                Laporan Pengambilan Gula
            </h2>

            <p>
                Rekapitulasi data pengambilan bonus gula karyawan PG Gending
            </p>

        </div>


        {{-- EXPORT --}}
        <div class="export-actions">

            <a href="{{ route('admin.laporan.excel', request()->query()) }}"
               class="btn btn-success">

                <i class="bi bi-file-earmark-excel me-1"></i>
                Export Excel

            </a>


            <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
               class="btn btn-danger">

                <i class="bi bi-file-earmark-pdf me-1"></i>
                Export PDF

            </a>

        </div>

    </div>


    {{-- =========================================================
         RINGKASAN
    ========================================================== --}}
    <div class="row g-2 g-md-3 mb-4">

        {{-- SUDAH --}}
        <div class="col-6 col-md-4">

            <div class="card summary-card shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-2">

                        <div class="summary-icon
                                    bg-success
                                    bg-opacity-10
                                    text-success">

                            <i class="bi bi-check-circle-fill"></i>

                        </div>

                        <div class="min-w-0">

                            <div class="summary-label">
                                Sudah Mengambil
                            </div>

                            <div class="summary-number text-success">

                                {{ $statistik['sudahAmbil'] ?? 0 }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BELUM --}}
        <div class="col-6 col-md-4">

            <a href="{{ route(
                'admin.laporan.index',
                array_merge(
                    request()->except('page'),
                    ['status' => 'belum']
                )
            ) }}"
               class="summary-card-link">

                <div class="card summary-card shadow-sm h-100">

                    <div class="card-body p-3">

                        <div class="d-flex align-items-center gap-2">

                            <div class="summary-icon
                                        bg-warning
                                        bg-opacity-10
                                        text-warning">

                                <i class="bi bi-clock-fill"></i>

                            </div>

                            <div class="min-w-0">

                                <div class="summary-label">
                                    Belum Mengambil
                                </div>

                                <div class="summary-number text-warning">

                                    {{ $statistik['belumAmbil'] ?? 0 }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </a>

        </div>


        {{-- TOTAL GULA --}}
        <div class="col-12 col-md-4">

            <div class="card summary-card shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-2">

                        <div class="summary-icon
                                    bg-info
                                    bg-opacity-10
                                    text-info">

                            <i class="bi bi-box-seam-fill"></i>

                        </div>

                        <div class="min-w-0">

                            <div class="summary-label">
                                Total Gula
                            </div>

                            <div class="summary-number text-info">

                                {{ number_format(
                                    $statistik['totalGula'] ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                                <small>KG</small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         FILTER
    ========================================================== --}}
    <div class="card filter-card shadow-sm mb-4">

        <div class="card-body">

            @php
                $hasActiveFilter = request()->hasAny([
                    'tanggal_awal',
                    'tanggal_akhir',
                    'status',
                    'search'
                ]);
            @endphp


            {{-- FILTER AKTIF --}}
            @if($hasActiveFilter)

                <div class="active-filters">

                    @if(request('search'))

                        <span class="filter-chip">

                            <i class="bi bi-search"></i>

                            {{ request('search') }}

                        </span>

                    @endif


                    @if(request('tanggal_awal') ||
                        request('tanggal_akhir'))

                        <span class="filter-chip">

                            <i class="bi bi-calendar3"></i>

                            @if(request('tanggal_awal'))

                                {{ \Carbon\Carbon::parse(
                                    request('tanggal_awal')
                                )->format('d/m/Y') }}

                            @else

                                ...

                            @endif

                            -

                            @if(request('tanggal_akhir'))

                                {{ \Carbon\Carbon::parse(
                                    request('tanggal_akhir')
                                )->format('d/m/Y') }}

                            @else

                                ...

                            @endif

                        </span>

                    @endif


                    @if(request('status') === 'sudah')

                        <span class="filter-chip">

                            <i class="bi bi-check-circle"></i>

                            Sudah Mengambil

                        </span>

                    @elseif(request('status') === 'belum')

                        <span class="filter-chip">

                            <i class="bi bi-clock"></i>

                            Belum Mengambil

                        </span>

                    @endif

                </div>

            @endif


            {{-- MOBILE FILTER BUTTON --}}
            <button type="button"
                    class="btn btn-outline-success
                           filter-toggle-btn"
                    onclick="
                        const body =
                            document.getElementById('filterBody');

                        body.classList.toggle('show');

                        const icon =
                            this.querySelector('.filter-chevron');

                        icon.classList.toggle('bi-chevron-down');
                        icon.classList.toggle('bi-chevron-up');
                    ">

                <span>

                    <i class="bi bi-funnel me-1"></i>

                    Filter Laporan

                </span>

                <i class="bi bi-chevron-down filter-chevron"></i>

            </button>


            {{-- FILTER BODY --}}
            <div id="filterBody"
                 class="filter-body-collapsible">

                <div class="mb-3">

                    <div class="filter-title">
                        Filter Laporan
                    </div>

                    <div class="filter-subtitle">
                        Pilih periode atau status untuk menampilkan data laporan.
                    </div>

                </div>


                <form method="GET"
                      action="{{ route('admin.laporan.index') }}">

                    <div class="row g-3">

                        {{-- SEARCH --}}
                        <div class="col-12 col-md-3">

                            <label>
                                Nama / NIK
                            </label>

                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Cari nama atau NIK..."
                                   value="{{ request('search') }}">

                        </div>


                        {{-- TANGGAL AWAL --}}
                        <div class="col-12 col-md-2">

                            <label>
                                Tanggal Awal
                            </label>

                            <input type="date"
                                   name="tanggal_awal"
                                   class="form-control"
                                   value="{{ request('tanggal_awal') }}">

                        </div>


                        {{-- TANGGAL AKHIR --}}
                        <div class="col-12 col-md-2">

                            <label>
                                Tanggal Akhir
                            </label>

                            <input type="date"
                                   name="tanggal_akhir"
                                   class="form-control"
                                   value="{{ request('tanggal_akhir') }}">

                        </div>


                        {{-- STATUS --}}
                        <div class="col-12 col-md-2">

                            <label>
                                Status Pengambilan
                            </label>

                            <select name="status"
                                    class="form-select">

                                <option value="">
                                    Semua
                                </option>

                                <option value="sudah"
                                    {{ request('status') === 'sudah'
                                        ? 'selected'
                                        : '' }}>

                                    Sudah Mengambil

                                </option>

                                <option value="belum"
                                    {{ request('status') === 'belum'
                                        ? 'selected'
                                        : '' }}>

                                    Belum Mengambil

                                </option>

                            </select>

                        </div>


                        {{-- BUTTON --}}
                        <div class="col-12 col-md-3
                                    d-flex
                                    align-items-end
                                    gap-2">

                            <button type="submit"
                                    class="btn btn-success
                                           flex-grow-1">

                                <i class="bi bi-search me-1"></i>

                                Tampilkan Laporan

                            </button>


                            @if($hasActiveFilter)

                                <a href="{{ route(
                                    'admin.laporan.index'
                                ) }}"
                                   class="btn btn-outline-secondary"
                                   title="Reset Filter">

                                    <i class="bi bi-arrow-counterclockwise"></i>

                                </a>

                            @endif

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
         HASIL LAPORAN
    ========================================================== --}}
    <div class="hasil-header">

        <div class="d-flex
                    flex-column
                    flex-md-row
                    justify-content-between
                    align-items-md-center
                    gap-2">

            <div>

                <div class="hasil-title">
                    Hasil Laporan
                </div>

                <p class="hasil-description">
                    Rekapitulasi data pengambilan gula berdasarkan
                    periode dan filter yang dipilih.
                </p>

            </div>


            {{-- PERIODE --}}
            <div class="periode-box">

                <i class="bi bi-calendar-check"></i>

                <span>

                    Periode:

                    <strong>

                        @if(request('tanggal_awal'))

                            {{ \Carbon\Carbon::parse(
                                request('tanggal_awal')
                            )->format('d F Y') }}

                        @else

                            {{ now()->format('d F Y') }}

                        @endif

                        –

                        @if(request('tanggal_akhir'))

                            {{ \Carbon\Carbon::parse(
                                request('tanggal_akhir')
                            )->format('d F Y') }}

                        @else

                            {{ now()->format('d F Y') }}

                        @endif

                    </strong>

                </span>

            </div>

        </div>

    </div>


    {{-- =========================================================
         DESKTOP TABLE
    ========================================================== --}}
    <div class="card table-card shadow-sm mb-4
                laporan-desktop-table">

        <div class="table-responsive">

            <table class="table laporan-table align-middle">

                <thead>

                    <tr>

                        <th class="text-center" width="55">
                            No
                        </th>

                        <th>
                            NIK
                        </th>

                        <th>
                            Nama Karyawan
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Bagian
                        </th>

                        <th>
                            Tanggal Ambil
                        </th>

                        <th class="text-center">
                            Jumlah Gula
                        </th>

                        <th class="text-center">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($laporan as $key => $item)

                        <tr>

                            <td class="text-center text-muted">

                                @if(
                                    method_exists($laporan, 'firstItem')
                                    && $laporan->firstItem()
                                )

                                    {{ $laporan->firstItem() + $key }}

                                @else

                                    {{ $key + 1 }}

                                @endif

                            </td>


                            <td class="nik">

                                {{ $item->nik }}

                            </td>


                            <td class="nama">

                                {{ $item->nama }}

                            </td>


                            <td>

                                {{ $item->kategori ?? '-' }}

                            </td>


                            <td>

                                {{ $item->bagian ?? '-' }}

                            </td>


                            <td>

                                @if($item->tanggal_ambil)

                                    {{ \Carbon\Carbon::parse(
                                        $item->tanggal_ambil
                                    )->format('d-m-Y') }}

                                @else

                                    -

                                @endif

                            </td>


                            <td class="text-center">

                                <span class="jumlah-gula">

                                    {{ number_format(
                                        $item->jumlah_gula ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                    KG

                                </span>

                            </td>


                            <td class="text-center">

                                @if($item->status_pengambilan === 'sudah')

                                    <span class="status-badge status-sudah">

                                        <i class="bi bi-check-circle-fill"></i>

                                        Sudah Mengambil

                                    </span>

                                @else

                                    <span class="status-badge status-belum">

                                        <i class="bi bi-clock-fill"></i>

                                        Belum Mengambil

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8">

                                <div class="empty-state">

                                    <i class="bi bi-inbox"></i>

                                    <div class="empty-state-title">
                                        Tidak Ada Data Laporan
                                    </div>

                                    <div class="empty-state-text">
                                        Belum terdapat data pengambilan
                                        gula sesuai periode atau filter
                                        yang dipilih.
                                    </div>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- TOTAL --}}
        @if($laporan->count() > 0)

            <div class="table-footer">

                <div class="d-flex
                            justify-content-between
                            align-items-center">

                    <span class="table-footer-label">
                        Total Gula
                    </span>

                    <span class="table-footer-value">

                        {{ number_format(
                            $laporan->sum('jumlah_gula'),
                            0,
                            ',',
                            '.'
                        ) }}

                        KG

                    </span>

                </div>

            </div>

        @endif

    </div>


    {{-- =========================================================
         MOBILE CARD
    ========================================================== --}}
    <div class="laporan-mobile-list mb-4">

        @forelse($laporan as $key => $item)

            <div class="card mobile-report-card shadow-sm mb-3">

                <div class="card-body">

                    {{-- HEADER CARD --}}
                    <div class="mobile-card-header">

                        <div class="mobile-employee">

                            <div class="mobile-employee-name">

                                {{ $item->nama }}

                            </div>

                            <div class="mobile-employee-nik">

                                NIK: {{ $item->nik }}

                            </div>

                        </div>


                        <div class="mobile-number">

                            @if(
                                method_exists($laporan, 'firstItem')
                                && $laporan->firstItem()
                            )

                                {{ $laporan->firstItem() + $key }}

                            @else

                                {{ $key + 1 }}

                            @endif

                        </div>

                    </div>


                    {{-- INFORMASI --}}
                    <div class="mobile-info-grid">

                        {{-- KATEGORI --}}
                        <div class="mobile-info-item">

                            <span class="mobile-info-label">
                                Kategori
                            </span>

                            <span class="mobile-info-value">
                                {{ $item->kategori ?? '-' }}
                            </span>

                        </div>


                        {{-- BAGIAN --}}
                        <div class="mobile-info-item">

                            <span class="mobile-info-label">
                                Bagian
                            </span>

                            <span class="mobile-info-value">
                                {{ $item->bagian ?? '-' }}
                            </span>

                        </div>


                        {{-- TANGGAL --}}
                        <div class="mobile-info-item">

                            <span class="mobile-info-label">
                                Tanggal Ambil
                            </span>

                            <span class="mobile-info-value">

                                @if($item->tanggal_ambil)

                                    {{ \Carbon\Carbon::parse(
                                        $item->tanggal_ambil
                                    )->format('d-m-Y') }}

                                @else

                                    -

                                @endif

                            </span>

                        </div>


                        {{-- JUMLAH GULA --}}
                        <div class="mobile-info-item">

                            <span class="mobile-info-label">
                                Jumlah Gula
                            </span>

                            <span class="mobile-info-value mobile-gula">

                                {{ number_format(
                                    $item->jumlah_gula ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                                KG

                            </span>

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div class="mobile-status-row">

                        <span class="mobile-status-label">
                            Status Pengambilan
                        </span>


                        @if($item->status_pengambilan === 'sudah')

                            <span class="status-badge status-sudah">

                                <i class="bi bi-check-circle-fill"></i>

                                Sudah Mengambil

                            </span>

                        @else

                            <span class="status-badge status-belum">

                                <i class="bi bi-clock-fill"></i>

                                Belum Mengambil

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="card table-card shadow-sm">

                <div class="empty-state">

                    <i class="bi bi-inbox"></i>

                    <div class="empty-state-title">
                        Tidak Ada Data Laporan
                    </div>

                    <div class="empty-state-text">
                        Belum terdapat data pengambilan gula
                        sesuai periode atau filter yang dipilih.
                    </div>

                </div>

            </div>

        @endforelse

    {{-- =========================================================
         PAGINATION
    ========================================================== --}}
    @if(
        method_exists($laporan, 'links')
        && $laporan->hasPages()
    )

        <div class="d-flex
                    justify-content-end
                    laporan-pagination">

            {{ $laporan
                ->onEachSide(1)
                ->links('pagination::bootstrap-5') }}

        </div>

    @endif

</div>

@endsection