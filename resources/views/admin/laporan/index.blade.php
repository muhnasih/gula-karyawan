@extends('layouts.app')

@section('title', 'Laporan Pengambilan Gula')

@section('content')

<style>
    /* =========================================================
       LAPORAN PENGAMBILAN GULA
    ========================================================= */

    .laporan-page {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    .laporan-page .card {
        border-radius: 12px;
    }

    /* HEADER */
    .laporan-header h2 {
        font-size: 1.4rem;
    }

    .laporan-header p {
        font-size: 0.85rem;
    }

    /* STATISTIK */
    .stat-card {
        border: 0;
        border-radius: 12px;
        transition: 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .stat-number {
        font-size: 1.35rem;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #6c757d;
    }

    /* FILTER */
    .filter-card {
        border-radius: 12px;
    }

    .filter-card .form-label {
        font-size: 0.8rem;
        margin-bottom: 5px;
    }

    /* TABLE */
    .laporan-table {
        font-size: 0.85rem;
    }

    .laporan-table th {
        white-space: nowrap;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 11px 10px;
    }

    .laporan-table td {
        padding: 10px;
    }

    .laporan-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .laporan-table tbody tr:hover {
        background-color: rgba(25, 135, 84, 0.04);
    }

    /* STATUS */
    .status-badge {
        font-size: 0.72rem;
        padding: 6px 9px;
        border-radius: 20px;
        white-space: nowrap;
    }

    /* BELUM MENGAMBIL */
    .belum-card {
        border-left: 4px solid #ffc107;
    }

    .belum-title {
        font-size: 1rem;
        font-weight: 700;
    }

    .belum-description {
        font-size: 0.78rem;
        color: #6c757d;
    }

    .belum-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .belum-item {
        border-bottom: 1px solid #eee;
        padding: 10px 0;
    }

    .belum-item:last-child {
        border-bottom: 0;
    }

    .belum-name {
        font-size: 0.85rem;
        font-weight: 600;
    }

    .belum-nik {
        font-size: 0.72rem;
        color: #6c757d;
    }

    .belum-gula {
        font-size: 0.8rem;
        font-weight: 700;
        color: #dc3545;
    }

    /* MOBILE CARD */
    .laporan-mobile-card {
        border-radius: 12px;
    }

    .laporan-mobile-card .employee-name {
        font-size: 0.9rem;
        font-weight: 700;
    }

    .laporan-mobile-card .employee-nik {
        font-size: 0.72rem;
        color: #6c757d;
    }

    .mobile-info-label {
        display: block;
        color: #6c757d;
        font-size: 0.7rem;
        margin-bottom: 2px;
    }

    .mobile-info-value {
        font-size: 0.78rem;
        font-weight: 500;
    }

    /* EMPTY */
    .empty-state {
        padding: 40px 20px;
        text-align: center;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 10px;
    }

    /* RESPONSIVE */
    @media (max-width: 767.98px) {

        .laporan-header h2 {
            font-size: 1.15rem;
        }

        .laporan-header p {
            font-size: 0.75rem;
        }

        .stat-number {
            font-size: 1.15rem;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }

        .filter-card .card-body {
            padding: 14px;
        }

        .belum-list {
            max-height: 250px;
        }
    }
</style>


<div class="laporan-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="laporan-header d-flex flex-column flex-lg-row
                justify-content-between align-items-lg-center
                gap-3 mb-4">

        <div>
            <h2 class="fw-bold text-success mb-1">
                <i class="bi bi-file-earmark-bar-graph-fill me-2"></i>
                Laporan Pengambilan Gula
            </h2>

            <p class="text-muted mb-0">
                Rekapitulasi pengambilan bonus gula karyawan PG Gending
            </p>
        </div>


        {{-- EXPORT --}}
        <div class="d-flex gap-2">

            <a href="{{ route('admin.laporan.excel', request()->query()) }}"
               class="btn btn-success btn-sm">

                <i class="bi bi-file-earmark-excel me-1"></i>

                <span class="d-none d-sm-inline">
                    Export
                </span>

                Excel
            </a>


            <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
               class="btn btn-danger btn-sm">

                <i class="bi bi-file-earmark-pdf me-1"></i>

                <span class="d-none d-sm-inline">
                    Export
                </span>

                PDF
            </a>

        </div>

    </div>


    {{-- =========================================================
         STATISTIK
    ========================================================== --}}
    <div class="row g-2 g-md-3 mb-4">

        {{-- TOTAL KARYAWAN --}}
        <div class="col-6 col-md-3">

            <div class="card stat-card shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <div>

                            <div class="stat-label">
                                Total Karyawan
                            </div>

                            <div class="stat-number fw-bold">
                                {{ $statistik['totalKaryawan'] ?? 0 }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SUDAH MENGAMBIL --}}
        <div class="col-6 col-md-3">

            <div class="card stat-card shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>

                        <div>

                            <div class="stat-label">
                                Sudah Mengambil
                            </div>

                            <div class="stat-number fw-bold text-primary">
                                {{ $statistik['sudahAmbil'] ?? 0 }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BELUM MENGAMBIL --}}
        <div class="col-6 col-md-3">

            <div class="card stat-card shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-clock-fill"></i>
                        </div>

                        <div>

                            <div class="stat-label">
                                Belum Mengambil
                            </div>

                            <div class="stat-number fw-bold text-warning">
                                {{ $statistik['belumAmbil'] ?? 0 }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL GULA --}}
        <div class="col-6 col-md-3">

            <div class="card stat-card shadow-sm h-100">

                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>

                        <div>

                            <div class="stat-label">
                                Total Gula
                            </div>

                            <div class="stat-number fw-bold text-info">

                                {{ number_format($statistik['totalGula'] ?? 0, 0, ',', '.') }}

                                <small class="fs-6">
                                    KG
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         PERIODE AKTIF
    ========================================================== --}}
    @if(request('tanggal_awal') || request('tanggal_akhir'))

        <div class="alert alert-success border-0 shadow-sm mb-4">

            <div class="d-flex align-items-start gap-2">

                <i class="bi bi-calendar-check-fill mt-1"></i>

                <div>

                    <strong>Periode Laporan</strong>

                    <div class="small mt-1">

                        @if(request('tanggal_awal'))
                            {{ \Carbon\Carbon::parse(request('tanggal_awal'))->format('d-m-Y') }}
                        @else
                            Semua tanggal
                        @endif

                        <span class="mx-1">s/d</span>

                        @if(request('tanggal_akhir'))
                            {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d-m-Y') }}
                        @else
                            Semua tanggal
                        @endif

                    </div>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
         FILTER
    ========================================================== --}}
    <div class="card filter-card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.laporan.index') }}">

                <div class="row g-3">

                    {{-- TANGGAL AWAL --}}
                    <div class="col-6 col-md-3">

                        <label class="form-label fw-semibold">
                            Tanggal Awal
                        </label>

                        <input type="date"
                               name="tanggal_awal"
                               class="form-control"
                               value="{{ request('tanggal_awal') }}">

                    </div>


                    {{-- TANGGAL AKHIR --}}
                    <div class="col-6 col-md-3">

                        <label class="form-label fw-semibold">
                            Tanggal Akhir
                        </label>

                        <input type="date"
                               name="tanggal_akhir"
                               class="form-control"
                               value="{{ request('tanggal_akhir') }}">

                    </div>


                    {{-- STATUS --}}
                    <div class="col-12 col-md-3">

                        <label class="form-label fw-semibold">
                            Status Pengambilan
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="">
                                Semua
                            </option>

                            <option value="sudah"
                                {{ request('status') === 'sudah' ? 'selected' : '' }}>
                                Sudah Mengambil
                            </option>

                            <option value="belum"
                                {{ request('status') === 'belum' ? 'selected' : '' }}>
                                Belum Mengambil
                            </option>

                        </select>

                    </div>


                    {{-- BUTTON --}}
                    <div class="col-12 col-md-3 d-flex align-items-end gap-2">

                        <button type="submit"
                                class="btn btn-success flex-grow-1">

                            <i class="bi bi-search me-1"></i>

                            Cari

                        </button>


                        @if(request()->hasAny([
                            'tanggal_awal',
                            'tanggal_akhir',
                            'status'
                        ]))

                            <a href="{{ route('admin.laporan.index') }}"
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


    {{-- =========================================================
         INFORMASI HASIL
    ========================================================== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h5 class="fw-bold mb-1">
                Data Karyawan
            </h5>

            <small class="text-muted">

                Menampilkan
                <strong>{{ $laporan->count() }}</strong>
                karyawan

            </small>

        </div>

    </div>


    {{-- =========================================================
         TABEL DESKTOP
    ========================================================== --}}
    <div class="card shadow-sm border-0 d-none d-md-block mb-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-bordered
                              align-middle mb-0 laporan-table">

                    <thead class="table-success">

                        <tr>

                            <th class="text-center">
                                No
                            </th>

                            <th>
                                NIK
                            </th>

                            <th>
                                Nama
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

                                {{-- NO --}}
                                <td class="text-center">
                                    {{ $key + 1 }}
                                </td>


                                {{-- NIK --}}
                                <td>
                                    <strong>
                                        {{ $item->nik }}
                                    </strong>
                                </td>


                                {{-- NAMA --}}
                                <td>
                                    {{ $item->nama }}
                                </td>


                                {{-- KATEGORI --}}
                                <td>
                                    {{ $item->kategori ?? '-' }}
                                </td>


                                {{-- BAGIAN --}}
                                <td>
                                    {{ $item->bagian ?? '-' }}
                                </td>


                                {{-- TANGGAL --}}
                                <td>

                                    @if($item->tanggal_ambil)

                                        {{ \Carbon\Carbon::parse(
                                            $item->tanggal_ambil
                                        )->format('d-m-Y') }}

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- JUMLAH GULA --}}
                                <td class="text-center">

                                    <strong
                                        class="{{ $item->jumlah_gula > 0
                                            ? 'text-success'
                                            : 'text-muted' }}">

                                        {{ number_format(
                                            $item->jumlah_gula ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                        KG

                                    </strong>

                                </td>


                                {{-- STATUS --}}
                                <td class="text-center">

                                    @if($item->status_pengambilan === 'sudah')

                                        <span class="badge bg-success status-badge">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Sudah Mengambil

                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark status-badge">

                                            <i class="bi bi-clock me-1"></i>

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

                                        <div class="fw-semibold">
                                            Data tidak ditemukan
                                        </div>

                                        <small>
                                            Belum ada data sesuai filter yang dipilih.
                                        </small>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =========================================================
         CARD MOBILE
    ========================================================== --}}
    <div class="d-block d-md-none mb-4">

        @forelse($laporan as $key => $item)

            <div class="card laporan-mobile-card shadow-sm border-0 mb-3">

                <div class="card-body">

                    {{-- HEADER CARD --}}
                    <div class="d-flex justify-content-between
                                align-items-start mb-3">

                        <div>

                            <div class="employee-name">
                                {{ $item->nama }}
                            </div>

                            <div class="employee-nik">
                                {{ $item->nik }}
                            </div>

                        </div>


                        <div class="text-muted small">
                            #{{ $key + 1 }}
                        </div>

                    </div>


                    {{-- INFORMASI --}}
                    <div class="row gy-3">

                        {{-- KATEGORI --}}
                        <div class="col-6">

                            <span class="mobile-info-label">
                                Kategori
                            </span>

                            <span class="mobile-info-value">
                                {{ $item->kategori ?? '-' }}
                            </span>

                        </div>


                        {{-- BAGIAN --}}
                        <div class="col-6">

                            <span class="mobile-info-label">
                                Bagian
                            </span>

                            <span class="mobile-info-value">
                                {{ $item->bagian ?? '-' }}
                            </span>

                        </div>


                        {{-- TANGGAL --}}
                        <div class="col-6">

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
                        <div class="col-6">

                            <span class="mobile-info-label">
                                Jumlah Gula
                            </span>

                            <span class="mobile-info-value
                                fw-bold
                                {{ $item->jumlah_gula > 0
                                    ? 'text-success'
                                    : 'text-muted' }}">

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
                    <div class="mt-3">

                        @if($item->status_pengambilan === 'sudah')

                            <span class="badge bg-success status-badge">

                                <i class="bi bi-check-circle me-1"></i>

                                Sudah Mengambil

                            </span>

                        @else

                            <span class="badge bg-warning text-dark status-badge">

                                <i class="bi bi-clock me-1"></i>

                                Belum Mengambil

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="card shadow-sm border-0">

                <div class="empty-state">

                    <i class="bi bi-inbox"></i>

                    <div class="fw-semibold">
                        Data tidak ditemukan
                    </div>

                    <small>
                        Belum ada data sesuai filter yang dipilih.
                    </small>

                </div>

            </div>

        @endforelse

    </div>


    {{-- =========================================================
         DAFTAR KARYAWAN BELUM MENGAMBIL
    ========================================================== --}}

    @php

        $belumMengambil = collect($laporan)
            ->filter(function ($item) {
                return $item->status_pengambilan === 'belum';
            });

    @endphp


    @if($belumMengambil->count() > 0)

        <div class="card belum-card shadow-sm border-0 mb-4">

            <div class="card-body">

                {{-- HEADER --}}
                <div class="d-flex flex-column flex-md-row
                            justify-content-between
                            align-items-md-center
                            gap-2 mb-3">

                    <div>

                        <div class="belum-title">

                            <i class="bi bi-person-exclamation
                                       text-warning me-2"></i>

                            Karyawan Belum Mengambil

                        </div>

                        <div class="belum-description">

                            Daftar karyawan yang belum mengambil gula
                            pada periode yang dipilih.

                        </div>

                    </div>


                    <span class="badge bg-warning text-dark">

                        {{ $belumMengambil->count() }}
                        Karyawan

                    </span>

                </div>


                {{-- LIST --}}
                <div class="belum-list">

                    @foreach($belumMengambil as $item)

                        <div class="belum-item">

                            <div class="d-flex justify-content-between
                                        align-items-center gap-3">

                                <div class="flex-grow-1">

                                    <div class="belum-name">

                                        {{ $item->nama }}

                                    </div>

                                    <div class="belum-nik">

                                        NIK:
                                        {{ $item->nik }}

                                        @if($item->kategori)
                                            <span class="mx-1">•</span>
                                            {{ $item->kategori }}
                                        @endif

                                        @if($item->bagian)
                                            <span class="mx-1">•</span>
                                            {{ $item->bagian }}
                                        @endif

                                    </div>

                                </div>


                                <div class="belum-gula text-nowrap">

                                    0 KG

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @elseif(request('status') === 'belum')

        {{-- TIDAK ADA YANG BELUM MENGAMBIL --}}
        <div class="alert alert-success border-0 shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            Semua karyawan sudah mengambil gula pada periode tersebut.

        </div>

    @endif


</div>

@endsection