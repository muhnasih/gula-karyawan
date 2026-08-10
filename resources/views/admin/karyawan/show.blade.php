@extends('layouts.app')

@section('title', 'Detail Karyawan')

@section('content')

<div class="container-fluid">

    {{-- ========================================================= --}}
    {{-- PESAN BERHASIL --}}
    {{-- ========================================================= --}}

    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            <strong>Berhasil!</strong>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-person-vcard me-2"></i>
                Detail Karyawan
            </h2>

            <p class="text-muted mb-0">
                Informasi lengkap data karyawan
            </p>

        </div>


        {{-- KEMBALI --}}
        <a href="{{ route('admin.karyawan') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- DATA UTAMA --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                {{-- FOTO / ICON --}}
                <div class="col-md-3 text-center mb-4 mb-md-0">

                    <div
                        class="bg-success text-white rounded-circle
                               d-flex align-items-center justify-content-center
                               mx-auto"
                        style="width: 110px; height: 110px;"
                    >

                        <i class="bi bi-person-fill"
                           style="font-size: 4rem;">
                        </i>

                    </div>

                    <h4 class="fw-bold mt-3 mb-1">
                        {{ $karyawan->nama }}
                    </h4>

                    <div class="text-muted">
                        NIK: {{ $karyawan->nik }}
                    </div>

                </div>


                {{-- INFORMASI --}}
                <div class="col-md-9">

                    <div class="row">

                        {{-- NIK --}}
                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block mb-1">
                                NIK
                            </small>

                            <div class="fw-semibold fs-5">
                                {{ $karyawan->nik }}
                            </div>

                        </div>


                        {{-- NAMA --}}
                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block mb-1">
                                Nama Karyawan
                            </small>

                            <div class="fw-semibold fs-5">
                                {{ $karyawan->nama }}
                            </div>

                        </div>


                        {{-- JABATAN --}}
                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block mb-1">
                                Jabatan
                            </small>

                            <div class="fw-semibold">
                                {{ $karyawan->jabatan ?? '-' }}
                            </div>

                        </div>


                        {{-- BAGIAN --}}
                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block mb-1">
                                Bagian
                            </small>

                            <div class="fw-semibold">
                                {{ $karyawan->bagian ?? '-' }}
                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block mb-1">
                                Status
                            </small>

                            <div>

                                @if ($karyawan->status)

                                    @if (strtolower($karyawan->status) === 'aktif')

                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            {{ $karyawan->status }}
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $karyawan->status }}
                                        </span>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- KATEGORI --}}
                        <div class="col-md-6 mb-4">

                            <small class="text-muted d-block mb-1">
                                Kategori
                            </small>

                            <div>

                                @if ($karyawan->kategori)

                                    <span class="badge bg-primary">
                                        {{ $karyawan->kategori }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- KETERANGAN --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-light">

            <h5 class="mb-0 fw-bold">

                <i class="bi bi-card-text me-2"></i>
                Keterangan

            </h5>

        </div>

        <div class="card-body">

            @if ($karyawan->keterangan)

                <p class="mb-0">
                    {{ $karyawan->keterangan }}
                </p>

            @else

                <span class="text-muted">
                    Tidak ada keterangan.
                </span>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- AKSI --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <h5 class="fw-bold mb-3">

                <i class="bi bi-gear me-2"></i>
                Aksi Karyawan

            </h5>


            <div class="d-flex flex-wrap gap-2">


                {{-- ================================================= --}}
                {{-- EDIT --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('admin.karyawan.edit', $karyawan->id) }}"
                    class="btn btn-warning"
                >

                    <i class="bi bi-pencil-square me-1"></i>
                    Edit Karyawan

                </a>


                {{-- ================================================= --}}
                {{-- HAPUS --}}
                {{-- ================================================= --}}

                <form
                    action="{{ route('admin.karyawan.destroy', $karyawan->id) }}"
                    method="POST"
                    onsubmit="return confirm(
                        'Apakah Anda yakin ingin menghapus data {{ addslashes($karyawan->nama) }}? Data yang sudah dihapus tidak dapat dikembalikan.'
                    );"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >

                        <i class="bi bi-trash me-1"></i>
                        Hapus Karyawan

                    </button>

                </form>


                {{-- ================================================= --}}
                {{-- KEMBALI --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('admin.karyawan') }}"
                    class="btn btn-secondary"
                >

                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali ke Data Karyawan

                </a>

            </div>

        </div>

    </div>

</div>

@endsection