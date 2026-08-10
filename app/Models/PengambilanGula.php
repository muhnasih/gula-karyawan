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
        'periode',
        'tanggal_ambil',
        'discan_oleh',
    ];

    protected $casts = [
        'tanggal_ambil' => 'date',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Karyawan
    |--------------------------------------------------------------------------
    */

    public function karyawan()
    {
        return $this->belongsTo(
            Karyawan::class,
            'karyawan_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Relasi ke Operator/User
    |--------------------------------------------------------------------------
    */

    public function operator()
    {
        return $this->belongsTo(
            User::class,
            'discan_oleh'
        );
    }
}