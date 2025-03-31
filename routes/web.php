

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.welcome');
});

Route::get('/reservar', function () {
    return view('reservar');
})->name('reservar');  // Aquí le damos el nombre a la ruta

Route::get('/login', function () {
    return view('auth.login'); // Asegúrate de tener esta vista
})->name('login');
