<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Manejar la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario no está autenticado
        if (!Auth::check() && !in_array($request->path(), ['login', 'register'])) {
            return redirect('login');  // Redirigir al login si no está autenticado
        }

        // Si el usuario está autenticado y trata de acceder a 'login' o 'register', redirigir al dashboard
        if (Auth::check() && in_array($request->path(), ['login', 'register'])) {
            return redirect('/dashboard');
        }

        // Permitir que la solicitud continúe
        return $next($request);
    }
}
