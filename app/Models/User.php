<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'dni',
        'fechaNacimiento',
        'email',
        'password',
        'estadoCuenta',
        'idRol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'fechaNacimiento' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * RELACIONES CON OTRAS TABLAS
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'idRol', 'idRol');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'id', 'id');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'id', 'id');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id', 'id');
    }

    public function padre()
    {
        return $this->hasOne(Padre::class, 'id', 'id');
    }



    /**
     * Verificar si el usuario tiene un rol específico (RETORNA TRUE/FALSE)
     */
    public function hasRole($role)
    {
        return $this->role && $this->role->nombreRol === $role;
    }

    /**
     * Verificar si es administrador (RETORNA TRUE/FALSE)
     */
    public function esAdmin()
    {
        return $this->hasRole('administrador');
    }

    /**
     * Verificar si es docente
     */
    public function esDocente()
    {
        return $this->hasRole('docente');
    }

    /**
     * Verificar si es estudiante
     */
    public function esEstudiante()
    {
        return $this->hasRole('estudiante');
    }

    /**
     * Verificar si es padre de familia
     */
    public function esPadreFamilia()
    {
        return $this->hasRole('padreFamilia');
    }

    /**
     * Retornar el estado del usuario
     */
    public function getEstado(){
        return $this->estadoCuenta;
    }
}