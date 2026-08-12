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
<div class="card shadow-sm border-0">

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle mb-0">

            <thead class="table-light">
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
                        <td>{{ $item->nik }}</td>

                        <td class="fw-semibold">{{ $item->nama }}</td>

                        <td>{{ $item->jabatan ?? '-' }}</td>
                        <td>{{ $item->bagian ?? '-' }}</td>

                        <td>
                            @if ($item->status)

                                @if (strtolower($item->status) === 'aktif')

                                    <span class="badge bg-success">
                                        {{ $item->status }}
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ $item->status }}
                                    </span>

                                @endif

                            @else

                                <span class="text-muted">-</span>

                            @endif
                        </td>

                        <td>
                            @if ($item->kategori)

                                <span class="badge bg-primary">
                                    {{ $item->kategori }}
                                </span>

                            @else

                                <span class="text-muted">-</span>

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
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada data karyawan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- PAGINATION --}}
<div class="mt-4">

    {{ $karyawan->links() }}

</div>

@endsection