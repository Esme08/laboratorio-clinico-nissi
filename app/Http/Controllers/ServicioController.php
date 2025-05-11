<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Clinica;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::select('nombre', 'precio')->get();
        $clinica = Clinica::with('imagenes')->first();
        if (!$clinica) {
            $clinica = new Clinica();
            $clinica->imagenes = collect();
        }
        return view('home', compact('servicios', 'clinica'));
    }
}
