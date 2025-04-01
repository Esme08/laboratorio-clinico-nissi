<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validación de las credenciales
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            // Si las credenciales son correctas, redirigir a la página principal
            return redirect()->intended('/home');  // Redirige a la página de inicio
        } else {
            // Si las credenciales son incorrectas, redirigir con un mensaje de error
            return back()->withErrors([
                'email' => 'Las credenciales no son correctas.',
            ]);
        }
    }
}
