<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aturan_jatah_gula', function (Blueprint $table) {

            $table->id();

            /*
            |----------------------------------------------------------
            | STATUS KARYAWAN
            |----------------------------------------------------------
            */
            $table->string('status', 100)->unique();

            /*
            |----------------------------------------------------------
            | JUMLAH JATAH GULA
            |----------------------------------------------------------
            */
            $table->unsignedInteger('jumlah_gula')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aturan_jatah_gula');
    }
};