<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role  (Opcional) El rol requerido para acceder a la ruta.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        // Si el usuario no está autenticado y está intentando acceder a rutas distintas de 'login' o 'register'
        if (!Auth::check() && !($request->path() === 'login' || $request->path() === 'register')) {
            return redirect('login'); // Redirigir al login si no está autenticado
        }
          // Si el usuario está autenticado y trata de acceder a 'login' o 'register', redirigir al dashboard
        if (Auth::check() && ($request->path() == 'login' || $request->path() === 'register')) {
            return redirect('/dashboard');
        }

        // Si se especifica un rol, verificar si el usuario autenticado tiene ese rol
        if ($role !== null && Auth::check()) {
            // Verificar si el rol del usuario coincide con el rol requerido
            if (Auth::user()->role !== $role) {
                // Si no tiene el rol necesario, redirigir o generar un error 403
                abort(403, 'Acceso denegado. No tienes el rol necesario.');
            }
        }

        return $next($request);
    }
}
