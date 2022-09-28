<div class="{{ $errors->has('title_en') ? ' has-error' : ''}}">
    {!! Form::label('title_en', 'Title EN: ', ['class' => 'control-label']) !!}
    {!! Form::text('title_en', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('title_en', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('body_en') ? ' has-error' : ''}}">
    {!! Form::label('body_en', 'English text: ', ['class' => 'control-label']) !!}
    {!! Form::textarea('body_en', null, ['class' => 'form-control textarea']) !!}
    {!! $errors->first('body_en', '<p class="help-block">:message</p>') !!}
</div>
<hr>
<div class="{{ $errors->has('title_es') ? ' has-error' : ''}}">
    {!! Form::label('title_es', 'Title ES: ', ['class' => 'control-label']) !!}
    {!! Form::text('title_es', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title_es', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('body_es') ? ' has-error' : ''}}">
    {!! Form::label('body_es', 'Spanish text: ', ['class' => 'control-label']) !!}
    {!! Form::textarea('body_es', null, ['class' => 'form-control textarea']) !!}
    {!! $errors->first('body_es', '<p class="help-block">:message</p>') !!}
</div>

<br>
<div class="">
    {!! Form::submit($formMode === 'edit' ? __('Update') : __('Create'), ['class' => 'btn btn-primary']) !!}
</div>

