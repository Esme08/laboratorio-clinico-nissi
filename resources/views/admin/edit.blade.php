<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Información de la Clínica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Lora', serif;
        }
        .navbar {
            font-family: 'Roboto', sans-serif;
            font-size: 1.1rem;
        }
    </style>
</head>
<body class="bg-light">
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
    <div class="container mt-5 ">
        <h1 class=" text-success fw-bold mb-4" style="font-size: 2.5rem;">Actualizar Información de la Clínica</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-4 mb-4 border-success">
            <h5 class="mb-3 fw-bold text-success">Detalles Principales de la Clínica</h5>
            <form action="{{route('admin.clinica.guardar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-4">
                    <label for="nombre" class="form-label fw-bold text-success">Nombre</label>
                    <input type="text" class="form-control shadow-sm border-success" id="nombre" name="nombre" value="{{ $clinica->nombre }}" required>
                    @error('nombre') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="form-label fw-bold text-success">Descripción</label>
                    <textarea class="form-control shadow-sm border-success" id="descripcion" name="descripcion" rows="4" required>{{ $clinica->descripcion }}</textarea>
                    @error('descripcion') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="ubicacion_google_maps" class="form-label fw-bold text-success">Ubicación Google Maps (URL)</label>
                    <input type="url" class="form-control shadow-sm border-success" id="ubicacion_google_maps" name="ubicacion_google_maps" value="{{ $clinica->ubicacion_google_maps }}" required>
                    @error('ubicacion_google_maps') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="contacto" class="form-label fw-bold text-success">Contacto</label>
                    <input type="text" class="form-control shadow-sm border-success" id="contacto" name="contacto" value="{{ $clinica->contacto }}" required>
                    @error('contacto') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="card p-4 mb-4 shadow-sm border-success">
                    <h5 class="mb-3 fw-bold text-success">Imágenes del Carrusel</h5>
                    <div class="row mb-3">
                        @forelse ($clinica->imagenes as $imagen)
                            <div class="col-md-3 mb-3 position-relative">
                                <img src="{{ asset($imagen->url_imagen) }}" alt="Imagen del Carrusel" class="img-thumbnail shadow-sm">
                                <div class="position-absolute top-0 end-0 m-1">
                                <button type="button" onclick="eliminarImagen({{ $imagen->id_imagen }})" class="btn btn-danger btn-sm badge rounded-pill p-2" title="Eliminar Imagen" style="position: absolute; top: 5px; right: 5px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-danger">No hay imágenes en el carrusel.</p>
                        @endforelse
                    </div>
                </div>

                <div class="card p-4 mb-4 shadow-sm border-success">
                    <h5 class="mb-3 fw-bold text-success">Añadir Nueva Imagen</h5>
                    <div class="mb-3">
                        <label for="imagen" class="form-label fw-bold text-success">Seleccionar Imagen</label>
                        <input type="file" class="form-control shadow-sm border-success" id="imagen" name="imagenes[]" multiple>
                        @error('imagen') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success fw-bold shadow-sm px-4 py-2" style="font-size: 1.1rem; border-radius: 8px;">
                    <i class="bi bi-save"></i> Actualizar Información
                </button>
            </form>
            <form id="form-eliminar-imagen" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
            </form>
        </div>


    </div>

   <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        <p>&copy; 2025 {{$clinica->nombre}}. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
    </footer>
    <script>
        function eliminarImagen(id) {
            const form = document.getElementById('form-eliminar-imagen');
            form.action = `/dashboard/info/imagenes/${id}/eliminar`;
            form.submit();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
