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
        'jumlah_gula' => 'integer',
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
    | Menentukan jumlah gula berdasarkan status karyawan
    |--------------------------------------------------------------------------
    */

    public function getJumlahGulaAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->karyawan) {
            return match (strtolower(trim($this->karyawan->status))) {
                'karpim' => 10,
                'karpel' => 5,
                default => 0,
            };
        }

        return 0;
    }
}