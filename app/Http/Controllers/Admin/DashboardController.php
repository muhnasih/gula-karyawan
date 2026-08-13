<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PengambilanGula; // pastikan model ini sudah ada
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();

        $tetap    = Karyawan::where('kategori', 'Tetap')->count();
        $kampPkwt = Karyawan::where('kategori', 'KAMP-PKWT')->count();
        $os       = Karyawan::where('kategori', 'OS')->count();

        $pensiun = Karyawan::pensiun()->count();

        // Hitung karyawan yang sudah ambil gula hari ini
        $hariIni = Carbon::today();

        $sudahAmbil = PengambilanGula::whereDate('tanggal_ambil', $hariIni)
            ->distinct('karyawan_id')
            ->count('karyawan_id');

        $belumAmbil = $totalKaryawan - $sudahAmbil;

        // TODO: ganti dengan Activity::latest()->take(5)->get() saat tabel log sudah dibuat
        $aktivitas = collect();

        return view('admin.dashboard', compact(
            'totalKaryawan',
            'tetap',
            'kampPkwt',
            'os',
            'pensiun',
            'sudahAmbil',
            'belumAmbil',
            'aktivitas'
        ));
    }
}