<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jugador;
use App\Models\TipoEstadistica;
use App\Models\Partido;

class Estadistica extends Model
{
    use HasFactory;

    protected $table = 'estadisticas';

    public function jugador() {
        return $this->belongsTo(Jugador::class);
    }

    public function partido() {
        return $this->belongsTo(Partido::class);
    }
}
