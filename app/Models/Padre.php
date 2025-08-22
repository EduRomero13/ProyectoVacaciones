<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    use HasFactory;

    protected $table = 'padres';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    // Agregar relación con hijos
    public function hijos()
    {
        return $this->hasMany(Hijo::class, 'idPadre', 'id');
    }

    // Relación indirecta con estudiantes a través de hijos
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'hijos', 'idPadre', 'idEstudiante');
        //belongstomany porque es una relacion de muchos a muchos, un estudiante puede tener padre y madre
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