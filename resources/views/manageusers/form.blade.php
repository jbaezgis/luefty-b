<div class="{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('email', 'Email: ', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="{{ $errors->has('lang') ? ' has-error' : ''}}">
    {!! Form::label('email', 'Language: ', ['class' => 'control-label']) !!}
    <select class="form-control {{ $errors->has('lang') ? 'has-error' : '' }} select2" id="lang" name="lang">
        <option value="en" @if ($formMode === 'edit'){{ $user->lang == 'en' ? 'selected' : '' }}@endif>English</option>
        <option value="es" @if ($formMode === 'edit'){{ $user->lang == 'es' ? 'selected' : '' }}@endif>Español</option>
    </select>
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="inputEmail4">{{ __('Country') }}</label>
    {!! Form::select('country_id', App\Country::pluck('en_name', 'id'), null, ['placeholder'=>__('Select your Country'), 'class'=>'form-control select2', 'required']) !!}
    {{-- <select class="form-control select2 {{ $errors->has('lang') ? 'has-error' : '' }}" id="lang" name="lang" value="{{ old('lang') }}">
        <option value="en">{{ __('Dominican Republic') }}</option>
        <option value="es">{{ __('Mexico') }}</option>
    </select> --}}
    <div class="invalid-feedback">
        {{ __('Please select your Country') }}
    </div>

    @if ($errors->has('country_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('country_id') }}</strong>
        </span>
    @endif

</div>
<div class="{{ $errors->has('phone') ? ' has-error' : ''}}">
    {!! Form::label('phone', 'Phone: ', ['class' => 'control-label']) !!}
    {!! Form::number('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<p></p>
<div class="{{ $errors->has('company_name') ? ' has-error' : ''}}">
    {!! Form::label('company_name', 'Company Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('company_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
</div>
<p></p>
<div class="form-group">
    <label for="inputEmail4">{{ __('User Type') }}</label>
    {!! Form::select('user_type', App\UserType::pluck('name', 'id'), null, ['placeholder'=>__('Select an User Type'), 'class'=>'form-control select2', 'required']) !!}
    <div class="invalid-feedback">
        {{ __('Please select a User Type') }}
    </div>

    @if ($errors->has('user_type'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('user_type') }}</strong>
        </span>
    @endif

</div>
{{-- <div class="{{ $errors->has('rating') ? ' has-error' : ''}}">
        {!! Form::label('rating', 'Rating: ', ['class' => 'control-label']) !!}
        {!! Form::number('rating', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('rating', '<p class="help-block">:message</p>') !!}
</div> --}}
@if ($formMode === 'create')
<div class="{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('password', 'Password: ', ['class' => 'control-label']) !!}
    @php
        $passwordOptions = ['class' => 'form-control'];
        if ($formMode === 'create') {
            $passwordOptions = array_merge($passwordOptions, ['required' => 'required']);
        }
    @endphp
    {!! Form::password('password', $passwordOptions) !!}
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
@endif
{{-- <div class="{{ $errors->has('roles') ? ' has-error' : ''}}">
    {!! Form::label('role', 'Role: ', ['class' => 'control-label']) !!}
    {!! Form::select('roles[]', $roles, isset($user_roles) ? $user_roles : [], ['class' => 'form-control select2', 'multiple' => true]) !!}
</div> --}}
<br>
<div class="">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
