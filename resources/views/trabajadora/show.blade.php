@extends('adminlte::page')

@section('template_title')
    {{ $trabajadora->name ?? "{{ __('Show') Trabajadora" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Trabajadora</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('trabajadoras.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ci:</strong>
                            {{ $trabajadora->Ci }}
                        </div>
                        <div class="form-group">
                            <strong>Especialidad:</strong>
                            {{ $trabajadora->Especialidad }}
                        </div>
                        <div class="form-group">
                            <strong>Horario:</strong>
                            {{ $trabajadora->Horario }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $trabajadora->Nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Trabajadoraid:</strong>
                            {{ $trabajadora->TrabajadoraID }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
