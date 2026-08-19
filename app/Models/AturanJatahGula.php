<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturanJatahGula extends Model
{
    use HasFactory;

    protected $table = 'aturan_jatah_gula';

    protected $fillable = [
        'status',
        'jumlah_gula',
    ];

    protected $casts = [
        'jumlah_gula' => 'integer',
    ];

    /**
     * =========================================================
     * NORMALISASI STATUS
     * =========================================================
     */
    public static function normalisasiStatus(?string $status): string
    {
        return strtoupper(
            trim(
                preg_replace(
                    '/\s+/',
                    ' ',
                    (string) $status
                )
            )
        );
    }

    /**
     * =========================================================
     * AMBIL JATAH BERDASARKAN STATUS
     * =========================================================
     */
    public static function getJatahByStatus(?string $status): ?int
    {
        $status = self::normalisasiStatus($status);

        if ($status === '') {
            return null;
        }

        $aturan = self::where(
            'status',
            $status
        )->first();

        if (!$aturan) {
            return null;
        }

        return (int) $aturan->jumlah_gula;
    }
}