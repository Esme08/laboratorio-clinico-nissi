

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('home');
});


Route::get('/', [ServicioController::class, 'index'])->name('home');

Route::get('/agendar-cita', [CitaController::class, 'create'])->name('cita.create');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



// Aquí le damos el nombre a la ruta
Route::get('/login', function () {
    return view('login'); // Asegúrate de tener esta vista
})->name('login');


Administrador::create([
    'nombre' => 'Admin Ejemplo',
    'correo' => 'admin@example.com',
    'contraseña' => Hash::make('123456'), // Encripta la contraseña
]);

