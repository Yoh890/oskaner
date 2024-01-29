<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstra extends Model
{
    use HasFactory;
    protected $table='ekstra';
    protected $guarded = [];

    public function ekskul()
    {
        return $this->hasMany(Ekskul::class);
    }

    public function pelatih()
    {
        return $this->hasMany(Pelatih::class);
    }
}
