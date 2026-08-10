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

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = DB::table('pengambilan_gula')
            ->join(
                'karyawan',
                'karyawan.id',
                '=',
                'pengambilan_gula.karyawan_id'
            )
            ->select(
                'karyawan.nik',
                'karyawan.nama',
                'karyawan.kategori',
                'karyawan.bagian',
                'pengambilan_gula.tanggal_ambil'
            );

        if ($this->request->filled('tanggal_awal')) {
            $query->whereDate(
                'pengambilan_gula.tanggal_ambil',
                '>=',
                $this->request->tanggal_awal
            );
        }

        if ($this->request->filled('tanggal_akhir')) {
            $query->whereDate(
                'pengambilan_gula.tanggal_ambil',
                '<=',
                $this->request->tanggal_akhir
            );
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
                    $item->tanggal_ambil ?? '-',
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