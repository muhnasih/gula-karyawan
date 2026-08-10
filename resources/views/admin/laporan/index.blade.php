@extends('layouts.app')

@section('title', 'Laporan Pengambilan Gula')

@section('content')

{{-- =========================================================
    HEADER
========================================================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-success mb-1">
            <i class="bi bi-file-earmark-bar-graph-fill me-2"></i>
            Laporan Pengambilan Gula
        </h2>
        <p class="text-muted mb-0">
            Rekapitulasi pengambilan bonus gula karyawan PG Gending
        </p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.laporan.excel', request()->query()) }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel me-1"></i>
            Export Excel
        </a>
        <a href="{{ route('admin.laporan.pdf', request()->query()) }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf me-1"></i>
            Export PDF
        </a>
    </div>
</div>

{{-- =========================================================
    STATISTIK
========================================================= --}}
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="text-muted mb-2">Total Karyawan</h6>
                <h2 class="fw-bold text-success mb-0">{{ $statistik['totalKaryawan'] ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="text-muted mb-2">Sudah Mengambil</h6>
                <h2 class="fw-bold text-primary mb-0">{{ $statistik['sudahAmbil'] ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="text-muted mb-2">Belum Mengambil</h6>
                <h2 class="fw-bold text-warning mb-0">{{ $statistik['belumAmbil'] ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <h6 class="text-muted mb-2">Pensiun</h6>
                <h2 class="fw-bold text-danger mb-0">{{ $statistik['pensiun'] ?? 0 }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- =========================================================
    FILTER
========================================================= --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.laporan.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="sudah" {{ request('status') === 'sudah' ? 'selected' : '' }}>Sudah Mengambil</option>
                        <option value="belum" {{ request('status') === 'belum' ? 'selected' : '' }}>Belum Mengambil</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- =========================================================
    TABEL LAPORAN
========================================================= --}}
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-success">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">NIK</th>
                        <th>Nama</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Bagian</th>
                        <th width="15%">Tanggal Ambil</th>
                        <th width="15%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan ?? [] as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>{{ $item->nik }}</strong></td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->bagian }}</td>
                            <td>{{ $item->tanggal_ambil ?? '-' }}</td>
                            <td>
                                @if($item->tanggal_ambil)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Sudah Mengambil
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i>
                                        Belum Mengambil
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <span class="fs-5">Belum ada data laporan</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection