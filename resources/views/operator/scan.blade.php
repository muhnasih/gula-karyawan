@extends('layouts.app')

@section('title', 'Scan QR Karyawan')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold" style="color: var(--pg-green);">
        <i class="bi bi-qr-code-scan"></i>
        Scan QR Karyawan
    </h2>

    <p class="text-muted mb-0">
        Scan QR pada dashboard karyawan untuk proses pengambilan gula.
    </p>
</div>

<div class="row g-4">

    {{-- KIRI: KAMERA + HASIL SCAN --}}
    <div class="col-lg-7">

        {{-- SCANNER --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <h5 class="fw-bold mb-3">
                    Kamera Scanner
                </h5>

                <div
                    id="reader"
                    style="width: 100%;"
                ></div>

                <div
                    id="scan-status"
                    class="alert alert-info mt-3 mb-0"
                >
                    Arahkan kamera ke QR Code karyawan.
                </div>

            </div>
        </div>

        {{-- HASIL SCAN --}}
        <div
            id="hasil-scan"
            class="card shadow-sm border-0 d-none"
        >
            <div class="card-body">

                <h5 class="fw-bold mb-3">
                    Data Karyawan
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <small class="text-muted">Nama</small>
                        <div id="nama" class="fw-bold fs-5">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted">NIK</small>
                        <div id="nik" class="fw-bold">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted">Jabatan</small>
                        <div id="jabatan">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <small class="text-muted">Bagian</small>
                        <div id="bagian">-</div>
                    </div>

                </div>

                {{-- STATUS --}}
                <div id="status-box" class="alert"></div>

                {{-- FORM KONFIRMASI --}}
                <form
                    id="form-confirm"
                    action="{{ route('operator.scan.confirm') }}"
                    method="POST"
                    class="d-none"
                >
                    @csrf

                    <input type="hidden" name="nik" id="nik-input">
                    <input type="hidden" name="periode" id="periode-input">

                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-check-circle-fill"></i>
                        Konfirmasi Pengambilan
                    </button>
                </form>

                {{-- SCAN LAGI --}}
                <button
                    type="button"
                    id="scan-lagi"
                    class="btn btn-primary w-100 mt-2"
                    onclick="scanLagi()"
                >
                    <i class="bi bi-camera"></i>
                    Scan Karyawan Lain
                </button>

            </div>
        </div>

    </div>

    {{-- KANAN: RIWAYAT --}}
    <div class="col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h5 class="fw-bold mb-3">
                    <i class="bi bi-clock-history text-success"></i>
                    Riwayat Pengambilan
                </h5>

                <div class="table-responsive">
                    <table class="table table-sm align-middle" id="tabel-riwayat">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat ?? [] as $item)
                                <tr>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <span class="badge bg-success">SUDAH</span>
                                    </td>
                                </tr>
                            @empty
                                <tr id="riwayat-kosong">
                                    <td colspan="3" class="text-center text-muted">
                                        Belum ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- LIBRARY QR SCANNER --}}
<script src="https://unpkg.com/html5-qrcode"></script>

<script>

let scanner;
let sedangScan = true;

/*
|--------------------------------------------------------------------------
| Mulai Scanner
|--------------------------------------------------------------------------
*/
function mulaiScanner()
{
    scanner = new Html5Qrcode("reader");

    scanner.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: { width: 250, height: 250 }
        },

        function(decodedText) {
            if (!sedangScan) {
                return;
            }
            sedangScan = false;
            prosesScan(decodedText);
        },

        function(errorMessage) {
            // Tidak perlu menampilkan error scan
        }

    ).catch(function(error) {

        document.getElementById('scan-status').className =
            'alert alert-danger mt-3';

        document.getElementById('scan-status').innerHTML =
            'Kamera tidak dapat digunakan. Pastikan izin kamera diberikan.';

    });
}

