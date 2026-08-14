@extends('layouts.app')

@section('title', 'Statistik Operator')

@section('content')

<style>
    /* =========================================================
       OPERATOR STATISTIK - MODERN MINIMAL
    ========================================================= */

    .operator-statistik {
        width: 100%;
        overflow-x: hidden;
    }

    .operator-statistik * {
        box-sizing: border-box;
    }

    /* =========================
       HEADER
    ========================= */

    .page-header {
        margin-bottom: 1.5rem;
    }

    .page-header h4 {
        font-size: clamp(1.15rem, 1rem + .5vw, 1.4rem);
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 .25rem;
        letter-spacing: -0.02em;
    }

    .page-header p {
        color: #8a8a8a;
        font-size: .85rem;
        margin: 0;
    }

    /* =========================
       STAT CARD
    ========================= */

    .stat-card {
        background: #fff;
        border: 1px solid #ececec;
        border-radius: 14px;
        height: 100%;
        transition: box-shadow .2s ease, transform .2s ease;
    }

    .stat-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
        transform: translateY(-2px);
    }

    .stat-card-body {
        padding: 1.15rem;
    }

    .stat-content {
        min-width: 0;
    }

    .stat-label {
        display: block;
        color: #9a9a9a;
        font-size: .75rem;
        font-weight: 500;
        margin-bottom: .35rem;
        letter-spacing: .01em;
    }

    .stat-number {
        color: #1a1a1a;
        font-size: clamp(1.2rem, 1rem + 1vw, 1.65rem);
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }

    .stat-number.accent {
        color: #0d6efd;
    }

    .stat-progress {
        height: 4px;
        background: #f0f0f0;
        border-radius: 4px;
        margin-top: .55rem;
        overflow: hidden;
    }

    .stat-progress-bar {
        height: 100%;
        background: #0d6efd;
        border-radius: 4px;
        transition: width .4s ease;
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 11px;
        background: #f5f5f5;
        color: #6a6a6a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .stat-icon.accent {
        background: rgba(13, 110, 253, .1);
        color: #0d6efd;
    }

    /* =========================
       CONTENT CARD
    ========================= */

    .content-card {
        border: 1px solid #ececec;
        border-radius: 14px;
        background: #fff;
        overflow: hidden;
        box-shadow: none;
        transition: box-shadow .2s ease;
    }

    .content-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, .04);
    }

    .content-card .card-header {
        background: #fff;
        border: 0;
        border-bottom: 1px solid #f2f2f2;
        padding: 1rem 1.25rem;
    }

    .content-card .card-body {
        padding: 1.1rem 1.25rem 1.25rem;
    }

    .section-title {
        font-size: .95rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        letter-spacing: -0.01em;
    }

    /* =========================
       FILTER
    ========================= */

    .filter-label {
        color: #6a6a6a;
        font-size: .8rem;
        font-weight: 600;
        margin-bottom: .4rem;
    }

    .filter-form .form-control {
        height: 42px;
        border: 1px solid #e2e2e2;
        border-radius: 10px;
        font-size: .9rem;
        box-shadow: none;
        transition: border-color .15s ease;
    }

    .filter-form .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .12);
    }

    .filter-form .btn {
        height: 42px;
        border-radius: 10px;
        font-size: .88rem;
        font-weight: 600;
        padding: 0 1.3rem;
    }

    /* =========================
       TABLE
    ========================= */

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid #ececec;
        border-radius: 10px;
    }

    .table-wrapper table {
        width: 100%;
        min-width: 480px;
        margin: 0;
    }

    .table-wrapper th {
        background: #fafafa;
        color: #8a8a8a;
        border-bottom: 1px solid #ececec;
        font-size: .72rem;
        font-weight: 600;
        padding: .75rem .9rem;
        white-space: nowrap;
        letter-spacing: .02em;
        text-transform: uppercase;
    }

    .table-wrapper td {
        color: #3a3a3a;
        font-size: .83rem;
        padding: .75rem .9rem;
        vertical-align: middle;
        white-space: nowrap;
        border-bottom: 1px solid #f5f5f5;
    }

    .table-wrapper tbody tr:last-child td {
        border-bottom: 0;
    }

    .table-wrapper tbody tr:hover {
        background: #fafafa;
    }

    /* =========================
       BADGE
    ========================= */

    .badge-status {
        display: inline-flex;
        align-items: center;
        border-radius: 6px;
        padding: .28rem .6rem;
        font-size: .68rem;
        font-weight: 600;
        background: #f7f7f7;
        border: 1px solid #e5e5e5;
        color: #4a4a4a;
    }

    .badge-status.badge-alert {
        background: #fff8e6;
        border-color: #f0d78c;
        color: #8a6d00;
    }

    /* =========================
       COMPACT LIST
    ========================= */

    .compact-scroll {
        max-height: 320px;
        overflow-y: auto;
        border: 1px solid #ececec;
        border-radius: 10px;
    }

    .compact-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .compact-scroll::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 5px;
    }

    .compact-list {
        display: flex;
        flex-direction: column;
    }

    .compact-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        padding: .65rem .9rem;
        border-bottom: 1px solid #f5f5f5;
        transition: background .15s ease;
    }

    .compact-item:last-child {
        border-bottom: 0;
    }

    .compact-item:hover {
        background: #fafafa;
    }

    .compact-main {
        min-width: 0;
        flex: 1;
    }

    .compact-name {
        font-size: .84rem;
        font-weight: 600;
        color: #2a2a2a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .compact-meta {
        font-size: .72rem;
        color: #9a9a9a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: .1rem;
    }

    .compact-count {
        font-size: .76rem;
        color: #6a6a6a;
        font-weight: 500;
        white-space: nowrap;
        background: #f5f5f5;
        padding: .2rem .55rem;
        border-radius: 6px;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        padding: 2.75rem 1rem;
        text-align: center;
        color: #9a9a9a;
    }

    .empty-state i {
        display: block;
        font-size: 2.1rem;
        margin-bottom: .65rem;
        opacity: .35;
    }

    .empty-state div {
        font-size: .84rem;
    }

    /* =========================
       SPACING
    ========================= */

    .section-gap {
        margin-top: 1.35rem !important;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 575.98px) {

        .operator-statistik .container-fluid {
            padding: 1rem .75rem 1.5rem !important;
        }

        .row.g-3 {
            --bs-gutter-x: .7rem;
            --bs-gutter-y: .7rem;
        }

        .stat-card:hover {
            transform: none;
            box-shadow: none;
        }

        .stat-card-body {
            padding: .9rem;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            font-size: .95rem;
            border-radius: 9px;
        }

        .content-card .card-header {
            padding: .9rem 1rem;
        }

        .content-card .card-body {
            padding: 1rem;
        }

        .filter-form .btn {
            width: 100%;
        }

        .table-wrapper table {
            min-width: 500px;
        }

        .table-wrapper th,
        .table-wrapper td {
            padding: .65rem .75rem;
            font-size: .78rem;
        }

        .section-gap {
            margin-top: 1.1rem !important;
        }
    }
