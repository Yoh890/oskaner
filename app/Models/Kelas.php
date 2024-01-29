<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table='kelas';
    protected $guarded = [];

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }
}
