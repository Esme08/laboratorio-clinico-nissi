<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Resend\Laravel\Facades\Resend;
use App\Mail\OrderShipped;

class DashBoard extends Controller
{

    public function index(Request $request)
    {
        $tiempo = $request->query('tiempo'); // Obtener el valor del filtro

        // Filtrar las citas según el valor de 'tiempo'
        switch ($tiempo) {
            case 'Hoy':
                $citas = Cita::whereDate('fecha', now()->format('Y-m-d'))->get();
                break;
            case 'Manana':
                $citas = Cita::whereDate('fecha', now()->addDay()->format('Y-m-d'))->get();
                break;
            case 'Ayer':
                $citas = Cita::whereDate('fecha', now()->subDay()->format('Y-m-d'))->get();  // Compara solo la fecha sin la hora
                break;
            default:
                $citas = Cita::all(); // Si no se proporciona un filtro, obtener todas las citas
                break;
        }

        // Pasar las citas filtradas a la vista
        return view('dashboard', ['citas' => $citas]);
    }

    public function sendEmail(Request $request){
        //dd($request->all());
        #$order = Order::findOrFail(1);
        $request->validate([
            'file' => 'required',
        ]);
        $file = $request->file('file');
        Resend::emails()->send([
            'from' => 'Acme <onboarding@resend.dev>',
            'to' => ['zhonglingmrx@gmail.com'],
            'subject' => 'Resultados de la cita',
            'text' => '¡Hola! Aquí están los resultados de su cita.',
            'attachments' => [
                [
                    'content' => base64_encode(file_get_contents($file->getRealPath())),  // Convertir el archivo a base64
                    'filename' => $file->getClientOriginalName(),  // Nombre del archivo
                    'type' => $file->getMimeType(),  // Tipo MIME del archivo
                ]
            ],
        ]);
        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
