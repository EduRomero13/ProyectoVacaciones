<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        /** @var User|null $user */
        $user = Auth::user(); //retorna el usuario autenticado actualmente
        // El Auth es una fachada que proporciona acceso a las funciones de autenticación de Laravel. Permite verificar si un usuario está autenticado, obtener el usuario actual, cerrar sesión, etc.
        // Verifica primero que el user haya iniciado sesión, después, verifica que el rol sea el que se ingresa en el método, si no lo es, simplemente se muestra la vista 403
        if (!$user || !$user->hasRole($role)) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        return $next($request);
    }
}
