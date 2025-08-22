<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'idPago';
    public $timestamps = false;

    protected $fillable = [
        'idMatricula',
        'cronogramaPago',
        'cuota',
        'descuento',
        'comprobante',
        'estado',
        'fechaCreacion',
    ];

    protected $casts = [
        'cronogramaPago' => 'date',
        'fechaCreacion' => 'datetime',
        'cuota' => 'decimal:2',
        'descuento' => 'decimal:2',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'idMatricula', 'idMatricula');
    }

    public function historial()
    {
        return $this->hasMany(HistorialPago::class, 'idPago', 'idPago');
    }

    public function ultimoHistorial()
    {
        return $this->hasOne(HistorialPago::class, 'idPago', 'idPago')
                    ->orderBy('fechaRegistro', 'desc');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'idPago', 'idPago');
    }

    public function ultimoReporte()
    {
        return $this->hasOne(Reporte::class, 'idPago', 'idPago')
                    ->orderBy('fechaGeneracion', 'desc');
    }

    public function getNombreEstudiante()
    {
        return $this->matricula ? $this->matricula->getNombreEstudiante() : 'Sin estudiante';
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getMontoTotal()
    {
        return $this->cuota - $this->descuento;
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeValidados($query)
    {
        return $query->where('estado', 'validado');
    }

    public function scopeRechazados($query)
    {
        return $query->where('estado', 'rechazado');
    }

    public function scopeVencidos($query)
    {
        return $query->where('cronogramaPago', '<', now()->toDateString())
                    ->where('estado', 'pendiente');
    }

    public function scopePorMatricula($query, $idMatricula)
    {
        return $query->where('idMatricula', $idMatricula);
    }
}