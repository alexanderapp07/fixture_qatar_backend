<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';

    protected $fillable = [
        'campeon_pais_id',
        'usuario_id',
        'informacion'
    ];

    public function usuario() {
        return $this->hasOne(Usuario::class);
    }

    public function favoritos() {
        return $this->belongsToMany(Pais::class);
    }
}
