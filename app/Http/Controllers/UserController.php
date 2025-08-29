<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Estudiante;
use App\Models\Padre;
use App\Models\Docente;
use App\Models\EmailVerificationToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailBeforeRegistration;

class UserController extends Controller

{
    public function verificalogin(Request $request){ 

        $data=request()->validate([
            'email'=>'required',
            'password'=>'required'
        ],
        [
            'email.required'=>'Ingrese Usuario',
            'password.required'=>'Ingrese contraseña',
        ]);
        // Buscar usuario por email
        $user = User::where('email', $request->email)->first();

        // Verificar si el usuario existe
        if (!$user) {
            return back()->withErrors([
                'email' => 'No existe una cuenta con este email'
            ])->withInput($request->only('email'));
        }

        // Verificar estado de la cuenta
        if ($user->estadoCuenta !== 'verificado') {
            $mensaje = match($user->estadoCuenta) {
                'pendiente' => 'Su cuenta está pendiente de verificación por el administrador',
                'rechazado' => 'Su cuenta ha sido rechazada. Contacte al administrador',
                default => 'Su cuenta no está activa'
            };
            
            return back()->withErrors([
                'email' => $mensaje
            ])->withInput($request->only('email'));
        }

        if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'password' => 'Contraseña incorrecta'
        ])->withInput($request->only('email'));
        }

        // Autenticar al usuario
        Auth::login($user);
        // Auth y sesiones en Laravel:
        // - Auth es una fachada que permite gestionar la autenticación de usuarios.
        // - Auth::user() retorna el usuario autenticado actualmente (o null si no hay sesión activa).
        // - Auth::check() retorna true si hay un usuario autenticado.
        // - Cuando un usuario inicia sesión, Laravel almacena su información en la sesión.
        // - Las sesiones permiten mantener el estado del usuario entre peticiones HTTP.
        // - Usar Auth junto con middleware permite proteger rutas y filtrar acceso según el rol del usuario.
        // - Ejemplo: if (!Auth::check() || !Auth::user()->hasRole($role)) { abort(403); }
        
        // Regenerar sesión por seguridad
        $request->session()->regenerate();
        
        return redirect()->intended('/perfil');
    }
    public function salir(Request $request){ 
        Auth::logout();
        $request->session()->invalidate(); // Invalidar sesión
        $request->session()->regenerateToken(); // Regenerar token CSRF
        return redirect('/');
    }

    public function verifyEmailExists(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Debe ser un email válido.',
            'email.unique' => 'Este email ya está registrado.',
        ]);

        try {
            //Guardar todos los datos ingresados antes de mandar el correo
            $formData = $request->except(['_token', 'password', 'password_confirmation']);
            session(['pending_registration_data' => $formData]);
            
            // También guardar la contraseña de forma segura (hasheada temporalmente)
            if ($request->has('password')) {
                session(['pending_registration_password' => $request->password]);
            }

            // Generar token único
            $token = Str::random(60);
            
            // Eliminar tokens anteriores del mismo email
            EmailVerificationToken::where('email', $request->email)->delete();
            
            // Crear nuevo token
            $verificationToken = EmailVerificationToken::create([
                'email' => $request->email,
                'token' => $token,
                'verified' => false,
                'expires_at' => now()->addMinutes(30), // Expira en 30 minutos
            ]);

            // Enviar correo
            Mail::to($request->email)->send(new VerifyEmailBeforeRegistration($verificationToken));

            return response()->json([
                'success' => true,
                'message' => 'Hemos enviado un correo de verificación a tu email. Revisa tu bandeja de entrada.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el correo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verificar token desde el correo
     */
    public function verifyEmailToken($token)
    {
        $verificationToken = EmailVerificationToken::where('token', $token)->first();

        if (!$verificationToken) {
            return redirect()->route('registrar')->with('error', 'Token de verificación inválido.');
        }

        if ($verificationToken->isExpired()) {
            return redirect()->route('registrar')->with('error', 'El token de verificación ha expirado.');
        }

        if ($verificationToken->verified) {
            return redirect()->route('registrar')->with('error', 'Este email ya ha sido verificado.');
        }

        // Marcar como verificado
        $verificationToken->update(['verified' => true]);

        // Obtener los datos guardados en sesión
        $formData = session('pending_registration_data', []);

        // Redirigir al formulario con el email verificado
        return redirect()->route('registrar')->with([
            'email_verified' => true,
            'verified_email' => $verificationToken->email,
            'success' => '¡Email verificado exitosamente! Ahora puedes completar tu registro.',
            'form_data'=> $formData
        ]);
    }

    public function registrar(Request $request)
    {
        // Validaciones básicas
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

        $emailToken = EmailVerificationToken::where('email', $request->email)
                                       ->where('verified', true)
                                       ->first();
        if (!$emailToken) {
            return back()->withErrors(['email' => 'Debe verificar su email antes de registrarse.'])->withInput();
        }
        // Validaciones específicas según el tipo de usuario
        if ($request->user_type === 'estudiante') {
            $request->validate([
                'partida_nacimiento' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'constancia_estudios' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ], [
                'partida_nacimiento.required' => 'La partida de nacimiento es obligatoria.',
                'constancia_estudios.required' => 'La constancia de estudios es obligatoria.',
                'partida_nacimiento.max' => 'La partida de nacimiento no debe pesar más de 5MB.',
                'constancia_estudios.max' => 'La constancia de estudios no debe pesar más de 5MB.',
            ]);
        } elseif ($request->user_type === 'padre') {
            $request->validate([
                'nombre_hijo' => 'required|string|max:255',
                'dni_hijo' => 'required|string|max:8',
                'partida_nacimiento_hijo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'ultimos_digitos_tarjeta' => 'nullable|string|size:4|regex:/^[0-9]{4}$/',
            ], [
                'nombre_hijo.required' => 'El nombre del hijo es obligatorio.',
                'dni_hijo.required' => 'El DNI del hijo es obligatorio.',
                'partida_nacimiento_hijo.required' => 'La partida de nacimiento del hijo es obligatoria.',
                'partida_nacimiento_hijo.max' => 'La partida de nacimiento del hijo no debe pesar más de 5MB.',
                'ultimos_digitos_tarjeta.regex' => 'Los últimos 4 dígitos deben ser números.',
            ]);
        } elseif ($request->user_type === 'docente') {
            $request->validate([
                'especialidad' => 'required|string|max:255',
                'titulo_profesional' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'curriculum_vitae' => 'required|file|mimes:pdf|max:5120',
            ], [
                'especialidad.required' => 'La especialidad es obligatoria.',
                'titulo_profesional.required' => 'El título profesional es obligatorio.',
                'curriculum_vitae.required' => 'El curriculum vitae es obligatorio.',
                'titulo_profesional.max' => 'El título profesional no debe pesar más de 5MB.',
                'curriculum_vitae.max' => 'El curriculum vitae no debe pesar más de 5MB.',
                'curriculum_vitae.mimes' => 'El curriculum vitae debe ser un archivo PDF.',
            ]);
        }

        try {
            DB::beginTransaction();

            // Obtener el rol según el tipo de usuario
            $roleMap = [
                'estudiante' => 'estudiante',
                'padre' => 'padreFamilia',
                'docente' => 'docente'
            ];

            $role = Role::where('nombreRol', $roleMap[$request->user_type])->first();
            if (!$role) {
                throw new \Exception('Rol no encontrado.');
            }

            // Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'dni' => $request->dni,
                'fechaNacimiento' => $request->fechaNacimiento,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'idRol' => $role->idRol,
                'estadoCuenta' => 'pendiente', // Pendiente de verificación por el administrador
            ]);

            // Crear el registro específico según el tipo de usuario
            if ($request->user_type === 'estudiante') {
                // Guardar archivos
                $partidaPath = $request->file('partida_nacimiento')->store('documentos/estudiantes/partidas', 'public');
                $constanciaPath = $request->file('constancia_estudios')->store('documentos/estudiantes/constancias', 'public');

                Estudiante::create([
                    'id' => $user->id,
                    'partidaNacimiento' => $partidaPath,
                    'constanciaEstudios' => $constanciaPath,
                ]);

            } elseif ($request->user_type === 'padre') {
                // Guardar archivo
                $partidaHijoPath = $request->file('partida_nacimiento_hijo')->store('documentos/padres/partidas_hijos', 'public');

                Padre::create([
                    'id' => $user->id,
                ]);

                // Aquí podrías crear un registro temporal para el hijo que será validado después
                // por ahora guardamos la información en un campo JSON o tabla temporal

            } elseif ($request->user_type === 'docente') {
                // Guardar archivos
                $tituloPath = $request->file('titulo_profesional')->store('documentos/docentes/titulos', 'public');
                $cvPath = $request->file('curriculum_vitae')->store('documentos/docentes/cv', 'public');

                Docente::create([
                    'id' => $user->id,
                    'especialidad' => $request->especialidad,
                    'tituloProfesional' => $tituloPath,
                    'curriculumVitae' => $cvPath,
                ]);
            }
            session()->forget(['pending_registration_data', 'pending_registration_password']);
            $emailToken->delete();
            DB::commit();
            // Mensaje de éxito
            $mensaje = "Registro exitoso. Sus documentos serán validados por el administrador en un plazo de 12-24 horas ";

            return redirect()->route('login')->with('success', $mensaje);

        } catch (\Exception $e) {
            DB::rollback();
            
            // Eliminar archivos subidos si hay error
            if (isset($partidaPath)) Storage::disk('public')->delete($partidaPath);
            if (isset($constanciaPath)) Storage::disk('public')->delete($constanciaPath);
            if (isset($partidaHijoPath)) Storage::disk('public')->delete($partidaHijoPath);
            if (isset($tituloPath)) Storage::disk('public')->delete($tituloPath);
            if (isset($cvPath)) Storage::disk('public')->delete($cvPath);

            return back()->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()])->withInput();
        }
    }
}  
