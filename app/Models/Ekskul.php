<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;
    protected $table='ekskul';
    protected $guarded = [];

    public function ekstra()
    {
        return $this->belongsTo(Ekstra::class);
    }
}
