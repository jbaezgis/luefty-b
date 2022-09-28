@extends('layouts.app2', ['title' => 'GROUP OPTION 2', 'hidesidebar' => true,])

@section('head')
	<link rel="stylesheet" href="{{URL::asset('/btdatepicker/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('content')
<div class="row"> 
    <div class="col-md-12 text-center" style="background: url(/img/whales/whales_siteRecurso_5image_.png) no-repeat center center; background-size: 100%; padding-top: 50px; padding-bottom: 50px;">
        <h1><span class="text-primary">Whales of Samana</span></h1>
        <h2 class=""><span class="">Ecological Tourism for all</span></h2>
    </div>
</div>
<p></p>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <h3>Group Option 2 <small>Whales Group Tour by Ground Transportation from Punta Cana</small></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Booking Information
                </h3>
            </div>
            <div class="box-body">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert"><strong>Oops</strong>, Please correct the errors in the form</div>
                @endif
                <form method="POST" action="{{ route('orders.store') }}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" id="whale_id" name="whale_id" value="6">
                    @include('whales.form', ['orders' => new App\Order])

                    <br>
                    <button type="submit" class="btn btn-primary" data-submit-value="Please wait...">Send</button>
            
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
            <div class="box box-solid box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        GROUP OPTION 2
                    </h3>
                </div>
                <div class="box-body">
                    
                    <ul class="nav nav-stacked">
                        <li class="text-center">
                            <p class="lead"><strong>The price for this full day tour is:</strong></p>
                            <p class="lead"><i>Whale watching combined with Rincon Beach:</i></p>
                        </li>
                        <li class="text-center">
                            <p class="lead"><strong>U$ 129.00</strong> per adult.</p>
                        </li>
                        <li class="text-center">
                            <p class="lead"><strong>U$ 79.00</strong> for kids 11 and under.</p>
                        </li>
                        <li class="text-center">
                            <p class="lead">Included are all land and sea transportation, professional multilingual guides, National Park fees, as well as lunch and beverages.</p>
                        </li>
                    </ul>
                </div>
                {{-- end box-body --}}
                {{-- <div class="box-footer text-center">
                        <i>This Private Excursion is available every day of the week from January 15th to March 20th. Please book well in advance in order to secure your aircraft.</i>
                </div> --}}
            </div>
            {{-- end box --}}
        </div>
        {{-- end col --}}
</div>
<hr>
<div class="row">
    <div class="col-md-12 text-center">
        <h4>
            The whale tour is too beautiful and fun to leave it to a booking form. Call us at 829.820.5200 or chat or email. We really want you to enjoy your tour and to appreciate the options. We do not charge more than others but you do get our exceptional personal service.
        </h4>
    </div>
</div>

</div>
@endsection

@section('footer')
<script src="{{URL::asset('/btdatepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose : true,
        startDate: "-",
        clearBtn: true,
        todayHighlight: true
        });
    });
</script>
@endsection