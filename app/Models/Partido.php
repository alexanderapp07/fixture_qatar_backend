<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    public function estadio() {
        return $this->belongsTo(Estadio::class);
    }

    public function pais_local() {
        return $this->belongsTo(Pais::class);
    }

    public function pais_visita() {
        return $this->belongsTo(Pais::class);
    }
}
