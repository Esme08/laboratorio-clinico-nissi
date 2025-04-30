<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Lora', serif;
        }
        nav {
            background-color: #b5e8c3;
        }
        footer {
            padding: 10px;
            text-align: center;
            font-size: 14px;
            background-color: #b5e8c3;
            margin-top: 2rem;
        }
        .form-control {
            margin-bottom: 2rem;
        }
        h3 {
            margin-bottom: 2rem;
        }
        .form-label .text-muted {
            font-size: 0.8em;
            font-style: italic;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg t">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
                Laboratorio Clinico Nissi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
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
                    <h3 class="text-center">🗓️ Agendar una Cita</h3>
                    <form id="formCita" action="{{ route('cita.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">👤 Nombre Completo</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ej: Laura Tejada" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> 📧 Correo Electrónico(Opcional)</label>
                            <input type="email" class="form-control" name="correo" placeholder="Ej: laura@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">📞Teléfono(Opcional)</label>
                            <input type="tel" class="form-control" name="telefono" pattern="[0-9]{8,}" placeholder="Ej: 78945612">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">📅 Fecha de la Cita</label>
                            <input type="date" class="form-control" name="fecha" id="fechaCita" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora">🕒 Hora </label>
                            <select name="hora" id="hora" required class="form-control">
                                <option value="">Selecciona una fecha primero</option>
                            </select>
                        </div>
                        <div class="mb-3" style="display: flex; flex-direction: column;">
                            <label class="form-label">🧪 Selecciona los Servicios</label>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#serviciosModal">
                                Buscar y Añadir Servicios
                            </button>
                            <label class="form-label mt-3">Servicios Seleccionados</label>
                            <ul id="servicios-seleccionados-lista" class="list-group">
                            </ul>
                            <input type="hidden" name="precio_total" id="precioTotal" value="0.00">
                        </div>

                        <button id="submitBtn" type="submit" class="btn btn-dark w-100">Agendar Cita</button>
                        <div id="mensaje" class="mt-3 text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="serviciosModal" tabindex="-1" aria-labelledby="serviciosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviciosModalLabel">Seleccionar Servicios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" id="buscarServicio" class="form-control" placeholder="Buscar por nombre o categoría...">
                    </div>
                    <div id="lista-servicios-modal">
                        @foreach($servicios as $servicio)
                            <div class="servicio-item-modal justify-content-between align-items-center mb-2"
                                 data-id="{{ $servicio->id_servicio }}"
                                 data-nombre="{{ $servicio->nombre }}"
                                 data-precio="{{ $servicio->precio }}"
                                 data-categoria="{{ $servicio->categoria->nombre }}">
                                <div>
                                    {{$servicio->categoria->nombre}} - {{ $servicio->nombre }} - ${{ $servicio->precio }}
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-success agregar-servicio-modal">
                                    +
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center p-3 mt-4">
        <p>&copy; 2025 Laboratorio Clinico Nissi. Todos los derechos reservados.</p>
        <p>"Tu salud es nuestra prioridad, confía en nosotros para obtener un diagnóstico preciso."</p>
        <img src="{{ asset('imagenes/farmacia.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        const serviciosModal = document.getElementById('serviciosModal');
        const listaServiciosModal = document.getElementById('lista-servicios-modal');
        const buscarServicioInput = document.getElementById('buscarServicio');
        const serviciosSeleccionadosLista = document.getElementById('servicios-seleccionados-lista');
        const precioTotalInput = document.getElementById('precioTotal');
        const fechaCita = document.getElementById('fechaCita');
        const horaSelect = document.getElementById('hora');
        const formCita = document.getElementById('formCita');
        const submitBtn = document.getElementById('submitBtn');
        const mensajeDiv = document.getElementById('mensaje');
        const buscarServiciosBtn = document.querySelector('#serviciosModal button[data-bs-toggle="modal"]'); // Selecciona el botón

        let serviciosSeleccionados = [];
        let todosLosServiciosModal = [];

        serviciosModal.addEventListener('show.bs.modal', function () {
            todosLosServiciosModal = Array.from(listaServiciosModal.querySelectorAll('.servicio-item-modal')).map(item => ({
                id: item.dataset.id,
                nombre: item.dataset.nombre,
                categoria: item.dataset.categoria,
                precio: parseFloat(item.dataset.precio),
                elemeto: item
            }));

            actualizarEstadoServiciosEnModal();
            filtrarServicios();

        });

        function actualizarListaServiciosSeleccionados() {
            serviciosSeleccionadosLista.innerHTML = '';
            serviciosSeleccionados.forEach(servicio => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                listItem.textContent = servicio.nombre + ' - $' + servicio.precio.toFixed(2);

                const botonEliminar = document.createElement('button');
                botonEliminar.type = 'button';
                botonEliminar.classList.add('btn', 'btn-sm', 'btn-outline-danger');
                botonEliminar.textContent = 'x';
                botonEliminar.addEventListener('click', function() {
                    serviciosSeleccionados = serviciosSeleccionados.filter(s => s.id !== servicio.id);
                    actualizarListaServiciosSeleccionados();
                    actualizarPrecioTotal();
                    actualizarEstadoServiciosEnModal(); // Actualizar el estado en el modal también
                });
                listItem.appendChild(botonEliminar);

                serviciosSeleccionadosLista.appendChild(listItem);
            });
            actualizarPrecioTotal();
        }

        function actualizarPrecioTotal() {
            let precioTotal = 0;
            serviciosSeleccionados.forEach(servicio => {
                precioTotal += servicio.precio;
            });
            precioTotalInput.value = precioTotal.toFixed(2);
        }

        function actualizarEstadoServiciosEnModal() {
            const serviciosItemsModal = listaServiciosModal.querySelectorAll('.servicio-item-modal');
            serviciosItemsModal.forEach(item => {
                const servicioIdModal = item.dataset.id;
                const agregarBoton = item.querySelector('.agregar-servicio-modal');

                if (serviciosSeleccionados.some(servicio => servicio.id === servicioIdModal)) {
                    item.style.backgroundColor = '#e0f7e6'; // Fondo verde claro
                    agregarBoton.innerHTML = '<i class="bi bi-check-lg"></i>'; // Icono de check
                    agregarBoton.classList.remove('btn-outline-success');
                    agregarBoton.classList.add('btn-success', 'disabled'); // Deshabilitar el botón
                } else {
                    item.style.backgroundColor = ''; // Restablecer fondo
                    agregarBoton.innerHTML = '+';
                    agregarBoton.classList.remove('btn-success', 'disabled');
                    agregarBoton.classList.add('btn-outline-success');
                }
            });
        }


        // Evento para agregar servicios desde el modal
        serviciosModal.addEventListener('click', function(event) {
            if (event.target.classList.contains('agregar-servicio-modal')) {
                const servicioId = event.target.parentElement.dataset.id;
                const servicioNombre = event.target.parentElement.dataset.nombre;
                const servicioPrecio = parseFloat(event.target.parentElement.dataset.precio);

                const servicioExistente = serviciosSeleccionados.find(item => item.id === servicioId);
                if (!servicioExistente) {
                    serviciosSeleccionados.push({ id: servicioId, nombre: servicioNombre, precio: servicioPrecio });
                    actualizarListaServiciosSeleccionados();
                    actualizarEstadoServiciosEnModal();
                }
            }
        });
        function normalizarTexto(texto) {
            return texto
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")    // elimina acentos
            .replace(/[^\w\s]/gi, "")           // elimina signos de puntuación
            .replace(/\s+/g, " ")               // espacios múltiples a uno solo
            .trim()
            .toLowerCase();
        }

        function filtrarServicios() {
            const filtro = normalizarTexto(buscarServicioInput.value);
            todosLosServiciosModal.forEach(servicio => {
            const nombre = normalizarTexto(servicio.nombre);
            const categoria = normalizarTexto(servicio.categoria);

            if (nombre.includes(filtro) || categoria.includes(filtro)) {
                servicio.elemeto.style.display = 'flex';

            } else {
                servicio.elemeto.style.display = 'none';

            }
            });
        }

        //Evento para filtrar servicios en el modal
        buscarServicioInput.addEventListener('input', () => {
            filtrarServicios();
        });

        fechaCita.addEventListener('change', function () {
            const diaSemana = new Date(this.value).getDay();
            if (diaSemana === 6) { // Domingo es 0
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
            if (!fechaSeleccionada) {
                alert('Por favor, selecciona una fecha primero.');
                this.value = '';
                return;
            }

            const diaSemana = new Date(fechaSeleccionada).getDay();
            const horaSeleccionada = parseInt(this.value.split(':')[0]);

            let mensajeRestriccion = '';

            if (diaSemana === 5) { // Sábado es 6
                if (horaSeleccionada < 7 || horaSeleccionada >= 12) { // Hasta las 12:00 PM
                    mensajeRestriccion = 'Los sábados solo se pueden agendar citas de 7:00 AM a 12:00 PM.';
                }
            } else if (diaSemana !== 0) { // Lunes a Viernes (0 es Domingo)
                if (horaSeleccionada < 7 || horaSeleccionada >= 17) { // Hasta las 4:00 PM
                    mensajeRestriccion = 'Las citas solo se pueden agendar de 7:00 AM a 4:00 PM.';
                }
            }

            if (mensajeRestriccion) {
                alert(mensajeRestriccion);
                this.value = '';
            }
        });

        formCita.addEventListener("submit", function(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            // Obtén los IDs de los servicios seleccionados
            const serviciosIds = serviciosSeleccionados.map(servicio => servicio.id);

            // Añade cada ID de servicio al FormData como un array 'servicios[]'
            serviciosIds.forEach(id => {
                formData.append('servicios[]', id);
            });

            submitBtn.disabled = true;
            mensajeDiv.innerHTML = ''; // Limpiar mensajes anteriores

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
                    fetch(form.action, {
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
                            form.reset();
                            serviciosSeleccionados = [];
                            actualizarListaServiciosSeleccionados();
                            actualizarEstadoServiciosEnModal();
                            precioTotalInput.value = '0.00';
                            horaSelect.innerHTML = '<option value="">Selecciona una fecha primero</option>';
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
        // Limpiar la lista y el precio al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            serviciosSeleccionados = [];
            actualizarListaServiciosSeleccionados();
            precioTotalInput.value = '0.00';
        });
    </script>
</body>
</html>
