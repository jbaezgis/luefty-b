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
                    <h4 class="card-title">{{__('Booking Details')}}</h4>
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
                    
                    {{-- <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="customRadioInline1">{{__('From the airport')}}</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">{{__('To the airport')}}</label>
                    </div> --}}

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
                                        <strong>{{ date('g:i A', strtotime($auction->arrival_time)) }}</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> --}}

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

                {{-- <div class="card-footer">
                    <div class="d-flex flex-row">
                        <div class="p-2 bd-highlight"><i class="fa fa-money fa-2x text-info" aria-hidden="true"></i></div>
                        <div class="p-2 bd-highlight">

                            @section('starting_bid')
                                {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                                {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                                {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
                                {{ $extras_total = $extras->sum('total')}}
                            @endsection
                            <small class="text-muted">{{__('Vehicle price:')}}</small><br>
                            <strong>$ {{ number_format($starting_bid, 2, '.', ',') }}</strong><br>

                            @if ($extras->count() > 0)
                                <small class="text-muted">{{__('Extras:')}}</small><br>
                                @foreach ($extras as $extra)
                                    <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }} <br>
                                @endforeach
                            @endif
                            <hr>
                            <h4><small>{{__('Total')}}:</small> $ {{ number_format($total, 2, '.', ',') }}</h4>

                        </div>
                    </div>
                </div> --}}
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
            {{-- End PC version --}}

            {{-- Mobile version --}}
            <div class="d-block d-sm-none mb-3">
                @section('passengers')
                    {{ $childrend = $auction->infants + $auction->babies}}
                @endsection
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
            @if( session()->has('passengers_error') )
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="lead">{{ __('You selected a') }} <strong>{{$auction->vehicleType->type}}</strong> {{__('for a maximum of')}} <strong>{{$auction->vehicleType->max_passengers}}</strong> {{__('passengers')}}</p>
                    <hr>
                    <p>{{__('Select another size of vehicle or change the number of passengers')}}</p>
                    <a href="{{url('first_step/'.$auction->key.'/edit')}} " class="btn btn-warning btn-sm">{{__('Vehicle List')}} </a> <br>
                    
                </div>
            @endif

            {!! Form::model($auction, ['method' => 'PATCH', 'url' => ['/booking', $auction->id], 'id' => 'main_form',
                'class' => 'form-horizontal needs-validation', 'novalidate']) !!}
            
                @include ('bookings.forms.airport_to_airport')

                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        {{-- <small>Click here to accept the updated bid. For even better bids click button on right</small> --}}
                        {{-- <small>Fill this form, select your extras and continue to the auction.</small> --}}
                        {{-- <button class="btn btn-warning btn-block font-weight-bolder" type="submit" title="{{ __('Continue with auction')}}"><span class=""><i class="fa fa-refresh loading" aria-hidden="true"></i></span> $ {{ number_format($total, 2, '.', ',') }} {{ __('Current bid')}} </button> --}}
                        <button class="btn btn-warning btn-block font-weight-bolder" type="submit" title="{{ __('Continue with auction')}}"><span class="">{{ __('Save and continue')}} </button>
                    </div> {{-- /col --}}

                    {{-- <div class="col-md-6 text-center">
                        <small>Click here to receive lower price bids by email. Hint: prices can drop 60%</small>
                        <button class="btn btn-warning btn-block font-weight-bolder" type="submit" title="{{ __('Continue with auction')}}">{{ __('See on going auction and receive email updates')}}</button>
                    </div>  --}}
                </div> {{-- /row --}}
                {{-- <hr>
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

                                <button type="button" data-dismiss="modal" class="btn btn-primary">Ok</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            {!! Form::close() !!}
        </div>

        {{-- Right column --}}
        {{-- <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bolder">
                    {{__('Please add any extras')}}
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
                                        Plase note that disabled passenger must be able to board the vehicle independently or with the assistance of those in their party.
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    <small>{{ __('Outward')}} </small>
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
                                        Ideal if you need to collet/drop off keys or if your group will bestaying at more than one accommodation address.
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    <small>{{ __('Outward')}} </small>
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
                                    <small>{{ __('Outward')}} </small>
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
                                    <small>{{ __('Outward')}} </small>
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

                </div>
            </div>
        </div> --}}

    </div>

</div>

</div> {{-- /container --}}

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
