

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\CategoriaServicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\ComboServicioController;
use App\Http\Controllers\CitaServicioController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ImagenClinicaController;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AdminMiddleware;


Route::get('/', [ServicioController::class, 'index']);





// Rutas de recursos
Route::resource('citas', CitaController::class);
Route::resource('categorias_servicios', CategoriaServicioController::class);
Route::resource('servicios', ServicioController::class);
Route::resource('combos', ComboController::class);
Route::resource('combos_servicios', ComboServicioController::class);
Route::resource('citas_servicios', CitaServicioController::class);
Route::resource('resultados', ResultadoController::class);
Route::resource('administradores', AdministradorController::class);
Route::resource('clinicas', ClinicaController::class);
Route::resource('imagenes_clinica', ImagenClinicaController::class);

Route::get('/', [ServicioController::class, 'index'])->name('home');

Route::get('/agendar-cita', [CitaController::class, 'create'])->name('cita.create');

// Página pública

// Login y Logout
// Página pública
Route::get('/', function () {
    return view('home'); // Página visible para todos
});

// Login y Logout
Route::get('/login', function () { return view('login'); });
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Restricción manual: Si no es admin, redirigir al login
Route::get('/admin/edit-home', function () {
    if (!session('admin')) {
        return redirect('/login')->withErrors(['error' => 'Acceso restringido']);
    }
    return view('admin.edit-home'); // Vista de edición solo para administradores
});

Route::post('/admin/update-home', function (Request $request) {
    if (!session('admin')) {
        return redirect('/login')->withErrors(['error' => 'Acceso restringido']);
    }

    // Aquí guardarías la actualización en la base de datos
    // Por ejemplo, guardar el contenido en una tabla `HomePageContent`
    
    return redirect('/')->with('success', 'Página actualizada correctamente.');
});

// Eliminar esta parte de la creación de administrador
// Administrador::create([
//     'nombre' => 'Admin Ejemplo',
//     'correo' => 'admin@example.com',
//     'contraseña' => Hash::make('123456'),
// ]);
