<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'especialidad',
        'tituloProfesional',
        'curriculumVitae',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function cursos(){
        return $this->hasMany(Curso::class,'idDocente','id');
    }

    
    /**
     * Explicación:
     * hasMany = "Un docente TIENE MUCHOS cursos"
     * 'idDocente' = Foreign key en la tabla cursos (donde están los cursos)
     * 'id' = Primary key en la tabla docentes (donde estoy parado)
     */

    /**
     * La regla:
     * hasMany: ('ModeloHijo', 'foreign_key_en_tabla_hija', 'mi_primary_key')
     * belongsTo: ('ModeloPadre', 'mi_foreign_key', 'primary_key_en_tabla_padre')
     */


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

    public function scopePorEspecialidad($query, $especialidad)
    {
        return $query->where('especialidad', $especialidad);
    }
    
}