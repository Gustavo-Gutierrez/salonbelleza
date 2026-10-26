@extends('adminlte::page')

@section('title', 'Dashboard - Yolanda Studio')

@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-3">Dashboard</h1>
    </div>
</div>

<!-- Estadísticas -->
<div class="row">
    <!-- Citas Hoy -->
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted fw-normal">Citas Hoy</h6>
                        <h3 class="mb-0">{{ $estadisticas['citas_hoy'] }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-day text-primary fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Ingresos Hoy -->
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-start border-success border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted fw-normal">Ingresos Hoy</h6>
                        <h3 class="mb-0">${{ number_format($estadisticas['ingresos_hoy'], 2) }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-dollar-sign text-success fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Clientes Totales -->
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-start border-info border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted fw-normal">Clientes</h6>
                        <h3 class="mb-0">{{ $estadisticas['total_clientes'] }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users text-info fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Productos Bajo Stock -->
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted fw-normal">Bajo Stock</h6>
                        <h3 class="mb-0">{{ $estadisticas['productos_bajo_stock'] }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-exclamation-triangle text-warning fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Citas de Hoy -->
<div class="row">
    <div class="col-12 col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Citas de Hoy</h5>
            </div>
            <div class="card-body">
                @if($citasHoy->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Servicio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($citasHoy as $cita)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i') }}</td>
                                    <td>{{ $cita->cliente->name }}</td>
                                    <td>
                                        @foreach($cita->detalleCitas as $detalle)
                                            {{ $detalle->servicio->nombre }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $cita->estado == 'pendiente' ? 'warning' : ($cita->estado == 'confirmada' ? 'info' : 'success') }}">
                                            {{ ucfirst($cita->estado) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay citas programadas para hoy</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Productos Bajo Stock -->
    <div class="col-12 col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Productos Bajo Stock</h5>
            </div>
            <div class="card-body">
                @if($productosBajoStock->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Stock Actual</th>
                                    <th>Stock Mínimo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productosBajoStock as $producto)
                                <tr>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->categoria }}</td>
                                    <td>
                                        <span class="badge bg-{{ $producto->stock_actual == 0 ? 'danger' : 'warning' }}">
                                            {{ $producto->stock_actual }}
                                        </span>
                                    </td>
                                    <td>{{ $producto->stock_minimo }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <p class="text-muted">Todo el inventario está en niveles adecuados</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Top Servicios -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Servicios Más Solicitados</h5>
            </div>
            <div class="card-body">
                @if($topServicios->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Servicio</th>
                                    <th>Total Citas</th>
                                    <th>Total Servicios</th>
                                    <th>Total Ingresos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topServicios as $servicio)
                                <tr>
                                    <td>{{ $servicio->nombre }}</td>
                                    <td>{{ $servicio->total_citas }}</td>
                                    <td>{{ $servicio->total_servicios }}</td>
                                    <td>${{ number_format($servicio->total_ingresos, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay datos de servicios aún</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection