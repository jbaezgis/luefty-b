@csrf

<div class="custom-file">
    <input type="file" name="image" id="image" class="" id="validatedCustomFile">
    {{-- <label class="custom-file-label" for="validatedCustomFile">{{_('Image')}}...</label> --}}
    {{-- <div class="invalid-feedback">{{__('Please select an image')}}</div> --}}
</div>
<p></p>
{{-- <div class="form-group">
    <label for="from" class="mb-0">{{__('Location')}}</label><br>
    {!! Form::select('location_id', App\Location::where('active', 1)->where('is_airport', NULL)->orderBy('name', 'asc')->pluck('name', 'id'), null, ['id'=>'location_id', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
    <small id="fromErrors" class="form-text text-danger">{{ $errors->first('location_id') }}</small>
    <div class="invalid-feedback">
        {{ __('Please select a Location') }}
    </div>
</div> --}}

{{-- <div class="form-group">
    <label for="email">{{__('Title')}}</label>
    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{ old('title', $tour->title) }}"  aria-describedby="titleErrors">
    <small id="titleErrors" class="form-text text-danger">{{ $errors->first('title') }}</small>
</div> --}}

<div class="form-group">
    <div class="{{ $errors->has('title') ? ' has-error' : ''}}">
        {!! Form::label('title', __('Title'), ['class' => 'control-label']) !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="{{ $errors->has('name') ? ' has-error' : ''}}">
        {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="{{ $errors->has('slug') ? ' has-error' : ''}}">
        {!! Form::label('slug', __('Slug') . ' ' . __('(Example: title-name-description)'), ['class' => 'control-label' ]) !!}
        {!! Form::text('slug', null, ['class' => 'form-control', 'required' => 'required', 'onkeypress' => 'return AvoidSpace(event)']) !!}
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{-- <div class="form-group">
    <label for="message">{{__('Description')}}</label>
    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="3" value="{{ old('description', $tour->description) }}"  aria-describedby="descriptionErrors"></textarea>
    <small id="descriptionErrors" class="form-text text-danger">{{ $errors->first('description') }}</small>
</div> --}}
<div class="{{ $errors->has('description') ? ' has-error' : ''}}">
    {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' =>'description', 'required' => 'required']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


