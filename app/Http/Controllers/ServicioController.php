<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::select('nombre', 'precio')->get();
        return view('home', compact('servicios'));
    }
}
