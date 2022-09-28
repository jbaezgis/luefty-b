@extends('layouts.app2')
@section('title', __('Select Vehicle'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<br>
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
    </div> --}}

    {{-- <div class="row">
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
                <a class="btn btn-primary">{{__('Select Vehicle')}}</a>
                <a class="btn btn-light">{{__('Complete Form')}}</a>
                <a class="btn btn-light">{{__('Extras')}}</a>
            </div>
        </div>
    </div>
    <p></p> --}}
    
    {{-- Function for driving time --}}
    
    {{-- @include('bookings.top_texts') --}}
    
    <div class="row">
        @section('passengers')
            {{ $childrend = $auction->infants + $auction->babies}}
        @endsection

        <div class="col-md-4">
            @include('bookings.left_column.left_column')
        </div>

        <div class="col-md-8">
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="bg-warning mb-2 rounded" style="padding-top: 12px; padding-bottom: 12px"> 
                        <h4 class="card-title">{{__('LUEFTY DIRECT SALES, SAVE FROM 60%')}}</h4>
                    </div>
                </div>

                {{-- <div class="col-md-4">
                    <div class="btn btn-primary btn-block">{{ __('SOT BY PRICE')}}</div>
                </div> --}}
            </div>
            {{-- <hr> --}}
            {{-- Vehicle list --}}
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
                        <div class="col-md-4">

                            {{-- <div class="row">
                                <div class="col-md-12">
                                    @if ($auction->category_id == 8)
                                        {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!}

                                            {{ Form::hidden('auction_id', $auction->id) }}
                                            {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                            {{ Form::hidden('service_price_id', $item->id) }}

                                            {!! Form::button(__('Select Vehicle'), array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                    'title' => __(' Join auction for a lower price')
                                            )) !!}
                                        {!! Form::close() !!}
                                    @elseif ($auction->category_id == NULL)
                                        {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!}

                                            {{ Form::hidden('auction_id', $auction->id) }}
                                            {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                            {{ Form::hidden('service_price_id', $item->id) }}

                                            {!! Form::button(__(' Join auction for a lower price'), array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                    'title' => __(' Join auction for a lower price')
                                            )) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                                <p class="text-center"></p>
                                
                                @if ($auction->category_id == NULL)
                                    <div class="col-md-12 py-2 text-center">
                                        <span>{{__('Or')}}</span>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    @if ($auction->category_id == 7)
                                        {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/price', $item->id], 'style' => 'display:inline']) !!}

                                            {{ Form::hidden('auction_id', $auction->id) }}
                                            {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                            {{ Form::hidden('service_price_id', $item->id) }}

                                            {!! Form::button('$' . number_format($auction->type == 'roundtrip' ? $rt_price : $price, 2, '.', ',') . ' - ' . __('Select Vehicle'), array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                    'title' => __('Buy now at current bid'),
                                                    // $auction->vehicle_type == $item->vehicle->id ? 'disabled' : '' 
                                            )) !!}
                                        {!! Form::close() !!}
                                    @elseif ($auction->category_id == NULL)
                                        {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/price', $item->id], 'style' => 'display:inline']) !!}

                                            {{ Form::hidden('auction_id', $auction->id) }}
                                            {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                            {{ Form::hidden('service_price_id', $item->id) }}

                                            {!! Form::button('$' . number_format($auction->type == 'roundtrip' ? $rt_price : $price, 2, '.', ',') . ' - ' . __('Buy now'), array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                    'title' => __('Buy now at current bid')
                                            )) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            </div> --}}
                        </div>
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
                        
                        {{-- @if ($auction->category_id == NULL)
                            <div class="col-md-1 py-2 text-center">
                                <h5>{{__('Or')}}</h5>
                            </div>
                        @endif --}}

                        {{-- <div class="col-md-5">
                            @if ($auction->category_id == 7)
                                {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/price', $item->id], 'style' => 'display:inline']) !!}

                                    {{ Form::hidden('auction_id', $auction->id) }}
                                    {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                    {{ Form::hidden('service_price_id', $item->id) }}

                                    {!! Form::button('$' . number_format($auction->type == 'roundtrip' ? $rt_price : $price, 2, '.', ',') . ' - ' . __('Select Vehicle'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-block font-weight-bolder',
                                            'title' => __('Book now at current bid'),
                                            // $auction->vehicle_type == $item->vehicle->id ? 'disabled' : '' 
                                    )) !!}
                                {!! Form::close() !!}
                            @elseif ($auction->category_id == NULL)
                                {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/price', $item->id], 'style' => 'display:inline']) !!}

                                    {{ Form::hidden('auction_id', $auction->id) }}
                                    {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                    {{ Form::hidden('service_price_id', $item->id) }}

                                    {!! Form::button('$' . number_format($auction->type == 'roundtrip' ? $rt_price : $price, 2, '.', ',') . ' - ' . __('Book Now'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-block font-weight-bolder',
                                            'title' => __('Book now at current bid')
                                    )) !!}
                                {!! Form::close() !!}
                            @endif
                        </div> --}}
                    </div>
                </div>{{-- car option box --}}

                @endforeach
                {{-- <hr>

                <div class="row text-center">
                    <div class="col-md-12">
                        <h5>{{__('Create an auction and get the best prices on the market')}} </h5>
                    </div>
                    <div class="col-md-12">
                        {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!}

                            {{ Form::hidden('auction_id', $auction->id) }}


                            {!! Form::button(__('Join to Auction'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary',
                                    'title' => __('Join to Auction')
                            )) !!}
                        {!! Form::close() !!}


                    </div>
                </div> --}}
            @else
                <h3>{{__('Service not found. Please select other locations.')}}</h3>
            @endif
        </div>
    </div>{{-- /row --}}
    



    {{-- <div class="row">
        <div class="col-md-12">
            <!-- Form locations -->
            {!! Form::model($auction, ['method' => 'PATCH', 'url' => ['/fromto', $auction->id], 'id' => 'locations_form',
                'class' => 'form-horizontal needs-validation','novalidate']) !!}
                @include ('bookings.forms.locations')
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div> --}}


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

@endsection
