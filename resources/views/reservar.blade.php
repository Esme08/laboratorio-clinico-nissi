<!-- resources/views/reservar.blade.php -->
@extends('layouts.welcome') {{-- Asegúrate de usar solo el nombre del archivo sin extensión --}}

@section('content')
    <h1>Laboratorio Clínico Nisii</h1>
    <h2>Contáctenos o reserve su cita</h2>
    <form>
        <label>Nombre completo</label>
        <input type="text" name="nombre" required>

        <label>Seleccione fecha</label>
        <input type="date" name="fecha" required>

        <label>Contacto</label>
        <input type="text" name="contacto" required>

        <button type="submit">Agendar cita</button>
    </form>
@endsection


