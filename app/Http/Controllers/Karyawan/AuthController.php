<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login karyawan.
     *
     * Login karyawan hanya menggunakan NIK.
     */
    public function showLoginForm()
    {
        return view('auth.karyawan-login');
    }

    /**
     * Proses login karyawan menggunakan NIK.
     */
    public function login(Request $request)
    {
        $request->validate([
            'nik' => [
                'required',
                'string',
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
        ]);

        // Bersihkan spasi di awal/akhir NIK
        $nik = trim($request->nik);

        // Cari karyawan yang aktif berdasarkan NIK
        $karyawan = Karyawan::aktif()
            ->where('nik', $nik)
            ->first();

        // Jika tidak ditemukan
        if (!$karyawan) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'NIK tidak ditemukan atau karyawan tidak aktif.'
                );
        }

        // Login menggunakan guard karyawan
        Auth::guard('karyawan')->login($karyawan);

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        // Masuk ke dashboard karyawan
        return redirect()->route('karyawan.dashboard');
    }

    /**
     * Logout karyawan.
     */
    public function logout(Request $request)
    {
        Auth::guard('karyawan')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('karyawan.login');
    }
}
