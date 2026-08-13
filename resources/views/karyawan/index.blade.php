@extends('layouts.app')

@section('title', 'Dashboard Karyawan')

@section('content')

<style>
    /* =========================================================
       DASHBOARD KARYAWAN
       RESPONSIVE DESKTOP + HP
    ========================================================= */
    .karyawan-dashboard {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* =========================================================
       HEADER
    ========================================================= */
    .karyawan-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .karyawan-header p {
        font-size: .9rem;
    }

    /* =========================================================
       CARD
    ========================================================= */
    .karyawan-card {
        border: 0;
        border-radius: 16px;
        overflow: hidden;
    }

    .karyawan-card .card-body {
        padding: 1.25rem;
    }

    /* =========================================================
       DATA KARYAWAN
    ========================================================= */
    .profile-icon {
        width: 55px;
        height: 55px;
        min-width: 55px;
    }

    .profile-name {
        font-size: 1.05rem;
        word-break: break-word;
    }

    .employee-label {
        display: block;
        font-size: .75rem;
        color: #6c757d;
        margin-bottom: .2rem;
    }

    .employee-value {
        font-weight: 600;
        word-break: break-word;
    }

    /* =========================================================
       INFORMASI
    ========================================================= */
    .info-alert {
        border-radius: 14px;
    }

    .info-alert .info-icon {
        flex-shrink: 0;
    }

    /* =========================================================
       BARCODE
    ========================================================= */
    .barcode-card {
        position: sticky;
        top: 1rem;
    }

    #barcode-display {
        min-height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .barcode-container {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 14px;
        padding: 1rem;
        display: inline-block;
        max-width: 100%;
    }

    .barcode-container svg,
    .barcode-container canvas,
    .barcode-container img {
        max-width: 100%;
        height: auto;
    }

    .barcode-title {
        font-size: 1.05rem;
        font-weight: 700;
    }

    .barcode-description {
        font-size: .85rem;
        color: #6c757d;
    }

    /* =========================================================
       STATUS
    ========================================================= */
    .status-icon {
        font-size: 3.5rem;
    }

    .status-title {
        font-weight: 700;
        font-size: 1rem;
    }

    .status-description {
        font-size: .85rem;
        color: #6c757d;
        line-height: 1.5;
    }

    /* =========================================================
       LIST BULAN
    ========================================================= */
    .month-list {
        border-radius: 12px;
        overflow: hidden;
    }

    .month-item {
        min-height: 58px;
        border-left: 0;
        border-right: 0;
        padding: .8rem 1rem;
        transition: all .15s ease;
    }

    .month-item:first-child {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .month-item:last-child {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .month-item:hover {
        background-color: #f8f9fa;
    }

    .month-item.active {
        background-color: #e8f5e9;
        color: #198754;
        border-color: #cfe8d5;
    }

    .month-name {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .35rem;
    }

    .month-status {
        white-space: nowrap;
    }

    /* =========================================================
       BADGE
    ========================================================= */
    .month-item .badge {
        font-size: .7rem;
        font-weight: 600;
    }

    /* =========================================================
       LOGOUT
    ========================================================= */
    .logout-wrapper {
        display: flex;
        justify-content: flex-end;
    }

    .logout-wrapper .btn {
        border-radius: 10px;
        font-weight: 600;
        min-height: 42px;
    }

    /* =========================================================
       MOBILE
    ========================================================= */
    @media (max-width: 991.98px) {
        .barcode-card {
            position: static;
        }

        #barcode-display {
            min-height: 350px;
        }
    }

    @media (max-width: 767.98px) {
        .karyawan-dashboard {
            padding-left: 0;
            padding-right: 0;
        }

        .karyawan-header {
            margin-bottom: 1rem !important;
        }

        .karyawan-header h2 {
            font-size: 1.3rem;
        }

        .karyawan-header p {
            font-size: .82rem;
        }

        .karyawan-card .card-body {
            padding: 1rem;
        }

        .profile-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
        }

        .profile-icon i {
            font-size: 1.4rem !important;
        }

        .profile-name {
            font-size: .95rem;
        }

        .employee-label {
            font-size: .7rem;
        }

        .employee-value {
            font-size: .88rem;
        }

        .info-alert {
            font-size: .82rem;
        }

        .info-alert .fs-4 {
            font-size: 1.3rem !important;
        }

        #barcode-display {
            min-height: 320px;
        }

        .barcode-container {
            padding: .75rem;
        }

        .barcode-container svg,
        .barcode-container canvas,
        .barcode-container img {
            width: 200px !important;
            max-width: 100%;
            height: auto !important;
        }

        .barcode-title {
            font-size: .98rem;
        }

        .barcode-description {
            font-size: .78rem;
        }

        .status-icon {
            font-size: 3rem;
        }

        .status-title {
            font-size: .95rem;
        }

        .status-description {
            font-size: .8rem;
        }

        .month-item {
            min-height: 60px;
            padding: .75rem;
        }

        .month-name {
            font-size: .85rem;
        }

        .month-status {
            margin-top: .25rem;
        }

        .month-item .badge {
            font-size: .65rem;
        }

        .logout-wrapper {
            justify-content: stretch;
        }

        .logout-wrapper form {
            width: 100%;
        }

        .logout-wrapper .btn {
            width: 100%;
        }
    }

    @media (max-width: 400px) {
        .karyawan-card .card-body {
            padding: .85rem;
        }

        .karyawan-header h2 {
            font-size: 1.2rem;
        }

        .info-alert {
            padding: .8rem;
        }

        #barcode-display {
            min-height: 300px;
        }

        .barcode-container svg,
        .barcode-container canvas,
        .barcode-container img {
            width: 180px !important;
        }

        .month-item {
            padding: .7rem;
        }

        .month-name {
            font-size: .8rem;
        }
    }

    /* =========================================================
       ANIMASI
    ========================================================= */
    .barcode-animation {
        animation: barcodeFade .25s ease-out;
    }

    @keyframes barcodeFade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="karyawan-dashboard">

    {{-- =====================================================
        HEADER
    ===================================================== --}}
    <div class="karyawan-header mb-4">
        <h2 class="fw-bold mb-1">Dashboard Karyawan</h2>
        <p class="text-muted mb-0">Sistem Pengambilan Gula Karyawan</p>
    </div>

    {{-- =====================================================
        DATA KARYAWAN
    ===================================================== --}}
    <div class="card shadow-sm karyawan-card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <div class="profile-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-fill fs-3"></i>
                </div>

                <div class="ms-3">
                    <h5 class="profile-name fw-bold mb-1">{{ $karyawan->nama }}</h5>
                    <div class="text-muted small">NIK: {{ $karyawan->nik }}</div>
                </div>
            </div>

            <div class="row g-3">
                {{-- JABATAN --}}
                <div class="col-12 col-sm-6">
                    <div>
                        <span class="employee-label">Jabatan</span>
                        <div class="employee-value">{{ $karyawan->jabatan ?? '-' }}</div>
                    </div>
                </div>

                {{-- BAGIAN --}}
                <div class="col-12 col-sm-6">
                    <div>
                        <span class="employee-label">Bagian</span>
                        <div class="employee-value">{{ $karyawan->bagian ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =====================================================
        INFORMASI
    ===================================================== --}}
    <div class="alert alert-info border-0 shadow-sm info-alert mb-4">
        <div class="d-flex align-items-start">
            <div class="info-icon me-3">
                <i class="bi bi-info-circle-fill fs-4"></i>
            </div>
            <div>
                <strong>Informasi Pengambilan Gula</strong>
                <div class="small mt-1">
                    Barcode hanya berlaku untuk <strong>bulan berjalan</strong>.
                    Tunjukkan barcode kepada operator untuk melakukan pengambilan gula.
                    Jika sampai akhir bulan tidak diambil, barcode bulan tersebut akan <strong>kedaluwarsa</strong>.
                    Barcode bulan berikutnya akan muncul otomatis saat bulan baru tiba.
                </div>
            </div>
        </div>
    </div>

    {{-- =====================================================
        BARCODE + DAFTAR BULAN
    ===================================================== --}}
    <div class="row g-4">

        {{-- =================================================
            BARCODE AKTIF
        ================================================= --}}
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm karyawan-card barcode-card">
                <div class="card-body text-center" id="barcode-display">
                    {{-- Diisi otomatis oleh JavaScript --}}
                </div>
            </div>
        </div>

        {{-- =================================================
            DAFTAR BULAN
        ================================================= --}}
        <div class="col-12 col-lg-7">
            <div class="card shadow-sm karyawan-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <h5 class="fw-bold mb-0">Daftar Barcode Per Bulan</h5>
                        <span class="badge bg-success">Tahun {{ now()->year }}</span>
                    </div>

                    <div class="list-group month-list" id="month-list">
                        @foreach($bulan as $item)
                            @php
                                $periode = $item['periode']->copy();
                                $bulanSekarang = now()->startOfMonth();
                                $bulanItem = $periode->copy()->startOfMonth();
                                $isCurrent = $bulanItem->equalTo($bulanSekarang);
                                $isFuture = $bulanItem->greaterThan($bulanSekarang);
                                $isExpired = $bulanItem->lessThan($bulanSekarang);
                            @endphp

                            <button type="button"
                                    class="list-group-item list-group-item-action month-item d-flex justify-content-between align-items-center gap-2"
                                    data-index="{{ $loop->index }}"
                                    data-current="{{ $isCurrent ? 1 : 0 }}"
                                    data-future="{{ $isFuture ? 1 : 0 }}"
                                    data-expired="{{ $isExpired ? 1 : 0 }}">

                                {{-- NAMA BULAN --}}
                                <span class="month-name">
                                    <span>
                                        <i class="bi bi-calendar3 me-2 text-muted"></i>
                                        {{ $periode->translatedFormat('F Y') }}
                                    </span>

                                    @if($isCurrent)
                                        <span class="badge bg-primary">Bulan Ini</span>
                                    @endif
                                </span>

                                {{-- STATUS --}}
                                <span class="month-status">
                                    @if($isFuture)
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-lock-fill"></i>
                                            Belum Tiba
                                        </span>

                                    @elseif($isCurrent && $item['sudah_diambil'])
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Sudah Diambil
                                        </span>

                                    @elseif($isCurrent && !$item['sudah_diambil'])
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            Belum Diambil
                                        </span>

                                    @elseif($isExpired && $item['sudah_diambil'])
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Sudah Diambil
                                        </span>

                                    @elseif($isExpired)
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle-fill"></i>
                                            Kedaluwarsa
                                        </span>
                                    @endif
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =====================================================
        TEMPLATE DATA PER BULAN
    ===================================================== --}}
    @foreach($bulan as $item)
        @php
            $periode = $item['periode']->copy();
            $bulanSekarang = now()->startOfMonth();
            $bulanItem = $periode->copy()->startOfMonth();
            $isCurrent = $bulanItem->equalTo($bulanSekarang);
            $isFuture = $bulanItem->greaterThan($bulanSekarang);
            $isExpired = $bulanItem->lessThan($bulanSekarang);
        @endphp

        <template id="month-data-{{ $loop->index }}">
            <div class="barcode-animation">
                <h5 class="fw-bold mb-3">{{ $periode->translatedFormat('F Y') }}</h5>

                {{-- BULAN MASA DEPAN --}}
                @if($isFuture)
                    <div class="text-muted py-5">
                        <i class="bi bi-lock-fill status-icon"></i>
                        <p class="mt-3 mb-1 status-title">Barcode Belum Tersedia</p>
                        <p class="mb-0 status-description">
                            Barcode akan muncul otomatis saat bulan
                            <strong>{{ $periode->translatedFormat('F Y') }}</strong> tiba.
                        </p>
                    </div>

                {{-- BULAN SEKARANG - SUDAH DIAMBIL --}}
                @elseif($isCurrent && $item['sudah_diambil'])
                    <div class="py-5">
                        <i class="bi bi-check-circle-fill text-success status-icon"></i>
                        <p class="mt-3 mb-1 text-success status-title">Sudah Diambil Bulan Ini</p>

                        @if($item['tanggal_ambil'])
                            <small class="text-muted">
                                <i class="bi bi-calendar-check"></i>
                                Diambil tanggal:
                                <strong>{{ \Carbon\Carbon::parse($item['tanggal_ambil'])->format('d-m-Y H:i') }}</strong>
                            </small>
                        @endif

                        <div class="mt-3">
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle-fill"></i>
                                Barcode sudah tidak tersedia
                            </span>
                        </div>
                    </div>

                {{-- BULAN SEKARANG - BELUM DIAMBIL --}}
                @elseif($isCurrent && !$item['sudah_diambil'])
                    <div class="barcode-title mb-2">Barcode Pengambilan</div>
                    <div class="barcode-description mb-3">
                        Berlaku untuk bulan <strong>{{ $periode->translatedFormat('F Y') }}</strong>
                    </div>

                    <div class="barcode-container">
                        {!! QrCode::size(200)->generate($item['barcode']) !!}
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Tunjukkan barcode ini kepada operator untuk mengambil gula.
                        </small>
                    </div>

                    <div class="mt-2">
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-clock-fill me-1"></i>
                            Belum Diambil
                        </span>
                    </div>

                {{-- BULAN SUDAH LEWAT - SUDAH DIAMBIL --}}
                @elseif($isExpired && $item['sudah_diambil'])
                    <div class="py-5">
                        <i class="bi bi-check-circle-fill text-success status-icon"></i>
                        <p class="mt-3 mb-1 text-success status-title">Sudah Diambil</p>

                        @if($item['tanggal_ambil'])
                            <small class="text-muted">
                                <i class="bi bi-calendar-check"></i>
                                Diambil tanggal:
                                <strong>{{ \Carbon\Carbon::parse($item['tanggal_ambil'])->format('d-m-Y H:i') }}</strong>
                            </small>
                        @endif
                    </div>

                {{-- BULAN SUDAH LEWAT - BELUM DIAMBIL --}}
                @elseif($isExpired && !$item['sudah_diambil'])
                    <div class="py-5">
                        <i class="bi bi-x-circle-fill text-danger status-icon"></i>
                        <p class="mt-3 mb-1 text-danger status-title">Barcode Sudah Tidak Tersedia</p>
                        <p class="mb-2 status-description">
                            Anda tidak melakukan pengambilan pada bulan
                            <strong>{{ $periode->translatedFormat('F Y') }}</strong>.
                        </p>

                        <div class="mt-3">
                            <span class="badge bg-danger">
                                <i class="bi bi-calendar-x-fill me-1"></i>
                                Periode Telah Berakhir
                            </span>
                        </div>

                        <p class="text-muted small mt-3 mb-0">
                            Barcode bulan tersebut sudah kedaluwarsa dan tidak dapat digunakan lagi.
                        </p>
                    </div>
                @endif
            </div>
        </template>
    @endforeach

    {{-- =====================================================
        LOGOUT
    ===================================================== --}}
    <div class="logout-wrapper mt-4">
        <form action="{{ route('karyawan.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-box-arrow-right me-1"></i>
                Logout
            </button>
        </form>
    </div>
