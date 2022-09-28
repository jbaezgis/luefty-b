
<div class="d-flex flex-row">
    <div class="pr-4">
        <h5 class="text-primary">{{__('Type')}} </h5>
        {{-- <small class="text-muted">{{__('Type')}}</small><br> --}}
        <span>{{$auction->type == 'oneway' ? 'One way' : 'Round-Trip'}}</span>
    </div>
    <div class="">
        @if($auction->arrival_time)
            <h5 class="text-primary">{{__('Booking ID')}} </h5>
            {{-- <small class="text-muted">{{__('Booking ID')}}</small><br> --}}
            <span># {{$auction->service_number ? $auction->service_number : $auction->auction_id }}</span>
        @endif
    </div>
</div>
<p></p>

@if($auction->full_name)
<div class="d-flex flex-row">
    <div class="pr-4">
        <h5 class="text-primary">{{__('Name')}}</h5>
        <span>{{$auction->full_name}}</span>
    </div>
    <div class="pr-4">
        <h5 class="text-primary">{{__('Phone')}}</h5>
        <span>{{$auction->phone}}</span>
    </div>
</div>
<p></p>
<div class="d-flex flex-row">
    <div class="">
        <h5 class="text-primary">{{__('Email')}}</h5>
        <span>{{$auction->email}}</span>
    </div>
</div>
<p></p>
@endif

@if($auction->type == 'roundtrip')
    {{-- Going --}}
    <div class="border-top p-1"></div>
    <h5 class="text-primary">{{__('Going')}} </h5>
    <h5 class="text-primary">{{__('From')}}</h5>
    <span>{{$auction->fromcity->name}}</span>
    <p></p>
    <h5 class="text-primary">{{__('To')}}</h5>
    <span>{{$auction->tocity->name}}</span>
    <p></p>

    @if($auction->full_name)
        <div class="d-flex flex-row">
            <div class="pr-3">
                <h5 class="text-primary">{{__('Arrival Date')}}</h5>
                <span>{{ $auction->date }}</span>
            </div>
            <div class="">
                @if($auction->arrival_time)
                    <h5 class="text-primary">{{__('Time')}}</h5>
                    <span>{{ date('g:i A', strtotime($auction->arrival_time)) }}</span>
                @endif
            </div>
        </div>
        <p></p>
        
        <div class="d-flex flex-row">
            <div class="pr-3">
                <h5 class="text-primary">{{__('Arrival Airline')}}</h5>
                <span>{{$auction->arrival_airline}}</span>
            </div>
            <div class="">
                @if($auction->arrival_time)
                    <h5 class="text-primary">{{__('Flight Number')}}</h5>
                    <span>{{ $auction->flight_number }}</span>
                @endif
            </div>
        </div>
        <p></p>

        <h5 class="text-primary">{{__('Drop-off details and other information')}}</h5>
        <span>{{$auction->more_information}}</span>
        <p></p>
    @endif
    {{-- End going --}}

    {{-- Return --}}
    <div class="border-top p-1"></div>
    <h5 class="text-primary">{{__('Return')}} </h5>
    <h5 class="text-primary">{{__('From')}}</h5>
    <span>{{$auction->tocity->name}}</span>
    <p></p>
    <h5 class="text-primary">{{__('To')}}</h5>
    <span>{{$auction->fromcity->name}}</span>
    <p></p>
    
    @if($auction->full_name)
        <div class="d-flex flex-row">
            <div class="pr-3">
                <h5 class="text-primary">{{__('Departure Date')}}</h5>
                <span>{{$auction->return_date}}</span>
            </div>
            <div class="">
                @if($auction->arrival_time)
                    <h5 class="text-primary">{{__('Time')}}</h5>
                    <span>{{ date('g:i A', strtotime($auction->return_time)) }}</span>
                @endif
            </div>
        </div>
        <p></p>
        <div class="d-flex flex-row">
            <div class="">
                <span class="">{{__('Pickup Time')}} <small class="text-danger">(<i class="fa fa-info-circle" aria-hidden="true"></i> {{__('Important')}} )</small></span><br>
                <strong class="text-danger">{{ date('g:i A', strtotime($auction->pickup_time)) }}</strong><br>
                {{-- <small class="text-danger">{{__('Text for Pickup time.')}} </small> --}}
            </div>
        </div>

        <p></p>
        
        <div class="d-flex flex-row">
            <div class="pr-3">
                <h5 class="text-primary">{{__('Departure Airline')}}</h5>
                <span>{{$auction->return_airline}}</span>
            </div>
            <div class="">
                @if($auction->arrival_time)
                    <h5 class="text-primary">{{__('Flight Number')}}</h5>
                    <span>{{ $auction->return_flight_number }}</span>
                @endif
            </div>
        </div>
        <p></p>

        <h5 class="text-primary">{{__('More information')}}</h5>
        <span>{{$auction->return_more_information}}</span>
        <p></p>
    @endif
