<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserAccess
{
    public function handle(Request $request, Closure $next)
    {
        // ID de usuarios permitidos
        $allowedUserIds = [5, 6, 7]; // Aquí pones las IDs de los usuarios que pueden acceder

        
        // Verificamos si el usuario está autenticado y su ID está en la lista
        if (auth()->check() && in_array(auth()->id(), $allowedUserIds)) {
            return $next($request);
        }

        // Si no, redirigimos a una ruta con un mensaje de error
        return redirect()->route('home')->with('error', 'No tienes acceso a esta página.');
    }
}
