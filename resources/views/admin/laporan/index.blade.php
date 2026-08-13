@extends('layouts.app')

@section('title', 'Laporan Pengambilan Gula')

@section('content')

{{-- =========================================================
    HEADER
========================================================= --}}
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-2 mb-4">
    <div>
        <h2 class="fw-bold text-success mb-1 fs-4 fs-lg-2">
            <i class="bi bi-file-earmark-bar-graph-fill me-2"></i>
            Laporan Pengambilan Gula
        </h2>
        <p class="text-muted mb-0 small">
            Rekapitulasi pengambilan bonus gula karyawan PG Gending
        </p>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.laporan.excel', request()->query()) }}" class="btn btn-success flex-fill flex-lg-grow-0">
            <i class="bi bi-file-earmark-excel me-1"></i>
            <span class="d-none d-sm-inline">Export </span>Excel
        </a>
        <a href="{{ route('admin.laporan.pdf', request()->query()) }}" class="btn btn-danger flex-fill flex-lg-grow-0">
            <i class="bi bi-file-earmark-pdf me-1"></i>
            <span class="d-none d-sm-inline">Export </span>PDF
        </a>
    </div>
</div>

{{-- =========================================================
    STATISTIK
========================================================= --}}
<div class="row mb-4 g-2 g-md-3">
    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <h6 class="text-muted mb-2 small">Total Karyawan</h6>
                <h3 class="fw-bold text-success mb-0">{{ $statistik['totalKaryawan'] ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <h6 class="text-muted mb-2 small">Sudah Mengambil</h6>
                <h3 class="fw-bold text-primary mb-0">{{ $statistik['sudahAmbil'] ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <h6 class="text-muted mb-2 small">Belum Mengambil</h6>
                <h3 class="fw-bold text-warning mb-0">{{ $statistik['belumAmbil'] ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <h6 class="text-muted mb-2 small">Pensiun</h6>
                <h3 class="fw-bold text-danger mb-0">{{ $statistik['pensiun'] ?? 0 }}</h3>
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
                <div class="col-6 col-md-3">
                    <label class="form-label fw-semibold small">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                </div>

                <div class="col-6 col-md-3">
                    <label class="form-label fw-semibold small">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>

                <div class="col-12 col-md-3">
                    <label class="form-label fw-semibold small">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="sudah" {{ request('status') === 'sudah' ? 'selected' : '' }}>Sudah Mengambil</option>
                        <option value="belum" {{ request('status') === 'belum' ? 'selected' : '' }}>Belum Mengambil</option>
                    </select>
                </div>

                <div class="col-12 col-md-3 d-flex align-items-end">
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
    TABEL LAPORAN (tampil di layar md ke atas)
========================================================= --}}
<div class="card shadow-sm border-0 d-none d-md-block">
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

{{-- =========================================================
    DAFTAR LAPORAN - CARD LIST (tampil di layar kecil / HP)
========================================================= --}}
<div class="d-block d-md-none">

    @forelse($laporan ?? [] as $key => $item)

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $item->nama }}</h6>
                        <small class="text-muted">{{ $item->nik }}</small>
                    </div>
                    <span class="text-muted small">#{{ $key + 1 }}</span>
                </div>

                <div class="row gy-1 small mb-3">
                    <div class="col-6">
                        <span class="text-muted d-block">Kategori</span>
                        <span>{{ $item->kategori }}</span>
                    </div>

                    <div class="col-6">
                        <span class="text-muted d-block">Bagian</span>
                        <span>{{ $item->bagian }}</span>
                    </div>

                    <div class="col-6">
                        <span class="text-muted d-block">Tanggal Ambil</span>
                        <span>{{ $item->tanggal_ambil ?? '-' }}</span>
                    </div>
                </div>

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

            </div>
        </div>

    @empty

        <div class="card shadow-sm border-0">
            <div class="card-body text-center text-muted py-5">
                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                <span class="fs-5">Belum ada data laporan</span>
            </div>
        </div>

    @endforelse

</div>

@endsection