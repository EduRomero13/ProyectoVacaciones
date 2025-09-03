<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlazoMatricula extends Model
{
    protected $table = 'plazo_matricula';
    public $timestamps = false;
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];
}
