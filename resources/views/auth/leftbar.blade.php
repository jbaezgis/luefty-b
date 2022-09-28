<?php function profileActiveMenu($url){
  return request()->is($url) ? 'active' : '';
}?>

<!-- Profile Image -->
<div class="box box-primary">
    <div class="box-body box-profile">
        {{-- <img class="profile-user-img img-responsive rounded-circle" src="/uploads/avatars/{{ $user->avatar }}" alt="User profile picture"> --}}

        <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
        {{-- <p class="text-muted text-center">{{ __('User Type') }}: <strong>{{ auth()->user()->userType->name }} </strong> </p> --}}

        <p class="text-muted text-center">{{ __('Company') }}: <strong>{{ auth()->user()->company_name }} </strong></p>


      {{-- <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>{{ __('Followers') }}</b> <a class="pull-right">{{ $user->profile->followers->count()}}</a>
        </li>
        <li class="list-group-item">
          <b>{{ __('Following') }}</b> <a class="pull-right">{{ $user->following->count()}}</a>
        </li>
      </ul> --}}


      {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
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
    {{-- <div class="box-header with-border">
      <h3 class="box-title">About Me</h3>
    </div> --}}
    <!-- /.box-header -->
    <div class="box-body">
      {{-- <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

      <p class="text-muted">
        B.S. in Computer Science from the University of Tennessee at Knoxville
      </p>

      <hr> --}}
      @if (auth()->user()->email_verified_at)
      <h5 class="text-success text-center">{{ __('Active') }} </h5>
        <p class="text-center">
            {{-- <i class="fa fa-circle text-primary" aria-hidden="true"></i> <br> --}}
            {{ __('Free Trial')}} <br>
            <small class="text-muted"><strong>{{ __('Expires') }}</strong>: {{ date('l j, F Y', strtotime(auth()->user()->next_payment)) }}</small>
        </p>
      @else
      <h5 class="text-danger text-center">{{ __('Pending verification') }} </h5>
      @endif


    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
