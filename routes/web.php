<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Operator\ScanController;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;

use App\Http\Controllers\Karyawan\AuthController as KaryawanAuthController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;


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
        | Admin langsung masuk ke halaman Laporan
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {
            return redirect()->route('admin.laporan.index');
        }


        /*
        |--------------------------------------------------------------------------
        | OPERATOR
        |--------------------------------------------------------------------------
        | Operator masuk ke Dashboard Operator
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
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


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
            | HAPUS KARYAWAN
            |--------------------------------------------------------------------------
            */

            Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])
                ->name('karyawan.destroy');


            /*
            |--------------------------------------------------------------------------
            | LAPORAN
            |--------------------------------------------------------------------------
            */

            // Halaman utama laporan
            Route::get('/laporan', [LaporanController::class, 'index'])
                ->name('laporan.index');


            // Export Excel
            Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])
                ->name('laporan.excel');


            // Export PDF
            Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])
                ->name('laporan.pdf');


            /*
            |--------------------------------------------------------------------------
            | OPERATOR (Data User dengan role operator)
            |--------------------------------------------------------------------------
            */

            // Halaman utama daftar operator
            Route::get('/operator', [UserController::class, 'index'])
                ->name('operator.index');


            // Tambah operator
            Route::get('/operator/create', [UserController::class, 'create'])
                ->name('operator.create');

            Route::post('/operator', [UserController::class, 'store'])
                ->name('operator.store');


            // Edit operator
            Route::get('/operator/{user}/edit', [UserController::class, 'edit'])
                ->name('operator.edit');

            Route::put('/operator/{user}', [UserController::class, 'update'])
                ->name('operator.update');


            // Hapus operator
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
            | SCAN
            |--------------------------------------------------------------------------
            */

            Route::get('/scan', [ScanController::class, 'index'])
                ->name('scan');


            /*
            |--------------------------------------------------------------------------
            | PROSES SCAN
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