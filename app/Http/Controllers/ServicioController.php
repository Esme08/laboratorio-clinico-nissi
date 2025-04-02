<<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio; // Importar el modelo

class ServicioController extends Controller
{
    public function index()
    {
        try {
            $servicios = Servicio::select('nombre', 'precio')->get(); // Recuperar servicios
            return view('home', ['servicios' => $servicios]); // Pasar la variable correctamente
        } catch (\Exception $e) {
            return back()->with('error', 'Error al obtener los servicios.');
        }
    }
}


