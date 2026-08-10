<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PengambilanGula;
class Karyawan extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'karyawan';

    protected $fillable = [
        'nik',
        'nama',
        'jabatan',
        'bagian',
        'status',
        'kategori',
        'keterangan',
        'status_pengambilan',
        'tanggal_pengambilan',
        'discan_oleh',
    ];

    protected $casts = [
        'tanggal_pengambilan' => 'datetime',
    ];

    /**
     * Karyawan login pakai NIK, bukan email/password.
     */
    public function getAuthPassword()
    {
        return null; // tidak dipakai, login tanpa password
    }

    public function getAuthIdentifierName()
    {
        return 'nik';
    }

    /**
     * Accessor: apakah karyawan berstatus pensiun.
     */
    public function getIsPensiunAttribute(): bool
    {
        return str_starts_with((string) $this->keterangan, 'PENSIUN');
    }

    public function getTanggalPensiunAttribute(): ?string
    {
        if ($this->is_pensiun) {
            return trim(str_replace('PENSIUN', '', $this->keterangan));
        }

        return null;
    }

    public function scopePensiun($query)
    {
        return $query->where('keterangan', 'like', 'PENSIUN%');
    }

    public function scopeAktif($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('keterangan')
              ->orWhere('keterangan', 'not like', 'PENSIUN%');
        });
    }

    public function scopeSudahAmbil($query)
    {
        return $query->where('status_pengambilan', 'sudah');
    }

    public function scopeBelumAmbil($query)
    {
        return $query->where('status_pengambilan', 'belum');
    }

    public function discanOleh()
    {
        return $this->belongsTo(User::class, 'discan_oleh');
    }

    public function pengambilanGula()
{
    return $this->hasMany(PengambilanGula::class, 'karyawan_id');
}
}