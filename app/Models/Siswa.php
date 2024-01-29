<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table='siswa';
    protected $guarded = [];
    protected $cascadeDeletes = ['prestasi', 'laporan', 'absen', 'peserta'];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // Hapus entitas terkait
            $model->prestasi()->delete();
            $model->laporan()->delete();
            $model->absen()->delete();
            $model->peserta()->delete();
            // ... tambahkan relasi lainnya ...
        });
    }


    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
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