</div>

{{-- =========================================================
    SCRIPT SWITCH BULAN
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.month-item');
    const display = document.getElementById('barcode-display');

    /*
    |--------------------------------------------------------------------------
    | Tampilkan bulan
    |--------------------------------------------------------------------------
    */
    function showMonth(index) {
        const template = document.getElementById('month-data-' + index);

        if (!template) {
            return;
        }

        /*
         * Masukkan template
         */
        display.innerHTML = template.innerHTML;

        /*
         * Reset active
         */
        items.forEach(function (btn) {
            btn.classList.remove('active');
        });

        /*
         * Tandai bulan yang dipilih
         */
        const activeBtn = document.querySelector('.month-item[data-index="' + index + '"]');

        if (activeBtn) {
            activeBtn.classList.add('active');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Event klik bulan
    |--------------------------------------------------------------------------
    */
    items.forEach(function (item) {
        item.addEventListener('click', function () {
            showMonth(this.dataset.index);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Default: Tampilkan bulan berjalan
    |--------------------------------------------------------------------------
    */
    const currentItem = document.querySelector('.month-item[data-current="1"]');

    if (currentItem) {
        showMonth(currentItem.dataset.index);
    } else if (items.length > 0) {
        showMonth(items[0].dataset.index);
    }
});
</script>

@endsection
