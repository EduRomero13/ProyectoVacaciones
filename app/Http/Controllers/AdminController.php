<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Role;
use App\Models\Estudiante;
use App\Models\Padre;
use App\Models\Docente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
}
