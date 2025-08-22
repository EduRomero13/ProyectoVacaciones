<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';
    protected $primaryKey = 'idAsistencia';
    public $timestamps = false;

    protected $fillable = [
        'idEstudiante',
        'idCurso',
        'fecha',
        'estado',
        'fechaRegistro',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fechaRegistro' => 'datetime',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idEstudiante', 'id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'idCurso');
    }

    public function historial()
    {
        return $this->hasMany(HistorialAsistencia::class, 'idAsistencia', 'idAsistencia');
    }

    public function ultimoHistorial()
    {
        return $this->hasOne(HistorialAsistencia::class, 'idAsistencia', 'idAsistencia')
                    ->orderBy('fechaModificacion', 'desc');
    }

    public function getNombreEstudiante()
    {
        return $this->estudiante ? $this->estudiante->getNombre() : 'Sin estudiante';
    }

    public function getNombreCurso()
    {
        return $this->curso ? $this->curso->getNombre() : 'Sin curso';
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function scopePorEstudiante($query, $idEstudiante)
    {
        return $query->where('idEstudiante', $idEstudiante);
    }

    public function scopePorCurso($query, $idCurso)
    {
        return $query->where('idCurso', $idCurso);
    }

    public function scopePorFecha($query, $fecha)
    {
        return $query->where('fecha', $fecha);
    }

    public function scopeAsistieron($query)
    {
        return $query->where('estado', 'asistió');
    }

    public function scopeFaltaron($query)
    {
        return $query->where('estado', 'faltó');
    }

    public function scopeTardanzas($query)
    {
        return $query->where('estado', 'tardanza');
    }

    public function scopeEntreFechas($query, $fechaInicio, $fechaFin)
    {
        return $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
    }

    public function scopeEsteMes($query)
    {
        return $query->whereMonth('fecha', now()->month)
                    ->whereYear('fecha', now()->year);
    }
}