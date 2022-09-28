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
  {{-- <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}"> --}}
  <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('bower_components/select2/dist/css/select2-bootstrap4.min.css')}}">
  {{-- <link rel="stylesheet" href="{{URL::asset('bower_components/gijgo-datetimepicker/css/gijgo.min.css')}}"> --}}

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">
  
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
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
  @yield('head')
</head>

<body id="body">
<section class="">
  <nav class="navbar navbar-light navbar-expand-xs bg-white border-bottom shadow-sm">
       <a href="{{URL::to('/')}}" class="navbar-brand"><img src="{{URL::asset('images/luefty-logo.svg')}}" height="40"></a>
       
      {{-- lang on xs --}}
      <ul class="navbar-nav ml-2 justify-content-end d-none d-sm-block">
       
      </ul>
      {{-- end lang on xs--}}
      
      <ul class="nav ml-4 justify-content-end">
          @if (auth()->guest())
          <div class="btn-group" role="group" aria-label="Basic example">
              <a href="locale/en" class="btn {{ Config::get('app.locale') == 'en' ? 'btn-ligth active-lang' : 'btn-ligth' }}"><span class="flag-icon flag-icon-us"></span> EN</a>
              <a href="locale/es" class="btn {{ Config::get('app.locale') == 'es' ? 'btn-ligth active-lang' : 'btn-ligth' }}"><span class="flag-icon flag-icon-es"></span> ES</a>
          </div>
          @endif
         
        
      </ul>
    </nav>

    <nav class="navbar navbar-expand navbar-dark navbar-expand-md bg-dark" style="padding-bottom: 5px; padding-top: 5px;">
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Arreglo para menu activo -->
        <?php function activeMenuLight($url){
          return request()->is($url) ? 'active active-lang' : '';
        }?>
        <?php function activeMenu($url){
          return request()->is($url) ? 'active active-menu' : '';
        }?>
      <!-- fin -->
      
      @if (Auth::check())
      @section('counts')
      {{ $privatecount = App\Auction::private()->active()->whereNotNull('from_location')->where('user_id', auth()->user()->id)->count() }}
      {{ $sharingcount = App\Auction::sharing()->active()->whereNotNull('from_location')->where('user_id', auth()->user()->id)->count() }}
      {{ $trashcount = App\Auction::where('deleted', 1)->where('user_id', auth()->user()->id)->count() }}
      @endsection
      @endif 

      @section('amenu_formedit')
        {{-- @if (url('myauction/*/edit'))
        {{ $auction = $id; }}
        @endif --}}
      @endsection

      <div class="navbar-collapse collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto justify-content-center">
         {{-- <li class="nav-item {{ activeMenu('/') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ trans('menu.home') }}</a></li>
         <li class="nav-item {{ activeMenu('transfers') }}"><a class="nav-link" href="{{ route('auctions.transfers') }}">{{ trans('menu.all_transfers_auctions') }}</a></li>
         <li class="nav-item {{ activeMenu('account*') }}"><a class="nav-link" href="{{ route('account.transfers-bids') }}">{{ trans('menu.my_transfers_bids') }}</a></li>
         <li class="nav-item {{ activeMenu('tours') }}"><a class="nav-link" href="{{ route('tours.tours') }}">{{ trans('menu.all_tours_auctions') }}</a></li>
         <li class="nav-item {{ activeMenu('account*') }}"><a class="nav-link" href="{{ route('account.tours-bids') }}">{{ trans('menu.my_tours_bids') }}</a></li> --}}
        @if (Auth::check() && Auth::user()->can('messages-menu'))
           {{-- <li class="nav-item {{ activeMenu('messages') }}"><a class="nav-link" href="{{ route('messages.index') }}">{{ trans('menu.messages') }}</a></li> --}}
        @endif
        {{-- @if (Auth::check() && Auth::user()->can('myaccount-menu'))
           <li class="nav-item {{ activeMenu('account*') }}"><a class="nav-link" href="{{ route('account.index') }}">Mi Cuenta</a></li>
           
        @endif --}}
        
        @if (auth()->guest())
          <li class="nav-item mr-2 {{ activeMenu('/') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ trans('menu.home') }}</a></li>
          <li class="nav-item {{ activeMenu('messages/create') }}"><a class="nav-link" href="{{ route('messages.create') }}">{{ trans('menu.contactus') }}</a></li>
          <li class="nav-item mr-2 {{ activeMenu('how-does-it-works') }}"><a class="nav-link" href="{{ route('pages.howworks') }}">@lang('menu.how_does_it_work')</a></li>
        @elseif (Auth::check() && Auth::user()->hasRole('super-admin'))
          {{-- <li class="nav-item {{ activeMenu('/') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ trans('menu.home') }}</a></li> --}}
          <li class="nav-item mr-2 {{ activeMenu('myauctions/privatetransfers/*') }}">
            <a class="nav-link" href="{{ route('privatetransfers.index') }}">{{ __('Private Transfers') }} 
              {{-- <span class="badge badge-light border">{{ $privatecount }}</span> --}}
            </a>
          </li>
          <li class="nav-item mr-2 {{ activeMenu('myauctions/sharedshuttles/*') }}">
            <a class="nav-link" href="{{ route('sharedshuttles.index') }}">{{ __('Shared Transfers') }} 
              {{-- <span class="badge badge-light border">{{ $sharingcount }}</span> --}}
            </a>
          </li>
          {{-- <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> --}}
          <li class="nav-item mr-2 {{ activeMenu(['transfers*', 'auctions*']) }}"><a class="nav-link" href="{{ route('auctions.privatetransfers') }}">{{ __('Auctions') }}</a></li>
          {{-- <li class="nav-item mr-2 {{ activeMenu('mybids') }}"><a class="nav-link" href="{{ route('mybids.index') }}">{{ __('All bids') }}</a></li> --}}
          <li class="nav-item mr-2 {{ activeMenu('mybids/won/index') }}"><a class="nav-link" href="{{ route('mybids.won') }}">{{ __('Accepted Bids') }}</a></li>
          {{-- <li class="nav-item mr-2 {{ activeMenu('mybids/lost/index') }}"><a class="nav-link" href="{{ route('mybids.lost') }}">{{ __('My Lost Bids') }}</a></li> --}}
          <li class="nav-item mr-2 {{ activeMenu('mybids/canceled/index') }}"><a class="nav-link" href="{{ route('mybids.canceled') }}">{{ __('Cancelled Auctions') }}</a></li>
          @elseif (Auth::check() && Auth::user()->hasRole('admin'))
          <li class="nav-item mr-2 {{ activeMenu('myauctions*') }}"><a class="nav-link" href="{{ URL('myauctions') }}">{{ trans('menu.my_auctions') }}</a></li>
          <li class="nav-item mr-2 {{ activeMenu('transfers*') }}"><a class="nav-link" href="{{ route('auctions.transfers') }}">{{ trans('menu.all_auctions') }}</a></li>
        @elseif (Auth::check() && Auth::user()->hasRole('auctioneer'))
          {{-- <li class="nav-item {{ activeMenu('/') }}"><a class="nav-link" href="{{URL::to('/')}}">{{ trans('menu.home') }}</a></li> --}}
          <li class="nav-item mr-2 {{ activeMenu('myauctions/privatetransfers/index') }}"><a class="nav-link" href="{{ route('privatetransfers.index') }}">{{ __('Private Transfers') }} {{-- <span class="badge badge-light border">{{ $privatecount }}</span> --}}</a></li>
          <li class="nav-item mr-2 {{ activeMenu('myauctions/sharedshuttles/index') }}"><a class="nav-link" href="{{ route('sharedshuttles.index') }}">{{ __('Shared Transfers') }} {{-- <span class="badge badge-light border">{{ $sharingcount }}</span> --}}</a></li>          
          {{-- <li class="nav-item mr-2 {{ activeMenu('myauctions/trash/index') }}"><a class="nav-link" href="{{ route('myauctions.trash') }}">{{ __('Trash') }} <span class="badge badge-danger">{{ $trashcount }}</span></a></li>           --}}
        @elseif (Auth::check() && Auth::user()->hasRole('bidder'))
          <li class="nav-item mr-2 {{ activeMenu('auctions*') }}"><a class="nav-link" href="{{ route('auctions.privatetransfers') }}">{{ __('Auctions') }}</a></li>
          {{-- <li class="nav-item mr-2 {{ activeMenu('mybids') }}"><a class="nav-link" href="{{ route('mybids.index') }}">{{ __('All bids') }}</a></li> --}}
          <li class="nav-item mr-2 {{ activeMenu('mybids/won/index') }}"><a class="nav-link" href="{{ route('mybids.won') }}">{{ __('Accepted Bids') }}</a></li>
          {{-- <li class="nav-item mr-2 {{ activeMenu('mybids/lost/index') }}"><a class="nav-link" href="{{ route('mybids.lost') }}">{{ __('My Lost Bids') }}</a></li> --}}
          <li class="nav-item mr-2 {{ activeMenu('mybids/canceled/index') }}"><a class="nav-link" href="{{ route('mybids.canceled') }}">{{ __('Cancelled Auctions') }}</a></li>
       
        @endif

       </ul>
        
       <ul class="nav navbar-nav ml-auto justify-content-end">
          @if (auth()->guest())

          @elseif (Auth::check() & Auth::user()->hasRole('super-admin') or Auth::user()->hasRole('auctioneer') )
            <li class="nav-item mr-2 {{ activeMenu('myauctions/trash/index') }} "><a class="nav-link" href="{{ route('myauctions.trash') }}">{{ __('Trash') }} {{--<span class="badge badge-light border">{{ $trashcount }}</span>--}}</a></li>
          @endif
       </ul>

     </div>
   </nav>
</section>
  <!--==========================
    Container
  ============================-->
    <div id="app"> </div>
    <div class="">
      @yield('content')
    </div>

  <!--==========================
    Footer
  ============================-->
  <hr>
  <div class="container">
  <footer class="pt-4 my-md-5 pt-md-5">
      <div class="row">
        <div class="col-md-4">
          <img class="mb-2" src="{{URL::asset('images/luefty-logo.svg')}}" alt="" height="40">
          <small class="d-block mb-3 text-muted">&copy; {{ date('Y')}} </small>
        </div>
        {{-- <div class="col-6 col-md">
          <h5>{{ trans('globals.home') }}</h5>
          <ul class="list-unstyled text-small">
            @if (auth()->check())
            <li><a class="text-muted" href="{{ route('account.index') }}">My Account</a></li>
            @endif
            @if (auth()->guest())
            <li><a class="text-muted" href="#">{{ trans('auth.sign_up') }}</a></li>
            <li><a class="text-muted" href="#">{{ trans('auth.login') }}</a></li>
            @endif
            
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>{{ trans('globals.company') }}</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">{{ trans('menu.privacy') }}</a></li>
            <li><a class="text-muted" href="{{ route('pages.about') }}">@lang('menu.the_company')</a></li>
            <li><a class="text-muted" href="{{ route('pages.faqs') }}">@lang('menu.how_does_it_work')</a></li>
          </ul>
        </div> --}}
        <div class="col-md-4">
        <h5>{{ trans('globals.contact_us') }}</h5>
        <ul class="list-unstyled text-small">
          {{-- <li><a class="text-primary">info@porsubasta.com</a></li> --}}
          <li><a class="text-muted" href="{{ route('messages.create') }}">{{ trans('menu.contactus') }}</a></li>
        </ul>
          
        </div>
      </div>
    </footer>
    </div>
  <!-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> -->

  <!-- JavaScript Libraries -->
  {{-- <script src="{{URL::asset('js/app.js')}}"></script> --}}
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

@yield('scripts')


</body>
</html>