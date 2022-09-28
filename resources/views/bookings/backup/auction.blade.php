@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" role="alert">
                <div class="row">
                    <div class="col-md-3">
                        <i class="fa fa-check-circle fa-lg text-primary" aria-hidden="true"></i>  {{__('Fair Trade Tourism')}}
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-check-circle fa-lg text-primary" aria-hidden="true"></i>  {{__('Buy direct and save up to 60%')}}
                    </div>
                    <div class="col-md-6">
                        <i class="fa fa-check-circle fa-lg text-primary" aria-hidden="true"></i>  {{__('Suppliers compete for you booking by bidding lower and lower')}}
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- /row --}}
    {{-- Service details --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary pb-2">
                    <h4>{{__('Booking Details')}} </h4>
                </div>
                <div class="card-body">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="customRadioInline1">{{__('From the airport')}}</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">{{__('To the airport')}}</label>
                    </div>

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

                    {{-- <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-calendar fa-2x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <small class="text-muted">{{__('Flight departure')}}</small><br>
                                    <strong>3/7/2020</strong>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <small class="text-muted">{{__('Time')}}</small><br>
                                    <strong>12:00</strong>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card border-0 shadow-sm mt-2">
                        <div class="card-body p-1">
                            <div class="d-flex flex-row">
                                <div class="p-2 bd-highlight"><i class="fa fa-users fa-2x text-info" aria-hidden="true"></i></div>
                                <div class="p-2 bd-highlight">
                                    <small class="text-muted">{{__('Passengers')}}</small><br>
                                    <strong>{{$auction->adults}}
                                        {{__('Adults')}}
                                        @if ($auction->infants or $auction->babies)
                                            , {{$auction->infants + $auction->babies}} {{__('Children')}}
                                        @endif

                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex flex-row">
                        <div class="p-2 bd-highlight"><i class="fa fa-money fa-2x text-info" aria-hidden="true"></i></div>
                        <div class="p-2 bd-highlight">
                            <small class="text-muted">{{__('Vehicle price:')}}</small><br>
                            @section('starting_bid')
                                {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                                {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                            @endsection
                            <strong>$ {{ number_format($starting_bid, 2, '.', ',') }}</strong><br>

                            <small class="text-muted">{{__('Extras:')}}</small><br>
                            <strong>{{__('Child seat')}}</strong>: $7.00 <br>
                            <strong>{{__('5 min extra stop')}}</strong>: $15.00
                            <hr>
                            <h4><small>{{__('Total')}}:</small> $ {{ number_format($starting_bid, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header bg-primary">
                    {{__('Booking details')}}
                </div>
                <div class="card-body">
                    <p><strong>{{__('Service')}}:</strong> <span class="font-weight-light">{{__('From')}}</span> <span class="text-primary">{{ $auction->fromcity->name }}</span> <span class="font-weight-light">{{__('To')}}</span> <span class="text-primary">{{ $auction->tocity->name }}</span></p>
                    <p><strong>{{__('Driving time:')}} </strong> <span class="text-primary">{{ $auction->service->driving_time }} {{__('minutes')}}</span></p>
                    <p><strong>{{__('Vehicle type:')}} </strong> <span class="text-primary">{{ $auction->vehicleType->type }}</span> </p>
                </div>

            </div>
            <br>
            <div class="card border-success mb-3 text-center">
                <div class="card-body">

                    <span class="text-success" style="font-size: 20px;">{{__('Starting price')}}:<span class=""><strong> $ {{ number_format($auction->servicePrice->oneway_price, 2, '.', ',') }} </strong> </span> </span>
                </div>
            </div>

            <div class="card border-primary mb-3 text-center">
                <div class="card-body">
                    @section('starting_bid')
                        {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                        {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                    @endsection
                    {{-- <h3 class="">${{ number_format($starting_bid, 2, '.', ',') }}</h3> --}}
                    <div class="animation">
                        <h5 class="bid-title">{{__('Pending bid...')}} </h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="current-bid">
                        <span class="text-primary" style="font-size: 20px;">{{__('Current bid')}}: <span class=""> <strong>$ {{ number_format($starting_bid, 2, '.', ',') }}</strong></span></span>
                        {{-- <h3 class="text-success"><strong>{{__('Current bid')}}:</strong> $ {{ number_format($starting_bid, 2, '.', ',') }}</h3> --}}
                    </div>
                </div>
            </div>
            <br>

            <h4 class="">{{__('Fill Form to Buy at Auction Price.')}} </h4>

        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary" role="alert">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-check-circle fa-lg text-primary" aria-hidden="true"></i>  {{__('Free cancellation with 24 hours notice')}}
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-check-circle fa-lg text-primary" aria-hidden="true"></i>  <span class="">{{__('Drivers keep 100% of their price')}}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            {!! Form::model($auction, ['method' => 'PATCH', 'url' => ['/booking', $auction->id], 'id' => 'main_form',
                'class' => 'form-horizontal needs-validation', 'novalidate']) !!}
            {{-- Form info --}}
            {{-- <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="baby_seats">{{ __('Baby Seats')}}</label>
                                <input type="number" class="form-control {{ $errors->has('baby_seats') ? 'is-invalid' : '' }}" id="baby_seats" name="baby_seats" value="{{ old('baby_seats', $auction->baby_seats) }}" aria-describedby="passengersErrors">
                                <small id="passengersError" class="form-text text-danger">{{ $errors->first('baby_seats') }} </small>
                                <div class="invalid-feedback">
                                    {{ __('Please enter how many baby seats') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="child_seats">{{ __('Child Seats')}}</label>
                                <input type="number" class="form-control {{ $errors->has('child_seats') ? 'is-invalid' : '' }}" id="child_seats" name="child_seats" value="{{ old('child_seats', $auction->child_seats) }}" aria-describedby="passengersErrors">
                                <small id="passengersError" class="form-text text-danger">{{ $errors->first('child_seats') }} </small>
                                <div class="invalid-feedback">
                                    {{ __('Please enter how many child seats') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <hr> --}}
                @include ('bookings.forms.airport_to_airport')

                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" type="submit" title="{{ __('Continue with auction')}}">{{ __('Continue with auction')}} <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    </div> {{-- /col --}}
                </div> {{-- /row --}}
            {!! Form::close() !!}
        </div>



    </div>

</div>

</div> {{-- /container --}}

@endsection
