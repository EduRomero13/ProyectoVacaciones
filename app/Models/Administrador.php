<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores'; // o 'ADMINISTRADORES' según tu nomenclatura

    /**
     * PROPIEDAD PROTEGIDA: Define cuál es la clave primaria de la tabla
     * En este caso es 'id' que también es foreign key hacia users
     */
    protected $primaryKey = 'id';

    /**
     * PROPIEDAD PÚBLICA: Controla si Laravel maneja created_at y updated_at automáticamente
     * false = No usar timestamps automáticos (la tabla no tiene estos campos)
     */
    public $timestamps = false;

    /**
     * PROPIEDAD PÚBLICA: Indica que la clave primaria NO es auto-incrementable
     * false = Porque el ID viene de la tabla users (relación 1:1)
     */
    public $incrementing = false;

    /**
     * ARRAY PROTEGIDO: Define qué campos se pueden llenar masivamente
     * En este caso solo el id (que viene de users)
     */
    protected $fillable = [
        'id',
    ];

    /**
     * RELACIÓN: Un administrador pertenece a un usuario (1:1)
     * belongsTo = El administrador "pertenece a" un usuario
     * 'id' = foreign key en tabla administradores
     * 'id' = primary key en tabla users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * MÉTODO PÚBLICO: Obtener el nombre del administrador desde la tabla users
     * $this->user = Accede a la relación user()
     * ->name = Obtiene el campo name del usuario relacionado
     * ?? 'Sin nombre' = Operador null coalescing (si es null, devuelve 'Sin nombre')
     */
    public function getNombre()
    {
        return $this->user->name ?? 'Sin nombre';
    }

    /**
     * MÉTODO PÚBLICO: Obtener el email del administrador desde la tabla users
     * Mismo concepto que getNombre() pero para email
     */
    public function getEmail()
    {
        return $this->user->email ?? 'Sin email';
    }

}