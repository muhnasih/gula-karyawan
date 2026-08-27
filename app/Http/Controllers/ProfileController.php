<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman pengaturan profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Mengubah informasi profil.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        /*
        |--------------------------------------------------------------------------
        | Jika email berubah
        |--------------------------------------------------------------------------
        */

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Mengubah kata sandi.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [

            /*
            |--------------------------------------------------------------------------
            | Password lama
            |--------------------------------------------------------------------------
            */

            'current_password' => [
                'required',
                'current_password',
            ],

            /*
            |--------------------------------------------------------------------------
            | Password baru
            |--------------------------------------------------------------------------
            */

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
            ],

        ], [

            'current_password.required' =>
                'Kata sandi lama wajib diisi.',

            'current_password.current_password' =>
                'Kata sandi lama tidak sesuai.',

            'password.required' =>
                'Kata sandi baru wajib diisi.',

            'password.min' =>
                'Kata sandi baru minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi kata sandi tidak cocok.',

            'password.different' =>
                'Kata sandi baru harus berbeda dari kata sandi lama.',

        ]);

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Simpan password dengan hash
        |--------------------------------------------------------------------------
        */

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('profile.edit')
            ->with('status', 'password-updated');
    }

    /**
     * Menghapus akun.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => [
                'required',
                'current_password',
            ],
        ]);

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Auth::logout();

        /*
        |--------------------------------------------------------------------------
        | Hapus akun
        |--------------------------------------------------------------------------
        */

        $user->delete();

        /*
        |--------------------------------------------------------------------------
        | Hapus session
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}