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
     * Menampilkan SEMUA karyawan.
     *
     * Jika karyawan sudah mengambil pada periode yang dipilih:
     *     tanggal_ambil = tanggal pengambilan
     *     jumlah_gula   = jumlah gula
     *     status        = sudah
     *
     * Jika belum mengambil:
     *     tanggal_ambil = null
     *     jumlah_gula   = 0
     *     status        = belum
     */
    private function getLaporanQuery(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | SUBQUERY PENGAMBILAN
        |--------------------------------------------------------------------------
        |
        | Hanya mengambil data berdasarkan periode yang dipilih.
        |
        */
        $pengambilanQuery = DB::table('pengambilan_gula')
            ->select(
                'karyawan_id',
                'tanggal_ambil',
                'jumlah_gula'
            );


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL AWAL
        |--------------------------------------------------------------------------
        */
        if ($request->filled('tanggal_awal')) {

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
        if ($request->filled('tanggal_akhir')) {

            $pengambilanQuery->whereDate(
                'tanggal_ambil',
                '<=',
                $request->tanggal_akhir
            );
        }


        /*
        |--------------------------------------------------------------------------
        | QUERY UTAMA
        |--------------------------------------------------------------------------
        |
        | LEFT JOIN digunakan supaya karyawan yang belum mengambil
        | tetap muncul.
        |
        */
        $query = DB::table('karyawan')
            ->leftJoinSub(
                $pengambilanQuery,
                'pengambilan',
                function ($join) {
                    $join->on(
                        'karyawan.id',
                        '=',
                        'pengambilan.karyawan_id'
                    );
                }
            )
            ->select(
                'karyawan.id',
                'karyawan.nik',
                'karyawan.nama',
                'karyawan.kategori',
                'karyawan.bagian',
                'pengambilan.tanggal_ambil',

                /*
                |--------------------------------------------------------------------------
                | JUMLAH GULA
                |--------------------------------------------------------------------------
                |
                | Kalau belum mengambil -> 0 KG
                |
                */
                DB::raw(
                    'COALESCE(pengambilan.jumlah_gula, 0) as jumlah_gula'
                ),

                /*
                |--------------------------------------------------------------------------
                | STATUS PENGAMBILAN
                |--------------------------------------------------------------------------
                */
                DB::raw(
                    "CASE
                        WHEN pengambilan.karyawan_id IS NOT NULL
                        THEN 'sudah'
                        ELSE 'belum'
                    END as status_pengambilan"
                )
            );


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {

            if ($request->status === 'sudah') {

                /*
                | Hanya yang sudah mengambil
                */
                $query->whereNotNull(
                    'pengambilan.karyawan_id'
                );
            }

            elseif ($request->status === 'belum') {

                /*
                | Hanya yang belum mengambil
                */
                $query->whereNull(
                    'pengambilan.karyawan_id'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | URUTKAN
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
        | QUERY PENGAMBILAN
        |--------------------------------------------------------------------------
        |
        | Query ini hanya mengambil data pada periode yang dipilih.
        |
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
        | SUDAH MENGAMBIL
        |--------------------------------------------------------------------------
        */
        $sudahAmbil = (clone $pengambilanQuery)
            ->distinct()
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
        | Hanya menjumlahkan gula yang benar-benar diambil
        | pada periode yang dipilih.
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
        | RETURN
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