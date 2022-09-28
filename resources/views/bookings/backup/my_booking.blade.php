@extends('layouts.app2')

@section('content')
<br>
<div class="container-fluid mb-5">
    @if ($request->auction_id)
    {{-- PC Version --}}
    {{-- <hr> --}}
    <div class="row ">
            <div class="col-md-4 d-none d-sm-block">
                <div class="accordion" id="accordionExample">
                    <div class="card border-primary">
                        <div class="card-header bg-primary" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="card-title">{{__('Booking Details')}} <small>({{('Click here')}})</small></h4>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
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

                                <div class="card border-0 shadow-sm mt-2">
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
                                                    <strong>{{ date('g:i A', strtotime($auction->arrival_time)) }}</strong>
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
                                </div>
                                <div class="card border-0 shadow-sm mt-2">
                                    <div class="card-body p-1">
                                        <div class="d-flex flex-row">
                                            <div class="p-2 bd-highlight"><i class="fa fa-plane fa-3x text-info" aria-hidden="true"></i></div>
                                            <div class="p-2 bd-highlight">
                                                <span class="text-info">{{__('Arrival Airline')}}</span><br>
                                                <strong>{{$auction->arrival_airline}}</strong>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                                @if($auction->arrival_time)
                                                    <span class="text-info">{{__('Flight Number')}}</span><br>
                                                    <strong>{{ $auction->flight_number }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm mt-2">
                                    <div class="card-body p-1">
                                        <div class="d-flex flex-row">
                                            <div class="p-2 bd-highlight"><i class="fa fa-info fa-3x text-info" aria-hidden="true"></i></div>
                                            <div class="p-2 bd-highlight">
                                                <span class="text-info">{{__('More Information')}}</span><br>
                                                <strong>{{$auction->more_information}}</strong>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                @if ($auction->type == 'roundtrip')
                                <div class="card border-0 shadow-sm mt-2">
                                    <div class="card-body p-1">
                                        <div class="d-flex flex-row">
                                            <div class="p-2 bd-highlight"><i class="fa fa-map-marker fa-3x text-info" aria-hidden="true"></i></div>
                                            <div class="p-2 bd-highlight">
                                                <span class="text-info">{{__('Departure Date')}}</span><br>
                                                <strong>{{$auction->return_date}}</strong>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                                @if($auction->arrival_time)
                                                    <span class="text-info">{{__('Departure Time')}}</span><br>
                                                    <strong>{{ date('g:i A', strtotime($auction->return_time)) }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm mt-2">
                                    <div class="card-body p-1">
                                        <div class="d-flex flex-row">
                                            <div class="p-2 bd-highlight"><i class="fa fa-plane fa-3x text-info" aria-hidden="true"></i></div>
                                            <div class="p-2 bd-highlight">
                                                <span class="text-info">{{__('Departure Airline')}}</span><br>
                                                <strong>{{$auction->return_airline}}</strong>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                                @if($auction->arrival_time)
                                                    <span class="text-info">{{__('Flight Number')}}</span><br>
                                                    <strong>{{ $auction->return_flight_number }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif

                            </div>
                            <div class="card-footer border-bottom border-primary bg-white">
                                <div class="d-flex flex-row">
                                    {{-- <div class="p-2 bd-highlight"><i class="fa fa-money fa-2x text-info" aria-hidden="true"></i></div> --}}
                                    <div class="p-2 bd-highlight">
                                        @section('starting_bid')
                                            {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                                            {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                                            {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                                            {{ $extras_total = $extras->sum('total')}}
                                        @endsection

                                        {{-- @if ($extras->count() > 0)
                                            <small class="text-muted">{{__('Extras:')}}</small><br>
                                            @foreach ($extras as $extra)
                                                <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }} <br>
                                            @endforeach
                                            <hr>
                                            <h5><small>{{__('Extras total')}}:</small> $ {{ number_format($extras_total, 2, '.', ',') }}</h5>
                                        @endif --}}
                                    </div>
                                </div>

                                <ul class="list-group list-group-flush">
                                    @if ($auction->category_id == 7)
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h5 class="my-0">{{__('Vehicle')}}</h5>
                                            <span class="text-muted">{{__('Vehicle details')}}</span>
                                        </div>
                                        <h5 class="text-muted">
                                            ${{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                            {{-- @if ($auction->category_id == 7)
                                            @else
                                                ${{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                            @endif --}}
                                        </h5>
                                    </li>
                                    @endif
                                    @if ($extras->count() > 0)
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h5 class="my-0">{{__('Extras')}}</h5>
                                            @foreach ($extras as $extra)
                                                <span class="text-muted">{{ $extra->quantity }} - {{ $extra->name }} = ${{ number_format($extra->total, 2, '.', ',') }}</span> 
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
                                        </div>
                                        @if ($auction->category_id == 7)
                                        <h5 class="text-muted">${{ number_format($extras_total, 2, '.', ',') }}</span>
                                        @endif
                                    </li>
                                    @endif
                                    
                                    <li class="list-group-item d-flex justify-content-between">
                                        @if ($auction->category_id == 7)
                                            <h5 >Total (USD)</span>
                                            <h4>${{ number_format($total_booking, 2, '.', ',') }}</h4>
                                        @else
                                            @if ($extras->count() > 0)
                                            <h5 >Total (USD)</span>
                                            <h4>${{ number_format($extras_total, 2, '.', ',') }}</h4>
                                            @endif
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary mt-2">
                        <div class="card-header bg-primary" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="card-title">{{ __('Your contact information')}} <small>({{('Click here')}})</small></h4>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
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
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 d-none d-sm-block">

                {{-- Cannot edit alert --}}
                @if( session()->has('cannot_edit') )
                    <div class="alert alert-warning" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading">{{ __('Sorry!') }} <small>{{ session('cannot_edit') }}</small></h4>
                        <hr>
                        {{__('If you want to cancel this auction and create another one, please click cancel!')}} <br>
                        <p></p>
                        {{-- <a href="#" class="btn btn-warning">{{__('Cancel')}} </a> --}}
                        {!! Form::open(['method' => 'DELETE', 'url' => ['/booking/cancel', $auction->id], 'style' => 'display:inline']) !!}
                            {!! Form::button(__('Cancel'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-warning',
                                    'title' => __('Do you want to cancel this auction?')
                            )) !!}
                        {!! Form::close() !!}
                    </div>
                @endif

                

                @section('starting_bid')
                    {{ $percentage = $auction->servicePrice->oneway_price * 0.5 }}
                    {{ $starting_bid = $auction->servicePrice->oneway_price + $percentage }}
                    {{ $date_remaining = \Carbon\Carbon::parse($auction->date) }}
                    {{ $date_time = $auction->date . ' ' .$auction->arrival_time}}
                    {{ $date_r=strtotime($date_time)}}
                    {{ $diff=$date_r-time() }}
                    {{ $days=floor($diff/(60*60*24)) }}
                    {{ $hours=round(($diff-$days*60*60*24)/(60*60)) }}
                @endsection
                    <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                            <h4 class="card-title">{{ __('Bids') }} </h4>
                        </div>{{-- /box-header --}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong class="font-weight-bolder">
                                        {{__('Bids drop nearer the auction close date because drivers want to fill empty legs and idle time. You receive an email with each lower bid.')}}
                                    </strong>
                                    <p></p>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{__('Driver')}}</th>
                                        {{-- <th>{{__('Rating')}}</th> --}}
                                        {{-- <th>{{__('Vehicle')}}</th> --}}
                                        <th>{{__('Current Bid')}}</th>
                                        <th>{{__('Auction Closes')}}</th>
                                        <th>{{__('Accept bid and pay now')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bids as $bid)
                                    @section('bid')
                                        {{ $bid_per = $bid->bid * 0.5 }}
                                        {{ $bid_total = $bid->bid + $bid_per }}
                                    @endsection
                                    <tr>
                                        <td scope="row">{{$bid->user->name}}</td>
                                        {{-- <td>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        </td> --}}
                                        {{-- <td>2017 Microbus</td> --}}
                                        <td class="bg-primary font-weight-bolder text-center">${{ number_format($bid_total , 2, '.', ',') }}</td>
                                        {{-- <td>{{$date_remaining->diffInHours()}} {{__('hours')}} </td> --}}
                                        <td>
                                            @if ($days > 0)
                                                {{$days}} {{ $days == 1 ? __('day') : __('days') }} {{__('and')}} {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                                            @else 
                                                {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                                            @endif 
                                        </td>
                                        <td class="bg-warning">
                                            {!! Form::open(['method' => 'PATCH', 'url' => ['booking/accept-bid', $bid->id], 'style' => 'display:inline']) !!}
                                                {{-- hidden fields --}}
                                                {{ Form::hidden('auctionid', $auction->id) }}

                                                {{-- Button --}}
                                                {!! Form::button(__('Accept offer'), array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                        'title' => __('Accept Bid'),
                                                        'data-toggle' => 'tooltip',
                                                        'data-placement' => 'top',
                                                        'title' => __('Accept offer or wait for better bid')
                                                )) !!}
                                                
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td scope="row">{{__('Starting bid')}}</td>
                                        {{-- <td>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        </td> --}}
                                        {{-- <td>2017 Microbus</td> --}}
                                        <td class="bg-primary font-weight-bolder text-center">${{ number_format($starting_bid, 2, '.', ',') }}</td>
                                        <td>
                                            @if ($days > 0)
                                                {{$days}} {{ $days == 1 ? __('day') : __('days') }} {{__('and')}} {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                                            @else 
                                                {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                                            @endif 
                                        </td>
                                        <td class="bg-warning">
                                            {!! Form::open(['method' => 'PATCH', 'url' => ['booking/acceptsb', $auction->id], 'style' => 'display:inline']) !!}
                                                {{-- hidden fields --}}
                                                {{-- {{ Form::hidden('auction_id', $auction->id) }} --}}

                                                {{-- Button --}}
                                                {!! Form::button(__('Accept offer'), array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                        'title' => __('Accept Bid'),
                                                        'data-toggle' => 'tooltip',
                                                        'data-placement' => 'top',
                                                        'title' => __('Accept offer or wait for better bid')
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>{{-- /box-body --}}
                    </div>{{-- /box --}}
            </div>{{-- /col --}}



    </div>{{-- /row --}}
    @endif
    {{-- End PC version --}}

    {{-- Mobile version --}}

    <div class="row d-block d-sm-none px-2 ">
        <div class="col-md-12 px-2 text-center">
            <small>{{__('Scroll down to see bids')}} </small>
            <p></p>
        </div>
        <div class="col-md-12">
                 <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-details" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Booking Details')}}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-contac" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Contact information')}}</a>
                    </li>
                </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body">
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
                                                    <strong>{{ date('g:i A', strtotime($auction->arrival_time)) }}</strong>
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
                                <div class="card border-0 shadow-sm mt-2">
                                    <div class="card-body p-1">
                                        <div class="d-flex flex-row">
                                            <div class="p-2 bd-highlight"><i class="fa fa-plane fa-3x text-info" aria-hidden="true"></i></div>
                                            <div class="p-2 bd-highlight">
                                                <span class="text-info">{{__('Arrival Airline')}}</span><br>
                                                <strong>{{$auction->arrival_airline}}</strong>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                                @if($auction->arrival_time)
                                                    <span class="text-info">{{__('Flight Number')}}</span><br>
                                                    <strong>{{ $auction->flight_number }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex flex-row">
                                {{-- <div class="p-2 bd-highlight"><i class="fa fa-money fa-2x text-info" aria-hidden="true"></i></div> --}}
                                <div class="p-2 bd-highlight">
                                    @section('starting_bid')
                                        {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                                        {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                                        {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                                        {{ $extras_total = $extras->sum('total')}}
                                    @endsection
    
                                    {{-- @if ($extras->count() > 0)
                                        <small class="text-muted">{{__('Extras:')}}</small><br>
                                        @foreach ($extras as $extra)
                                            <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }} <br>
                                        @endforeach
                                        <hr>
                                        <h5><small>{{__('Extras total')}}:</small> $ {{ number_format($extras_total, 2, '.', ',') }}</h5>
                                    @endif --}}
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                @if ($auction->category_id == 7)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h5 class="my-0">{{__('Vehicle')}}</h5>
                                        <span class="text-muted">Vehicle details</span>
                                    </div>
                                    <h5 class="text-muted">
                                        ${{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                        {{-- @if ($auction->category_id == 7)
                                        @else
                                            ${{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                        @endif --}}
                                    </h5>
                                </li>
                                @endif
                                @if ($extras->count() > 0)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h5 class="my-0">{{__('Extras')}}</h5>
                                        @foreach ($extras as $extra)
                                            <span class="text-muted">{{ $extra->quantity }} - {{ $extra->name }} = ${{ number_format($extra->total, 2, '.', ',') }}</span> 
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
                                    </div>
                                    @if ($auction->category_id == 7)
                                    <h5 class="text-muted">${{ number_format($extras_total, 2, '.', ',') }}</span>
                                    @endif
                                </li>
                                @endif
                                
                                <li class="list-group-item d-flex justify-content-between">
                                    @if ($auction->category_id == 7)
                                        <h5 >Total (USD)</span>
                                        <h4>${{ number_format($total_booking, 2, '.', ',') }}</h4>
                                    @else
                                        @if ($extras->count() > 0)
                                        <h5 >Total (USD)</span>
                                        <h4>${{ number_format($extras_total, 2, '.', ',') }}</h4>
                                        @endif
                                    @endif
                                </li>
                              </ul>
                        </div>
                    </div>
                </div>
                {{-- End details --}}
                <div class="tab-pane fade" id="pills-contac" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card">
                        <div class="card-body">
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
                            
                        </div>
                    </div>
                </div>
              </div>
        </div>
        <hr>
        {{-- Bids --}}
        <div class="row">
            <div class="col-md-12">
                <h4 class="pl-3">{{__('Bids')}} </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <small class="">
                    {{__('Bids drop nearer the auction close date because drivers want to fill empty legs and idle time. You receive an email with each lower bid.')}}
                </small>
                <p></p>
            </div>
        </div>
        <div class="col-md">
        @foreach ($bids as $bid)
            
        @section('bid')
            {{ $bid_per = $bid->bid * 0.5 }}
            {{ $bid_total = $bid->bid + $bid_per }}
        @endsection
            <div class="card">
                <div class="card-header">
                    {{$bid->user->name}} - 
                    <span class="font-weight-bolder">${{ number_format($bid_total , 2, '.', ',') }}</span>
                </div>
                <div class="card-body">
                    <span>{{__('Rating')}}:
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                    </span> <br>
                    <span>{{__('Vehicle')}}: <strong>2017 Microbus</strong></span> <br>
                    <span>{{__('Auction Closes')}}: 
                        <strong>
                            @if ($days > 0)
                                {{$days}} {{ $days == 1 ? __('day') : __('days') }} {{__('and')}} {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                            @else 
                                {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                            @endif 
                        </strong>
                    </span> 
                    <br>
                </div>
                <div class="card-footer">
                    {!! Form::open(['method' => 'PATCH', 'url' => ['booking/accept-bid', $bid->id], 'style' => 'display:inline']) !!}
                            {{-- hidden fields --}}
                            {{ Form::hidden('auctionid', $auction->id) }}

                            {{-- Button --}}
                            {!! Form::button(__('Accept offer'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-warning btn-block',
                                    'title' => __('Accept offer'),
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => __('Accept offer or wait for better bid')
                            )) !!}
                        {!! Form::close() !!}
                </div>
            </div>
            <p></p>
        @endforeach
    </div>
        <div class="col-md">
            @section('starting_bid2')
                    {{ $percentage2 = $auction->servicePrice->oneway_price * 0.5 }}
                    {{ $starting_bid2 = $auction->servicePrice->oneway_price + $percentage2 }}
                @endsection
            <div class="card">
                <div class="card-header">
                    {{__('Starting bid')}} - 
                    <span class="font-weight-bolder">${{ number_format($starting_bid2, 2, '.', ',') }}</span>
                </div>
                <div class="card-body">
                    <span>{{__('Rating')}}:
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                    </span> <br>
                    <span>{{__('Vehicle')}}: <strong>2017 Microbus</strong></span> <br>
                    <span>{{__('Auction Closes')}}: 
                        <strong>
                            @if ($days > 0)
                                {{$days}} {{ $days == 1 ? __('day') : __('days') }} {{__('and')}} {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                            @else 
                                {{ $hours }} {{ $hours == 1 ? __('hour') : __('hours') }}
                            @endif 
                        </strong>
                    </span> <br>
                </div>
                <div class="card-footer">
                    {!! Form::open(['method' => 'PATCH', 'url' => ['booking/acceptsb', $auction->id], 'style' => 'display:inline']) !!}
                    {{-- hidden fields --}}
                    {{-- {{ Form::hidden('auction_id', $auction->id) }} --}}

                    {{-- Button --}}
                    {!! Form::button(__('Accept offer'), array(
                            'type' => 'submit',
                            'class' => 'btn btn-warning btn-block',
                            'title' => __('Accept Bid'),
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'title' => __('Accept offer or wait for better bid')
                    )) !!}
                {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
