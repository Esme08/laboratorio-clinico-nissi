<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Combo;

class CitaController extends Controller
{
    public function create()
    {
        $servicios = Servicio::all();
        $combos = Combo::all();
        return view('formcita', compact('servicios', 'combos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required|numeric',
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio_combo' => 'required',
        ]);

        $cita = new Cita();
        $cita->nombre_cliente = $request->nombre;
        $cita->correo_cliente = $request->correo;
        $cita->telefono_cliente = $request->telefono;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->estado = 'Pendiente';
        $cita->save();

        // Determinar si es un servicio o un combo y adjuntarlo
        if (Servicio::find($request->servicio_combo)) {
            $cita->servicios()->attach($request->servicio_combo);
        } elseif (Combo::find($request->servicio_combo)) {
            $cita->combos()->attach($request->servicio_combo);
        }

        return response()->json(['success' => true]); // Devuelve una respuesta JSON de éxito
    }
}