<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pais;

class Confederacion extends Model
{
    use HasFactory;

    public function paises() {
        return $this->hasMany(Pais::class);
    }
}
