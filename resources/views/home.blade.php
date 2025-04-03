<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio Clinico Nissi</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .carousel-inner img { 
        max-width: 70%;  /* Ajusta el tamaño de la imagen */
        max-height: 400px; /* Define una altura máxima */
        margin: auto; /* Centra horizontalmente las imágenes */
    }
    body {
    font-family: 'Lora', serif;
    }
    footer {
            
            
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

</style>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg " style="background-color: #b5e8c3;">
        <div class="container">
            <a class="navbar-brand" href="#">
            <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">  
                 Laboratorio Clinico Nissi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-2">
    <div class="text-center mb-3">
    <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top"> 
        </div>
        <h2 class="text-center">Laboratorio Clinico Nissi</h2>
        <h5 class="text-center">¿Quiénes somos?</h5>
        <p class="text-center">Laboratorio Clínico Nissi es un centro especializado en análisis de laboratorio ubicado en Chalchuapa, Santa Ana. Nos dedicamos a ofrecer servicios confiables y precisos en el diagnóstico de diversas condiciones de salud, con tecnología avanzada y un equipo de profesionales altamente capacitados</p>
        <p class="text-center fw-bold ">
     ¡Estamos aquí para ti! Atiéndete de lunes a sábado de <strong>7:00 a.m. a 5:00 p.m.</strong>
        </p>

        <!-- Carrusel -->
        <div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                     <img src="{{ asset('imagenes/imagen1lab.jpeg') }}" class="d-block" >
                </div>
                <div class="carousel-item">
                     <img src="{{ asset('imagenes/imagen2lab.jpeg') }}" class="d-block">
                </div>
                <div class="carousel-item">
                      <img src="{{ asset('imagenes/imagen3lab.jpeg') }}" class="d-block">
                </div>
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
                    <p>Realizamos una variedad de exámenes clínicos para el monitoreo y diagnóstico de la salud de nuestros pacientes. Tambien garantizamos la entrega rápida y segura de los análisis, con opciones de consulta presencial y digital </p>
                </div>
            </div>
            <div class="col-md-6"> 
    <div class="card p-4  text-center">
        <h5 class="fw-bold"> ¡Agenda tu cita en segundos!</h5>
        <p class="text-muted">
            No pierdas tiempo en filas. Reserva tu cita en línea de forma rápida y sencilla, 
            desde donde estés y en cualquier momento.  
        </p>
        
        <a class="btn btn-dark btn-lg fw-bold" href="{{ route('cita.create') }}">
            📍 Agendar ahora
        </a>
    </div>
</div>

        </div>

        <div class="container mt-4">
        <h2 class="text-center mb-4">Servicios Disponibles</h2>
        <div class="row">
            @foreach ($servicios->chunk(6) as $grupo)
                <div class="col-md-4 mb-4">
                    <div class="card p-3 shadow-sm">
                        <h5 class="text-center"></h5>
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

       






    <div class="container mt-5">
    <h2 class="text-center mb-4">Ubicacion</h2>
    <div class="d-flex justify-content-center">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.494259603005!2d-89.67833309999999!3d13.988681799999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f62eb0043248afd%3A0x3857c200393ea816!2sLaboratorio%20Cl%C3%ADnico%20Nissi!5e0!3m2!1ses!2ssv!4v1743394176080!5m2!1ses!2ssv" 
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
    <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        <p>&copy; 2025 Laboratorio Clinico Nissi. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">  
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>

</html>