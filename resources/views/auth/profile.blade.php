@extends('layouts.app2')
@section('title', __('My Profile'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

<br>

<div class="container">

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">
        @include('auth.leftbar')
      </div>

      <div class="col-md-9">
      @if( session()->has('verified') )
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">{{ __('Your account is verified') }}</h4>
          {{ __('Now you can use all the functions of Luefty.') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

        @if (auth()->user()->email_verified_at)
        @else
          @if (session('resent'))
              <div class="alert alert-success" role="alert">
                  {{ __('A fresh verification link has been sent to your email address.') }}
              </div>
          @endif
          <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">{{ __('Verify Your Email Address') }}</h4>
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email, please') }} <a class="alert-link" href="{{ route('verification.resend') }}">{{ __('click here to request another verification link') }}</a>.
          </div>
          <p></p>
          <div class="alert alert-warning" role="alert">
            {{ __('If you have not received the verification email verify that your email is correct, otherwise')}} <a href="{{ route('profile.edit') }}" class="alert-link">{{ __('you can edit your information')}}</a> {{ __('and enter the correct information')}}.
          </div>
        @endif

          {{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('Profile')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Notifications')}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('Activity log')}}</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
            </div> --}}

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Profile') }}</h3>
              <div class="box-tools pull-right">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Edit your profile information')}} ">{{ __('Edit your profile')}} </a>
              </div>
            </div>
            <div class="box-body">
              {{-- <div class="row">
                <div class="col-md-12 text-center">
                  <h3>{{ auth()->user()->name }}</h3>
                  <small class="text-muted">{{ __('Company Name') }}</small>
                  <p>{{ auth()->user()->company_name }}</p>
                </div>
              </div> --}}
              {{-- <div class="row">
                <div class="col-md-4">
                  <small class="text-muted">{{ __('Name') }}</small>
                  <p>{{ auth()->user()->name }}</p>
                </div>
                <div class="col-md-4">
                  <small class="text-muted">{{ __('Company Name') }}</small>
                  <p>{{ auth()->user()->company_name }}</p>
                </div>
              </div> --}}

              <div class="row">
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('Address') }}
                    @if (auth()->user()->address_ispublic == 1 )
                      <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Address is public')}} "> <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a>
                    @else
                      <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Address is private')}} "> <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a>
                    @endif
                    </small>
                    <p>{{ auth()->user()->address }}</p>
                  </div>
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('Region') }}</small>
                    <p>{{ $user->region['name'] }}</p>
                  </div>
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('Country') }}</small>
                    <p>{{ auth()->user()->country['en_name'] }}</p>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('Email') }}</small>
                    <p>{{ auth()->user()->email }}</p>
                  </div>
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('Phone') }}
                      @if (auth()->user()->phone_ispublic == 1 )
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Phone number is public')}} "> <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a>
                      @else
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Phone number is private')}} "> <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a>
                      @endif
                    </small>
                    <p>{{ auth()->user()->phone }}</p>
                  </div>
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('Web site') }}</small>
                    <p>{{ auth()->user()->web_site }}</p>
                  </div>
              </div>

              {{-- <div class="row">
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('RNC') }}
                      @if (auth()->user()->rnc_ispublic == 1 )
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your RNC is public')}} "> <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a>
                      @else
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your RNC is private')}} "> <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a>
                      @endif
                    </small>
                    <p>{{ auth()->user()->rnc }}</p>
                  </div>
                  <div class="col-md-4">
                    <small class="text-muted">{{ __('Cedula') }}
                      @if (auth()->user()->cedula_ispublic == 1 )
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your RNC is public')}} "> <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a>
                      @else
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your RNC is private')}} "> <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a>
                      @endif
                    </small>
                    <p>{{ auth()->user()->cedula }} </p>
                  </div>
                </div> --}}
                {{-- <div class="row">
                    <div class="col-md-4">
                      <small class="text-muted">{{ __('Country') }}</small>
                      <p>{{ auth()->user()->country->en_name }}</p>
                    </div>

                </div> --}}
            </div>
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
</div>
@endsection
