

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
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ImagenClinicaController;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;

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

// Rutas de autenticación

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/Administrador1', function () {
        return view('Administrador1');
    })->name('Administrador1');
    
});


// Eliminar esta parte de la creación de administrador
// Administrador::create([
//     'nombre' => 'Admin Ejemplo',
//     'correo' => 'admin@example.com',
//     'contraseña' => Hash::make('123456'),
// ]);
