@extends('layouts.app')

@section('title', 'Laporan Pengambilan Gula')

@section('content')

<style>
    /* =========================================================
       LAPORAN PENGAMBILAN GULA — versi sederhana & modern
       Dibangun pakai CSS variables + clamp() supaya responsif
       tanpa perlu override manual di banyak breakpoint.
    ========================================================= */

    .laporan-page {
        --brand: #198754;
        --brand-soft: #e8f5e9;
        --brand-border: #c8e6c9;
        --warning: #997404;
        --warning-soft: #fff3cd;
        --info: #0d6efd;
        --ink: #212529;
        --muted: #6c757d;
        --muted-soft: #8a9299;
        --border: #e9ecef;
        --surface: #ffffff;
        --bg-soft: #f8f9fa;
        --radius: 12px;
        --radius-sm: 8px;
        --shadow: 0 1px 2px rgba(16, 24, 40, .06), 0 1px 3px rgba(16, 24, 40, .04);
        --shadow-hover: 0 8px 20px rgba(16, 24, 40, .08);

        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        padding-bottom: clamp(15px, 3vw, 25px);
        color: var(--ink);
    }

    .laporan-page * { box-sizing: border-box; }

    .card-base {
        border: 1px solid var(--border) !important;
        border-radius: var(--radius);
        background: var(--surface);
        box-shadow: var(--shadow) !important;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .laporan-header { margin-bottom: clamp(16px, 3vw, 22px); }

    .laporan-header h2 {
        font-size: clamp(1.15rem, 1rem + 1vw, 1.45rem);
        font-weight: 700;
        color: var(--brand);
        margin-bottom: 4px;
    }

    .laporan-header p {
        font-size: .82rem;
        color: var(--muted);
        margin: 0;
        line-height: 1.5;
    }

    .export-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .export-actions .btn {
        flex: 1 1 auto;
        min-height: 40px;
        border-radius: var(--radius-sm);
        font-size: .8rem;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================================================
       SUMMARY CARDS
    ========================================================= */

    .summary-card-link { text-decoration: none; color: inherit; display: block; height: 100%; }

    .summary-card {
        transition: transform .15s ease, box-shadow .15s ease;
        padding: clamp(11px, 2.5vw, 16px);
    }

    .summary-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover) !important;
    }

    .summary-row { display: flex; align-items: flex-start; gap: 10px; }

    .summary-icon {
        width: clamp(32px, 6vw, 44px);
        height: clamp(32px, 6vw, 44px);
        min-width: clamp(32px, 6vw, 44px);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: clamp(.85rem, 2vw, 1.05rem);
    }

    .summary-label { font-size: .72rem; color: var(--muted); margin-bottom: 3px; font-weight: 500; }

    .summary-number { font-size: clamp(1rem, .8rem + 1vw, 1.3rem); font-weight: 700; line-height: 1.2; }
    .summary-number small { font-size: .65rem; font-weight: 600; margin-left: 2px; }

    .summary-meta { font-size: .65rem; color: var(--muted-soft); margin-top: 4px; }

    .summary-progress { height: 4px; background: var(--border); border-radius: 10px; overflow: hidden; margin-top: 8px; }
    .summary-progress-bar { height: 100%; border-radius: 10px; }

    /* =========================================================
       FILTER
    ========================================================= */

    .filter-card { padding: clamp(13px, 2.5vw, 17px); }

    .filter-title { font-size: .86rem; font-weight: 700; }
    .filter-subtitle { font-size: .72rem; color: var(--muted); margin-top: 3px; line-height: 1.4; }

    .filter-card label { display: block; font-size: .73rem; font-weight: 600; color: #495057; margin-bottom: 5px; }

    .filter-card .form-control,
    .filter-card .form-select {
        min-height: 41px;
        border-radius: 7px;
        font-size: .78rem;
        border-color: #dee2e6;
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #86c7a5;
        box-shadow: 0 0 0 .15rem rgba(25, 135, 84, .1);
    }

    .filter-card .btn { min-height: 41px; border-radius: 7px; font-size: .78rem; font-weight: 600; }

    .filter-toggle-btn { display: none; }
    .filter-body-collapsible { display: block; }

    .active-filters { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 14px; }

    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 20px;
        background: var(--brand-soft);
        color: var(--brand);
        border: 1px solid var(--brand-border);
        font-size: .67rem;
        font-weight: 600;
    }

    /* =========================================================
       HASIL LAPORAN
    ========================================================= */

    .hasil-title { font-size: 1rem; font-weight: 700; margin-bottom: 3px; }
    .hasil-description { font-size: .75rem; color: var(--muted); margin: 0; line-height: 1.45; }

    .data-count { display: inline-flex; align-items: center; gap: 5px; margin-top: 6px; font-size: .68rem; color: var(--muted); }
    .data-count strong { color: #495057; }

    .periode-box {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 11px;
        background: var(--bg-soft);
        border: 1px solid var(--border);
        border-radius: 7px;
        font-size: .71rem;
        white-space: nowrap;
    }

    .periode-box i { color: var(--brand); font-size: .85rem; }
    .periode-box strong { font-weight: 600; }

    /* =========================================================
       MONTH SWITCHER
    ========================================================= */

    .month-switcher {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--bg-soft);
        border: 1px solid var(--border);
        border-radius: 7px;
        padding: 4px;
    }

    .month-switcher .btn-month-nav {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        color: var(--brand);
        background: transparent;
        border: none;
        text-decoration: none;
        font-size: .85rem;
        transition: background .15s ease;
    }

    .month-switcher .btn-month-nav:hover { background: var(--brand-soft); }

    .month-switcher .btn-month-nav.disabled {
        color: #c7ccd1;
        pointer-events: none;
    }

    .month-switcher .month-label {
        min-width: 130px;
        text-align: center;
        font-size: .78rem;
        font-weight: 700;
        color: var(--ink);
        padding: 0 6px;
    }

    .month-today-link {
        font-size: .68rem;
        font-weight: 600;
        color: var(--brand);
        text-decoration: none;
        padding: 6px 10px;
        border: 1px solid var(--brand-border);
        border-radius: 7px;
        background: var(--brand-soft);
        white-space: nowrap;
    }

    .month-today-link:hover { color: var(--brand); background: #d9efdc; }

    /* =========================================================
       TABLE (desktop)
    ========================================================= */

    .table-card { overflow: hidden; }

    .laporan-table { margin: 0; font-size: .78rem; min-width: 900px; }

    .laporan-table thead th {
        background: var(--brand);
        color: #fff;
        border-color: rgba(255, 255, 255, .15);
        font-size: .71rem;
        font-weight: 600;
        white-space: nowrap;
        padding: 11px 10px;
    }

    .laporan-table tbody td { padding: 10px; border-color: var(--border); vertical-align: middle; }
    .laporan-table tbody tr:hover { background: #f8fbf9; }

    .laporan-table .nik { font-weight: 600; white-space: nowrap; color: #495057; }
    .laporan-table .nama { font-weight: 600; min-width: 160px; }

    .jumlah-gula { font-weight: 700; color: var(--brand); white-space: nowrap; }
    .jumlah-gula.empty { color: #adb5bd; font-weight: 500; }

    /* =========================================================
       STATUS BADGE (dipakai desktop & mobile)
    ========================================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border-radius: 20px;
        padding: 5px 9px;
        font-size: .65rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-sudah { background: #d1e7dd; color: #146c43; }
    .status-belum { background: var(--warning-soft); color: var(--warning); }

    /* =========================================================
       TABLE FOOTER
    ========================================================= */

    .table-footer {
        padding: 12px 15px;
        background: var(--bg-soft);
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-footer-label { font-size: .71rem; color: var(--muted); }
    .table-footer-value { font-size: .85rem; font-weight: 700; color: var(--brand); }

    /* =========================================================
       MOBILE CARD LIST (pengganti tabel di layar kecil)
    ========================================================= */

    .laporan-mobile-list { display: none; }

    .mobile-report-card { padding: 14px; }

    .mobile-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
    }

    .mobile-employee-name { font-size: .88rem; font-weight: 700; word-break: break-word; }
    .mobile-employee-nik { font-size: .67rem; color: var(--muted); margin-top: 3px; }

    .mobile-number {
        min-width: 28px;
        height: 28px;
        padding: 0 7px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f3f5;
        color: var(--muted);
        font-size: .67rem;
        font-weight: 600;
    }

    .mobile-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 15px; margin-top: 13px; }

    .mobile-info-label { display: block; font-size: .64rem; color: var(--muted-soft); margin-bottom: 3px; }
    .mobile-info-value { display: block; font-size: .75rem; font-weight: 500; word-break: break-word; }

    .mobile-gula { color: var(--brand); font-weight: 700; }
    .mobile-gula.empty { color: #adb5bd; font-weight: 500; }

    .mobile-status-row {
        margin-top: 13px;
        padding-top: 11px;
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .mobile-status-label { font-size: .65rem; color: var(--muted-soft); }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state { padding: clamp(35px, 8vw, 55px) 20px; text-align: center; color: var(--muted); }
    .empty-state i { display: block; font-size: 2.5rem; color: #adb5bd; margin-bottom: 10px; }
    .empty-state-title { font-size: .88rem; font-weight: 600; color: #495057; margin-bottom: 3px; }
    .empty-state-text { font-size: .73rem; line-height: 1.5; }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .laporan-pagination { margin-top: 15px; }
    .laporan-pagination .pagination { margin-bottom: 0; gap: 4px; flex-wrap: wrap; }

    .laporan-pagination .page-link {
        min-width: 36px;
        min-height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px !important;
        font-size: .73rem;
        color: var(--brand);
        border-color: #dee2e6;
    }

    .laporan-pagination .page-item.active .page-link {
        background: var(--brand);
        border-color: var(--brand);
        color: #fff;
    }

    /* =========================================================
       MOBILE (< 768px) — hanya yang benar-benar perlu berubah
       struktur, bukan cuma ukuran font (sudah ditangani clamp)
    ========================================================= */

    @media (max-width: 767.98px) {

        .export-actions { width: 100%; display: grid; grid-template-columns: 1fr 1fr; }

        .filter-toggle-btn {
            display: flex;
            width: 100%;
            min-height: 40px;
            align-items: center;
            justify-content: space-between;
            border-radius: 7px;
            font-size: .74rem;
        }

        .filter-body-collapsible { display: none; padding-top: 13px; }
        .filter-body-collapsible.show { display: block; }

        .periode-box { width: 100%; margin-top: 9px; white-space: normal; }

        .laporan-desktop-table { display: none !important; }
        .laporan-mobile-list { display: block; }

        .laporan-pagination .pagination { justify-content: center; }
    }
</style>


<div class="laporan-page">

    {{-- HEADER --}}
    <div class="laporan-header d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
        <div>
            <h2><i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Laporan Pengambilan Gula</h2>
            <p>Rekapitulasi data pengambilan bonus gula karyawan PG Gending</p>
        </div>

        <div class="export-actions">
            <a href="{{ route('admin.laporan.excel', request()->query()) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel me-1"></i>Export Excel
            </a>
            <a href="{{ route('admin.laporan.pdf', request()->query()) }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf me-1"></i>Export PDF
            </a>
        </div>
    </div>


    {{-- RINGKASAN --}}
    @php
        $totalKaryawan = $statistik['totalKaryawan'] ?? (($statistik['sudahAmbil'] ?? 0) + ($statistik['belumAmbil'] ?? 0));
        $sudahAmbil = $statistik['sudahAmbil'] ?? 0;
        $belumAmbil = $statistik['belumAmbil'] ?? 0;
        $persentaseSudah = $totalKaryawan > 0 ? round(($sudahAmbil / $totalKaryawan) * 100) : 0;
        $persentaseBelum = $totalKaryawan > 0 ? round(($belumAmbil / $totalKaryawan) * 100) : 0;
        $totalGula = $statistik['totalGula'] ?? 0;

        // ==== PERIODE BULANAN ====
        // $bulanAktif / $tahunAktif idealnya dikirim dari Controller
        // (fallback ke bulan berjalan kalau belum ada, supaya view tetap aman).
        $bulanAktif = (int) ($bulanAktif ?? request('bulan', now()->month));
        $tahunAktif = (int) ($tahunAktif ?? request('tahun', now()->year));

        $periodeAktif = \Carbon\Carbon::createFromDate($tahunAktif, $bulanAktif, 1);
        $periodeSekarang = now()->startOfMonth();
        $isBulanIni = $periodeAktif->isSameMonth($periodeSekarang);

        $bulanPrev = $periodeAktif->copy()->subMonth();
        $bulanNext = $periodeAktif->copy()->addMonth();

        $queryTanpaBulan = request()->except(['bulan', 'tahun', 'page']);

        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
    @endphp

    <div class="row g-2 g-md-3 mb-4">

        {{-- SUDAH MENGAMBIL --}}
        <div class="col-6 col-md-4">
            <div class="card-base summary-card h-100">
                <div class="summary-row">
                    <div class="summary-icon bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle-fill"></i></div>
                    <div class="min-w-0 flex-grow-1">
                        <div class="summary-label">Sudah Mengambil</div>
                        <div class="summary-number text-success">
                            {{ number_format($sudahAmbil, 0, ',', '.') }} <small>Karyawan</small>
                        </div>
                        <div class="summary-meta">{{ $persentaseSudah }}% dari total karyawan</div>
                        <div class="summary-progress">
                            <div class="summary-progress-bar bg-success" style="width: {{ $persentaseSudah }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BELUM MENGAMBIL --}}
        <div class="col-6 col-md-4">
            <a href="{{ route('admin.laporan.index', array_merge(request()->except('page'), ['status' => 'belum'])) }}" class="summary-card-link">
                <div class="card-base summary-card h-100">
                    <div class="summary-row">
                        <div class="summary-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-clock-fill"></i></div>
                        <div class="min-w-0 flex-grow-1">
                            <div class="summary-label">Belum Mengambil</div>
                            <div class="summary-number text-warning">
                                {{ number_format($belumAmbil, 0, ',', '.') }} <small>Karyawan</small>
                            </div>
                            <div class="summary-meta">{{ $persentaseBelum }}% dari total karyawan</div>
                            <div class="summary-progress">
                                <div class="summary-progress-bar bg-warning" style="width: {{ $persentaseBelum }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- TOTAL GULA --}}
        <div class="col-12 col-md-4">
            <div class="card-base summary-card h-100">
                <div class="summary-row">
                    <div class="summary-icon bg-info bg-opacity-10 text-info"><i class="bi bi-box-seam-fill"></i></div>
                    <div class="min-w-0">
                        <div class="summary-label">Total Gula Tersalurkan</div>
                        <div class="summary-number text-info">
                            {{ number_format($totalGula, 0, ',', '.') }} <small>KG</small>
                        </div>
                        <div class="summary-meta">Berdasarkan data laporan yang ditampilkan</div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- FILTER --}}
    <div class="card-base filter-card mb-4">

        @php
            $hasActiveFilter = request()->hasAny(['status', 'search']);
        @endphp

        @if($hasActiveFilter)
            <div class="active-filters">
                @if(request('search'))
                    <span class="filter-chip"><i class="bi bi-search"></i>{{ request('search') }}</span>
                @endif

                @if(request('status') === 'sudah')
                    <span class="filter-chip"><i class="bi bi-check-circle"></i>Sudah Mengambil</span>
                @elseif(request('status') === 'belum')
                    <span class="filter-chip"><i class="bi bi-clock"></i>Belum Mengambil</span>
                @endif
            </div>
        @endif

        <button type="button" class="btn btn-outline-success filter-toggle-btn" onclick="
            const body = document.getElementById('filterBody');
            body.classList.toggle('show');
            const icon = this.querySelector('.filter-chevron');
            icon.classList.toggle('bi-chevron-down');
            icon.classList.toggle('bi-chevron-up');
        ">
            <span><i class="bi bi-funnel me-1"></i>Filter Laporan</span>
            <i class="bi bi-chevron-down filter-chevron"></i>
        </button>

        <div id="filterBody" class="filter-body-collapsible">

            <div class="mb-3">
                <div class="filter-title">Filter Laporan</div>
                <div class="filter-subtitle">Pilih bulan &amp; tahun, lalu saring nama, NIK, atau status pengambilan.</div>
            </div>

            <form method="GET" action="{{ route('admin.laporan.index') }}">
                <div class="row g-3">

                    <div class="col-6 col-md-3">
                        <label>Bulan</label>
                        <select name="bulan" class="form-select">
                            @foreach($namaBulan as $angka => $nama)
                                <option value="{{ $angka }}" {{ $bulanAktif == $angka ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 col-md-2">
                        <label>Tahun</label>
                        <select name="tahun" class="form-select">
                            @for($thn = now()->year; $thn >= now()->year - 4; $thn--)
                                <option value="{{ $thn }}" {{ $tahunAktif == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-12 col-md-3">
                        <label>Nama / NIK</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK..." value="{{ request('search') }}">
                    </div>

                    <div class="col-12 col-md-2">
                        <label>Status Pengambilan</label>
                        <select name="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="sudah" {{ request('status') === 'sudah' ? 'selected' : '' }}>Sudah Mengambil</option>
                            <option value="belum" {{ request('status') === 'belum' ? 'selected' : '' }}>Belum Mengambil</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1">
                            <i class="bi bi-search me-1"></i>Tampilkan
                        </button>

                        @if($hasActiveFilter)
                            <a href="{{ route('admin.laporan.index', ['bulan' => $bulanAktif, 'tahun' => $tahunAktif]) }}" class="btn btn-outline-secondary" title="Reset Filter">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>
                        @endif
                    </div>

                </div>
            </form>
        </div>
    </div>


    {{-- HASIL LAPORAN --}}
    <div class="hasil-header mb-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <div class="hasil-title">
                    Sudah Mengambil Gula – {{ $namaBulan[$bulanAktif] }} {{ $tahunAktif }}
                </div>
                <p class="hasil-description">
                    @if($isBulanIni)
                        Daftar karyawan yang sudah &amp; belum mengambil gula pada bulan berjalan.
                    @else
                        Daftar karyawan yang sudah &amp; belum mengambil gula pada periode ini.
                    @endif
                </p>
                <div class="data-count">
                    <i class="bi bi-database"></i>
                    <span>Menampilkan <strong>{{ $laporan->total() ?? $laporan->count() }}</strong> data karyawan</span>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">

                <div class="month-switcher">
                    <a class="btn-month-nav"
                       href="{{ route('admin.laporan.index', array_merge($queryTanpaBulan, ['bulan' => $bulanPrev->month, 'tahun' => $bulanPrev->year])) }}"
                       title="Bulan sebelumnya">
                        <i class="bi bi-chevron-left"></i>
                    </a>

                    <span class="month-label">{{ $namaBulan[$bulanAktif] }} {{ $tahunAktif }}</span>

                    <a class="btn-month-nav {{ $isBulanIni ? 'disabled' : '' }}"
                       href="{{ $isBulanIni ? '#' : route('admin.laporan.index', array_merge($queryTanpaBulan, ['bulan' => $bulanNext->month, 'tahun' => $bulanNext->year])) }}"
                       title="Bulan berikutnya">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                @unless($isBulanIni)
                    <a class="month-today-link" href="{{ route('admin.laporan.index', array_merge($queryTanpaBulan, ['bulan' => now()->month, 'tahun' => now()->year])) }}">
                        <i class="bi bi-calendar-check me-1"></i>Bulan Ini
                    </a>
                @endunless

            </div>
        </div>
    </div>


    {{-- DESKTOP TABLE --}}
    <div class="card-base table-card mb-4 laporan-desktop-table">
        <div class="table-responsive">
            <table class="table laporan-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" width="55">No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
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
                            <td class="text-center text-muted">
                                {{ (method_exists($laporan, 'firstItem') && $laporan->firstItem()) ? $laporan->firstItem() + $key : $key + 1 }}
                            </td>
                            <td class="nik">{{ $item->nik }}</td>
                            <td class="nama">{{ $item->nama }}</td>
                            <td>{{ $item->kategori ?? '-' }}</td>
                            <td>{{ $item->bagian ?? '-' }}</td>
                            <td>{{ $item->tanggal_ambil ? \Carbon\Carbon::parse($item->tanggal_ambil)->format('d-m-Y') : '-' }}</td>
                            <td class="text-center">
                                @if($item->status_pengambilan === 'sudah')
                                    <span class="jumlah-gula">{{ number_format($item->jumlah_gula ?? 0, 0, ',', '.') }} KG</span>
                                @else
                                    <span class="jumlah-gula empty">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->status_pengambilan === 'sudah')
                                    <span class="status-badge status-sudah"><i class="bi bi-check-circle-fill"></i>Sudah Mengambil</span>
                                @else
                                    <span class="status-badge status-belum"><i class="bi bi-clock-fill"></i>Belum Mengambil</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <div class="empty-state-title">Tidak Ada Data Laporan</div>
                                    <div class="empty-state-text">Belum terdapat data pengambilan gula sesuai periode atau filter yang dipilih.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($laporan->count() > 0)
            <div class="table-footer">
                <span class="table-footer-label">Total Gula Tersalurkan</span>
                <span class="table-footer-value">{{ number_format($statistik['totalGula'] ?? 0, 0, ',', '.') }} KG</span>
            </div>
        @endif
    </div>


    {{-- MOBILE CARD LIST --}}
    <div class="laporan-mobile-list mb-4">
        @forelse($laporan as $key => $item)
            <div class="card-base mobile-report-card mb-3">
                <div class="mobile-card-header">
                    <div class="mobile-employee">
                        <div class="mobile-employee-name">{{ $item->nama }}</div>
                        <div class="mobile-employee-nik">NIK: {{ $item->nik }}</div>
                    </div>
                    <div class="mobile-number">
                        {{ (method_exists($laporan, 'firstItem') && $laporan->firstItem()) ? $laporan->firstItem() + $key : $key + 1 }}
                    </div>
                </div>

                <div class="mobile-info-grid">
                    <div class="mobile-info-item">
                        <span class="mobile-info-label">Kategori</span>
                        <span class="mobile-info-value">{{ $item->kategori ?? '-' }}</span>
                    </div>
                    <div class="mobile-info-item">
                        <span class="mobile-info-label">Bagian</span>
                        <span class="mobile-info-value">{{ $item->bagian ?? '-' }}</span>
                    </div>
                    <div class="mobile-info-item">
                        <span class="mobile-info-label">Tanggal Ambil</span>
                        <span class="mobile-info-value">{{ $item->tanggal_ambil ? \Carbon\Carbon::parse($item->tanggal_ambil)->format('d-m-Y') : '-' }}</span>
                    </div>
                    <div class="mobile-info-item">
                        <span class="mobile-info-label">Jumlah Gula</span>
                        @if($item->status_pengambilan === 'sudah')
                            <span class="mobile-info-value mobile-gula">{{ number_format($item->jumlah_gula ?? 0, 0, ',', '.') }} KG</span>
                        @else
                            <span class="mobile-info-value mobile-gula empty">-</span>
                        @endif
                    </div>
                </div>

                <div class="mobile-status-row">
                    <span class="mobile-status-label">Status Pengambilan</span>
                    @if($item->status_pengambilan === 'sudah')
                        <span class="status-badge status-sudah"><i class="bi bi-check-circle-fill"></i>Sudah Mengambil</span>
                    @else
                        <span class="status-badge status-belum"><i class="bi bi-clock-fill"></i>Belum Mengambil</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="card-base">
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <div class="empty-state-title">Tidak Ada Data Laporan</div>
                    <div class="empty-state-text">Belum terdapat data pengambilan gula sesuai periode atau filter yang dipilih.</div>
                </div>
            </div>
        @endforelse
    </div>


    {{-- PAGINATION --}}
    @if(method_exists($laporan, 'links') && $laporan->hasPages())
        <div class="d-flex justify-content-end laporan-pagination">
            {{ $laporan->onEachSide(1)->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

@endsection