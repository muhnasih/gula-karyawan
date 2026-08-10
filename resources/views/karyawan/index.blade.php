@extends('layouts.app')

@section('title', 'Dashboard Karyawan')

@section('content')

<div class="container py-4">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="mb-4">
        <h2 class="fw-bold mb-1">Dashboard Karyawan</h2>
        <p class="text-muted mb-0">Sistem Pengambilan Gula Karyawan</p>
    </div>

    {{-- ========================================================= --}}
    {{-- DATA KARYAWAN --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div
                    class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px;"
                >
                    <i class="bi bi-person-fill fs-3"></i>
                </div>

                <div class="ms-3">
                    <h5 class="fw-bold mb-1">{{ $karyawan->nama }}</h5>
                    <div class="text-muted">NIK: {{ $karyawan->nik }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <small class="text-muted">Jabatan</small>
                    <div class="fw-semibold">{{ $karyawan->jabatan ?? '-' }}</div>
                </div>

                <div class="col-md-6 mb-3">
                    <small class="text-muted">Bagian</small>
                    <div class="fw-semibold">{{ $karyawan->bagian ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- INFORMASI --}}
    {{-- ========================================================= --}}

    <div class="alert alert-info border-0 shadow-sm mb-4">
        <div class="d-flex">
            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
            <div>
                <strong>Informasi Pengambilan Gula</strong>
                <div class="small mt-1">
                    Tunjukkan barcode kepada operator untuk melakukan pengambilan gula.
                    Barcode bulan berikutnya akan tampil otomatis saat bulannya tiba.
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- BARCODE UTAMA + LIST BULAN --}}
    {{-- ========================================================= --}}

    <div class="row g-4">

        {{-- ============================================= --}}
        {{-- BARCODE AKTIF (default: bulan ini) --}}
        {{-- ============================================= --}}

        <div class="col-lg-5">
            <div class="card shadow-sm border-0" style="position: sticky; top: 1rem;">
                <div class="card-body text-center" id="barcode-display">
                    {{-- diisi otomatis via JavaScript --}}
                </div>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- DAFTAR BARCODE PER BULAN --}}
        {{-- ============================================= --}}

        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">Daftar Barcode Per Bulan</h5>
                        <span class="badge bg-success">Tahun {{ now()->year }}</span>
                    </div>

                    <div class="list-group" id="month-list">
                        @foreach($bulan as $item)
                            @php
                                $isCurrent = $item['periode']->isSameMonth(now()) && $item['periode']->isSameYear(now());
                                $isFuture  = $item['periode']->startOfMonth()->gt(now()->startOfMonth());
                            @endphp

                            <button
                                type="button"
                                class="list-group-item list-group-item-action month-item d-flex justify-content-between align-items-center"
                                data-index="{{ $loop->index }}"
                                data-current="{{ $isCurrent ? 1 : 0 }}"
                            >
                                <span>
                                    <i class="bi bi-calendar3 me-2 text-muted"></i>
                                    {{ $item['periode']->translatedFormat('F Y') }}
                                    @if($isCurrent)
                                        <span class="badge bg-primary ms-2">Bulan Ini</span>
                                    @endif
                                </span>

                                @if($isFuture)
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-lock-fill"></i> Belum Tiba
                                    </span>
                                @elseif($item['sudah_diambil'])
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle-fill"></i> Sudah Diambil
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-exclamation-circle-fill"></i> Belum Diambil
                                    </span>
                                @endif
                            </button>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- ========================================================= --}}
    {{-- TEMPLATE DATA (hidden, dibaca oleh JavaScript) --}}
    {{-- ========================================================= --}}

    @foreach($bulan as $item)
        @php
            $isCurrent = $item['periode']->isSameMonth(now()) && $item['periode']->isSameYear(now());
            $isFuture  = $item['periode']->startOfMonth()->gt(now()->startOfMonth());
        @endphp

        <template id="month-data-{{ $loop->index }}">
            <h5 class="fw-bold mb-3">{{ $item['periode']->translatedFormat('F Y') }}</h5>

            @if($isFuture)
                {{-- BULAN BELUM TIBA --}}
                <div class="text-muted py-5">
                    <i class="bi bi-lock-fill fs-1"></i>
                    <p class="mt-3 mb-0">Barcode belum tersedia.</p>
                    <p class="mb-0">Akan muncul otomatis saat bulan ini tiba.</p>
                </div>

            @elseif($item['sudah_diambil'])
                {{-- SUDAH DIAMBIL --}}
                <div class="py-5">
                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                    <p class="mt-3 mb-1 fw-bold text-success">Sudah Diambil Bulan Ini</p>
                    @if($item['tanggal_ambil'])
                        <small class="text-muted">
                            <i class="bi bi-calendar-check"></i>
                            Diambil tanggal:
                            <strong>{{ \Carbon\Carbon::parse($item['tanggal_ambil'])->format('d-m-Y') }}</strong>
                        </small>
                    @endif
                </div>

            @else
                {{-- BELUM DIAMBIL: TAMPILKAN BARCODE --}}
                <div class="mb-2">
                    <strong>Barcode Pengambilan</strong>
                </div>

                <div class="bg-white border rounded-3 p-3 d-inline-block">
                    {!! QrCode::size(200)->generate($item['barcode']) !!}
                </div>

                <div class="mt-3">
                    <small class="text-muted">
                        Tunjukkan barcode ini kepada operator.
                    </small>
                </div>
            @endif
        </template>
    @endforeach

    {{-- ========================================================= --}}
    {{-- LOGOUT --}}
    {{-- ========================================================= --}}

    <div class="text-end mt-4">
        <form action="{{ route('karyawan.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </form>
    </div>

</div>

{{-- ========================================================= --}}
{{-- SCRIPT: SWITCH TAMPILAN BARCODE PER BULAN --}}
{{-- ========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const items   = document.querySelectorAll('.month-item');
    const display = document.getElementById('barcode-display');

    function showMonth(index) {
        const template = document.getElementById('month-data-' + index);
        if (!template) return;

        display.innerHTML = template.innerHTML;

        items.forEach(function (btn) {
            btn.classList.remove('active');
        });

        const activeBtn = document.querySelector('.month-item[data-index="' + index + '"]');
        if (activeBtn) activeBtn.classList.add('active');
    }

    items.forEach(function (item) {
        item.addEventListener('click', function () {
            showMonth(this.dataset.index);
        });
    });

    // Default: tampilkan bulan ini. Kalau tidak ketemu, tampilkan bulan pertama.
    const currentItem = document.querySelector('.month-item[data-current="1"]');
    if (currentItem) {
        showMonth(currentItem.dataset.index);
    } else if (items.length > 0) {
        showMonth(items[0].dataset.index);
    }
});
</script>

@endsection