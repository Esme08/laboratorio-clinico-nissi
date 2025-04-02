<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
        ]);

        $admin = Administrador::where('correo', $credentials['correo'])->first();

        if ($admin && password_verify($credentials['contraseña'], $admin->contraseña)) {
            session(['admin' => true]); // Guardamos que el usuario es admin
            return redirect('/admin/edit-home');
        }

        return back()->withErrors(['error' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect('/');
    }
}
