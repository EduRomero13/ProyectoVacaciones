<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPago extends Model
{
    use HasFactory;

    protected $table = 'historial_pagos';
    protected $primaryKey = 'idHistorialPago';
    public $timestamps = false;

    protected $fillable = [
        'idPago',
        'fechaRegistro',
        'estadoPago',
        'observaciones',
    ];

    protected $casts = [
        'fechaRegistro' => 'datetime',
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'idPago', 'idPago');
    }

    public function getNombreEstudiante()
    {
        return $this->pago ? $this->pago->getNombreEstudiante() : 'Sin estudiante';
    }

    public function getEstadoPago()
    {
        return $this->estadoPago;
    }

    public function getObservaciones()
    {
        return $this->observaciones ?? 'Sin observaciones';
    }

    public function scopePorPago($query, $idPago)
    {
        return $query->where('idPago', $idPago);
    }

    public function scopePendientes($query)
    {
        return $query->where('estadoPago', 'pendiente');
    }

    public function scopeValidados($query)
    {
        return $query->where('estadoPago', 'validado');
    }

    public function scopeRechazados($query)
    {
        return $query->where('estadoPago', 'rechazado');
    }

    public function scopeRecientes($query, $dias = 30)
    {
        return $query->where('fechaRegistro', '>=', now()->subDays($dias));
    }

    public function scopeOrdenadoPorFecha($query, $orden = 'desc')
    {
        return $query->orderBy('fechaRegistro', $orden);
    }
}