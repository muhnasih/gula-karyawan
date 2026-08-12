<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Menampilkan daftar karyawan
     */
    public function index(Request $request)
    {
        $query = Karyawan::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->cari . '%')
                  ->orWhere('nik', 'like', '%' . $request->cari . '%');
            });
        }

        $karyawan = $query
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        $kategoriList = Karyawan::distinct()
            ->pluck('kategori')
            ->filter();

        $statusList = Karyawan::distinct()
            ->pluck('status')
            ->filter();

        return view(
            'admin.karyawan.index',
            compact(
                'karyawan',
                'kategoriList',
                'statusList'
            )
        );
    }


    /**
     * Form tambah karyawan
     */
    public function create()
    {
        return view('admin.karyawan.create');
    }


    /**
     * Simpan karyawan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nik' => 'required|string|max:50|unique:karyawan,nik',
                'nama' => 'required|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'bagian' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:100',
                'kategori' => 'nullable|string|max:100',
                'keterangan' => 'nullable|string',
            ],
            [
                'nik.required' => 'NIK wajib diisi.',
                'nik.unique' => 'NIK tersebut sudah terdaftar.',
                'nama.required' => 'Nama karyawan wajib diisi.',
            ]
        );

        Karyawan::create($validated);

        return redirect()
            ->route('admin.karyawan')
            ->with('success', 'Data karyawan berhasil ditambahkan.');
    }


    /**
     * Form edit karyawan
     */
    public function edit(Karyawan $karyawan)
    {
        return view('admin.karyawan.edit', compact('karyawan'));
    }


    /**
     * Memperbarui data karyawan
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate(
            [
                'nik' => 'required|string|max:50|unique:karyawan,nik,' . $karyawan->id,
                'nama' => 'required|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'bagian' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:100',
                'kategori' => 'nullable|string|max:100',
                'keterangan' => 'nullable|string',
            ],
            [
                'nik.required' => 'NIK wajib diisi.',
                'nik.unique' => 'NIK tersebut sudah digunakan karyawan lain.',
                'nama.required' => 'Nama karyawan wajib diisi.',
            ]
        );

        $karyawan->update($validated);

        return redirect()
            ->route('admin.karyawan')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }


    /**
     * Menghapus data karyawan
     */
    public function destroy(Karyawan $karyawan)
    {
        $nama = $karyawan->nama;

        $karyawan->delete();

        return redirect()
            ->route('admin.karyawan')
            ->with('success', "Data karyawan {$nama} berhasil dihapus.");
    }
}