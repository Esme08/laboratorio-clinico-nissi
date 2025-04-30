<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Support\Facades\Log;

class CitaController extends Controller
{
    public function create()
    {
        $servicios = Servicio::with('categoria')->where('desactivar', 0)->get();
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

        $ocupadas = DB::table('Citas')
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

            $citaExistente = DB::table('Citas')
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
        try {
            $request->validate([
                'nombre' => 'nullable|string',
                'correo' => 'nullable|email',
                'telefono' => 'nullable|numeric|digits_between:8,15',
                'servicios' => 'required|array',
                'servicios.*' => 'exists:Servicios,id_servicio',
                'precio_total' => 'required|numeric|min:0',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
            ]);

            $cita = new Cita();
            $cita->nombre_cliente = $request->nombre;
            $cita->correo_cliente = $request->correo;
            $cita->telefono_cliente = $request->telefono;
            $cita->fecha = $request->fecha;
            $cita->hora = $request->hora;
            $cita->estado = 'Pendiente';
            $cita->precio_total = $request->precio_total;

            // Recuperar los nombres de los servicios seleccionados
            $nombresServicios = Servicio::whereIn('id_servicio', $request->servicios)
                ->pluck('nombre')
                ->implode(', '); // Convertir la colección de nombres en una cadena separada por comas

            $cita->servicios_seleccionados = $nombresServicios; // Asignar la cadena de nombres al campo
            $cita->save();

            // Adjuntar los servicios a la tabla pivote (para mantener la relación)
            foreach ($request->servicios as $servicioId) {
                $servicio = Servicio::findOrFail($servicioId);
                $cita->servicios()->attach($servicioId, ['precio_servicio' => $servicio->precio]);
            }

            return response()->json(['success' => true, 'message' => 'Cita agendada correctamente.']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => 'Error de validación', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error al guardar la cita: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al agendar la cita: ' . $e->getMessage()], 500);
        }
    }
}
