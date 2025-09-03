<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use App\Models\PlazoMatricula;
use App\Models\Matricula;

class MatriculaController extends Controller
{
    public function show (){
        $formales = Curso::where('especialidad','like','%ciencias formales%')->get();
        $naturales = Curso::where('especialidad','like','%ciencias naturales%')->get();
        $sociales = Curso::where('especialidad','like','%ciencias sociales%')->get();
        $aplicadas = Curso::where('especialidad','like','%ciencias aplicadas%')->get();
        return view('estudiante.matricula', compact('formales','naturales','sociales','aplicadas')); //cuando se pasa cursos a la vista matricula, se está pasando un objeto de tipo colección, el cual puede recorerse usando @foreach ($cursos as $curso) y tambien se puede acceder a sus propiedades como $curso->nombre
    }

    public function matricular(Request $request)
{
    // Validar datos
    $request->validate([
        'fechaMatricula' => 'required|date',
        'cursos' => 'required|array|min:1|max:7',
    ]);

    // Validar plazo de matrícula
    $plazo = PlazoMatricula::first();
    $hoy = now()->toDateString();
    if (!$plazo || !$plazo->activo || $hoy < $plazo->fecha_inicio || $hoy > $plazo->fecha_fin) {
        return redirect()->back()->withErrors(['matricula' => 'Las matrículas no están habilitadas en este momento.']);
    }

    // Validar que el estudiante esté verificado
    $user = Auth::user();
    $estudiante = $user->estudiante;
    if (!$estudiante || $user->estadoCuenta !== 'verificado') {
        return redirect()->back()->withErrors(['matricula' => 'Solo los estudiantes verificados pueden matricularse.']);
    }

    // Crear la matrícula
    $matricula = \App\Models\Matricula::create([
        'idEstudiante' => $user->id,
        'fechaMatricula' => $request->input('fechaMatricula'),
        'estado' => 'en revisión',
    ]);

    // Asociar los cursos seleccionados
    $matricula->cursos()->attach($request->input('cursos'));

    // Redirigir o mostrar mensaje
    return redirect()->back()->with('success', 'Matrícula registrada correctamente.');
}

// Vista para el admin: administrar matrículas
    public function adminIndex() {
        $plazo = PlazoMatricula::first();
        $matriculas = Matricula::with(['estudiante', 'cursos'])->get();
        return view('admin.matriculas', compact('plazo', 'matriculas'));
    }

    // Guardar plazo de matrícula
    public function guardarPlazo(Request $request) {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        $plazo = PlazoMatricula::first();
        if (!$plazo) $plazo = new PlazoMatricula();
        $plazo->fecha_inicio = $request->fecha_inicio;
        $plazo->fecha_fin = $request->fecha_fin;
        $plazo->activo = $request->has('activo');
        $plazo->save();
        return redirect()->back()->with('success', 'Plazo actualizado');
    }

    // Editar estado de matrícula
    public function actualizarEstado(Request $request, $id) {
        $request->validate([
            'estado' => 'required|in:pendiente,aprobada,rechazada',
        ]);
        $matricula = Matricula::findOrFail($id);
        $matricula->estado = $request->estado;
        $matricula->save();
        return redirect()->back()->with('success', 'Estado actualizado');
    }
}
