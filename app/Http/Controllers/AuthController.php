<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Administrador::where('correo', $request->usuario)->first();

        if ($admin && Hash::check($request->password, $admin->contraseña)) {
            Session::put('admin', $admin);
            return redirect()->route('dashboard'); // Redirige a la página de inicio
        }

        return back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('login');
    }
}
