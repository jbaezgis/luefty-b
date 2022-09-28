<div class="row">
    <div class="col-md-4">
        <div class="custom-file">
            <input type="file" name="image"  class="custom-file-input" id="validatedCustomFile">
            <label class="custom-file-label" for="validatedCustomFile">{{_('Image')}}...</label>
            <div class="invalid-feedback">{{__('Please select an image')}}</div>
        </div>
    </div>

</div>
<br>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <div class="{{ $errors->has('code') ? ' has-error' : ''}}">
                {!! Form::label('code', 'Code', ['class' => 'control-label']) !!}
                {!! Form::email('code', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
            </div>
        </div>{{-- /form-group --}}
    </div> {{-- /col --}}
    <div class="col-md-10">
        <div class="form-group">
            <div class="{{ $errors->has('en_name') ? ' has-error' : ''}}">
                {!! Form::label('en_name', __('Name'), ['class' => 'control-label']) !!}
                {!! Form::email('en_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('en_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>{{-- /form-group --}}
    </div> {{-- /col --}}
</div>{{-- /row --}}

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="{{ $errors->has('description') ? ' has-error' : ''}}">
                {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'id' =>'description', 'required' => 'required']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>{{-- /form-group --}}
    </div> {{-- /col --}}
</div>{{-- /row --}}

