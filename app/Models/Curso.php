<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $primaryKey = 'idCurso';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'especialidad',
        'duracion',
        'cupoMaximo',
        'idDocente',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'idDocente', 'id');
        //con belongsto un registro pertenece a un solo registro en la otra tabla, en este caso: UN CURSO SOLO PUEDE ESTAR ASIGNADO A UN SOLO DOCENTE
    }

    /**
     * belongsTo = "Un curso PERTENECE A un docente"
     * 'idDocente' = Foreign key en la tabla cursos (donde estoy parado)
     * 'id' = Primary key en la tabla docentes (donde apunto)
     */

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'idCurso', 'idCurso');
    }

    public function matriculas()
    {
        return $this->belongsToMany(Matricula::class, 'matricula_curso', 'idCurso', 'idMatricula');
        //con belongstomany un registro puede relacionarse con múltiples registros de otra tabla (requiere de una tabla intermedia)
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'idCurso', 'idCurso');
    }

    public function getNombre()
    {
        return $this->nombre ?? 'Sin nombre';
    }

    public function getDescripcion()
    {
        return $this->descripcion ?? 'Sin descripción';
    }

    public function tieneDocente()
    {
        return $this->idDocente !== null;
    }

    public function scopePorEspecialidad($query, $especialidad)
    {
        return $query->where('especialidad', $especialidad);
    }

    public function scopeConDocente($query)
    {
        return $query->whereNotNull('idDocente');
    }

    public function scopeSinDocente($query)
    {
        return $query->whereNull('idDocente');
    }
}