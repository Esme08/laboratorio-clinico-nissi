<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/administrador.css') }}">
    <title>Administrar Usuarios</title>
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
                <button type="button" class="btn-primary btn mb-3" data-bs-toggle="modal" data-bs-target="#saveModal">Agregar Administrador</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr class="fila">
                        <th scope="row">{{ $usuario->id_admin}}</th>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-primary btn-subir"
                                    data-bs-toggle="modal"
                                    data-bs-target="#saveModal"
                                    data-id="{{ $usuario->id_admin }}"
                                    data-nombre ="{{ $usuario->nombre }}"
                                    data-correo ="{{ $usuario->correo }}"
                                    data-password = "{{ $usuario->contraseña }}"
                                    data-editar = "true"
                            >
                                Editar
                            </button>

                            <form action="{{ route('usuario.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id_admin" value="{{ $usuario->id_admin }}">
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                             <td colspan="6" class="text-center">No hay Administradores</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="6">
                            <div class="d-flex justify-content-center">
                                {{ $usuarios->links('pagination::bootstrap-4') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveModalLabel">Guardar Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="saveForm" action="" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="id_admin">
                    <!-- Campo para ingresar el correo del paciente -->
                    <div class="mb-3">
                        <label for="patientNombre" class="form-label">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="patientNombre" name="nombre" placeholder="Nombre de Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="patientCorreo" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="patientCorreo" name="correo" placeholder="Correo" required>
                    </div>
                    <div id="content-password" class="mb-3">
                        <label for="patientPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="patientPassword" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>


    <footer class="text-center p-3 mt-4 footer" style="background-color: #b5e8c3;">
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
    }, 100); // Un pequeño retraso para no interferir con el submit
    });
    // RESET al cerrar el modal (esto debe ir FUERA del otro evento)
    saveModal.addEventListener('hide.bs.modal', function () {
        if (!form) return;
        form.reset();
    });

    // LLENAR al abrir el modal
    saveModal.addEventListener('show.bs.modal', function (event) {
        const storeUrl = "{{ route('usuario.store') }}";
        const updateUrl = "{{ route('usuario.edit') }}";
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const nombre = button.getAttribute('data-nombre');
        const correo = button.getAttribute('data-correo');
        const editar = button.getAttribute('data-editar');
        const password = button.getAttribute('data-password');

        if (editar == "true") {
            saveModal.querySelector('.modal-title').textContent = 'Editar Administrador';
            form.action = updateUrl;

            form.querySelector('input[name="id_admin"]').value = id || '';
            form.querySelector('input[name="nombre"]').value = nombre || '';
            form.querySelector('input[name="correo"]').value = correo || '';
            form.querySelector('input[name="password"]').value = password || '';

        } else {
            saveModal.querySelector('.modal-title').textContent = 'Agregar Administrador';
            // form.querySelector('input[name="id_admin"]');
            // const passwordField = document.getElementById('content-password');
            // if (passwordField) {
            //     passwordField.classList.remove('d-none');
            // }
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
