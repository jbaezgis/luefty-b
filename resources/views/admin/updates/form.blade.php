<div class="row">
    <div class="col-md-6">
        <div class="{{ $errors->has('name') ? ' has-error' : ''}}">
            {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
        
        <br>
        <div class="">
            {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>

    </div>
</div>

