<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/administrador.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Administrar Servicios</title>
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
            <h2 class="text-success fw-bold">Administrar Servicios</h2>
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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <form id="form-citas" action="{{ route('admin.servicios') }}" method="GET">
                    @csrf
                    <select name="estado" id="estado" class="form-select form-select-sm  w-auto border  border-success" onchange="this.form.submit()">
                        <option value="activos" {{ $estado === 'activos' ? 'selected' : '' }}>Servicios Activos</option>
                        <option value="desactivados" {{ $estado === 'desactivados' ? 'selected' : '' }}>Servicios Desactivados</option>
                    </select>
                </form>

            </div>
            <div>
                <button type="button" class="btn btn-outline-primary btn-md mb-3 fw-bold " data-bs-toggle="modal" data-bs-target="#saveModal">
                    <i class="bi bi-plus-circle"></i> Agregar Servicio
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="table-success text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicios as $servicio)
                    <tr class="fila align-middle text-center">
                        <td scope="row">{{ $servicio->id_servicio}}</td>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>${{$servicio->precio}}</td>
                        <td>{{ $servicio->categoria->nombre }}</td>
                        <td scope="row" class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-primary btn-subir"
                                    data-bs-toggle="modal"
                                    data-bs-target="#saveModal"
                                    data-id="{{ $servicio->id_servicio }}"
                                    data-nombre ="{{ $servicio->nombre }}"
                                    data-descripcion ="{{ $servicio->descripcion }}"
                                    data-precio ="{{ $servicio->precio }}"
                                    data-id_categoria ="{{ $servicio->id_categoria }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            @if($estado === 'activados')
                                <form action="{{ route('servicio.desactivar') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_servicio" value="{{ $servicio->id_servicio }}">
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('servicio.activar') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_servicio" value="{{ $servicio->id_servicio }}">
                                    <button type="submit" class="btn btn-outline-success d-flex align-items-center gap-2">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                             <td colspan="6" class="text-center">No hay Servicios</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="6">
                            <div class="d-flex justify-content-center">
                                {{ $servicios->links('pagination::bootstrap-4') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-success" id="saveModalLabel">Gestión de Administradores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="saveForm" action="" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="id_servicio">
                    <!-- Campo para ingresar el correo del paciente -->
                    <div class="mb-3">
                        <label for="patientServicio" class="form-label fw-bold text-success">Nombre del Servicio</label>
                        <input type="text" class="form-control border border-success shadow-sm" id="patientServicio" name="nombre" placeholder="Ingrese el nombre del servicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="patientCategoria" class="form-label fw-bold text-success">Categoría</label>
                        <select class="form-select border border-success shadow-sm" id="patientCategoria" name="id_categoria" required>
                            <option value="" disabled selected>Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="patientPrecio" class="form-label fw-bold text-success">Precio</label>
                        <input type="number" class="form-control border border-success shadow-sm" id="patientPrecio" name="precio" placeholder="Ingrese el precio del servicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="patientDescripcion" class="form-label fw-bold text-success">Descripción</label>
                        <textarea class="form-control border border-success shadow-sm" id="patientDescripcion" name="descripcion" placeholder="Ingrese una descripción" rows="3" required></textarea>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success fw-bold px-5 py-2 shadow-sm" style="width: auto; min-width: 150px;">
                            <i class="bi bi-save"></i> Guardar
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
    const saveModal = document.getElementById('saveModal');
    const form = saveModal.querySelector('form');

    form.addEventListener('submit', function () {
        setTimeout(() => {
        form.reset();
        const selectCategoria = form.querySelector('select[name="id_categoria"]');
        selectCategoria.value = '';
    }, 100); // Un pequeño retraso para no interferir con el submit
    });
    // RESET al cerrar el modal (esto debe ir FUERA del otro evento)
    saveModal.addEventListener('hide.bs.modal', function () {
        if (!form) return;
        form.reset();
        saveModal.querySelector('.modal-title').textContent = 'Agregar Servicio';

        const selectCategoria = form.querySelector('select[name="id_categoria"]');
        if (selectCategoria) {
            selectCategoria.value = "";
        }
    });

    // LLENAR al abrir el modal
    saveModal.addEventListener('show.bs.modal', function (event) {
        const storeUrl = "{{ route('servicio.store') }}";
        const updateUrl = "{{ route('servicio.edit') }}";
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');
        const descripcion = button.getAttribute('data-descripcion');
        const precio = button.getAttribute('data-precio');
        const id_categoria = button.getAttribute('data-id_categoria');

        if (id) {

            saveModal.querySelector('.modal-title').textContent = 'Editar Servicio';
            form.action = updateUrl;

            form.querySelector('input[name="id_servicio"]').value = id || '';
            form.querySelector('input[name="nombre"]').value = nombre || '';
            form.querySelector('input[name="descripcion"]').value = descripcion || '';
            form.querySelector('input[name="precio"]').value = precio || '';

            const selectCategoria = form.querySelector('select[name="id_categoria"]');
            if (selectCategoria) {
                // Deseleccionar todas
                Array.from(selectCategoria.options).forEach(option => {
                    option.selected = false;
                });

                // Seleccionar la correcta
                const opcion = Array.from(selectCategoria.options).find(opt => opt.value === String(id_categoria));
                if (opcion) {
                    opcion.selected = true;
                }
            }

        } else {
            saveModal.querySelector('.modal-title').textContent = 'Agregar Servicio';
            form.action = storeUrl;
        }
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
