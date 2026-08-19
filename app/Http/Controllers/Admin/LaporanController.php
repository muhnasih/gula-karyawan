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
        /*
        |--------------------------------------------------------------------------
        | PERIODE AKTIF (BULAN & TAHUN)
        |--------------------------------------------------------------------------
        |
        | Default ke bulan & tahun berjalan kalau belum ada di query string,
        | supaya saat pertama kali buka halaman langsung tampil bulan ini.
        |
        */

        $bulanAktif = (int) $request->input('bulan', now()->month);
        $tahunAktif = (int) $request->input('tahun', now()->year);

        /*
        |--------------------------------------------------------------------------
        | DATA LAPORAN
        |--------------------------------------------------------------------------
        |
        | Data tabel dipaginasi 15 data per halaman.
        | Filter tetap dibawa ketika berpindah halaman.
        |
        */

        $laporan = $this->getLaporanQuery($request, $bulanAktif, $tahunAktif)
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $statistik = $this->getStatistik($bulanAktif, $tahunAktif);

        return view(
            'admin.laporan.index',
            compact(
                'laporan',
                'statistik',
                'bulanAktif',
                'tahunAktif'
            )
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
        $bulanAktif = (int) $request->input('bulan', now()->month);
        $tahunAktif = (int) $request->input('tahun', now()->year);

        $laporan = $this->getLaporanQuery($request, $bulanAktif, $tahunAktif)->get();

        $statistik = $this->getStatistik($bulanAktif, $tahunAktif);

        $pdf = Pdf::loadView(
            'admin.laporan.export.pdf',
            compact(
                'laporan',
                'statistik',
                'bulanAktif',
                'tahunAktif'
            )
        );

        $pdf->setPaper(
            'A4',
            'landscape'
        );

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
        $bulanAktif = (int) $request->input('bulan', now()->month);
        $tahunAktif = (int) $request->input('tahun', now()->year);

        $laporan = $this->getLaporanQuery($request, $bulanAktif, $tahunAktif)->get();

        $statistik = $this->getStatistik($bulanAktif, $tahunAktif);

        return view(
            'admin.laporan.pdf',
            compact(
                'laporan',
                'statistik',
                'bulanAktif',
                'tahunAktif'
            )
        );
    }


    /**
     * =========================================================
     * DOWNLOAD PDF
     * =========================================================
     */
    public function downloadPdf(Request $request)
    {
        $bulanAktif = (int) $request->input('bulan', now()->month);
        $tahunAktif = (int) $request->input('tahun', now()->year);

        $laporan = $this->getLaporanQuery($request, $bulanAktif, $tahunAktif)->get();

        $statistik = $this->getStatistik($bulanAktif, $tahunAktif);

        $pdf = Pdf::loadView(
            'admin.laporan.pdf',
            compact(
                'laporan',
                'statistik',
                'bulanAktif',
                'tahunAktif'
            )
        );

        $pdf->setPaper(
            'A4',
            'landscape'
        );

        return $pdf->download(
            'laporan-pengambilan-gula.pdf'
        );
    }


    /**
     * =========================================================
     * QUERY LAPORAN
     * =========================================================
     *
     * Semua karyawan ditampilkan untuk periode (bulan & tahun) tertentu.
     *
     * SUDAH MENGAMBIL (pada bulan tsb):
     * - tanggal_ambil terisi & berada di bulan/tahun aktif
     * - jumlah_gula terisi
     * - status = sudah
     *
     * BELUM MENGAMBIL (pada bulan tsb):
     * - tidak ada baris pengambilan di bulan/tahun aktif
     *   (meskipun karyawan pernah mengambil di bulan lain)
     * - jumlah_gula = 0
     * - status = belum
     *
     */
    private function getLaporanQuery(Request $request, int $bulanAktif, int $tahunAktif)
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY PENGAMBILAN — DIBATASI KE BULAN & TAHUN AKTIF
        |--------------------------------------------------------------------------
        */

        $pengambilanQuery = DB::table('pengambilan_gula')
            ->select(
                'karyawan_id',
                'tanggal_ambil',
                'jumlah_gula'
            )
            ->whereYear('tanggal_ambil', $tahunAktif)
            ->whereMonth('tanggal_ambil', $bulanAktif);


        /*
        |--------------------------------------------------------------------------
        | QUERY UTAMA
        |--------------------------------------------------------------------------
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

                DB::raw(
                    'COALESCE(
                        pengambilan.jumlah_gula,
                        0
                    ) as jumlah_gula'
                ),

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
        | SEARCH NAMA / NIK
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->search
            );

            $query->where(function ($q) use ($search) {

                $q->where(
                    'karyawan.nama',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'karyawan.nik',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            if ($request->status === 'sudah') {

                $query->whereNotNull(
                    'pengambilan.karyawan_id'
                );

            }

            elseif ($request->status === 'belum') {

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
     *
     * Statistik berdasarkan periode bulan & tahun aktif.
     *
     * Search tidak memengaruhi statistik (sama seperti sebelumnya).
     *
     */
    private function getStatistik(int $bulanAktif, int $tahunAktif)
    {
        /*
        |--------------------------------------------------------------------------
        | TOTAL KARYAWAN
        |--------------------------------------------------------------------------
        */

        $totalKaryawan = DB::table(
            'karyawan'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | QUERY PENGAMBILAN — DIBATASI KE BULAN & TAHUN AKTIF
        |--------------------------------------------------------------------------
        */

        $pengambilanQuery = DB::table('pengambilan_gula')
            ->whereYear('tanggal_ambil', $tahunAktif)
            ->whereMonth('tanggal_ambil', $bulanAktif);


        /*
        |--------------------------------------------------------------------------
        | SUDAH MENGAMBIL (BULAN INI)
        |--------------------------------------------------------------------------
        */

        $sudahAmbil = (clone $pengambilanQuery)
            ->whereNotNull('karyawan_id')
            ->distinct()
            ->count('karyawan_id');


        /*
        |--------------------------------------------------------------------------
        | BELUM MENGAMBIL (BULAN INI)
        |--------------------------------------------------------------------------
        */

        $belumAmbil = max(
            0,
            $totalKaryawan - $sudahAmbil
        );


        /*
        |--------------------------------------------------------------------------
        | TOTAL GULA (BULAN INI)
        |--------------------------------------------------------------------------
        */

        $totalGula = (clone $pengambilanQuery)
            ->whereNotNull('jumlah_gula')
            ->sum('jumlah_gula');


        /*
        |--------------------------------------------------------------------------
        | PENSIUN
        |--------------------------------------------------------------------------
        |
        | Tetap disediakan jika masih digunakan
        | oleh dashboard atau halaman lain.
        | (Tidak terikat periode bulan.)
        |
        */

        $pensiun = DB::table('karyawan')
            ->where(
                'status',
                'pensiun'
            )
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