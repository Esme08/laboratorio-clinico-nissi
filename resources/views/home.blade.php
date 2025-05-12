<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$clinica->nombre}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<style>
    nav {
            background-color: #b5e8c3;
        }
    .carousel-inner img {
        max-width: 70%;
        max-height: 400px;
        margin: auto;
    }
    body {
        font-family: 'Lora', serif;
    }
    footer {
            padding: 10px;
            text-align: center;
            font-size: 14px;
            background-color: #b5e8c3;
            margin-top: 2rem;
    }
</style>
<body>

    <!-- Navbar -->
   <nav class="navbar navbar-expand-lg " style="background-color: #b5e8c3;">

        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/" style="font-size: 1.2rem; font-weight: bold; color: #155724;">
                <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top rounded-circle border border-dark">
                <span>{{$clinica->nombre}}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="{{ route('home') }}" style="font-size: 1.1rem;">
                            <i class="bi bi-house-door"></i> <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="#"  style="font-size: 1.1rem;">
                            <i class="bi bi-briefcase"></i> <span>Servicios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="#" style="font-size: 1.1rem;">
                            <i class="bi bi-envelope"></i> <span>Contacto</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

<div class="container mt-2">
    <div class="text-center mb-3">
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
    </div>
    <h2 class="text-center">{{$clinica->nombre}}</h2>
    <h5 class="text-center">¿Quiénes somos?</h5>
    <p class="text-center">{{$clinica->descripcion}}</p>
    <p class="text-center fw-bold ">¡Estamos aquí para ti! Atiéndete de lunes a sábado de <strong>7:00 a.m. a 5:00 p.m.</strong></p>

    <!-- Carrusel -->
    <div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($clinica->imagenes as $index => $imagen)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset($imagen->url_imagen) }}" class="d-block">
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- Información -->
    <div class="row text-center mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="fw-bold">Tipos de exámenes</h5>
                <p>Realizamos una variedad de exámenes clínicos...</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 text-center">
                <h5 class="fw-bold">¡Agenda tu cita en segundos!</h5>
                <p class="text-muted">No pierdas tiempo en filas...</p>
                <a class="btn btn-dark btn-lg fw-bold" href="{{ route('cita.create') }}">📍 Agendar ahora</a>
            </div>
        </div>
    </div>

    <!-- Servicios -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Servicios Disponibles</h2>
        <div class="row">
            @foreach ($servicios->chunk(6) as $grupo)
                <div class="col-md-4 mb-4">
                    <div class="card p-3 shadow-sm">
                        <ul class="list-unstyled">
                            @foreach ($grupo as $servicio)
                                <li><strong>{{ $servicio->nombre }}</strong> - ${{ number_format($servicio->precio, 2) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Ubicación -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Ubicación</h2>
        <div class="d-flex justify-content-center">
        <iframe
            src="{{ $clinica->ubicacion_google_maps }}"
            width="100%"
            height="400"
            style="border:0; max-width: 800px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center p-3 mt-4">
        <p>&copy; 2025 {{$clinica->nombre}}. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
