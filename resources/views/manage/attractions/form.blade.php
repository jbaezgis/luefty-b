@csrf

<div class="custom-file">
    <input type="file" name="image" id="image" class="" id="validatedCustomFile">
    {{-- <label class="custom-file-label" for="validatedCustomFile">{{_('Image')}}...</label> --}}
    {{-- <div class="invalid-feedback">{{__('Please select an image')}}</div> --}}
</div>
<p></p>

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
            <label for="from" class="control-label">{{__('Location')}}</label><br>
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br> --}}
            {{-- <small>{{__('Pick up location.')}} </small> --}}
            {!! Form::select('location_id', App\Location::where('active', 1)->where('is_airport', 0)->orderBy('name', 'asc')->pluck('name', 'id'), null, ['id'=>'location_id', 'placeholder'=>'', 'class'=>'form-control select2' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('location_id') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Location') }}
            </div>
        </div>
    </div>

    <div class="col-md-2">
        {!! Form::label('published', __('Status'), ['class' => 'control-label']) !!}
        {!! Form::select('published', array('1' => 'Published', '0' => 'Unpublished'), null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
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

{{-- <div class="form-group">
    <label for="message">{{__('Description')}}</label>
    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="3" value="{{ old('description', $tour->description) }}"  aria-describedby="descriptionErrors"></textarea>
    <small id="descriptionErrors" class="form-text text-danger">{{ $errors->first('description') }}</small>
</div> --}}

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

