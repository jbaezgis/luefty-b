<div class="row">
    <div class="col-3 text-center border-right">
        <h5 class="mb-0">{{$auction->full_name}}</h5>
        <span class="text-muted">{{$auction->email}}</span><br>
        <span class="text-muted">{{$auction->phone}}</span><br>
        
        <small class="font-weight-bold text-muted">{{__('Status')}}:</small>
        @if ($auction->changed === 1 & $auction->status === 'Closed')
            <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
        @elseif ($auction->changed === 1)
            <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is Changed because you updated its info') }}" data-placement="top">{{ __('Changed')}} </span>
        @else
            @if ($auction->status == 'Closed')
                <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
            @else
                @if ($auction->bids->count() > 0)
                    <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ __('This Auction is Open because has one bid or more.') }}" data-placement="top">{{ __('Open') }}</span>
                @else
                    <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is do not have bids.') }}" data-placement="top">{{ __('No bid yet') }}</span>
                @endif
            @endif
        @endif

        <hr>
        <div class="row justify-content-center">
            <div class="col-4">
                <small class="font-weight-bold text-uppercase text-muted">{{__('Payment')}}</small> <br>
                <span>
                    @if($auction->payment_method == 'Stripe')
                        <span class=""><i class="fa fa-cc-stripe fa-2x stripe" aria-hidden="true"></i> </span>
                    @else
                        <span class="badge badge-warning"> {{__('Pending')}}</span>
                    @endif
                </span>
            </div>
            <div class="col-5">
                <small class="font-weight-bold text-uppercase text-muted">{{__('Amount Paid')}}</small> <br>
                <span class="font-weight-bold ">
                    {{$auction->country->currency_symbol}}{{ number_format($auction->paid_amount, 2, '.', ',') }}
                </span>
            </div>
            
            
        </div>

    </div>

    {{-- Round-trip details --}}
    @if($auction->type == 'roundtrip')
        <div class="col-9">
            <div class="d-flex flex-row">
                
                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Booking ID')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->auction_id}} </span>
                    </div>

                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Type')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->type == 'oneway' ? 'One way' : 'Round-Trip'}}</span>
                    </div>

                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Passengers')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->passengers}}</span>
                    </div>
        
                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Vehicle')}}</small> <br>
                        <span class="font-weight-bold">
                            {{$auction->servicePrice->vehicle->type}} 
                            <span class="text-muted font-weight-normal">(<span>Max <strong>{{$auction->servicePrice->vehicle->max_passengers}}</strong> {{__('passengers')}})</span>
                        </span>
                    </div>

                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Starting Bid')}}</small> <br>
                        <span class="font-weight-bold">
                            {{$auction->country->currency_symbol}}{{ number_format($auction->starting_bid, 2, '.', ',') }}
                        </span>
                    </div>

                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Buy Now price')}}</small> <br>
                        <span class="font-weight-bold">
                            {{$auction->country->currency_symbol}}{{ number_format($auction->order_total, 2, '.', ',') }}
                        </span>
                    </div>
            </div>
            <hr>
            <h5 class="pl-2 mb-0">{{__('Going')}}</h5>
            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('From')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->fromcity['name']}}</span>
                </div>
    
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('To')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->tocity['name']}}</span>
                </div>
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Flight arrival')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->date}}, {{ date('g:ia', strtotime($auction->arrival_time)) }}</span>
                </div>
            </div>
            
            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Arrival Airline')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->arrival_airline}}</span>
                </div>
    
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Flight Number')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->flight_number}}</span>
                </div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Drop-off details and other information')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->more_information}}</span>
                </div>
            </div>

            <hr>
            <h5 class="pl-2 mb-0">{{__('Return')}}</h5>
            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('From')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->tocity['name']}}</span>
                </div>
    
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('To')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->fromcity['name']}}</span>
                </div>

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Flight arrival')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->return_date}}, {{ date('g:ia', strtotime($auction->return_time)) }}</span>
                </div>

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Pickup Time')}}</small> <br>
                    <span class="font-weight-bold">{{ date('g:ia', strtotime($auction->pickup_time)) }}</span>
                </div>
            </div>
            
            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Arrival Airline')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->return_airline}}</span>
                </div>
    
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Flight Number')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->return_flight_number}}</span>
                </div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Drop-off details and other information')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->return_more_information}}</span>
                </div>
            </div>
        </div>
    {{-- One way details --}}
    @else
        <div class="col-9">
            <div class="d-flex flex-row">
                
                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Booking ID')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->auction_id}} </span>
                    </div>

                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Type')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->type == 'oneway' ? 'One way' : 'Round-Trip'}}</span>
                    </div>

                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Starting Bid')}}</small> <br>
                        <span class="font-weight-bold">
                            {{$auction->country->currency_symbol}}{{ number_format($auction->starting_bid, 2, '.', ',') }}
                        </span>
                    </div>
                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Buy Now price')}}</small> <br>
                        <span class="font-weight-bold">
                            {{$auction->country->currency_symbol}}{{ number_format($auction->order_total, 2, '.', ',') }}
                        </span>
                    </div>

            </div>

            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('From')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->fromcity['name']}}</span>
                </div>
    
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('To')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->tocity['name']}}</span>
                </div>

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Flight arrival')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->date}}, {{ date('g:ia', strtotime($auction->arrival_time)) }}</span>
                </div>

            </div>

            <div class="d-flex flex-row">

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Arrival Airline')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->arrival_airline}}</span>
                </div>

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Flight Number')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->flight_number}}</span>
                </div>

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Passengers')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->passengers}}</span>
                </div>

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Vehicle')}}</small> <br>
                    <span class="font-weight-bold">
                        {{$auction->servicePrice->vehicle->type}} 
                        <span class="text-muted font-weight-normal">(<span>Max <strong>{{$auction->servicePrice->vehicle->max_passengers}}</strong> {{__('passengers')}})</span>
                    </span>
                </div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('Drop-off details and other information')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->more_information}}</span>
                </div>
            </div>
        </div>
    @endif
</div>
<hr>