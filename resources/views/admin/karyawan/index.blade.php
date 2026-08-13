@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')

{{-- =========================================================
    HEADER
========================================================= --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">

    <div>
        <h2 class="fw-bold mb-1 fs-4 fs-md-2">
            Data Karyawan
        </h2>

        <p class="text-muted mb-0 small">
            Kelola data karyawan
        </p>
    </div>

    <a href="{{ route('admin.karyawan.create') }}"
       class="btn btn-success w-100 w-md-auto">

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

        <button type="submit"
                class="btn btn-success w-100">

            <i class="bi bi-search me-1"></i>
            Cari

        </button>

    </div>

</form>


{{-- =========================================================
    DAFTAR KARYAWAN - TABEL (tampil di layar md ke atas)
========================================================= --}}
<div class="card shadow-sm border-0 d-none d-md-block">

    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle mb-0">

            <colgroup>
                <col style="width: 12%">  {{-- NIK --}}
                <col style="width: 22%">  {{-- NAMA --}}
                <col style="width: 16%">  {{-- JABATAN --}}
                <col style="width: 15%">  {{-- BAGIAN --}}
                <col style="width: 12%">  {{-- STATUS --}}
                <col style="width: 13%">  {{-- KATEGORI --}}
                <col style="width: 10%">  {{-- AKSI --}}
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
                        <td class="text-truncate" title="{{ $item->nik }}">
                            {{ $item->nik }}
                        </td>

                        <td class="fw-semibold text-truncate" title="{{ $item->nama }}">
                            {{ $item->nama }}
                        </td>

                        <td class="text-truncate" title="{{ $item->jabatan ?? '-' }}">
                            {{ $item->jabatan ?? '-' }}
                        </td>

                        <td class="text-truncate" title="{{ $item->bagian ?? '-' }}">
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


{{-- =========================================================
    DAFTAR KARYAWAN - CARD LIST (tampil di layar kecil / HP)
========================================================= --}}
<div class="d-block d-md-none">

    @forelse ($karyawan as $item)

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $item->nama }}</h6>
                        <small class="text-muted">{{ $item->nik }}</small>
                    </div>

                    @if ($item->status)
                        @if (strtolower($item->status) === 'aktif')
                            <span class="status-badge status-aktif">{{ $item->status }}</span>
                        @else
                            <span class="status-badge status-nonaktif">{{ $item->status }}</span>
                        @endif
                    @endif
                </div>

                <div class="row gy-1 small mb-3">
                    <div class="col-6">
                        <span class="text-muted d-block">Jabatan</span>
                        <span>{{ $item->jabatan ?? '-' }}</span>
                    </div>

                    <div class="col-6">
                        <span class="text-muted d-block">Bagian</span>
                        <span>{{ $item->bagian ?? '-' }}</span>
                    </div>

                    <div class="col-6">
                        <span class="text-muted d-block">Kategori</span>
                        @if ($item->kategori)
                            <span class="badge bg-primary">{{ $item->kategori }}</span>
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


{{-- PAGINATION --}}
<div class="mt-4 d-flex justify-content-center justify-content-md-start">

    {{ $karyawan->links() }}

</div>

@endsection