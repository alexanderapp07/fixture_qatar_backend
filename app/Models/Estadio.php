<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partido;

class Estadio extends Model
{
    use HasFactory;
    protected $table = 'estadios'; 
    public function partidos() {
        return $this->hasMany(Partido::class);
    }
}
