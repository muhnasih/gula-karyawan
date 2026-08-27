<?php

namespace App\Console\Commands;

use App\Models\Karyawan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetKaryawanPassword extends Command
{
    protected $signature = 'karyawan:set-password';

    protected $description = 'Mengatur password awal karyawan menggunakan NIK';

    public function handle()
    {
        $karyawan = Karyawan::all();

        if ($karyawan->isEmpty()) {
            $this->warn('Tidak ada data karyawan.');

            return Command::SUCCESS;
        }

        $jumlah = 0;

        foreach ($karyawan as $item) {

            if (empty($item->nik)) {
                continue;
            }

            $item->password = Hash::make(trim($item->nik));
            $item->save();

            $jumlah++;
        }

        $this->info(
            "Password awal berhasil dibuat untuk {$jumlah} karyawan."
        );

        $this->line('');
        $this->line('Password awal = NIK masing-masing karyawan.');

        return Command::SUCCESS;
    }
}