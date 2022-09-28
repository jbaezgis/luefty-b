@extends('layouts.app2')
@section('title', __('My Profile'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

<br>

<div class="container">
  <?php function profileActiveMenu($url){
    return request()->is($url) ? 'active' : '';
  }?>
  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
              {{-- <img class="profile-user-img img-responsive rounded-circle" src="/uploads/avatars/{{ $user->avatar }}" alt="User profile picture"> --}}
      
              <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
              {{-- <p class="text-muted text-center">{{ __('User Type') }}: <strong>{{ auth()->user()->userType->name }} </strong> </p> --}}
      
              <p class="text-muted text-center">{{ __('Company') }}: <strong>{{ auth()->user()->company_name }} </strong></p>
          </div>
          <!-- /.box-body -->
      
          <div class="box-footer text-center">
              @if (auth()->user()->public == 1 )
                  <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Profile is Public. Other people can see your Profile.')}} "><small class="text-success">{{ __('Public')}} <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a></small>
              @else
                  <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Profile is Private. Other users can not see your Profile')}} "><small class="text-primary">{{ __('Private')}} <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a></small>
              @endif
          </div>
        </div>
        <!-- /.box -->
      
          <div class="list-group">
              <a href="{{ route('user.profile')}} " class="list-group-item list-group-item-action {{ profileActiveMenu('profile') }}" data-toggle="tooltip" data-placement="right" title="{{ __('Your prifle information')}} ">{{ __('Profile')}} </a>
              <a href="{{ route('vehicles.index')}}" class="list-group-item list-group-item-action {{ profileActiveMenu('profile/vehicles*') }}" data-toggle="tooltip" data-placement="right" title="{{ __('See the information of your vehicles')}} ">
                {{ __('Vehicles')}}
                <span class="badge badge-light badge-pill pull-right">{{ auth()->user()->vehicles->count() }}</span>
              </a>
              <a href="{{ route('profile.favorites')}}" class="list-group-item list-group-item-action {{ profileActiveMenu('profile/favorites') }}" data-toggle="tooltip" data-placement="right" title="{{ __('Suppliers and Agencies you added as favorites')}} ">
                  {{ __('Favorites')}}
                  <span class="badge badge-light badge-pill pull-right">{{ auth()->user()->following->count() }}</span>
              </a>
              <a href="" class="list-group-item list-group-item-action " data-toggle="tooltip" data-placement="right" title="{{ __('Suppliers and Agencies that added you to their favorites')}}" >
                {{ __('Followers')}}
                <span class="badge badge-light badge-pill pull-right">{{ auth()->user()->profile->followers->count() }}</span>
              </a>
      
      
            </div>
          <p></p>
      
        <!-- About Me Box -->
        <div class="box box-solid">
          <!-- /.box-header -->
          <div class="box-body">
            {{-- <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
      
            <p class="text-muted">
              B.S. in Computer Science from the University of Tennessee at Knoxville
            </p>
      
            <hr> --}}
      
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      
      </div>

      <div class="col-md-9">
      @if( session()->has('info') )
        <div class="alert alert-success" role="alert">
          {{-- <h4 class="alert-heading">{{ __('Your account is verified') }}</h4> --}}
          {{ __('Password updated.') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif


          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Update password') }}</h3>
              {{-- <div class="box-tools pull-right">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Edit your profile information')}} ">{{ __('Edit your profile')}} </a>
              </div> --}}
            </div>
            <div class="box-body">
              <form class="needs-validation" action="{{route('profile.updatePassword')}}" method="POST" enctype="multipart/form-data" novalidate>
                  {{ csrf_field()}}
                  <div class="form-group">
                      <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
                      <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" required>
                      <div class="invalid-feedback">
                          {{ __('Please enter a Password') }}
                      </div>
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>

                  <div class="form-group">
                      <label for="password-confirm" class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" id="password-confirm" required>
                      <div class="invalid-feedback">
                          {{ __('Please re-enter your password') }}
                      </div>
                      <span id='message'></span>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update password') }} <i class="fa fa-" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
              </form>
            </div>
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
</div>
@endsection

@section('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    
</script>

<script>
  // Password validation
  $('#password, #password-confirm').on('keyup', function () {
      $('#register_btn').attr('disabled', 'disabled');
      if ($('#password').val() == '') {
          $('#message').html('Please enter your password!').css('color', 'red');
      }else {
        if ($('#password').val() == $('#password-confirm').val()) {
            $('#message').html('Match!').css('color', 'green');
            $('#register_btn').attr('disabled', false);
        } else 
            $('#message').html('Re-enter your password. Passwords do not match!').css('color', 'red');
      }
  });
</script>
@endsection
