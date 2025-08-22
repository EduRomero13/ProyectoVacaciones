<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller

{
    public function verificalogin(Request $request){ 
        /**
         * Flujo de acción del request 
         * 1. Cliente/Navegador → Envía petición HTTP con datos
         * 2. Servidor Web (Apache/Nginx) → Recibe petición HTTP
         * 3. Laravel → Convierte petición HTTP en objeto Request
         * 4. Laravel → Pasa el objeto Request a tu controlador
         */

        /**
         * Lo que sucede:
         * Cliente envía datos:
            * httpPOST /login HTTP/1.1
            * Host: miapp.com
            * Content-Type: application/x-www-form-urlencoded
            * email=usuario@email.com&password=123456
         * Laravel convierte esto en objeto Request:
            * // Laravel automáticamente hace esto:
            * $request = new Request();
            * $request->email = 'usuario@email.com';
            * $request->password = '123456';
         * Laravel pasa el Request a tu controlador:
            * // Laravel internamente hace:
            * $controller = new UserController();
            * $controller->verificalogin($request); // ← Aquí recibes el objeto
         */
        $data=request()->validate([
            'email'=>'required',
            'password'=>'required'
        ],
        [
            'email.required'=>'Ingrese Usuario',
            'password.required'=>'Ingrese contraseña',
        ]);
        $name=$request->get('email');
        $query=User::where('email','=',$name)->get();
        if ($query->count()!=0)
        {
            //$hashp=$query[0]->password;
            $bpassword=$query[0]->password;
            $password=$request->get('password');
            //if (password_verify($password, $hashp))
            if($password===$bpassword)
            {
                // Autenticar al usuario
                Auth::login($query[0]);
                
                // Regenerar sesión por seguridad
                $request->session()->regenerate();
                
                return redirect('/welcome');  
            }
            else
            {
                return back()->withErrors(['password'=>'Contraseña no válida'])->withInput(request(['email', 'password']));
            }
        }
        else
        {
            return back()->withErrors(['email'=>'Usuario no válido'])->withInput(request(['email']));
        }
    }
    public function salir(Request $request){ 
        Auth::logout();
        $request->session()->invalidate(); // Invalidar sesión
        $request->session()->regenerateToken(); // Regenerar token CSRF
        return redirect('/');
    }
}  
