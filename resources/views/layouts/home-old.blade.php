<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <title>@yield('title') | {{ config('app.name') }}</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{URL::asset('images/favicon.png')}}" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  {{-- Google Maps Api --}}
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB50fxBrVikNVJVUy_TpP1nsGpPhiSZVAs&libraries=geometry,places">
  </script>

  <!-- Libraries CSS Files -->
  <link rel="stylesheet" href="{{URL::asset('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  {{-- <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}"> --}}
  <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2-bootstrap4.min.css')}}">
  {{-- <link rel="stylesheet" href="{{URL::asset('bower_components/gijgo-datetimepicker/css/gijgo.min.css')}}"> --}}

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">

  {{-- CK Editor --}}
  {{-- <link rel="stylesheet" href="{{URL::asset('bower_components/ckeditor/toolbarconfigurator/lib/codemirror/neo.css')}}"> --}}

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  {{-- <link rel="stylesheet" href="{{URL::asset('admin/css/AdminLTE.min.css')}}"> --}}

  <!-- Bootstrap CSS File -->
  <link href="{{URL::asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  {{-- DataTables --}}
  <link href="{{URL::asset('lib/datatables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.19/integration/font-awesome/dataTables.fontAwesome.css"> --}}
  <!-- Main Stylesheet File -->
  <!-- <link href="css/style.css" rel="stylesheet"> -->
  {{-- <link href="{{URL::asset('css/app.css')}}" rel="stylesheet">  --}}

  {{-- Sweet alerts --}}
  <link href="{{URL::asset('css/sweetalert.css')}}" rel="stylesheet">

  {{-- flags --}}
  <link href="{{URL::asset('css/flag-icon.min.css')}}" rel="stylesheet">


  <link href="{{URL::asset('css/subasta.css')}}" rel="stylesheet">
  <link href="{{URL::asset('css/luefty.css')}}" rel="stylesheet">

  @yield('head')
</head>

<!-- Arreglo para menu activo -->
<?php function activeMenuLight($url){
    return request()->is($url) ? 'active active-lang' : '';
  }?>
  <?php function activeMenu($url){
    return request()->is($url) ? 'active active-menu' : '';
  }?>
<!-- fin -->

<body id="body">
<section class="">
  <nav class="navbar navbar-light navbar-expand bg-white border-bottom shadow-sm">
       <a href="{{URL::to('/')}}" class="navbar-brand"><img src="{{URL::asset('images/logo.svg')}}" height="40"></a>

        <div class=" ml-auto d-none d-lg-block d-xl-block">
            <ul class="navbar-nav ">
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
      <ul class="navbar-nav ml-auto d-none d-sm-block">

        @if (auth()->guest())
        <div class="dropdown">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (Config::get('app.locale') == 'en')
                    <span class="flag-icon flag-icon-us"></span> EN
                @else
                    <span class="flag-icon flag-icon-es"></span> ES
                @endif
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a href="{{ url('locale/en') }}" class="dropdown-item {{ Config::get('app.locale') == 'en' ? 'active' : '' }}"><span class="flag-icon flag-icon-us"></span> EN</a>
                <a href="{{ url('locale/es') }}" class="dropdown-item {{ Config::get('app.locale') == 'es' ? 'active' : 'btn-ligth' }}"><span class="flag-icon flag-icon-es"></span> ES</a>
                {{-- <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a> --}}
            </div>
        </div>
        {{-- <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ url('locale/en') }}" class="btn {{ Config::get('app.locale') == 'en' ? 'btn-ligth active-lang' : 'btn-ligth' }}"><span class="flag-icon flag-icon-us"></span> EN</a>
            <a href="{{ url('locale/es') }}" class="btn {{ Config::get('app.locale') == 'es' ? 'btn-ligth active-lang' : 'btn-ligth' }}"><span class="flag-icon flag-icon-es"></span> ES</a>
        </div> --}}
        @endif
      </ul>
      {{-- end lang on xs--}}

      <ul class="navbar-nav ml-4 justify-content-end">

        <!--if user-->
        {{ auth()->user()->name }}
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
              <a class="dropdown-item" href="{{ url('myauctions/privatetransfers/index') }}">{{ __('Agency') }}</a>
              <a class="dropdown-item" href="{{ url('suppliers') }}">{{ __('Supplier') }}</a>
            @else
              <a class="dropdown-item" href="{{ url('suppliers') }}">{{ __('Supplier') }}</a>
            @endif
            
            {{-- Admin items --}}
            @if (Auth::check() && Auth::user()->hasRole('admin'))
            <div class="dropdown-divider"></div>
            <span class=" pl-3 text-muted">{{__('Administration')}} </span>
                {{-- <a class="dropdown-item" href="{{ url('manage/auctions') }}"><i class="fa fa-list-ul"></i> {{ __('Manage Auctions') }}</a> --}}
                <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fa fa-users"></i> {{ __('Manage Users') }}</a>
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
            <a class="dropdown-item" href="{{ route('password.request') }}" ><i class="fa fa-lock" aria-hidden="true"></i> {{ __('Change my password') }} </a>
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
        @if (auth()->guest())
        <div class="btn-group" role="group" aria-label="Basic example">
          <a href="{{ url('login') }}" class="btn btn-primary btn-sm">{{ __('Login') }}</a>
          {{-- <a href="{{ url('register') }}" class="btn btn-outline-secondary btn-sm">{{ __('Sign up') }}</a> --}}

        </div>
        @endif
      </ul>
    </nav>

    @if (auth()->guest())
    <nav class="navbar navbar-light navbar-expand-md d-xl-none pt-2 pb-2">
        <ul class="navbar-nav ml-auto">
        </ul>
        <ul class="navbar-nav ml-auto justify-content-end">
            <div class="dropdown">
                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
          <div class="btn-group" role="group" aria-label="Basic example">
              <a href="locale/en" class="btn {{ Config::get('app.locale') == 'en' ? 'btn-ligth active-lang' : 'btn-ligth' }}"><span class="flag-icon flag-icon-us"></span> EN</a>
              <a href="locale/es" class="btn {{ Config::get('app.locale') == 'es' ? 'btn-ligth active-lang' : 'btn-ligth' }}"><span class="flag-icon flag-icon-es"></span> ES</a>
          </div>
        </ul>

    </nav>
    @endif