/*
|--------------------------------------------------------------------------
| Proses hasil QR
|--------------------------------------------------------------------------
*/
function prosesScan(nik)
{
    document.getElementById('scan-status').className =
        'alert alert-warning mt-3';

    document.getElementById('scan-status').innerHTML =
        'QR terbaca. Mencari data karyawan...';

    fetch('{{ route('operator.scan.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ nik: nik })
    })

    .then(response => response.json())

    .then(data => {

        if (!data.success) {
            throw new Error(data.message || 'Data tidak ditemukan.');
        }

        tampilkanData(data);

    })

    .catch(error => {

        document.getElementById('scan-status').className =
            'alert alert-danger mt-3';

        document.getElementById('scan-status').innerHTML =
            error.message;

        sedangScan = true;

    });
}

/*
|--------------------------------------------------------------------------
| Tampilkan data karyawan
|--------------------------------------------------------------------------
*/
function tampilkanData(data)
{
    const karyawan = data.karyawan;

    document.getElementById('hasil-scan').classList.remove('d-none');

    document.getElementById('nama').innerText = karyawan.nama;
    document.getElementById('nik').innerText = karyawan.nik;
    document.getElementById('jabatan').innerText = karyawan.jabatan || '-';
    document.getElementById('bagian').innerText = karyawan.bagian || '-';

    document.getElementById('nik-input').value = karyawan.nik;
    document.getElementById('periode-input').value = data.periode;

    const statusBox = document.getElementById('status-box');
    const formConfirm = document.getElementById('form-confirm');

    if (data.status === 'belum') {

        statusBox.className = 'alert alert-warning';

        statusBox.innerHTML =
            '<i class="bi bi-exclamation-circle-fill"></i> ' +
            'BELUM DIAMBIL pada bulan ' + data.periode;

        formConfirm.classList.remove('d-none');

    } else {

        statusBox.className = 'alert alert-success';

        statusBox.innerHTML =
            '<i class="bi bi-check-circle-fill"></i> ' +
            'SUDAH DIAMBIL pada bulan ' + data.periode +
            '<br>Tanggal: ' + (data.tanggal_ambil || '-');

        formConfirm.classList.add('d-none');

    }

    document.getElementById('scan-status').className =
        'alert alert-success mt-3';

    document.getElementById('scan-status').innerHTML =
        'QR berhasil dibaca.';
}

/*
|--------------------------------------------------------------------------
| Tambah baris ke tabel Riwayat (tanpa reload)
|--------------------------------------------------------------------------
*/
function tambahRiwayat(nik, nama)
{
    const kosong = document.getElementById('riwayat-kosong');

    if (kosong) {
        kosong.remove();
    }

    const tbody = document.querySelector('#tabel-riwayat tbody');

    const row = document.createElement('tr');

    row.innerHTML =
        '<td>' + nik + '</td>' +
        '<td>' + nama + '</td>' +
        '<td><span class="badge bg-success">SUDAH</span></td>';

    tbody.prepend(row);
}

/*
|--------------------------------------------------------------------------
| Submit form konfirmasi via AJAX (biar tabel riwayat auto-update)
|--------------------------------------------------------------------------
*/
document.getElementById('form-confirm').addEventListener('submit', function(e) {

    e.preventDefault();

    const nik = document.getElementById('nik-input').value;
    const nama = document.getElementById('nama').innerText;
    const periode = document.getElementById('periode-input').value;

    fetch(this.action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ nik: nik, periode: periode })
    })

    .then(response => response.json())

    .then(data => {

        if (!data.success) {
            throw new Error(data.message || 'Konfirmasi gagal.');
        }

        tambahRiwayat(nik, nama);
        scanLagi();

    })

    .catch(error => {
        alert(error.message);
    });

});

/*
|--------------------------------------------------------------------------
| Scan Lagi
|--------------------------------------------------------------------------
*/
function scanLagi()
{
    document.getElementById('hasil-scan').classList.add('d-none');
    document.getElementById('form-confirm').classList.add('d-none');

    document.getElementById('scan-status').className =
        'alert alert-info mt-3';

    document.getElementById('scan-status').innerHTML =
        'Arahkan kamera ke QR Code karyawan.';

    sedangScan = true;
}

mulaiScanner();

</script>

@endsection