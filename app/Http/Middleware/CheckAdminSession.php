<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;  // Importa esta línea
class CheckAdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('admin')) {
            // Si no hay administrador en la sesión, redirige al login
            return redirect()->route('login');
        }

        // Obtén el nombre del administrador de la sesión
        if ($request->routeIs('login') && Session::has('admin')) {
            return redirect()->route('dashboard');
        }

        return $next($request);

    }
}
