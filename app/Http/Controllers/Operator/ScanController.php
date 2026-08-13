<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PengambilanGula;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | JATAH GULA BERDASARKAN STATUS KARYAWAN
    |--------------------------------------------------------------------------
    |
    | KARPIM      = 10 KG
    | KARPEL      = 5 KG
    | KAMPANYE    = ? KG   <-- ISI SESUAI KETENTUAN
    | PKWT        = ? KG   <-- ISI SESUAI KETENTUAN
    | HONORER     = ? KG   <-- ISI SESUAI KETENTUAN
    | OS LMG-DMG  = ? KG   <-- ISI SESUAI KETENTUAN
    | OS DMG      = ? KG   <-- ISI SESUAI KETENTUAN
    |
    */

    private function tentukanJatahGula(?string $status): ?int
    {
        // Normalisasi status:
        // - jika null menjadi string kosong
        // - hapus spasi awal/akhir
        // - ubah menjadi huruf besar
        $status = strtoupper(trim((string) $status));

        return match ($status) {
            'KARPIM' => 10,
            'KARPEL' => 5,

            // TODO: lengkapi jatah untuk status berikut jika memang berhak
            // 'KAMPANYE' => ...,
            // 'PKWT' => ...,
            // 'HONORER' => ...,
            // 'OS LMG-DMG' => ...,
            // 'OS DMG' => ...,

            // Status lain belum memiliki jatah
            default => null,
        };
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALISASI STATUS
    |--------------------------------------------------------------------------
    */

    private function normalisasiStatus(?string $status): string
    {
        return strtoupper(
            trim(
                preg_replace('/\s+/', ' ', (string) $status)
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN SCANNER
    |--------------------------------------------------------------------------
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
                        ? Carbon::parse($item->tanggal_ambil)->format('d-m-Y')
                        : '-',
                    'jumlah_gula' => $item->jumlah_gula ?? 0,
                ];
            });

        return view(
            'operator.scan',
            compact('riwayat')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES HASIL SCAN QR
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI NIK
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'nik' => [
                'required',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL NIK
        |--------------------------------------------------------------------------
        */

        $nik = trim($request->nik);


        /*
        |--------------------------------------------------------------------------
        | CARI KARYAWAN AKTIF
        |--------------------------------------------------------------------------
        */

        $karyawan = Karyawan::aktif()
            ->where('nik', $nik)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | KARYAWAN TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'status' => 'tidak_ditemukan',
                'message' => 'Karyawan dengan NIK tersebut tidak ditemukan.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI STATUS
        |--------------------------------------------------------------------------
        */

        $statusKaryawan = $this->normalisasiStatus(
            $karyawan->status
        );


        /*
        |--------------------------------------------------------------------------
        | TENTUKAN JATAH GULA
        |--------------------------------------------------------------------------
        */

        $jumlahGula = $this->tentukanJatahGula(
            $statusKaryawan
        );


        /*
        |--------------------------------------------------------------------------
        | STATUS TIDAK MEMILIKI JATAH
        |--------------------------------------------------------------------------
        */

        if ($jumlahGula === null) {
            return response()->json([
                'success' => false,
                'status' => 'status_tidak_valid',

                'message' =>
                    'Status karyawan belum memiliki jatah gula.',

                'status_karyawan' => $karyawan->status,

                'status_normalisasi' => $statusKaryawan,

                'nik' => $karyawan->nik,

                'nama' => $karyawan->nama,
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | PERIODE BULAN SEKARANG
        |--------------------------------------------------------------------------
        */

        $sekarang = Carbon::now();

        $tahun = $sekarang->year;

        $bulan = $sekarang->month;

        $periode = $sekarang->format('Y-m');


        /*
        |--------------------------------------------------------------------------
        | CEK PENGAMBILAN BULAN INI
        |--------------------------------------------------------------------------
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
        |--------------------------------------------------------------------------
        | DATA KARYAWAN
        |--------------------------------------------------------------------------
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
        |--------------------------------------------------------------------------
        | BELUM MENGAMBIL
        |--------------------------------------------------------------------------
        */

        if (!$pengambilan) {
            return response()->json([
                'success' => true,

                'status' => 'belum',

                'message' =>
                    'Karyawan belum mengambil gula bulan ini.',

                'karyawan' => $dataKaryawan,

                'periode' => $periode,

                'bulan' => $sekarang->translatedFormat('F Y'),

                'jumlah_gula' => $jumlahGula,

                'satuan' => 'KG',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SUDAH MENGAMBIL
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'status' => 'sudah',

            'message' =>
                'Karyawan sudah mengambil gula bulan ini.',

            'karyawan' => $dataKaryawan,

            'periode' => $periode,

            'bulan' => $sekarang->translatedFormat('F Y'),

            'jumlah_gula' =>
                $pengambilan->jumlah_gula ?? $jumlahGula,

            'satuan' => 'KG',

            'tanggal_ambil' =>
                $pengambilan->tanggal_ambil
                    ? Carbon::parse(
                        $pengambilan->tanggal_ambil
                    )->format('d-m-Y')
                    : null,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI PENGAMBILAN GULA
    |--------------------------------------------------------------------------
    */

    public function confirm(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI REQUEST
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI NIK
        |--------------------------------------------------------------------------
        */

        $nik = trim($request->nik);

        $periode = trim($request->periode);


        /*
        |--------------------------------------------------------------------------
        | CARI KARYAWAN AKTIF
        |--------------------------------------------------------------------------
        */

        $karyawan = Karyawan::aktif()
            ->where('nik', $nik)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | KARYAWAN TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

        if (!$karyawan) {
            return response()->json([
                'success' => false,

                'status' => 'tidak_ditemukan',

                'message' =>
                    'Karyawan tidak ditemukan.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI STATUS
        |--------------------------------------------------------------------------
        */

        $statusKaryawan = $this->normalisasiStatus(
            $karyawan->status
        );


        /*
        |--------------------------------------------------------------------------
        | TENTUKAN JATAH GULA
        |--------------------------------------------------------------------------
        */

        $jumlahGula = $this->tentukanJatahGula(
            $statusKaryawan
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI STATUS
        |--------------------------------------------------------------------------
        */

        if ($jumlahGula === null) {
            return response()->json([
                'success' => false,

                'status' => 'status_tidak_valid',

                'message' =>
                    'Status karyawan belum memiliki jatah gula.',

                'status_karyawan' =>
                    $karyawan->status,

                'status_normalisasi' =>
                    $statusKaryawan,

                'nik' =>
                    $karyawan->nik,

                'nama' =>
                    $karyawan->nama,
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN PERIODE YANG DIPILIH ADALAH BULAN SEKARANG
        |--------------------------------------------------------------------------
        |
        | Pengambilan hanya boleh dilakukan untuk bulan berjalan.
        |
        */

        $periodeSekarang = Carbon::now()->format('Y-m');

        if ($periode !== $periodeSekarang) {
            return response()->json([
                'success' => false,

                'status' => 'periode_tidak_valid',

                'message' =>
                    'Pengambilan gula hanya dapat dilakukan untuk periode bulan berjalan.',

                'periode_diminta' =>
                    $periode,

                'periode_sekarang' =>
                    $periodeSekarang,
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | PECAH PERIODE
        |--------------------------------------------------------------------------
        */

        [$tahun, $bulan] = explode(
            '-',
            $periode
        );


        /*
        |--------------------------------------------------------------------------
        | CEK APAKAH SUDAH MENGAMBIL
        |--------------------------------------------------------------------------
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


        /*
        |--------------------------------------------------------------------------
        | SUDAH MENGAMBIL
        |--------------------------------------------------------------------------
        */

        if ($sudahAmbil) {
            return response()->json([
                'success' => false,

                'status' => 'sudah',

                'message' =>
                    'Karyawan sudah mengambil gula pada periode tersebut.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA PENGAMBILAN
        |--------------------------------------------------------------------------
        */

        $pengambilan = PengambilanGula::create([
            'karyawan_id' =>
                $karyawan->id,

            'tanggal_ambil' =>
                now()->toDateString(),

            'jumlah_gula' =>
                $jumlahGula,
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESPONSE BERHASIL
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'status' => 'berhasil',

            'message' =>
                'Pengambilan gula berhasil dikonfirmasi.',

            'karyawan' => [
                'id' =>
                    $karyawan->id,

                'nik' =>
                    $karyawan->nik,

                'nama' =>
                    $karyawan->nama,

                'jabatan' =>
                    $karyawan->jabatan,

                'bagian' =>
                    $karyawan->bagian,

                'status' =>
                    $statusKaryawan,

                'kategori' =>
                    $karyawan->kategori,
            ],

            'periode' =>
                $periode,

            'jumlah_gula' =>
                $jumlahGula,

            'satuan' =>
                'KG',

            'tanggal_ambil' =>
                $pengambilan->tanggal_ambil
                    ? Carbon::parse(
                        $pengambilan->tanggal_ambil
                    )->format('d-m-Y')
                    : now()->format('d-m-Y'),
        ]);
    }
}