</style>


<div class="operator-statistik">

    <div class="container-fluid py-4">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="page-header">
            <h4>Statistik Operator</h4>
            <p>
                Statistik pengambilan gula periode
                <strong>
                    {{ \Carbon\Carbon::createFromFormat('Y-m', $periode)->translatedFormat('F Y') }}
                </strong>
            </p>
        </div>


        {{-- =====================================================
            STATISTIK
        ====================================================== --}}

        <div class="row g-3">

            {{-- Total Karyawan --}}
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-body">
                        <div class="d-flex justify-content-between align-items-center gap-2">
                            <div class="stat-content">
                                <span class="stat-label">Total Karyawan</span>
                                <div class="stat-number">{{ $statistik['total_karyawan'] }}</div>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sudah Mengambil --}}
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-body">
                        <div class="d-flex justify-content-between align-items-center gap-2">
                            <div class="stat-content">
                                <span class="stat-label">Sudah Mengambil</span>
                                <div class="stat-number">{{ $statistik['sudah_ambil'] }}</div>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Belum Mengambil --}}
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-body">
                        <div class="d-flex justify-content-between align-items-center gap-2">
                            <div class="stat-content">
                                <span class="stat-label">Belum Mengambil</span>
                                <div class="stat-number">{{ $statistik['belum_ambil'] }}</div>
                            </div>
                            <div class="stat-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Persentase --}}
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-body">
                        <div class="d-flex justify-content-between align-items-center gap-2">
                            <div class="stat-content">
                                <span class="stat-label">Persentase</span>
                                <div class="stat-number accent">{{ $statistik['persentase_sudah'] }}%</div>
                                <div class="stat-progress">
                                    <div class="stat-progress-bar" style="width: {{ min($statistik['persentase_sudah'], 100) }}%"></div>
                                </div>
                            </div>
                            <div class="stat-icon accent">
                                <i class="bi bi-bar-chart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        {{-- =====================================================
            FILTER PERIODE
        ====================================================== --}}

        <div class="card content-card section-gap">
            <div class="card-body">
                <form method="GET"
                      action="{{ route('operator.statistik') }}"
                      class="row g-3 align-items-end filter-form">

                    <div class="col-12 col-md-5 col-lg-4">
                        <label class="filter-label">Periode</label>
                        <input type="month" name="periode" value="{{ $periode }}" class="form-control">
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
            PENGAMBILAN PER HARI
        ====================================================== --}}

        <div class="card content-card section-gap">
            <div class="card-header">
                <div class="section-title">Pengambilan Per Hari</div>
            </div>
            <div class="card-body">
                @if($pengambilanHarian->count() > 0)
                    <div class="table-wrapper">
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
            PER STATUS KARYAWAN
        ====================================================== --}}

        <div class="card content-card section-gap">
            <div class="card-header">
                <div class="section-title">Pengambilan per Status Karyawan</div>
            </div>
            <div class="card-body">
                @if($perStatus->count() > 0)
                    <div class="table-wrapper">
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
                                        <td><span class="badge-status">{{ $item['status'] }}</span></td>
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

        <div class="card content-card section-gap">
            <div class="card-header">
                <div class="section-title">Pengambilan Terbaru</div>
            </div>
            <div class="card-body">
                @if($pengambilanTerbaru->count() > 0)
                    <div class="table-wrapper">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
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
                                        <td><span class="badge-status">{{ $item->karyawan->status ?? '-' }}</span></td>
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

        <div class="card content-card section-gap">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="section-title">Karyawan Belum Mengambil</div>
                @if($karyawanBelumAmbil->count() > 0)
                    <span class="compact-count">{{ $karyawanBelumAmbil->count() }} orang</span>
                @endif
            </div>
            <div class="card-body">
                @if($karyawanBelumAmbil->count() > 0)
                    <div class="compact-scroll">
                        <div class="compact-list">
                            @foreach($karyawanBelumAmbil as $index => $karyawan)
                                <div class="compact-item">
                                    <div class="compact-main">
                                        <div class="compact-name">
                                            {{ $index + 1 }}. {{ $karyawan->nama ?? '-' }}
                                        </div>
                                        <div class="compact-meta">
                                            {{ $karyawan->nik ?? '-' }} &middot; {{ $karyawan->bagian ?? '-' }}
                                        </div>
                                    </div>
                                    <span class="badge-status badge-alert">{{ $karyawan->status ?? '-' }}</span>
                                </div>
                            @endforeach
                        </div>
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