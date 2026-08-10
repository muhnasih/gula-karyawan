<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            if (!Schema::hasColumn('karyawan', 'status_pengambilan')) {
                $table->enum('status_pengambilan', ['belum', 'sudah'])
                    ->default('belum')
                    ->after('keterangan');
            }

            if (!Schema::hasColumn('karyawan', 'tanggal_pengambilan')) {
                $table->timestamp('tanggal_pengambilan')
                    ->nullable()
                    ->after('status_pengambilan');
            }

            if (!Schema::hasColumn('karyawan', 'discan_oleh')) {
                $table->foreignId('discan_oleh')
                    ->nullable()
                    ->after('tanggal_pengambilan')
                    ->constrained('users')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            if (Schema::hasColumn('karyawan', 'discan_oleh')) {
                $table->dropForeign(['discan_oleh']);
                $table->dropColumn('discan_oleh');
            }

            if (Schema::hasColumn('karyawan', 'tanggal_pengambilan')) {
                $table->dropColumn('tanggal_pengambilan');
            }

            if (Schema::hasColumn('karyawan', 'status_pengambilan')) {
                $table->dropColumn('status_pengambilan');
            }
        });
    }
};