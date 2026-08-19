<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanGulaExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize
{
    protected $request;

    protected int $bulanAktif;

    protected int $tahunAktif;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Default ke bulan & tahun berjalan, sama seperti halaman laporan.
        $this->bulanAktif = (int) $request->input('bulan', now()->month);
        $this->tahunAktif = (int) $request->input('tahun', now()->year);
    }

    public function collection()
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY PENGAMBILAN — DIBATASI KE BULAN & TAHUN AKTIF
        |--------------------------------------------------------------------------
        */

        $pengambilanQuery = DB::table('pengambilan_gula')
            ->select(
                'karyawan_id',
                'tanggal_ambil',
                'jumlah_gula'
            )
            ->whereYear('tanggal_ambil', $this->tahunAktif)
            ->whereMonth('tanggal_ambil', $this->bulanAktif);

        /*
        |--------------------------------------------------------------------------
        | QUERY UTAMA — MULAI DARI KARYAWAN (LEFT JOIN)
        |--------------------------------------------------------------------------
        |
        | Supaya karyawan yang belum mengambil gula di bulan ini
        | tetap ikut muncul di export, bukan cuma yang sudah ambil.
        |
        */

        $query = DB::table('karyawan')

            ->leftJoinSub(
                $pengambilanQuery,
                'pengambilan',
                function ($join) {
                    $join->on(
                        'karyawan.id',
                        '=',
                        'pengambilan.karyawan_id'
                    );
                }
            )

            ->select(
                'karyawan.nik',
                'karyawan.nama',
                'karyawan.kategori',
                'karyawan.bagian',
                'pengambilan.tanggal_ambil',

                DB::raw(
                    'COALESCE(
                        pengambilan.jumlah_gula,
                        0
                    ) as jumlah_gula'
                )
            );

        /*
        |--------------------------------------------------------------------------
        | SEARCH NAMA / NIK (opsional, ikut filter di halaman laporan)
        |--------------------------------------------------------------------------
        */

        if ($this->request->filled('search')) {

            $search = trim($this->request->search);

            $query->where(function ($q) use ($search) {
                $q->where('karyawan.nama', 'like', "%{$search}%")
                  ->orWhere('karyawan.nik', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS (opsional, ikut filter di halaman laporan)
        |--------------------------------------------------------------------------
        */

        if ($this->request->filled('status')) {

            if ($this->request->status === 'sudah') {
                $query->whereNotNull('pengambilan.karyawan_id');
            } elseif ($this->request->status === 'belum') {
                $query->whereNull('pengambilan.karyawan_id');
            }
        }

        return $query
            ->orderBy('karyawan.nama')
            ->get()
            ->map(function ($item) {

                return [
                    $item->nik,
                    $item->nama,
                    $item->kategori,
                    $item->bagian,
                    $item->tanggal_ambil
                        ? date('d-m-Y', strtotime($item->tanggal_ambil))
                        : '-',
                    $item->tanggal_ambil ? $item->jumlah_gula : '-',
                    $item->tanggal_ambil
                        ? 'Sudah Mengambil'
                        : 'Belum Mengambil',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'Kategori',
            'Bagian',
            'Tanggal Ambil',
            'Jumlah Gula (KG)',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
}