</section>
  <!--==========================
    Container
    ============================-->
    {{-- <div id='app'>
        <fallow-button></fallow-button>
    </div> --}}
      <div id="app">

        @yield('content')
      </div>

  <!--==========================
    Footer
  ============================-->
  {{-- <hr> --}}
  <div class="container-fluid bg-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{__('We are growing!')}}</h4>
                    <h5>2021</h5>
                    <p>Text text text text</p>

                    <h5>2022</h5>
                    <p>Text text text text</p>

                    <h5>2023</h5>
                    <p>Text text text text</p>
                </div>
                <div class="col-md-6">
                    <h4>{{__('More services soon!')}}</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="#">Tours and Excursions</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Charter small planes</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Shared Shuttles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Airbn, Homeaway, Hotel rooms</a>
                        </li>
                      </ul>
                </div>
            </div>
        </div>
  </div>
  <div class="container">
  <footer class="py-3">
      <div class="row">
        <div class="col-md-12">
            <span class="d-block mb-3 text-muted"><img class="mb-2" src="{{URL::asset('images/logo.svg')}}" alt="" height="40"> Luefty GmbH Vienna, Austria Patent Pending, Copyright 2020 All Rights Reserved. <span class="pull-right">{{__('Support:')}} info@luefty.com</span></span>
            {{-- <span class="d-block mb-3 text-muted"><img class="mb-2" src="{{URL::asset('images/logo.svg')}}" alt="" height="40"> &copy; {{ date('Y')}} </span> --}}
        </div>

      </div>
    </footer>
    </div>
  <!-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->

  <!-- JavaScript Libraries -->
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
  <script src="{{URL::asset('js/jquery.js')}}"></script>
  <script src="{{URL::asset('js/popper.min.js')}}"></script>
  <script src="{{URL::asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('js/modernizr-2.8.3.min.js')}}"></script>
  <script src="{{URL::asset('js/moment-with-locales.min.js')}}"></script>

  {{-- Bower components --}}
  <script src="{{URL::asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  {{-- <script src="{{URL::asset('bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script> --}}
  {{-- <script src="{{URL::asset('bower_components/gijgo-datetimepicker/js/gijgo.min.js')}}"></script> --}}
  <!-- bootstrap datepicker -->
  <script src="{{URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <!-- bootstrap time picker -->
  <script src="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
  <!-- InputMask -->
  <script src="{{URL::asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
  <script src="{{URL::asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
  <script src="{{URL::asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

  {{-- DataTables --}}
  <script src="{{URL::asset('lib/datatables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('lib/datatables/js/dataTables.bootstrap4.min.js')}}"></script>

  {{-- GMap location picker --}}
  <script src="{{URL::asset('js/locationpicker.jquery.js')}}"></script>

  {{-- Input maks --}}
  <script src="{{URL::asset('admin/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

  <!-- bootstrap wysihtml5 - text editor -->
  <script src="{{URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

  {{-- CK Editor --}}
  <script src="{{URL::asset('bower_components/ckeditor/ckeditor.js')}}"></script>
  {{-- <script src="{{URL::asset('bower_components/ckeditor/ckeditor_sample.js')}}"></script> --}}

  {{-- bootstrap-input-spinner --}}
  <script src="{{URL::asset('js/bootstrap-input-spinner.js')}}"></script>




  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
      $('[data-toggle="popover"]').popover()
    })
  </script>

<script type="text/javascript">
  $(function () {
    $('.select2').select2({
      theme: 'bootstrap4',
    });
  });
</script>

<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5({
      toolbar: {
        "fa": true
      }
    })

    // $('.bid').inputmask('999.99', { 'placeholder': '00.0' })

    //Date picker
    $('.datepicker').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    })

    var date = new Date();
    date.setDate(date.getDate());

    $('.datepicker2').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
      startDate: date,
      todayHighlight: true

    })


    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      snapToStep: true,
      minuteStep: 5,
      defaultTime: false,
      defaultTime: 'current',
      icons: {
          up: 'fa fa-arrow-up',
          down: 'fa fa-arrow-down'
      }
    })
    //Datemask dd/mm/yyyy
    // $('.datepicker').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })


  })
</script>

<script type="text/javascript">
    var LHCChatOptions = {};
    LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500};
    (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
    var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
    po.src = '//support.dominicanshuttles.com/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true?r='+referrer+'&l='+location;
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script>

@yield('scripts')


</body>
</html>
