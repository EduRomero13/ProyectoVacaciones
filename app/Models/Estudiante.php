<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'partidaNacimiento',
        'constanciaEstudios',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function padres()
    {
        return $this->belongsToMany(Padre::class, 'hijos', 'idEstudiante', 'idPadre');
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'idEstudiante', 'id');
    }


    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'idEstudiante', 'id');
    }

    public function getNombre()
    {
        return $this->user->name ?? 'Sin nombre';
    }

    public function getEmail()
    {
        return $this->user->email ?? 'Sin email';
    }

    public function getDni()
    {
        return $this->user->dni ?? 'Sin DNI';
    }
    public function scopeVerificados($query)
    {
        return $query->whereHas('user', function($query) {
            $query->where('estadoCuenta', 'verificado');
        });
    }

    public function scopePendientes($query)
    {
        return $query->whereHas('user', function($query) {
            $query->where('estadoCuenta', 'pendiente');
        });
    }

    public function scopeBloqueados($query)
    {
        return $query->whereHas('user', function($query) {
            $query->where('estadoCuenta', 'bloqueado');
        });
    }
}