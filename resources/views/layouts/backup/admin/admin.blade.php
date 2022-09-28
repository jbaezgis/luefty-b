<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PorSubasta | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{URL::asset('images/favicon.png')}}" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{URL::asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{URL::asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{URL::asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('admin/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{URL::asset('admin/css/skins/_all-skins.min.css')}}">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black-light sidebar-mini fixed">
<div class="wrapper">

@include('layouts.admin.header')  

@include('layouts.admin.menu')

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
</div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
            {{-- <img class="mb-2" src="{{URL::asset('images/logo.svg')}}" alt="" height="40">
            <small class="d-block mb-3 text-muted">1.0.1</small> --}}
        </div>
        <strong>&copy; {{ date('Y')}}
    </footer>

</div>
<!-- ./wrapper -->
    
    <!-- jQuery 3 -->
    <script src="{{URL::asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{URL::asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('admin/js/adminlte.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{URL::asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap  -->
    <script src="{{URL::asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{URL::asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{URL::asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{URL::asset('admin/bower_components/chart.js/Chart.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('admin/js/pages/dashboard2.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::asset('admin/js/demo.js')}}"></script>
    <!-- Select2 -->
    <script src="{{URL::asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

    <script>
       $('.select2').select2()
       $('.textarea').wysihtml5()
    </script>
    </body>
</html>