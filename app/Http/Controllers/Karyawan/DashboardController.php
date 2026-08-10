<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\PengambilanGula;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Karyawan yang sedang login
        $karyawan = Auth::guard('karyawan')->user();

        // Tahun yang sedang berjalan
        $tahun = Carbon::now()->year;

        /*
        |--------------------------------------------------------------------------
        | Ambil semua riwayat pengambilan karyawan tahun ini
        |--------------------------------------------------------------------------
        */

        $pengambilan = PengambilanGula::where(
            'karyawan_id',
            $karyawan->id
        )
        ->whereYear('tanggal_ambil', $tahun)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Buat daftar 12 bulan
        |--------------------------------------------------------------------------
        */

        $bulan = collect();


        for ($i = 1; $i <= 12; $i++) {

            $periode = Carbon::create(
                $tahun,
                $i,
                1
            );


            /*
            |--------------------------------------------------------------------------
            | Cari apakah bulan tersebut sudah diambil
            |--------------------------------------------------------------------------
            */

            $dataPengambilan = $pengambilan->first(function ($item) use ($i) {

                return Carbon::parse($item->tanggal_ambil)
                    ->month == $i;

            });


            $sudahDiambil = $dataPengambilan !== null;


            /*
            |--------------------------------------------------------------------------
            | QR CODE
            |--------------------------------------------------------------------------
            |
            | QR hanya berisi NIK.
            |
            | Contoh:
            |
            | 12345678
            |
            */

            $barcode = $karyawan->nik;


            /*
            |--------------------------------------------------------------------------
            | Masukkan data bulan
            |--------------------------------------------------------------------------
            */

            $bulan->push([

                'periode' => $periode,

                'sudah_diambil' => $sudahDiambil,

                'tanggal_ambil' => $dataPengambilan?->tanggal_ambil,

                'barcode' => $barcode,

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Kirim ke halaman dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'karyawan.index',
            compact(
                'karyawan',
                'bulan'
            )
        );
    }
}
