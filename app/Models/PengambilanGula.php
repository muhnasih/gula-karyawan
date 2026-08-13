<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanGula extends Model
{
    use HasFactory;

    protected $table = 'pengambilan_gula';

    protected $fillable = [
        'karyawan_id',
        'tanggal_ambil',
        'jumlah_gula',
    ];

    protected $casts = [
        'tanggal_ambil' => 'date',
        'jumlah_gula'   => 'integer',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    /**
     * Helper: menentukan jatah gula berdasarkan kategori karyawan
     * (bukan accessor, supaya tidak menimpa nilai database)
     */
    public static function getJatahByKategori(?string $kategori): int
    {
        return match (strtolower(trim($kategori ?? ''))) {
            'karpim' => 10,
            'karpel' => 5,
            default  => 0,
        };
    }
}