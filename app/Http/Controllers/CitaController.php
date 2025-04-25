<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Support\Facades\Log; // Importa la clase Log

class CitaController extends Controller
{
    public function create()
    {
        $servicios = Servicio::all();
        return view('formcita', compact('servicios'));
    }

    public function obtenerHorasDisponibles(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
        ]);

        $fecha = $request->fecha;

        $inicio = strtotime('07:00');
        $fin = strtotime('16:00');
        $intervalo = 30 * 60;

        $horas = [];
        for ($hora = $inicio; $hora <= $fin; $hora += $intervalo) {
            $horas[] = date('H:i', $hora);
        }

        $ocupadas = DB::table('citas')
            ->where('fecha', $fecha)
            ->pluck('hora')
            ->toArray();

        $disponibles = array_filter($horas, function ($h) use ($ocupadas) {
            return !in_array($h, $ocupadas);
        });

        return response()->json(array_values($disponibles));
    }

    public function verificarHoraCita(Request $request)
    {
        try {
            $request->validate([
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
            ]);

            $fecha = $request->fecha;
            $hora = $request->hora;

            Log::info('Verificando hora de cita: Fecha=' . $fecha . ', Hora=' . $hora);

            $citaExistente = DB::table('citas')
                ->where('fecha', $fecha)
                ->where('hora', $hora)
                ->exists();

            Log::info('Resultado de la consulta: ' . ($citaExistente ? 'Hora ocupada' : 'Hora disponible'));

            return response()->json(['ocupada' => $citaExistente]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return response()->json(['error' => 'Error de validación', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error al verificar hora de cita: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'nullable|string',
            'correo' => 'nullable|email',
            'telefono' => 'nullable|numeric|digits_between:8,15',
            'servicios' => 'required|array',
            'servicios.*' => 'exists:servicios,id',
            'precio_total' => 'required|numeric|min:0',
            'fecha' => 'required|date', // Asegúrate de validar la fecha aquí también
            'hora' => 'required|date_format:H:i', // Asegúrate de validar la hora aquí también
        ]);

        dd($request->all()); // Ver los datos que llegan

        $cita = new Cita();
        $cita->nombre = $request->nombre;
        $cita->correo = $request->correo;
        $cita->telefono = $request->telefono;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->precio_total = $request->precio_total;

        dd($cita); // Ver el objeto cita antes de guardar

        $cita->save();

        dd('Cita guardada'); // Verificar si se llega hasta aquí

        foreach ($request->servicios as $servicioId) {
            $cita->servicios()->attach($servicioId);
        }

        return response()->json(['success' => true, 'message' => 'Cita agendada correctamente.']);
    }
}