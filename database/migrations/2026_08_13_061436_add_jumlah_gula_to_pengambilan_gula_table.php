<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengambilan_gula', function (Blueprint $table) {
            $table->integer('jumlah_gula')
                ->nullable()
                ->after('tanggal_ambil');
        });
    }

    public function down(): void
    {
        Schema::table('pengambilan_gula', function (Blueprint $table) {
            $table->dropColumn('jumlah_gula');
        });
    }
};