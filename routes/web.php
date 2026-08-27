<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

// =========================================================
// ADMIN CONTROLLERS
// =========================================================
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JatahGulaController;

// =========================================================
// OPERATOR CONTROLLERS
// =========================================================
use App\Http\Controllers\Operator\ScanController;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\OperatorStatistikController;

// =========================================================
// KARYAWAN CONTROLLERS
// =========================================================
use App\Http\Controllers\Karyawan\AuthController as KaryawanAuthController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\ProfileController as KaryawanProfileController;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA — PILIHAN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.choose-login');
})->name('choose-login');


/*
|--------------------------------------------------------------------------
| ROUTE SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | REDIRECT BERDASARKAN ROLE
    |--------------------------------------------------------------------------
    */

    Route::get('/home', function () {

        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {
            return redirect()->route('admin.laporan.index');
        }


        /*
        |--------------------------------------------------------------------------
        | OPERATOR
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'operator') {
            return redirect()->route('operator.dashboard');
        }


        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK DIKENALI
        |--------------------------------------------------------------------------
        */

        auth()->logout();

        return redirect()
            ->route('login')
            ->with(
                'error',
                'Role akun Anda tidak dikenali. Silakan hubungi administrator.'
            );

    })->name('home');


    /*
    |--------------------------------------------------------------------------
    | PROFILE (ADMIN & OPERATOR)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | FOTO PROFIL (ADMIN & OPERATOR)
    |--------------------------------------------------------------------------
    */

    Route::get('/profile/foto', [ProfileController::class, 'editFoto'])
        ->name('profile.foto');

    Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])
        ->name('profile.foto.update');


    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | DATA KARYAWAN
            |--------------------------------------------------------------------------
            */

            Route::get('/karyawan', [KaryawanController::class, 'index'])
                ->name('karyawan');


            /*
            |--------------------------------------------------------------------------
            | TEMPLATE & IMPORT EXCEL KARYAWAN
            |--------------------------------------------------------------------------
            */

            Route::get('/karyawan/template', [KaryawanController::class, 'downloadTemplate'])
                ->name('karyawan.template');

            Route::post('/karyawan/import', [KaryawanController::class, 'importExcel'])
                ->name('karyawan.import');


            /*
            |--------------------------------------------------------------------------
            | TAMBAH KARYAWAN
            |--------------------------------------------------------------------------
            */

            Route::get('/karyawan/create', [KaryawanController::class, 'create'])
                ->name('karyawan.create');

            Route::post('/karyawan', [KaryawanController::class, 'store'])
                ->name('karyawan.store');


            /*
            |--------------------------------------------------------------------------
            | EDIT KARYAWAN
            |--------------------------------------------------------------------------
            */

            Route::get('/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])
                ->name('karyawan.edit');

            Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])
                ->name('karyawan.update');


            /*
            |--------------------------------------------------------------------------
            | HAPUS BANYAK KARYAWAN SEKALIGUS
            |--------------------------------------------------------------------------
            | Diletakkan sebelum route dinamis {karyawan} agar
            | "bulk-destroy" tidak tertangkap sebagai parameter ID.
            */

            Route::delete('/karyawan/bulk-destroy', [KaryawanController::class, 'bulkDestroy'])
                ->name('karyawan.bulk-destroy');


            /*
            |--------------------------------------------------------------------------
            | HAPUS KARYAWAN
            |--------------------------------------------------------------------------
            */

            Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])
                ->name('karyawan.destroy');


            /*
            |--------------------------------------------------------------------------
            | PENGATURAN JATAH GULA
            |--------------------------------------------------------------------------
            */

            Route::get('/jatah-gula', [JatahGulaController::class, 'index'])
                ->name('jatah-gula.index');

            Route::post('/jatah-gula', [JatahGulaController::class, 'update'])
                ->name('jatah-gula.update');


            /*
            |--------------------------------------------------------------------------
            | LAPORAN
            |--------------------------------------------------------------------------
            */

            Route::get('/laporan', [LaporanController::class, 'index'])
                ->name('laporan.index');


            /*
            |--------------------------------------------------------------------------
            | EXPORT EXCEL
            |--------------------------------------------------------------------------
            */

            Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])
                ->name('laporan.excel');


            /*
            |--------------------------------------------------------------------------
            | EXPORT PDF
            |--------------------------------------------------------------------------
            */

            Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])
                ->name('laporan.pdf');


            /*
            |--------------------------------------------------------------------------
            | KELOLA OPERATOR
            |--------------------------------------------------------------------------
            */

            Route::get('/operator', [UserController::class, 'index'])
                ->name('operator.index');


            /*
            |--------------------------------------------------------------------------
            | TAMBAH OPERATOR
            |--------------------------------------------------------------------------
            */

            Route::get('/operator/create', [UserController::class, 'create'])
                ->name('operator.create');

            Route::post('/operator', [UserController::class, 'store'])
                ->name('operator.store');


            /*
            |--------------------------------------------------------------------------
            | EDIT OPERATOR
            |--------------------------------------------------------------------------
            */

            Route::get('/operator/{user}/edit', [UserController::class, 'edit'])
                ->name('operator.edit');

            Route::put('/operator/{user}', [UserController::class, 'update'])
                ->name('operator.update');


            /*
            |--------------------------------------------------------------------------
            | HAPUS OPERATOR
            |--------------------------------------------------------------------------
            */

            Route::delete('/operator/{user}', [UserController::class, 'destroy'])
                ->name('operator.destroy');

        });


    /*
    |--------------------------------------------------------------------------
    | OPERATOR
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:operator')
        ->prefix('operator')
        ->name('operator.')
        ->group(function () {


            /*
            |--------------------------------------------------------------------------
            | DASHBOARD OPERATOR
            |--------------------------------------------------------------------------
            */

            Route::get('/dashboard', [OperatorDashboardController::class, 'index'])
                ->name('dashboard');


            /*
            |--------------------------------------------------------------------------
            | STATISTIK OPERATOR
            |--------------------------------------------------------------------------
            */

            Route::get('/statistik', [OperatorStatistikController::class, 'index'])
                ->name('statistik');


            /*
            |--------------------------------------------------------------------------
            | SCAN BARCODE
            |--------------------------------------------------------------------------
            */

            Route::get('/scan', [ScanController::class, 'index'])
                ->name('scan');


            /*
            |--------------------------------------------------------------------------
            | PROSES SCAN BARCODE
            |--------------------------------------------------------------------------
            */

            Route::post('/scan', [ScanController::class, 'store'])
                ->name('scan.store');


            /*
            |--------------------------------------------------------------------------
            | KONFIRMASI PENGAMBILAN
            |--------------------------------------------------------------------------
            */

            Route::post('/scan/confirm', [ScanController::class, 'confirm'])
                ->name('scan.confirm');

        });

});


