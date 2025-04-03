<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <nav class="navbar navbar-expand-lg " style="background-color: #b5e8c3;">
        </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h3 class="text-center">Agendar una Cita</h3>
                    <form action="{{ route('cita.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" pattern="[0-9]{8,}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hora</label>
                            <input type="time" class="form-control" name="hora" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Selecciona el Servicio o Combo</label>
                            <select class="form-select" name="servicio_combo" required>
                                <option value="">Selecciona una opción</option>
                                @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->id_servicio }}">{{ $servicio->nombre }}</option>
                                @endforeach
                                @foreach($combos as $combo)
                                    <option value="{{ $combo->id_combo }}">{{ $combo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Agendar Cita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center p-3 mt-4" style="background-color: #b5e8c3;">
        </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>