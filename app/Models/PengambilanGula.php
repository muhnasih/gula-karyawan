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

    /**
     * Relasi ke karyawan.
     */
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}