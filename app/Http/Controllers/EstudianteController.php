<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Matricula;
use App\Models\Horario;
use Carbon\Carbon;

class EstudianteController extends Controller
{
    public function horario()
    {
        $estudiante = Auth::user()->estudiante;
        // Obtener todas las matrículas aprobadas del estudiante
        $matriculas = $estudiante->matriculas()->where('estado', 'aprobada')->get();
        $cursos = collect();
        foreach ($matriculas as $matricula) {
            $cursos = $cursos->merge($matricula->cursos);
        }
        // Solo cursos con horario definido
        $cursos = $cursos->unique('idCurso')->filter(function($curso) {
            return $curso->horarios->count() > 0;
        });
        // Obtener todos los horarios de los cursos
        $horarios = collect();
        foreach ($cursos as $curso) {
            foreach ($curso->horarios as $horario) {
                $horarios->push([
                    'curso' => $curso,
                    'horario' => $horario,
                ]);
            }
        }
        // Pasar los datos a la vista
        return view('estudiante.horario', compact('horarios'));
    }
}
