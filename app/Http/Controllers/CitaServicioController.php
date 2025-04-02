<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitaServicioController extends Controller
{
    public function create()
    {
        return view('formcita'); // Asegúrate de que la vista esté en resources/views/formcita.blade.php
    }
}
