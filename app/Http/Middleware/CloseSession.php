<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CloseSession
{
    public function handle($request, Closure $next)
    {
        //seteo la zona horaria en BsAs
        date_default_timezone_set('America/Argentina/Buenos_Aires');

        // Obtener la hora actual
        $horaActual = Carbon::now();
        // Verifica si la hora actual es exactamente 12:42
        if ($horaActual->format('H:i') == '00:00') {
            // Cerrar la sesión del usuario
            Auth::logout();
            session()->flush();

            // Redirige al login con un mensaje
            return redirect('/estancias/login')->with('message', 'Tu sesión ha sido cerrada automáticamente.');
        }

        // Si no coincide la hora, continúa con la solicitud
        return $next($request);
    }
}
