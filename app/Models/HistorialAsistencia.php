<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialAsistencia extends Model
{
    use HasFactory;

    protected $table = 'historial_asistencias';
    protected $primaryKey = 'idHistorialAsistencia';
    public $timestamps = false;

    protected $fillable = [
        'idAsistencia',
        'observaciones',
        'fechaModificacion',
    ];

    protected $casts = [
        'fechaModificacion' => 'datetime',
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'idAsistencia', 'idAsistencia');
    }

    public function getNombreEstudiante()
    {
        return $this->asistencia ? $this->asistencia->getNombreEstudiante() : 'Sin estudiante';
    }

    public function getNombreCurso()
    {
        return $this->asistencia ? $this->asistencia->getNombreCurso() : 'Sin curso';
    }

    public function getObservaciones()
    {
        return $this->observaciones ?? 'Sin observaciones';
    }

    public function scopePorAsistencia($query, $idAsistencia)
    {
        return $query->where('idAsistencia', $idAsistencia);
    }
}