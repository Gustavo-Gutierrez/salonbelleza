@extends('adminlte::page')

@section('template_title')
    {{ $citum->name ?? "{{ __('Show') Citum" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Citum</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cita.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $citum->Fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Hora:</strong>
                            {{ $citum->Hora }}
                        </div>
                        <div class="form-group">
                            <strong>Citaid:</strong>
                            {{ $citum->CitaID }}
                        </div>
                        <div class="form-group">
                            <strong>Clienteid:</strong>
                            {{ $citum->ClienteID }}
                        </div>
                        <div class="form-group">
                            <strong>Trabajadoraid:</strong>
                            {{ $citum->TrabajadoraID }}
                        </div>
                        <div class="form-group">
                            <strong>Detalle Citaid:</strong>
                            {{ $citum->Detalle_citaID }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
