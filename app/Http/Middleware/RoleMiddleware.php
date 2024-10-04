<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Manejar la solicitud entrante para verificar el rol del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$roles  (Los roles permitidos para acceder a la ruta).
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            // Permitir el acceso si el usuario tiene uno de los roles permitidos
            if (in_array($userRole, $roles)) {
                return $next($request);
            }

            // Permitir acceso si es admin y está intentando acceder a las rutas permitidas
            if ($userRole === 'admin' && $this->isAdminRouteAllowed($request)) {
                return $next($request);
            }
        }

        // Si el rol no coincide o no está autenticado, lanzar error 403
        abort(403, 'Acceso denegado. No tienes el rol necesario.');
    }

    /**
     * Verifica si la ruta es accesible por un administrador.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isAdminRouteAllowed(Request $request): bool
    {
        // Definir las rutas permitidas para el rol admin
        $adminRoutes = [
            'clients.create',
            'clients.store',
            'clients.edit',
            'clients.update',
            'clients.destroy',
            'users.create',
            'users.store',
            // Puedes agregar más rutas aquí si es necesario
        ];

        // Verificar si la ruta actual es una de las rutas permitidas para admin
        return in_array($request->route()->getName(), $adminRoutes);
    }
}
