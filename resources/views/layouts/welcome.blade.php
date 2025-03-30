<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio Clínico Nisii</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('includes.navbar') {{-- Incluir navbar --}}

    <main class="container">
        @yield('content') {{-- Contenido dinámico de cada página --}}
    </main>

    @include('includes.footer') {{-- Incluir footer --}}
</body>
</html>

