<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';
    protected $primaryKey = 'idReporte';
    public $timestamps = false;

    protected $fillable = [
        'idPago',
        'estado',
        'fechaGeneracion',
        'fechaActualizacion',
    ];

    protected $casts = [
        'fechaGeneracion' => 'datetime',
        'fechaActualizacion' => 'datetime',
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'idPago', 'idPago');
    }

    public function getNombreEstudiante()
    {
        return $this->pago ? $this->pago->getNombreEstudiante() : 'Sin estudiante';
    }

    public function getEstado()
    {
        return $this->estado;
    }
    
    public function scopePorPago($query, $idPago)
    {
        return $query->where('idPago', $idPago);
    }

    public function scopeGenerados($query)
    {
        return $query->where('estado', 'generado');
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeEnviados($query)
    {
        return $query->where('estado', 'enviado');
    }

    public function scopeRevisados($query)
    {
        return $query->where('estado', 'revisado');
    }

    public function scopeAprobados($query)
    {
        return $query->where('estado', 'aprobado');
    }

    public function scopeRechazados($query)
    {
        return $query->where('estado', 'rechazado');
    }

    public function scopeFinalizados($query)
    {
        return $query->where('estado', 'finalizado');
    }

    public function scopeAnulados($query)
    {
        return $query->where('estado', 'anulado');
    }

    public function scopeRecientes($query, $dias = 30)
    {
        return $query->where('fechaGeneracion', '>=', now()->subDays($dias));
    }

    public function scopeOrdenadoPorFecha($query, $orden = 'desc')
    {
        return $query->orderBy('fechaGeneracion', $orden);
    }
}