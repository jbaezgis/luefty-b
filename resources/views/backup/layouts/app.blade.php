<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{URL::asset('images/favicon.png')}}" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{URL::asset('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{URL::asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <!-- <link href="css/style.css" rel="stylesheet"> -->
  <link href="{{URL::asset('css/app.css')}}" rel="stylesheet"> 


</head>

<body id="body">

  <nav class="navbar navbar-light navbar-expand-md bg-white border-bottom shadow-sm">
       <a href="{{URL::to('/')}}" class="navbar-brand"><img src="{{URL::asset('images/logo.svg')}}" height="40"></a>
      
      
      <ul class="nav ml-auto justify-content-end">
        <!-- <li class="nav-item"><a class="nav-link" href="{{URL::to('setlanguage/es')}}">ES</a></li>
        <li class="nav-item"><a class="nav-link" href="{{URL::to('setlanguage/en')}}">EN</a></li> -->
        <!--if user-->
        @if (auth()->check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle user-dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="/users/{{ auth()->id() }}/edit">{{ trans('auth.profile') }}</a>
            <a class="dropdown-item" href="#">{{ trans('auth.change_password') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">Logout</a>
          </div>
        </li> 
        @endif
        @if (auth()->guest())
        <div class="btn-group" role="group" aria-label="Basic example">
          <a href="/login" class="btn btn-outline-primary btn-sm">{{ trans('auth.login') }}</a>
          <a href="/register" class="btn btn-outline-success btn-sm">{{ trans('auth.sign_up') }}</a>
        </div>
        @endif
      </ul>
    </nav>

    <nav class="navbar navbar-dark navbar-expand-md bg-dark" style="padding-bottom: 5px; padding-top: 5px;">
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Arreglo para menu activo -->
        <?php function activeMenu($url){
          return request()->is($url) ? 'active' : '';
        }?>
      <!-- fin -->

      <div class="navbar-collapse collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto justify-content-center">
         <li class="nav-item {{ activeMenu('/') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ trans('menu.home') }}</a></li>
         <li class="nav-item {{ activeMenu('messages/create') }}"><a class="nav-link" href="{{ route('messages.create') }}">{{ trans('menu.contactus') }}</a></li>
         @if (auth()->check())
           <li class="nav-item {{ activeMenu('messages') }}"><a class="nav-link" href="{{ route('messages.index') }}">{{ trans('menu.messages') }}</a></li>
           @if (auth()->user()->hasRoles(['super_admin']))
             <li class="nav-item {{ activeMenu('users') }}"><a class="nav-link" href="{{ route('users.index') }}">{{ trans('menu.users') }}</a></li>
           @endif
         @endif

       </ul>
        
       <ul class="nav navbar-nav ml-auto justify-content-end">
         
       </ul>

     </div>
   </nav>
    
  <!--==========================
    Container
  ============================-->

   @yield('content')


  <!--==========================
    Footer
  ============================-->
  <hr>
  <div class="container">
  <footer class="pt-4 my-md-5 pt-md-5">
      <div class="row">
        <div class="col-12 col-md">
          <img class="mb-2" src="{{URL::asset('images/logo.svg')}}" alt="" height="40">
          <small class="d-block mb-3 text-muted">&copy; {{ date('Y')}} </small>
        </div>
        <div class="col-6 col-md">
          <h5>{{ trans('globals.home') }}</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">{{ trans('auth.sign_up') }}</a></li>
            <li><a class="text-muted" href="#">{{ trans('auth.login') }}</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>{{ trans('globals.company') }}</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">{{ trans('menu.privacy') }}</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
        <h5>{{ trans('globals.contact_us') }}</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-primary">info@porsubasta.com</a></li>
        </ul>
          
        </div>
      </div>
    </footer>
    </div>
  <!-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->

  <!-- JavaScript Libraries -->
  <script src="{{URL::asset('js/jquery-3.3.1.slim.min.js')}}"></script>
  <script src="{{URL::asset('js/popper.min.js')}}"></script>
  <script src="{{URL::asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('js/modernizr-2.8.3.min.js')}}"></script>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>

</body>
</html>