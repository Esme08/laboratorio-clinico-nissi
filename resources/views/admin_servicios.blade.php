<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/administrador.css') }}">
    <title>Administrar Servicios</title>
</head>
<body>
<header>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">DashBoard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cita.store') }}">Agendar Cita</a></li>
                    <li class="nav-item"><a class="nav-link"  href="{{ route('admin.servicios') }}">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('historial.citas')}}">Historial</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index')}}">Usuarios</a></li>

                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container">
        <div class="text-center mt-4">
            <h1 >Bienvenido a Laboratorio Clinico Nissi</h1>
            <h2>Administrar Servicios</h2>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <form id="form-citas" action="{{ route('admin.servicios') }}" method="GET">
                    @csrf
                    <select name="estado" id="estado">
                        <option value="activos" {{ $estado === 'activos' ? 'selected' : '' }}>Servicios Activos</option>
                        <option value="desactivados" {{ $estado === 'desactivados' ? 'selected' : '' }}>Servicios Desactivados</option>
                    </select>
                    <button type="submit">
                       Buscar
                    </button>
                </form>

            </div>
            <div>
                <button type="button" class="btn-primary btn mb-3" data-bs-toggle="modal" data-bs-target="#saveModal">Agregar Servicio</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
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
                    <tr class="fila">
                        <th scope="row">{{ $servicio->id_servicio}}</th>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        <td>${{$servicio->precio}}</td>
                        <td>{{ $servicio->categoria->nombre }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-primary btn-subir"
                                    data-bs-toggle="modal"
                                    data-bs-target="#saveModal"
                                    data-id="{{ $servicio->id_servicio }}"
                                    data-nombre ="{{ $servicio->nombre }}"
                                    data-descripcion ="{{ $servicio->descripcion }}"
                                    data-precio ="{{ $servicio->precio }}"
                                    data-id_categoria ="{{ $servicio->id_categoria }}">
                                Editar
                            </button>
                            @if($estado === 'activados')
                                <form action="{{ route('servicio.desactivar') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_servicio" value="{{ $servicio->id_servicio }}">
                                    <button type="submit" class="btn btn-danger">Desactivar</button>
                                </form>
                            @else
                                <form action="{{ route('servicio.activar') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_servicio" value="{{ $servicio->id_servicio }}">
                                    <button type="submit" class="btn btn-success">Activar</button>
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
                <h5 class="modal-title" id="saveModalLabel">Guardar Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="saveForm" action="" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="id_servicio">
                    <!-- Campo para ingresar el correo del paciente -->
                    <div class="mb-3">
                        <label for="patientServicio" class="form-label">Nombre del Servicio</label>
                        <input type="text" class="form-control" id="patientServicio" name="nombre" placeholder="Nombre del servicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="patientCategoria" class="form-label">Categoria</label>
                        <select class="form-select" id="patientCategoria" name="id_categoria" required>
                            <option value=""  disabled selected >Seleccionar Categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="patientPrecio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="patientPrecio" name="precio" placeholder="Precio del servicio" required>
                    </div>

                    <div class="mb-3">
                        <label for="patientDescripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="patientDescripcion" name="descripcion" placeholder="Descripcion" required>
                    </div>

                    <div class="modal-footer modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>


    <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        <p>&copy; 2025 Laboratorio Clinico Nissi. Todos los derechos reservados.</p>
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
