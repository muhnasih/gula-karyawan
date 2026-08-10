<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengambilan Gula</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #222;
        }
        h2 {
            text-align: center;
            margin-bottom: 4px;
        }
        .subtitle {
            text-align: center;
            margin-bottom: 16px;
            font-size: 11px;
            color: #555;
        }
        .statistik {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .statistik div {
            border: 1px solid #ccc;
            padding: 6px 12px;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Laporan Pengambilan Gula</h2>
    <p class="subtitle">
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </p>

    <div class="statistik">
        <div>Total Karyawan: <strong>{{ $statistik['totalKaryawan'] }}</strong></div>
        <div>Sudah Ambil: <strong>{{ $statistik['sudahAmbil'] }}</strong></div>
        <div>Belum Ambil: <strong>{{ $statistik['belumAmbil'] }}</strong></div>
        <div>Pensiun: <strong>{{ $statistik['pensiun'] }}</strong></div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Bagian</th>
                <th>Tanggal Ambil</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $row->nik }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->kategori }}</td>
                    <td>{{ $row->bagian }}</td>
                    <td>{{ $row->tanggal_ambil ? \Carbon\Carbon::parse($row->tanggal_ambil)->translatedFormat('d F Y') : '-' }}</td>
                    <td class="text-center">{{ $row->tanggal_ambil ? 'Sudah' : 'Belum' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>