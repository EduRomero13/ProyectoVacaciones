<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

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

    // Obtener el ID del estudiante (ajusta según tu lógica de autenticación)
    $idEstudiante = Auth::user()->id;

    // Crear la matrícula
    $matricula = \App\Models\Matricula::create([
        'idEstudiante' => $idEstudiante,
        'fechaMatricula' => $request->input('fechaMatricula'),
        'estado' => 'en revisión',
    ]);

    // Asociar los cursos seleccionados
    $matricula->cursos()->attach($request->input('cursos'));

    // Redirigir o mostrar mensaje
    return redirect()->back()->with('success', 'Matrícula registrada correctamente.');
}

}
