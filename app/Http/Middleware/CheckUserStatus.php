<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Si el usuario está inactivo, redirigir a una página de error o mostrar mensaje
            if (!Auth::user()->status) {
                // Redirigir a una página de error personalizada
                return redirect()->route('inactive')->withErrors('Tu cuenta está inactiva. Contacta al administrador.');
            }
        }

        return $next($request);
    }
}
