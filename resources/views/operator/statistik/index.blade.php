@extends('layouts.app')

@section('title', 'Statistik Operator')

@section('content')

<style>
    /* =========================================================
       STATISTIK OPERATOR - RESPONSIVE
    ========================================================= */

    .operator-statistik {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* HEADER */
    .statistik-header {
        margin-bottom: 1.25rem;
    }

    .statistik-header h4 {
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: .25rem;
    }

    .statistik-header p {
        font-size: .9rem;
    }

    /* =========================================================
       KARTU STATISTIK
    ========================================================= */

    .stat-card {
        border: 0;
        border-radius: 14px;
        transition: .2s ease;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-card .card-body {
        padding: 1.15rem;
    }

    .stat-label {
        display: block;
        color: #6c757d;
        font-size: .82rem;
        margin-bottom: .25rem;
    }

    .stat-number {
        font-size: 1.7rem;
        line-height: 1.2;
        font-weight: 700;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 1.45rem;
    }

    .icon-primary {
        color: #0d6efd;
        background: rgba(13, 110, 253, .10);
    }

    .icon-success {
        color: #198754;
        background: rgba(25, 135, 84, .10);
    }

    .icon-warning {
        color: #ffc107;
        background: rgba(255, 193, 7, .13);
    }

    .icon-info {
        color: #0dcaf0;
        background: rgba(13, 202, 240, .12);
    }

    /* =========================================================
       CARD UMUM
    ========================================================= */

    .content-card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
    }

    .content-card .card-header {
        padding: 1.15rem 1.25rem .5rem;
    }

    .content-card .card-body {
        padding: 1.25rem;
    }

    .section-title {
        font-size: 1.05rem;
        font-weight: 700;
    }

    .section-subtitle {
        font-size: .82rem;
        color: #6c757d;
    }

    /* =========================================================
       FILTER
    ========================================================= */

    .filter-label {
        font-size: .85rem;
        margin-bottom: .4rem;
    }

    .filter-form .form-control {
        min-height: 42px;
        border-radius: 8px;
    }

    .filter-form .btn {
        min-height: 42px;
        border-radius: 8px;
        white-space: nowrap;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .responsive-table {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }

    .responsive-table table {
        min-width: 600px;
        margin-bottom: 0;
    }

    .responsive-table th,
    .responsive-table td {
        white-space: nowrap;
        vertical-align: middle;
        padding: .75rem .8rem;
        font-size: .88rem;
    }

    .responsive-table thead th {
        font-size: .8rem;
        font-weight: 600;
        color: #6c757d;
        background: #f8f9fa;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 3rem 1rem;
        text-align: center;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 2.7rem;
        display: block;
        margin-bottom: .75rem;
    }

    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 991.98px) {

        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .stat-card .card-body {
            padding: 1rem;
        }

        .stat-number {
            font-size: 1.5rem;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            font-size: 1.25rem;
        }
    }

    /* =========================================================
       HP
    ========================================================= */

    @media (max-width: 575.98px) {

        .operator-statistik {
            padding: 0;
        }

        .container-fluid {
            padding-left: .75rem;
            padding-right: .75rem;
        }

        /* Header */
        .statistik-header {
            margin-bottom: 1rem;
        }

        .statistik-header h4 {
            font-size: 1.15rem;
        }

        .statistik-header p {
            font-size: .78rem;
            line-height: 1.4;
        }

        /* Statistik cards */
        .row.g-3 {
            --bs-gutter-x: .65rem;
            --bs-gutter-y: .65rem;
        }

        .stat-card {
            border-radius: 12px;
        }

        .stat-card .card-body {
            padding: .9rem;
        }

        .stat-label {
            font-size: .72rem;
        }

        .stat-number {
            font-size: 1.3rem;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 10px;
            font-size: 1.05rem;
        }

        /* Content cards */
        .content-card {
            border-radius: 12px;
        }

        .content-card .card-header {
            padding: 1rem 1rem .35rem;
        }

        .content-card .card-body {
            padding: 1rem;
        }

        .section-title {
            font-size: .95rem;
        }

        .section-subtitle {
            font-size: .75rem;
            line-height: 1.4;
        }

        /* Filter */
        .filter-form {
            display: block;
        }

        .filter-form .form-control {
            width: 100%;
            min-height: 44px;
        }

        .filter-form .btn {
            width: 100%;
            min-height: 44px;
            margin-top: .25rem;
        }

        /* Table */
        .responsive-table {
            margin-left: -.25rem;
            margin-right: -.25rem;
            width: calc(100% + .5rem);
        }

        .responsive-table table {
            min-width: 560px;
        }

        .responsive-table th,
        .responsive-table td {
            padding: .65rem .7rem;
            font-size: .78rem;
        }

        .responsive-table thead th {
            font-size: .72rem;
        }

        /* Empty state */
        .empty-state {
            padding: 2rem .75rem;
        }

        .empty-state i {
            font-size: 2.2rem;
        }

        .empty-state div {
            font-size: .8rem;
        }
    }

    /* =========================================================
       HP SANGAT KECIL
    ========================================================= */

    @media (max-width: 380px) {

        .container-fluid {
            padding-left: .6rem;
            padding-right: .6rem;
        }

        .stat-card .card-body {
            padding: .75rem;
        }

        .stat-label {
            font-size: .68rem;
        }

        .stat-number {
            font-size: 1.15rem;
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            min-width: 34px;
            font-size: .95rem;
        }

        .content-card .card-header,
        .content-card .card-body {
            padding-left: .8rem;
            padding-right: .8rem;
        }
    }
</style>


<div class="operator-statistik">

    <div class="container-fluid py-4">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="statistik-header">

            <h4>
                Statistik Operator
            </h4>

            <p class="text-muted mb-0">
                Statistik pengambilan gula periode
                {{ \Carbon\Carbon::createFromFormat('Y-m', $periode)->translatedFormat('F Y') }}
            </p>

        </div>


        {{-- =====================================================
            KARTU STATISTIK
        ====================================================== --}}

        <div class="row g-3">


            {{-- Total Karyawan --}}
            <div class="col-6 col-xl-3">

                <div class="card shadow-sm h-100 stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center gap-2">

                            <div class="min-w-0">

                                <span class="stat-label">
                                    Total Karyawan
                                </span>

                                <div class="stat-number">
                                    {{ $statistik['total_karyawan'] }}
                                </div>

                            </div>

                            <div class="stat-icon icon-primary">

                                <i class="bi bi-people-fill"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Sudah Mengambil --}}
            <div class="col-6 col-xl-3">

                <div class="card shadow-sm h-100 stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center gap-2">

                            <div class="min-w-0">

                                <span class="stat-label">
                                    Sudah Mengambil
                                </span>

                                <div class="stat-number">
                                    {{ $statistik['sudah_ambil'] }}
                                </div>

                            </div>

                            <div class="stat-icon icon-success">

                                <i class="bi bi-check-circle-fill"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Belum Mengambil --}}
            <div class="col-6 col-xl-3">

                <div class="card shadow-sm h-100 stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center gap-2">

                            <div class="min-w-0">

                                <span class="stat-label">
                                    Belum Mengambil
                                </span>

                                <div class="stat-number">
                                    {{ $statistik['belum_ambil'] }}
                                </div>

                            </div>

                            <div class="stat-icon icon-warning">

                                <i class="bi bi-clock-fill"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Persentase --}}
            <div class="col-6 col-xl-3">

                <div class="card shadow-sm h-100 stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center gap-2">

                            <div class="min-w-0">

                                <span class="stat-label">
                                    Persentase Pengambilan
                                </span>

                                <div class="stat-number">
                                    {{ $statistik['persentase_sudah'] }}%
                                </div>

                            </div>

                            <div class="stat-icon icon-info">

                                <i class="bi bi-bar-chart-fill"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            FILTER PERIODE
        ====================================================== --}}

        <div class="card shadow-sm mt-4 content-card">

            <div class="card-body">

                <form
                    method="GET"
                    action="{{ route('operator.statistik') }}"
                    class="row g-3 align-items-end filter-form"
                >

                    <div class="col-12 col-md-5 col-lg-4">

                        <label class="form-label fw-semibold filter-label">
                            Pilih Periode
                        </label>

                        <input
                            type="month"
                            name="periode"
                            value="{{ $periode }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-12 col-md-auto">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-search me-1"></i>

                            Tampilkan

                        </button>

                    </div>

                </form>

            </div>

        </div>


        {{-- =====================================================
            PENGAMBILAN HARIAN
        ====================================================== --}}

        <div class="card shadow-sm mt-4 content-card">

            <div class="card-header bg-white border-0">

                <div class="section-title">
                    Pengambilan Per Hari
                </div>

                <div class="section-subtitle">
                    Data pengambilan gula pada periode terpilih
                </div>

            </div>


            <div class="card-body">

                @if($pengambilanHarian->count() > 0)

                    <div class="responsive-table">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>
                                        Tanggal
                                    </th>

                                    <th class="text-end">
                                        Jumlah Pengambilan
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($pengambilanHarian as $item)

                                    <tr>

                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tanggal_ambil)->translatedFormat('d F Y') }}
                                        </td>

                                        <td class="text-end fw-semibold">
                                            {{ $item->total }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">

                        <i class="bi bi-inbox"></i>

                        <div>
                            Belum ada data pengambilan pada periode ini.
                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
            PENGAMBILAN TERBARU
        ====================================================== --}}

        <div class="card shadow-sm mt-4 content-card">

            <div class="card-header bg-white border-0">

                <div class="section-title">
                    Pengambilan Terbaru
                </div>

                <div class="section-subtitle">
                    10 transaksi pengambilan terakhir
                </div>

            </div>


            <div class="card-body">

                @if($pengambilanTerbaru->count() > 0)

                    <div class="responsive-table">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>
                                        No
                                    </th>

                                    <th>
                                        NIK
                                    </th>

                                    <th>
                                        Nama Karyawan
                                    </th>

                                    <th>
                                        Bagian
                                    </th>

                                    <th>
                                        Tanggal Ambil
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($pengambilanTerbaru as $index => $item)

                                    <tr>

                                        <td>
                                            {{ $index + 1 }}
                                        </td>

                                        <td>
                                            {{ $item->karyawan->nik ?? '-' }}
                                        </td>

                                        <td class="fw-semibold">
                                            {{ $item->karyawan->nama ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item->karyawan->bagian ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item->tanggal_ambil?->translatedFormat('d F Y') ?? '-' }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty-state">

                        <i class="bi bi-inbox"></i>

                        <div>
                            Belum ada data pengambilan.
                        </div>

                    </div>

                @endif

            </div>

        </div>


    </div>

</div>

@endsection
