<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        // Hanya mengambil user dengan role operator
        $users = User::where('role', 'operator')
            ->latest()
            ->get();

        return view('admin.operator.index', compact('users'));
    }

    public function create()
    {
        return view('admin.operator.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'     => ['required', 'string', 'max:255', 'unique:users,username'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'username'     => $validated['username'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'email'        => $validated['email'],
            'password'     => Hash::make($validated['password']),
            'role'         => 'operator',
            'status'       => 'aktif',
        ]);

        return redirect()
            ->route('admin.operator.index')
            ->with('success', 'Operator berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.operator.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username'     => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email'        => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password'     => ['nullable', 'string', 'min:8', 'confirmed'],
            'status'       => ['required', 'in:aktif,nonaktif'],
        ]);

        $user->username     = $validated['username'];
        $user->nama_lengkap = $validated['nama_lengkap'];
        $user->email        = $validated['email'];
        $user->status       = $validated['status'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.operator.index')
            ->with('success', 'Data operator berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.operator.index')
            ->with('success', 'Operator berhasil dihapus.');
    }
}