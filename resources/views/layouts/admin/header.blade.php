<header class="main-header">
  <div class="container-fluid bg-white border-bottom">
    <div class="container">
    <nav class="navbar navbar-light navbar-expand">
         <a href="{{URL::to('/')}}" class="navbar-brand"><img src="{{URL::asset('images/logo.svg')}}" height="40" alt="Luefty"></a>
  
          <div class=" ml-auto ">
              <ul class="navbar-nav ">
                @if (auth()->check())
                @else
                  <li class="nav-item mr-2 "><a class="nav-link" href="{{URL::to('/login')}}"><i class="fa fa-user    "></i> {{ __('Account') }}</a></li>
                  {{-- <li class="nav-item mr-2"><a class="nav-link" href="{{URL::to('/suppliers')}}">{{ __('Suppliers') }}</a></li> --}}
                @endif
                  {{-- <li class="nav-item mr-2 {{ activeMenu('/') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ __('HOME') }}</a></li>
                  <li class="nav-item mr-2 {{ activeMenu('/help-center') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ __('HELP CENTER') }}</a></li>
                  <li class="nav-item mr-2 {{ activeMenu('/AGENCIES') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ __('AGENCIES') }}</a></li>
                  <li class="nav-item {{ activeMenu('messages/create') }}"><a class="nav-link" href="{{ route('messages.create') }}">{{ __('CONTACT') }}</a></li> --}}
                  @if (auth()->check())
                      {{-- <li class="nav-item {{ activeMenuLight('users*') }}">
                          <a class="nav-link" href="{{ url('users') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('Here you can find Agencies and Suppliers and add them to your Favorites')}} ">{{__('Members')}}</a>
                      </li> --}}
                      @if (auth()->user()->isAdmin == true)
  
                      @endif
                  @endif
  
            @if (Auth::check() && Auth::user()->hasRole('admin'))
  
            @endif
  
  
         </ul>
        </div>
  
  
        {{-- lang on larch screen --}}
        {{-- Oculto por ahora --}}
        <ul class="navbar-nav">
          @if (auth()->guest())
          {{-- <div class="dropdown">
              <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @if (Config::get('app.locale') == 'en')
                      <span class="flag-icon flag-icon-us"></span> EN
                  @else
                      <span class="flag-icon flag-icon-es"></span> ES
                  @endif
              </a>
  
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                  <a href="{{ url('locale/en') }}" class="dropdown-item {{ Config::get('app.locale') == 'en' ? 'active' : '' }}"><span class="flag-icon flag-icon-us"></span> EN</a>
                  <a href="{{ url('locale/es') }}" class="dropdown-item {{ Config::get('app.locale') == 'es' ? 'active' : 'btn-ligth' }}"><span class="flag-icon flag-icon-es"></span> ES</a>
              </div>
          </div> --}}
          @endif
        </ul>
        {{-- end lang on xs--}}
  
        <ul class="navbar-nav ml-4 justify-content-end">
  
          <!--if user-->
          @if (auth()->check())
          <li class="nav-item dropdown">
  
            <a class="nav-link dropdown-toggle user-dropdown d-none d-lg-block d-xl-block" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ auth()->user()->name }}
              {{-- ({{ auth()->user()->userType->name }}) --}}
  
            </a>
            <a class="nav-link dropdown-toggle user-dropdown d-none d-block d-sm-block d-md-none" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ auth()->user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              {{-- Client items --}}
              {{-- @if (Auth::check() && Auth::user()->hasRole('client'))
              @endif --}}
              @if (Auth::check() && Auth::user()->user_type == 1)
                <a class="dropdown-item" href="{{ url('myauctions/privatetransfers/index') }}">{{ __('Place Auction') }}</a>
                <a class="dropdown-item" href="{{ url('suppliers/index') }}">{{ __('Make Bid') }}</a>
              @else
                <a class="dropdown-item" href="{{ url('suppliers/index') }}">{{ __('Make Bid') }}</a>
              @endif
  
              <div class="dropdown-divider"></div>
              {{-- <a class="dropdown-item" href="{{ url('users') }}">{{ __('Members') }}</a> --}}
  
              {{-- Admin items --}}
              @if (Auth::check() && Auth::user()->hasRole('admin'))
              <div class="dropdown-divider"></div>
              <span class=" pl-3 text-muted">{{__('Administration')}} </span>
                  {{-- <a class="dropdown-item" href="{{ url('manage/auctions') }}"><i class="fa fa-list-ul"></i> {{ __('Manage Auctions') }}</a> --}}
                  {{-- <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fa fa-users"></i> {{ __('Manage Users') }}</a> --}}
                  <a class="dropdown-item" href="{{ route('services.index') }}"><i class="fa fa-list"></i> {{ __('Manage Services') }}</a>
                  <a class="dropdown-item" href="{{ route('countries.index') }}"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ __('Locations') }}</a>
                  {{-- <a class="dropdown-item" href="{{ route('booking.touristAuctions') }}"><i class="fa fa-list" aria-hidden="true"></i> {{ __('Tourist Auctions') }}</a> --}}
                  {{-- <li class="nav-item mr-2 {{ activeMenu('booking/tourist-auctions*') }}"><a class="nav-link" href="{{ route('booking.touristAuctions') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('Supplier')}} ">{{ __('Tourist Auctions') }}</a></li> --}}
              @endif
              @if (auth()->user()->isAdmin == true)
              <a class="dropdown-item" href="{{ route('system.settings') }}"><i class="fa fa-gears"></i> {{ __('Settings') }}</a>
              @endif
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa fa-user"></i> {{ __('My profile') }}</a>
              {{-- <a class="dropdown-item" href="{{ route('password.request') }}" ><i class="fa fa-lock" aria-hidden="true"></i> {{ __('Change my password') }} </a> --}}
              <div class="dropdown-divider"></div>
  
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out"></i> {{__('Logout')}}
                  </a>
  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
  
            </div>
          </li>
          @endif
        </ul>
        @if (auth()->guest())
  
        {{-- <a href="{{ url('booking/search') }}" class="btn btn-primary btn-sm">{{ __('My Booking') }}</a> --}}
          
        @endif
      </nav>
  
      @if (auth()->guest())
      {{-- <nav class="navbar navbar-light navbar-expand-md d-xl-none pt-2 pb-2">
          <ul class="navbar-nav ml-auto">
          </ul>
          <ul class="navbar-nav ml-auto justify-content-end">
              
          </ul>
  
      </nav> --}}
      @endif
  
    </div>
  </div>

</header>