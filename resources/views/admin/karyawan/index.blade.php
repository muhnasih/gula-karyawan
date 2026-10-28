@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')
@php
    $inisial = function ($nama) {
        $kata = preg_split('/\s+/', trim((string) $nama));
        $hasil = '';
        foreach (array_slice($kata, 0, 2) as $k) {
            $hasil .= mb_strtoupper(mb_substr($k, 0, 1));
        }
        return $hasil ?: '?';
    };

    $warnaAvatar = function ($nama) {
        return 'tone-' . (abs(crc32((string) $nama)) % 5);
    };

    $isAktif = function ($status) {
        return strtolower((string) $status) === 'aktif';
    };

    $adaFilter = request()->filled('cari') || request()->filled('kategori') || request()->filled('status');
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .emp {
        --ink: #0f172a;
        --ink-soft: #64748b;
        --line: #e2e8f0;
        --paper: #ffffff;
        --wash: #f8fafc;
        --leaf: #0d9488;
        --leaf-deep: #0f766e;
        --leaf-tint: #ccfbf1;
        --rose: #e11d48;
        --rose-tint: #ffe4e6;
        --shadow: 0 1px 3px rgba(15, 23, 42, .06), 0 1px 2px rgba(15, 23, 42, .04);
        --shadow-md: 0 4px 12px rgba(15, 23, 42, .08);

        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
        color: var(--ink);
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
        padding-bottom: 100px;
        box-sizing: border-box;
    }

    .emp *,
    .emp *::before,
    .emp *::after {
        box-sizing: border-box;
    }

    .emp *:focus-visible {
        outline: 3px solid rgba(13, 148, 136, .4);
        outline-offset: 2px;
    }

    /* ===== Header ===== */
    .emp-head {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px 20px;
        margin-bottom: 24px;
    }

    .emp-title {
        font-size: clamp(1.35rem, 4vw, 1.7rem);
        font-weight: 800;
        letter-spacing: -.025em;
        margin: 0 0 6px;
        line-height: 1.2;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
    }

    .emp-total {
        display: inline-flex;
        align-items: center;
        padding: 3px 11px;
        font-size: .78rem;
        font-weight: 700;
        color: var(--leaf-deep);
        background: var(--leaf-tint);
        border-radius: 999px;
        white-space: nowrap;
    }

    .emp-sub {
        color: var(--ink-soft);
        font-size: .9rem;
        margin: 0;
        max-width: 48ch;
        line-height: 1.45;
    }

    .emp-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        flex-shrink: 0;
    }

    .emp .btn-emp {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 15px;
        font-size: .875rem;
        font-weight: 600;
        border-radius: 10px;
        border: 1px solid transparent;
        text-decoration: none;
        cursor: pointer;
        transition: background .15s, border-color .15s, color .15s, box-shadow .15s;
        white-space: nowrap;
        line-height: 1.3;
    }

    .emp .btn-emp-main {
        background: var(--leaf);
        color: #fff;
        box-shadow: 0 1px 2px rgba(13, 148, 136, .25);
    }
    .emp .btn-emp-main:hover {
        background: var(--leaf-deep);
        color: #fff;
    }

    .emp .btn-emp-dark {
        background: var(--ink);
        color: #fff;
    }
    .emp .btn-emp-dark:hover {
        background: #020617;
        color: #fff;
    }

    .emp .btn-emp-ghost {
        background: var(--paper);
        color: var(--ink);
        border-color: var(--line);
    }
    .emp .btn-emp-ghost:hover {
        border-color: #94a3b8;
        background: var(--wash);
        color: var(--ink);
    }

    .emp .btn-emp-danger {
        background: var(--paper);
        color: var(--rose);
        border: 1px solid #fecdd3;
    }
    .emp .btn-emp-danger:hover {
        background: var(--rose-tint);
        color: var(--rose);
    }

    /* ===== Alert ===== */
    .emp .alert {
        border: 0;
        border-radius: 12px;
        font-size: .9rem;
        margin-bottom: 16px;
    }

    /* ===== Filter ===== */
    .emp-filter {
        display: grid;
        grid-template-columns: minmax(0, 2.2fr) minmax(0, 1fr) minmax(0, 1fr) auto;
        gap: 10px;
        padding: 14px;
        margin-bottom: 18px;
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: 14px;
        box-shadow: var(--shadow);
    }

    .emp-search {
        position: relative;
        min-width: 0;
    }

    .emp-search i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft);
        pointer-events: none;
        font-size: .95rem;
    }

    .emp-search .form-control {
        padding-left: 40px;
    }

    .emp .form-control,
    .emp .form-select {
        border-radius: 10px;
        border: 1px solid var(--line);
        background-color: var(--wash);
        font-size: .9rem;
        padding: 9px 12px;
        color: var(--ink);
        width: 100%;
        min-width: 0;
    }

    .emp .form-control:focus,
    .emp .form-select:focus {
        background-color: #fff;
        border-color: var(--leaf);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, .15);
    }

    .emp-filter-btns {
        display: flex;
        gap: 8px;
        align-items: stretch;
    }

    .emp-filter-btns .btn-emp {
        height: 100%;
        min-height: 42px;
    }

    /* ===== Select row ===== */
    .emp-select-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 12px;
        padding: 0 2px;
        font-size: .85rem;
        color: var(--ink-soft);
    }

    .emp .form-check-input {
        cursor: pointer;
        border-color: #cbd5e1;
        width: 1.1em;
        height: 1.1em;
    }

    .emp .form-check-input:checked {
        background-color: var(--leaf);
        border-color: var(--leaf);
    }

    /* ===== Tabel desktop ===== */
    .emp-table-wrap {
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .emp-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .emp-table thead th {
        padding: 12px 14px;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        color: var(--ink-soft);
        background: var(--wash);
        border-bottom: 1px solid var(--line);
        white-space: nowrap;
    }

    .emp-table tbody td {
        padding: 13px 14px;
        vertical-align: middle;
        border-bottom: 1px solid var(--line);
        font-size: .9rem;
    }

    .emp-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .emp-table tbody tr {
        transition: background-color .12s;
    }

    .emp-table tbody tr:hover {
        background: #f1f5f9;
    }

    .emp-table tbody tr:has(.row-checkbox:checked) {
        background: var(--leaf-tint);
    }

    .cell-person {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .cell-person-text {
        min-width: 0;
        overflow: hidden;
    }

    .person-name {
        font-weight: 700;
        line-height: 1.3;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .person-nik {
        font-size: .78rem;
        color: var(--ink-soft);
        font-variant-numeric: tabular-nums;
        margin-top: 1px;
    }

    .cell-role-main {
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .cell-role-sub {
        font-size: .78rem;
        color: var(--ink-soft);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-top: 1px;
    }

    .emp-muted {
        color: #94a3b8;
    }

    /* Avatar */
    .avatar {
        flex: 0 0 auto;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        font-size: .8rem;
        font-weight: 800;
        letter-spacing: .02em;
    }

    .tone-0 { background: #dbeafe; color: #1d4ed8; }
    .tone-1 { background: #ccfbf1; color: #0f766e; }
    .tone-2 { background: #fef3c7; color: #b45309; }
    .tone-3 { background: #ede9fe; color: #6d28d9; }
    .tone-4 { background: #ffe4e6; color: #be123c; }

    /* Status & kategori */
    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .82rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
        flex-shrink: 0;
    }

    .status-aktif { color: var(--leaf-deep); }
    .status-nonaktif { color: var(--rose); }

    .kategori {
        display: inline-block;
        padding: 3px 10px;
        font-size: .78rem;
        font-weight: 600;
        color: var(--ink);
        background: var(--wash);
        border: 1px solid var(--line);
        border-radius: 7px;
        white-space: nowrap;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Icon buttons */
    .icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        color: var(--ink-soft);
        background: transparent;
        border: 1px solid var(--line);
        border-radius: 9px;
        text-decoration: none;
        cursor: pointer;
        transition: color .15s, background .15s, border-color .15s;
        flex-shrink: 0;
    }

    .icon-btn:hover {
        color: var(--ink);
        background: var(--wash);
    }

    .icon-btn.is-danger:hover {
        color: var(--rose);
        background: var(--rose-tint);
        border-color: #fecdd3;
    }

    .row-actions {
        display: flex;
        justify-content: center;
        gap: 6px;
    }

    .row-actions form {
        margin: 0;
    }

    /* ===== Kartu mobile ===== */
    .m-card {
        padding: 14px;
        margin-bottom: 10px;
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: 14px;
        box-shadow: var(--shadow);
    }

    .m-card:has(.row-checkbox:checked) {
        background: var(--leaf-tint);
        border-color: #99f6e4;
    }

    .m-top {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .m-top .cell-person {
        flex: 1;
        min-width: 0;
    }

    .m-status-wrap {
        flex-shrink: 0;
        padding-top: 2px;
    }

    .m-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 16px;
        margin: 14px 0 0;
        padding-top: 12px;
        border-top: 1px dashed var(--line);
        font-size: .85rem;
    }

    .m-meta dt {
        font-size: .72rem;
        font-weight: 500;
        color: var(--ink-soft);
        margin-bottom: 3px;
        text-transform: uppercase;
        letter-spacing: .02em;
    }

    .m-meta dd {
        margin: 0;
        font-weight: 600;
        word-break: break-word;
        line-height: 1.35;
    }

    .m-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-top: 14px;
    }

    .m-actions form {
        margin: 0;
    }

    .m-actions .btn-emp {
        width: 100%;
        padding: 9px 10px;
        font-size: .84rem;
    }

    /* ===== Empty state ===== */
    .empty {
        padding: 52px 20px;
        text-align: center;
        color: var(--ink-soft);
    }

    .empty i {
        font-size: 2.1rem;
        color: #cbd5e1;
    }

    .empty-title {
        margin: 12px 0 6px;
        font-weight: 700;
        color: var(--ink);
        font-size: 1.05rem;
    }

    .empty p {
        margin: 0 auto 18px;
        max-width: 36ch;
        font-size: .88rem;
        line-height: 1.5;
    }

    /* ===== Bulk bar ===== */
    .bulk-action-bar {
        position: fixed;
        left: 50%;
        bottom: 20px;
        transform: translateX(-50%);
        z-index: 1040;
        display: flex;
        align-items: center;
        gap: 10px 14px;
        padding: 10px 12px 10px 18px;
        color: #fff;
        background: var(--ink);
        border-radius: 14px;
        box-shadow: 0 12px 32px rgba(15, 23, 42, .32);
        animation: bulk-in .2s ease-out;
        max-width: calc(100vw - 24px);
        flex-wrap: wrap;
        justify-content: center;
    }

    .bulk-action-bar.d-none {
        display: none !important;
    }

    .bulk-info {
        font-size: .9rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .bulk-cancel {
        padding: 8px 12px;
        font-size: .85rem;
        font-weight: 600;
        color: #94a3b8;
        background: transparent;
        border: 0;
        border-radius: 8px;
        cursor: pointer;
    }

    .bulk-cancel:hover {
        color: #fff;
        background: rgba(255, 255, 255, .08);
    }

    .bulk-delete {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 15px;
        font-size: .85rem;
        font-weight: 700;
        color: #fff;
        background: #e11d48;
        border: 0;
        border-radius: 9px;
        cursor: pointer;
    }

    .bulk-delete:hover {
        background: #be123c;
    }

    @keyframes bulk-in {
        from { opacity: 0; transform: translate(-50%, 12px); }
        to   { opacity: 1; transform: translate(-50%, 0); }
    }

    @media (prefers-reduced-motion: reduce) {
        .bulk-action-bar { animation: none; }
        .emp * { transition: none !important; }
    }

    /* ===== Modal ===== */
    .emp-modal .modal-content {
        border: 0;
        border-radius: 16px;
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        color: var(--ink);
    }

    .emp-modal .modal-header,
    .emp-modal .modal-footer {
        border-color: var(--line);
        padding: 16px 20px;
    }

    .emp-modal .modal-body {
        padding: 20px;
    }

    .emp-modal .modal-title {
        font-weight: 800;
        font-size: 1.05rem;
    }

    .emp-modal .form-control {
        border-radius: 10px;
    }

    .emp-modal .cols-box {
        padding: 14px;
        background: var(--wash);
        border: 1px solid var(--line);
        border-radius: 12px;
    }

    .emp-modal .cols-box code {
        color: var(--leaf-deep);
        background: var(--leaf-tint);
        padding: 2px 7px;
        border-radius: 6px;
        font-size: .78rem;
        margin: 2px 2px 2px 0;
        display: inline-block;
    }

    /* ===== Pagination spacing ===== */
    .emp-pagination {
        margin-top: 20px;
    }

    /* ===== Responsive ===== */
    @media (max-width: 991.98px) {
        .emp-filter {
            grid-template-columns: 1fr 1fr;
        }

        .emp-search,
        .emp-filter-btns {
            grid-column: 1 / -1;
        }

        .emp-filter-btns {
            flex-wrap: wrap;
        }

        .emp-filter-btns .btn-emp {
            flex: 1;
            min-width: 120px;
        }
    }

    @media (max-width: 767.98px) {
        .emp-head {
            flex-direction: column;
            align-items: stretch;
        }

        .emp-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100%;
        }

        .emp-actions .btn-emp-main {
            grid-column: 1 / -1;
        }

        .emp .btn-emp {
            justify-content: center;
        }

        .emp-filter {
            grid-template-columns: 1fr;
            padding: 12px;
        }

        .emp-filter-btns {
            grid-column: auto;
        }

        .bulk-action-bar {
            width: calc(100vw - 24px);
            left: 12px;
            right: 12px;
            transform: none;
            bottom: 16px;
            justify-content: space-between;
            padding: 10px 12px;
            gap: 8px;
        }

        .bulk-info {
            flex: 1;
            min-width: 0;
        }
    }

    @media (max-width: 420px) {
        .m-meta {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .emp-actions {
            grid-template-columns: 1fr;
        }

        .emp-actions .btn-emp-main {
            grid-column: auto;
        }
    }
</style>

<div class="emp">
    {{-- Header --}}
    <div class="emp-head">
        <div>
            <h2 class="emp-title">
                Data Karyawan
                <span class="emp-total">{{ number_format($karyawan->total()) }} orang</span>
            </h2>
            <p class="emp-sub">
                Kelola data karyawan dan atur jatah gula berdasarkan status.
            </p>
        </div>
        <div class="emp-actions">
            <a href="{{ route('admin.karyawan.create') }}" class="btn-emp btn-emp-main">
                <i class="bi bi-person-plus"></i>
                Tambah karyawan
            </a>
            <button
                type="button"
                class="btn-emp btn-emp-dark"
                data-bs-toggle="modal"
                data-bs-target="#modalImportExcel"
            >
                <i class="bi bi-file-earmark-excel"></i>
                Import Excel
            </button>
            <a href="{{ route('admin.karyawan.template') }}" class="btn-emp btn-emp-ghost">
                <i class="bi bi-download"></i>
                Template
            </a>
        </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Terjadi kesalahan:
            </strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- Filter --}}
    <form method="GET" class="emp-filter">
        <div class="emp-search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="cari"
                value="{{ request('cari') }}"
                class="form-control"
                placeholder="Cari nama atau NIK"
                aria-label="Cari nama atau NIK"
            >
        </div>

        <select name="kategori" class="form-select" aria-label="Filter kategori">
            <option value="">Semua kategori</option>
            @foreach ($kategoriList as $kat)
                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                    {{ $kat }}
                </option>
            @endforeach
        </select>

        <select name="status" class="form-select" aria-label="Filter status">
            <option value="">Semua status</option>
            @foreach ($statusList as $st)
                <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>
                    {{ $st }}
                </option>
            @endforeach
        </select>

        <div class="emp-filter-btns">
            <button type="submit" class="btn-emp btn-emp-main">
                <i class="bi bi-search"></i>
                Cari
            </button>
            @if ($adaFilter)
                <a href="{{ url()->current() }}" class="btn-emp btn-emp-ghost" title="Hapus semua filter">
                    <i class="bi bi-x-lg"></i>
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Select all --}}
    <div class="emp-select-row">
        <div class="form-check d-flex align-items-center gap-2 mb-0 ps-0">
            <input
                type="checkbox"
                class="form-check-input select-all-checkbox m-0"
                id="selectAllTop"
                aria-label="Pilih semua data karyawan"
            >
            <label class="mb-0" for="selectAllTop">Pilih semua</label>
        </div>
        <span>
            Menampilkan {{ $karyawan->firstItem() ?? 0 }}–{{ $karyawan->lastItem() ?? 0 }}
            dari {{ number_format($karyawan->total()) }}
        </span>
    </div>

    {{-- Tabel desktop --}}
    <div class="emp-table-wrap d-none d-md-block">
        <div class="table-responsive">
            <table class="emp-table">
                <colgroup>
                    <col style="width: 48px">
                    <col style="width: 32%">
                    <col style="width: 26%">
                    <col style="width: 12%">
                    <col style="width: 14%">
                    <col style="width: 110px">
                </colgroup>
                <thead>
                    <tr>
                        <th>
                            <input
                                type="checkbox"
                                class="form-check-input select-all-checkbox"
                                aria-label="Pilih semua data karyawan"
                            >
                        </th>
                        <th>Karyawan</th>
                        <th>Jabatan &amp; bagian</th>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawan as $item)
                        <tr>
                            <td>
                                <input
                                    type="checkbox"
                                    class="form-check-input row-checkbox"
                                    data-scope="desktop"
                                    value="{{ $item->id }}"
                                    aria-label="Pilih {{ $item->nama }}"
                                >
                            </td>
                            <td>
                                <div class="cell-person">
                                    <span class="avatar {{ $warnaAvatar($item->nama) }}" aria-hidden="true">
                                        {{ $inisial($item->nama) }}
                                    </span>
                                    <div class="cell-person-text">
                                        <div class="person-name" title="{{ $item->nama }}">
                                            {{ $item->nama }}
                                        </div>
                                        <div class="person-nik">NIK {{ $item->nik }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="cell-role-main" title="{{ $item->jabatan ?? '-' }}">
                                    {{ $item->jabatan ?? '-' }}
                                </div>
                                <div class="cell-role-sub" title="{{ $item->bagian ?? '-' }}">
                                    {{ $item->bagian ?? '-' }}
                                </div>
                            </td>
                            <td>
                                @if ($item->status)
                                    <span class="status {{ $isAktif($item->status) ? 'status-aktif' : 'status-nonaktif' }}">
                                        {{ $item->status }}
                                    </span>
                                @else
                                    <span class="emp-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->kategori)
                                    <span class="kategori" title="{{ $item->kategori }}">{{ $item->kategori }}</span>
                                @else
                                    <span class="emp-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a
                                        href="{{ route('admin.karyawan.edit', $item->id) }}"
                                        class="icon-btn"
                                        title="Edit"
                                        aria-label="Edit {{ $item->nama }}"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form
                                        action="{{ route('admin.karyawan.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ addslashes($item->nama) }}?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="icon-btn is-danger"
                                            title="Hapus"
                                            aria-label="Hapus {{ $item->nama }}"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty">
                                    <i class="bi bi-people"></i>
                                    @if ($adaFilter)
                                        <div class="empty-title">Tidak ada karyawan yang cocok</div>
                                        <p>Coba ubah kata kunci atau hapus filter yang sedang dipakai.</p>
                                        <a href="{{ url()->current() }}" class="btn-emp btn-emp-ghost">
                                            Hapus filter
                                        </a>
                                    @else
                                        <div class="empty-title">Belum ada data karyawan</div>
                                        <p>Tambahkan satu per satu, atau impor banyak sekaligus dari file Excel.</p>
                                        <a href="{{ route('admin.karyawan.create') }}" class="btn-emp btn-emp-main">
                                            <i class="bi bi-person-plus"></i>
                                            Tambah karyawan
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Kartu mobile --}}
    <div class="d-block d-md-none">
        @forelse ($karyawan as $item)
            <div class="m-card">
                <div class="m-top">
                    <input
                        type="checkbox"
                        class="form-check-input row-checkbox m-0"
                        data-scope="mobile"
                        value="{{ $item->id }}"
                        aria-label="Pilih {{ $item->nama }}"
                        style="margin-top: 11px;"
                    >
                    <div class="cell-person">
                        <span class="avatar {{ $warnaAvatar($item->nama) }}" aria-hidden="true">
                            {{ $inisial($item->nama) }}
                        </span>
                        <div class="cell-person-text">
                            <div class="person-name">{{ $item->nama }}</div>
                            <div class="person-nik">NIK {{ $item->nik }}</div>
                        </div>
                    </div>
                    @if ($item->status)
                        <div class="m-status-wrap">
                            <span class="status {{ $isAktif($item->status) ? 'status-aktif' : 'status-nonaktif' }}">
                                {{ $item->status }}
                            </span>
                        </div>
                    @endif
                </div>

                <dl class="m-meta">
                    <div>
                        <dt>Jabatan</dt>
                        <dd>{{ $item->jabatan ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt>Bagian</dt>
                        <dd>{{ $item->bagian ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt>Kategori</dt>
                        <dd>
                            @if ($item->kategori)
                                <span class="kategori">{{ $item->kategori }}</span>
                            @else
                                -
                            @endif
                        </dd>
                    </div>
                </dl>

                <div class="m-actions">
                    <a
                        href="{{ route('admin.karyawan.edit', $item->id) }}"
                        class="btn-emp btn-emp-ghost"
                    >
                        <i class="bi bi-pencil-square"></i>
                        Edit
                    </a>
                    <form
                        action="{{ route('admin.karyawan.destroy', $item->id) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ addslashes($item->nama) }}?');"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-emp btn-emp-danger">
                            <i class="bi bi-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="emp-table-wrap">
                <div class="empty">
                    <i class="bi bi-people"></i>
                    @if ($adaFilter)
                        <div class="empty-title">Tidak ada karyawan yang cocok</div>
                        <p>Coba ubah kata kunci atau hapus filter yang sedang dipakai.</p>
                        <a href="{{ url()->current() }}" class="btn-emp btn-emp-ghost">Hapus filter</a>
                    @else
                        <div class="empty-title">Belum ada data karyawan</div>
                        <p>Tambahkan satu per satu, atau impor dari file Excel.</p>
                        <a href="{{ route('admin.karyawan.create') }}" class="btn-emp btn-emp-main">
                            <i class="bi bi-person-plus"></i>
                            Tambah karyawan
                        </a>
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="emp-pagination d-flex justify-content-center justify-content-md-start">
        {{ $karyawan->withQueryString()->links() }}
    </div>

    {{-- Bulk action bar --}}
    <div id="bulkActionBar" class="bulk-action-bar d-none" role="region" aria-label="Aksi untuk data terpilih">
        <span class="bulk-info">
            <span id="bulkSelectedCount">0</span> dipilih
        </span>
        <button type="button" id="bulkCancelBtn" class="bulk-cancel">Batal pilih</button>
        <button type="button" id="bulkDeleteBtn" class="bulk-delete">
            <i class="bi bi-trash"></i>
            Hapus terpilih
        </button>
    </div>
</div>

{{-- Form bulk delete --}}
<form
    id="bulkDeleteForm"
    action="{{ route('admin.karyawan.bulk-destroy') }}"
    method="POST"
    class="d-none"
>
    @csrf
    @method('DELETE')
    <div id="bulkDeleteInputs"></div>
</form>

{{-- Modal Import --}}
<div
    class="modal fade emp-modal"
    id="modalImportExcel"
    tabindex="-1"
    aria-labelledby="modalImportExcelLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <form
                action="{{ route('admin.karyawan.import') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImportExcelLabel">
                        <i class="bi bi-file-earmark-excel text-success me-2"></i>
                        Import data karyawan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info small border-0 mb-3">
                        <i class="bi bi-info-circle-fill me-1"></i>
                        Pakai template Excel yang disediakan supaya format data sesuai dengan sistem.
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label fw-semibold">Pilih file Excel</label>
                        <input
                            type="file"
                            name="file"
                            id="file"
                            class="form-control"
                            accept=".xlsx,.xls"
                            required
                        >
                        <div class="mt-2 small text-muted">
                            Format: <strong>.xlsx</strong> atau <strong>.xls</strong>.
                            Ukuran maksimal: <strong>5 MB</strong>.
                        </div>
                    </div>

                    <div class="cols-box">
                        <div class="fw-semibold mb-2">
                            <i class="bi bi-list-check me-1"></i>
                            Kolom yang dibaca
                        </div>
                        <div class="small">
                            <code>nik</code>
                            <code>nama</code>
                            <code>jabatan</code>
                            <code>bagian</code>
                            <code>status</code>
                            <code>kategori</code>
                            <code>keterangan</code>
                        </div>
                    </div>

                    <div class="mt-3 small text-muted">
                        <i class="bi bi-shield-check me-1"></i>
                        NIK yang sudah terdaftar otomatis dilewati, jadi tidak ada data ganda.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload me-1"></i>
                        Import sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script bulk --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const selectAllCheckboxes = document.querySelectorAll('.select-all-checkbox');
        const bulkActionBar = document.getElementById('bulkActionBar');
        const bulkSelectedCount = document.getElementById('bulkSelectedCount');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const bulkCancelBtn = document.getElementById('bulkCancelBtn');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');
        const bulkDeleteInputs = document.getElementById('bulkDeleteInputs');

        function getDesktopCheckboxes() {
            return document.querySelectorAll('.row-checkbox[data-scope="desktop"]');
        }

        function getCheckedDesktop() {
            return document.querySelectorAll('.row-checkbox[data-scope="desktop"]:checked');
        }

        function updateBulkBar() {
            const checkedCount = getCheckedDesktop().length;
            bulkActionBar.classList.toggle('d-none', checkedCount === 0);
            bulkSelectedCount.textContent = checkedCount;
        }

        function syncSelectAllState() {
            const total = getDesktopCheckboxes().length;
            const checkedTotal = getCheckedDesktop().length;
            selectAllCheckboxes.forEach(function (selectAll) {
                selectAll.checked = total > 0 && checkedTotal === total;
                selectAll.indeterminate = checkedTotal > 0 && checkedTotal < total;
            });
        }

        rowCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const value = checkbox.value;
                document
                    .querySelectorAll('.row-checkbox[value="' + value + '"]')
                    .forEach(function (el) {
                        el.checked = checkbox.checked;
                    });
                updateBulkBar();
                syncSelectAllState();
            });
        });

        selectAllCheckboxes.forEach(function (selectAll) {
            selectAll.addEventListener('change', function () {
                rowCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAll.checked;
                });
                updateBulkBar();
                syncSelectAllState();
            });
        });

        bulkCancelBtn.addEventListener('click', function () {
            rowCheckboxes.forEach(function (checkbox) {
                checkbox.checked = false;
            });
            updateBulkBar();
            syncSelectAllState();
        });

        bulkDeleteBtn.addEventListener('click', function () {
            const checked = getCheckedDesktop();
            if (checked.length === 0) return;

            const konfirmasi = confirm(
                'Apakah Anda yakin ingin menghapus ' +
                checked.length +
                ' data karyawan terpilih? Tindakan ini tidak dapat dibatalkan.'
            );
            if (!konfirmasi) return;

            bulkDeleteInputs.innerHTML = '';
            checked.forEach(function (checkbox) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = checkbox.value;
                bulkDeleteInputs.appendChild(input);
            });
            bulkDeleteForm.submit();
        });
    });
</script>
@endsection