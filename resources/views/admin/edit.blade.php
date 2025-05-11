<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Información de la Clínica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Lora', serif;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1>Editar Información de la Clínica</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card p-4 mb-4">
            <h5 class="mb-3">Información Principal</h5>
            <form action="{{route('admin.clinica.guardar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $clinica->nombre }}" required>
                    @error('nombre') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion">{{ $clinica->descripcion }}</textarea>
                    @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="ubicacion_google_maps" class="form-label">Ubicación Google Maps (URL)</label>
                    <input type="url" class="form-control" id="ubicacion_google_maps" name="ubicacion_google_maps" value="{{ $clinica->ubicacion_google_maps }}">
                    @error('ubicacion_google_maps') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="contacto" class="form-label">Contacto</label>
                    <input type="text" class="form-control" id="contacto" name="contacto" value="{{ $clinica->contacto }}">
                    @error('contacto') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="card p-4 mb-3">
                    <h5 class="mb-3">Imágenes del Carrusel</h5>
                    <div class="row mb-3">
                        @forelse ($clinica->imagenes as $imagen)
                            <img src="{{ asset($imagen->url_imagen) }}" alt="Imagen del Carrusel" class="img-thumbnail p-2 w-25">
                        @empty
                            <p>No hay imágenes en el carrusel.</p>
                        @endforelse
                    </div>
                </div>
                <div class="card p-4 mb-3">
                        <h6>Añadir Nueva Imagen</h6>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Seleccionar Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagenes[]" multiple>
                            @error('imagen') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Información</button>
            </form>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
