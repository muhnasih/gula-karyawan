<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PengambilanGula;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OperatorStatistikController extends Controller
{
    /**
     * Halaman Statistik Operator
     */
    public function index(Request $request)
    {
        // =========================================================
        // PERIODE
        // =========================================================
        $periode = $request->get(
            'periode',
            Carbon::now()->format('Y-m')
        );

        try {
            $tanggalPeriode = Carbon::createFromFormat('Y-m', $periode);
        } catch (\Exception $e) {
            $tanggalPeriode = Carbon::now();
            $periode = $tanggalPeriode->format('Y-m');
        }

        $tahun = $tanggalPeriode->year;
        $bulan = $tanggalPeriode->month;


        // =========================================================
        // TOTAL KARYAWAN (hanya aktif)
        // =========================================================
        $totalKaryawan = Karyawan::aktif()->count();


        // =========================================================
        // QUERY PENGAMBILAN PADA BULAN TERPILIH
        // =========================================================
        $pengambilanQuery = PengambilanGula::whereYear('tanggal_ambil', $tahun)
            ->whereMonth('tanggal_ambil', $bulan);


        // =========================================================
        // TOTAL PENGAMBILAN
        // =========================================================
        $totalPengambilan = (clone $pengambilanQuery)->count();


        // =========================================================
        // TOTAL KARYAWAN YANG SUDAH MENGAMBIL
        // =========================================================
        $sudahAmbil = (clone $pengambilanQuery)
            ->distinct('karyawan_id')
            ->count('karyawan_id');


        // =========================================================
        // TOTAL KARYAWAN YANG BELUM MENGAMBIL
        // =========================================================
        $belumAmbil = max(0, $totalKaryawan - $sudahAmbil);


        // =========================================================
        // TOTAL KILO PADA BULAN TERPILIH
        // =========================================================
        $totalKg = (clone $pengambilanQuery)->sum('jumlah_gula');


        // =========================================================
        // KARYAWAN YANG SUDAH MENGAMBIL (ID)
        // =========================================================
        $karyawanSudahAmbilIds = (clone $pengambilanQuery)
            ->pluck('karyawan_id')
            ->unique();


        // =========================================================
        // KARYAWAN YANG BELUM MENGAMBIL
        // =========================================================
        $karyawanBelumAmbil = Karyawan::aktif()
            ->whereNotIn('id', $karyawanSudahAmbilIds)
            ->orderBy('nama')
            ->get();


        // =========================================================
        // DAFTAR "SUDAH MENGAMBIL" + FILTER
        // =========================================================
        $tanggalAwal  = $request->get('tanggal_awal');
        $tanggalAkhir = $request->get('tanggal_akhir');
        $search       = $request->get('search');

        $daftarSudahAmbilQuery = PengambilanGula::with('karyawan')
            ->latest('tanggal_ambil')
            ->latest('id');

        // Filter tanggal
        if ($tanggalAwal) {
            $daftarSudahAmbilQuery->whereDate('tanggal_ambil', '>=', $tanggalAwal);
        }

        if ($tanggalAkhir) {
            $daftarSudahAmbilQuery->whereDate('tanggal_ambil', '<=', $tanggalAkhir);
        }

        // Default ke periode bulan jika tidak ada filter tanggal
        if (!$tanggalAwal && !$tanggalAkhir) {
            $daftarSudahAmbilQuery
                ->whereYear('tanggal_ambil', $tahun)
                ->whereMonth('tanggal_ambil', $bulan);
        }

        // Filter pencarian (nama atau NIK)
        if ($search) {
            $daftarSudahAmbilQuery->whereHas('karyawan', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%');
            });
        }

        $daftarSudahAmbil     = (clone $daftarSudahAmbilQuery)->get();
        $totalGulaSudahAmbil  = (clone $daftarSudahAmbilQuery)->sum('jumlah_gula');


        // =========================================================
        // STATISTIK
        // =========================================================
        $statistik = [
            'total_karyawan'    => $totalKaryawan,
            'total_pengambilan' => $totalPengambilan,
            'sudah_ambil'       => $sudahAmbil,
            'belum_ambil'       => $belumAmbil,
            'total_kg'          => $totalKg,
        ];


        // =========================================================
        // RETURN VIEW
        // =========================================================
        return view('operator.statistik.index', compact(
            'periode',
            'tahun',
            'bulan',
            'statistik',
            'karyawanBelumAmbil',
            'daftarSudahAmbil',
            'totalGulaSudahAmbil',
            'tanggalAwal',
            'tanggalAkhir'
            // 'search' tidak perlu di-compact karena sudah diambil via request() di view
        ));
    }
}