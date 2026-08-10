<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PengambilanGula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Scanner
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Riwayat pengambilan terbaru (untuk panel di sebelah kamera)
        |--------------------------------------------------------------------------
        */

        $riwayat = PengambilanGula::with('karyawan')
            ->latest('tanggal_ambil')
            ->take(10)
            ->get()
            ->map(function ($item) {
                return (object) [
                    'nik'  => $item->karyawan->nik ?? '-',
                    'nama' => $item->karyawan->nama ?? '-',
                ];
            });

        return view('operator.scan', compact('riwayat'));
    }


    /*
    |--------------------------------------------------------------------------
    | Hasil Scan QR
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
        ]);

        $nik = trim($request->nik);

        /*
        |--------------------------------------------------------------------------
        | Cari karyawan berdasarkan NIK
        |--------------------------------------------------------------------------
        */

        $karyawan = Karyawan::aktif()
            ->where('nik', $nik)
            ->first();

        if (!$karyawan) {

            return response()->json([
                'success' => false,
                'message' => 'Karyawan dengan NIK tersebut tidak ditemukan.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Periode bulan sekarang
        |--------------------------------------------------------------------------
        */

        $tahun   = Carbon::now()->year;
        $bulan   = Carbon::now()->month;
        $periode = Carbon::now()->format('Y-m');


        /*
        |--------------------------------------------------------------------------
        | Cek apakah sudah mengambil bulan ini
        |--------------------------------------------------------------------------
        */

        $pengambilan = PengambilanGula::where('karyawan_id', $karyawan->id)
            ->whereYear('tanggal_ambil', $tahun)
            ->whereMonth('tanggal_ambil', $bulan)
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Belum mengambil
        |--------------------------------------------------------------------------
        */

        if (!$pengambilan) {

            return response()->json([
                'success' => true,

                'status' => 'belum',

                'message' => 'Karyawan belum mengambil gula bulan ini.',

                'karyawan' => [
                    'id' => $karyawan->id,
                    'nik' => $karyawan->nik,
                    'nama' => $karyawan->nama,
                    'jabatan' => $karyawan->jabatan,
                    'bagian' => $karyawan->bagian,
                ],

                'periode' => $periode,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Sudah mengambil
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'status' => 'sudah',

            'message' => 'Karyawan sudah mengambil gula bulan ini.',

            'karyawan' => [
                'id' => $karyawan->id,
                'nik' => $karyawan->nik,
                'nama' => $karyawan->nama,
                'jabatan' => $karyawan->jabatan,
                'bagian' => $karyawan->bagian,
            ],

            'periode' => $periode,

            'tanggal_ambil' => $pengambilan->tanggal_ambil
                ? Carbon::parse($pengambilan->tanggal_ambil)->format('d-m-Y')
                : null,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Konfirmasi Pengambilan
    |--------------------------------------------------------------------------
    */

    public function confirm(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'periode' => 'required|string', // format: Y-m, misal 2026-08
        ]);

        $karyawan = Karyawan::aktif()
            ->where('nik', trim($request->nik))
            ->first();

        if (!$karyawan) {

            return response()->json([
                'success' => false,
                'message' => 'Karyawan tidak ditemukan.',
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Pecah periode (Y-m) jadi tahun & bulan
        |--------------------------------------------------------------------------
        */

        [$tahun, $bulan] = explode('-', $request->periode);


        /*
        |--------------------------------------------------------------------------
        | Cek apakah sudah mengambil di bulan tersebut
        |--------------------------------------------------------------------------
        */

        $sudahAmbil = PengambilanGula::where('karyawan_id', $karyawan->id)
            ->whereYear('tanggal_ambil', $tahun)
            ->whereMonth('tanggal_ambil', $bulan)
            ->exists();

        if ($sudahAmbil) {

            return response()->json([
                'success' => false,
                'message' => 'Karyawan sudah mengambil gula pada periode tersebut.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan pengambilan
        |--------------------------------------------------------------------------
        */

        PengambilanGula::create([
            'karyawan_id' => $karyawan->id,
            'tanggal_ambil' => now()->toDateString(),
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Pengambilan gula berhasil dikonfirmasi.',
        ]);
    }
}