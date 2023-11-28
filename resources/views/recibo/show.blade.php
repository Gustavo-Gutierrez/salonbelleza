@extends('adminlte::page')

@section('template_title')
    {{ $recibo->name ?? "{{ __('Show') Recibo" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Recibo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('recibos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $recibo->Fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Total:</strong>
                            {{ $recibo->Total }}
                        </div>
                        <div class="form-group">
                            <strong>Reciboid:</strong>
                            {{ $recibo->ReciboID }}
                        </div>
                        <div class="form-group">
                            <strong>Citaid:</strong>
                            {{ $recibo->CitaID }}
                        </div>
                        <div class="form-group">
                            <strong>Clienteid:</strong>
                            {{ $recibo->ClienteID }}
                        </div>
                        <div class="form-group">
                            <strong>Detallereciboid:</strong>
                            {{ $recibo->DetalleReciboID }}
                        </div>
                        <div class="form-group">
                            <strong>Trabajadoraid:</strong>
                            {{ $recibo->TrabajadoraID }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
