@extends('layouts.app')

@section('title', 'Statistik Operator')

@section('content')

<style>
    /* =========================================================
       STATISTIK OPERATOR - RESPONSIVE (FIXED)
    ========================================================= */

    .operator-statistik,
    .operator-statistik * {
        box-sizing: border-box;
    }

    .operator-statistik {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* HEADER */
    .statistik-header {
        margin-bottom: 1.5rem;
    }

    .statistik-header h4 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: .3rem;
        color: #212529;
    }

    .statistik-header p {
        font-size: .9rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    /* =========================================================
       KARTU STATISTIK
    ========================================================= */

    .stat-card {
        border: 0;
        border-radius: 14px;
        transition: transform .2s ease, box-shadow .2s ease;
        overflow: hidden;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08) !important;
    }

    .stat-card .card-body {
        padding: 1.2rem 1.15rem;
    }

    .stat-label {
        display: block;
        color: #6c757d;
        font-size: .8rem;
        font-weight: 500;
        margin-bottom: .35rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .stat-number {
        font-size: 1.75rem;
        line-height: 1.15;
        font-weight: 700;
        color: #212529;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .icon-primary {
        color: #0d6efd;
        background: rgba(13, 110, 253, .12);
    }

    .icon-success {
        color: #198754;
        background: rgba(25, 135, 84, .12);
    }

    .icon-warning {
        color: #ffc107;
        background: rgba(255, 193, 7, .15);
    }

    .icon-info {
        color: #0dcaf0;
        background: rgba(13, 202, 240, .13);
    }

    /* =========================================================
       CARD UMUM
    ========================================================= */

    .content-card {
        border: 0;
        border-radius: 14px;
        overflow: hidden;
        max-width: 100%;
    }

    .content-card .card-header {
        padding: 1.2rem 1.25rem .6rem;
        background: #fff;
        border-bottom: 0;
    }

    .content-card .card-body {
        padding: 1.15rem 1.25rem 1.35rem;
        max-width: 100%;
        overflow: hidden;
    }

    .section-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: .15rem;
    }

    .section-subtitle {
        font-size: .82rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    /* =========================================================
       FILTER
    ========================================================= */

    .filter-label {
        font-size: .85rem;
        font-weight: 600;
        margin-bottom: .4rem;
        color: #495057;
    }

    .filter-form .form-control {
        min-height: 44px;
        border-radius: 10px;
        font-size: .95rem;
    }

    .filter-form .btn {
        min-height: 44px;
        border-radius: 10px;
        white-space: nowrap;
        font-weight: 600;
        padding-left: 1.4rem;
        padding-right: 1.4rem;
    }

    /* =========================================================
       TABLE (FIX UTAMA)
       - Wrapper dibatasi 100% dari parent, tidak boleh melebar
       - Tabel default mengikuti lebar wrapper (width:100%)
       - min-width hanya dipakai di layar kecil supaya kolom
         tidak gepeng, dan wrapper yang akan scroll, bukan
         seluruh halaman
    ========================================================= */

    .responsive-table {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        border-radius: 8px;
    }

    .responsive-table table {
        width: 100%;
        min-width: 100%;
        margin-bottom: 0;
    }

    .responsive-table th,
    .responsive-table td {
        white-space: nowrap;
        vertical-align: middle;
        padding: .8rem .9rem;
        font-size: .875rem;
    }

    .responsive-table thead th {
        font-size: .78rem;
        font-weight: 600;
        color: #6c757d;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .responsive-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* =========================================================
       BADGE STATUS
    ========================================================= */

    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: .25rem;
        font-size: .72rem;
        font-weight: 700;
        padding: .35rem .6rem;
        border-radius: 8px;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 2.8rem 1rem;
        text-align: center;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 2.6rem;
        display: block;
        margin-bottom: .85rem;
        opacity: .7;
    }

    .empty-state div {
        font-size: .9rem;
    }

    /* =========================================================
       TABLET (≤ 991px)
    ========================================================= */

    @media (max-width: 991.98px) {

        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .stat-card .card-body {
            padding: 1.05rem 1rem;
        }

        .stat-number {
            font-size: 1.55rem;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            font-size: 1.25rem;
        }
    }

    /* =========================================================
       HP (≤ 575px)
    ========================================================= */

    @media (max-width: 575.98px) {

        .operator-statistik {
            padding: 0;
        }

        .container-fluid {
            padding-left: .75rem !important;
            padding-right: .75rem !important;
            padding-top: 1.1rem !important;
            padding-bottom: 1.5rem !important;
        }

        /* Header */
        .statistik-header {
            margin-bottom: 1.15rem;
        }

        .statistik-header h4 {
            font-size: 1.2rem;
        }

        .statistik-header p {
            font-size: .8rem;
            line-height: 1.45;
        }

        /* Statistik cards */
        .row.g-3 {
            --bs-gutter-x: .7rem;
            --bs-gutter-y: .7rem;
        }

        .stat-card {
            border-radius: 12px;
        }

        .stat-card .card-body {
            padding: .95rem .85rem;
        }

        .stat-label {
            font-size: .72rem;
            margin-bottom: .25rem;
        }

        .stat-number {
            font-size: 1.35rem;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 10px;
            font-size: 1.1rem;
        }

        /* Content cards */
        .content-card {
            border-radius: 12px;
        }

        .content-card .card-header {
            padding: 1.05rem 1rem .4rem;
        }

        .content-card .card-body {
            padding: 1rem;
        }

        .section-title {
            font-size: .98rem;
        }

        .section-subtitle {
            font-size: .76rem;
            line-height: 1.4;
        }

        /* Filter */
        .filter-form .form-control {
            width: 100%;
            min-height: 46px;
            font-size: 1rem;
        }

        .filter-form .btn {
            width: 100%;
            min-height: 46px;
            margin-top: .35rem;
        }

        /* Table: baru di sini kita paksa min-width supaya kolom
           tidak gepeng, wrapper yang scroll horizontal, bukan
           body/halaman */
        .responsive-table {
            margin-left: -.5rem;
            margin-right: -.5rem;
            width: calc(100% + 1rem);
            border-radius: 0;
        }

        .responsive-table table {
            min-width: 540px;
        }

        .responsive-table th,
        .responsive-table td {
            padding: .7rem .75rem;
            font-size: .8rem;
        }

        .responsive-table thead th {
            font-size: .72rem;
        }

        /* Empty state */
        .empty-state {
            padding: 2.2rem .75rem;
        }

        .empty-state i {
            font-size: 2.3rem;
        }

        .empty-state div {
            font-size: .82rem;
        }
    }

    /* =========================================================
       HP SANGAT KECIL (≤ 380px)
    ========================================================= */

    @media (max-width: 380px) {

        .container-fluid {
            padding-left: .6rem !important;
            padding-right: .6rem !important;
        }

        .stat-card .card-body {
            padding: .8rem .7rem;
        }

        .stat-label {
            font-size: .68rem;
        }

        .stat-number {
            font-size: 1.2rem;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            font-size: 1rem;
            border-radius: 9px;
        }

        .content-card .card-header,
        .content-card .card-body {
            padding-left: .85rem;
            padding-right: .85rem;
        }

        .responsive-table table {
            min-width: 480px;
        }
    }
</style>


<div class="operator-statistik">

    <div class="container-fluid py-4">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div class="statistik-header">
            <h4>Statistik Operator</h4>
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
                                <span class="stat-label">Total Karyawan</span>
                                <div class="stat-number">{{ $statistik['total_karyawan'] }}</div>
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
                                <span class="stat-label">Sudah Mengambil</span>
                                <div class="stat-number">{{ $statistik['sudah_ambil'] }}</div>
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
                                <span class="stat-label">Belum Mengambil</span>
                                <div class="stat-number">{{ $statistik['belum_ambil'] }}</div>
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
                                <span class="stat-label">Persentase</span>
                                <div class="stat-number">{{ $statistik['persentase_sudah'] }}%</div>
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
                <form method="GET"
                      action="{{ route('operator.statistik') }}"
                      class="row g-3 align-items-end filter-form">

                    <div class="col-12 col-md-5 col-lg-4">
                        <label class="form-label filter-label">Pilih Periode</label>
                        <input type="month"
                               name="periode"
                               value="{{ $periode }}"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-primary">
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
            <div class="card-header">
                <div class="section-title">Pengambilan Per Hari</div>
                <div class="section-subtitle">Data pengambilan gula pada periode terpilih</div>
            </div>

            <div class="card-body">
                @if($pengambilanHarian->count() > 0)
                    <div class="responsive-table">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th class="text-end">Jumlah Pengambilan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengambilanHarian as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_ambil)->translatedFormat('d F Y') }}</td>
                                        <td class="text-end fw-semibold">{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <div>Belum ada data pengambilan pada periode ini.</div>
                    </div>
                @endif
            </div>
        </div>


        {{-- =====================================================
            PENGAMBILAN PER STATUS KARYAWAN
        ====================================================== --}}
        <div class="card shadow-sm mt-4 content-card">
            <div class="card-header">
                <div class="section-title">Pengambilan per Status Karyawan</div>
                <div class="section-subtitle">Jumlah pengambilan dikelompokkan berdasarkan status (KARPIM/KARPEL)</div>
            </div>

            <div class="card-body">
                @if($perStatus->count() > 0)
                    <div class="responsive-table">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-end">Jumlah Pengambilan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perStatus as $item)
                                    <tr>
                                        <td>{{ $item['status'] }}</td>
                                        <td class="text-end fw-semibold">{{ $item['total'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <div>Belum ada data pengambilan pada periode ini.</div>
                    </div>
                @endif
            </div>
        </div>


        {{-- =====================================================
            PENGAMBILAN TERBARU
        ====================================================== --}}
        <div class="card shadow-sm mt-4 content-card">
            <div class="card-header">
                <div class="section-title">Pengambilan Terbaru</div>
                <div class="section-subtitle">10 transaksi pengambilan terakhir</div>
            </div>

            <div class="card-body">
                @if($pengambilanTerbaru->count() > 0)
                    <div class="responsive-table">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Bagian</th>
                                    <th>Status</th>
                                    <th class="text-end">Jumlah</th>
                                    <th>Tanggal Ambil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengambilanTerbaru as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->karyawan->nik ?? '-' }}</td>
                                        <td class="fw-semibold">{{ $item->karyawan->nama ?? '-' }}</td>
                                        <td>{{ $item->karyawan->bagian ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-secondary badge-status">
                                                {{ $item->karyawan->status ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-end fw-semibold">{{ $item->jumlah_gula ?? 0 }} KG</td>
                                        <td>{{ $item->tanggal_ambil?->translatedFormat('d F Y') ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <div>Belum ada data pengambilan.</div>
                    </div>
                @endif
            </div>
        </div>


        {{-- =====================================================
            KARYAWAN BELUM MENGAMBIL
        ====================================================== --}}
        <div class="card shadow-sm mt-4 content-card">
            <div class="card-header">
                <div class="section-title">Karyawan Belum Mengambil</div>
                <div class="section-subtitle">Daftar karyawan aktif yang belum mengambil jatah pada periode ini</div>
            </div>

            <div class="card-body">
                @if($karyawanBelumAmbil->count() > 0)
                    <div class="responsive-table">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Bagian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($karyawanBelumAmbil as $index => $karyawan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $karyawan->nik ?? '-' }}</td>
                                        <td class="fw-semibold">{{ $karyawan->nama ?? '-' }}</td>
                                        <td>{{ $karyawan->bagian ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-warning text-dark badge-status">
                                                {{ $karyawan->status ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-check-circle"></i>
                        <div>Semua karyawan sudah mengambil jatah pada periode ini.</div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection