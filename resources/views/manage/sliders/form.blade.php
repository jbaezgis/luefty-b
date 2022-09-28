@csrf
<div class="row">
    <div class="col-md-12">

        <div class="custom-file">
            <input type="file" name="image" id="slider_image" class="" id="validatedCustomFile">
            {{-- <label class="custom-file-label" for="validatedCustomFile">{{_('Image')}}...</label> --}}
            {{-- <div class="invalid-feedback">{{__('Please select an image')}}</div> --}}
        </div>
    </div>
</div>
<p></p>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="{{ $errors->has('status') ? ' has-error' : ''}}">
                {!! Form::label('status', __('Status'), ['class' => 'control-label']) !!}
                {!! Form::select('status', array('Active' => 'Active', 'Disabled' => 'Disabled'), null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="{{ $errors->has('order') ? ' has-error' : ''}}">
                {!! Form::label('order', __('Order'), ['class' => 'control-label']) !!}
                {!! Form::number('order', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="{{ $errors->has('title') ? ' has-error' : ''}}">
        {!! Form::label('title', __('Title'), ['class' => 'control-label']) !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="{{ $errors->has('link') ? ' has-error' : ''}}">
        {!! Form::label('link', __('Link'), ['class' => 'control-label']) !!}
        {!! Form::text('link', null, ['class' => 'form-control']) !!}
        {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="{{ $errors->has('description') ? ' has-error' : ''}}">
        {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id' =>'description', 'required' => 'required']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

