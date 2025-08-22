<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'aulas'; 

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idAula';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'descripcion',
        'disponibilidad',
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'idAula', 'idAula');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'disponibilidad' => 'boolean',
    ];

    public function getDisponibilidad(){
        return $this->disponibilidad;
    }

    /**
     * Marcar aula como disponible
     *
     * @return bool
     */
    public function marcarDisponible()
    {
        return $this->update(['disponibilidad' => 1]);
    }

    /**
     * Marcar aula como ocupada
     *
     * @return bool
     */
    public function marcarOcupada()
    {
        return $this->update(['disponibilidad' => 0]);
    }

    /**
     * Scope para obtener solo aulas disponibles
     */
    public function scopeAulasDisponibles($query)
    {
        return $query->where('disponibilidad', 1);
    }

    /**
     * Scope para obtener solo aulas ocupadas
     */
    public function scopeAulasOcupadas($query)
    {
        return $query->where('disponibilidad', 0);
    }
}