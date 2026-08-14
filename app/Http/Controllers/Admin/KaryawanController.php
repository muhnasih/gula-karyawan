<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Exports\KaryawanTemplateExport;
use App\Imports\KaryawanImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    /**
     * =========================================================
     * MENAMPILKAN DAFTAR KARYAWAN
     * =========================================================
     */
    public function index(Request $request)
    {
        $query = Karyawan::query();

        /*
        |--------------------------------------------------------------------------
        | FILTER KATEGORI
        |--------------------------------------------------------------------------
        */
        if ($request->filled('kategori')) {
            $query->where(
                'kategori',
                $request->kategori
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PENCARIAN NAMA / NIK
        |--------------------------------------------------------------------------
        */
        if ($request->filled('cari')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nama',
                    'like',
                    '%' . $request->cari . '%'
                );

                $q->orWhere(
                    'nik',
                    'like',
                    '%' . $request->cari . '%'
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | DATA KARYAWAN
        |--------------------------------------------------------------------------
        */
        $karyawan = $query
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | DAFTAR KATEGORI
        |--------------------------------------------------------------------------
        */
        $kategoriList = Karyawan::query()
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        /*
        |--------------------------------------------------------------------------
        | DAFTAR STATUS
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
        | VIEW
        |--------------------------------------------------------------------------
        */
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
     * =========================================================
     * FORM TAMBAH KARYAWAN
     * =========================================================
     */
    public function create()
    {
        return view(
            'admin.karyawan.create'
        );
    }


    /**
     * =========================================================
     * SIMPAN KARYAWAN BARU
     * =========================================================
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate(
            [
                'nik' => [
                    'required',
                    'string',
                    'max:50',
                    'unique:karyawan,nik',
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'jabatan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'bagian' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'status' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'kategori' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK tersebut sudah terdaftar.',

                'nama.required' =>
                    'Nama karyawan wajib diisi.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA
        |--------------------------------------------------------------------------
        */
        Karyawan::create($validated);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('admin.karyawan')
            ->with(
                'success',
                'Data karyawan berhasil ditambahkan.'
            );
    }


    /**
     * =========================================================
     * FORM EDIT KARYAWAN
     * =========================================================
     */
    public function edit(Karyawan $karyawan)
    {
        return view(
            'admin.karyawan.edit',
            compact('karyawan')
        );
    }


    /**
     * =========================================================
     * UPDATE DATA KARYAWAN
     * =========================================================
     */
    public function update(
        Request $request,
        Karyawan $karyawan
    ) {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate(
            [
                'nik' => [
                    'required',
                    'string',
                    'max:50',
                    'unique:karyawan,nik,' . $karyawan->id,
                ],

                'nama' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'jabatan' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'bagian' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'status' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'kategori' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'keterangan' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'nik.required' =>
                    'NIK wajib diisi.',

                'nik.unique' =>
                    'NIK tersebut sudah digunakan karyawan lain.',

                'nama.required' =>
                    'Nama karyawan wajib diisi.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */
        $karyawan->update($validated);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('admin.karyawan')
            ->with(
                'success',
                'Data karyawan berhasil diperbarui.'
            );
    }


    /**
     * =========================================================
     * HAPUS DATA KARYAWAN
     * =========================================================
     */
    public function destroy(Karyawan $karyawan)
    {
        /*
        |--------------------------------------------------------------------------
        | SIMPAN NAMA UNTUK PESAN
        |--------------------------------------------------------------------------
        */
        $nama = $karyawan->nama;

        /*
        |--------------------------------------------------------------------------
        | HAPUS
        |--------------------------------------------------------------------------
        */
        $karyawan->delete();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('admin.karyawan')
            ->with(
                'success',
                "Data karyawan {$nama} berhasil dihapus."
            );
    }


    /**
     * =========================================================
     * IMPORT DATA KARYAWAN DARI EXCEL
     * =========================================================
     */
    public function importExcel(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI FILE EXCEL
        |--------------------------------------------------------------------------
        */
        $request->validate(
            [
                'file' => [
                    'required',
                    'file',
                    'mimes:xlsx,xls',
                    'max:5120',
                ],
            ],
            [
                'file.required' =>
                    'Silakan pilih file Excel terlebih dahulu.',

                'file.file' =>
                    'File yang dikirim tidak valid.',

                'file.mimes' =>
                    'File harus berformat Excel (.xlsx atau .xls).',

                'file.max' =>
                    'Ukuran file maksimal 5 MB.',
            ]
        );

        try {

            /*
            |--------------------------------------------------------------------------
            | BUAT OBJECT IMPORT
            |--------------------------------------------------------------------------
            */
            $import = new KaryawanImport();

            /*
            |--------------------------------------------------------------------------
            | PROSES IMPORT
            |--------------------------------------------------------------------------
            */
            Excel::import(
                $import,
                $request->file('file')
            );

            /*
            |--------------------------------------------------------------------------
            | BUAT PESAN HASIL IMPORT
            |--------------------------------------------------------------------------
            */
            $pesan = 'Import selesai. ';

            $pesan .=
                "Berhasil: {$import->berhasil}. ";

            $pesan .=
                "Dilewati: {$import->dilewati}. ";

            $pesan .=
                "Gagal: {$import->gagal}.";

            /*
            |--------------------------------------------------------------------------
            | REDIRECT BERHASIL
            |--------------------------------------------------------------------------
            */
            return redirect()
                ->route('admin.karyawan')
                ->with(
                    'success',
                    $pesan
                );

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | REDIRECT JIKA IMPORT GAGAL
            |--------------------------------------------------------------------------
            */
            return redirect()
                ->route('admin.karyawan')
                ->with(
                    'error',
                    'Import gagal: ' .
                    $e->getMessage()
                );
        }
    }


    /**
     * =========================================================
     * DOWNLOAD TEMPLATE EXCEL
     * =========================================================
     */
    public function downloadTemplate()
    {
        return Excel::download(
            new KaryawanTemplateExport(),
            'template-data-karyawan.xlsx'
        );
    }
}