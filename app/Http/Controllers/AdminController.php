<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Role;
use App\Models\Estudiante;
use App\Models\Padre;
use App\Models\Docente;
use App\Models\Curso;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Pago;
use App\Models\Matricula;
use App\Models\Aula;
use App\Models\Horario;

class AdminController extends Controller
{
    public function usersIndex()
    {
        $users = User::with('role')->get();
        return view('admin.users', compact('users'));
    }

    public function usersStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:8|unique:users',
            'fechaNacimiento' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:estudiante,padre,docente',
            'terms' => 'accepted',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'user_type.required' => 'Debe seleccionar un tipo de usuario.',
            'terms.accepted' => 'Debe aceptar los términos y condiciones.',
        ]);

        // Validaciones específicas según el tipo de usuario
        if ($request->user_type === 'estudiante') {
            $request->validate([
                'partida_nacimiento' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'constancia_estudios' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);
        } elseif ($request->user_type === 'padre') {
            $request->validate([
                'nombre_hijo' => 'required|string|max:255',
                'dni_hijo' => 'required|string|max:8',
                'partida_nacimiento_hijo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'ultimos_digitos_tarjeta' => 'nullable|string|size:4|regex:/^[0-9]{4}$/',
            ]);
        } elseif ($request->user_type === 'docente') {
            $request->validate([
                'especialidad' => 'required|string|max:255',
                'titulo_profesional' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'curriculum_vitae' => 'required|file|mimes:pdf|max:5120',
            ]);
        }

        try {
            DB::beginTransaction();
            $roleMap = [
                'estudiante' => 'estudiante',
                'padre' => 'padreFamilia',
                'docente' => 'docente'
            ];
            $role = Role::where('nombreRol', $roleMap[$request->user_type])->first();
            if (!$role) {
                throw new \Exception('Rol no encontrado.');
            }
            $user = User::create([
                'name' => $request->name,
                'dni' => $request->dni,
                'fechaNacimiento' => $request->fechaNacimiento,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'idRol' => $role->idRol,
                'estadoCuenta' => 'pendiente',
            ]);
            if ($request->user_type === 'estudiante') {
                $partidaPath = $request->file('partida_nacimiento')->store('documentos/estudiantes/partidas', 'public');
                $constanciaPath = $request->file('constancia_estudios')->store('documentos/estudiantes/constancias', 'public');
                Estudiante::create([
                    'id' => $user->id,
                    'partidaNacimiento' => $partidaPath,
                    'constanciaEstudios' => $constanciaPath,
                ]);
            } elseif ($request->user_type === 'padre') {
                $partidaHijoPath = $request->file('partida_nacimiento_hijo')->store('documentos/padres/partidas_hijos', 'public');
                Padre::create([
                    'id' => $user->id,
                ]);
                // Aquí podrías guardar info del hijo en otra tabla si lo necesitas
            } elseif ($request->user_type === 'docente') {
                $tituloPath = $request->file('titulo_profesional')->store('documentos/docentes/titulos', 'public');
                $cvPath = $request->file('curriculum_vitae')->store('documentos/docentes/cv', 'public');
                Docente::create([
                    'id' => $user->id,
                    'especialidad' => $request->especialidad,
                    'tituloProfesional' => $tituloPath,
                    'curriculumVitae' => $cvPath,
                ]);
            }
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Usuario registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            if (isset($partidaPath)) Storage::disk('public')->delete($partidaPath);
            if (isset($constanciaPath)) Storage::disk('public')->delete($constanciaPath);
            if (isset($partidaHijoPath)) Storage::disk('public')->delete($partidaHijoPath);
            if (isset($tituloPath)) Storage::disk('public')->delete($tituloPath);
            if (isset($cvPath)) Storage::disk('public')->delete($cvPath);
            return back()->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()])->withInput();
        }
    }

    public function usersVerify(User $user)
    {
        $user->estadoCuenta = 'verificado';
        $user->save();
        return back()->with('success', 'Usuario verificado correctamente.');
    }

    public function usersBlock(User $user)
    {
        $user->estadoCuenta = 'bloqueado';
        $user->save();
        return back()->with('success', 'Usuario bloqueado correctamente.');
    }

    public function cursosIndex()
    {
        $especialidades = [
            'ciencias formales',
            'ciencias naturales',
            'ciencias sociales',
            'ciencias aplicadas',
        ];
        $filtro = request('especialidad');
        $nombreCurso = request('nombre_curso');
        $nombreDocente = request('nombre_docente');
        $query = Curso::with(['docente.user']);
        if ($filtro && in_array($filtro, $especialidades)) {
            $query->where('especialidad', 'like', '%' . $filtro . '%');
        }
        if ($nombreCurso) {
            $query->where('nombre', 'like', '%' . $nombreCurso . '%');
        }
        if ($nombreDocente) {
            $query->whereHas('docente.user', function($q) use ($nombreDocente) {
                $q->where('name', 'like', '%' . $nombreDocente . '%');
            });
        }
        $cursos = $query->paginate(30);
        $docentes = Docente::with('user')->get();
        return view('admin.cursos', compact('cursos', 'docentes', 'especialidades', 'filtro', 'nombreCurso', 'nombreDocente'));
    }

    public function cursosStore(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'especialidad' => 'required|string|max:255',
            'duracion' => 'required|string|max:255',
            'cupoMaximo' => 'required|integer|min:1',
            'idDocente' => 'nullable|exists:docentes,id',
            'idCurso' => 'nullable|integer',
        ]);

        if ($data['idCurso']) {
            // Editar curso existente
            $curso = \App\Models\Curso::find($data['idCurso']);
            if ($curso) {
                $curso->update($data);
                return redirect()->route('admin.cursos.index')->with('success', 'Curso actualizado correctamente.');
            }
        } else {
            // Crear nuevo curso
            \App\Models\Curso::create($data);
            return redirect()->route('admin.cursos.index')->with('success', 'Curso creado correctamente.');
        }
        return redirect()->route('admin.cursos.index')->with('error', 'No se pudo guardar el curso.');
    }

    public function cursosDelete(Request $request, $idCurso)
    {
        $curso = \App\Models\Curso::find($idCurso);
        if ($curso) {
            $curso->delete();
            return back()->with('success', 'Curso eliminado correctamente.');
        }
        return back()->with('error', 'No se encontró el curso.');
    }

    public function pagosIndex()
    {
        $pagos = Pago::with(['matricula.estudiante.user','matricula.cursos'])->get();
        return view('admin.pagos', compact('pagos'));
    }

    public function pagosActualizarEstado(Request $request, $idPago)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,validado,rechazado'
        ]);
        $pago = Pago::findOrFail($idPago);
        $pago->estado = $request->estado;
        $pago->save();
        return back()->with('success','Estado de pago actualizado.');
    }
    
    public function horariosIndex() {
        $cursos = Curso::all();
        $aulas = Aula::all();
        $horarios = Horario::with(['curso', 'aula'])->orderBy('diaSemana')->orderBy('horaInicio')->get();
        return view('admin.horarios', compact('cursos', 'aulas', 'horarios'));
    }

    public function horariosStore(Request $request) {
        // Validar que el curso no tenga ya un horario asignado
        $existeHorario = Horario::where('idCurso', $request->idCurso)->exists();
        if ($existeHorario) {
            return back()->withErrors(['idCurso' => 'Este curso ya tiene un horario asignado.'])->withInput();
        }

        $request->validate([
            'idCurso' => 'required|exists:cursos,idCurso',
            'idAula' => 'required|exists:aulas,idAula',
            'diaSemana' => 'required',
            'horaInicio' => 'required',
            'horaFin' => 'required|after:horaInicio',
        ]);

        $aula = Aula::findOrFail($request->idAula);
        if (!$aula->disponibilidad) {
            return back()->withErrors(['idAula' => 'El aula seleccionada no está disponible para dictar clases.'])->withInput();
        }

        // Validar que el horario esté entre 07:00 y 19:00
        $horaInicio = $request->horaInicio;
        $horaFin = $request->horaFin;
        if ($horaInicio < '07:00' || $horaFin >'19:00') {
            return back()->withErrors(['horaInicio' => 'El horario debe estar entre 07:00 y 19:00.'])->withInput();
        }

        // Validar que la duración del horario coincida con la duración del curso
        $curso = Curso::findOrFail($request->idCurso);
        // Solo permitimos horas exactas, así que tomamos la parte de la hora
        $hInicio = intval(substr($horaInicio, 0, 2));//toma la parte de las horas tomando los dos primeros caracteres de las cadenas (07:00 ->07) y las pasa a entero (intval)
        $hFin = intval(substr($horaFin, 0, 2));
        $diffHoras = $hFin - $hInicio;
        $duracionCurso = intval($curso->duracion);//obtiene en entero el valor de las horas dictadas del curso en la base de datos

        if ($diffHoras !== $duracionCurso) {//compara la diferencia hallada con la duracion actual del curso
            return back()->withErrors(['horaFin' => 'La diferencia entre la hora de inicio y fin debe ser exactamente ' . $curso->duracion . ' horas para este curso.'])->withInput();
        }

        // Validar cruce de horarios en la misma aula
        $cruce = Horario::where('idAula', $request->idAula)
            ->where('diaSemana', $request->diaSemana)
            ->where(function($q) use ($horaInicio, $horaFin) {
                $q->whereBetween('horaInicio', [$horaInicio, $horaFin])
                ->orWhereBetween('horaFin', [$horaInicio, $horaFin])
                ->orWhere(function($q2) use ($horaInicio, $horaFin) {
                    $q2->where('horaInicio', '<', $horaInicio)
                        ->where('horaFin', '>', $horaFin);
                });
            })
            ->exists();
        if ($cruce) {
            return back()->withErrors(['idAula' => 'El aula ya tiene un curso asignado en ese horario.'])->withInput();
        }

        Horario::create($request->all());
        return redirect()->route('admin.horarios.index')->with('success', 'Horario asignado correctamente.');
    }
    
    public function horariosUpdate(Request $request, $idHorario)
    {
        $horario = Horario::findOrFail($idHorario);
        $request->validate([
            'idCurso' => 'required|exists:cursos,idCurso',
            'idAula' => 'required|exists:aulas,idAula',
            'diaSemana' => 'required',
            'horaInicio' => 'required',
            'horaFin' => 'required|after:horaInicio',
        ]);

        $aula = \App\Models\Aula::findOrFail($request->idAula);
        if (!$aula->disponibilidad && $aula->idAula != $horario->idAula) {
            return back()->withErrors(['idAula' => 'El aula seleccionada no está disponible para dictar clases.'])->withInput();
        }

        $horaInicio = $request->horaInicio;
        $horaFin = $request->horaFin;
        if ($horaInicio < '07:00' || $horaFin > '19:00') {
            return back()->withErrors(['horaInicio' => 'El horario debe estar entre 07:00 y 19:00.'])->withInput();
        }

        $curso = \App\Models\Curso::findOrFail($request->idCurso);
        $hInicio = intval(substr($horaInicio, 0, 2));
        $hFin = intval(substr($horaFin, 0, 2));
        $diffHoras = $hFin - $hInicio;
        $duracionCurso = intval($curso->duracion);
        if ($diffHoras !== $duracionCurso) {
            return back()->withErrors(['horaFin' => 'La diferencia entre la hora de inicio y fin debe ser exactamente ' . $curso->duracion . ' horas para este curso.'])->withInput();
        }

        // Validar cruce de horarios en la misma aula (excluyendo el actual)
        $cruce = Horario::where('idAula', $request->idAula)
            ->where('diaSemana', $request->diaSemana)
            ->where('idHorario', '!=', $horario->idHorario)
            ->where(function($q) use ($horaInicio, $horaFin) {
                $q->whereBetween('horaInicio', [$horaInicio, $horaFin])
                ->orWhereBetween('horaFin', [$horaInicio, $horaFin])
                ->orWhere(function($q2) use ($horaInicio, $horaFin) {
                    $q2->where('horaInicio', '<', $horaInicio)
                        ->where('horaFin', '>', $horaFin);
                });
            })
            ->exists();
        if ($cruce) {
            return back()->withErrors(['idAula' => 'El aula ya tiene un curso asignado en ese horario.'])->withInput();
        }

        $horario->update($request->all());
        return redirect()->route('admin.horarios.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function horariosDelete($idHorario)
    {
        $horario = Horario::findOrFail($idHorario);
        $horario->delete();
        return redirect()->route('admin.horarios.index')->with('success', 'Horario eliminado correctamente.');
    }
}
