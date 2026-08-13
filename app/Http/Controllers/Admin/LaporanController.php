<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\LaporanGulaExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik($request);

        return view('admin.laporan.index', compact('laporan', 'statistik'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new LaporanGulaExport($request),
            'laporan-pengambilan-gula.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik($request);

        $pdf = Pdf::loadView('admin.laporan.export.pdf', compact('laporan', 'statistik'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-pengambilan-gula.pdf');
    }

    public function previewPdf(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik($request);

        return view('admin.laporan.pdf', compact('laporan', 'statistik'));
    }

    public function downloadPdf(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik($request);

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan', 'statistik'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-pengambilan-gula.pdf');
    }

    /**
     * Build query laporan dengan filter
     */
    private function getLaporanQuery(Request $request)
    {
        $query = DB::table('pengambilan_gula')
            ->join('karyawan', 'karyawan.id', '=', 'pengambilan_gula.karyawan_id')
            ->select(
                'karyawan.nik',
                'karyawan.nama',
                'karyawan.kategori',
                'karyawan.bagian',
                'pengambilan_gula.tanggal_ambil',
                'pengambilan_gula.jumlah_gula'   // ← ditambahkan
            );

        // Filter tanggal awal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('pengambilan_gula.tanggal_ambil', '>=', $request->tanggal_awal);
        }

        // Filter tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('pengambilan_gula.tanggal_ambil', '<=', $request->tanggal_akhir);
        }

        // Filter status "sudah" / "belum" diganti jadi filter berdasarkan apakah ada data
        // Karena ini join ke pengambilan_gula, yang muncul di sini otomatis sudah ambil.
        // Kalau mau tampilkan yang belum ambil, harus pakai leftJoin + whereNull (lebih kompleks).

        return $query->orderBy('karyawan.nama', 'asc');
    }

    /**
     * Get data statistik (bisa difilter tanggal juga)
     */
    private function getStatistik(Request $request = null)
    {
        $totalKaryawan = DB::table('karyawan')->count();

        $sudahAmbilQuery = DB::table('pengambilan_gula')
            ->select('karyawan_id')
            ->distinct();

        if ($request && $request->filled('tanggal_awal')) {
            $sudahAmbilQuery->whereDate('tanggal_ambil', '>=', $request->tanggal_awal);
        }
        if ($request && $request->filled('tanggal_akhir')) {
            $sudahAmbilQuery->whereDate('tanggal_ambil', '<=', $request->tanggal_akhir);
        }

        $sudahAmbil = $sudahAmbilQuery->count();

        return [
            'totalKaryawan' => $totalKaryawan,
            'sudahAmbil'    => $sudahAmbil,
            'belumAmbil'    => $totalKaryawan - $sudahAmbil,
            'pensiun'       => DB::table('karyawan')->where('status', 'pensiun')->count(),
            'totalGula'     => DB::table('pengambilan_gula')->sum('jumlah_gula'), // bonus
        ];
    }
}