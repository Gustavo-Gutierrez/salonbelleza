<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::text('Fecha', $citum->Fecha, ['class' => 'form-control' . ($errors->has('Fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('Fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Hora') }}
            {{ Form::text('Hora', $citum->Hora, ['class' => 'form-control' . ($errors->has('Hora') ? ' is-invalid' : ''), 'placeholder' => 'Hora']) }}
            {!! $errors->first('Hora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CitaID') }}
            {{ Form::text('CitaID', $citum->CitaID, ['class' => 'form-control' . ($errors->has('CitaID') ? ' is-invalid' : ''), 'placeholder' => 'Citaid']) }}
            {!! $errors->first('CitaID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ClienteID') }}
            {{ Form::text('ClienteID', $citum->ClienteID, ['class' => 'form-control' . ($errors->has('ClienteID') ? ' is-invalid' : ''), 'placeholder' => 'Clienteid']) }}
            {!! $errors->first('ClienteID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('TrabajadoraID') }}
            {{ Form::text('TrabajadoraID', $citum->TrabajadoraID, ['class' => 'form-control' . ($errors->has('TrabajadoraID') ? ' is-invalid' : ''), 'placeholder' => 'Trabajadoraid']) }}
            {!! $errors->first('TrabajadoraID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Detalle_citaID') }}
            {{ Form::text('Detalle_citaID', $citum->Detalle_citaID, ['class' => 'form-control' . ($errors->has('Detalle_citaID') ? ' is-invalid' : ''), 'placeholder' => 'Detalle Citaid']) }}
            {!! $errors->first('Detalle_citaID', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>