@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    {{-- <div class="row">
        <div class="col-md-12">
            <a href="{{ url('booking/search?'.'auction_id='.$auction->auction_id.'&email='.$auction->email)}}" target="_blank">{{__('See this auction')}} </a>
        </div>
    </div> --}}
    <br>
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
                                {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                                {{ $extras_total = $extras->sum('total')}}
                            @endsection
                            <strong>$ {{ number_format($starting_bid, 2, '.', ',') }}</strong><br>

                            @if ($extras->count() > 0)
                                <small class="text-muted">{{__('Extras:')}}</small><br>
                                @foreach ($extras as $extra)
                                    <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }} <br>
                                @endforeach
                                <hr>
                                <h5><small>{{__('Extras total')}}:</small> $ {{ number_format($extras_total, 2, '.', ',') }}</h5>
                            @endif
                            {{-- <strong>{{__('Child seat')}}</strong>: $7.00 <br>
                            <strong>{{__('5 min extra stop')}}</strong>: $15.00 --}}
                            <hr>
                            <h4><small>{{__('Total')}}:</small> $ {{ number_format($total, 2, '.', ',') }}</h4>
                        </div>
                    </div>
                </div>
            </div>



            {{-- <div class="card border-success mb-3 text-center">
                <div class="card-body">

                    <span class="text-success" style="font-size: 20px;">{{__('Starting price')}}:<span class=""><strong> $ {{ number_format($auction->servicePrice->oneway_price, 2, '.', ',') }} </strong> </span> </span>
                </div>
            </div> --}}

            {{-- <div class="card border-primary mb-3 text-center">
                <div class="card-body">
                    @section('starting_bid')
                        {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                        {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                    @endsection

                    <div class="animation">
                        <h5 class="bid-title">{{__('Pending bid...')}} </h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="current-bid">
                        <span class="text-primary" style="font-size: 20px;">{{__('Current bid')}}: <span class=""> <strong>$ {{ number_format($starting_bid, 2, '.', ',') }}</strong></span></span>

                    </div>
                </div>
            </div>
            <br>

            <h4 class="">{{__('Fill Form to Buy at Auction Price.')}} </h4> --}}

        </div>
        <div class="col-md-8">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">{{ __('Your contact information')}} </h4>
                </div>{{-- /box-header --}}
                <div class="box-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="30%">{{ __('Full name')}}</td>
                                <td><strong>{{ $auction->full_name}}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ __('Email')}}</td>
                                <td><strong>{{ $auction->email}}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ __('Phone')}}</td>
                                <td><strong>{{ $auction->phone}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>{{-- /box-body --}}
            </div>{{-- /box --}}

            <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">{{ __('Arrival information')}} </h4>
                    </div>{{-- /box-header --}}
                    <div class="box-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="30%">{{ __('Arrival Date')}}</td>
                                    <td><strong>{{ date('l, F j - Y', strtotime($auction->date)) }} </strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Arrival Airline')}}</td>
                                    <td><strong>{{ $auction->arrival_airline}}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Flight Number')}}</td>
                                    <td><strong>{{ $auction->flight_number}}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Arrival Time')}}</td>
                                    <td><strong>{{ date('g:i A', strtotime($auction->arrival_time)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>{{-- /box-body --}}
                </div>{{-- /box --}}

                <div class="row">
                    <div class="col-md-6 text-center">
                        <small>Click here to accept the updated bid. For even better bids click button on right</small>

                        {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/acceptsb', $auction->id], 'style' => 'display:inline']) !!}
                            {{-- hidden fields --}}
                            {{ Form::hidden('auction_id', $auction->id) }}

                            {{-- Button --}}
                            {{-- {!! Form::button(number_format($starting_bid, 2, '.', ','), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-success btn-lg',
                                    // 'style' => 'color: #000; border-color: #fff;',
                                    'title' => __('Accept')
                            )) !!} --}}
                            <button class="btn btn-warning btn-block font-weight-bolder" type="submit" title="{{ __('Accept current bid')}}"><span class=""><i class="fa fa-refresh loading" aria-hidden="true"></i></span> $ {{ number_format($total, 2, '.', ',') }} {{ __('Current bid')}} </button>
                        {!! Form::close() !!}
                    </div> {{-- /col --}}

                    <div class="col-md-6 text-center">
                        <small>Click here to receive lower price bids by email. Hint: prices can drop 60%</small>

                        <a class="btn btn-warning btn-block font-weight-bolder" href="{{ url('booking/mybooking?'.'auction_id='.$auction->auction_id.'&email='.$auction->email)}}" title="{{ __('Continue with auction')}}">{{ __('See on going auction and receive email updates')}}</a>
                    </div> {{-- /col --}}
                </div> {{-- /row --}}
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                            HOW DO THE AUCTIONS WORK?
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">HOW DO THE AUCTIONS WORK?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                ...
                                </div>
                                <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                <button type="button" data-dismiss="modal" class="btn btn-primary">Ok</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>{{-- /col --}}


    </div>{{-- /row --}}

</div> {{-- /container --}}

@endsection
