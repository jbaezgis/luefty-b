@csrf

<div class="custom-file">
    <input type="file" name="image" id="image" class="" id="validatedCustomFile">
    {{-- <label class="custom-file-label" for="validatedCustomFile">{{_('Image')}}...</label> --}}
    {{-- <div class="invalid-feedback">{{__('Please select an image')}}</div> --}}
</div>
<p></p>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="{{ $errors->has('url') ? ' has-error' : ''}}">
                {!! Form::label('url', __('URL'), ['class' => 'control-label']) !!}
                {!! Form::text('url', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="{{ $errors->has('image_alt') ? ' has-error' : ''}}">
                {!! Form::label('image_alt', __('Image alt') . ' ' . '- ', ['class' => 'control-label']) !!} <code>&lt;alt="Image alt"&gt;</code>
                {!! Form::text('image_alt', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('image_alt', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="from" class="">{{__('Attraction')}}</label><br>
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br> --}}
            {{-- <small>{{__('Pick up location.')}} </small> --}}
            {!! Form::select('attraction_id', App\Attraction::orderBy('title', 'asc')->pluck('title', 'id'), null, ['id'=>'attraction_id', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('attraction_id') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select an Attraction') }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('status', __('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', array('Published' => 'Published', 'Unpublished' => 'Unpublished'), null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    
    {{-- <div class="col-md-6">
        <div class="form-group">
            <label for="from" class="mb-0">{{__('Location')}}</label><br>
            {!! Form::select('location_id', App\Location::where('active', 1)->where('is_airport', NULL)->orderBy('name', 'asc')->pluck('name', 'id'), null, ['id'=>'location_id', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('location_id') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Location') }}
            </div>
        </div>
    </div> --}}
</div>

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
    <div class="{{ $errors->has('slug') ? ' has-error' : ''}}">
        {!! Form::label('slug', __('Slug') . ' ' . __('(Example: title-name-description)'), ['class' => 'control-label' ]) !!}
        {!! Form::text('slug', null, ['class' => 'form-control', 'required' => 'required', 'onkeypress' => 'return AvoidSpace(event)']) !!}
        {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="from" class="control-label">{{__('Departure Location')}}</label><br>
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br> --}}
            {{-- <small>{{__('Pick up location.')}} </small> --}}
            {!! Form::select('departure_location', App\Location::where('active', 1)->where('is_airport', 0)->orderBy('name', 'asc')->pluck('name', 'id'), null, ['id'=>'departure_location', 'placeholder'=>'', 'class'=>'form-control select2' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('departure_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Location') }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="{{ $errors->has('departure_time') ? ' has-error' : ''}}">
            {!! Form::label('departure_time', __('Departure Time'), ['class' => 'control-label']) !!}
            {!! Form::time('departure_time', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('departure_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="{{ $errors->has('duration') ? ' has-error' : ''}}">
            {!! Form::label('duration', __('Duration'), ['class' => 'control-label']) !!}
            {!! Form::text('duration', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('type', __('Type'), ['class' => 'control-label']) !!}
            {!! Form::select('type', array('Adventure' => 'Adventure', 'Family' => 'Family'), null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="{{ $errors->has('adults_price') ? ' has-error' : ''}}">
            {!! Form::label('adults_price', __('Adults price'), ['class' => 'control-label']) !!}
            {!! Form::number('adults_price', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('adults_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="{{ $errors->has('children_price') ? ' has-error' : ''}}">
            {!! Form::label('children_price', __('Children price'), ['class' => 'control-label']) !!}
            {!! Form::number('children_price', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('children_price', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="{{ $errors->has('latitude') ? ' has-error' : ''}}">
            {!! Form::label('latitude', __('Latitude'), ['class' => 'control-label']) !!}
            {!! Form::text('latitude', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="{{ $errors->has('longitude') ? ' has-error' : ''}}">
            {!! Form::label('longitude', __('Longitude'), ['class' => 'control-label']) !!}
            {!! Form::text('longitude', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<p></p>
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
<p></p>
<div class="row">
    <div class="col-md-12">
        <label for="from" class="control-label">{{__('Select tour images')}} <span class="text-muted">({{__('max 4 images')}})</span></label><br>
        
        <div class="custom-file">
            <input type="file" name="tour_multiple_images[]" id="tour-multiple-images" class="" id="validatedCustomFile" multiple>
        </div>
    </div>
</div>

