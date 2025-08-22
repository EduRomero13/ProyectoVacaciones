<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hijo extends Model
{
    use HasFactory;

    protected $table = 'hijos';
    protected $primaryKey = 'idHijo';
    public $timestamps = false;

    protected $fillable = [
        'idPadre',
        'idEstudiante',
    ];

    public function padre()
    {
        return $this->belongsTo(Padre::class, 'idPadre', 'id');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idEstudiante', 'id');
    }

    public function getNombrePadre()
    {
        return $this->padre->getNombre() ?? 'Sin padre';
    }

    public function getNombreEstudiante()
    {
        return $this->estudiante->getNombre() ?? 'Sin estudiante';
    }

    public function getEmailPadre()
    {
        return $this->padre->getEmail() ?? 'Sin email';
    }

    public function getEmailEstudiante()
    {
        return $this->estudiante->getEmail() ?? 'Sin email';
    }
}