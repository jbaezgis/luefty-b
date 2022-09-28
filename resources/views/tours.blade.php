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
{{-- <div class="position-relative overflow-hidden p-md-5 bg-light slider">
    <div class="row">
        <div class="col-md-12 p-5">
            <div class="row">
                <div class="col-md-12 text-center text-white custom-text-shaddow">
                    <h1 class="" >{{ __('WORLD\'S FIRST FAIR TRADE TOURISM AUCTIONS') }} </h1>
                    <p></p>
                    <h3 class="">{{ __('BIDS CAN BE 60% LESS BECAUSE OF EMPTY LEGS, EMPTY SEATS AND IDLE TIME') }} </h3>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<p></p>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <small><a href="{{url('/')}}">{{__('Home')}}</a> / {{$country->en_name}} /</span> <span class="text-muted">{{__('Tours')}} </span></small> 
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <h1>{{$country->en_name}}
                <small>
                    @if (request()->is('country/'.$country->slug.'/transfers'))
                        {{_('Transfers')}} 
                    @elseif (request()->is('country/'.$country->slug.'/tours'))
                        {{_('Tours')}} 
                    @elseif (request()->is('country/'.$country->slug.'/flights'))
                        {{_('Flights')}} 
                    @endif
                </small>
            </h1>
        </div>
    
    </div>
    <br>    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="btn-group btn-block">
                <a href="{{url('country/'.$country->slug.'/transfers')}}" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/transfers') ? 'btn-warning' : 'btn-light'}}" aria-current="page">{{_('Transfers')}}</a>
                <a href="{{url('country/'.$country->slug.'/tours')}}" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/tours') ? 'btn-warning' : 'btn-light'}}" aria-current="page">{{_('Tours')}}</a>
                <a href="{{url('country/'.$country->slug.'/flighs')}}" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/flighs') ? 'btn-warning' : 'btn-light'}}" aria-current="page">{{_('Flight')}}</a>
            </div>
        </div>
    </div>
</div>
<p></p>
{{-- Search form --}}
<div class="bg-info-light py-4">
    <div class="container">

        {!! Form::open(['method' => 'GET', 'url' => 'country/'.$country->slug.'/tours', 'class' => '', 'role' => 'search'])  !!}
            {{-- @lang('globals.filters'): --}}
            <div class="row justify-content-center">
                <div class="col-md-6">
                    
                        <select class="form-control select2" id="from" name="from" required>
                            <option value="" disabled selected>{{__('Location')}}</option>
                            @foreach ($tours_locations as $item)
                                <option value="{{$item->id}}" data-description="">{{$item->location->name}}</option>
                            @endforeach
                        </select>
                        <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from') }}</small>
                    
                </div>
                
                <div class="col-md-2">
                    <button class="btn btn-warning btn-block font-weight-bolder" type="submit" title="{{ __('Search')}}">{{ __('Search')}} <i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<p></p>

<div class="container">

    {{-- Country Attractions --}}
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2>{{__('Top attractions in')}} {{$country->en_name}}</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
            <div class="p2">
                <a href="{{url('country/'.$country->slug.'/'. $last_attraction->slug.'/attraction')}}">
                    <img src="{{URL::asset('storage/images/attractions/'. $last_attraction->image)}}" class="rounded-lg img-fluid" alt="{{$last_attraction->image}}">
                </a>
                <div class="py-1 ">
                    <div class="text-truncate">
                        <span class="">{{$last_attraction->title}}</span>
                    </div>
                    <small class="text-muted">{{$last_attraction->tours->count()}} {{__('Tours and Activity')}}</small><br>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                @foreach($attractions as $item)
                    <div class="col-md-4 mb-3">
                        <div class="">
                            <a href="{{url('country/'.$country->slug.'/'. $item->slug.'/attraction')}}">
                                <img src="{{URL::asset('storage/images/attractions/'. $item->image)}}" class="rounded img-fluid" alt="{{$item->image}}">
                            </a>
                            <div class="card-body pl-2 py-1 ">
                                <div class="text-truncate">
                                    <span class="">{{$item->title}}</span>
                                </div>
                                <small class="text-muted">{{$item->tours->count()}} {{__('Tours and Activity')}}</small><br>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Country Tours --}}
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2>{{__('Top tours in')}} {{$country->en_name}}</h2>
            {{-- <span class="text-muted">{{__('World\'s best tourist destinations')}}</span> --}}
        </div>
    </div>

    <div class="row">
        @foreach($tours as $item)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="tour-image">
                        <div class="tour-price p-2 bg-primary"><small>{{__('from')}}</small> <span>${{ number_format($item->adults_price, 2, '.', ',') }}</span></div>
                        <div class="tour-image">
                            <a href="{{url('country/'.$country->slug.'/'. $item->slug.'/tour')}}">
                                <img src="{{URL::asset('storage/images/tours/thumbs/'. $item->image)}}" class="card-img-top" alt="{{$item->image}}">
                            </a>
                        </div>
                        <small class="text-muted pt-2 pl-2"><i class="fa fa-globe" aria-hidden="true"></i> {{ $item->attraction->title }}, {{ $item->location->country->en_name }}</small>
                    </div>

                    <div class="card-body pl-2 py-1 ">
                        <strong class="text-truncate">
                            <span class="">{{$item->title}}</span>
                        </strong>
                        <br>
                        <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{$item->duration}} </span> <br>
                        {{-- <span>{{__('Departure')}}: {{$item->depLocation->name}}</span>, {{$item->departure_time}} <br> --}}
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
					url: APP_URL+'/servicesto/' + from,
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
