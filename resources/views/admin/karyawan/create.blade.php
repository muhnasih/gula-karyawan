@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-person-plus me-2"></i>
                Tambah Karyawan
            </h2>

            <p class="text-muted mb-0">
                Tambahkan data karyawan baru
            </p>
        </div>

        <a href="{{ route('admin.karyawan') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

    </div>


    {{-- ERROR VALIDASI --}}
    @if ($errors->any())

        <div class="alert alert-danger shadow-sm">

            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Data belum dapat disimpan.
            </div>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">
                <i class="bi bi-person-vcard me-2"></i>
                Form Data Karyawan
            </h5>

        </div>


        <div class="card-body">

            <form action="{{ route('admin.karyawan.store') }}"
                  method="POST">

                @csrf


                {{-- NIK --}}
                <div class="mb-3">

                    <label for="nik"
                           class="form-label fw-semibold">

                        NIK
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="nik"
                        id="nik"
                        class="form-control @error('nik') is-invalid @enderror"
                        value="{{ old('nik') }}"
                        placeholder="Masukkan NIK karyawan"
                        required
                    >

                    @error('nik')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- NAMA --}}
                <div class="mb-3">

                    <label for="nama"
                           class="form-label fw-semibold">

                        Nama Karyawan
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                    @error('nama')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- JABATAN --}}
                <div class="mb-3">

                    <label for="jabatan"
                           class="form-label fw-semibold">

                        Jabatan

                    </label>

                    <input
                        type="text"
                        name="jabatan"
                        id="jabatan"
                        class="form-control"
                        value="{{ old('jabatan') }}"
                        placeholder="Contoh: Operator"
                    >

                </div>


                {{-- BAGIAN --}}
                <div class="mb-3">

                    <label for="bagian"
                           class="form-label fw-semibold">

                        Bagian

                    </label>

                    <input
                        type="text"
                        name="bagian"
                        id="bagian"
                        class="form-control"
                        value="{{ old('bagian') }}"
                        placeholder="Contoh: Produksi"

                    >

                </div>


                {{-- STATUS --}}
                <div class="mb-3">

                    <label for="status"
                           class="form-label fw-semibold">

                        Status

                    </label>

                    <input
                        type="text"
                        name="status"
                        id="status"
                        class="form-control"
                        value="{{ old('status') }}"
                        placeholder="Contoh: Aktif"
                    >

                </div>


                {{-- KATEGORI --}}
                <div class="mb-3">

                    <label for="kategori"
                           class="form-label fw-semibold">

                        Kategori

                    </label>

                    <input
                        type="text"
                        name="kategori"
                        id="kategori"
                        class="form-control"
                        value="{{ old('kategori') }}"
                        placeholder="Contoh: Tetap"
                    >

                </div>


                {{-- KETERANGAN --}}
                <div class="mb-4">

                    <label for="keterangan"
                           class="form-label fw-semibold">

                        Keterangan

                    </label>

                    <textarea
                        name="keterangan"
                        id="keterangan"
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan keterangan jika diperlukan"
                    >{{ old('keterangan') }}</textarea>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.karyawan') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-x-circle me-1"></i>
                        Batal

                    </a>

                    <button type="submit"
                            class="btn btn-success">

                        <i class="bi bi-save me-1"></i>
                        Simpan Karyawan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection