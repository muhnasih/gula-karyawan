@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

<style>
    /* =========================================================
       DATA KARYAWAN
    ========================================================= */

    .employee-page {
        width: 100%;
        overflow-x: hidden;
    }

    .employee-action {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-aktif {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-nonaktif {
        background: #f8d7da;
        color: #842029;
    }

    .import-info {
        font-size: 13px;
        color: #6c757d;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    @media (max-width: 767.98px) {

        .employee-action {
            display: grid;
            grid-template-columns: 1fr;
            width: 100%;
        }

        .employee-action .btn {
            width: 100%;
        }

        .card {
            border-radius: 12px;
        }
    }
</style>


<div class="employee-page">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1 fs-4 fs-md-2">
                Data Karyawan
            </h2>

            <p class="text-muted mb-0 small">
                Kelola data karyawan
            </p>
        </div>


        {{-- TOMBOL AKSI --}}
        <div class="employee-action">

            {{-- TAMBAH KARYAWAN --}}
            <a href="{{ route('admin.karyawan.create') }}"
               class="btn btn-success">

                <i class="bi bi-person-plus me-1"></i>
                Tambah Karyawan

            </a>


            {{-- IMPORT EXCEL --}}
            <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalImportExcel"
            >

                <i class="bi bi-file-earmark-excel me-1"></i>
                Import Excel

            </button>


            {{-- DOWNLOAD TEMPLATE --}}
            <a
                href="{{ route('admin.karyawan.template') }}"
                class="btn btn-outline-success"
            >

                <i class="bi bi-download me-1"></i>
                Template Excel

            </a>

        </div>

    </div>


    {{-- =========================================================
        PESAN BERHASIL
    ========================================================== --}}
    @if (session('success'))

        <div
            class="alert alert-success alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        PESAN ERROR
    ========================================================== --}}
    @if (session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERROR
    ========================================================== --}}
    @if ($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <strong>
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        FILTER / PENCARIAN
    ========================================================== --}}
    <form method="GET" class="row g-2 mb-4">

        <div class="col-12 col-md-4">

            <input
                type="text"
                name="cari"
                value="{{ request('cari') }}"
                class="form-control"
                placeholder="Cari nama atau NIK..."
            >

        </div>


        <div class="col-6 col-md-3">

            <select name="kategori" class="form-select">

                <option value="">
                    Semua Kategori
                </option>

                @foreach ($kategoriList as $kat)

                    <option
                        value="{{ $kat }}"
                        {{ request('kategori') == $kat ? 'selected' : '' }}
                    >
                        {{ $kat }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="col-6 col-md-3">

            <select name="status" class="form-select">

                <option value="">
                    Semua Status
                </option>

                @foreach ($statusList as $st)

                    <option
                        value="{{ $st }}"
                        {{ request('status') == $st ? 'selected' : '' }}
                    >
                        {{ $st }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="col-12 col-md-2">

            <button
                type="submit"
                class="btn btn-success w-100"
            >

                <i class="bi bi-search me-1"></i>
                Cari

            </button>

        </div>

    </form>


    {{-- =========================================================
        TABEL DESKTOP
    ========================================================== --}}
    <div class="card shadow-sm border-0 d-none d-md-block">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle mb-0">

                <colgroup>

                    <col style="width: 12%">
                    <col style="width: 22%">
                    <col style="width: 16%">
                    <col style="width: 15%">
                    <col style="width: 12%">
                    <col style="width: 13%">
                    <col style="width: 10%">

                </colgroup>


                <thead>

                    <tr>

                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th>BAGIAN</th>
                        <th>STATUS</th>
                        <th>KATEGORI</th>
                        <th class="text-center">AKSI</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($karyawan as $item)

                        <tr>

                            <td
                                class="text-truncate"
                                title="{{ $item->nik }}"
                            >
                                {{ $item->nik }}
                            </td>


                            <td
                                class="fw-semibold text-truncate"
                                title="{{ $item->nama }}"
                            >
                                {{ $item->nama }}
                            </td>


                            <td
                                class="text-truncate"
                                title="{{ $item->jabatan ?? '-' }}"
                            >
                                {{ $item->jabatan ?? '-' }}
                            </td>


                            <td
                                class="text-truncate"
                                title="{{ $item->bagian ?? '-' }}"
                            >
                                {{ $item->bagian ?? '-' }}
                            </td>


                            <td>

                                @if ($item->status)

                                    @if (strtolower($item->status) === 'aktif')

                                        <span class="status-badge status-aktif">
                                            {{ $item->status }}
                                        </span>

                                    @else

                                        <span class="status-badge status-nonaktif">
                                            {{ $item->status }}
                                        </span>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            <td>

                                @if ($item->kategori)

                                    <span class="badge bg-primary">
                                        {{ $item->kategori }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            <td class="text-center">

                                <a
                                    href="{{ route('admin.karyawan.edit', $item->id) }}"
                                    class="btn btn-sm btn-outline-warning"
                                    title="Edit"
                                >

                                    <i class="bi bi-pencil-square"></i>

                                </a>


                                <form
                                    action="{{ route('admin.karyawan.destroy', $item->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ addslashes($item->nama) }}?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Hapus"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center text-muted py-4"
                            >

                                Belum ada data karyawan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
        CARD MOBILE
    ========================================================== --}}
    <div class="d-block d-md-none">

        @forelse ($karyawan as $item)

            <div class="card shadow-sm border-0 mb-3">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start mb-2">

                        <div>

                            <h6 class="fw-bold mb-0">
                                {{ $item->nama }}
                            </h6>

                            <small class="text-muted">
                                {{ $item->nik }}
                            </small>

                        </div>


                        @if ($item->status)

                            @if (strtolower($item->status) === 'aktif')

                                <span class="status-badge status-aktif">
                                    {{ $item->status }}
                                </span>

                            @else

                                <span class="status-badge status-nonaktif">
                                    {{ $item->status }}
                                </span>

                            @endif

                        @endif

                    </div>


                    <div class="row gy-2 small mb-3">

                        <div class="col-6">

                            <span class="text-muted d-block">
                                Jabatan
                            </span>

                            <span>
                                {{ $item->jabatan ?? '-' }}
                            </span>

                        </div>


                        <div class="col-6">

                            <span class="text-muted d-block">
                                Bagian
                            </span>

                            <span>
                                {{ $item->bagian ?? '-' }}
                            </span>

                        </div>


                        <div class="col-6">

                            <span class="text-muted d-block">
                                Kategori
                            </span>

                            @if ($item->kategori)

                                <span class="badge bg-primary">
                                    {{ $item->kategori }}
                                </span>

                            @else

                                <span>-</span>

                            @endif

                        </div>

                    </div>


                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('admin.karyawan.edit', $item->id) }}"
                            class="btn btn-sm btn-outline-warning flex-fill"
                        >

                            <i class="bi bi-pencil-square me-1"></i>
                            Edit

                        </a>


                        <form
                            action="{{ route('admin.karyawan.destroy', $item->id) }}"
                            method="POST"
                            class="flex-fill"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ addslashes($item->nama) }}?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-danger w-100"
                            >

                                <i class="bi bi-trash me-1"></i>
                                Hapus

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="card shadow-sm border-0">

                <div class="card-body text-center text-muted py-4">

                    Belum ada data karyawan.

                </div>

            </div>

        @endforelse

    </div>


    {{-- =========================================================
        PAGINATION
    ========================================================== --}}
    <div class="mt-4 d-flex justify-content-center justify-content-md-start">

        {{ $karyawan->links() }}

    </div>

