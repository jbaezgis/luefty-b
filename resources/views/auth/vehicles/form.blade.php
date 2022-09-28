<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('brand', __('Brand'), ['class' => 'control-label']) !!}
            {!! Form::text('brand', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
            <div class="invalid-feedback">
                {{ __('The Brand is required') }}
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('model', __('Model'), ['class' => 'control-label']) !!}
            {!! Form::text('model', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
            <div class="invalid-feedback">
                {{ __('The Model is required') }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('type', __('Type'), ['class' => 'control-label']) !!}
            {!! Form::text('type', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
            <div class="invalid-feedback">
                {{ __('The Type is required') }}
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('year', __('Year'), ['class' => 'control-label']) !!}
            {!! Form::number('year', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
            <div class="invalid-feedback">
                {{ __('The Year is required') }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('seats', __('Seats'), ['class' => 'control-label']) !!}
            {!! Form::number('seats', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('seats', '<p class="help-block">:message</p>') !!}
            <div class="invalid-feedback">
                {{ __('The Seats is required') }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('condition', __('Condition'), ['class' => 'control-label']) !!}
            {{-- {!! Form::text('condition', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
            {!! Form::select('condition', ['Excellent' => 'Excellent', 'Very good' => 'Very good', 'Acceptable' => 'Acceptable'], null, ['placeholder'=>__('--Select Condition--'), 'class'=>'form-control select2', 'required' ]) !!}
            {!! $errors->first('condition', '<p class="help-block">:message</p>') !!}
            <div class="invalid-feedback">
                {{ __('The Condition is required') }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
            {{-- <div class="custom-control custom-switch">
                <input name="active" value="1" type="checkbox" class="custom-control-input" id="active" {{ $shared->active == 1 ? 'checked' : ''}}>
                <label class="custom-control-label" for="active">{{ __('Shared Shuttles') }}</label>
            </div> --}}
            <div class="checkbox">
                {!! Form::label('gps_installed', __('GPS Installed?')) !!}
                {!! Form::checkbox('gps_installed') !!}
            </div>
            {{-- <div class="">
                {!! Form::label('gps_installed', __('GPS Installed?')) !!}
                {!! Form::checkbox('gps_installed', 1, ['class' => 'form-control']) !!}
            </div> --}}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('vehicles.index')}}" class="btn btn-secondary">{{ __('Cancel') }} </a>
        {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
