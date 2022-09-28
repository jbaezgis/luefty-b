@extends('layouts.app2')
@section('title', __('Complete Form'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<div class="py-5" style="background-image: url('/images/slide.png');">
    <div class="container">
        {{-- <div class="row">
            <div class="col-md-12 text-center">
                <p class="text-muted">{{__('Type')}}: <span class="text-primary">{{$auction->type == 'oneway' ? 'One way' : 'Round-Trip'}}</span> | {{__('Booking ID:')}} <span># {{$auction->service_number ? $auction->service_number : $auction->auction_id }} </span></p>
                @if($auction->type == 'roundtrip')
                    <h3 class="font-weight-light"><strong>{{ $auction->fromcity->name }}</strong> <span class="text-primary"><i class="fa fa-exchange" aria-hidden="true"></i></span> <strong>{{ $auction->tocity->name }}</strong></h3>
                @else
                    <h3 class="font-weight-light"><span class="text-muted">{{__('From')}}</span> <strong>{{ $auction->fromcity->name }}</strong> <span class="text-muted">{{__('To')}}</span> <strong>{{ $auction->tocity->name }}</strong></h3>
                @endif
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12 text-center">
    
                {!! Form::open([
                    'method' => 'PATCH',
                    'url' => ['/booking/oneway', $auction->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('One Way', array(
                            'type' => 'submit',
                            'class' => ($auction->type == 'oneway' ? 'btn btn-primary' : 'btn btn-secondary btn-sm'),
                            'title' => __('Change to One Way')
                    )) !!}
                {!! Form::close() !!}
    
                {!! Form::open([
                    'method' => 'PATCH',
                    'url' => ['/booking/roundtrip', $auction->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('Round Trip', array(
                            'type' => 'submit',
                            'class' => ($auction->type == 'roundtrip' ? 'btn btn-primary' : 'btn btn-secondary btn-sm'),
                            'title' => __('Change to Round Trip')
                    )) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <p></p> --}}
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                    <a class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                    <a class="btn btn-light text-primary">{{__('Complete Form')}}</a>
                    <a class="btn btn-light">{{__('Extras')}}</a>
                </div>
            </div>
        </div>
        <p></p> --}}
        
        {{-- Function for driving time --}}
        
        {{-- @include('bookings.top_texts') --}}
        
        <div class="row">
            <div class="col-md-4">
                @include('bookings.left_column.left_column')
                <!-- <hr>
                <div class="col-md-12 text-center d-none d-sm-none d-md-block">
                    <img src="{{asset('images/parrot/parrot_form.png')}}" height="350" alt="Parrot form">
                </div> -->
            </div>
    
            <div class="col-md-8">
                @if( session()->has('passengers_error') )
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="lead">{{ __('You selected a') }} <strong>{{$auction->vehicleType->type}}</strong> {{__('for a maximum of')}} <strong>{{$auction->vehicleType->max_passengers}}</strong> {{__('passengers')}}</p>
                        <hr>
                        <p>{{__('Select a different vehicle size or change the number of passengers')}}</p>
                        <a href="{{url('select_vehicle/'.$auction->key.'/edit')}} " class="btn btn-warning btn-sm">{{__('Vehicle List')}} </a> <br>
                        
                    </div>
                @endif
    
                {!! Form::model($auction, ['method' => 'PATCH', 'url' => ['/booking', $auction->id], 'id' => 'main_form',
                    'class' => 'form-horizontal needs-validation', 'novalidate']) !!}
    
                    {{-- Airport to Airport --}}
                    @if ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == 1)
                        @include ('bookings.forms.airport_to_airport')
                    
                    {{-- Airport to Location --}}
                    @elseif ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == NULL)
                        @include ('bookings.forms.airport_to_location')
                    
                    {{-- Location to Location --}}
                    @elseif ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == NULL)
                        @include ('bookings.forms.location_to_location')
                    
                    {{-- Location to Airport --}}
                    @elseif ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == 1)
                        @include ('bookings.forms.location_to_airport')
    
                    @endif
    
                    @include ('bookings.forms.extras')
    
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button class="btn btn-primary btn-block btn-lg font-weight-bolder" type="submit" title="{{ __('CONTINUE TO PAY')}}"><span class="">{{ __('CONTINUE TO PAY')}} </button>
                        </div> {{-- /col --}}
                    </div> {{-- /row --}}
                    
                {!! Form::close() !!}
            </div>

            <!-- <div class="col-md-12 text-center d-block d-sm-block d-md-none">
                <img src="{{asset('images/parrot/parrot_form.png')}}" height="250" alt="Parrot form">
            </div> -->
        </div>{{-- /row --}}
    
    
    </div>
</div>

@endsection

@section('scripts')
<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
</script>

<script>
    var cleave = new Cleave('#phone' ,{
        phone:true,
        phoneRegionCode: 'US'
    });
</script>

@endsection
