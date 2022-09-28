@csrf
@if($mode == 'update')
    <div class="row">
        <div class="col-md-12">

            <div class="custom-file">
                <input type="file" name="image" id="post-image" class="" id="validatedCustomFile">
            </div>
        </div>
    </div>
    <p></p>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="from" class="control-label">{{__('Country')}}</label><br>
            {!! Form::select('country_id', App\Country::where('active', 1)->orderBy('en_name', 'asc')->pluck('en_name', 'id'), null, ['id'=>'country_id', 'placeholder'=>'', 'class'=>'form-control select2', $mode == 'create' ? '' : 'disabled' => 'disabled' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('country_id') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Country') }}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="from" class="control-label">{{__('Region')}}</label><br>
            {!! Form::select('region_id', App\Region::where('active', 1)->orderBy('name', 'asc')->pluck('name', 'id'), null, ['id'=>'region_id', 'placeholder'=>'', 'class'=>'form-control select2' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('region_id') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Region') }}
            </div>
        </div>
    </div>

    <div class="col-md-2">
        {!! Form::label('is_airport', __('Is airpot?'), ['class' => 'control-label']) !!}
        {!! Form::select('is_airport', array('0' => 'No', '1' => 'Yes'), null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-md-2">
        {!! Form::label('active', __('Status'), ['class' => 'control-label']) !!}
        {!! Form::select('active', array('1' => 'Active', '0' => 'Inactive'), null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

{{-- <div class="form-group">
    <label for="email">{{__('Title')}}</label>
    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ old('title', $tour->title) }}"  aria-describedby="titleErrors">
    <small id="titleErrors" class="form-text text-danger">{{ $errors->first('title') }}</small>
</div> --}}
<div class="form-group">
    <div class="{{ $errors->has('name') ? ' has-error' : ''}}">
        {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', $mode == 'create' ? '' : 'disabled' => 'disabled']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if($mode == 'update')
<div class="form-group">
    <div class="{{ $errors->has('slug') ? ' has-error' : ''}}">
        {!! Form::label('slug', __('Slug'), ['class' => 'control-label']) !!}
        {!! Form::text('slug', null, ['class' => 'form-control', $mode == 'create' ? '' : 'disabled' => 'disabled']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif

{{-- <div class="form-group">
    <div class="{{ $errors->has('keywords') ? ' has-error' : ''}}">
        {!! Form::label('keywords', __('Keywords') . ' ' . __('(Separated by comma: Attractions, Transportation, Tours,)'), ['class' => 'control-label' ]) !!}
        {!! Form::text('keywords', null, ['class' => 'form-control', 'required' => 'required', 'onkeypress' => 'return AvoidSpace(event)']) !!}
        {!! $errors->first('keywords', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

@if($mode == 'update')
<div class="form-group">
    <div class="{{ $errors->has('short_description') ? ' has-error' : ''}}">
        {!! Form::label('short_description', __('Short Description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('short_description', null, ['class' => 'form-control', 'required' => 'required', 'rows' => '3']) !!}
        {!! $errors->first('short_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="{{ $errors->has('description') ? ' has-error' : ''}}">
        {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' =>'description', 'required' => 'required']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
