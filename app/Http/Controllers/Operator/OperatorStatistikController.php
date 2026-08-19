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
     * Jumlah item per halaman untuk masing-masing daftar.
     * Diletakkan sebagai konstanta supaya mudah diubah dari satu tempat.
     */
    private const PER_PAGE_SUDAH_AMBIL = 15;
    private const PER_PAGE_BELUM_AMBIL = 15;

    /**
     * Halaman Statistik Operator
     */
    public function index(Request $request)
    {
        // =========================================================
        // VALIDASI INPUT FILTER
        // =========================================================
        $validated = $request->validate([
            'periode'       => 'nullable|date_format:Y-m',
            'tanggal_awal'  => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
            'search'        => 'nullable|string|max:100',
        ]);


        // =========================================================
        // PERIODE
        // =========================================================
        $periode = $validated['periode'] ?? Carbon::now()->format('Y-m');

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
        // KARYAWAN YANG BELUM MENGAMBIL (PAGINATED)
        // =========================================================
        $karyawanBelumAmbil = Karyawan::aktif()
            ->whereNotIn('id', $karyawanSudahAmbilIds)
            ->orderBy('nama')
            ->paginate(
                self::PER_PAGE_BELUM_AMBIL,
                ['*'],
                'page_belum' // nama parameter halaman khusus, agar tidak bentrok dgn paginator lain
            )
            ->withQueryString();


        // =========================================================
        // DAFTAR "SUDAH MENGAMBIL" + FILTER
        // =========================================================
        $tanggalAwal  = $validated['tanggal_awal'] ?? null;
        $tanggalAkhir = $validated['tanggal_akhir'] ?? null;
        $search       = $validated['search'] ?? null;

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

        // Total kg dihitung dari SELURUH hasil filter (bukan cuma 1 halaman),
        // jadi harus di-clone SEBELUM paginate() dipanggil.
        $totalGulaSudahAmbil = (clone $daftarSudahAmbilQuery)->sum('jumlah_gula');

        $daftarSudahAmbil = $daftarSudahAmbilQuery
            ->paginate(
                self::PER_PAGE_SUDAH_AMBIL,
                ['*'],
                'page_sudah' // nama parameter halaman khusus, agar tidak bentrok dgn paginator lain
            )
            ->withQueryString();


        // =========================================================
        // STATISTIK
        // =========================================================
        $statistik = [
            'total_karyawan' => $totalKaryawan,
            'sudah_ambil'    => $sudahAmbil,
            'belum_ambil'    => $belumAmbil,
            'total_kg'       => $totalKg,
        ];


        // =========================================================
        // RETURN VIEW
        // =========================================================
        return view('operator.statistik.index', compact(
            'periode',
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