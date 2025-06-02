<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/administrador.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Administrar Usuarios</title>
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
            <a class="navbar-brand d-flex align-items-center gap-2" href="/dashboard/citas" style="font-size: 1.2rem; font-weight: bold; color: #155724;">
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
            <h2 class="text-success fw-bold">Administrar Usuarios</h2>
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
            <button type="button" class="btn btn-outline-primary btn-md mb-3 fw-bold " data-bs-toggle="modal" data-bs-target="#saveModal">
                    <i class="bi bi-plus-circle"></i> Agregar Administrador
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="table-success text-center">
                        <th scope="col" class="fw-bold">ID</th>
                        <th scope="col" class="fw-bold">Nombre</th>
                        <th scope="col" class="fw-bold">Correo</th>
                        <th scope="col" class="fw-bold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr class="fila align-middle text-center">
                        <td>{{ $usuario->id_admin}}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-primary btn-subir"
                                    data-bs-toggle="modal"
                                    data-bs-target="#saveModal"
                                    data-id="{{ $usuario->id_admin }}"
                                    data-nombre ="{{ $usuario->nombre }}"
                                    data-correo ="{{ $usuario->correo }}"
                                    data-password = "{{ $usuario->contraseña }}"
                                    data-editar = "true"
                            >
                                <i class="bi bi-pencil-square"></i>
                            </button>

                           @if (!$loop->first)
                                <form action="{{ route('usuario.delete') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id_admin" value="{{ $usuario->id_admin }}">
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-outline-secondary" disabled title="Este administrador no se puede eliminar">
                                    <i class="bi bi-lock"></i>
                                </button>
                            @endif
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
                <h5 class="modal-title fw-bold text-success" id="saveModalLabel">Gestión de Servicios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="saveForm" action="" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="id_admin">
                    <!-- Campo para ingresar el correo del paciente -->
                    <div class="mb-3">
                        <label for="patientNombre" class="form-label fw-bold text-success">Nombre del Usuario</label>
                        <input type="text" class="form-control border border-success px-3" id="patientNombre" name="nombre" placeholder="Nombre de Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="patientCorreo" class="form-label fw-bold text-success">Correo</label>
                        <input type="email" class="form-control border border-success px-3" id="patientCorreo" name="correo" placeholder="Correo" required>
                    </div>
                   <div id="content-password" class="mb-3">
                        <label for="patientPassword" class="form-label fw-bold text-success">Contraseña</label>
                        <input type="password" class="form-control border border-success px-3" id="patientPassword" name="password" placeholder="Contraseña" required>
                    </div>
                    <div id="content-repetpassword" class="mb-3">
                        <label for="repeatPassword" class="form-label fw-bold text-success">Repetir Contraseña</label>
                        <input type="password" class="form-control border border-success px-3" id="repeatPassword" name="repeat_password" placeholder="Repetir Contraseña" required>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success fw-bold px-5 py-2 shadow-sm" style="width: auto; min-width: 150px;"><i class="bi bi-save"></i> Guardar</button>
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
    const password = document.getElementById("patientPassword");
    const repeatPassword = document.getElementById("repeatPassword");
    const saveModal = document.getElementById('saveModal');
    const form = saveModal.querySelector('form');

    function validatePasswords() {
        const passwordVal = password.value;
        const repeatPasswordVal = repeatPassword.value;

        // Si ambos están vacíos (caso de edición sin cambiar contraseña), no validar nada
       if (!passwordVal && !repeatPasswordVal) {
            repeatPassword.setCustomValidity(""); // Esto habilita el submit
            return true;
        }

        // Si solo uno de los dos está lleno, marcar error
        if ((passwordVal && !repeatPasswordVal) || (!passwordVal && repeatPasswordVal)) {
            repeatPassword.setCustomValidity("Debes llenar ambos campos si vas a cambiar la contraseña");
            return false;
        }

        // Si ambos están llenos, verificar que coincidan
        if (passwordVal !== repeatPasswordVal) {
            repeatPassword.setCustomValidity("Las contraseñas no coinciden");
            return false;
        }

        // Todo está correcto
        repeatPassword.setCustomValidity("");
        return true;
    }

    repeatPassword.addEventListener("input", validatePasswords);
    password.addEventListener("input", validatePasswords);

    form.addEventListener("submit", function (e) {
        if (!validatePasswords()) {
            e.preventDefault(); // Evita el envío si las contraseñas no coinciden
        }
    });


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
        const existingPassword  = button.getAttribute('data-password');
        const passwordInput = document.getElementById('patientPassword');
        const repeatPasswordInput = document.getElementById('repeatPassword');
        if (editar == "true") {
            saveModal.querySelector('.modal-title').textContent = 'Editar Administrador';
            form.action = updateUrl;

            form.querySelector('input[name="id_admin"]').value = id || '';
            form.querySelector('input[name="nombre"]').value = nombre || '';
            form.querySelector('input[name="correo"]').value = correo || '';
            form.querySelector('input[name="password"]').value = existingPassword  || '';

            passwordInput.required = false;
            repeatPasswordInput.required = false;

            const passwordField = document.getElementById('content-password');
            if (passwordField) {
                const label = passwordField.querySelector('label');
                if (label) {
                    label.textContent = 'Nueva Contraseña';
                }
            }
        } else {
            saveModal.querySelector('.modal-title').textContent = 'Agregar Administrador';
            const passwordField = document.getElementById('content-password');

             passwordInput.required = true;
            repeatPasswordInput.required = true;
            if (passwordField) {
                const label = passwordField.querySelector('label');
                if (label) {
                    label.textContent = 'Contraseña';
                }
            }
            // form.querySelector('input[name="id_admin"]');
            // const passwordField = document.getElementById('content-password');
            // if (passwordField) {
            //     passwordField.classList.remove('d-none');
            // }
            form.action = storeUrl;
        }
        validatePasswords();
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
