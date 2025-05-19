<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/administrador.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Citas</title>
    <style>
        .navbar {
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
        }
    </style>
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg " style="background-color: #b5e8c3;">

        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/dashboard" style="font-size: 1.2rem; font-weight: bold; color: #155724;">
                <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top rounded-circle border border-dark">
                <span>{{$clinica->nombre}}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="{{ route('dashboard') }}" style="font-size: 1.1rem;">
                            <i class="bi bi-calendar-check"></i> <span>Citas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="{{ route('clinica.info') }}" target="_blank" style="font-size: 1.1rem;">
                            <i class="bi bi-info-circle"></i> <span>Info Clinica</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="{{ route('cita.store') }}" target="_blank" style="font-size: 1.1rem;">
                            <i class="bi bi-calendar-plus"></i> <span>Agendar Cita</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="{{ route('admin.servicios') }}" style="font-size: 1.1rem;">
                            <i class="bi bi-briefcase"></i> <span>Servicios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="{{ route('historial.citas') }}" style="font-size: 1.1rem;">
                            <i class="bi bi-clock-history"></i> <span>Historial</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success d-flex align-items-center gap-2" href="{{ route('usuarios.index') }}" style="font-size: 1.1rem;">
                            <i class="bi bi-people"></i> <span>Usuarios</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link fw-bold text-danger d-flex align-items-center gap-2" style="font-size: 1.1rem;">
                                <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container">
        <div class="text-center mt-4">
            <h1 class="text-success fw-bold">Bienvenido a {{$clinica->nombre}}</h1>
            <h2 class="text-success fw-bold">Gestión de Citas</h2>
        </div>
        @if (session('success'))
            <div id="success-alert" class="alert alert-success fw-bold text-success">{{ session('success') }}</div>
            <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
            </script>
        @endif

        <div class="text-start mb-4">
            <form id="form-citas" action="{{ route('dashboard') }}" method="GET" >
            @csrf
            <select name="tiempo" id="tiempo" class="form-select form-select-sm w-auto border border-success" onchange="this.form.submit()">
                <option value="Ayer" {{ $tiempo == 'Ayer' ? 'selected' : '' }}>Citas de Ayer</option>
                <option value="Hoy" {{ $tiempo == 'Hoy' ? 'selected' : '' }}>Citas de hoy</option>
                <option value="Manana" {{ $tiempo == 'Manana' ? 'selected' : '' }}>Citas de mañana</option>
            </select>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="table-success text-center">
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
                    <tr class="fila align-middle text-center">
                        <th scope="row">{{ $cita->id_cita}}</th>
                        <td>{{ $cita->nombre_cliente }}</td>
                        <td>{{ $cita->correo_cliente }}</td>
                        <td>{{ $cita->telefono_cliente }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td class="select-estado text-center">
                           <form class="d-inline-block" action="{{ route('cita.updateEstado', $cita->id_cita) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id_cita" value="{{ $cita->id_cita }}">
                                <select name="estado" id="estado-{{ $cita->id_cita }}" class="form-select form-select-sm w-auto mx-auto border-success" onchange="this.form.submit()">
                                    <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Cancelada" {{ $cita->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                    <option value="Completada" {{ $cita->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
                                </select>
                            </form>
                        </td>
                        <td >
                         @if($cita->correo_cliente)
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-success btn-sm btn-subir d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#uploadModal" data-correo="{{ $cita->correo_cliente }}">
                                    <i class="bi bi-envelope"></i> Enviar Correo
                                </button>
                            </div>
                        @endif
                        </td>
                    </tr>
                    <tr class="detalle" style="display: none;">
                        <td colspan="8">
                            <div class="d-flex justify-content-between" style="width: 100%;">
                                <div class="p-4 border rounded bg-light" style="width: 100%;">
                                    <h5 class="mb-3"><span class="fw-semibold">Detalles de la Cita:</span></h5>
                                    <p><span class="fw-semibold">Nombre:</span> {{ $cita->nombre_cliente }}</p>
                                    <p><span class="fw-semibold">Correo:</span> {{ $cita->correo_cliente }}</p>
                                    <p><span class="fw-semibold">Teléfono:</span> {{ $cita->telefono_cliente }}</p>
                                    <p><span class="fw-semibold">Fecha:</span> {{ $cita->fecha }}</p>
                                    <p><span class="fw-semibold">Hora:</span> {{ $cita->hora }}</p>
                                    <p><span class="fw-semibold">Estado:</span> <span class="badge bg-info text-dark">{{ $cita->estado }}</span></p>
                                    <p><span class="fw-semibold">Servicios Seleccionados:</span></p>
                                    <ul class="list-group mb-3" style="max-width: 300px; overflow-y: auto;">
                                        @foreach (explode(',', $cita->servicios_seleccionados) as $servicio)
                                            <li class="list-group-item">{{ trim($servicio) }}</li>
                                        @endforeach
                                    </ul>
                                    <p><strong>Total:</strong> <span class="text-success fw-bold">${{ $cita->precio_total }}</span></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                        @empty
                            <tr>
                             <td colspan="8" class="text-center">No hay citas para el filtro seleccionado.</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="8">
                                <div class="d-flex justify-content-center">
                                    {{ $citas->links('pagination::bootstrap-4') }}
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-success" id="uploadModalLabel">
                    <i class="bi bi-upload"></i> Subir Archivo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" action="{{route('send.email')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <!-- Campo para ingresar el correo del paciente -->
                    <div class="mb-3">
                        <label for="patientEmail" class="form-label fw-bold text-success">Correo del Paciente</label>
                        <input type="email" class="form-control shadow-sm border border-success" id="patientEmail" name="correo" placeholder="Ingrese el correo del paciente" required style="background-color: #f9f9f9;">
                    </div>
                    <!-- Campo para seleccionar el archivo -->
                    <div class="mb-3">
                        <label for="fileUpload" class="form-label fw-bold text-success">Seleccionar Archivo</label>
                        <div class="input-group shadow-sm">
                            <input type="file" class="form-control border border-success " id="fileUpload" name="file" required style="background-color: #f9f9f9;">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-cloud-upload-fill"></i> <span>Enviar Archivo</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>

   <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        <p>&copy; 2025 {{$clinica->nombre}}. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
    </footer>
    <script>
        document.querySelectorAll('.fila').forEach((row, index) => {
            row.addEventListener('click', function (event) {
                // Evitar que el clic en el botón active la fila
                if (event.target.closest('.btn-subir') || event.target.closest('.select-estado') || event.target.closest('.btn-whatsapp')) {
                    return;
                }
                let detalleRow = document.querySelectorAll('.detalle')[index];
                detalleRow.style.display = detalleRow.style.display === 'none' ? 'table-row' : 'none';

            });
        });
    </script>
    <script>
        const uploadModal = document.getElementById('uploadModal');

        uploadModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const correo = button.getAttribute('data-correo');
            const modalBodyInput = document.getElementById('patientEmail');
            modalBodyInput.value = correo;
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
