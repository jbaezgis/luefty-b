<div class="form-group custom-control custom-switch">
    <input name="public" value="1" type="checkbox" class="custom-control-input" id="customSwitch1" {{ auth()->user()->public == 1 ? 'checked' : ''}}>
    <label class="custom-control-label" for="customSwitch1">{{ __('Public profile')}} </label>
    <small>({{ __('This option allows other users to see your profile.')}})</small>
</div>

<div class="form-group">
        <label for="inputEmail4">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? auth()->user()->name }}" required autofocus>
        <div class="invalid-feedback">
            {{ __('Please enter your Name') }}
        </div>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif

    </div>
    @if (auth()->user()->email_verified_at)
    <fieldset disabled>
        <div class="form-group">
            <label for="disabledTextInput">{{ __('E-Mail Address') }}</label>
            <input type="email" id="disabledTextInput" class="form-control" placeholder="{{ auth()->user()->email }}">
        </div>
    </fieldset>

    <fieldset disabled>
        <div class="form-group">
            <label for="disabledTextInput">{{ __('Country') }}</label>
            <input type="email" id="disabledTextInput" class="form-control" placeholder="{{ auth()->user()->country->en_name }}">
        </div>
    </fieldset>
    @else
    <div class="form-group">
            <label for="inputEmail4">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? auth()->user()->email }}" required >
            <div class="invalid-feedback">
                {{ __('Please enter a valid E-Mail Address') }}
            </div>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
    </div>
    <div class="form-group">
        <label for="inputEmail4">{{ __('Country') }}</label>
        {!! Form::select('country_id', App\Country::pluck('en_name', 'id'), auth()->user()->country_id, ['placeholder'=>__('Select your Country'), 'class'=>'form-control select2', 'required']) !!}
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
    @endif


    <div class="form-group">
        <label for="inputEmail4">{{ __('Region') }}</label>
        {!! Form::select('region_id', App\Region::where('country_id', auth()->user()->country_id)->pluck('name', 'id'), auth()->user()->region_id, ['placeholder'=>'Select your Location', 'class'=>'form-control select2', 'required']) !!}
        <div class="invalid-feedback">
            {{ __('Please select your Location') }}
        </div>

        @if ($errors->has('region_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('region_id') }}</strong>
            </span>
        @endif

    </div>
    <div class="form-group">
        <label for="address" class=" col-form-label text-md-right">{{ __('Address')}} </label>
        <input id="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') ?? auth()->user()->address }}" required>
        <div class="custom-control custom-switch">
            <input name="address_ispublic" value="1" type="checkbox" class="custom-control-input" id="address_ispublic" {{ auth()->user()->address_ispublic == 1 ? 'checked' : ''}}>
            <label class="custom-control-label" for="address_ispublic">{{ __('Public')}} </label>
            <small>({{ __('If you activate this option others user will see your Address.')}})</small>
        </div>
        <div class="invalid-feedback">
            {{ __('Please enter a address number') }}
        </div>
        @if ($errors->has('address'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('address') }}</strong>
        </span>
        @endif
    </div>


    <div class="form-group">
        <label for="inputEmail4">{{ __('Language') }}</label>
        <select class="form-control select2 { $errors->has('lang') ? 'has-error' : '' }}" id="lang" name="lang" value="{{ old('lang') }}">
            <option value="en" {{ auth()->user()->lang == 'en' ? 'selected' : '' }}>English</option>
            <option value="es" {{ auth()->user()->lang == 'es' ? 'selected' : '' }}>Español</option>
        </select>

        @if ($errors->has('lang'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('lang') }}</strong>
            </span>
        @endif

    </div>


    <div class="form-group">
        <label for="phone" class=" col-form-label text-md-right">{{__('Phone')}}</label>
        <input id="phone" type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') ?? auth()->user()->phone }}" required>
        <div class="custom-control custom-switch">
            <input name="phone_ispublic" value="1" type="checkbox" class="custom-control-input" id="phone_ispublic" {{ auth()->user()->phone_ispublic == 1 ? 'checked' : ''}}>
            <label class="custom-control-label" for="phone_ispublic">{{ __('Public')}} </label>
            <small>({{ __('If you activate this option others user will see your Phone.')}})</small>
        </div>
        <div class="invalid-feedback">
            {{ __('Please enter a Phone number') }}
        </div>
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="company_name" class=" col-form-label text-md-right">{{__('Company name')}}</label>
        <input id="company_name" type="text" class="form-control {{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') ?? auth()->user()->company_name }}" required>
        <div class="invalid-feedback">
            {{ __('Please enter a Company Name') }}
        </div>
        @if ($errors->has('company_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('company_name') }}</strong>
            </span>
        @endif
    </div>
    {{-- <div class="form-group">
        <label for="inputEmail4">{{ __('User Type') }}</label>
        {!! Form::select('user_type', App\UserType::pluck('name', 'id'), auth()->user()->user_type, ['placeholder'=>'Select an User Type', 'class'=>'form-control select2', 'required']) !!}
        <div class="invalid-feedback">
            {{ __('Please select a User Type') }}
        </div>

        @if ($errors->has('user_type'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('user_type') }}</strong>
            </span>
        @endif

    </div> --}}
    {{-- <div class="form-group">
        <label for="cedula" class=" col-form-label text-md-right">{{ __('Cédula') }}</label>
        <input id="cedula" type="text" class="form-control {{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" value="{{ old('cedula') ?? auth()->user()->cedula }}" required>
        <div class="custom-control custom-switch">
            <input name="cedula_ispublic" value="1" type="checkbox" class="custom-control-input" id="cedula_ispublic" {{ auth()->user()->cedula_ispublic == 1 ? 'checked' : ''}}>
            <label class="custom-control-label" for="cedula_ispublic">{{ __('Public')}} </label>
            <small>({{ __('This option allows other users to see your address.')}})</small>
        </div>
        <div class="invalid-feedback">
            {{ __('Please enter a Company Name') }}
        </div>
        @if ($errors->has('cedula'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('cedula') }}</strong>
            </span>
        @endif
    </div> --}}

    {{-- <div class="form-group">
        <label for="rnc" class=" col-form-label text-md-right">{{ __('RNC') }}</label>
        <input id="rnc" type="text" class="form-control {{ $errors->has('rnc') ? ' is-invalid' : '' }}" name="rnc" value="{{ old('rnc') ?? auth()->user()->rnc }}" required>
        <div class="custom-control custom-switch">
            <input name="rnc_ispublic" value="1" type="checkbox" class="custom-control-input" id="rnc_ispublic" {{ auth()->user()->rnc_ispublic == 1 ? 'checked' : ''}}>
            <label class="custom-control-label" for="rnc_ispublic">{{ __('Public')}} </label>
            <small>({{ __('This option allows other users to see your address.')}})</small>
        </div>
        <div class="invalid-feedback">
            {{ __('Please enter a Company Name') }}
        </div>
        @if ($errors->has('rnc'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('rnc') }}</strong>
            </span>
        @endif
    </div> --}}

    <div class="form-group">
        <label for="web_site" class=" col-form-label text-md-right">{{ __('Web site') }}</label>
        <input id="web_site" type="text" class="form-control {{ $errors->has('web_site') ? ' is-invalid' : '' }}" name="web_site" value="{{ old('web_site') ?? auth()->user()->web_site }}">
        <div class="invalid-feedback">
            {{ __('Please enter a web site') }}
        </div>
        @if ($errors->has('web_site'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('web_site') }}</strong>
            </span>
        @endif
    </div>

    <p></p>
    <div class="form-group row mb-0">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">
                {{ __('Update profile') }} <i class="fa fa-" aria-hidden="true"></i>
            </button>
        </div>
    </div>
