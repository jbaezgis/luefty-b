@if ($auction->starting_bid)
    @section('starting_bid')
        {{ $percentage = $auction->servicePrice->starting_bid * 0.10 }}
        {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
        {{ $order_total = $auction->order_total + $extras->sum('total')}}
    @endsection
@endif

<div class="col-md-4">
    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            {{-- {{__('Booking details')}} --}}
            <h4 class="box-title">{{ __('Booking Details')}} </h4>
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
            
        </div>
        {{-- end card-body --}}
    </div>
    {{-- end card --}}
</div>

