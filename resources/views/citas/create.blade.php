@extends('adminlte::page')

@section('title', 'Nueva Cita - Yolanda Studio')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Nueva Cita</h1>
                <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('citas.store') }}" method="POST" id="citaForm">
                        @csrf

                        <!-- Información Básica -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i> Información Básica</h5>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input type="date" 
                                       class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" 
                                       name="fecha" 
                                       value="{{ old('fecha', date('Y-m-d')) }}"
                                       min="{{ date('Y-m-d') }}"
                                       required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="hora_inicio" class="form-label">Hora de Inicio *</label>
                                <select class="form-select @error('hora_inicio') is-invalid @enderror" 
                                        id="hora_inicio" 
                                        name="hora_inicio" 
                                        required>
                                    <option value="">Seleccionar hora...</option>
                                    @php
                                        $hora = \Carbon\Carbon::parse('09:00');
                                        while ($hora->format('H:i') <= '19:00') {
                                            echo '<option value="' . $hora->format('H:i') . '">' . $hora->format('H:i') . '</option>';
                                            $hora->addMinutes(30);
                                        }
                                    @endphp
                                </select>
                                @error('hora_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="cliente_id" class="form-label">Cliente *</label>
                                <select class="form-select select2 @error('cliente_id') is-invalid @enderror" 
                                        id="cliente_id" 
                                        name="cliente_id" 
                                        required>
                                    <option value="">Seleccionar cliente...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" 
                                                {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}
                                                data-phone="{{ $cliente->phone }}"
                                                data-email="{{ $cliente->email }}">
                                            {{ $cliente->name }} - {{ $cliente->codigo_cliente }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="empleado_id" class="form-label">Empleado *</label>
                                <select class="form-select select2 @error('empleado_id') is-invalid @enderror" 
                                        id="empleado_id" 
                                        name="empleado_id" 
                                        required>
                                    <option value="">Seleccionar empleado...</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" 
                                                {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                            {{ $empleado->name }} - {{ $empleado->especialidad }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('empleado_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="notas" class="form-label">Notas</label>
                                <textarea class="form-control @error('notas') is-invalid @enderror" 
                                          id="notas" 
                                          name="notas" 
                                          rows="2">{{ old('notas') }}</textarea>
                                @error('notas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Servicios -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5><i class="fas fa-spa me-2"></i> Servicios</h5>
                                    <button type="button" class="btn btn-sm btn-outline-yolanda" id="agregarServicio">
                                        <i class="fas fa-plus me-1"></i> Agregar Servicio
                                    </button>
                                </div>
                                
                                <div id="servicios-container">
                                    <!-- Los servicios se agregarán aquí dinámicamente -->
                                </div>
                                
                                <!-- Plantilla para servicio -->
                                <template id="servicio-template">
                                    <div class="servicio-item card mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-5 mb-2">
                                                    <label class="form-label">Servicio *</label>
                                                    <select class="form-select servicio-select" name="servicios[][id]" required>
                                                        <option value="">Seleccionar servicio...</option>
                                                        @foreach($servicios as $servicio)
                                                            <option value="{{ $servicio->id }}" 
                                                                    data-precio="{{ $servicio->precio }}"
                                                                    data-duracion="{{ $servicio->duracion_minutos }}">
                                                                {{ $servicio->nombre }} - ${{ number_format($servicio->precio, 2) }} 
                                                                ({{ $servicio->duracion_minutos }} min)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label class="form-label">Cantidad *</label>
                                                    <input type="number" 
                                                           class="form-control cantidad-input" 
                                                           name="servicios[][cantidad]" 
                                                           min="1" 
                                                           value="1" 
                                                           required>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label class="form-label">Subtotal</label>
                                                    <input type="text" 
                                                           class="form-control subtotal-input" 
                                                           value="$0.00" 
                                                           readonly>
                                                </div>
                                                <div class="col-md-1 mb-2 text-center">
                                                    <label class="form-label">&nbsp;</label>
                                                    <button type="button" class="btn btn-danger btn-sm eliminar-servicio">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Resumen y Total -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="mb-3"><i class="fas fa-calculator me-2"></i> Resumen</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="duracion_total" class="form-label">Duración Total</label>
                                                    <div class="input-group">
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="duracion_total" 
                                                               value="0 minutos" 
                                                               readonly>
                                                        <span class="input-group-text">
                                                            <i class="fas fa-clock"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="total_servicios" class="form-label">Total Servicios</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="text" 
                                                               class="form-control" 
                                                               id="total_servicios" 
                                                               value="0.00" 
                                                               readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="descuento" class="form-label">Descuento</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" 
                                                               class="form-control" 
                                                               id="descuento" 
                                                               name="descuento" 
                                                               min="0" 
                                                               step="0.01"
                                                               value="{{ old('descuento', 0) }}">
                                                    </div>
                                                    <small class="text-muted">Ingresa el descuento si aplica</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="total_final" class="form-label">Total Final</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="text" 
                                                               class="form-control fw-bold fs-4 text-success" 
                                                               id="total_final" 
                                                               value="0.00" 
                                                               readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-yolanda">
                                        <i class="fas fa-save me-2"></i> Guardar Cita
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Panel Lateral -->
        <div class="col-lg-4">
            <!-- Información del Cliente -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i> Información del Cliente</h5>
                </div>
                <div class="card-body">
                    <div id="cliente-info" class="text-center text-muted">
                        <i class="fas fa-user-circle fa-3x mb-3"></i>
                        <p>Selecciona un cliente para ver su información</p>
                    </div>
                </div>
            </div>

            <!-- Horarios Disponibles -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i> Horarios Disponibles</h5>
                </div>
                <div class="card-body">
                    <div id="horarios-container" class="text-center text-muted">
                        <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                        <p>Selecciona fecha y empleado para ver horarios disponibles</p>
                    </div>
                </div>
            </div>

            <!-- Información de Empleado -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i> Información del Empleado</h5>
                </div>
                <div class="card-body">
                    <div id="empleado-info" class="text-center text-muted">
                        <i class="fas fa-user-tie fa-3x mb-3"></i>
                        <p>Selecciona un empleado para ver su información</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .servicio-item {
        border-left: 4px solid var(--primary-color);
    }
    .servicio-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .horario-disponible {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .horario-disponible:hover {
        background-color: #e9ecef;
        transform: translateY(-2px);
    }
    .horario-seleccionado {
        background-color: var(--primary-color) !important;
        color: white !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Variables globales
        let servicioCount = 0;
        const servicioTemplate = $('#servicio-template').html();

        // Inicializar Select2
        $('.select2').select2({
            theme: 'bootstrap-5'
        });

        // Agregar primer servicio automáticamente
        agregarServicio();

        // Agregar servicio
        $('#agregarServicio').click(function() {
            agregarServicio();
        });

        // Función para agregar servicio
        function agregarServicio() {
            servicioCount++;
            const servicioHtml = servicioTemplate.replace(/\[\]/g, `[${servicioCount}]`);
            $('#servicios-container').append(servicioHtml);
            
            // Inicializar Select2 para el nuevo select
            $('#servicios-container .servicio-select:last').select2({
                theme: 'bootstrap-5'
            });
            
            // Agregar eventos al nuevo servicio
            const servicioItem = $('#servicios-container .servicio-item:last');
            servicioItem.find('.servicio-select').change(actualizarServicio);
            servicioItem.find('.cantidad-input').on('input', actualizarServicio);
            servicioItem.find('.eliminar-servicio').click(function() {
                if ($('#servicios-container .servicio-item').length > 1) {
                    $(this).closest('.servicio-item').remove();
                    actualizarResumen();
                } else {
                    alert('Debe haber al menos un servicio');
                }
            });
        }

        // Actualizar información de servicio
        function actualizarServicio() {
            const item = $(this).closest('.servicio-item');
            const select = item.find('.servicio-select');
            const cantidad = item.find('.cantidad-input').val();
            const precio = select.find(':selected').data('precio') || 0;
            const subtotal = precio * cantidad;
            
            item.find('.subtotal-input').val('$' + subtotal.toFixed(2));
            actualizarResumen();
        }

        // Actualizar resumen
        function actualizarResumen() {
            let duracionTotal = 0;
            let totalServicios = 0;
            
            $('#servicios-container .servicio-item').each(function() {
                const select = $(this).find('.servicio-select');
                const cantidad = $(this).find('.cantidad-input').val();
                const precio = select.find(':selected').data('precio') || 0;
                const duracion = select.find(':selected').data('duracion') || 0;
                
                duracionTotal += duracion * cantidad;
                totalServicios += precio * cantidad;
            });
            
            const descuento = parseFloat($('#descuento').val()) || 0;
            const totalFinal = totalServicios - descuento;
            
            $('#duracion_total').val(duracionTotal + ' minutos');
            $('#total_servicios').val(totalServicios.toFixed(2));
            $('#total_final').val(totalFinal.toFixed(2));
        }

        // Actualizar resumen cuando cambia el descuento
        $('#descuento').on('input', actualizarResumen);

        // Cargar información del cliente
        $('#cliente_id').change(function() {
            const clienteId = $(this).val();
            const selectedOption = $(this).find(':selected');
            
            if (clienteId) {
                $.ajax({
                    url: '{{ route("clientes.info") }}',
                    method: 'GET',
                    data: { id: clienteId },
                    success: function(response) {
                        const html = `
                            <div class="text-start">
                                <h6 class="mb-2">${response.name}</h6>
                                <p class="mb-1">
                                    <i class="fas fa-phone me-2"></i>
                                    ${response.phone || 'No registrado'}
                                </p>
                                <p class="mb-1">
                                    <i class="fas fa-envelope me-2"></i>
                                    ${response.email}
                                </p>
                                <p class="mb-1">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    ${response.address || 'No registrada'}
                                </p>
                                <p class="mb-1">
                                    <i class="fas fa-tag me-2"></i>
                                    ${response.codigo_cliente}
                                </p>
                                <hr>
                                <p class="mb-1">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    ${response.citas_completadas} citas completadas
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-dollar-sign me-2"></i>
                                    Total gastado: $${response.total_gastado}
                                </p>
                            </div>
                        `;
                        $('#cliente-info').html(html);
                    }
                });
            } else {
                $('#cliente-info').html(`
                    <i class="fas fa-user-circle fa-3x mb-3"></i>
                    <p>Selecciona un cliente para ver su información</p>
                `);
            }
        });

        // Cargar información del empleado
        $('#empleado_id').change(function() {
            const empleadoId = $(this).val();
            const selectedOption = $(this).find(':selected');
            
            if (empleadoId) {
                const html = `
                    <div class="text-start">
                        <h6 class="mb-2">${selectedOption.text().split(' - ')[0]}</h6>
                        <p class="mb-1">
                            <i class="fas fa-briefcase me-2"></i>
                            ${selectedOption.text().split(' - ')[1] || 'Sin especialidad'}
                        </p>
                        <hr>
                        <p class="mb-0 text-muted">
                            <small>Selecciona fecha para ver horarios disponibles</small>
                        </p>
                    </div>
                `;
                $('#empleado-info').html(html);
                
                // Cargar horarios disponibles si ya hay fecha
                if ($('#fecha').val()) {
                    cargarHorariosDisponibles();
                }
            } else {
                $('#empleado-info').html(`
                    <i class="fas fa-user-tie fa-3x mb-3"></i>
                    <p>Selecciona un empleado para ver su información</p>
                `);
            }
        });

        // Cargar horarios disponibles
        function cargarHorariosDisponibles() {
            const fecha = $('#fecha').val();
            const empleadoId = $('#empleado_id').val();
            
            if (fecha && empleadoId) {
                $.ajax({
                    url: '{{ route("citas.horarios-disponibles") }}',
                    method: 'GET',
                    data: {
                        fecha: fecha,
                        empleado_id: empleadoId
                    },
                    beforeSend: function() {
                        $('#horarios-container').html(`
                            <div class="text-center">
                                <div class="spinner-border spinner-border-sm text-yolanda" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                                <p class="mt-2">Buscando horarios disponibles...</p>
                            </div>
                        `);
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            let html = '<div class="row g-2">';
                            response.forEach(function(horario) {
                                html += `
                                    <div class="col-4">
                                        <button type="button" 
                                                class="btn btn-outline-secondary w-100 horario-disponible"
                                                data-hora="${horario}">
                                            ${horario}
                                        </button>
                                    </div>
                                `;
                            });
                            html += '</div>';
                            $('#horarios-container').html(html);
                            
                            // Agregar evento a los horarios
                            $('.horario-disponible').click(function() {
                                $('.horario-disponible').removeClass('horario-seleccionado btn-yolanda');
                                $(this).addClass('horario-seleccionado btn-yolanda');
                                $('#hora_inicio').val($(this).data('hora')).trigger('change');
                            });
                        } else {
                            $('#horarios-container').html(`
                                <div class="text-center text-danger">
                                    <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                    <p>No hay horarios disponibles para esta fecha</p>
                                </div>
                            `);
                        }
                    },
                    error: function() {
                        $('#horarios-container').html(`
                            <div class="text-center text-danger">
                                <i class="fas
    fa-exclamation-triangle fa-3x mb-3"></i>
                                <p>Error al cargar horarios disponibles</p>
                            </div>
                        `);
                    }
                });
            }
        }

        // Cargar horarios cuando cambia la fecha o el empleado
        $('#fecha, #empleado_id').change(function() {
            cargarHorariosDisponibles();
        });
    });
</script>
@endpush