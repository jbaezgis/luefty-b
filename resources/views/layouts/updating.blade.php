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

  <meta property="og:description"content="World's first fair trade tourism auctions" />
    <meta property="og:title"content="@yield('title') - Luefty" />
    <meta property="og:url"content="https://luefty.com" />
    <meta property="og:type"content="website" />
    <meta property="og:locale"content="{{ app()->getLocale() }}" />
    <meta property="og:locale:alternate"content="es_ES" />
    {{-- <meta property="og:locale:alternate"content="{{ app()->getLocale() }}" /> --}}
    <meta property="og:site_name"content="Luefty" />
    <meta property="og:image"content="@yield('og-image')" />
    <meta property="og:image:url"content="@yield('og-image-url')" />

    {{-- <meta name="twitter:card"content="summary" />
    <meta name="twitter:title"content="@yield('title') - Luefty" />
    <meta name="twitter:site"content="@ybaezgis" /> --}}
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"@yield('title')"}</script>
    
    <meta name="_base_url" content="{{ url('/') }}">

  <!-- Favicons -->
  <link href="{{URL::asset('images/favicon.png')}}" rel="icon">
  <link href="{{URL::asset('images/favicon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,800" rel="stylesheet" integrity="sha384-XuYF8cvNOqkdGoXoQ+7JNDj7WjiAtYwQsemRAq26iJyQxoPqYKFrDtE2cTkuP+9W" crossorigin="anonymous"> --}}
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet" integrity="sha384-ZswrZUR9fUFZ7cgOCu9z+zur69ZuP38AXQDL+C+XDlZQ1o1+uLsWA/jDsx/U9q/U" crossorigin="anonymous"/>
  {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet" integrity="sha384-ZgZ9kWlGR8i/egnnxUHqZOY+q+/OS5XKGm1A6ffoHWVHEGEgulaJ30q5FgtgSgWh" crossorigin="anonymous"> --}}
  {{-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet" integrity="sha384-kaP7pEcXLCb0qKCCrr9FF2JL3QMBUplSgmhgfrVfktDxgsfBt4zd74JNX9W+B7Eq" crossorigin="anonymous"> --}}

  {{-- Google Maps Api --}}
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB50fxBrVikNVJVUy_TpP1nsGpPhiSZVAs&libraries=geometry,places">
  </script> --}}

  {{-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> --}}
  
  {{-- Select2 --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" integrity="sha384-QyBj6h6db75/JDTyCPXOPf/LKz7SKinEvgKVewS45N04pLBCHyZTXcmPccj9b65R" crossorigin="anonymous"/>  
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
    <div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center py-5">
                <img class="mb-2" src="{{URL::asset('images/logo.svg')}}" alt="" height="60"> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="display-4 text-muted">We are updating our website.</h1>
                <h3 class="text-primary">Come back soon.</h3>
            </div>
        </div>
    </div>
    </div>

    

    <footer class="new_footer_area bg_color">
      <div class="new_footer_top">
          <div class="container">
              <div class="row">
                  {{-- <div class="col-lg-3 col-md-6">
                      <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                          <h3 class="f-title f_600 t_color f_size_18"><img class="mb-2" src="{{URL::asset('images/logo.svg')}}" alt="" height="35"> </h3>
                      </div>
                  </div> --}}
                  {{-- <div class="col-lg-3 col-md-6">
                      <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                          <h3 class="f-title f_600 t_color f_size_18">Links</h3>
                          <ul class="list-unstyled f_list">
                              <li><a href="#">Transfers</a></li>
                              <li><a href="#">Tours</a></li>
                              <li><a href="#">Charter Flights</a></li>
                              <li><a href="#">Why Auctions?</a></li>
                              <li><a href="#">B2B</a></li>
                              <li><a href="#">Our Story</a></li>
                          </ul>
                      </div>
                  </div> --}}
                  {{-- <div class="col-lg-3 col-md-6">
                      <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                          <h3 class="f-title f_600 t_color f_size_18">Help</h3>
                          <ul class="list-unstyled f_list">
                              <li><a href="#">FAQ</a></li>
                              <li><a href="#">Term &amp; conditions</a></li>
                              <li><a href="#">Reporting</a></li>
                              <li><a href="#">Documentation</a></li>
                              <li><a href="#">Support Policy</a></li>
                              <li><a href="#">Privacy</a></li>        
                          </ul>
                      </div>
                  </div> --}}
                  {{-- <div class="col-lg-3 col-md-6">
                      <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
                          <h3 class="f-title f_600 t_color f_size_18">Networks</h3>
                          <div class="f_social_icon">
                              <a href="#" class="fa fa-facebook"></a>
                              <a href="#" class="fa fa-twitter"></a>
                              <a href="#" class="fa fa-linkedin"></a>
                              <a href="#" class="fa fa-pinterest"></a>
                          </div>
                      </div>
                  </div> --}}
              </div>
          </div>
          <div class="footer_bg">
              <div class="footer_bg_one"></div>
              <div class="footer_bg_two"></div>
          </div>
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
  <script src="https://js.stripe.com/v3/" ></script>

  {{-- <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js" integrity="sha384-HDBrcXeMFF7Dho/e9IdHeBwUVpvCGv11aMPO/RmExJwhQ//1r0HpQRYr+kg3mhjL" crossorigin="anonymous"></script> --}}

  <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js" integrity="sha384-7xH8JZtwaPcP+Whtba+8A18GFR/P9jQkiOj020/sMrn/2iiV/vTBfItteYkrzab5" crossorigin="anonymous"></script>

  {{-- Tail select --}}
  <script src="https://cdn.jsdelivr.net/npm/tail.select@0.5.15/js/tail.select-full.min.js" integrity="sha256-/Ph6E5QQSCLk3HmwJgwi9DBZMa+pjQJWRtcSvEpaax4=" crossorigin="anonymous"></script>

  {{-- Glider slider --}}
  <script src="{{ asset('plugins/glider/glider.js') }}"></script>
  <script src="{{ asset('plugins/tel-input/cleave.js') }}"></script>
  <script src="{{ asset('plugins/tel-input/cleave-phone.i18n.js') }}"></script>

@yield('scripts')


</body>
</html>
