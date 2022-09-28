@extends('layouts.app2')
@section('title', __('Login'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            @if( session()->has('error') )
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {!! session('error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <br>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Login') }}</h3>
                </div>

                <div class="box-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="emailIcon"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}" aria-describedby="emailIcon" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="passwordIcon"><i class="fa fa-lock"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Enter your password') }}" aria-describedby="passwordIcon" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <br>
                        <div class="form-group custom-checkbox">
                                <div class="form-check">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="custom-control-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>

                        <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                {{-- <a href="/register" class="btn btn-secondary">{{ __('Register') }}</a> --}}
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                        {{-- <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                            {{ __('Lost password') }}
                        </a> --}}

                        <a class="btn btn-link btn-block" href="{{ url('register') }}">
                            <h5>{{ __('Create account') }}</h5>
                        </a>
                    </div>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                </div>
            </div> --}}
            <p class="text-center">To change password send email to info@luefty.com - we protect your security</p>

        </div>
    </div>
</div>
@endsection
