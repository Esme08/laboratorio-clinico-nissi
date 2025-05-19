<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/administrador.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <title>Historial</title>
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
            <h2 class="text-success fw-bold">Historial de Citas</h2>
        </div>
        <div class="mb-4">
            <form id="form-citas" action="{{ route('historial.citas') }}" method="GET">
                @csrf
            <select name="tiempo" id="tiempo" class="form-select form-select-sm  w-auto border  border-success" onchange="this.form.submit()">
                <option value="7dias" {{ request('tiempo') == '7dias' ? 'selected' : '' }}>7 Dias</option>
                <option value="1mes" {{ request('tiempo') == '1mes' ? 'selected' : '' }}>1 Mes</option>
                <option value="3meses" {{ request('tiempo') == '3meses' ? 'selected' : '' }}>3 Meses</option>
                <option value="6meses" {{ request('tiempo') == '6meses' ? 'selected' : '' }}>6 meses</option>
                <option value="1anio" {{ request('tiempo') == '1anio' ? 'selected' : '' }}>1 Año</option>
                <option value="todo" {{ request('tiempo') == 'todo' ? 'selected' : '' }}>Todo</option>

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
                    </tr>
                </thead>
                <tbody>
                    @forelse($citas as $cita)
                    <tr class="fila align-middle text-center">
                        <th scope="row">{{ $cita->id_cita }}</th>
                        <td>{{ $cita->nombre_cliente }}</td>
                        <td>{{ $cita->correo_cliente }}</td>
                        <td>{{ $cita->telefono_cliente }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>
                            <span class="fw-bold px-2 py-1 rounded" style="background-color:
                                {{ $cita->estado == 'Cancelada' ? '#f8d7da' : ($cita->estado == 'Completada' ? '#d4edda' : '#cce5ff') }};
                                color: {{ $cita->estado == 'Cancelada' ? '#721c24' : ($cita->estado == 'Completada' ? '#155724' : '#004085') }};
                                display: inline-block;">
                                {{ $cita->estado }}
                            </span>
                        </td>
                    </tr>
                        @empty
                            <tr>
                             <td colspan="7" class="text-center">No hay citas para el filtro seleccionado.</td>
                            </tr>
                        @endforelse
                        <tr>
                        <tr>
                            <td colspan="7">
                                <div class="d-flex justify-content-center">
                                    {{ $citas->links('pagination::bootstrap-4') }}
                                </div>
                            </td>
                        </tr>
                    </tr>
                </tbody>
            </table>

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
