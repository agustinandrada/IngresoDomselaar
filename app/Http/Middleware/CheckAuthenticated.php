<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        if (session('user') == null) {
            // Depura la URL de la solicitud

            // Redirige a la página de inicio de sesión
            return redirect()->route('login');
        }

        return $next($request);
    }
}
