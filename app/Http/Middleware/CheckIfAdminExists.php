<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Administrador;
class CheckIfAdminExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Administrador::whereNotNull('id_admin')->exists()) {
            // Si no existe un administrador, redirige a la página de creación de administrador
            return redirect()->route('login');
        }

        return $next($request);
    }
}
