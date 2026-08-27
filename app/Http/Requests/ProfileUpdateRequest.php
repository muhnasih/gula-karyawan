<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Menentukan apakah request diperbolehkan.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        $user = $this->user();

        return [

            /*
            |--------------------------------------------------------------------------
            | Nama Lengkap
            |--------------------------------------------------------------------------
            */

            'nama_lengkap' => [
                'required',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Username
            |--------------------------------------------------------------------------
            */

            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')
                    ->ignore($user->id),
            ],

        ];
    }

    /**
     * Pesan error.
     */
    public function messages(): array
    {
        return [

            'nama_lengkap.required' =>
                'Nama lengkap wajib diisi.',

            'nama_lengkap.string' =>
                'Nama lengkap harus berupa teks.',

            'nama_lengkap.max' =>
                'Nama lengkap maksimal 255 karakter.',

            'username.required' =>
                'Username wajib diisi.',

            'username.string' =>
                'Username harus berupa teks.',

            'username.max' =>
                'Username maksimal 255 karakter.',

            'username.unique' =>
                'Username tersebut sudah digunakan.',

        ];
    }
}