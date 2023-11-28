@extends('adminlte::page')

@section('template_title')
    {{ $servicio->name ?? "{{ __('Show') Servicio" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Servicio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('servicios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $servicio->Nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $servicio->Precio }}
                        </div>
                        <div class="form-group">
                            <strong>Servicioid:</strong>
                            {{ $servicio->ServicioID }}
                        </div>
                        <div class="form-group">
                            <strong>Detalle Servicioid:</strong>
                            {{ $servicio->Detalle_servicioID }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
