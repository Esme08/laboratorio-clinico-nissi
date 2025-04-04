<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ✅ Agregado
use App\Models\Cita;
use App\Models\Servicio;

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

    // Horario base: 08:00 a 17:00, cada 30 min
    $inicio = strtotime('07:00');
    $fin = strtotime('16:00');
    $intervalo = 30 * 60; // 30 minutos en segundos

    $horas = [];
    for ($hora = $inicio; $hora <= $fin; $hora += $intervalo) {
        $horas[] = date('H:i', $hora);
    }

    // Obtener las horas ocupadas de la base de datos
    $ocupadas = DB::table('citas')
        ->where('fecha', $fecha)
        ->pluck('hora')
        ->toArray();

    // Filtrar las horas disponibles
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
                'hora' => 'required|date_format:H:i', // ✅ Validación estricta
            ]);

            $fecha = $request->fecha;
            $hora = $request->hora;

            \Log::info('Verificando hora de cita: Fecha=' . $fecha . ', Hora=' . $hora);

            $citaExistente = DB::table('citas') // ✅ Nombre de tabla en minúsculas
                ->where('fecha', $fecha)
                ->where('hora', $hora)
                ->exists();

            \Log::info('Resultado de la consulta: ' . ($citaExistente ? 'Hora ocupada' : 'Hora disponible'));

            return response()->json(['ocupada' => $citaExistente]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Error de validación: ' . $e->getMessage());
            return response()->json(['error' => 'Error de validación', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Error al verificar hora de cita: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required|numeric|digits_between:8,15',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i', // Valida el formato de la hora
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:Servicios,id_servicio', // Valida que cada ID de servicio exista
            'precio_total' => 'required|numeric|min:0',
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
            if ($servicio) {
                $serviciosNombres[] = $servicio->nombre;
                $cita->servicios()->attach($servicioId, ['precio_servicio' => $servicio->precio]);
            }
        }

        $cita->servicios_seleccionados = json_encode($serviciosNombres);
        $cita->save();

        return response()->json(['success' => true]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['success' => false, 'errors' => $e->errors()], 422); // Devuelve los errores de validación
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}
}