@else
    <h5 class="text-primary">{{__('From')}}</h5>
    <span>{{$auction->fromcity->name}}</span>
    <p></p>
    <h5 class="text-primary">{{__('To')}}</h5>
    <span>{{$auction->tocity->name}}</span>
    <p></p>

    @if($auction->full_name)
        <div class="d-flex flex-row">
            <div class="pr-3">
                <h5 class="text-primary">{{__('Flight arrival')}}</h5>
                <span>{{$auction->date}}</span>
            </div>
            <div class="">
                @if($auction->arrival_time)
                    <h5 class="text-primary">{{__('Time')}}</h5>
                    <span>{{ date('g:i A', strtotime($auction->arrival_time)) }}</span>
                @endif
            </div>
        </div>
        <p></p>
        
        <div class="d-flex flex-row">
            <div class="pr-3">
                <h5 class="text-primary">{{__('Arrival Airline')}}</h5>
                <span>{{$auction->arrival_airline}}</span>
            </div>
            <div class="">
                @if($auction->arrival_time)
                    <h5 class="text-primary">{{__('Flight Number')}}</h5>
                    <span>{{ $auction->flight_number }}</span>
                @endif
            </div>
        </div>
        <p></p>

        {{-- More info --}}
        <h5 class="text-primary">{{__('Drop-off details and other information')}}</h5>
        <span>{{$auction->more_information}}</span>
    @endif
@endif

{{-- Passengers --}}
@if ($auction->passengers)
    <hr>
    <h5 class="text-primary">{{__('Passengers')}} </h5>
    <div class="d-flex flex-row">
        <div class="">
            {{-- @section('passengers')
                {{ $childrend = $auction->infants + $auction->babies}}
            @endsection
            <small class="text-primary">{{__('Passengers')}}</small><br>
            <span>{{$auction->adults}}
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

            </span> --}}

            <span><strong>{{$auction->passengers}}</strong> {{__('Passengers')}}</span>
        </div>
    </div>
@endif

@if (request()->is('booking/confirmation*'))

@else
    
    @if ($extras->count() > 0)
    <hr>
        <h5 class="text-primary">{{__('Extras')}} </h5>
        @foreach ($extras as $extra)
            {{ $extra->quantity }} - <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }}
            {!! Form::open(['method' => 'DELETE', 'url' => ['/extras', $extra->id], 'style' => 'display:inline']) !!}
                
                {!! Form::button('<i class="fa fa-times text-danger" aria-hidden="true"></i>', array(
                        'type' => 'submit',
                        'class' => 'btn',
                        'title' => __('Delete extra'),
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top'
                )) !!}
            {!! Form::close() !!}
            <br>
        @endforeach
    @endif
    {{-- Vehicle details --}}
    @if ($auction->service_price_id)
        <hr>
        <h5 class="text-primary">{{__('Vehicle')}} </h5>
        <div class="d-flex flex-row">
            <div class="flex-fill pr-3">
                <h5 class="text-primary">{{$auction->servicePrice->vehicle->type}}</h5>
                <span>Max <strong>{{$auction->servicePrice->vehicle->max_passengers}}</strong> {{__('passengers')}} </span>
            </div>
            @if ($auction->category_id == 7)
                <div class="flex-fill text-right">
                    <h5 class="text-primary">$ {{ number_format($auction->starting_bid, 2, '.', ',') }}</h5>
                    
                </div>
            @endif
        </div>
    @endif {{-- endif for service_price_id --}}
    
    @if ($auction->category_id == 7)
        <hr>
        <div class="d-flex flex-row">
            <div class="flex-fill pr-3">
                <h5 class="text-muted">Total (USD)</h5>
            </div>
            @if ($auction->category_id == 7)
                <div class="flex-fill text-right">
                    <h5 class="">$ {{ number_format($order_total, 2, '.', ',') }}</h5>
                    
                </div>
            @endif
        </div>
    @endif {{-- endif for category --}}
@endif {{-- endif for url --}}


