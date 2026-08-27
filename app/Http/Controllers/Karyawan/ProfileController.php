<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil karyawan.
     */
    public function edit()
    {
        $karyawan = Auth::guard('karyawan')->user();

        return view('karyawan.profile', compact('karyawan'));
    }

    /**
     * Menampilkan halaman ubah password.
     */
    public function password()
    {
        $karyawan = Auth::guard('karyawan')->user();

        return view('karyawan.password', compact('karyawan'));
    }

    /**
     * Memproses perubahan password karyawan.
     */
    public function updatePassword(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'current_password' => [
                'required',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'current_password.required' =>
                'Password saat ini wajib diisi.',

            'password.required' =>
                'Password baru wajib diisi.',

            'password.min' =>
                'Password baru minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password baru tidak cocok.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | AMBIL KARYAWAN YANG SEDANG LOGIN
        |--------------------------------------------------------------------------
        */

        $karyawan = Auth::guard('karyawan')->user();


        /*
        |--------------------------------------------------------------------------
        | CEK PASSWORD SAAT INI
        |--------------------------------------------------------------------------
        */

        if (!Hash::check(
            $request->current_password,
            $karyawan->password
        )) {

            return back()
                ->withInput()
                ->withErrors([
                    'current_password' =>
                        'Password saat ini salah.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PASSWORD BARU
        |--------------------------------------------------------------------------
        */

        $karyawan->password = Hash::make(
            $request->password
        );

        $karyawan->save();


        /*
        |--------------------------------------------------------------------------
        | BERHASIL
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Password berhasil diubah.'
        );
    }
}