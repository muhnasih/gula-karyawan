<?php

namespace App\Imports;

use App\Models\Karyawan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToCollection, WithHeadingRow
{
    public int $berhasil = 0;
    public int $dilewati = 0;
    public int $gagal = 0;

    public array $errorRows = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {

            try {

                $nik = trim((string) ($row['nik'] ?? ''));
                $nama = trim((string) ($row['nama'] ?? ''));

                // Validasi data wajib
                if ($nik === '' || $nama === '') {
                    $this->gagal++;

                    $this->errorRows[] = [
                        'baris' => $index + 2,
                        'alasan' => 'NIK atau Nama kosong',
                    ];

                    continue;
                }

                // Cek NIK sudah ada
                $sudahAda = Karyawan::where('nik', $nik)->exists();

                if ($sudahAda) {
                    $this->dilewati++;
                    continue;
                }

                Karyawan::create([
                    'nik'               => $nik,
                    'nama'              => $nama,
                    'jabatan'           => $this->nullableValue($row['jabatan'] ?? null),
                    'bagian'            => $this->nullableValue($row['bagian'] ?? null),
                    'status'            => $this->nullableValue($row['status'] ?? 'Aktif'),
                    'kategori'          => $this->nullableValue($row['kategori'] ?? null),
                    'keterangan'        => $this->nullableValue($row['keterangan'] ?? null),

                    // Jangan mengubah status pengambilan
                    // secara manual ketika import.
                    'status_pengambilan' => null,
                    'tanggal_pengambilan' => null,
                    'discan_oleh' => null,
                ]);

                $this->berhasil++;

            } catch (\Throwable $e) {

                $this->gagal++;

                $this->errorRows[] = [
                    'baris' => $index + 2,
                    'alasan' => $e->getMessage(),
                ];
            }
        }
    }

    private function nullableValue($value)
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}