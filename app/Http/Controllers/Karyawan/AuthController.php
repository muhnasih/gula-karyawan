<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login karyawan.
     */
    public function showLoginForm()
    {
        return view('auth.karyawan-login');
    }

    /**
     * Proses login karyawan menggunakan NIK + Password.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
                'string',
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Bersihkan spasi di awal/akhir NIK
        $nik = trim($request->nik);

        // Cari karyawan aktif berdasarkan NIK
        $karyawan = Karyawan::aktif()
            ->where('nik', $nik)
            ->first();

        // Jika NIK tidak ditemukan
        if (!$karyawan) {
            return back()
                ->withInput($request->only('nik'))
                ->with(
                    'error',
                    'NIK tidak ditemukan atau karyawan tidak aktif.'
                );
        }

        // Cek password
        if (!Hash::check($request->password, $karyawan->password)) {
            return back()
                ->withInput($request->only('nik'))
                ->with(
                    'error',
                    'Password yang Anda masukkan salah.'
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