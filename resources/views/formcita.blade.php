<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Lora', serif;
        }

        .form-label .text-danger {
            font-size: 0.8em;
        }

        .accordion-button:not(.collapsed) {
            color: #000;
            background-color: #e9ecef;
        }

        .accordion-button:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        footer {
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg " style="background-color: #b5e8c3;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                Laboratorio Clinico Nissi
            </a>
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Agendar una Cita</h3>
                    <form id="formCita" action="{{ route('cita.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo <span class="text-muted">(Opcional)</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                            <div class="form-text">Ingresa tu nombre si deseas que te contactemos directamente.</div>
                        </div>
                        <div class="mb-3">
                            <label for="fechaCita" class="form-label">Fecha de la Cita <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fechaCita" name="fecha" required>
                            <div class="form-text">Selecciona el día que deseas tu cita. No atendemos los domingos.</div>
                        </div>
                        <div class="mb-3">
                            <label for="hora" class="form-label">Hora de la Cita <span class="text-danger">*</span></label>
                            <select name="hora" id="hora" required class="form-control">
                                <option value="">Selecciona una fecha primero</option>
                            </select>
                            <div class="form-text">Selecciona la hora en la que te gustaría tu cita.</div>
                        </div>

                        <div class="accordion mb-3" id="serviciosAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingServicios">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseServicios" aria-expanded="false" aria-controls="collapseServicios">
                                        Seleccionar Servicios <span class="text-danger">*</span>
                                    </button>
                                </h2>
                                <div id="collapseServicios" class="accordion-collapse collapse" aria-labelledby="headingServicios" data-bs-parent="#serviciosAccordion">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label class="form-label">Servicios Disponibles:</label>
                                            <div id="servicios-lista" class="w-full">
                                            <input type="text" class="form-control mb-3" id="filtro" placeholder="Buscar por nombre o categoria">
                                            @foreach($servicios as $servicio)
                                                <div class="form-check"
                                                data-nombre="{{ strtolower($servicio->nombre) }}"
                                                data-categoria="{{ strtolower($servicio->categoria->nombre ?? '') }}">
                                                    <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id_servicio }}" id="servicio{{ $servicio->id_servicio }}" data-precio="{{ $servicio->precio }}">
                                                    <label class="form-check-label" for="servicio{{ $servicio->id_servicio }}">
                                                       {{$servicio->categoria->nombre}} - {{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio Total Estimado</label>
                                            <input type="text" class="form-control" id="precioTotal" name="precio_total_visual" value="$0.00" readonly>
                                            <input type="hidden" name="precio_total" id="precioTotalReal" value="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico <span class="text-muted">(Opcional)</span></label>
                            <input type="email" class="form-control" id="correo" name="correo">
                            <div class="form-text">Ingresa tu correo si deseas recibir una confirmación de tu cita.</div>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Número de Teléfono <span class="text-muted">(Opcional)</span></label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" pattern="[0-9]{8,}">
                            <div class="form-text">Ingresa tu número de teléfono para que podamos contactarte si es necesario.</div>
                        </div>

                        <button id="submitBtn" type="submit" class="btn btn-dark w-100">Agendar Cita</button>
                        <div id="mensaje" class="mt-3 text-center"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function normalizarTexto(texto) {
        return texto
            .normalize("NFD")                          // separa caracteres con acento
            .replace(/[\u0300-\u036f]/g, "")           // elimina los acentos
            .replace(/[^\w\s]/gi, "")                  // elimina signos de puntuación
            .replace(/\s+/g, " ")                      // elimina espacios múltiples
            .trim()                                    // elimina espacios al inicio/final
            .toLowerCase();
    }

    document.getElementById('filtro').addEventListener('input', function () {
        const filtro = normalizarTexto(this.value);
        const servicios = document.querySelectorAll('.form-check');

        servicios.forEach(servicio => {
            const nombre = normalizarTexto(servicio.getAttribute('data-nombre'));
            const categoria = normalizarTexto(servicio.getAttribute('data-categoria'));

            if (nombre.includes(filtro) || categoria.includes(filtro)) {
                servicio.style.display = '';
            } else {
                servicio.style.display = 'none';
            }
        });
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviciosLista = document.getElementById('servicios-lista');
            const precioTotalInput = document.getElementById('precioTotal');
            const precioTotalRealInput = document.getElementById('precioTotalReal');
            const fechaCita = document.getElementById('fechaCita');
            const horaSelect = document.getElementById('hora');
            const formCita = document.getElementById('formCita');
            const submitBtn = document.getElementById('submitBtn');
            const mensajeDiv = document.getElementById('mensaje');
            const serviciosCheckboxes = serviciosLista.querySelectorAll('input[type="checkbox"]');

            function actualizarPrecioTotal() {
                let precioTotal = 0;
                serviciosCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        precioTotal += parseFloat(checkbox.dataset.precio);
                    }
                });
                precioTotalInput.value = `$${precioTotal.toFixed(2)}`;
                precioTotalRealInput.value = precioTotal.toFixed(2);
            }

            serviciosCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', actualizarPrecioTotal);
            });

            fechaCita.addEventListener('change', function () {
                const diaSemana = new Date(this.value).getDay();
                if (diaSemana === 0) { // Domingo es 0
                    alert('No se pueden agendar citas los domingos.');
                    this.value = '';
                    horaSelect.innerHTML = '<option value="">Selecciona una fecha primero</option>';
                    return;
                }

                if (this.value) {
                    fetch(`/horas-disponibles?fecha=${this.value}`)
                        .then(response => response.json())
                        .then(horas => {
                            horaSelect.innerHTML = '';
                            if (horas.length === 0) {
                                horaSelect.innerHTML = '<option value="">No hay horas disponibles para este día</option>';
                            } else {
                                horaSelect.innerHTML = '<option value="">Selecciona una hora</option>';
                                horas.forEach(hora => {
                                    const option = document.createElement('option');
                                    option.value = hora;
                                    option.textContent = hora;
                                    horaSelect.appendChild(option);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error al obtener horas disponibles:', error);
                            horaSelect.innerHTML = '<option value="">Error al cargar las horas</option>';
                        });
                } else {
                    horaSelect.innerHTML = '<option value="">Selecciona una fecha primero</option>';
                }
            });

            horaSelect.addEventListener('change', function() {
                const fechaSeleccionada = fechaCita.value;
                if (!fechaSeleccionada) return;

                const diaSemana = new Date(fechaSeleccionada).getDay();
                const hora = parseInt(this.value.split(':')[0]);

                if (diaSemana === 6) { // Sábado es 6
                    if (hora < 7 || hora >= 12) {
                        alert('Los sábados solo se pueden agendar citas de 7:00 AM a 12:00 PM.');
                        this.value = '';
                    }
                } else if (diaSemana !== 0) { // Lunes a viernes (0 es domingo)
                    if (hora < 7 || hora >= 16) {
                        alert('Las citas solo se pueden agendar de 7:00 AM a 4:00 PM.');
                        this.value = '';
                    }
                }
            });

            formCita.addEventListener("submit", function(event) {
                event.preventDefault();

                const formData = new FormData(formCita);
                submitBtn.disabled = true;
                mensajeDiv.innerHTML = ''; // Limpiar mensajes previos

                fetch('/verificar-hora-cita', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.ocupada) {
                        mensajeDiv.innerHTML = '<div class="alert alert-danger">La hora seleccionada ya está ocupada. Por favor, elige otra hora.</div>';
                        submitBtn.disabled = false;
                    } else {
                        fetch(formCita.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': formData.get('_token')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                mensajeDiv.innerHTML = '<div class="alert alert-success">Cita agendada correctamente.</div>';
                                formCita.reset();
                                precioTotalInput.value = '$0.00';
                                precioTotalRealInput.value = '0.00';
                                horaSelect.innerHTML = '<option value="">Selecciona una fecha primero</option>';
                                serviciosCheckboxes.forEach(cb => cb.checked = false);
                            } else {
                                mensajeDiv.innerHTML = '<div class="alert alert-danger">Error al agendar la cita: ' + (data.message || 'Error desconocido.') + '</div>';
                            }
                        })
                        .catch(error => {
                            mensajeDiv.innerHTML = '<div class="alert alert-danger">Error al agendar la cita: ' + (error.message || 'Error desconocido.') + '</div>';
                        })
                        .finally(() => {
                            submitBtn.disabled = false;
                        });
                    }
                })
                .catch(error => {
                    mensajeDiv.innerHTML = '<div class="alert alert-danger">Error al verificar la hora de la cita.</div>';
                    submitBtn.disabled = false;
                });
            });
        });
    </script>
