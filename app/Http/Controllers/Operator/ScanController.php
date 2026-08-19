<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\AturanJatahGula;
use App\Models\Karyawan;
use App\Models\PengambilanGula;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    /**
     * =========================================================
     * JATAH GULA BERDASARKAN STATUS KARYAWAN (DINAMIS DARI DB)
     * =========================================================
     */
    private function tentukanJatahGula(?string $status): ?int
    {
        return AturanJatahGula::getJatahByStatus($status);
    }

    /**
     * =========================================================
     * NORMALISASI STATUS
     * =========================================================
     */
    private function normalisasiStatus(?string $status): string
    {
        return strtoupper(
            trim(
                preg_replace(
                    '/\s+/',
                    ' ',
                    (string) $status
                )
            )
        );
    }

    /**
     * =========================================================
     * HALAMAN SCANNER
     * =========================================================
     */
    public function index()
    {
        $riwayat = PengambilanGula::with('karyawan')
            ->latest('tanggal_ambil')
            ->take(10)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'nik' => $item->karyawan->nik ?? '-',

                    'nama' => $item->karyawan->nama ?? '-',

                    'status' => $item->karyawan->status ?? '-',

                    'tanggal_ambil' => $item->tanggal_ambil
                        ? Carbon::parse(
                            $item->tanggal_ambil
                        )->format('d-m-Y')
                        : '-',

                    'jumlah_gula' => $item->jumlah_gula ?? 0,
                ];
            });

        return view(
            'operator.scan',
            compact('riwayat')
        );
    }

    /**
     * =========================================================
     * PROSES SCAN QR / NIK
     * =========================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => [
                'required',
                'string',
            ],
        ]);

        $nik = trim($request->nik);

        /*
         * Cari karyawan aktif.
         */
        $karyawan = Karyawan::aktif()
            ->where('nik', $nik)
            ->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'status' => 'tidak_ditemukan',
                'message' => 'Karyawan dengan NIK tersebut tidak ditemukan.',
            ], 404);
        }

        /*
         * Normalisasi status.
         */
        $statusKaryawan = $this->normalisasiStatus(
            $karyawan->status
        );

        /*
         * Tentukan jatah berdasarkan STATUS (mengambil dari Database).
         */
        $jumlahGula = $this->tentukanJatahGula(
            $statusKaryawan
        );

        /*
         * Status belum mempunyai aturan jatah.
         */
        if ($jumlahGula === null) {
            return response()->json([
                'success' => false,

                'status' => 'status_tidak_valid',

                'message' => 'Status karyawan belum memiliki jatah gula pada sistem.',

                'status_karyawan' => $karyawan->status,

                'status_normalisasi' => $statusKaryawan,

                'nik' => $karyawan->nik,

                'nama' => $karyawan->nama,
            ], 422);
        }

        /*
         * Periode sekarang.
         */
        $sekarang = Carbon::now();

        $tahun = $sekarang->year;

        $bulan = $sekarang->month;

        $periode = $sekarang->format('Y-m');

        /*
         * Cari pengambilan pada bulan berjalan.
         */
        $pengambilan = PengambilanGula::where(
                'karyawan_id',
                $karyawan->id
            )
            ->whereYear(
                'tanggal_ambil',
                $tahun
            )
            ->whereMonth(
                'tanggal_ambil',
                $bulan
            )
            ->latest('tanggal_ambil')
            ->first();

        /*
         * Data karyawan.
         */
        $dataKaryawan = [
            'id' => $karyawan->id,

            'nik' => $karyawan->nik,

            'nama' => $karyawan->nama,

            'jabatan' => $karyawan->jabatan,

            'bagian' => $karyawan->bagian,

            'status' => $statusKaryawan,

            'kategori' => $karyawan->kategori,

            'keterangan' => $karyawan->keterangan,
        ];

        /*
         * Belum mengambil.
         */
        if (!$pengambilan) {
            return response()->json([
                'success' => true,

                'status' => 'belum',

                'message' => 'Karyawan belum mengambil gula bulan ini.',

                'karyawan' => $dataKaryawan,

                'periode' => $periode,

                'bulan' => $sekarang->translatedFormat('F Y'),

                'jumlah_gula' => $jumlahGula,

                'satuan' => 'KG',
            ]);
        }

        /*
         * Sudah mengambil.
         */
        return response()->json([
            'success' => true,

            'status' => 'sudah',

            'message' => 'Karyawan sudah mengambil gula bulan ini.',

            'karyawan' => $dataKaryawan,

            'periode' => $periode,

            'bulan' => $sekarang->translatedFormat('F Y'),

            'jumlah_gula' => $pengambilan->jumlah_gula ?? $jumlahGula,

            'satuan' => 'KG',

            'tanggal_ambil' => $pengambilan->tanggal_ambil
                ? Carbon::parse(
                    $pengambilan->tanggal_ambil
                )->format('d-m-Y')
                : null,
        ]);
    }

    /**
     * =========================================================
     * KONFIRMASI PENGAMBILAN
     * =========================================================
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'nik' => [
                'required',
                'string',
            ],

            'periode' => [
                'required',
                'date_format:Y-m',
            ],
        ]);

        $nik = trim($request->nik);

        $periode = trim($request->periode);

        /*
         * Cari karyawan aktif.
         */
        $karyawan = Karyawan::aktif()
            ->where('nik', $nik)
            ->first();

        if (!$karyawan) {
            return response()->json([
                'success' => false,

                'status' => 'tidak_ditemukan',

                'message' => 'Karyawan tidak ditemukan.',
            ], 404);
        }

        /*
         * Normalisasi status.
         */
        $statusKaryawan = $this->normalisasiStatus(
            $karyawan->status
        );

        /*
         * Tentukan jatah berdasarkan STATUS (mengambil dari Database).
         */
        $jumlahGula = $this->tentukanJatahGula(
            $statusKaryawan
        );

        if ($jumlahGula === null) {
            return response()->json([
                'success' => false,

                'status' => 'status_tidak_valid',

                'message' => 'Status karyawan belum memiliki jatah gula pada sistem.',

                'status_karyawan' => $karyawan->status,

                'status_normalisasi' => $statusKaryawan,

                'nik' => $karyawan->nik,

                'nama' => $karyawan->nama,
            ], 422);
        }

        /*
         * Pengambilan hanya boleh bulan berjalan.
         */
        $periodeSekarang = Carbon::now()->format('Y-m');

        if ($periode !== $periodeSekarang) {
            return response()->json([
                'success' => false,

                'status' => 'periode_tidak_valid',

                'message' => 'Pengambilan gula hanya dapat dilakukan untuk periode bulan berjalan.',

                'periode_diminta' => $periode,

                'periode_sekarang' => $periodeSekarang,
            ], 422);
        }

        /*
         * Pecah periode.
         */
        [$tahun, $bulan] = explode(
            '-',
            $periode
        );

        /*
         * Cek apakah sudah mengambil.
         */
        $sudahAmbil = PengambilanGula::where(
                'karyawan_id',
                $karyawan->id
            )
            ->whereYear(
                'tanggal_ambil',
                $tahun
            )
            ->whereMonth(
                'tanggal_ambil',
                $bulan
            )
            ->exists();

        if ($sudahAmbil) {
            return response()->json([
                'success' => false,

                'status' => 'sudah',

                'message' => 'Karyawan sudah mengambil gula pada periode tersebut.',
            ], 422);
        }

        /*
         * Simpan histori pengambilan.
         */
        $pengambilan = PengambilanGula::create([
            'karyawan_id' => $karyawan->id,

            'tanggal_ambil' => now()->toDateString(),

            'jumlah_gula' => $jumlahGula,
        ]);

        /*
         * Response berhasil.
         */
        return response()->json([
            'success' => true,

            'status' => 'berhasil',

            'message' => 'Pengambilan gula berhasil dikonfirmasi.',

            'karyawan' => [
                'id' => $karyawan->id,

                'nik' => $karyawan->nik,

                'nama' => $karyawan->nama,

                'jabatan' => $karyawan->jabatan,

                'bagian' => $karyawan->bagian,

                'status' => $statusKaryawan,

                'kategori' => $karyawan->kategori,
            ],

            'periode' => $periode,

            'jumlah_gula' => $jumlahGula,

            'satuan' => 'KG',

            'tanggal_ambil' => $pengambilan->tanggal_ambil
                ? Carbon::parse(
                    $pengambilan->tanggal_ambil
                )->format('d-m-Y')
                : now()->format('d-m-Y'),
        ]);
    }
}