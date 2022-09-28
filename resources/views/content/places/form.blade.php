<div class="row">
    <div class="col-md-4">
        <div class="custom-file">
            <input type="file" name="image"  class="custom-file-input" id="validatedCustomFile">
            <label class="custom-file-label" for="validatedCustomFile">Imagen...</label>
            <div class="invalid-feedback">Debes seleccionar una imagen</div>
        </div>
    </div>

</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('title') ? ' has-error' : ''}}">
            {!! Form::label('title', 'Título: ', ['class' => 'control-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('title', 'Compañia: ', ['class' => 'control-label']) !!}
            {!! Form::select('company', App\Company::pluck('name', 'id'), null, ['placeholder'=>'--Seleccionar--', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('company') }}</small>
            <div class="invalid-feedback">
                {{ __('Debes seleccionar una Compañia') }}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('date') ? ' has-error' : ''}}">
            {!! Form::label('date', 'Fecha: ', ['class' => 'control-label']) !!}
            {!! Form::text('date', null, ['class' => 'form-control datepicker', 'required' => 'required']) !!}
            {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group {{ $errors->has('location') ? ' has-error' : ''}}">
            {!! Form::label('location', 'Ubicación: ', ['class' => 'control-label']) !!}
            {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('content') ? ' has-error' : ''}}">
            {!! Form::label('content', 'Contenido: ', ['class' => 'control-label']) !!}
            {!! Form::textarea('content', null, ['class' => 'form-control textarea', 'required' => 'required']) !!}
            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Actualizar' : 'Guardar', ['class' => 'btn btn-primary', 'onclick' => 'save(this);']) !!}
</div>
