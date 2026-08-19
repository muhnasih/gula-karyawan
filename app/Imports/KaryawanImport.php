<?php

namespace App\Imports;

use App\Models\Karyawan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToCollection, WithHeadingRow
{
    /**
     * Statistik hasil import
     */
    public int $berhasil = 0;
    public int $dilewati = 0;
    public int $gagal = 0;

    /**
     * Menyimpan detail error setiap baris
     */
    public array $errorRows = [];

    /**
     * =========================================================
     * PROSES IMPORT DATA
     * =========================================================
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {

            // Nomor baris Excel.
            // Karena baris pertama adalah header,
            // data pertama berada di baris 2.
            $barisExcel = $index + 2;

            try {

                /*
                |--------------------------------------------------------------------------
                | AMBIL DATA DARI EXCEL
                |--------------------------------------------------------------------------
                */

                $nik = $this->cleanValue($row['nik'] ?? null);
                $nama = $this->cleanValue($row['nama'] ?? null);

                /*
                |--------------------------------------------------------------------------
                | VALIDASI NIK DAN NAMA
                |--------------------------------------------------------------------------
                */

                if ($nik === null) {

                    $this->gagal++;

                    $this->errorRows[] = [
                        'baris' => $barisExcel,
                        'nik'   => '-',
                        'nama'  => $nama ?? '-',
                        'alasan' => 'NIK kosong',
                    ];

                    continue;
                }

                if ($nama === null) {

                    $this->gagal++;

                    $this->errorRows[] = [
                        'baris' => $barisExcel,
                        'nik'   => $nik,
                        'nama'  => '-',
                        'alasan' => 'Nama kosong',
                    ];

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | CEK NIK SUDAH TERDAFTAR
                |--------------------------------------------------------------------------
                */

                $sudahAda = Karyawan::where('nik', $nik)->exists();

                if ($sudahAda) {

                    $this->dilewati++;

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | SIMPAN DATA KARYAWAN
                |--------------------------------------------------------------------------
                |
                | status_pengambilan WAJIB memiliki nilai karena di database:
                |
                | enum('belum','sudah')
                | NOT NULL
                | DEFAULT 'belum'
                |
                | Kita isi secara eksplisit dengan 'belum'.
                |
                */

                Karyawan::create([
                    'nik' => $nik,

                    'nama' => $nama,

                    'jabatan' => $this->nullableValue(
                        $row['jabatan'] ?? null
                    ),

                    'bagian' => $this->nullableValue(
                        $row['bagian'] ?? null
                    ),

                    'status' => $this->nullableValue(
                        $row['status'] ?? null
                    ),

                    'kategori' => $this->nullableValue(
                        $row['kategori'] ?? null
                    ),

                    'keterangan' => $this->nullableValue(
                        $row['keterangan'] ?? null
                    ),

                    /*
                    |--------------------------------------------------------------------------
                    | STATUS PENGAMBILAN GULA
                    |--------------------------------------------------------------------------
                    */

                    'status_pengambilan' => 'belum',

                    /*
                    |--------------------------------------------------------------------------
                    | BELUM PERNAH MENGAMBIL GULA
                    |--------------------------------------------------------------------------
                    */

                    'tanggal_pengambilan' => null,

                    'discan_oleh' => null,
                ]);

                /*
                |--------------------------------------------------------------------------
                | BERHASIL
                |--------------------------------------------------------------------------
                */

                $this->berhasil++;

            } catch (\Throwable $e) {

                /*
                |--------------------------------------------------------------------------
                | JIKA TERJADI ERROR
                |--------------------------------------------------------------------------
                */

                $this->gagal++;

                $this->errorRows[] = [
                    'baris' => $barisExcel,
                    'nik'   => $nik ?? '-',
                    'nama'  => $nama ?? '-',
                    'alasan' => $e->getMessage(),
                ];
            }
        }
    }

    /**
     * =========================================================
     * MEMBERSIHKAN NILAI DARI EXCEL
     * =========================================================
     */
    private function cleanValue($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        return $value;
    }

    /**
     * =========================================================
     * NILAI NULLABLE
     * =========================================================
     */
    private function nullableValue($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}