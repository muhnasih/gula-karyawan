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
     * Menampilkan halaman laporan
     */
    public function index(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik();

        return view('admin.laporan.index', compact('laporan', 'statistik'));
    }

    /**
     * Export ke Excel
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(
            new LaporanGulaExport($request),
            'laporan-pengambilan-gula.xlsx'
        );
    }

    /**
     * Export ke PDF (versi lama, tetap dipertahankan jika masih dipakai di tempat lain)
     */
    public function exportPdf(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik();

        $pdf = Pdf::loadView('admin.laporan.export.pdf', compact('laporan', 'statistik'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-pengambilan-gula.pdf');
    }

    /**
     * Preview PDF — hanya menampilkan halaman HTML di browser,
     * TIDAK membuat file PDF dan TIDAK melakukan download.
     */
    public function previewPdf(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik();

        return view('admin.laporan.pdf', compact('laporan', 'statistik'));
    }

    /**
     * Download PDF — membuat file PDF asli dari view yang sama
     * dengan preview, lalu langsung didownload.
     */
    public function downloadPdf(Request $request)
    {
        $laporan   = $this->getLaporanQuery($request)->get();
        $statistik = $this->getStatistik();

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
                'pengambilan_gula.tanggal_ambil'
            );

        // Filter tanggal awal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('pengambilan_gula.tanggal_ambil', '>=', $request->tanggal_awal);
        }

        // Filter tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('pengambilan_gula.tanggal_ambil', '<=', $request->tanggal_akhir);
        }

        // Filter status
        if ($request->status === 'sudah') {
            $query->whereNotNull('pengambilan_gula.tanggal_ambil');
        } elseif ($request->status === 'belum') {
            $query->whereNull('pengambilan_gula.tanggal_ambil');
        }

        return $query->orderBy('karyawan.nama', 'asc');
    }

    /**
     * Get data statistik
     */
    private function getStatistik()
    {
        $totalKaryawan = DB::table('karyawan')->count();
        $sudahAmbil    = DB::table('pengambilan_gula')->whereNotNull('tanggal_ambil')->count();

        return [
            'totalKaryawan' => $totalKaryawan,
            'sudahAmbil'    => $sudahAmbil,
            'belumAmbil'    => $totalKaryawan - $sudahAmbil,
            'pensiun'       => DB::table('karyawan')->where('status', 'pensiun')->count(),
        ];
    }
}