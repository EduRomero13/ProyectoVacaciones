<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use Carbon\Carbon;

class DocenteController extends Controller
{
    public function horario()
    {
        $docente = Auth::user()->docente;
        // Obtener todos los cursos asignados al docente
        $cursos = $docente->cursos()->with(['horarios', 'matriculas'])->get();
        // Solo cursos con horario definido
        $cursos = $cursos->filter(function($curso) {
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
        return view('docente.horario', compact('horarios'));
    }
    public function pagos()
    {
        $docente = Auth::user()->docente;
        $cursos = $docente->cursos()->with('horarios')->get();
        // Solo cursos con al menos un horario definido
        $cursos = $cursos->filter(function($curso) {
            return $curso->horarios->count() > 0;
        });
        return view('docente.pagos', compact('cursos'));
    }
}