/*
|--------------------------------------------------------------------------
| KARYAWAN
|--------------------------------------------------------------------------
|
| Login karyawan menggunakan guard "karyawan"
|
*/


/*
|--------------------------------------------------------------------------
| LOGIN KARYAWAN
|--------------------------------------------------------------------------
*/

Route::middleware('guest:karyawan')->group(function () {

    Route::get('/karyawan/login', [KaryawanAuthController::class, 'showLoginForm'])
        ->name('karyawan.login');

    Route::post('/karyawan/login', [KaryawanAuthController::class, 'login'])
        ->name('karyawan.login.store');

});


/*
|--------------------------------------------------------------------------
| HALAMAN KARYAWAN SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth:karyawan')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD KARYAWAN
    |--------------------------------------------------------------------------
    */

    Route::get('/karyawan/dashboard', [KaryawanDashboardController::class, 'index'])
        ->name('karyawan.dashboard');


    /*
    |--------------------------------------------------------------------------
    | EDIT PASSWORD KARYAWAN
    |--------------------------------------------------------------------------
    */

    Route::get('/karyawan/password', [KaryawanProfileController::class, 'password'])
    ->name('karyawan.password');

Route::put('/karyawan/password', [KaryawanProfileController::class, 'updatePassword'])
    ->name('karyawan.password.update');

    /*
    |--------------------------------------------------------------------------
    | LOGOUT KARYAWAN
    |--------------------------------------------------------------------------
    */

    Route::post('/karyawan/logout', [KaryawanAuthController::class, 'logout'])
        ->name('karyawan.logout');

});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
|
| Route login/register untuk Admin dan Operator
|
*/

require __DIR__ . '/auth.php';