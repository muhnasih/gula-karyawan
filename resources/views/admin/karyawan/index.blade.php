@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Data Karyawan
        </h2>

        <p class="text-muted mb-0">
            Kelola data karyawan
        </p>
    </div>

    <a href="{{ route('admin.karyawan.create') }}"
       class="btn btn-success">

        <i class="bi bi-person-plus me-1"></i>
        Tambah Karyawan

    </a>

</div>


{{-- PESAN BERHASIL --}}
@if (session('success'))

    <div class="alert alert-success alert-dismissible fade show shadow-sm"
         role="alert">

        <i class="bi bi-check-circle-fill me-2"></i>

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif


{{-- FILTER / PENCARIAN --}}
<form method="GET" class="row g-2 mb-4">

    <div class="col-md-4">

        <input
            type="text"
            name="cari"
            value="{{ request('cari') }}"
            class="form-control"
            placeholder="Cari nama atau NIK..."
        >

    </div>


    <div class="col-md-3">

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


    <div class="col-md-3">

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


    <div class="col-md-2">

        <button type="submit"
                class="btn btn-success w-100">

            <i class="bi bi-search me-1"></i>
            Cari

        </button>

    </div>

</form>


{{-- DAFTAR KARYAWAN --}}
<div class="row">

    @forelse ($karyawan as $item)

        <div class="col-md-6 mb-3">

            <div class="card shadow-sm border-0">

                <div class="card-body d-flex align-items-center">

                    <div
                        class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 55px; height: 55px;"
                    >

                        <i class="bi bi-person-fill fs-3"></i>

                    </div>


                    <div class="ms-3">

                        <h5 class="fw-bold mb-1">

                            <a
                                href="{{ route('admin.karyawan.show', $item->id) }}"
                                class="text-decoration-none text-dark"
                            >

                                {{ $item->nama }}

                            </a>

                        </h5>


                        <div class="text-muted">

                            NIK: {{ $item->nik }}

                        </div>


                        <div class="small">

                            {{ $item->kategori ?? '-' }}

                            &middot;

                            {{ $item->status ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <p class="text-muted">
                Belum ada data karyawan.
            </p>

        </div>

    @endforelse

</div>


{{-- PAGINATION --}}
<div class="mt-4">

    {{ $karyawan->links() }}

</div>

@endsection