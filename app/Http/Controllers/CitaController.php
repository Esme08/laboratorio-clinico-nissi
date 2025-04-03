<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Servicio;

class CitaController extends Controller
{
    public function create()
    {
        $servicios = Servicio::all();
        return view('formcita', compact('servicios'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'correo' => 'required|email',
                'telefono' => 'required|numeric',
                'fecha' => 'required|date',
                'hora' => 'required',
                'servicios' => 'required|array',
                'servicios.*' => 'exists:Servicios,id_servicio',
                'precio_total' => 'required|numeric',
            ]);

            $cita = new Cita();
            $cita->nombre_cliente = $request->nombre;
            $cita->correo_cliente = $request->correo;
            $cita->telefono_cliente = $request->telefono;
            $cita->fecha = $request->fecha;
            $cita->hora = $request->hora;
            $cita->estado = 'Pendiente';
            $cita->precio_total = $request->precio_total;
            $cita->save();

            $serviciosNombres = [];
            foreach ($request->servicios as $servicioId) {
                $servicio = Servicio::find($servicioId);
                $serviciosNombres[] = $servicio->nombre;
            }

            $cita->servicios_seleccionados = json_encode($serviciosNombres);
            $cita->save();

            foreach ($request->servicios as $servicioId) {
                $servicio = Servicio::find($servicioId);
                $cita->servicios()->attach($servicioId, ['precio_servicio' => $servicio->precio]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}