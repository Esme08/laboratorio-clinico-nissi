<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="text-center">Agendar una Cita</h3>
                <form id="formCita">
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" pattern="[0-9]{8,}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hora</label>
                        <input type="time" class="form-control" id="hora" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Selecciona el Servicio o Combo</label>
                        <select class="form-select" id="servicio" required>
                            <option value="">Selecciona una opción</option>
                            <option value="servicio1">Servicio 1</option>
                            <option value="servicio2">Servicio 2</option>
                            <option value="combo1">Combo 1</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Agendar Cita</button>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Footer -->
 <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        <p>&copy; 2025 Laboratorio Clinico Nissi. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">  
    </footer>

<script>
    document.getElementById("formCita").addEventListener("submit", function(event) {
        event.preventDefault();
        alert("Cita agendada correctamente.");
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




</body>
</html>
