<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Padre;
use App\Models\Curso;
use App\Models\Hijo;
use App\Models\Matricula;
use App\Models\Pago;

class PadreController extends Controller
{
    public function registrarHijo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:8|unique:users',
            'fechaNacimiento' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'partida_nacimiento' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'constancia_estudios' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        try {
            DB::beginTransaction();
            // Crear usuario estudiante
            $user = User::create([
                'name' => $request->name,
                'dni' => $request->dni,
                'fechaNacimiento' => $request->fechaNacimiento,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'idRol' => 3, // Suponiendo que 3 es el idRol de estudiante
                'estadoCuenta' => 'pendiente',
            ]);
            // Guardar archivos
            $partidaPath = $request->file('partida_nacimiento')->store('documentos/estudiantes/partidas', 'public');
            $constanciaPath = $request->file('constancia_estudios')->store('documentos/estudiantes/constancias', 'public');
            // Crear estudiante
            $estudiante = Estudiante::create([
                'id' => $user->id,
                'partidaNacimiento' => $partidaPath,
                'constanciaEstudios' => $constanciaPath,
            ]);
            // Asociar hijo con padre usando el modelo Hijo
            $padre = Auth::user()->padre;
            if ($padre) {
                \App\Models\Hijo::create([
                    'idPadre' => $padre->id,
                    'idEstudiante' => $estudiante->id,
                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Hijo registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            if (isset($partidaPath)) Storage::disk('public')->delete($partidaPath);
            if (isset($constanciaPath)) Storage::disk('public')->delete($constanciaPath);
            return back()->withErrors(['error' => 'Error al registrar hijo: ' . $e->getMessage()])->withInput();
        }
    }
    public function matriculaForm()
    {
        $padre = Auth::user()->padre;
        $hijos = $padre ? $padre->hijos()->with('estudiante.user')->get() : collect();
        // Agrupar cursos por especialidad
        $cursos = Curso::all()->groupBy('especialidad');
        return view('padre.matricula', compact('hijos', 'cursos'));
    }

    public function matricularHijo(Request $request, $idEstudiante)
    {
        $request->validate([
            'fechaMatricula' => 'required|date',
            'cursos' => 'required|array|min:1|max:7',
        ]);

        // Validar plazo de matrícula (opcional, si tienes lógica de plazos)
        // $plazo = PlazoMatricula::first();
        // $hoy = now()->toDateString();
        // if (!$plazo || !$plazo->activo || $hoy < $plazo->fecha_inicio || $hoy > $plazo->fecha_fin) {
        //     return redirect()->back()->withErrors(['matricula' => 'Las matrículas no están habilitadas en este momento.']);
        // }

        // Validar que el estudiante sea hijo del padre autenticado
        $padre = Auth::user()->padre;
        $esHijo = $padre && $padre->hijos()->where('idEstudiante', $idEstudiante)->exists();
        if (!$esHijo) {
            return redirect()->back()->withErrors(['matricula' => 'No puedes matricular a este estudiante.']);
        }

        // Crear la matrícula
        $matricula = Matricula::create([
            'idEstudiante' => $idEstudiante,
            'fechaMatricula' => $request->input('fechaMatricula'),
            'estado' => 'en revisión',
        ]);

        // Asociar los cursos seleccionados
        $matricula->cursos()->attach($request->input('cursos'));

        return redirect()->back()->with('success', 'Matrícula registrada correctamente.');
    }
    public function pagosForm()
    {
        $padre = Auth::user()->padre;
        $hijos = $padre ? $padre->hijos()->with(['estudiante.user','estudiante.matriculas.cursos','estudiante.matriculas.pagos'])->get() : collect();
        return view('padre.pagos', compact('hijos'));
    }
    public function pagar(Request $request, $idMatricula)
    {
        $request->validate([
            'comprobante' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $padre = Auth::user()->padre;
        $matricula = Matricula::findOrFail($idMatricula);
        // Validar que la matrícula pertenezca a un hijo del padre autenticado
        $esHijo = $padre && $padre->hijos()->where('idEstudiante', $matricula->idEstudiante)->exists();
        if (!$esHijo) {
            return redirect()->back()->withErrors(['pago' => 'No puedes pagar la matrícula de este estudiante.']);
        }
        // Si ya existe un pago para esta matrícula, no crear otro
        if ($matricula->pagos()->exists()) {
            return redirect()->back()->withErrors(['pago' => 'Ya existe un pago registrado para esta matrícula.']);
        }
        $total = $matricula->cursos->count() * 7;
        $pago = new Pago();
        $pago->idMatricula = $matricula->idMatricula;
        $pago->cronogramaPago = now()->toDateString();
        $pago->cuota = $total;
        $pago->descuento = 0;
        $pago->estado = 'pendiente';
        $pago->fechaCreacion = now();
        if ($request->hasFile('comprobante')) {
            $comprobantePath = $request->file('comprobante')->store('comprobantes/pagos', 'public');
            $pago->comprobante = $comprobantePath;
        } else {
            $pago->comprobante = '';
        }
        $pago->save();
        // Registrar historial de pago
        \App\Models\HistorialPago::create([
            'idPago' => $pago->idPago,
            'fechaRegistro' => now(),
            'estadoPago' => 'pendiente',
            'observaciones' => 'Pago registrado por el padre',
        ]);
        return redirect()->back()->with('success', 'Pago registrado correctamente. Total: S/ ' . $total . '. Espera la validación del administrador.');
    }
}
