<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- <title>@yield('title') | {{ config('app.name') }}</title> --}}
  {{-- SEO Tags --}}
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="@yield('description')">
  <meta name="keywords" content="@yield('keywords')">

  <meta property="og:description" content="World's first fair trade tourism auctions" />
  <meta property="og:title" content="@yield('title') - Luefty" />
  <meta property="og:url" content="https://luefty.com" />
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="{{ app()->getLocale() }}" />
  <meta property="og:locale:alternate" content="es_ES" />
  {{-- <meta property="og:locale:alternate"content="{{ app()->getLocale() }}" /> --}}
  <meta property="og:site_name" content="Luefty" />
  <meta property="og:image" content="@yield('og-image')" />
  <meta property="og:image:url" content="@yield('og-image-url')" />

  {{-- <meta name="twitter:card"content="summary" />
    <meta name="twitter:title"content="@yield('title') - Luefty" />
    <meta name="twitter:site"content="@ybaezgis" /> --}}
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "@yield('title')"
    }
  </script>

  <meta name="_base_url" content="{{ url('/') }}">
  <meta name="facebook-domain-verification" content="h39acrh39qqjwovhzl8bthvvmyac8m" />
  <!-- Favicons -->
  <link href="{{URL::asset('images/favicon.png')}}" rel="icon">
  <link href="{{URL::asset('images/favicon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,800" rel="stylesheet" integrity="sha384-XuYF8cvNOqkdGoXoQ+7JNDj7WjiAtYwQsemRAq26iJyQxoPqYKFrDtE2cTkuP+9W" crossorigin="anonymous"> --}}
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet" integrity="sha384-ZswrZUR9fUFZ7cgOCu9z+zur69ZuP38AXQDL+C+XDlZQ1o1+uLsWA/jDsx/U9q/U" crossorigin="anonymous" />
  {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet" integrity="sha384-ZgZ9kWlGR8i/egnnxUHqZOY+q+/OS5XKGm1A6ffoHWVHEGEgulaJ30q5FgtgSgWh" crossorigin="anonymous"> --}}
  {{-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" integrity="sha384-kaP7pEcXLCb0qKCCrr9FF2JL3QMBUplSgmhgfrVfktDxgsfBt4zd74JNX9W+B7Eq" crossorigin="anonymous"> --}}

  {{-- Google Maps Api --}}
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB50fxBrVikNVJVUy_TpP1nsGpPhiSZVAs&libraries=geometry,places">
  </script> --}}

  {{-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> --}}

  {{-- Select2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" integrity="sha384-QyBj6h6db75/JDTyCPXOPf/LKz7SKinEvgKVewS45N04pLBCHyZTXcmPccj9b65R" crossorigin="anonymous" />
  <!-- bootstrap datepicker -->
  {{-- <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />

  <!-- Bootstrap time Picker -->
  {{-- <link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" integrity="sha512-E4kKreeYBpruCG4YNe4A/jIj3ZoPdpWhWgj9qwrr19ui84pU5gvNafQZKyghqpFIHHE4ELK7L9bqAv7wfIXULQ==" crossorigin="anonymous" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('fonts/font-awesome/css/font-awesome.min.css')}}">


  <!-- Bootstrap -->
  {{-- <link href="{{URL::asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  {{-- DataTables --}}
  <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" integrity="sha384-MhzYknwvie6oPyWsa+FquGDTHidhPxKdh+kRjveUU9sXhKI0FkgQFU7dAGP36mSB" crossorigin="anonymous">
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.19/integration/font-awesome/dataTables.fontAwesome.css"> --}}

  {{-- flags --}}
  {{-- <link href="{{URL::asset('css/flag-icon.min.css')}}" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-Cv93isQdFwaKBV+Z4X8kaVBYWHST58Xb/jVOcV9aRsGSArZsgAnFIhMpDoMDcFNoUtday1hdjn0nGp3+KZyyFw==" crossorigin="anonymous" />

  {{-- Stripe --}}
  {{-- <script src="https://js.stripe.com/v3/" integrity="sha384-ZQP2vWYe+Nkqd7MZ+JesAb+Nns3DW6dre0dAxmXdCGAANn7W7UDcU6keKVZpNHTh" crossorigin="anonymous"></script> --}}

  {{-- Tail select --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/css/bootstrap4/tail.select-default.css" integrity="sha256-GMBotkO3O1XxKyBKZCDRFWFyqwq1O3aS0ujVCSChNeo=" crossorigin="anonymous">

  {{-- <link href="{{URL::asset('css/subasta.css')}}" rel="stylesheet"> --}}
  <link href="{{URL::asset('plugins/glider/glider.css')}}" rel="stylesheet">
  {{-- <link href="{{URL::asset('plugins/tel-input/css/intlTelInput.scss')}}" rel="stylesheet"> --}}
  <link href="{{URL::asset('css/luefty.css')}}" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Ads: 629366279 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-629366279"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-629366279');
  </script>
  <!-- Event snippet for Website traffic conversion page -->
  <script>
    gtag('event', 'conversion', {
      'send_to': 'AW-629366279/RGoCCNCeu9EBEIe8jawC'
    });
  </script>

{{-- Cookies --}}
{{-- <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="5dfe545c-1e8c-4eff-a984-7ec683d00ac2" data-blockingmode="auto" type="text/javascript"></script> --}}

  <!-- Facebook Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '875408763062633');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=875408763062633&ev=PageView&noscript=1" /></noscript>
  <!-- End Facebook Pixel Code -->
  <meta name="google-site-verification" content="1OHuWYqq0ANWHw4TnlXO9e94EQzJew370KAgRvfzliY" />
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-199112184-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-199112184-1');
  </script>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-W7KWJV4');
  </script>
  <!-- End Google Tag Manager -->
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W7KWJV4');</script>
<!-- End Google Tag Manager -->
  @yield('head')
</head>

<!-- Arreglo para menu activo -->
<?php function activeMenuLight($url)
{
  return request()->is($url) ? 'active active-lang' : '';
} ?>
<?php function activeMenu($url)
{
  return request()->is($url) ? 'active active-menu' : '';
} ?>

<!-- fin -->

<body id="body" onload="init();">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W7KWJV4" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div class="container-fluid bg-white shadow-sm">
    <div class="container">
      <nav class="navbar navbar-light navbar-expand py-0 ">
        <a href="{{URL::to('/')}}" class="navbar-brand py-0"><img src="{{URL::asset('images/logo-tm.svg')}}" height="40" alt="Luefty"></a>

        <div class="ml-auto d-none d-sm-block">
          <ul class="navbar-nav ">
            <li class="nav-item mr-2 {{ activeMenu('/') }}"><a class="nav-link py-3" href="{{URL::to('/')}}">{{ __('Home') }}</a></li>
            {{-- <li class="nav-item mr-2 {{ activeMenu('/help-center') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ __('About Us') }}</a></li> --}}
            {{-- <li class="nav-item mr-2 {{ activeMenu('/AGENCIES') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ __('AGENCIES') }}</a></li> --}}
            <li class="nav-item {{ activeMenu('messages/create') }}"><a class="nav-link py-3" href="{{ route('messages.create') }}">{{ __('Contact US') }}</a></li>
            {{-- <li class="nav-item mr-2"><a class="nav-link" href="#">{{ __('Transfers') }}</a></li>
            <li class="nav-item mr-2"><a class="nav-link" href="#">{{ __('Tours') }}</a></li>
            <li class="nav-item mr-2"><a class="nav-link" href="#">{{ __('Charter Flights') }}</a></li>
            <li class="nav-item mr-2"><a class="nav-link" href="#">{{ __('Why Auctions?') }}</a></li>
            <li class="nav-item mr-2"><a class="nav-link" href="#">{{ __('B2B') }}</a></li>
            <li class="nav-item mr-2"><a class="nav-link" href="#">{{ __('Our Story') }}</a></li> --}}
            <li class="nav-item border-right pr-2 mr-2"></li>

            @if (auth()->guest())
            <div class="dropdown">
              <a class="btn btn-light dropdown-toggle mt-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            </div>
            @endif

            <li class="nav-item border-right pr-2 mr-2"></li>

            @if (auth()->check())
            {{-- <li class="nav-item {{ activeMenuLight('users*') }}">
            <a class="nav-link" href="{{ url('users') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('Here you can find Agencies and Suppliers and add them to your Favorites')}} ">{{__('Members')}}</a>
            </li> --}}
            @if (auth()->user()->isAdmin == true)

            @endif
            @endif

            @if (auth()->check())
            @else
            <li class="nav-item mr-2 "><a class="nav-link py-3" href="{{URL::to('/login')}}"><i class="fa fa-user    "></i> {{ __('New User/Sign In') }}</a></li>
            {{-- <li class="nav-item mr-2"><a class="nav-link" href="{{URL::to('/suppliers')}}">{{ __('Suppliers') }}</a></li> --}}
            @endif

            @if (Auth::check() && Auth::user()->hasRole('admin'))

            @endif
          </ul>
        </div>


        {{-- lang on larch screen --}}
        {{-- Oculto por ahora --}}
        {{-- <ul class="navbar-nav">
        @if (auth()->guest())
        <div class="dropdown">
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
  </div>
  @endif
  </ul> --}}
  {{-- end lang on xs--}}

  <ul class="navbar-nav ml-4 justify-content-end">
    @if (auth()->check())
    @else
    <li class="nav-item mr-2 d-block d-md-none"><a class="nav-link py-3" href="{{URL::to('/login')}}"><i class="fa fa-user    "></i> {{ __('Sign In') }}</a></li>
    {{-- <li class="nav-item mr-2"><a class="nav-link" href="{{URL::to('/suppliers')}}">{{ __('Suppliers') }}</a></li> --}}
    @endif
    <!--if user-->
    @if (auth()->check())
    <li class="nav-item dropdown">

      <a class="nav-link dropdown-toggle user-dropdown d-none d-sm-block" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ auth()->user()->name }}
        {{-- ({{ auth()->user()->userType->name }}) --}}

      </a>
      <a class="nav-link dropdown-toggle user-dropdown d-block d-md-none" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{-- Testing --}}
        {{-- <img src="{{URL::asset('images/user-image.png')}}" height="20" alt="User Image"> --}}
        {{ strtok(auth()->user()->name, " ") }}
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        {{-- Client items --}}
        {{-- @if (Auth::check() && Auth::user()->hasRole('client'))
            @endif --}}
        @if (Auth::user()->hasVerifiedEmail())
        <a class="dropdown-item" href="{{ url('myauctions/privatetransfers/index') }}">{{ __('Manage Auctions') }}</a>
        <a class="dropdown-item" href="{{ url('suppliers/index') }}">{{ __('Manage Bids') }}</a>
        {{-- @if (Auth::check() && Auth::user()->user_type == 1)
              @else
                <a class="dropdown-item" href="{{ url('suppliers/index') }}">{{ __('Manage Bids') }}</a>
        @endif --}}
        @endif

        <div class="dropdown-divider"></div>
        {{-- @if (Auth::user()->hasVerifiedEmail())
              <a class="dropdown-item" href="{{ url('users') }}">{{ __('Members') }}</a>
        @endif --}}
        {{-- Admin items --}}
        @if (Auth::check() && Auth::user()->hasRole('admin'))
        <div class="dropdown-divider"></div>
        {{-- <span class=" pl-3 text-muted">{{__('Administration')}} </span> --}}
        <a class="dropdown-item" href="{{ url('administration') }}"><i class="fa fa-user-secret" aria-hidden="true"></i> {{ __('Administration') }}</a>
        {{-- <a class="dropdown-item" href="{{ route('users.index') }}"><i class="fa fa-users"></i> {{ __('Manage Users') }}</a> --}}
        {{-- <a class="dropdown-item" href="{{ route('services.index') }}"><i class="fa fa-list"></i> {{ __('Manage Services') }}</a> --}}
        {{-- <a class="dropdown-item" href="{{ route('countries.index') }}"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ __('Locations') }}</a> --}}
        {{-- <a class="dropdown-item" href="{{ route('booking.touristAuctions') }}"><i class="fa fa-list" aria-hidden="true"></i> {{ __('Tourist Auctions') }}</a> --}}
        {{-- <li class="nav-item mr-2 {{ activeMenu('booking/tourist-auctions*') }}"><a class="nav-link" href="{{ route('booking.touristAuctions') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('Supplier')}} ">{{ __('Tourist Auctions') }}</a>
    </li> --}}
    @endif
    @if (auth()->user()->isAdmin == true)
    {{-- <a class="dropdown-item" href="{{ route('system.settings') }}"><i class="fa fa-gears"></i> {{ __('Settings') }}</a> --}}
    @endif
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa fa-user"></i> {{ __('My profile') }}</a>
    {{-- <a class="dropdown-item" href="{{ route('password.request') }}" ><i class="fa fa-lock" aria-hidden="true"></i> {{ __('Change my password') }} </a> --}}
    <div class="dropdown-divider"></div>

    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
  {{-- <div class="container-fluid bg-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{__('We are growing!')}}</h4>
  <h5>2021</h5>
  <p>Mediterranean</p>
  <p>Caribbean</p>

  <h5>2022</h5>
  <p>South America</p>
  <p>Central America</p>

  <h5>2023</h5>
  <p>Africa</p>
  <p>Asia</p>
  <p>North America</p>
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
  </div> --}}
  {{-- <div class="container">
  <footer class="py-3">
      <div class="row">
        <div class="col-md-12">
            <span class="d-block mb-3 text-muted"><img class="mb-2" src="{{URL::asset('images/logo.svg')}}" alt="" height="40"> Luefty GmbH Vienna, Austria Patent Pending, Copyright 2020 All Rights Reserved. <span class="pull-right">{{__('Support:')}} info@luefty.com</span></span>
  </div>

  </div>
  </footer>
  </div>--}}


  <footer class="new_footer_area bg_color border-top mt-5">
    <div class="new_footer_top pt-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-6">
            <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
              <h3 class="f-title f_600 t_color f_size_18"><img class="mb-2" src="{{URL::asset('images/logo-tm.svg')}}" alt="" height="35"> </h3>
              {{-- <p>Don’t miss our updates of new features and improvements!</p>
                          <form action="#" class="f_subscribe_two mailchimp" method="post" novalidate="true" _lpchecked="1">
                              <input type="text" name="EMAIL" class="form-control memail" placeholder="Email">
                              <br>
                              <button class="btn btn-primary" type="submit">Subscribe</button>
                              <p class="mchimp-errmessage" style="display: none;"></p>
                              <p class="mchimp-sucmessage" style="display: none;"></p>
                          </form> --}}
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
              <h3 class="f-title f_600 t_color f_size_18">{{__('Links')}}</h3>
              <ul class="list-unstyled f_list">
                <li><a href="{{url('/about-us')}}">{{__('About us')}}</a></li>
                <li><a href="{{url('/overview')}}">{{__('Overview')}}</a></li>
                <li><a href="{{url('/how-does-it-work')}}">{{__('How does it work')}}</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
              <h3 class="f-title f_600 t_color f_size_18">{{__('Help')}}</h3>
              <ul class="list-unstyled f_list">
                {{-- <li><a href="#">FAQ</a></li> --}}
                <li><a href="{{__('/terms-and-conditions')}}">{{__('Term and conditions')}}</a></li>
                <li><a href="{{__('/privacy-policy')}}">{{__('Privacy Policy')}}</a></li>
                <li><a href="{{__('/rules')}}">{{__('Rules')}}</a></li>
                {{-- <li><a href="#">Documentation</a></li>
                              <li><a href="#">Support Policy</a></li>
                              <li><a href="#">Privacy</a></li>         --}}
              </ul>
            </div>
          </div>
          {{-- <div class="col-lg-2 col-md-6">
            <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
              <h3 class="f-title f_600 t_color f_size_18">Networks</h3>
              <div class="f_social_icon">
                <a href="https://www.facebook.com/lueftyinternational/" class="fa fa-facebook"></a>
                <a href="https://www.instagram.com/lueftyinternational" class="fa fa-instagram"></a>
              </div>
            </div>
          </div> --}}
          <div class="col-lg-4 col-md-6">
            <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
              <h3 class="f-title f_600 t_color f_size_18">{{__('Contacts')}}</h3>
              <div class="f_list">
                <small class="text-muted">For Latin America and the Caribbean: </small> <br>
                <span>1 829 820 5200</span> <br>
                <br>
                <small class="text-muted">For Europe and Turkey: </small><br>
                <span>00 34 630 620 517</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="footer_bg">
        <div class="footer_bg_one"></div>
        <div class="footer_bg_two"></div>
      </div> --}}
    </div>
    <div class="footer_bottom">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 col-sm-7">
            <p class="mb-0 f_400">© Luefty. All rights reserved. Luefty GmbH, Vienna, Austria. Patent Pending</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  {{-- Select2 --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" integrity="sha384-G0GDRbnjku69lu+u8lJ7+Yk/tx6WoelGZWGMBYN7YzWdU+yu07XXjmO2rNS72/Px" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>

  <!-- bootstrap time picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>


  {{-- DataTables --}}
  {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> --}}
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" integrity="sha384-XnTxmviuqUy3cHBf+lkYWuTSDlhxCDxd9RgSo5zvzsCq93P9xNa6eENuAITCwxNh" crossorigin="anonymous"></script>
  {{-- <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script> --}}
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" integrity="sha384-bX64nQ/u/Jovgh0rdhdtHy2BMWv9TOOds6b4reiVcJ0KcA76JdIxmwar1pN2NsUj" crossorigin="anonymous"></script>

  <!-- bootstrap wysihtml5 - text editor -->
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5.min.js" integrity="sha512-ajcjI21X2TXh2y3AbYfcyHhyDvkm56bNiwx8vLPPt2l8N3FJ8vM8GwhL+ACNw+I4KagIJUjtjzWILBdaktd5FA==" crossorigin="anonymous"></script> --}}

  {{-- FontAwesome --}}
  {{-- <script src="https://use.fontawesome.com/f97128392c.js"></script> --}}

  {{-- Stripe --}}
  {{-- <script src="https://js.stripe.com/v3/" integrity="sha384-fJpFr2JDA8aGUcU0xMQsb2xFFTqoOICAs/1KEwrUOrgud90+Wq1wJP2U/wt4Oz1k" crossorigin="anonymous"></script> --}}
  {{-- <script src="https://js.stripe.com/v3/" integrity="sha384-DlraKmzJ3de8d8SEjcAInJMNNV/AEGDS1k9fMNcOoQinlRq8TVOVd7to6RoKNF/F" crossorigin="anonymous"></script> --}}
  <script src="https://js.stripe.com/v3/"></script>

  {{-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js" integrity="sha384-HDBrcXeMFF7Dho/e9IdHeBwUVpvCGv11aMPO/RmExJwhQ//1r0HpQRYr+kg3mhjL" crossorigin="anonymous"></script> --}}

  <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js" integrity="sha384-7xH8JZtwaPcP+Whtba+8A18GFR/P9jQkiOj020/sMrn/2iiV/vTBfItteYkrzab5" crossorigin="anonymous"></script>

  {{-- Tail select --}}
  <script src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.min.js" integrity="sha256-/Ph6E5QQSCLk3HmwJgwi9DBZMa+pjQJWRtcSvEpaax4=" crossorigin="anonymous"></script>

  {{-- Glider slider --}}
  <script src="{{ asset('plugins/glider/glider.js') }}"></script>
  <script src="{{ asset('plugins/tel-input/cleave.js') }}"></script>
  <script src="{{ asset('plugins/tel-input/cleave-phone.i18n.js') }}"></script>

  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $(function() {
      $('[data-toggle="popover"]').popover()
    })
  </script>

  {{-- <script>
    CKEDITOR.replace( 'description');
  </script> --}}

  <script>
    $(function() {
      $('.select2').select2({
        // theme: 'bootstrap4',
      });
    });
  </script>

  <script>
    tail.select('.tail-select-from', {
      search: true,
      descriptions: true,
      placeholder: 'Pick up Location',
      // animate: true, 
    });

    tail.select('.tail-select-to', {
      search: true,
      descriptions: true,
      placeholder: 'Drop off Location',
      // animate: true, 
    });
  </script>

  <script>
    $(function() {

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

  {{-- <script type="text/javascript">
    var LHCChatOptions = {};
    LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500};
    (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
    var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
    po.src = '//support.dominicanshuttles.com/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true?r='+referrer+'&l='+location;
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script> --}}

  <!--Start of Tawk.to Script-->
  {{-- <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/5f5288df4704467e89ec470e/default';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script> --}}
  <!--End of Tawk.to Script-->
  <script>var LHC_API = LHC_API||{};
    LHC_API.args = {mode:'widget',lhc_base_url:'//chat.luefty.com/',wheight:450,wwidth:350,pheight:520,pwidth:500,domain:'luefty.com',leaveamessage:true,check_messages:false};
    (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.setAttribute('crossorigin','anonymous'); po.async = true;
    var date = new Date();po.src = 'https://chat.luefty.com/design/defaulttheme/js/widgetv2/index.js?'+(""+date.getFullYear() + date.getMonth() + date.getDate());
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
  </script>
  
  {{-- Cookies --}}
  {{-- <script id="CookieDeclaration" src="https://consent.cookiebot.com/5dfe545c-1e8c-4eff-a984-7ec683d00ac2/cd.js" type="text/javascript" async></script> --}}
  
  @yield('scripts')

</body>

</html>