</div>


{{-- =========================================================
    MODAL IMPORT EXCEL
========================================================= --}}
<div
    class="modal fade"
    id="modalImportExcel"
    tabindex="-1"
    aria-labelledby="modalImportExcelLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <form
                action="{{ route('admin.karyawan.import') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="modal-header">

                    <h5
                        class="modal-title fw-bold"
                        id="modalImportExcelLabel"
                    >

                        <i class="bi bi-file-earmark-excel text-success me-2"></i>

                        Import Data Karyawan

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <div class="alert alert-info small">

                        <i class="bi bi-info-circle-fill me-1"></i>

                        Gunakan template Excel yang telah disediakan
                        agar format data sesuai dengan sistem.

                    </div>


                    <div class="mb-3">

                        <label
                            for="file"
                            class="form-label fw-semibold"
                        >
                            Pilih File Excel
                        </label>


                        <input
                            type="file"
                            name="file"
                            id="file"
                            class="form-control"
                            accept=".xlsx,.xls"
                            required
                        >


                        <div class="import-info mt-2">

                            Format yang diperbolehkan:
                            <strong>.xlsx</strong> atau
                            <strong>.xls</strong>.

                            <br>

                            Maksimal ukuran file:
                            <strong>5 MB</strong>.

                        </div>

                    </div>


                    <div class="border rounded p-3 bg-light">

                        <div class="fw-semibold mb-2">

                            <i class="bi bi-list-check me-1"></i>

                            Kolom Excel

                        </div>


                        <div class="small text-muted">

                            <code>nik</code>,
                            <code>nama</code>,
                            <code>jabatan</code>,
                            <code>bagian</code>,
                            <code>status</code>,
                            <code>kategori</code>,
                            <code>keterangan</code>

                        </div>

                    </div>


                    <div class="mt-3 small text-muted">

                        <i class="bi bi-shield-check me-1"></i>

                        NIK yang sudah terdaftar akan otomatis
                        dilewati agar tidak terjadi data duplikat.

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-success"
                    >

                        <i class="bi bi-upload me-1"></i>

                        Import Sekarang

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection