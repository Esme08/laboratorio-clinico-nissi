<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrador;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Administrador::where('correo', $request->correo)->first();

        if ($admin && Hash::check($request->password, $admin->contraseña)) {
            Auth::login($admin);
            return redirect()->route('Administrador1'); // Redirige a la página principal
        }

        return back()->withErrors(['correo' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

