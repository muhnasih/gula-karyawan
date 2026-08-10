<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PengambilanGula;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = Carbon::now()->year;
        $bulan = Carbon::now()->month;

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalKaryawan = Karyawan::aktif()->count();

        $sudahAmbil = PengambilanGula::whereYear('tanggal_ambil', $tahun)
            ->whereMonth('tanggal_ambil', $bulan)
            ->count();

        $belumAmbil = $totalKaryawan - $sudahAmbil;

        /*
        |--------------------------------------------------------------------------
        | Riwayat pengambilan terbaru
        |--------------------------------------------------------------------------
        */

        $riwayat = PengambilanGula::with('karyawan')
            ->latest('tanggal_ambil')
            ->take(10)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'nik'  => $item->karyawan->nik ?? '-',
                    'nama' => $item->karyawan->nama ?? '-',
                ];
            });

        return view('operator.dashboard', compact(
            'totalKaryawan',
            'sudahAmbil',
            'belumAmbil',
            'riwayat'
        ));
    }
}