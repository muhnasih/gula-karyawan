<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengambilan Gula</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }
        h2 {
            text-align: center;
            margin-bottom: 4px;
            font-size: 16px;
        }
        .subtitle {
            text-align: center;
            margin-bottom: 14px;
            font-size: 10px;
            color: #555;
        }
        .statistik {
            width: 100%;
            margin-bottom: 14px;
            border-collapse: collapse;
        }
        .statistik td {
            border: 1px solid #ccc;
            padding: 6px 10px;
            text-align: center;
            width: 25%;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
        }
        table.data th,
        table.data td {
            border: 1px solid #999;
            padding: 5px 7px;
        }
        table.data th {
            background-color: #e8f5e9;
            font-size: 11px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <h2>Laporan Pengambilan Gula</h2>
    <p class="subtitle">
        PG Gending &mdash; Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </p>

    {{-- Statistik --}}
    <table class="statistik">
        <tr>
            <td>
                Total Karyawan<br>
                <strong>{{ $statistik['totalKaryawan'] ?? 0 }}</strong>
            </td>
            <td>
                Sudah Ambil<br>
                <strong>{{ $statistik['sudahAmbil'] ?? 0 }}</strong>
            </td>
            <td>
                Belum Ambil<br>
                <strong>{{ $statistik['belumAmbil'] ?? 0 }}</strong>
            </td>
            <td>
                Total Gula<br>
                <strong>{{ number_format($statistik['totalGula'] ?? 0) }} KG</strong>
            </td>
        </tr>
    </table>

    {{-- Tabel Data --}}
    <table class="data">
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="13%">NIK</th>
                <th>Nama</th>
                <th width="12%">Kategori</th>
                <th width="13%">Bagian</th>
                <th width="14%">Tanggal Ambil</th>
                <th class="text-center" width="10%">Jumlah</th>
                <th class="text-center" width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $row->nik }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->kategori ?? '-' }}</td>
                    <td>{{ $row->bagian ?? '-' }}</td>
                    <td>
                        {{ $row->tanggal_ambil
                            ? \Carbon\Carbon::parse($row->tanggal_ambil)->translatedFormat('d F Y')
                            : '-' }}
                    </td>
                    <td class="text-center">
                        {{ !is_null($row->jumlah_gula) ? $row->jumlah_gula . ' KG' : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $row->tanggal_ambil ? 'Sudah' : 'Belum' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>