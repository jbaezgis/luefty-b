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
        <link href="{{URL::asset('images/favicon.png')}}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet" integrity="sha384-ZswrZUR9fUFZ7cgOCu9z+zur69ZuP38AXQDL+C+XDlZQ1o1+uLsWA/jDsx/U9q/U" crossorigin="anonymous"/>
        
        {{-- Select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" integrity="sha384-QyBj6h6db75/JDTyCPXOPf/LKz7SKinEvgKVewS45N04pLBCHyZTXcmPccj9b65R" crossorigin="anonymous"/>  
        <!-- bootstrap datepicker -->
        {{-- <link rel="stylesheet" href="{{URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />

        <!-- Bootstrap time Picker -->
        {{-- <link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" integrity="sha512-E4kKreeYBpruCG4YNe4A/jIj3ZoPdpWhWgj9qwrr19ui84pU5gvNafQZKyghqpFIHHE4ELK7L9bqAv7wfIXULQ==" crossorigin="anonymous" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{URL::asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">

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
      
        {{-- <link href="{{URL::asset('css/subasta.css')}}" rel="stylesheet"> --}}
        <link href="{{URL::asset('css/luefty.css')}}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/css/fileinput.min.css" integrity="sha512-8KeRJXvPns3KF9uGWdZW18Azo4c1SG8dy2IqiMBq8Il1wdj7EWtR3EGLwj+DnvznrRjn0oyBU+OEwJk7A79n7w==" crossorigin="anonymous" />
      
        @yield('head')
    </head>
<!-- Arreglo para menu activo -->

@include('layouts.admin.header')
@include('layouts.admin.menu')

<body id="body">

    {{-- Content --}}
    <div id="app">
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('layouts.admin.footer')

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    {{-- Select2 --}}
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

    {{-- Stripe --}}
    {{-- <script src="https://js.stripe.com/v3/" integrity="sha384-fJpFr2JDA8aGUcU0xMQsb2xFFTqoOICAs/1KEwrUOrgud90+Wq1wJP2U/wt4Oz1k" crossorigin="anonymous"></script> --}}
    <script src="https://js.stripe.com/v3/" integrity="sha384-DlraKmzJ3de8d8SEjcAInJMNNV/AEGDS1k9fMNcOoQinlRq8TVOVd7to6RoKNF/F" crossorigin="anonymous"></script>
    
    {{-- CKEditor --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js" integrity="sha384-7xH8JZtwaPcP+Whtba+8A18GFR/P9jQkiOj020/sMrn/2iiV/vTBfItteYkrzab5" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js" integrity="sha384-HDBrcXeMFF7Dho/e9IdHeBwUVpvCGv11aMPO/RmExJwhQ//1r0HpQRYr+kg3mhjL" crossorigin="anonymous"></script>
    
    <script src="{{URL::asset('plugins/ckeditor/ckeditor.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/fileinput.min.js" integrity="sha512-vDrq7v1F/VUDuBTB+eILVfb9ErriIMW7Dn3JC/HOQLI8ZzTBTRRKrKJO3vfMmZFQpEGVpi+EYJFatPgVFxOKGA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/themes/fa/theme.min.js" integrity="sha512-eur4+EF8SPJo3fhe8mMkdSwopFRsMtCU2NvPm8aKjxWFs3/9naJn5HbYi+KPGwAinR5xYzz0/njHcGzifM9KCg==" crossorigin="anonymous"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>

<script>
    CKEDITOR.replace( 'description');
    // CKEDITOR.replace( 'short_description');
</script>

<script>
    $(function () {
        $('.select2').select2({
        // theme: 'bootstrap4',
        });
        
        $('#image').fileinput({
        theme: 'fa',
        // showPreview: false,
        showUpload: false,
        showRemove: false,
        showClose: false,
        });

        $('#multiple-images').fileinput({
        theme: 'fa',
        showUpload: false,
        showRemove: false,
        showClose: false,
        });
    });
</script>

<script>
    $(function () {
        
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

})
</script>

@yield('scripts')

</body>
</html>