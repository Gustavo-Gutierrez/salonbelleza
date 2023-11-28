<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::text('Fecha', $recibo->Fecha, ['class' => 'form-control' . ($errors->has('Fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('Fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Total') }}
            {{ Form::text('Total', $recibo->Total, ['class' => 'form-control' . ($errors->has('Total') ? ' is-invalid' : ''), 'placeholder' => 'Total']) }}
            {!! $errors->first('Total', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
        <div class="form-group">
            {{ Form::label('CitaID') }}
            {{ Form::text('CitaID', $recibo->CitaID, ['class' => 'form-control' . ($errors->has('CitaID') ? ' is-invalid' : ''), 'placeholder' => 'Citaid']) }}
            {!! $errors->first('CitaID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ClienteID') }}
            {{ Form::text('ClienteID', $recibo->ClienteID, ['class' => 'form-control' . ($errors->has('ClienteID') ? ' is-invalid' : ''), 'placeholder' => 'Clienteid']) }}
            {!! $errors->first('ClienteID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('DetalleReciboID') }}
            {{ Form::text('DetalleReciboID', $recibo->DetalleReciboID, ['class' => 'form-control' . ($errors->has('DetalleReciboID') ? ' is-invalid' : ''), 'placeholder' => 'Detallereciboid']) }}
            {!! $errors->first('DetalleReciboID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('TrabajadoraID') }}
            {{ Form::text('TrabajadoraID', $recibo->TrabajadoraID, ['class' => 'form-control' . ($errors->has('TrabajadoraID') ? ' is-invalid' : ''), 'placeholder' => 'Trabajadoraid']) }}
            {!! $errors->first('TrabajadoraID', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>