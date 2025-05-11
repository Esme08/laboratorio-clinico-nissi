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
        if (Session::has('admin')) {

            return redirect()->route('dashboard'); // Si ya hay sesión, redirige al dashboard
        }
        $adminExist = Administrador::whereNotNull('id_admin')->exists();
        if ($adminExist) {
            // Si ya existe un administrador, redirige al login
            return view('login');
        }
        return view('create_admin');
    }

    public function createAdmin(Request $request){
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required',
            'password' => 'required',
        ]);
        //dd($request->all());
        $admin = new Administrador();
        $admin->nombre = $request->nombre;
        $admin->correo = $request->correo;
        $admin->contraseña = Hash::make($request->password);

        $admin->save();
        return redirect()->route('login')->with('success', 'Administrador creado exitosamente. Ahora puedes iniciar sesión.');

    }
    public function login(Request $request)
    {

        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        //dd($request->all());
        $admin = Administrador::where('correo', $request->correo)->where('estado', 'activo')->first();
       // dd($admin);
        if ($admin && Hash::check($request->password, $admin->contraseña)) {
            Session::put('admin', $admin);
            //dd('Ya se ha iniciado sesión');

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
