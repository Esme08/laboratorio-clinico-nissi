<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: 'Lora', serif;
    }
    footer {
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }
</style>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg " style="background-color: #b5e8c3;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">  
                Laboratorio Clinico Nissi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h3 class="text-center">Agendar una Cita</h3>
                    <form id="formCita" action="{{ route('cita.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" pattern="[0-9]{8,}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hora</label>
                            <input type="time" class="form-control" name="hora" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Selecciona el Servicio o Combo</label>
                            <select class="form-select" name="servicio_combo" required>
                                <option value="">Selecciona una opción</option>
                                @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->id_servicio }}">{{ $servicio->nombre }}</option>
                                @endforeach
                                @foreach($combos as $combo)
                                    <option value="{{ $combo->id_combo }}">{{ $combo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="submitBtn" type="submit" class="btn btn-dark w-100">Agendar Cita</button>
                    </form>
                    <div id="mensaje" class="mt-3 text-center"></div>
                </div>
            </div>
        </div>
    </div>

    
    <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        <p>&copy; 2025 Laboratorio Clinico Nissi. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">  
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("formCita").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            const form = event.target;
            const formData = new FormData(form);
            const submitBtn = document.getElementById('submitBtn');
            const mensajeDiv = document.getElementById('mensaje');

            submitBtn.disabled = true; // Deshabilita el botón para evitar envíos múltiples

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': formData.get('_token') // Incluye el token CSRF
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mensajeDiv.innerHTML = '<div class="alert alert-success">Cita agendada correctamente.</div>';
                    form.reset(); // Limpia el formulario
                } else {
                    mensajeDiv.innerHTML = '<div class="alert alert-danger">Error al agendar la cita.</div>';
                }
            })
            .catch(error => {
                mensajeDiv.innerHTML = '<div class="alert alert-danger">Error al agendar la cita.</div>';
            })
            .finally(() => {
                submitBtn.disabled = false; // Habilita el botón nuevamente
            });
        });
    </script>
</body>
</html>