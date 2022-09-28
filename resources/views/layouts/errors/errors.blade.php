<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <title>@yield('title') | PorSubasta</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
  
  <!-- Bootstrap CSS File -->
  <link href="{{URL::asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  

  <link href="{{URL::asset('css/subasta.css')}}" rel="stylesheet"> 
  @yield('head')
</head>

<body id="body">
<section class="">
    
</section>
  <!--==========================
    Container
  ============================-->
    <div class="">
      @yield('content')
    </div>
  
</body>
</html>