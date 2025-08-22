<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculaCurso extends Model
{
    use HasFactory;
    protected $table='matricula_curso';
    public $incrementing=false;
    public $timestamps=false;
    protected $primaryKey=['idMatricula','idCurso'];

    protected $fillable =[
        'idMatricula',
        'idCurso'
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'idMatricula', 'idMatricula');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'idCurso');
    }

    public function getNombreCurso()
    {
        return $this->curso ? $this->curso->getNombre() : 'Sin curso';
    }

    public function getNombreEstudiante()
    {
        return $this->matricula ? $this->matricula->getNombreEstudiante() : 'Sin estudiante';
    }

}
