<div class="{{ $errors->has('en_title') ? ' has-error' : ''}}">
    {!! Form::label('en_title', 'En Title: ', ['class' => 'control-label']) !!}
    {!! Form::text('en_title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('en_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('en_text') ? ' has-error' : ''}}">
    {!! Form::label('en_text', 'English text: ', ['class' => 'control-label']) !!}
    {!! Form::textarea('en_text', null, ['class' => 'form-control textarea']) !!}
    {!! $errors->first('en_text', '<p class="help-block">:message</p>') !!}
</div>
<hr>
<div class="{{ $errors->has('es_title') ? ' has-error' : ''}}">
    {!! Form::label('es_title', 'Es Title: ', ['class' => 'control-label']) !!}
    {!! Form::text('es_title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('es_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('es_text') ? ' has-error' : ''}}">
    {!! Form::label('es_text', 'Spanish text: ', ['class' => 'control-label']) !!}
    {!! Form::textarea('es_text', null, ['class' => 'form-control textarea']) !!}
    {!! $errors->first('es_text', '<p class="help-block">:message</p>') !!}
</div>

<br>
<div class="">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

