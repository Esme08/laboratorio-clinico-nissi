<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>DashBoard</title>
</head>
<body>
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
    <div class="container">
        <div>
            <h1>Bienvenido a Laboratorio Clinico Nissi</h1>
            <h2>Dashboard</h2>
        </div>
        <div>
            <h3>Lista de Citas</h3>
            <form id="form-citas" action="{{ route('dashboard') }}" method="GET">
                @csrf
            <select name="tiempo" id="tiempo">
                <option value="Ayer">Citas de Ayer</option>
                <option value="Hoy" selected>Citas de hoy</option>
                <option value="Manana">Citas de mañana</option>
            </select>
            <button type="submit">Buscar</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citas as $cita)
                    <tr class="fila">
                        <th scope="row">{{ $cita->id_cita}}</th>
                        <td>{{ $cita->nombre_cliente }}</td>
                        <td>{{ $cita->correo_cliente }}</td>
                        <td>{{ $cita->telefono_cliente }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>{{ $cita->estado }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-subir" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                Subir Archivo
                            </button>
                        </td>
                    </tr>
                    <tr class="detalle" style="display: none;">
                        <td colspan="8">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Detalles de la Cita:</strong>
                                    <p><strong>Nombre:</strong> {{ $cita->nombre_cliente }}</p>
                                    <p><strong>Correo:</strong> {{ $cita->correo_cliente }}</p>
                                    <p><strong>Telefono:</strong> {{ $cita->telefono_cliente }}</p>
                                    <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
                                    <p><strong>Hora:</strong> {{ $cita->hora }}</p>
                                    <p><strong>Estado:</strong> {{ $cita->estado }}</p>
                                    <p><strong>Servicios Seleccionados:</strong></p>
                                    <ul>
                                        @foreach (json_decode($cita->servicios_seleccionados, true) as $servicio)
                                            <li>{{ $servicio }}</li>
                                        @endforeach
                                    </ul>
                                    <p><strong>Total:</strong> {{ $cita->precio_total}}</p>
                                </div>
                            </div>
                        </td>
                        @empty
                            <tr>
                             <td colspan="8" class="text-center">No hay citas para el filtro seleccionado.</td>
                            </tr>
                        @endforelse
                </tbody>
            </table>

        </div>
    </div>
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Subir Archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" action="{{route('send.email')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <!-- Campo para ingresar el correo del paciente -->
                    <div class="mb-3">
                        <label for="patientEmail" class="form-label">Correo del Paciente</label>
                        <input type="email" class="form-control" id="patientEmail" name="correo" placeholder="Correo del paciente" required>
                    </div>
                    <!-- Campo para seleccionar el archivo -->
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Seleccionar archivo</label>
                        <input type="file" class="form-control" id="fileUpload" name="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        <p>&copy; 2025 Laboratorio Clinico Nissi. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
    </footer>
    <script>
        document.querySelectorAll('.fila').forEach((row, index) => {
            row.addEventListener('click', function (event) {
                // Evitar que el clic en el botón active la fila
                if (event.target.closest('.btn-subir')) {
                    return;
                }
                let detalleRow = document.querySelectorAll('.detalle')[index];
                detalleRow.style.display = detalleRow.style.display === 'none' ? 'table-row' : 'none';
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
