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
        | Riwayat pengambilan bulan berjalan
        |--------------------------------------------------------------------------
        | Hanya menampilkan riwayat pada bulan & tahun saat ini.
        | Data bulan sebelumnya TIDAK dihapus dari database, hanya tidak
        | ditampilkan di dashboard operator supaya riwayat tidak menumpuk.
        | Begitu masuk bulan baru, daftar ini otomatis "kosong lagi".
        */

        $riwayat = PengambilanGula::with('karyawan')
            ->whereYear('tanggal_ambil', $tahun)
            ->whereMonth('tanggal_ambil', $bulan)
            ->latest('tanggal_ambil')
            ->get()
            ->map(function ($item) {
                return (object) [
                    'nik' => $item->karyawan->nik ?? '-',
                    'nama' => $item->karyawan->nama ?? '-',
                    'status' => $item->karyawan->status ?? '-',
                    'tanggal_ambil' => $item->tanggal_ambil
                        ? Carbon::parse($item->tanggal_ambil)->format('d-m-Y')
                        : '-',
                    'jumlah_gula' => $item->jumlah_gula ?? 0,
                ];
            });

        // Label periode untuk ditampilkan di view, contoh: "September 2026"
        $periodeRiwayat = Carbon::now()->translatedFormat('F Y');

        return view('operator.dashboard', compact(
            'totalKaryawan',
            'sudahAmbil',
            'belumAmbil',
            'riwayat',
            'periodeRiwayat'
        ));
    }
}