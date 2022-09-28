{{-- <p class="lead">{{__('Category')}}: <strong class="text-primary">{{__('Private')}} </strong> </p> --}}
@if ($item->type == 'roundtrip')
        <div class="row">
            <div class="col-md-12">
                <p class="">
                    {{__('Booking ID:')}} <strong># {{$item->service_number ? $item->service_number : $item->auction_id }}</strong>  ({{__('This is a Round-Trip')}}) | 
                    {{-- {{__('Vehicle')}}: <strong>{{$item->vehicleType->type}} - {{$item->vehicleType->max_passengers}} pax</strong> |  --}}
                    {{__('Vehicle')}}: <strong>{{$item->vehicleType->type}}</strong> | 
                    {{__('Passengers')}}: <strong>{{$item->passengers}}</strong> | 
                    {{__('Starting bid')}}: <strong>{{ $item->country->currency_symbol }}{{ number_format($item->starting_bid, 2, '.', ',') }}</strong>
                    {{-- Current bid --}}
                    @if ($bids->where('auction_id', $item->id)->count() > 0)
                        | <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
                    @endif
                </p> 
            </div>
            <div class="col-md-6">
                {{-- Ida --}}
                <span class="text-primary"><i class="fa fa-arrow-right" aria-hidden="true"></i> {{__('Going')}} (<i class="fa fa-calendar" aria-hidden="true"></i> {{ date('l j, F Y', strtotime($item->date)) }}, {{ date('g:i A', strtotime($item->time)) }})</span>
                <h5 class="font-weight-light">{{__('From')}} <strong>{{ $item->fromcity->name }}</strong> {{__('To')}} <strong>{{ $item->tocity->name }}</strong></h5>
                
            </div>

            <div class="col-md-6">
                {{-- Vuelta --}}
                <span class="text-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Return')}} (<i class="fa fa-calendar" aria-hidden="true"></i> {{ date('l j, F Y', strtotime($item->return_date)) }}, {{ date('g:i A', strtotime($item->pickup_time)) }})</span>
                <h5 class="font-weight-light">{{__('From')}} <strong>{{ $item->tocity->name }}</strong> {{__('To')}} <strong>{{ $item->fromcity->name }}</strong></h5>
            </div>

            {{-- <div class="col-md-12">
                @if ($item->extras->count())
                    <div class="card">
                        <div class="card-header">
                            <h4 class=" card-title d-flex justify-content-between align-items-center">
                                <span class="">{{__('Extras')}}</span>
                                
                            </h4>
                        </div>
                        <div class="card-body">
                            @foreach ($item->extras as $extra)
                                {{$extra->quantity}} <strong>{{$extra->name}}</strong><br>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div> --}}
        </div>
    @else
        <p>
            <span class=""># {{ $item->auction_id }}</span> |
            <span class="mr-2">{{__('Date')}}: <strong>{{ date('l j, F Y', strtotime($item->date)) }}</strong>, {{__('Arrival time')}}: <strong>{{ date('g:i A', strtotime($item->arrival_time)) }}</strong></span> |
            {{__('Vehicle')}}: <strong>{{$item->vehicleType->type}}</strong> |
            {{__('Passengers')}}: <strong>{{$item->passengers}}</strong> | 
            <span class="">{{ __('Starting bid') }}: <strong>{{ $item->country->currency_symbol }}{{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span> 

            {{-- Current bid --}}
            @if ($item->category->code == 'private')
                @if ($bids->where('auction_id', $item->id)->count() > 0)
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
                @else
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
                @endif
            @endif

            @if ($item->bids->count() > 0)
            |
                <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->bids->min('bid'), 2, '.', ',') }}</strong></span></span>
            @endif
        </p>
    @endif