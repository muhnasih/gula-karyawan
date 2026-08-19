<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\AturanJatahGula;
use Illuminate\Http\Request;

class JatahGulaController extends Controller
{
    /**
     * =========================================================
     * MENAMPILKAN HALAMAN PENGATURAN JATAH GULA
     * =========================================================
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DAFTAR STATUS DARI DATA KARYAWAN
        |--------------------------------------------------------------------------
        */

        $statusList = Karyawan::query()
            ->whereNotNull('status')
            ->where('status', '!=', '')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');


        /*
        |--------------------------------------------------------------------------
        | PASTIKAN ATURAN JATAH UNTUK SETIAP STATUS
        |--------------------------------------------------------------------------
        |
        | Jika ada status karyawan yang belum memiliki aturan,
        | otomatis dibuat dengan jatah 0 KG.
        |
        */

        foreach ($statusList as $status) {

            $statusNormal =
                AturanJatahGula::normalisasiStatus(
                    $status
                );

            if ($statusNormal === '') {
                continue;
            }

            AturanJatahGula::firstOrCreate(
                [
                    'status' => $statusNormal,
                ],
                [
                    'jumlah_gula' => 0,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL ATURAN JATAH GULA
        |--------------------------------------------------------------------------
        */

        $aturanJatahGula = AturanJatahGula::query()
            ->orderBy('status')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.jatah-gula.index',
            compact('aturanJatahGula')
        );
    }


    /**
     * =========================================================
     * UPDATE JATAH GULA
     * =========================================================
     */
    public function update(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'status' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'jumlah_gula' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:1000',
                ],
            ],
            [
                'status.required' =>
                    'Status karyawan wajib dipilih.',

                'jumlah_gula.required' =>
                    'Jumlah jatah gula wajib diisi.',

                'jumlah_gula.integer' =>
                    'Jumlah gula harus berupa angka.',

                'jumlah_gula.min' =>
                    'Jumlah gula tidak boleh kurang dari 0 KG.',

                'jumlah_gula.max' =>
                    'Jumlah gula maksimal 1000 KG.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI STATUS
        |--------------------------------------------------------------------------
        */

        $status =
            AturanJatahGula::normalisasiStatus(
                $validated['status']
            );


        /*
        |--------------------------------------------------------------------------
        | UPDATE / CREATE ATURAN
        |--------------------------------------------------------------------------
        */

        AturanJatahGula::updateOrCreate(
            [
                'status' => $status,
            ],
            [
                'jumlah_gula' =>
                    (int) $validated['jumlah_gula'],
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.jatah-gula.index')
            ->with(
                'success',
                "Jatah gula untuk status {$status} berhasil diperbarui menjadi {$validated['jumlah_gula']} KG."
            );
    }
}