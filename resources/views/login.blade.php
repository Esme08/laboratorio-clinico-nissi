<!-- resources/views/reservar.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laboratorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">



    <style>

    </style>
</head>
<body class="login-body">

    <div class="login-container">
        <h3><strong>Bienvenido</strong></h3>
        <h4>{{$clinica->nombre}}</h4>
        <div class="icon-user">
         <img src="/imagenes/perfil_icon.png" alt="Imagen" style="width: 100px; height: 100px;">
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="correo" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Ingresar</button>
        </form>
    </div>

</body>
</html>


