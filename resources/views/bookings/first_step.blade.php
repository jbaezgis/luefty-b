@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    {{-- Function for driving time --}}
    
    @include('bookings.top_texts')
    
    <div class="row">
        @section('passengers')
            {{ $childrend = $auction->infants + $auction->babies}}
        @endsection

        <div class="col-md-4">
            {{-- PC Version --}}
            <div class="card d-none d-sm-block border-primary">
                <div class="card-header bg-primary pb-2">
                    <h4 class="card-title">{{__('Booking Details')}} </h4>
                </div>
                <div class="card-body">
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
                    <hr>
                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-plane fa-3x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <span class="text-info">{{__('Arrival airport')}}</span><br>
                                    <strong>{{$auction->fromcity->name}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-map-marker fa-3x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <span class="text-info">{{__('Going to')}}</span><br>
                                    <strong>{{$auction->tocity->name}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-map-marker fa-3x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <span class="text-info">{{__('Flight arrival')}}</span><br>
                                    <strong>{{$auction->date}}</strong>
                                </div>
                                <div class="p-2 bd-highlight">
                                    @if($auction->arrival_time)
                                        <span class="text-info">{{__('Time')}}</span><br>
                                        <strong>{{$auction->arrival_time}}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-users fa-2x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    @section('passengers')
                                        {{ $childrend = $auction->infants + $auction->babies}}
                                    @endsection
                                    <span class="text-info">{{__('Passengers')}}</span><br>
                                    <strong>{{$auction->adults}}
                                        @if ($auction->adults == 1)
                                            {{__('Adult')}}
                                        @else
                                            {{__('Adults')}}
                                        @endif
                                        @if ($auction->infants or $auction->babies)
                                            , {{ $childrend }} 
                                            @if ($childrend == 1)
                                                {{__('Child')}}
                                            @else
                                                {{__('Children')}}
                                            @endif
                                        @endif

                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            {{-- End PC version --}}

            {{-- Mobile version --}}
            <div class="d-block d-sm-none mb-3">
                <p>
                    <a class="btn btn-primary btn-lg btn-block" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        {{__('Booking Details')}}
                    </a>
                </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-plane fa-3x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <small class="text-muted">{{__('Arrival airport')}}</small><br>
                                    <strong>{{$auction->fromcity->name}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-map-marker fa-3x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <small class="text-muted">{{__('Going to')}}</small><br>
                                    <strong>{{$auction->tocity->name}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-map-marker fa-3x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <small class="text-muted">{{__('Flight arrival')}}</small><br>
                                    <strong>{{$auction->date}}</strong>
                                </div>
                                <div class="p-2 bd-highlight">
                                    @if($auction->arrival_time)
                                        <small class="text-muted">{{__('Time')}}</small><br>
                                        <strong>{{$auction->arrival_time}}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-users fa-2x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <small class="text-muted">{{__('Passengers')}}</small><br>
                                    <strong>{{$auction->adults}}
                                        @if ($auction->adults == 1)
                                            {{__('Adult')}}
                                        @else
                                            {{__('Adults')}}
                                        @endif
                                        @if ($auction->infants or $auction->babies)
                                            , {{ $childrend }} 
                                            @if ($childrend == 1)
                                                {{__('Child')}}
                                            @else
                                                {{__('Children')}}
                                            @endif
                                        @endif

                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            {{-- End mobile version --}}
        </div>

        <div class="col-md-8">
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="bg-primary mb-2 rounded" style="padding-top: 12px; padding-bottom: 12px"> 
                        <h4 class="card-title">{{__('VEHICLE CHOICES')}}</h4>
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
                <div class="shadow border border-primary mb-3 p-3 rounded">
                    <div class="row">
                        <div class="col-md-3">
                            @if ( $item->vehicle->type == 'Sedan')
                                <img class="img-fluid" src="{{ asset('images/vehicles/Sedan.jpeg') }}" alt="Vehicle">
                            @elseif ($item->vehicle->type == 'Minivan')
                                <img class="img-fluid" src="{{ asset('images/vehicles/Minivan.jpeg') }}" alt="Vehicle2">
                            @elseif ($item->vehicle->type == 'Minibus')
                                <img class="img-fluid" src="{{ asset('images/vehicles/Minibus.jpeg') }}" alt="Vehicle3">
                            @elseif ($item->vehicle->type == 'Large Van')
                                <img class="img-fluid" src="{{ asset('images/vehicles/LargeVan.jpeg') }}" alt="Vehicle4">
                            @endif
                        </div>
                        <div class="col-md-9">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="card-title">{{ $item->vehicle->type }}</h4>
                                            <p class="card-text">
                                                <span><i class="fa fa-users text-primary" aria-hidden="true"></i> {{ $item->priceOption->name }}</span> |
                                                <span>
                                                    <i class="fa fa-car text-primary" aria-hidden="true"></i> 
                                                    <strong>{{__('Driving time:')}}</strong> 
                                                    @if ($item->service->driving_time > 60)
                                                        {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                                    @else
                                                        {{date('i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                                    @endif
                                                </span>
                                                <br>
                                                {{-- <span><i class="fa fa-clock-o text-primary" aria-hidden="true"></i> </span> | --}}
                                                <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i> {{__('FREE Cancellation')}}</span>
                                                {{-- <br>

                                                {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!}
                                                    
                                                    {{ Form::hidden('auction_id', $auction->id) }}
                                                    {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                                    {{ Form::hidden('service_price_id', $item->id) }}

                                                    
                                                    {!! Form::button(__(' Join auction for a lower price'), array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-warning btn-block',
                                                            'title' => __(' Join auction for a lower price')
                                                    )) !!}
                                                {!! Form::close() !!} --}}
                                            </p>
                                        </div>
                                        @section('price')
                                            {{ $percentaje = $item->oneway_price * 0.50}}
                                            {{ $price = $item->oneway_price + $percentaje }}
                                            {{ $rt_price = $price * 2 }}
                                        @endsection
                                        {{-- <div class="col-md-5 text-center">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="">${{ number_format($price, 2, '.', ',') }}</h3>
                                                    {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/price', $item->id], 'style' => 'display:inline']) !!}

                                                        {{ Form::hidden('auction_id', $auction->id) }}


                                                        {!! Form::button(__('Buy now at current bid'), array(
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-warning btn-block',
                                                                'title' => __('Buy now at current bid')
                                                        )) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>

                                        </div> --}}
                                    </div>

                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="car-box-footer p-2 bg-light">
                            <div class="row">
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-2 pt-2 text-center d-none d-sm-block">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    <span>{{__('Or')}} </span>
                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-2 pt-2  text-center d-block d-sm-none">
                                    <i class="fa fa-arrow-up" aria-hidden="true"></i> <br>
                                    <span>{{__('Or')}} </span> <br>
                                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                </div>

                                <div class="col-md-4">
                                    
                                    {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/price', $item->id], 'style' => 'display:inline']) !!}

                                        {{ Form::hidden('auction_id', $auction->id) }}

                                        {!! Form::button('$' . number_format($auction->type == 'roundtrip' ? $rt_price : $price, 2, '.', ',') . ' - ' . __('Buy now'), array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                'title' => __('Buy now at current bid')
                                        )) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>

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
