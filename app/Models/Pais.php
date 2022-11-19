<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Confederacion;
use App\Models\Entrenador;
use App\Models\Jugador;

class Pais extends Model
{
    use HasFactory;

    public function confederacion() {
        return $this->belongsTo(Confederacion::class);
    }

    public function entrenador() {
        return $this->hasOne(Entrenador::class);
    }

    public function jugadores() {
        return $this->hasMany(Jugador::class);
    }

    public function partidos() {
        return $this->hasMany(Partido::class);
    }
}
