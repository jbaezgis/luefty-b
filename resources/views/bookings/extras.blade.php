@extends('layouts.app2')

@section('content')
<br>
<div class="container mb-5">
    @include('bookings.top_texts')
    {{-- Service details --}}
    <div class="row">
        <div class="col-md-4">
            {{-- PC version --}}
            <div class="card d-none d-sm-block border-primary">
                <div class="card-header bg-primary pb-2">
                    <h4 class="card-title">{{__('Booking Details')}} </h4>
                </div>
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
                                <div class="p-2 bd-highlight"><i class="fa fa-calendar fa-2x text-info" aria-hidden="true"></i></div>
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

                    {{-- Nuevos --}}
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

                <div class="card-footer bg-white">
                    <div class="d-flex flex-row">
                        
                        <div class="p-2">
                            @section('starting_bid')
                                {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                                {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                                {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                                {{ $total_booking = $auction->order_total + $extras->sum('total')}}
                                {{ $total_auction = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                                {{ $extras_total = $extras->sum('total')}}
                            @endsection
                            {{-- @if ($auction->category_id == 7)
                                <span class="text-muted">{{__('Vehicle price:')}}</span><br>
                                <strong>$ {{ number_format($auction->order_total, 2, '.', ',') }}</strong><br>
                            @endif --}}

                            {{-- @if ($extras->count() > 0)
                                <span class="text-muted">{{__('Extras:')}}</span><br>
                                @foreach ($extras as $extra)
                                    <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }}
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
                            @endif --}}

                            {{-- @if ($auction->category_id == 7)
                                <hr>
                                <h4><small>{{__('Total')}}:</small> $ {{ number_format($total_booking, 2, '.', ',') }}</h4>
                            @elseif ($auction->extras->count())
                                <hr>
                                <h4><small>{{__('Total extras')}}:</small> $ {{ number_format($extras_total, 2, '.', ',') }}</h4>
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
                            <h5 >Total (USD)</span>
                            @if ($auction->category_id == 7)
                                <h4>${{ number_format($total_booking, 2, '.', ',') }}</h4>
                            @else
                                <h4>${{ number_format($extras_total, 2, '.', ',') }}</h4>
                            @endif
                        </li>
                      </ul>
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


        {{-- Right column --}}
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-primary font-weight-bolder ">
                    <h4 class="card-title">{{__('Please add any extras')}}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-wheelchair fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>Wheelchair <small>(folding type only)</small></h5>
                            <span class="text-info">€ 7.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Plase note that disabled passengers must be able to board the vehicle independently or with the assistance of those in their party.
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="Wheelchair">
                                        <input type="hidden" name="price" value="7">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-clock-o fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>5 min extra stop in same town</h5>
                            <span class="text-info">€ 15.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Ideal if you need to collect/drop off keys or if your group will be staying at more than one accommodation address.
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="5 min extra">
                                        <input type="hidden" name="price" value="15">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-child fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>Child seat</h5>
                            <span class="text-info">€ 7.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Suitable for toddlers weighing 9-18 kg (approx 1 to 6 years)
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="Child seat">
                                        <input type="hidden" name="price" value="7">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-child fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>Booster seat</h5>
                            <span class="text-info">€ 7.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Suitable for children weighing 15-36 kg (approx 4 to 12 years)
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="Booster seat">
                                        <input type="hidden" name="price" value="7">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- card-body -->
                <div class="card-footer d-sm-none mb-3 bg-white">
                    @section('starting_bid')
                        {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                        {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                        {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                        {{ $total_booking = $auction->order_total + $extras->sum('total')}}
                        {{ $total_auction = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                        {{ $extras_total = $extras->sum('total')}}
                    @endsection
                    {{-- <div class="d-flex flex-row">
                        
                        <div class="p-2 bd-highlight">

                            @if ($auction->category_id == 7)
                                <small class="text-muted">{{__('Vehicle price:')}}</small><br>
                                <strong>$ {{ number_format($auction->order_total, 2, '.', ',') }}</strong><br>
                            @endif

                            @if ($extras->count() > 0)
                                <small class="text-muted">{{__('Extras:')}}</small><br>
                                @foreach ($extras as $extra)
                                    <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }}
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

                            @if ($auction->category_id == 7)
                                <hr>
                                <h4><small>{{__('Total')}}:</small> $ {{ number_format($total_booking, 2, '.', ',') }}</h4>
                            @elseif ($auction->extras->count())
                                <hr>
                                <h4><small>{{__('Total extras')}}:</small> $ {{ number_format($extras_total, 2, '.', ',') }}</h4>
                            @endif

                            
                        </div>
                    </div> --}}

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
            </div><!-- card -->

            <div class="row justify-content-center">
                <div class="col-md-6 text-center pt-3">
                    @if ($auction->category_id == 7)
                        <a href="{{ url('booking/confirmation/'. $auction->key )}}" class="btn btn-primary">{{__('Save and continue')}} </a>

                        @if ($auction->extras->count())
                        @else
                            {{-- <a href="{{ url('booking/confirmation/'. $auction->key )}}" class="btn btn-warning">{{__('Skip and continue')}} </a> --}}
                        @endif
                    @else
                        {!! Form::open([
                            'method' => 'PATCH',
                            'url' => ['booking/assign/status', $auction->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button(__('Save and continue'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary',
                                    'title' => __('Save and continue')
                            )) !!}
                        {!! Form::close() !!}
                        {{-- <a href="{{ url('booking/assign/status/'.$auction->id)}}" class="btn btn-primary">{{__('Save and continue')}} </a> --}}
                        @if ($auction->extras->count())
                        @else
                            {{-- <a href="{{ url('booking/mybooking?'.'auction_id='.$auction->auction_id.'&email='.$auction->email)}}" class="btn btn-warning">{{__('Skip and continue')}} </a> --}}
                        @endif
                    @endif
                </div>
            </div>
        </div><!-- col -->

    </div>

</div>

</div> {{-- /container --}}

@endsection
