@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('content')

<style>
    .operator-dashboard { width: 100%; max-width: 100%; overflow-x: hidden; }
    .operator-header { margin-bottom: 1.25rem; }
    .operator-header h2 { color: var(--pg-green, #198754); font-weight: 700; margin-bottom: .35rem; }
    .operator-header p { margin-bottom: 0; color: #6c757d; }
    .operator-card { border: 0; border-radius: 16px; overflow: hidden; }
    .operator-card .card-body { padding: 1.25rem; }
    .card-title-operator { font-size: 1.05rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: .5rem; }
    .scanner-wrapper { width: 100%; max-width: 520px; margin: 0 auto; }
    #reader { width: 100% !important; max-width: 520px; margin: 0 auto; overflow: hidden; border-radius: 14px; }
    #reader video { width: 100% !important; height: auto !important; max-height: 430px; object-fit: cover; border-radius: 12px; }
    #reader img { max-width: 100%; }
    #reader__scan_region { width: 100% !important; min-height: 0 !important; }
    #reader__scan_region video { width: 100% !important; }
    #reader__dashboard { width: 100% !important; padding: 8px 0 0 !important; }
    #reader__dashboard_section { width: 100% !important; }
    #reader__dashboard_section_csr { width: 100% !important; }
    #reader__camera_permission_button { width: 100%; max-width: 100%; }
    #reader__dashboard_section_swaplink { display: inline-block; margin-top: 6px; }
    #scan-status { border-radius: 10px; font-size: .9rem; line-height: 1.4; }
    #hasil-scan { border-radius: 16px; }
    .employee-info { background: #f8f9fa; border-radius: 12px; padding: 1rem; }
    .employee-item { min-height: 58px; }
    .employee-label { display: block; font-size: .75rem; color: #6c757d; margin-bottom: .2rem; }
    .employee-value { font-size: .95rem; font-weight: 500; word-break: break-word; }
    #nama { font-size: 1.05rem !important; font-weight: 700 !important; }
    .sugar-card { background: linear-gradient(135deg, #198754, #157347); color: white; border-radius: 14px; padding: 1rem; margin-top: 1rem; }
    .sugar-label { font-size: .75rem; opacity: .9; margin-bottom: .2rem; }
    .sugar-value { font-size: 1.8rem; font-weight: 800; line-height: 1.1; }
    .sugar-category { font-size: .85rem; margin-top: .35rem; opacity: .95; }
    #status-box { border-radius: 10px; margin-bottom: 1rem; line-height: 1.5; }
    #form-confirm .btn, #scan-lagi { min-height: 46px; border-radius: 10px; font-weight: 600; }
    .history-wrapper { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
    #tabel-riwayat { width: 100%; min-width: 520px; margin-bottom: 0; }
    #tabel-riwayat th { font-size: .75rem; font-weight: 700; color: #6c757d; white-space: nowrap; text-transform: uppercase; }
    #tabel-riwayat td { font-size: .85rem; vertical-align: middle; }
    #tabel-riwayat td:first-child { white-space: nowrap; }
    .history-empty { padding: 1.5rem .5rem !important; }
    .badge-kg { display: inline-flex; align-items: center; gap: .2rem; font-size: .75rem; font-weight: 700; padding: .4rem .6rem; border-radius: 8px; }
    @media (max-width: 767.98px) {
        .operator-dashboard { padding-left: 0; padding-right: 0; }
        .operator-header { margin-bottom: 1rem; }
        .operator-header h2 { font-size: 1.35rem; }
        .operator-header p { font-size: .85rem; line-height: 1.4; }
        .operator-card .card-body { padding: 1rem; }
        .card-title-operator { font-size: .98rem; }
        .scanner-wrapper { max-width: 100%; }
        #reader { max-width: 100%; }
        #reader video { max-height: 360px; }
        #scan-status { font-size: .82rem; }
        .employee-info { padding: .85rem; }
        .employee-item { min-height: auto; padding-bottom: .75rem; }
        .employee-label { font-size: .7rem; }
        .employee-value { font-size: .9rem; }
        #nama { font-size: 1rem !important; }
        .sugar-card { padding: .9rem; }
        .sugar-value { font-size: 1.6rem; }
        #form-confirm .btn, #scan-lagi { min-height: 48px; font-size: .9rem; }
        #tabel-riwayat { min-width: 500px; }
    }
    @media (max-width: 400px) {
        .operator-header h2 { font-size: 1.2rem; }
        .operator-header p { font-size: .78rem; }
        .operator-card .card-body { padding: .85rem; }
        #reader video { max-height: 300px; }
        #scan-status { font-size: .78rem; }
        .sugar-value { font-size: 1.45rem; }
    }
    @media (min-width: 768px) and (max-width: 991.98px) {
        .operator-card .card-body { padding: 1rem; }
        #reader video { max-height: 380px; }
    }
    .scan-result-animation { animation: scanResult .25s ease-out; }
    @keyframes scanResult { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
</style>


<div class="operator-dashboard">

    <div class="operator-header">
        <h2><i class="bi bi-speedometer2"></i> Dashboard Operator</h2>
        <p>Scan pengambilan gula karyawan PG Gending</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-circle-fill me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3">

        <div class="col-12 col-lg-7">

            <div class="card shadow-sm operator-card mb-3">
                <div class="card-body">
                    <div class="card-title-operator">
                        <i class="bi bi-qr-code-scan text-success"></i>
                        Kamera Scanner
                    </div>
                    <div class="scanner-wrapper">
                        <div id="reader"></div>
                    </div>
                    <div id="scan-status" class="alert alert-info mt-3 mb-0">
                        <i class="bi bi-camera me-1"></i>
                        Arahkan kamera ke QR Code karyawan.
                    </div>
                </div>
            </div>

            <div id="hasil-scan" class="card shadow-sm operator-card d-none">
                <div class="card-body">

                    <div class="card-title-operator">
                        <i class="bi bi-person-vcard text-success"></i>
                        Data Karyawan
                    </div>

                    <div class="employee-info">
                        <div class="row g-3">

                            <div class="col-12 col-sm-6">
                                <div class="employee-item">
                                    <span class="employee-label">Nama</span>
                                    <div id="nama" class="employee-value">-</div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="employee-item">
                                    <span class="employee-label">NIK</span>
                                    <div id="nik" class="employee-value">-</div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="employee-item">
                                    <span class="employee-label">Jabatan</span>
                                    <div id="jabatan" class="employee-value">-</div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="employee-item">
                                    <span class="employee-label">Bagian</span>
                                    <div id="bagian" class="employee-value">-</div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="employee-item">
                                    <span class="employee-label">Kategori</span>
                                    <div id="kategori" class="employee-value">-</div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="employee-item">
                                    <span class="employee-label">Status</span>
                                    <div id="status-karyawan" class="employee-value">-</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="sugar-card">
                        <div class="sugar-label">Jatah Pengambilan Gula</div>
                        <div class="sugar-value">
                            <span id="jumlah-gula">-</span> KG
                        </div>
                        <div class="sugar-category">
                            Status: <strong id="kategori-gula">-</strong>
                        </div>
                    </div>

                    <div id="status-box" class="alert mt-3"></div>

                    <form id="form-confirm" action="{{ route('operator.scan.confirm') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="nik" id="nik-input">
                        <input type="hidden" name="periode" id="periode-input">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Konfirmasi Pengambilan
                        </button>
                    </form>

                    <button type="button" id="scan-lagi" class="btn btn-primary w-100 mt-2" onclick="scanLagi()">
                        <i class="bi bi-camera me-1"></i>
                        Scan Karyawan Lain
                    </button>

                </div>
            </div>

        </div>

        <div class="col-12 col-lg-5">
            <div class="card shadow-sm operator-card">
                <div class="card-body">

                    <div class="card-title-operator">
                        <i class="bi bi-clock-history text-success"></i>
                        Riwayat Pengambilan
                    </div>

                    <div class="history-wrapper">
                        <table class="table table-sm align-middle" id="tabel-riwayat">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Pengambilan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat ?? [] as $item)
                                    <tr>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->status ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-success badge-kg">
                                                <i class="bi bi-box-seam"></i>
                                                {{ $item->jumlah_gula ?? 0 }} KG
                                            </span>
                                        </td>
                                        <td>{{ $item->tanggal_ambil }}</td>
                                        <td><span class="badge bg-success">SUDAH</span></td>
                                    </tr>
                                @empty
                                    <tr id="riwayat-kosong">
                                        <td colspan="6" class="text-center text-muted history-empty">
                                            <i class="bi bi-inbox fs-4 d-block mb-1"></i>
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
</div>


<script src="https://unpkg.com/html5-qrcode"></script>

<script>

    let scanner = null;
    let sedangScan = true;

    function mulaiScanner()
    {
        const reader = document.getElementById('reader');
        if (!reader) { return; }

        scanner = new Html5Qrcode("reader");

        scanner.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: function(viewfinderWidth, viewfinderHeight) {
                    let ukuran = Math.floor(Math.min(viewfinderWidth, viewfinderHeight) * 0.65);
                    ukuran = Math.max(180, ukuran);
                    ukuran = Math.min(300, ukuran);
                    return { width: ukuran, height: ukuran };
                },
                aspectRatio: 1.0,
                disableFlip: false
            },
            function(decodedText) {
                if (!sedangScan) { return; }
                sedangScan = false;
                prosesScan(decodedText);
            },
            function(errorMessage) {
                // Error scanner tidak perlu ditampilkan.
            }
        )
        .catch(function(error) {
            console.error(error);
            const status = document.getElementById('scan-status');
            status.className = 'alert alert-danger mt-3 mb-0';
            status.innerHTML =
                '<i class="bi bi-camera-video-off-fill me-1"></i>' +
                'Kamera tidak dapat digunakan. Pastikan izin kamera diberikan pada browser.';
        });
    }

    function prosesScan(nik)
    {
        const status = document.getElementById('scan-status');
        status.className = 'alert alert-warning mt-3 mb-0';
        status.innerHTML =
            '<span class="spinner-border spinner-border-sm me-1"></span>QR terbaca. Mencari data karyawan...';

        fetch('{{ route('operator.scan.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ nik: nik })
        })
        .then(response => {
            return response.json().then(data => {
                if (!response.ok) {
                    throw new Error(data.message || 'Terjadi kesalahan pada server.');
                }
                return data;
            });
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Data karyawan tidak ditemukan.');
            }
            tampilkanData(data);
        })
        .catch(error => {
            console.error(error);
            status.className = 'alert alert-danger mt-3 mb-0';
            status.innerHTML = '<i class="bi bi-exclamation-circle-fill me-1"></i>' + error.message;
            sedangScan = true;
        });
    }

    function tampilkanData(data)
    {
        const karyawan = data.karyawan;

        const hasilScan = document.getElementById('hasil-scan');
        hasilScan.classList.remove('d-none');
        hasilScan.classList.remove('scan-result-animation');
        void hasilScan.offsetWidth;
        hasilScan.classList.add('scan-result-animation');

        document.getElementById('nama').innerText = karyawan.nama || '-';
        document.getElementById('nik').innerText = karyawan.nik || '-';
        document.getElementById('jabatan').innerText = karyawan.jabatan || '-';
        document.getElementById('bagian').innerText = karyawan.bagian || '-';
        document.getElementById('kategori').innerText = karyawan.kategori || '-';
        document.getElementById('status-karyawan').innerText = karyawan.status || '-';

        document.getElementById('jumlah-gula').innerText = data.jumlah_gula ?? '-';
        document.getElementById('kategori-gula').innerText = karyawan.status || '-';

        document.getElementById('nik-input').value = karyawan.nik || '';
        document.getElementById('periode-input').value = data.periode || '';

        const statusBox = document.getElementById('status-box');
        const formConfirm = document.getElementById('form-confirm');

        if (data.status === 'belum')
        {
            statusBox.className = 'alert alert-warning';
            statusBox.innerHTML =
                '<i class="bi bi-exclamation-circle-fill me-1"></i>' +
                '<strong>BELUM DIAMBIL</strong><br>' +
                'Periode: ' + (data.periode || '-') + '<br>' +
                '<strong>Jatah: ' + (data.jumlah_gula ?? '-') + ' KG</strong>';

            formConfirm.classList.remove('d-none');
        }
        else
        {
            statusBox.className = 'alert alert-success';
            statusBox.innerHTML =
                '<i class="bi bi-check-circle-fill me-1"></i>' +
                '<strong>SUDAH DIAMBIL</strong><br>' +
                'Periode: ' + (data.periode || '-') + '<br>' +
                'Tanggal: ' + (data.tanggal_ambil || '-') + '<br>' +
                '<strong>Sudah menerima: ' + (data.jumlah_gula ?? '-') + ' KG</strong>';

            formConfirm.classList.add('d-none');
        }

        const scanStatus = document.getElementById('scan-status');
        scanStatus.className = 'alert alert-success mt-3 mb-0';
        scanStatus.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i>QR berhasil dibaca.';
    }

    function tambahRiwayat(nik, nama, status, jumlahGula, tanggal)
    {
        const kosong = document.getElementById('riwayat-kosong');
        if (kosong) { kosong.remove(); }

        const tbody = document.querySelector('#tabel-riwayat tbody');
        const row = document.createElement('tr');

        row.innerHTML =
            '<td>' + escapeHtml(nik) + '</td>' +
            '<td>' + escapeHtml(nama) + '</td>' +
            '<td>' + escapeHtml(status || '-') + '</td>' +
            '<td><span class="badge bg-success badge-kg"><i class="bi bi-box-seam"></i>' + escapeHtml(jumlahGula || 0) + ' KG</span></td>' +
            '<td>' + escapeHtml(tanggal || '-') + '</td>' +
            '<td><span class="badge bg-success">SUDAH</span></td>';

        tbody.prepend(row);
    }

    function escapeHtml(value)
    {
        if (value === null || value === undefined) { return ''; }
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    document.getElementById('form-confirm').addEventListener('submit', function(e)
    {
        e.preventDefault();

        const form = this;
        const button = form.querySelector('button[type="submit"]');

        const nik = document.getElementById('nik-input').value;
        const nama = document.getElementById('nama').innerText;
        const status = document.getElementById('status-karyawan').innerText;
        const jumlahGulaTampilan = document.getElementById('jumlah-gula').innerText;
        const periode = document.getElementById('periode-input').value;

        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Memproses...';

        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ nik: nik, periode: periode })
        })
        .then(response => {
            return response.json().then(data => {
                if (!response.ok) {
                    throw new Error(data.message || 'Terjadi kesalahan pada server.');
                }
                return data;
            });
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Konfirmasi gagal.');
            }

            const jumlah = data.jumlah_gula ?? jumlahGulaTampilan;
            const statusServer = (data.karyawan && data.karyawan.status) || status;
            const tanggalServer = data.tanggal_ambil || new Date().toLocaleDateString('id-ID');

            tambahRiwayat(nik, nama, statusServer, jumlah, tanggalServer);

            scanLagi();
        })
        .catch(error => {
            console.error(error);
            alert(error.message || 'Terjadi kesalahan.');
        })
        .finally(() => {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i>Konfirmasi Pengambilan';
        });
    });

    function scanLagi()
    {
        document.getElementById('hasil-scan').classList.add('d-none');
        document.getElementById('form-confirm').classList.add('d-none');

        const status = document.getElementById('scan-status');
        status.className = 'alert alert-info mt-3 mb-0';
        status.innerHTML = '<i class="bi bi-camera me-1"></i>Arahkan kamera ke QR Code karyawan.';

        sedangScan = true;
    }

    mulaiScanner();

</script>

@endsection