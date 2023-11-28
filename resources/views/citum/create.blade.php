@extends('adminlte::page')

@section('template_title')
    Create New Citum
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Create New Citum') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cita.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Back') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('cita.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="date" name="Fecha" id="fecha" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora:</label>
                                <input type="time" name="Hora" id="hora" class="form-control" required value="{{ now('America/La_Paz')->format('H:i') }}">
                            </div>
                            

                            <div class="form-group">
                                <label for="cliente">Cliente:</label>
                                <select name="ClienteID" id="cliente" class="form-control">
                                    {{-- Mostrar opciones de clientes --}}
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->ClienteID }}">{{ $cliente->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                    <label for="trabajadora">Trabajadora:</label>
                                    <select name="TrabajadoraID" id="trabajadora" class="form-control">
                                        {{-- Mostrar opciones de trabajadoras --}}
                                        @foreach($trabajadoras as $trabajadora)
                                            <option value="{{ $trabajadora->TrabajadoraID }}">{{ $trabajadora->Nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                           
                            <div class="form-group">
                                <label for="detalle_cita">Servicios para la Cita:</label>
                                <select name="Servicios[]" id="detalle_cita" class="form-control" multiple>
                                    {{-- Mostrar opciones de servicios --}}
                                    @foreach($servicios as $servicio)
                                        <option value="{{ $servicio->ServicioID }}">{{ $servicio->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            

                            <button type="submit" class="btn btn-primary">Guardar Cita</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection