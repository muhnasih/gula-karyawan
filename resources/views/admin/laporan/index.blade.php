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

    /* EXPORT BUTTONS */
    .export-actions {
        min-width: 0;
    }

    .export-actions .btn {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
        flex-shrink: 0;
    }

    .stat-number {
        font-size: 1.35rem;
        line-height: 1.2;
        word-break: break-word;
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

    .filter-card input.form-control,
    .filter-card select.form-select {
        min-height: 42px;
    }

    /* Filter toggle (mobile only) */
    .filter-toggle-btn {
        display: none;
    }

    /* Active filter badges */
    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 12px;
    }

    .active-filters .filter-chip {
        font-size: 0.72rem;
        background: #e8f5e9;
        color: #198754;
        border: 1px solid #c8e6c9;
        border-radius: 20px;
        padding: 4px 10px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
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

    .belum-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-top: 4px;
    }

    .belum-meta .meta-chip {
        font-size: 0.68rem;
        color: #6c757d;
        background: #f1f3f5;
        border-radius: 20px;
        padding: 2px 8px;
        white-space: nowrap;
    }

    .belum-gula {
        font-size: 0.8rem;
        font-weight: 700;
        color: #dc3545;
        flex-shrink: 0;
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
        word-break: break-word;
    }

    /* PAGINATION */
    .laporan-pagination .pagination {
        margin-bottom: 0;
        flex-wrap: wrap;
        gap: 4px;
    }

    .laporan-pagination .page-link {
        border-radius: 8px !important;
        min-width: 40px;
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        color: #198754;
        border-color: #dee2e6;
    }

    .laporan-pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
    }

    .laporan-pagination .page-item.disabled .page-link {
        color: #adb5bd;
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

        .export-actions {
            width: 100%;
            flex-wrap: wrap;
        }

        .export-actions .btn {
            flex: 1 1 0;
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

        .filter-toggle-btn {
            display: flex;
        }

        .filter-body-collapsible {
            display: none;
        }

        .filter-body-collapsible.show {
            display: block;
        }

        .belum-list {
            max-height: none;
            overflow-y: visible;
        }

        .status-badge {
            padding: 7px 10px;
        }

        .btn-reset-filter {
            min-width: 44px;
            min-height: 42px;
        }

        .laporan-pagination .page-link {
            min-width: 36px;
            min-height: 36px;
            font-size: 0.8rem;
            padding: 6px 10px;
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
        <div class="d-flex gap-2 export-actions">

            <a href="{{ route('admin.laporan.excel', request()->query()) }}"
               class="btn btn-success btn-sm"
               aria-label="Export Excel">

                <i class="bi bi-file-earmark-excel me-1"></i>
                <span class="d-none d-sm-inline">Export</span>
                Excel
            </a>

            <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
               class="btn btn-danger btn-sm"
               aria-label="Export PDF">

                <i class="bi bi-file-earmark-pdf me-1"></i>
                <span class="d-none d-sm-inline">Export</span>
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
                        <div class="min-w-0">
                            <div class="stat-label">Total Karyawan</div>
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
                        <div class="min-w-0">
                            <div class="stat-label">Sudah Mengambil</div>
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
                        <div class="min-w-0">
                            <div class="stat-label">Belum Mengambil</div>
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
                        <div class="min-w-0">
                            <div class="stat-label">Total Gula</div>
                            <div class="stat-number fw-bold text-info">
                                {{ number_format($statistik['totalGula'] ?? 0, 0, ',', '.') }}
                                <small class="fs-6">KG</small>
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

            {{-- Active Filter Summary --}}
            @php
                $hasActiveFilter = request()->hasAny(['tanggal_awal', 'tanggal_akhir', 'status', 'search']);
            @endphp

            @if($hasActiveFilter)
                <div class="active-filters">
                    @if(request('search'))
                        <span class="filter-chip">
                            <i class="bi bi-search"></i>
                            {{ request('search') }}
                        </span>
                    @endif

                    @if(request('tanggal_awal') || request('tanggal_akhir'))
                        <span class="filter-chip">
                            <i class="bi bi-calendar3"></i>
                            @if(request('tanggal_awal'))
                                {{ \Carbon\Carbon::parse(request('tanggal_awal'))->format('d/m/Y') }}
                            @else
                                ...
                            @endif
                            –
                            @if(request('tanggal_akhir'))
                                {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') }}
                            @else
                                ...
                            @endif
                        </span>
                    @endif

                    @if(request('status') === 'sudah')
                        <span class="filter-chip">
                            <i class="bi bi-check-circle"></i> Sudah Mengambil
                        </span>
                    @elseif(request('status') === 'belum')
                        <span class="filter-chip">
                            <i class="bi bi-clock"></i> Belum Mengambil
                        </span>
                    @endif
                </div>
            @endif

            {{-- Toggle button (mobile only) --}}
            <button type="button"
                    class="btn btn-outline-success btn-sm filter-toggle-btn
                           align-items-center justify-content-between w-100 mb-3"
                    onclick="document.getElementById('filterBody').classList.toggle('show'); this.querySelector('i.bi-chevron-down, i.bi-chevron-up').classList.toggle('bi-chevron-down'); this.querySelector('i.bi-chevron-down, i.bi-chevron-up').classList.toggle('bi-chevron-up');"
                    aria-label="Tampilkan / sembunyikan filter">

                <span>
                    <i class="bi bi-funnel me-1"></i>
                    Filter Laporan
                </span>
                <i class="bi bi-chevron-down"></i>
            </button>

            <div id="filterBody" class="filter-body-collapsible">

                <form method="GET" action="{{ route('admin.laporan.index') }}">

                    <div class="row g-3">

                        {{-- PENCARIAN NAMA / NIK --}}
                        <div class="col-12 col-md-3">
                            <label class="form-label fw-semibold">
                                Cari Nama / NIK
                            </label>
                            <input type="text"
                                   name="search"
                                   class="form-control"
                                   placeholder="Ketik nama atau NIK..."
                                   value="{{ request('search') }}">
                        </div>

                        {{-- TANGGAL AWAL --}}
                        <div class="col-12 col-md-2">
                            <label class="form-label fw-semibold">
                                Tanggal Awal
                            </label>
                            <input type="date"
                                   name="tanggal_awal"
                                   class="form-control"
                                   value="{{ request('tanggal_awal') }}">
                        </div>

                        {{-- TANGGAL AKHIR --}}
                        <div class="col-12 col-md-2">
                            <label class="form-label fw-semibold">
                                Tanggal Akhir
                            </label>
                            <input type="date"
                                   name="tanggal_akhir"
                                   class="form-control"
                                   value="{{ request('tanggal_akhir') }}">
                        </div>

                        {{-- STATUS --}}
                        <div class="col-12 col-md-2">
                            <label class="form-label fw-semibold">
                                Status
                            </label>
                            <select name="status" class="form-select">
                                <option value="">Semua</option>
                                <option value="sudah" {{ request('status') === 'sudah' ? 'selected' : '' }}>
                                    Sudah Mengambil
                                </option>
                                <option value="belum" {{ request('status') === 'belum' ? 'selected' : '' }}>
                                    Belum Mengambil
                                </option>
                            </select>
                        </div>

                        {{-- BUTTON --}}
                        <div class="col-12 col-md-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-success flex-grow-1">
                                <i class="bi bi-search me-1"></i>
                                Cari
                            </button>

                            @if($hasActiveFilter)
                                <a href="{{ route('admin.laporan.index') }}"
                                   class="btn btn-outline-secondary btn-reset-filter"
                                   title="Reset Filter"
                                   aria-label="Reset semua filter">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    <span class="d-none d-lg-inline ms-1">Reset</span>
                                </a>
                            @endif
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>


    {{-- =========================================================
         INFORMASI HASIL
    ========================================================== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Data Karyawan</h5>
            <small class="text-muted">
                @if(method_exists($laporan, 'total'))
                    Menampilkan
                    <strong>{{ $laporan->firstItem() ?? 0 }}–{{ $laporan->lastItem() ?? 0 }}</strong>
                    dari
                    <strong>{{ $laporan->total() }}</strong>
                    karyawan
                @else
                    Menampilkan
                    <strong>{{ $laporan->count() }}</strong>
                    karyawan
                @endif
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
                            <th class="text-center">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Bagian</th>
                            <th>Tanggal Ambil</th>
                            <th class="text-center">Jumlah Gula</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $key => $item)
                            <tr>
                                {{-- NO (fixed for pagination) --}}
                                <td class="text-center">
                                    @if(method_exists($laporan, 'firstItem') && $laporan->firstItem())
                                        {{ $laporan->firstItem() + $key }}
                                    @else
                                        {{ $key + 1 }}
                                    @endif
                                </td>

                                <td><strong>{{ $item->nik }}</strong></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kategori ?? '-' }}</td>
                                <td>{{ $item->bagian ?? '-' }}</td>

                                <td>
                                    @if($item->tanggal_ambil)
                                        {{ \Carbon\Carbon::parse($item->tanggal_ambil)->format('d-m-Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <strong class="{{ ($item->jumlah_gula ?? 0) > 0 ? 'text-success' : 'text-muted' }}">
                                        {{ number_format($item->jumlah_gula ?? 0, 0, ',', '.') }} KG
                                    </strong>
                                </td>

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
                                        <div class="fw-semibold">Data tidak ditemukan</div>
                                        <small>Belum ada data sesuai filter yang dipilih.</small>
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
         PAGINATION
    ========================================================== --}}
    @if(method_exists($laporan, 'links') && $laporan->hasPages())
        <div class="d-flex justify-content-center justify-content-md-end
                    mb-4 laporan-pagination">
            {{ $laporan->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    @endif


    {{-- =========================================================
         CARD MOBILE
    ========================================================== --}}
    <div class="d-block d-md-none mb-4">
        @forelse($laporan as $key => $item)
            <div class="card laporan-mobile-card shadow-sm border-0 mb-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="min-w-0">
                            <div class="employee-name">{{ $item->nama }}</div>
                            <div class="employee-nik">{{ $item->nik }}</div>
                        </div>
                        <div class="text-muted small flex-shrink-0">
                            #
                            @if(method_exists($laporan, 'firstItem') && $laporan->firstItem())
                                {{ $laporan->firstItem() + $key }}
                            @else
                                {{ $key + 1 }}
                            @endif
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-6">
                            <span class="mobile-info-label">Kategori</span>
                            <span class="mobile-info-value">{{ $item->kategori ?? '-' }}</span>
                        </div>
                        <div class="col-6">
                            <span class="mobile-info-label">Bagian</span>
                            <span class="mobile-info-value">{{ $item->bagian ?? '-' }}</span>
                        </div>
                        <div class="col-6">
                            <span class="mobile-info-label">Tanggal Ambil</span>
                            <span class="mobile-info-value">
                                @if($item->tanggal_ambil)
                                    {{ \Carbon\Carbon::parse($item->tanggal_ambil)->format('d-m-Y') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="col-6">
                            <span class="mobile-info-label">Jumlah Gula</span>
                            <span class="mobile-info-value fw-bold {{ ($item->jumlah_gula ?? 0) > 0 ? 'text-success' : 'text-muted' }}">
                                {{ number_format($item->jumlah_gula ?? 0, 0, ',', '.') }} KG
                            </span>
                        </div>
                    </div>

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
                    <div class="fw-semibold">Data tidak ditemukan</div>
                    <small>Belum ada data sesuai filter yang dipilih.</small>
                </div>
            </div>
        @endforelse
    </div>


    {{-- =========================================================
         DAFTAR KARYAWAN BELUM MENGAMBIL
    ========================================================== --}}
    @php
        if (isset($belumMengambilAll)) {
            $sumberBelum = $belumMengambilAll;
        } elseif (is_object($laporan) && method_exists($laporan, 'items')) {
            $sumberBelum = $laporan->items();
        } else {
            $sumberBelum = $laporan;
        }

        $belumMengambil = collect($sumberBelum)
            ->filter(function ($item) {
                return $item->status_pengambilan === 'belum';
            });
    @endphp

    @if($belumMengambil->count() > 0)
        <div class="card belum-card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row
                            justify-content-between
                            align-items-md-center
                            gap-2 mb-3">
                    <div>
                        <div class="belum-title">
                            <i class="bi bi-person-exclamation text-warning me-2"></i>
                            Karyawan Belum Mengambil
                        </div>
                        <div class="belum-description">
                            Daftar karyawan yang belum mengambil gula pada periode yang dipilih.
                        </div>
                    </div>
                    <span class="badge bg-warning text-dark">
                        {{ $belumMengambil->count() }} Karyawan
                    </span>
                </div>

                <div class="belum-list">
                    @foreach($belumMengambil as $item)
                        <div class="belum-item">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <div class="flex-grow-1 min-w-0">
                                    <div class="belum-name">{{ $item->nama }}</div>
                                    <div class="belum-meta">
                                        <span class="meta-chip">NIK: {{ $item->nik }}</span>
                                        @if($item->kategori)
                                            <span class="meta-chip">{{ $item->kategori }}</span>
                                        @endif
                                        @if($item->bagian)
                                            <span class="meta-chip">{{ $item->bagian }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="belum-gula text-nowrap">0 KG</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @elseif(request('status') === 'belum')
        <div class="alert alert-success border-0 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>
            Semua karyawan sudah mengambil gula pada periode tersebut.
        </div>
    @endif

</div>

@endsection