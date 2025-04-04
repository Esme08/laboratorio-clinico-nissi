<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DashBoard;

// web.php
Route::post('/verificar-hora-cita', [CitaController::class, 'verificarHoraCita']);
Route::get('/agendar-cita', [CitaController::class, 'create'])->name('cita.create');

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
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
