<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KaryawanTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'nik',
            'nama',
            'jabatan',
            'bagian',
            'status',
            'kategori',
            'keterangan',
        ];
    }

    public function array(): array
    {
        return [
            [
                '11004973',
                'Budi Santoso',
                'Operator',
                'Produksi',
                'KARPIM',
                'Tetap',
                '',
            ],
            [
                '11004974',
                'Andi Wijaya',
                'Staff',
                'Administrasi',
                'KARPEL',
                'Tetap',
                '',
            ],
        ];
    }
}