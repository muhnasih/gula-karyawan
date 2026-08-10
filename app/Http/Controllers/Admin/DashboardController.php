<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();

        $tetap    = Karyawan::where('kategori', 'Tetap')->count();
        $kampPkwt = Karyawan::where('kategori', 'KAMP-PKWT')->count();
        $os       = Karyawan::where('kategori', 'OS')->count();

        $pensiun = Karyawan::pensiun()->count();

        // TODO: ganti dengan query relasi tabel pengambilan gula saat sudah dibuat
        $sudahAmbil = 0;
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