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
        // PERSENTASE SUDAH MENGAMBIL
        // =========================================================

        $persentaseSudah = $totalKaryawan > 0
            ? round(
                ($sudahAmbil / $totalKaryawan) * 100,
                2
            )
            : 0;


        // =========================================================
        // PERSENTASE BELUM MENGAMBIL
        // =========================================================

        $persentaseBelum = $totalKaryawan > 0
            ? round(
                ($belumAmbil / $totalKaryawan) * 100,
                2
            )
            : 0;


        // =========================================================
        // PENGAMBILAN PER HARI
        // =========================================================

        $pengambilanHarian = (clone $pengambilanQuery)
            ->selectRaw(
                'tanggal_ambil, COUNT(*) as total'
            )
            ->groupBy('tanggal_ambil')
            ->orderBy('tanggal_ambil')
            ->get();


        // =========================================================
        // DATA GRAFIK
        // =========================================================

        $chartLabels = $pengambilanHarian
            ->map(function ($item) {

                return Carbon::parse(
                    $item->tanggal_ambil
                )->format('d M');

            })
            ->values();


        $chartData = $pengambilanHarian
            ->pluck('total')
            ->values();


        // =========================================================
        // PENGAMBILAN PER BAGIAN
        // =========================================================

        $perBagian = (clone $pengambilanQuery)
            ->with('karyawan')
            ->get()
            ->filter(function ($item) {

                return $item->karyawan !== null;

            })
            ->groupBy(function ($item) {

                return $item->karyawan->bagian
                    ?: 'Tidak Ada Bagian';

            })
            ->map(function ($items, $bagian) {

                return [
                    'bagian' => $bagian,
                    'total' => $items->count(),
                ];

            })
            ->values();


        // =========================================================
        // PENGAMBILAN PER STATUS KARYAWAN
        // =========================================================
        // Sebelumnya dikelompokkan berdasarkan 'kategori' (Tetap/OS/
        // KAMP-PKWT), padahal jatah gula sebenarnya ditentukan oleh
        // kolom 'status' (KARPIM/KARPEL). Diganti supaya laporan ini
        // mencerminkan pengelompokan yang benar-benar dipakai untuk
        // menentukan jumlah jatah gula.
        // =========================================================

        $perStatus = (clone $pengambilanQuery)
            ->with('karyawan')
            ->get()
            ->filter(function ($item) {

                return $item->karyawan !== null;

            })
            ->groupBy(function ($item) {

                return $item->karyawan->status
                    ?: 'Tidak Ada Status';

            })
            ->map(function ($items, $status) {

                return [
                    'status' => $status,
                    'total' => $items->count(),
                ];

            })
            ->values();


        // =========================================================
        // 10 PENGAMBILAN TERBARU
        // =========================================================

        $pengambilanTerbaru = (clone $pengambilanQuery)
            ->with('karyawan')
            ->latest('tanggal_ambil')
            ->latest('id')
            ->take(10)
            ->get();


        // =========================================================
        // KARYAWAN YANG SUDAH MENGAMBIL
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
        // STATISTIK
        // =========================================================

        $statistik = [

            'total_karyawan' => $totalKaryawan,

            'total_pengambilan' => $totalPengambilan,

            'sudah_ambil' => $sudahAmbil,

            'belum_ambil' => $belumAmbil,

            'persentase_sudah' => $persentaseSudah,

            'persentase_belum' => $persentaseBelum,

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
                'pengambilanHarian',
                'chartLabels',
                'chartData',
                'perBagian',
                'perStatus',
                'pengambilanTerbaru',
                'karyawanBelumAmbil'
            )
        );
    }
}