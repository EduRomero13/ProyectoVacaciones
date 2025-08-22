<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    protected $primaryKey = 'idHorario';
    public $timestamps = false;

    protected $fillable = [
        'idCurso',
        'diaSemana',
        'horaInicio',
        'horaFin',
        'idAula',
    ];

    protected $casts = [
        'horaInicio' => 'datetime:H:i',
        'horaFin' => 'datetime:H:i',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'idCurso');
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'idAula', 'idAula');
    }

    public function getNombreCurso()
    {
        return $this->curso ? $this->curso->getNombre() : 'Sin curso';
    }

    public function getDescripcionAula()
    {
        return $this->aula ? $this->aula->descripcion : 'Sin aula';
    }

    public function getDuracionHoras()
    {
        $inicio = \Carbon\Carbon::parse($this->horaInicio);
        $fin = \Carbon\Carbon::parse($this->horaFin);
        return $fin->diffInHours($inicio);
    }

    /**
     * QUERY SCOPES
     * 
     * $query = Instancia del Query Builder de Laravel que se pasa automáticamente
     * - Representa la consulta SQL en construcción
     * - Permite agregar condiciones WHERE, JOIN, ORDER BY, etc.
     * - Se puede encadenar con otros scopes
     * 
     * Uso: Horario::porDia('lunes')->porAula(5)->get()
     * SQL: SELECT * FROM horarios WHERE diaSemana = 'lunes' AND idAula = 5
     */
    //Obtiene todos los horarios por día
    public function scopePorDia($query, $dia)
    {
        return $query->where('diaSemana', $dia);
        // $query = Query Builder automático
        // $dia = parámetro personalizado
    }

    //Obtiene horarios por aula
    public function scopePorAula($query, $idAula)
    {
        return $query->where('idAula', $idAula);
        // $query = Query Builder automático
        // $idAula = parámetro personalizado
    }

    //HACER FUNCION PARA OBTENER LA DISPONIBILIDAD DE UN AULA DE ACUERDO AL HORARIO (RESIVIENDO COMO PARAMETRO LA HORA DE INICIO Y FIN)
}