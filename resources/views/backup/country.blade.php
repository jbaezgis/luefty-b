@extends('layouts.app2')
@section('title', $country->en_name)
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<?php function active($url){
    return request()->is($url) ? 'active' : '';
  }?>

@if( session()->has('error') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="py-5 country-image " style="background-image: url('/images/home/{{$country->code}}/{{$country->slug}}.png');">
    <div class="container"> 
        <div class="">
            <div class="row mb-5">
                <div class="col-md-12">
                    <small class="text-white"><a href="{{url('/')}}">{{__('Home')}}</a> / {{$country->en_name}} /</span> <span class="">{{__('Transfers')}} </span></small> 
                </div>
            </div>
            {{-- <hr> --}}
        
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="display-4 text-center text-white custom-text-shaddow-2">{{ $country->en_name }}</h1>
                </div>
                <br>
                <div class="col-md-8">
                    <div class="btn-group btn-block">
                        <a href="{{url('country/'.$country->slug.'/transfers')}}" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/transfers') ? 'btn-warning' : 'btn-light'}}" aria-current="page">{{_('Transfers')}}</a>
                        @if ($request->location == 'Dominican Republic')
                            <a href="https://tours.luefty.com/destination/{{$country->slug}}" target="_blank" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/tours') ? 'btn-primary' : 'btn-light'}}" aria-current="page">{{_('Tours')}}</a>
                        @else
                            <a href="https://tours.luefty.com/destination/{{$country->slug}}" target="_blank" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/tours') ? 'btn-primary' : 'btn-light'}}" aria-current="page">{{_('Tours')}}</a>
                        @endif
                        {{-- <a href="#" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/flights') ? 'btn-primary' : 'btn-light'}}" aria-current="page">{{_('Charter Flights')}}</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search form --}}
<div class="bg-warning py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center py-2">
                <h4 class="" >{{__('Our auctions give you from 60% lower prices for the same top suppliers as the largest agencies')}}</h4>
            </div>
        </div>
        {!! Form::open(['method' => 'POST', 'url' => '/booking/store', 'class' => '', 'role' => 'search'])  !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control select2" id="from" name="from" required>
                            <option value="" disabled selected class="font-weight-bolder">{{__('Pick up Location')}}</option>
                            @foreach ($services_from_airports as $item)
                                <option value="{{$item->id}}" data-description="">{{$item->fromLocation->name}}</option>
                            @endforeach
                            @foreach ($services_from as $item)
                                <option value="{{$item->id}}" data-description="">{{$item->fromLocation->name}}</option>
                            @endforeach
                        </select>
                        <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from') }}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        
                        <select class="form-control select2" id="to" name="to" disabled required>
                            <option value="" disabled selected>{{__('Drop off Location')}}</option>
                        </select>
                        <small id="toErrors" class="form-text text-danger">{{ $errors->first('to') }}</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control datepicker2" id="date" name="date" aria-describedby="dateErrors" placeholder="{{ __('Pick up date')}}" required>
                        <small id="dateError" class="form-text text-danger">{{ $errors->first('date') }} </small>
                        <div class="invalid-feedback">
                            {{ __('Arrival Date is required') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control datepicker2" id="return_date" name="return_date" aria-describedby="dateErrors" placeholder="{{ __('Add return')}}">
                        <small id="dateError" class="form-text text-danger">{{ $errors->first('return_date') }} </small>
                        <div class="invalid-feedback">
                            {{ __('Departure Date is required') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" id="passengers" name="passengers" value="{{ old('passengers') }}">
                            <option value="1">1 {{__('Passenger')}}</option>
                            <option value="2">2 {{__('Passengers')}}</option>
                            <option value="3">3 {{__('Passengers')}}</option>
                            <option value="4">4 {{__('Passengers')}}</option>
                            <option value="5">5 {{__('Passengers')}}</option>
                            <option value="6">6 {{__('Passengers')}}</option>
                            <option value="7">7 {{__('Passengers')}}</option>
                            <option value="8">8 {{__('Passengers')}}</option>
                            <option value="9">9 {{__('Passengers')}}</option>
                            <option value="10">10 {{__('Passengers')}}</option>
                        </select>
    
                    </div>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-block font-weight-bolder" type="submit" title="{{ __('Search')}}">{{ __('Start Auction')}}</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<p></p>


<div class="container">

    {{-- Results --}}

    @if ($service)
            {{-- @include ('bookings.service_list') --}}
                @foreach ($services_prices as $item)
                <div class="shadow-sm border border-secondary mb-3 p-3 rounded">
                    <div class="row">
                        <div class="col-md-2">
                            @if ( $item->vehicle->type == 'Sedan')
                                <img class="img-fluid" src="{{ asset('images/vehicles/Sedan.jpeg') }}" alt="Vehicle">
                            @elseif ($item->vehicle->type == 'Minivan')
                                <img class="img-fluid" src="{{ asset('images/vehicles/Minivan.jpeg') }}" alt="Vehicle2">
                            @elseif ($item->vehicle->type == 'Minibus')
                                <img class="img-fluid" src="{{ asset('images/vehicles/Minibus.jpeg') }}" alt="Vehicle3">
                            @elseif ($item->vehicle->type == 'Small Bus')
                                <img class="img-fluid" src="{{ asset('images/vehicles/LargeVan.jpeg') }}" alt="Vehicle4">
                            @endif
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex flex-row mb-3">
                                        <div class="p-2 bd-highlight border-right">
                                            <small class="text-muted">{{__('Vehicle type')}}</small><br>
                                            <span>{{ $item->vehicle->type }}</span>
                                        </div>
                                        <div class="p-2 bd-highlight border-right">
                                            <small class="text-muted">{{__('Max passengers')}}</small><br>
                                            <span>{{ $item->vehicle->max_passengers }}</span>
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <small class="text-muted">{{__('Driving time')}}</small><br>
                                            <span>
                                                @if ($item->service->driving_time > 60)
                                                    {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                                @else
                                                    {{date('i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                                @endif    
                                            </span>
                                        </div>
                                        <div class="p-2 bd-highlight ">
                                        </div>
                                        
                                    </div>
                                    <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i> {{__('Free Cancelation up to 24 hours before pick up time.')}}</span>
                                </div>
                            </div>
                        </div>
                        
                        @section('price')
                            {{ $percentaje = $item->oneway_price * 0.10}}
                            {{ $price = $item->oneway_price + $percentaje }}
                            {{ $rt_price = $price * 2 }}
                        @endsection
                    </div>
                    <div class="border-top">

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center pt-2">
                            <h5 class="text-primary">{{__('BOOK NOW TO SEE FIRST BID(S), 60% PRICE DROPS ARE NOT UNUSUAL')}} </h5>
                        </div>
                    </div>
                    <div class="row justify-content-center pt-2">
                        <div class="col-md-6">
                            @if ($auction->category_id == 8)
                                {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!}

                                    {{ Form::hidden('auction_id', $auction->id) }}
                                    {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                    {{ Form::hidden('service_price_id', $item->id) }}

                                    {!! Form::button(__('SEE AUCTION OFFERS'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-block font-weight-bolder',
                                            'title' => __('SEE AUCTION OFFERS')
                                    )) !!}
                                {!! Form::close() !!}
                            @elseif ($auction->category_id == NULL)
                                
                                {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!}

                                    {{ Form::hidden('auction_id', $auction->id) }}
                                    {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                    {{ Form::hidden('service_price_id', $item->id) }}

                                    {!! Form::button(__('SEE AUCTION OFFERS'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-block font-weight-bolder',
                                            'title' => __('SEE AUCTION OFFERS')
                                    )) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                        <p class="text-center"></p>
                    </div>
                </div>{{-- car option box --}}
            @endforeach
            {{-- end options results --}}

    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2>{{__('MOST POPULAR TRANSFER OFFERS')}}</h2>
            <div class="divider my-3"></div>
            {{-- <span class="text-muted">{{__('World\'s best tourist destinations')}}</span> --}}
        </div>
    </div>

    <div class="row">
        @foreach ($services_by_country as $item)
            <div class="col-md-4">
                <div class="border rounded mb-4">
                    <img class="img-fluid" src="{{ asset('storage/images/locations/'.$item->toLocation->image) }}"alt="Vehicle"> <br>
                    <small class="text-muted pl-2"><i class="fa fa-globe" aria-hidden="true"></i> {{ $item->toLocation->name }}, {{ $item->toLocation->country->en_name }}</small>
                    <div class="body p-2 ">
                        <h5>
                            <span class="text-muted">{{__('From')}}</span> <span>{{ $item->fromLocation->name }}</span> <span class="text-muted">{{__('To')}}</span> <span>{{ $item->toLocation->name }}</span>
                        </h5>
                        {{-- <p></p> --}}
                        <div class="mb-2">
                            <span>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                @if ($item->driving_time > 60)
                                    {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$item->driving_time))}}
                                @else
                                    {{date('i'.' \m\i\n\s', mktime(0,$item->driving_time))}}
                                @endif    
                            </span>
                        </div>
    
                        {{-- <div class="btn-group btn-group-toggle btn-block mb-2" data-toggle="buttons">
                            <label class="btn btn-light">
                                <input type="radio" name="options" id="option1"> 
                                <img class="img-fluid" src="{{ asset('images/vehicles/Sedan.jpeg') }}" width="80" alt="Vehicle"> <br>
                                Max 3 passengers
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="options" id="option2"> 
                                <img class="img-fluid" src="{{ asset('images/vehicles/Minivan.jpeg') }}" width="80" alt="Vehicle2"> <br>
                                Max 7 passengers
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="options" id="option3"> 
                                <img class="img-fluid" src="{{ asset('images/vehicles/Minibus.jpeg') }}" width="80" alt="Vehicle3"> <br>
                                Max 14 passengers
                            </label>
                        </div> --}}

                        {{-- @section('starting_bid')
                            {{ $starting_bid = $services_prices->where('service_id', $item->s_id)->min('oneway_price')}}
                        @endsection
                        <div class="mb-2">
                            <span>starting bid</span>
                            <span class="starting-bid">${{ number_format($starting_bid, 2, '.', ',') }}</span>
                        </div> --}}
                        {{-- <br> --}}
    
                        {{-- <div class="text-center">
                            <a href="#" class="btn btn-primary">{{__('One Way')}}</a>
                            <a href="#" class="btn btn-primary">{{__('Round Trip')}}</a>
                        </div> --}}
                        {!! Form::open(['method' => 'POST', 'url' => '/booking/transfer', 'class' => '', 'role' => 'search'])  !!}
                        
                            {{ Form::hidden('service_id', $item->s_id) }}
                            {{ Form::hidden('from', $item->fromLocation->id) }}
                            {{ Form::hidden('to', $item->toLocation->id) }}
                            {{-- {{ Form::hidden('service_price_id', $item->id) }} --}}
                            
                            <div class="d-flex">
                                <div class="pt-1"><span class="">{{ __('Select passengers') }}:</span></div>
                                <div class="pl-1">
                                    <select class="form-control" id="passengers" name="passengers" value="{{ old('passengers') }}">
                                        <option value="1">1 {{__('Passenger')}}</option>
                                        <option value="2">2 {{__('Passengers')}}</option>
                                        <option value="3">3 {{__('Passengers')}}</option>
                                        <option value="4">4 {{__('Passengers')}}</option>
                                        <option value="5">5 {{__('Passengers')}}</option>
                                        <option value="6">6 {{__('Passengers')}}</option>
                                        <option value="7">7 {{__('Passengers')}}</option>
                                        <option value="8">8 {{__('Passengers')}}</option>
                                        <option value="9">9 {{__('Passengers')}}</option>
                                        <option value="10">10 {{__('Passengers')}}</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="text-center">
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-warning">
                                        <input type="checkbox" name="type" value="oneway" onchange="this.form.submit()"> {{ __('One-Way' ) }}
                                    </label>
                                    <label class="btn btn-warning">
                                        <input type="checkbox" name="type" value="roundtrip" onchange="this.form.submit()"> {{ __('Round-Trip') }}
                                    </label>
                                </div>
                            </div>
                            
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>

@endsection

@section('scripts')
<script>
    //  $('.input-number').inputSpinner()
    // $("input[type='number']").inputSpinner()

    $("#from").change(function() {
        $('#button').removeClass("desabled");
    });
</script>

<script>
    function fromValue(){
        $('select[name="from"]').on('change', function(){
            var inputVal = document.getElementById("from").value;
        });
    }
</script>

<script>
    function undisable_to() {
        var to = document.getElementById("to");
        to.removeAttr("disabled");
    }

    function undisable() {
        var oneway_btn = document.getElementById("oneway-btn");
        var roundtrip_btn = document.getElementById("roundtrip-btn");

        oneway_btn.classList.remove("disabled");
        roundtrip_btn.classList.remove("disabled");

        document.getElementById("oneway").disabled = false;
        document.getElementById("roundtrip").disabled = false;
    }

	// $(document).ready(function(){
    //     var oneway = document.getElementById("oneway").disabled = true;
    //     var roundtrip = document.getElementById("roundtrip").disabled = true;

	// 	$('select[name="to"]').on('change', function(){
    //         var oneway = document.getElementById("oneway").disabled = false;
    //         var roundtrip = document.getElementById("roundtrip").disabled = false;
	// 	});
	// });
</script>
<script>
	$(document).ready(function(){

		$('select[name="from"]').on('change', function(){
            
            // $( "#to" ).prop( "disabled", false );
            //To enable 
            $('#to').removeAttr('disabled');

			var from = $(this).val();
            var APP_URL = $('meta[name="_base_url"]').attr('content');

			if(from){
				console.log(from);
				$.ajax({
					url: APP_URL+'/servicestoairports/' + from,
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// console.log(data);
						$('#to').empty();
						$('#to').append('<option value="" disable="true" selected="true">Drop off Location</option>');

						$.each(data, function(index, toObj){
							$('#to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
							// $('#tail-select-to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
                            // newAddItem.push({ key: toObj.id, value: toObj.name, description: "" })
						})
					}
				});

                $.ajax({
					url: APP_URL+'/servicesto/' + from,
					type: 'GET',
					dataType: 'json',
					success: function(data){
                        // $('#to').append('<option value="" disable="true" selected="true">Drop off Location</option>');
						$.each(data, function(index, toObj){
							$('#to').append('<option value="'+ toObj.id +'">' + toObj.name +'</option>');
							// $('#tail-select-to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
                            // newAddItem.push({ key: toObj.id, value: toObj.name, description: "" })
						})
					}
				});
			}
		});

	});
</script>

<script>
    // $(document).ready(function(){
    //     $('select[name="from"]').on('change', function(){
    //         let id = $(this).val();
    //         $('select[name="to"]').empty();
    //         $('select[name="to"]').append(`<option value="0" disabled selected>Processing...</option>`);
    //         $.ajax({
    //         type: 'GET',
    //         url: 'servicesto/' + id,
    //         success: function (response) {
    //         var response = JSON.parse(response);
    //         console.log(response);   
    //         $('select[name="to"]').empty();
    //         $('select[name="to"]').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
    //         response.forEach(toObj => {
    //             $('select[name="to"]').append(`<option value="${toObj['id']}">${toObj['name']}</option>`);
    //             });
    //         }
    //         });
    //     });
    // });
</script>

@endsection
