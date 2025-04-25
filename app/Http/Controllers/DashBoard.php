<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Servicio;
use App\Models\Administrador;
use App\Models\CategoriaServicio;
use Resend\Laravel\Facades\Resend;
use App\Mail\OrderShipped;
use Carbon\Carbon;
class DashBoard extends Controller
{

    public function index(Request $request)
    {
        $tiempo = $request->query('tiempo'); // Obtener el valor del filtro
        // Filtrar las citas según el valor de 'tiempo'
        switch ($tiempo) {
            case 'Manana':
                $fecha = Carbon::tomorrow()->format('Y-m-d');
                break;
            case 'Ayer':
                $fecha = Carbon::yesterday()->format('Y-m-d');
                break;
            default:
                $fecha = Carbon::now()->format('Y-m-d'); // Por defecto, mostrar citas de hoy
                // $fecha = null;
                break;
        }
        $citas = Cita::whereDate('fecha', $fecha)->paginate(10);
        // Pasar las citas filtradas a la vista
        return view('dashboard', ['citas' => $citas, 'tiempo' => $tiempo]);
    }

    public function indexServicio(Request $request)
    {

        $estado_servicio = $request->query('estado'); // Obtener el valor del filtro
        $categorias = CategoriaServicio::all();
        $estado = "activados";
        switch ($estado_servicio){
            case 'desactivados':
                $servicios = Servicio::with('categoria')->where('desactivar', 1)->paginate(10);
                $estado = "desactivados";
                break;
            default:
                $servicios = Servicio::with('categoria')->where('desactivar', 0)->paginate(10);
                break;
        }
        //dd($servicios);
        return view('admin_servicios', ['servicios' => $servicios, 'categorias' => $categorias, 'estado' => $estado]);
    }

    public function indexUsuarios(Request $request)
    {
        $usuarios = Administrador::where('estado', 'activo')->paginate(10);
        return view('admin_usuarios', ['usuarios' => $usuarios]);
    }

    public function storeUsuario(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $usuario = new Administrador();
        $usuario->nombre = $data['nombre'];
        $usuario->correo = $data['correo'];
        $usuario->contraseña = bcrypt($data['password']);
        $usuario->estado = 'activo';
        $usuario->save();
        return redirect()->back()->with('success', 'Usuario creado correctamente');
    }

    public function deleteUsuario(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $id = $data['id_admin'];
        $usuario = Administrador::find($id);
        $usuario->estado = 'despedido';
        $usuario->save();
        return redirect()->back()->with('success', 'Usuario eliminado correctamente');
    }
    public function editUsuario(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $id = $data['id_admin'];
        $usuario = Administrador::find($id);
        $usuario->nombre = $data['nombre'];
        $usuario->correo = $data['correo'];
        if (isset($data['password'])) {
            $usuario->contraseña = bcrypt($data['password']);
        }
        $usuario->save();
        return redirect()->back()->with('success', 'Usuario editado correctamente');
    }

    public function historialCitas(Request $request)
    {
        $tiempo = $request->query('tiempo'); // Obtener el valor del filtro
        // dd($tiempo);
        switch ($tiempo) {
            case '1mes':
                $fecha = Carbon::now()->subDays(30)->format('Y-m-d');
                break;
            case '3meses':
                $fecha = Carbon::now()->subDays(90)->format('Y-m-d');
                break;
            case '6meses':
                $fecha = Carbon::now()->subDays(180)->format('Y-m-d');
                break;
            case '1anio':
                $fecha = Carbon::now()->subDays(365)->format('Y-m-d');
                break;
            case 'todo':
                $fecha = null;
                break;
            default:
                $fecha = Carbon::now()->subDays(7)->format('Y-m-d'); // Por defecto, mostrar citas de hace 7 días
                break;
        }

        $citas = $fecha
        ? Cita::whereDate('fecha', '>=', $fecha)->paginate(10)
        : Cita::paginate(10);

        return view('historial', ['citas' => $citas, 'tiempo' => $tiempo]);
    }

    public function storeServicio(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $servicio = new Servicio();
        $servicio->nombre = $data['nombre'];
        $servicio->descripcion = $data['descripcion'];
        $servicio->precio = $data['precio'];
        $servicio->id_categoria = $data['id_categoria'];
        $servicio->save();
        return redirect()->back()->with('success', 'Servicio creado correctamente');
    }

    public function desactivarServicio(Request $request)
    {
        $data = $request->all();
        $id = $data['id_servicio'];
        $servicio = Servicio::find($id);
        $servicio->desactivar = 1;
        $servicio->save();
        return redirect()->back()->with('success', 'Servicio eliminado correctamente');
    }

    public function activarServicio(Request $request)
    {
        $data = $request->all();
        $id = $data['id_servicio'];
        $servicio = Servicio::find($id);
        $servicio->desactivar = 0;
        $servicio->save();
        return redirect()->back()->with('success', 'Servicio activado correctamente');
    }
    public function editServicio(Request $request)
    {
        $data = $request->all();
        $id = $data['id_servicio'];
        //dd($data);
        $servicio = Servicio::find($id);
        $servicio->nombre = $data['nombre'];
        $servicio->descripcion = $data['descripcion'];
        $servicio->precio = $data['precio'];
        $servicio->id_categoria = $data['id_categoria'];
        $servicio->save();
        return redirect()->back()->with('success', 'Servicio editado correctamente');
    }

    public function sendEmail(Request $request){
        //dd($request->all());
        #$order = Order::findOrFail(1);
        $request->validate([
            'file' => 'required',
            'correo' => 'required',
        ]);
        $file = $request->file('file');
        $correo = $request->correo;
        // dd($correo);
        Resend::emails()->send([
            'from' => 'Acme <onboarding@resend.dev>',
            'to' => [$correo],
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
