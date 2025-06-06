<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DashBoard;
use App\Http\Controllers\ClinicaController;

Route::get('/admin/clinica/editar', [ClinicaController::class, 'edit'])->name('admin.clinica.editar');
Route::post('/admin/clinica/actualizar', [ClinicaController::class, 'update'])->name('admin.clinica.actualizar');
Route::post('/admin/clinica/imagenes/guardar', [ClinicaController::class, 'storeImagen'])->name('admin.clinica.imagenes.guardar');
Route::delete('/admin/clinica/imagenes/{id}/eliminar', [ClinicaController::class, 'destroyImagen'])->name('admin.clinica.imagenes.eliminar');


Route::post('/verificar-hora-cita', [CitaController::class, 'verificarHoraCita']);
Route::get('/agendar-cita', [CitaController::class, 'create'])->name('cita.create');
Route::get('/horas-disponibles', [CitaController::class, 'obtenerHorasDisponibles']);


Route::get('/', [ServicioController::class, 'index'])->name('home');

Route::post('/agendar-cita', [CitaController::class, 'store'])->name('cita.store');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

Route::middleware('checkAdminExists')->group(function() {
    Route::post('/create-admin', [AuthController::class, 'createAdmin'])->name('create.admin');
});

Route::middleware('checkAdminSession')->group(function() {
    Route::get('/dashboard', [DashBoard::class, 'index'])->name('dashboard');
    Route::post('/dashboard/send-email', [DashBoard::class, 'sendEmail'])->name('send.email');
    Route::get('/dashboard/citas', [DashBoard::class, 'filterCita'])->name('citas.filter');
    Route::get('/dashboard/admin-servicios', [DashBoard::class, 'indexServicio'])->name('admin.servicios');
    Route::post('/dashboard/servicios/store', [DashBoard::class, 'storeServicio'])->name('servicio.store');
    Route::post('/dashboard/servicios/edit', [DashBoard::class, 'editServicio'])->name('servicio.edit');
    Route::post('/dashboard/servicios/desactivar', [DashBoard::class, 'desactivarServicio'])->name('servicio.desactivar');
    Route::post('/dashboard/servicios/activar', [DashBoard::class, 'activarServicio'])->name('servicio.activar');
    Route::get('/dashboard/historial', [DashBoard::class, 'historialCitas'])->name('historial.citas');
    Route::get('/dashboard/usuarios',[DashBoard::class, 'indexUsuarios'])->name('usuarios.index');
    Route::post('/dashboard/usuarios/store', [DashBoard::class, 'storeUsuario'])->name('usuario.store');
    Route::post('/dashboard/usuarios/edit', [DashBoard::class, 'editUsuario'])->name('usuario.edit');
    Route::delete('/dashboard/usuarios/eliminar', [DashBoard::class, 'deleteUsuario'])->name('usuario.delete');

});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
