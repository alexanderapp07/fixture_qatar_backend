<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estadistica;

class TipoEstadistica extends Model
{
    use HasFactory;

    public function estadisticas() {
        return $this->hasMany(Estadistica::class);
    }
}
