<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pais;

class Entrenador extends Model
{
    use HasFactory;

    public function pais() {
        return $this->belongsTo(Pais::class);
    }
}
