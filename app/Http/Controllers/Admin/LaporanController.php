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
        | DATA TABEL — DIPAGINASI (15 per halaman)
        |--------------------------------------------------------------------------
        |
        | withQueryString() supaya filter (tanggal, status, search)
        | tetap terbawa saat pindah halaman.
        |
        | Daftar "belum mengambil" TIDAK lagi diambil terpisah di sini.
        | Kalau user ingin melihat seluruh karyawan yang belum mengambil,
        | cukup gunakan filter Status = "Belum Mengambil" pada form filter
        | di atas tabel — hasilnya tetap dipaginasi dan konsisten dengan
        | tabel utama.
        |
        */
        $laporan = $this->getLaporanQuery($request)
            ->paginate(15)
            ->withQueryString();

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

        return $pdf->download('laporan-pengambilan-gula.pdf');
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

        return $pdf->download('laporan-pengambilan-gula.pdf');
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
        */
        $pengambilanQuery = DB::table('pengambilan_gula')
            ->select(
                'karyawan_id',
                'tanggal_ambil',
                'jumlah_gula'
            );

        // Filter tanggal awal
        if ($request->filled('tanggal_awal')) {
            $pengambilanQuery->whereDate(
                'tanggal_ambil',
                '>=',
                $request->tanggal_awal
            );
        }

        // Filter tanggal akhir
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
                DB::raw('COALESCE(pengambilan.jumlah_gula, 0) as jumlah_gula'),
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
        | FILTER PENCARIAN (Nama / NIK)
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('karyawan.nama', 'like', "%{$search}%")
                  ->orWhere('karyawan.nik', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            if ($request->status === 'sudah') {
                $query->whereNotNull('pengambilan.karyawan_id');
            } elseif ($request->status === 'belum') {
                $query->whereNull('pengambilan.karyawan_id');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | URUTKAN
        |--------------------------------------------------------------------------
        */
        $query->orderBy('karyawan.nama', 'asc');

        return $query;
    }


    /**
     * =========================================================
     * STATISTIK LAPORAN
     * =========================================================
     *
     * Statistik tetap berbasis periode (tanggal) saja.
     * Search tidak mempengaruhi angka di kartu statistik.
     */
    private function getStatistik(Request $request = null)
    {
        // Total seluruh karyawan
        $totalKaryawan = DB::table('karyawan')->count();

        // Query pengambilan (hanya filter tanggal)
        $pengambilanQuery = DB::table('pengambilan_gula');

        if ($request && $request->filled('tanggal_awal')) {
            $pengambilanQuery->whereDate(
                'tanggal_ambil',
                '>=',
                $request->tanggal_awal
            );
        }

        if ($request && $request->filled('tanggal_akhir')) {
            $pengambilanQuery->whereDate(
                'tanggal_ambil',
                '<=',
                $request->tanggal_akhir
            );
        }

        // Sudah mengambil
        $sudahAmbil = (clone $pengambilanQuery)
            ->distinct()
            ->count('karyawan_id');

        // Belum mengambil
        $belumAmbil = max(0, $totalKaryawan - $sudahAmbil);

        // Total gula
        $totalGula = (clone $pengambilanQuery)
            ->whereNotNull('jumlah_gula')
            ->sum('jumlah_gula');

        // Pensiun (opsional, kalau masih dipakai)
        $pensiun = DB::table('karyawan')
            ->where('status', 'pensiun')
            ->count();

        return [
            'totalKaryawan' => $totalKaryawan,
            'sudahAmbil'    => $sudahAmbil,
            'belumAmbil'    => $belumAmbil,
            'pensiun'       => $pensiun,
            'totalGula'     => $totalGula,
        ];
    }
}