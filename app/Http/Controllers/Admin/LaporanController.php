<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\LaporanGulaExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * =========================================================
     * HALAMAN LAPORAN
     * =========================================================
     */
    public function index(Request $request)
    {
        $laporan = $this->getLaporanQuery($request)->get();

        $statistik = $this->getStatistik($request);

        return view(
            'admin.laporan.index',
            compact('laporan', 'statistik')
        );
    }


    /**
     * =========================================================
     * EXPORT EXCEL
     * =========================================================
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(
            new LaporanGulaExport($request),
            'laporan-pengambilan-gula.xlsx'
        );
    }


    /**
     * =========================================================
     * EXPORT PDF
     * =========================================================
     */
    public function exportPdf(Request $request)
    {
        $laporan = $this->getLaporanQuery($request)->get();

        $statistik = $this->getStatistik($request);

        $pdf = Pdf::loadView(
            'admin.laporan.export.pdf',
            compact('laporan', 'statistik')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'laporan-pengambilan-gula.pdf'
        );
    }


    /**
     * =========================================================
     * PREVIEW PDF
     * =========================================================
     */
    public function previewPdf(Request $request)
    {
        $laporan = $this->getLaporanQuery($request)->get();

        $statistik = $this->getStatistik($request);

        return view(
            'admin.laporan.pdf',
            compact('laporan', 'statistik')
        );
    }


    /**
     * =========================================================
     * DOWNLOAD PDF
     * =========================================================
     */
    public function downloadPdf(Request $request)
    {
        $laporan = $this->getLaporanQuery($request)->get();

        $statistik = $this->getStatistik($request);

        $pdf = Pdf::loadView(
            'admin.laporan.pdf',
            compact('laporan', 'statistik')
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'laporan-pengambilan-gula.pdf'
        );
    }


    /**
     * =========================================================
     * QUERY LAPORAN
     * =========================================================
     *
     * Menampilkan data pengambilan gula sesuai filter tanggal.
     */
    private function getLaporanQuery(Request $request)
    {
        $query = DB::table('pengambilan_gula')
            ->join(
                'karyawan',
                'karyawan.id',
                '=',
                'pengambilan_gula.karyawan_id'
            )
            ->select(
                'karyawan.nik',
                'karyawan.nama',
                'karyawan.kategori',
                'karyawan.bagian',
                'pengambilan_gula.tanggal_ambil',
                'pengambilan_gula.jumlah_gula'
            );


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL AWAL
        |--------------------------------------------------------------------------
        */
        if ($request->filled('tanggal_awal')) {

            $query->whereDate(
                'pengambilan_gula.tanggal_ambil',
                '>=',
                $request->tanggal_awal
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL AKHIR
        |--------------------------------------------------------------------------
        */
        if ($request->filled('tanggal_akhir')) {

            $query->whereDate(
                'pengambilan_gula.tanggal_ambil',
                '<=',
                $request->tanggal_akhir
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        |
        | Karena tabel pengambilan_gula hanya berisi data yang sudah mengambil,
        | maka:
        |
        | sudah = tampilkan data pengambilan
        | belum = tidak ada data pengambilan
        |
        | Untuk sementara filter "belum" dikosongkan.
        |
        */
        if ($request->filled('status')) {

            if ($request->status === 'belum') {

                // Tidak ada data pengambilan
                $query->whereRaw('1 = 0');
            }
        }


        /*
        |--------------------------------------------------------------------------
        | URUTKAN BERDASARKAN NAMA
        |--------------------------------------------------------------------------
        */
        $query->orderBy(
            'karyawan.nama',
            'asc'
        );


        return $query;
    }


    /**
     * =========================================================
     * STATISTIK LAPORAN
     * =========================================================
     */
    private function getStatistik(Request $request = null)
    {
        /*
        |--------------------------------------------------------------------------
        | TOTAL SELURUH KARYAWAN
        |--------------------------------------------------------------------------
        */
        $totalKaryawan = DB::table('karyawan')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | QUERY PENGAMBILAN BERDASARKAN PERIODE
        |--------------------------------------------------------------------------
        */
        $pengambilanQuery = DB::table('pengambilan_gula');


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL AWAL
        |--------------------------------------------------------------------------
        */
        if ($request && $request->filled('tanggal_awal')) {

            $pengambilanQuery->whereDate(
                'tanggal_ambil',
                '>=',
                $request->tanggal_awal
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL AKHIR
        |--------------------------------------------------------------------------
        */
        if ($request && $request->filled('tanggal_akhir')) {

            $pengambilanQuery->whereDate(
                'tanggal_ambil',
                '<=',
                $request->tanggal_akhir
            );
        }


        /*
        |--------------------------------------------------------------------------
        | JUMLAH KARYAWAN YANG SUDAH MENGAMBIL
        |--------------------------------------------------------------------------
        |
        | DISTINCT agar satu karyawan tidak dihitung dua kali.
        |
        */
        $sudahAmbil = (clone $pengambilanQuery)
            ->distinct('karyawan_id')
            ->count('karyawan_id');


        /*
        |--------------------------------------------------------------------------
        | BELUM MENGAMBIL
        |--------------------------------------------------------------------------
        */
        $belumAmbil = max(
            0,
            $totalKaryawan - $sudahAmbil
        );


        /*
        |--------------------------------------------------------------------------
        | TOTAL GULA
        |--------------------------------------------------------------------------
        |
        | INI BAGIAN YANG DIPERBAIKI.
        |
        | Sekarang total gula mengikuti filter tanggal.
        |
        | Contoh:
        |
        | 01-07-2026 s/d 30-07-2026
        |
        | Maka hanya jumlah_gula pada periode tersebut yang dijumlahkan.
        |
        */
        $totalGula = (clone $pengambilanQuery)
            ->whereNotNull('jumlah_gula')
            ->sum('jumlah_gula');


        /*
        |--------------------------------------------------------------------------
        | PENSIUN
        |--------------------------------------------------------------------------
        */
        $pensiun = DB::table('karyawan')
            ->where('status', 'pensiun')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN STATISTIK
        |--------------------------------------------------------------------------
        */
        return [
            'totalKaryawan' => $totalKaryawan,

            'sudahAmbil' => $sudahAmbil,

            'belumAmbil' => $belumAmbil,

            'pensiun' => $pensiun,

            'totalGula' => $totalGula,
        ];
    }
}