<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengambilan_gula', function (Blueprint $table) {

            $table->id();

            // ID karyawan
            $table->unsignedBigInteger('karyawan_id');

            // Periode pengambilan
            // Contoh: 2026-08
            $table->string('periode', 7);

            // Tanggal ketika gula benar-benar diambil
            $table->date('tanggal_ambil')->nullable();

            // ID user/operator yang melakukan scan
            $table->unsignedBigInteger('discan_oleh')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Relasi ke tabel karyawan
            |--------------------------------------------------------------------------
            */

            $table->foreign('karyawan_id')
                ->references('id')
                ->on('karyawan')
                ->onDelete('cascade');


            /*
            |--------------------------------------------------------------------------
            | Relasi ke tabel users
            |--------------------------------------------------------------------------
            */

            $table->foreign('discan_oleh')
                ->references('id')
                ->on('users')
                ->onDelete('set null');


            /*
            |--------------------------------------------------------------------------
            | Satu karyawan hanya boleh mengambil
            | satu kali untuk satu periode/bulan
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'karyawan_id',
                'periode'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengambilan_gula');
    }
};
