@extends('layouts.app2', ['title' => 'EXCLUSIVE OPTION 4', 'hidesidebar' => true,])

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
        <h3>Exclusive Option 4</h3>
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
                <form method="POST" action="{{ url('exclusive') }}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" id="whale_id" name="whale_id" value="4">
                    @include('whales.form', ['orders' => new App\Order])

                    <br>
                    <button type="submit" class="btn btn-primary" data-submit-value="Please wait...">Send</button>
            
                </form>
            </div>
        </div>
        <hr>
        
            <h4 class="text-center">
                The whale tour is too beautiful and fun to leave it to a booking form. Call us at 829.820.5200 or chat or email. We really want you to enjoy your tour and to appreciate the options. We do not charge more than others but you do get our exceptional personal service.
            </h4>
        
    </div>
    <div class="col-md-5">
            <div class="col-md-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">From Samana</h3>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>1 person</td>
                                        <td>U$ 360.00</td>
                                    </tr>
                                    <tr>
                                        <td>2 people</td>
                                        <td>U$ 195.00 per person</td>
                                    </tr>
                                    <tr>
                                        <td>3 people</td>
                                        <td>U$ 145.00 per person</td>
                                    </tr>
                                    <tr>
                                        <td>4 people</td>
                                        <td>U$ 115.00 per person</td>
                                    </tr>
                                    <tr>
                                        <td>5 people</td>
                                        <td>U$ 105.00 per person</td>
                                    </tr>
                                    <tr>
                                        <td>6 people</td>
                                        <td>U$ 100.00 per person</td>
                                    </tr>
                                    <tr>
                                        <td>7 people</td>
                                        <td>U$ 95.00 per person</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> {{-- end col --}}
        
                <div class="col-md-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">From Puerto Plata, Sosua or Cabarete</h3>
                        </div>
                        <div class="box-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>1 person</td>
                                            <td>U$ 650.00</td>
                                        </tr>
                                        <tr>
                                            <td>2 people</td>
                                            <td>U$ 335.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>3 people</td>
                                            <td>U$ 235.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>4 people</td>
                                            <td>U$ 185.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>5 people</td>
                                            <td>U$ 150.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>6 people</td>
                                            <td>U$ 145.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>7 people</td>
                                            <td>U$ 135.00 per person</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>{{-- end col --}}
        
                <div class="col-md-12">
                    <div class="box box-solid box-primary">
                        <div class="box-header">
                            <h3 class="box-title">From Las Terrenas, Las Galeras or anywhere else in the Samana area:</h3>
                        </div>
                        <div class="box-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>1 person</td>
                                            <td>U$ 530.00</td>
                                        </tr>
                                        <tr>
                                            <td>2 people</td>
                                            <td>U$ 275.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>3 people</td>
                                            <td>U$ 195.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>4 people</td>
                                            <td>U$ 155.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>5 people</td>
                                            <td>U$ 130.000 per person</td>
                                        </tr>
                                        <tr>
                                            <td>6 people</td>
                                            <td>U$ 125.00 per person</td>
                                        </tr>
                                        <tr>
                                            <td>7 people</td>
                                            <td>U$ 115.00 per person</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>{{-- end col --}}
                    <div class="col-md-12">
                        <div class="box box-solid box-primary">
                            <div class="box-header">
                                <h3 class="box-title">From La Romana, Casa de Campo or Bayahibe</h3>
                            </div>
                            <div class="box-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>1 person</td>
                                                <td>U$ 950.00</td>
                                            </tr>
                                            <tr>
                                                <td>2 people</td>
                                                <td>U$ 500.00 per person</td>
                                            </tr>
                                            <tr>
                                                <td>3 people</td>
                                                <td>U$ 350.00 per person</td>
                                            </tr>
                                            <tr>
                                                <td>4 people</td>
                                                <td>U$ 260.00 per person</td>
                                            </tr>
                                            <tr>
                                                <td>5 people</td>
                                                <td>U$ 220.00 per person</td>
                                            </tr>
                                            <tr>
                                                <td>6 people</td>
                                                <td>U$ 200.00 per person</td>
                                            </tr>
                                            <tr>
                                                <td>7 people</td>
                                                <td>U$ 180.00 per person</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>{{-- end col --}}
                    
                    <div class="col-md-12">
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">From Santo Domingo or Boca Chica</h3>
                                </div>
                                <div class="box-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>1 person</td>
                                                    <td>U$ 750.00</td>
                                                </tr>
                                                <tr>
                                                    <td>2 people</td>
                                                    <td>U$ 390.00 per person</td>
                                                </tr>
                                                <tr>
                                                    <td>3 people</td>
                                                    <td>U$ 275.00 per person</td>
                                                </tr>
                                                <tr>
                                                    <td>4 people</td>
                                                    <td>U$ 215.00 per person</td>
                                                </tr>
                                                <tr>
                                                    <td>5 people</td>
                                                    <td>U$ 175.00 per person</td>
                                                </tr>
                                                <tr>
                                                    <td>6 people</td>
                                                    <td>U$ 165.00 per person</td>
                                                </tr>
                                                <tr>
                                                    <td>7 people</td>
                                                    <td>U$ 150.00 per person</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>{{-- end col --}}
    </div> {{-- end col --}}
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