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
        // Format:
        // 2026-08
        // =========================================================

        $periode = $request->get(
            'periode',
            Carbon::now()->format('Y-m')
        );


        // Pisahkan tahun dan bulan
        try {

            $tanggalPeriode = Carbon::createFromFormat(
                'Y-m',
                $periode
            );

        } catch (\Exception $e) {

            $tanggalPeriode = Carbon::now();
            $periode = $tanggalPeriode->format('Y-m');

        }


        $tahun = $tanggalPeriode->year;
        $bulan = $tanggalPeriode->month;


        // =========================================================
        // TOTAL KARYAWAN
        // =========================================================
        // Hanya hitung karyawan aktif, karena hanya karyawan aktif
        // yang bisa melakukan pengambilan gula (lihat ScanController).
        // Jika ikut menghitung karyawan nonaktif, statistik
        // "belum mengambil" akan salah / terlalu besar.
        // =========================================================

        $totalKaryawan = Karyawan::aktif()->count();


        // =========================================================
        // QUERY PENGAMBILAN PADA BULAN TERPILIH
        // =========================================================

        $pengambilanQuery = PengambilanGula::whereYear(
            'tanggal_ambil',
            $tahun
        )
            ->whereMonth(
                'tanggal_ambil',
                $bulan
            );


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

        $belumAmbil = max(
            0,
            $totalKaryawan - $sudahAmbil
        );


        // =========================================================
        // TOTAL KILO PADA BULAN TERPILIH
        // =========================================================
        // Menggantikan kartu "Persentase" -> sekarang menampilkan
        // total kg gula yang sudah diambil pada periode terpilih.
        // =========================================================

        $totalKg = (clone $pengambilanQuery)->sum('jumlah_gula');


        // =========================================================
        // KARYAWAN YANG SUDAH MENGAMBIL (BULAN TERPILIH)
        // =========================================================

        $karyawanSudahAmbilIds = (clone $pengambilanQuery)
            ->pluck('karyawan_id')
            ->unique();


        // =========================================================
        // KARYAWAN YANG BELUM MENGAMBIL
        // =========================================================
        // Dibatasi hanya karyawan aktif, konsisten dengan
        // $totalKaryawan di atas.
        // =========================================================

        $karyawanBelumAmbil = Karyawan::aktif()
            ->whereNotIn(
                'id',
                $karyawanSudahAmbilIds
            )
            ->orderBy('nama')
            ->get();


        // =========================================================
        // DAFTAR "SUDAH MENGAMBIL" (FILTER RENTANG TANGGAL)
        // =========================================================
        // Tidak dibatasi ke periode/bulan yang dipilih di atas -
        // ini adalah daftar keseluruhan pengambilan yang bisa
        // difilter bebas dari tanggal berapa sampai tanggal berapa.
        // Kalau tanggal_awal / tanggal_akhir tidak diisi, seluruh
        // riwayat pengambilan akan ditampilkan.
        // =========================================================

        $tanggalAwal = $request->get('tanggal_awal');
        $tanggalAkhir = $request->get('tanggal_akhir');

        $daftarSudahAmbilQuery = PengambilanGula::with('karyawan')
            ->latest('tanggal_ambil')
            ->latest('id');

        if ($tanggalAwal) {
            $daftarSudahAmbilQuery->whereDate('tanggal_ambil', '>=', $tanggalAwal);
        }

        if ($tanggalAkhir) {
            $daftarSudahAmbilQuery->whereDate('tanggal_ambil', '<=', $tanggalAkhir);
        }

        $daftarSudahAmbil = (clone $daftarSudahAmbilQuery)->get();

        $totalGulaSudahAmbil = (clone $daftarSudahAmbilQuery)->sum('jumlah_gula');


        // =========================================================
        // STATISTIK
        // =========================================================

        $statistik = [

            'total_karyawan' => $totalKaryawan,

            'total_pengambilan' => $totalPengambilan,

            'sudah_ambil' => $sudahAmbil,

            'belum_ambil' => $belumAmbil,

            'total_kg' => $totalKg,

        ];


        // =========================================================
        // RETURN VIEW
        // =========================================================

        return view(
            'operator.statistik.index',
            compact(
                'periode',
                'tahun',
                'bulan',
                'statistik',
                'karyawanBelumAmbil',
                'daftarSudahAmbil',
                'totalGulaSudahAmbil',
                'tanggalAwal',
                'tanggalAkhir'
            )
        );
    }
}