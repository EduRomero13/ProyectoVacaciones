<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';
    protected $primaryKey = 'idMatricula';
    public $timestamps = false;

    protected $fillable = [
        'idEstudiante',
        'fechaMatricula',
        'estado',
    ];

    protected $casts = [
        'fechaMatricula' => 'datetime',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idEstudiante', 'id');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'matricula_curso', 'idMatricula', 'idCurso');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'idMatricula', 'idMatricula');
    }

    public function getNombreEstudiante()
    {
        return $this->estudiante ? $this->estudiante->getNombre() : 'Sin estudiante';
    }

    public function getEmailEstudiante()
    {
        return $this->estudiante ? $this->estudiante->getEmail() : 'Sin email';
    }

    public function getEstado(){
        return $this->estado;//accede a la instancia actual del objeto
    }

    /**
     * QUERY SCOPES
     * $query = Query Builder que construye consultas SQL
     * Uso: Matricula::enRevision()->get()
     */
    public function scopeEnRevision($query)
    {
        return $query->where('estado', 'en revisión');
    }

    public function scopeAprobadas($query)
    {
        return $query->where('estado', 'aprobada');
    }

    public function scopeRechazadas($query)
    {
        return $query->where('estado', 'rechazada');
    }

    public function scopePorEstudiante($query, $idEstudiante)
    {
        return $query->where('idEstudiante', $idEstudiante);
    }

    /**
     * QUERY SCOPES - Filtros reutilizables para consultas
     * 
     * ¿Qué es un Query Builder?
     * Es una herramienta de Laravel que construye consultas SQL de forma programática
     * usando PHP en lugar de escribir SQL puro.
     * 
     * Analogía simple:
     * Imagina que construyes una oración palabra por palabra:
     * 
     * // En lugar de escribir toda la oración de una vez:
     * "SELECT * FROM matriculas WHERE estado = 'aprobada' AND idEstudiante = 5"
     * 
     * // El Query Builder te permite construirla paso a paso:
     * $query = "SELECT * FROM matriculas"        // Base
     * $query = $query + "WHERE estado = 'aprobada'"  // Agregar condición
     * $query = $query + "AND idEstudiante = 5"       // Agregar otra condición
     * 
     * Ejemplo práctico:
     * 
     * Sin Query Builder (SQL puro):
     * // ❌ Difícil de mantener y propenso a errores
     * $sql = "SELECT * FROM matriculas WHERE estado = 'aprobada' AND idEstudiante = ?";
     * $result = DB::select($sql, [5]);
     * 
     * Con Query Builder:
     * // ✅ Más legible y seguro
     * $matriculas = Matricula::where('estado', 'aprobada')
     *                        ->where('idEstudiante', 5)
     *                        ->get();
     * 
     * Con Scopes (aún mejor):
     * // ✅ Más expresivo y reutilizable
     * $matriculas = Matricula::aprobadas()->porEstudiante(5)->get();
     * 
     * $query = Parámetro que va construyendo la consulta SQL paso a paso
     */


}