@if ($auction->starting_bid)
    @section('starting_bid')
        {{ $percentage = $auction->servicePrice->starting_bid * 0.10 }}
        {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
        {{ $order_total = $auction->order_total + $extras->sum('total')}}
    @endsection
@endif


    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            {{-- {{__('Booking details')}} --}}
            <h4 class="box-title">{{ __('Auction Details')}} </h4>
        </div>
        <div class="card-body">
            {{-- Airport to Airport --}}
            @if ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == 1)
                @include ('bookings.left_column.airport_to_airport')
            
            {{-- Airport to Location --}}
            @elseif ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == NULL)
                @include ('bookings.left_column.airport_to_location')
            
            {{-- Location to Location --}}
            @elseif ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == NULL)
                @include ('bookings.left_column.location_to_location')
            
            {{-- Location to Airport --}}
            @elseif ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == 1)
                @include ('bookings.left_column.location_to_airport')

            @endif
            
            @if(request()->is('booking/complete_form*'))
            <hr>
            <h5 class="text-primary">{{__('Payment details')}}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between lh-condensed pl-0">
                    <div>
                        {{-- <h5 class="my-0">{{__('Vehicle')}}</h5> --}}
                        <h5>{{$auction->servicePrice->vehicle->type}}</h5>
                        <span class="text-muted">Max <strong>{{ $auction->servicePrice->priceOption->max_passengers }}</strong> {{__('passengers')}} </span>
                        {{-- <span class="text-muted">Vehicle details</span> --}}
                    </div>
                    <h5 class="text-muted">
                        @if ($auction->category_id == 7)
                            {{$auction->country->currency_symbol}}{{ number_format($auction->order_total, 2, '.', ',') }}<br>
                        @else
                            {{$auction->country->currency_symbol}}{{ number_format($auction->order_total, 2, '.', ',') }}<br>
                        @endif
                        
                    </h5>
                </li>
                @if ($extras->count() > 0)
                <li class="list-group-item d-flex justify-content-between lh-condensed pl-0">
                    <div>
                        <h5 class="my-0">{{__('Extras')}}</h5>
                        @foreach ($extras as $extra)
                            <span class="text-muted">{{ $extra->quantity }} - {{ $extra->name }} = {{$auction->country->currency_symbol}}{{ number_format($extra->total, 2, '.', ',') }}</span> <br>
                        @endforeach
                    </div>
                    <h5 class="text-muted">{{$auction->country->currency_symbol}}{{ number_format($extras_total, 2, '.', ',') }}</span>
                </li>
                @endif
                
                @if($auction->discount)
                    <li class="list-group-item d-flex justify-content-between pl-0">
                        <span>{{__('Coupon')}}: {{$coupon->code}}</small></span>
                        <h4>- {{$auction->country->currency_symbol}}{{ number_format($auction->discount, 2, '.', ',') }}</h4>
                    </li>
                @endif
                <li class="list-group-item d-flex justify-content-between pl-0">
                    <h5 >Total</span>
                    <h4>{{$auction->country->currency_symbol}}{{ number_format($total, 2, '.', ',') }}</h4>
                    {{-- @if ($auction->category_id == 7)
                        <h4>{{$auction->country->currency_symbol}}{{ number_format($total_booking, 2, '.', ',') }}</h4>
                    @else
                    @endif --}}
                </li>
            </ul>
            @endif
            {{-- <img class="img-fluid" src="{{ asset('images/home/muestra-pajaro-2.png') }}" alt="Pajaro"> --}}
        </div>
        {{-- end card-body --}}
    </div>
    {{-- end card --}}


