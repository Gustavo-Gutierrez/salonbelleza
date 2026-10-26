@extends('adminlte::page')


@section('title', 'Citas - Yolanda Studio')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Gestión de Citas</h1>
                <div>
                    <a href="{{ route('citas.create') }}" class="btn btn-yolanda">
                        <i class="fas fa-plus me-2"></i> Nueva Cita
                    </a>
                    <a href="{{ route('citas.agenda') }}" class="btn btn-outline-yolanda">
                        <i class="fas fa-calendar-alt me-2"></i> Calendario
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('citas.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" 
                                   value="{{ request('fecha') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="">Todos los estados</option>
                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                <option value="en_proceso" {{ request('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                                <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select class="form-select" id="cliente_id" name="cliente_id">
                                <option value="">Todos los clientes</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="empleado_id" class="form-label">Empleado</label>
                            <select class="form-select" id="empleado_id" name="empleado_id">
                                <option value="">Todos los empleados</option>
                                @foreach($empleados as $empleado)
                                    <option value="{{ $empleado->id }}" {{ request('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-yolanda">
                                <i class="fas fa-filter me-2"></i> Filtrar
                            </button>
                            <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Pendientes</h6>
                            <h3 class="mb-0">{{ $citas->where('estado', 'pendiente')->count() }}</h3>
                        </div>
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Confirmadas</h6>
                            <h3 class="mb-0">{{ $citas->where('estado', 'confirmada')->count() }}</h3>
                        </div>
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Completadas</h6>
                            <h3 class="mb-0">{{ $citas->where('estado', 'completada')->count() }}</h3>
                        </div>
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Canceladas</h6>
                            <h3 class="mb-0">{{ $citas->where('estado', 'cancelada')->count() }}</h3>
                        </div>
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Citas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($citas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Cliente</th>
                                        <th>Empleado</th>
                                        <th>Servicios</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($citas as $cita)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">{{ $cita->codigo }}</span>
                                        </td>
                                        <td>{{ $cita->fecha->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title bg-light rounded">
                                                        {{ substr($cita->cliente->name, 0, 2) }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $cita->cliente->name }}</h6>
                                                    <small class="text-muted">{{ $cita->cliente->codigo_cliente }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $cita->empleado->name }}</td>
                                        <td>
                                            @foreach($cita->detalleCitas as $detalle)
                                                <span class="badge bg-light text-dark mb-1">
                                                    {{ $detalle->servicio->nombre }} x{{ $detalle->cantidad }}
                                                </span><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <strong>${{ number_format($cita->total_final, 2) }}</strong>
                                            @if($cita->descuento > 0)
                                                <br>
                                                <small class="text-success">
                                                    <i class="fas fa-tag me-1"></i>
                                                    -${{ number_format($cita->descuento, 2) }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = [
                                                    'pendiente' => 'warning',
                                                    'confirmada' => 'info',
                                                    'en_proceso' => 'primary',
                                                    'completada' => 'success',
                                                    'cancelada' => 'danger'
                                                ][$cita->estado];
                                            @endphp
                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ ucfirst(str_replace('_', ' ', $cita->estado)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('citas.show', $cita) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('citas.edit', $cita) }}" 
                                                   class="btn btn-sm btn-warning" 
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($cita->estado != 'completada' && $cita->estado != 'cancelada')
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" 
                                                            type="button" 
                                                            data-bs-toggle="dropdown"
                                                            title="Cambiar estado">
                                                        <i class="fas fa-exchange-alt"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach(['pendiente', 'confirmada', 'en_proceso', 'completada', 'cancelada'] as $estado)
                                                            @if($estado != $cita->estado)
                                                                <li>
                                                                    <form action="{{ route('citas.cambiar-estado', $cita) }}" 
                                                                          method="POST" 
                                                                          class="d-inline">
                                                                        @csrf
                                                                        <input type="hidden" name="estado" value="{{ $estado }}">
                                                                        <button type="submit" class="dropdown-item">
                                                                            Cambiar a {{ ucfirst(str_replace('_', ' ', $estado)) }}
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                                <form action="{{ route('citas.destroy', $cita) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar esta cita?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Paginación -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                Mostrando {{ $citas->firstItem() }} a {{ $citas->lastItem() }} de {{ $citas->total() }} registros
                            </div>
                            <div>
                                {{ $citas->links() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">No hay citas registradas</h4>
                            <p class="text-muted">Comienza creando tu primera cita</p>
                            <a href="{{ route('citas.create') }}" class="btn btn-yolanda">
                                <i class="fas fa-plus me-2"></i> Crear Primera Cita
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-title {
        font-size: 0.875rem;
        font-weight: 600;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Inicializar DataTable
        $('.datatable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            },
            order: [[1, 'desc']], // Ordenar por fecha descendente
            pageLength: 25,
            responsive: true
        });
    });
</script>
@endpush