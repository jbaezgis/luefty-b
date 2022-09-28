<div class="{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('label') ? ' has-error' : ''}}">
    {!! Form::label('label', 'Label: ', ['class' => 'control-label']) !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
    {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
</div>
<br>
<div class="">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
