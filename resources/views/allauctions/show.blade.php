@extends('layouts.app2')

@section('content')
<br>
@section('best_bid')
    {{ $bestbid = $bids->where('auction_id', $auction->id)->min('bid') }}
    {{ $mybid2 = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->first() }}
    {{ $options = __('Example') . ': ' . __('If you select') . ' ' . '<b>' . '$5' . '</b>' . ' ' . __('and ') . '<b>' . __('Best bid') . ' = $' . $bestbid . '.00'.'</b>' . ', ' . __('your bid will be') . ' ' . '<b>' . '$' . ($bestbid - 5) . '.00' .'</b>' }}
    {{ $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid') }}
    {{ $starting_bid = $auction->starting_bid }}
    {{ $max = $starting_bid - 1 }}
    {{ $min = ($bestbid * 80)/100 }}

    @if ($bids->where('auction_id', $auction->id)->count() > 0)
        {{ $max = $starting_bid - 1 }}
        {{ $min = ($bestbid * 80)/100 }}
    @else
        {{ $max = $starting_bid - 1 }}
        {{ $min = ($starting_bid * 80)/100 }}
    @endif
@endsection
<div class="container">
    @if ($auction->type == 'roundtrip')
        <div class="row">
            <div class="col-md-8">
                <p class="lead text-muted">{{__('Booking ID:')}} <strong># {{$auction->service_number ? $auction->service_number : $auction->auction_id }}</strong>  ({{__('This is a Round-Trip')}})</p>
                {{-- Ida --}}
                <span class="text-primary"><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('l j, F Y', strtotime($auction->date)) }}, {{ date('g:i A', strtotime($auction->arrival_time)) }}</span>
                <h3 class="font-weight-light"><i class="fa fa-arrow-right" aria-hidden="true"></i> {{__('From')}} <strong>{{ $auction->fromcity->name }}</strong> {{__('To')}} <strong>{{ $auction->tocity->name }}</strong></h3>
                <hr>
                {{-- Vuelta --}}
                <span class="text-primary"><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('l j, F Y', strtotime($auction->return_date)) }}, {{ date('g:i A', strtotime($auction->pickup_time)) }}</span>
                <h3 class="font-weight-light"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('From')}} <strong>{{ $auction->tocity->name }}</strong> {{__('To')}} <strong>{{ $auction->fromcity->name }}</strong></h3>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class=" card-title d-flex justify-content-between align-items-center">
                            <span class="text-white">{{__('More details')}}</span>
                            {{-- <span class="badge badge-light badge-pill">3</span> --}}
                        </h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h5 class="my-0">{{__('Vehicle')}}</h5>
                                <span class="text-muted"></span>
                            </div>
                            <h5 class="text-muted">
                                {{$auction->vehicleType->type}} - {{$auction->vehicleType->max_passengers}} pax
                            </h5>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h5 class="my-0">{{__('Starting bid')}}</h5>
                                <span class="text-muted"></span>
                            </div>
                            <h5 class="text-muted">
                                {{ $auction->country->currency_symbol }}{{ number_format($auction->starting_bid, 2, '.', ',') }}
                            </h5>
                        </li>

                        {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h5 class="my-0">{{__('Starting bid')}}</h5>
                                <span class="text-muted"></span>
                            </div>
                            <h5 class="text-muted">
                                $ {{ number_format($auction->starting_bid, 2, '.', ',') }}
                            </h5>
                        </li> --}}
                    </ul>
                </div>
                

                @if ($auction->extras->count())
                    <div class="card">
                        <div class="card-header">
                            <h4 class=" card-title d-flex justify-content-between align-items-center">
                                <span class="">{{__('Extras')}}</span>
                                {{-- <span class="badge badge-light badge-pill">3</span> --}}
                            </h4>
                        </div>
                        <div class="card-body">
                            @foreach ($auction->extras as $extra)
                                {{$extra->quantity}} <strong>{{$extra->name}}</strong><br>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
        </div>
        {{-- <div class="row">
            <div class="col-md-12">
                <hr>
                <span><strong>{{__('More information')}} </strong></span>
                <p>{{$auction->more_information}} </p>
                <span><strong>{{__('Return more information')}} </strong></span>
                <p>{{$auction->return_more_information}} </p>
                <hr>
            </div>
        </div> --}}

    @else
        <div class="row">
            <div class="col-md-12">
                <p class="lead text-muted">{{__('Booking ID:')}} <strong># {{$auction->service_number ? $auction->service_number : $auction->auction_id }}</strong></p>
                @if ($auction->category->code == 'private')
                    <span class="text-primary"><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('l j, F Y', strtotime($auction->date)) }}, {{ date('g:i A', strtotime($auction->time)) }}</span>
                @elseif ($auction->category->code == 'booking_auction')
                    <span class="text-primary"><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('l j, F Y', strtotime($auction->date)) }}, {{ date('g:i A', strtotime($auction->arrival_time)) }}</span>
                @endif
                <h3 class="font-weight-light"> 
                    {{__('From')}} <strong>{{ $auction->fromcity->name }}</strong> {{__('To')}} <strong>{{ $auction->tocity->name }}</strong>
                </h3>
                    
                {{-- <p class="lead">{{__('Category')}}: <strong class="text-primary">{{__('Private')}} </strong> </p> --}}
                
                @if ($auction->category->code == 'private')
                    <p>
                        {{-- <span class=""># {{ $auction->service_number }}</span> | --}}
                        {{-- <span class="mr-2"><strong>{{ date('l j, F Y', strtotime($auction->date)) }}, {{ date('g:i A', strtotime($auction->arrival_time)) }}</strong></span> --}}
                        {{-- <span class="text-danger"><strong>{{ $auction->vehicle->name }}</strong></span> --}}
                
                        @if ($auction->passengers)
                            {{ __('People') }}: <span class="text-danger"><strong>{{ $auction->passengers }}</strong></span>
                        @endif
                        
                        @if($auction->status == 'Closed' and $won->won == 1)
                        | <span class="text-success" data-toggle="tooltip" data-placement="top" title="{{ __('This is your') }}">{{ __('Your bid') }}: <span class=""><strong>{{ $auction->country->currency_symbol }}{{ number_format($mybid, 2, '.', ',') }}</strong></span> <i class="fa fa-check" aria-hidden="true"></i></span>
                        @else
                        |
                        {{-- Current bid --}}
                            @if ($bids->where('auction_id', $auction->id)->count() > 0)
                                <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $auction->country->currency_symbol }}{{ number_format($bids->where('auction_id', $auction->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
                            @else
                                <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $auction->country->currency_symbol }}{{ number_format($auction->starting_bid, 2, '.', ',') }}</strong></span></span>
                            @endif
                        @endif
                    </p>
                    
                    <hr>
                    <span><strong>{{__('More information')}} </strong></span>
                    <p>{{$auction->more_information}} </p>
                    <hr>
                    
                @elseif ($auction->category->code == 'booking')
                
                @elseif ($auction->category->code == 'booking_auction')
                    <p>
                        {{-- <span class=""># {{ $auction->auction_id }}</span> |
                        <span class="mr-2">{{__('Date')}}: <strong>{{ date('l j, F Y', strtotime($auction->date)) }}</strong>, {{__('Arrival time')}}: <strong>{{ date('g:i A', strtotime($auction->arrival_time)) }}</strong></span> | --}}
                        
                        <span class="">{{ __('Starting bid') }}: <strong>{{ $auction->country->currency_symbol }}{{ number_format($auction->starting_bid, 2, '.', ',') }}</strong></span> 
                    
                        @if($auction->status == 'Closed' and $won->won == 1)
                        | <span class="text-success" data-toggle="tooltip" data-placement="top" title="{{ __('This is your') }}">{{ __('Your bid') }}: <span class=""><strong>{{ $auction->country->currency_symbol }}{{ number_format($mybid, 2, '.', ',') }}</strong></span> <i class="fa fa-check" aria-hidden="true"></i></span>
                        @else
                            {{-- Current bid --}}
                            @if ($auction->category->code == 'private')
                                @if ($bids->where('auction_id', $auction->id)->count() > 0)
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $auction->country->currency_symbol }}{{ number_format($bids->where('auction_id', $auction->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
                                @else
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $auction->country->currency_symbol }}{{ number_format($auction->starting_bid, 2, '.', ',') }}</strong></span></span>
                                @endif
                            @endif
                        
                            @if ($auction->bids->count() > 0)
                            |
                                <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $auction->country->currency_symbol }}{{ number_format($auction->bids->min('bid'), 2, '.', ',') }}</strong></span></span>
                            @endif
                        @endif
                    </p>
                @endif
                
                @if ($auction->extras->count())
                <hr>
                <span>{{__('Extras')}}: </span><br>
                    @foreach ($auction->extras as $extra)
                        {{$extra->quantity}} <strong>{{$extra->name}}</strong><br>
                    @endforeach
                    <hr>
                @endif
            </div>{{-- /col-md-12 --}}
            
        </div>{{-- /row --}}
    @endif


<div class="row">
        <div class="col-md-12">
            @if($auction->status == 'Closed' and $won->won == 1)
            <hr>
                <h4 class="text-success">{{__('You won this Auctions!')}}</h4>
                <h5>{{__('Details')}}:</h5>
                {{-- <span><strong>{{__('More information')}} </strong></span> --}}
                @if ($auction->category->code == 'private')
                    <p>{{$auction->more_information}} </p>
                @elseif ($auction->category->code == 'booking_auction')
                    <div class="d-flex flex-row">
                        <div class="p-2 pr-3">
                            <small class="font-weight-bold text-uppercase text-muted">{{__('Name')}}</small> <br>
                            <span class="font-weight-bold">{{$auction->full_name}} </span>
                        </div>

                        <div class="p-2 pr-3">
                            <small class="font-weight-bold text-uppercase text-muted">{{__('Email')}}</small> <br>
                            <span class="font-weight-bold">{{$auction->email}}</span>
                        </div>

                        <div class="p-2 pr-3">
                            <small class="font-weight-bold text-uppercase text-muted">{{__('Phone')}}</small> <br>
                            <span class="font-weight-bold">{{$auction->phone}}</span>
                        </div>
                    </div>

                    @if($auction->type == 'roundtrip')
                        {{-- Round trip info --}}
                        <hr>
                        <h5>{{__('Going')}} </h5>
                        <div class="d-flex flex-row">
                            <div class="p-2 pr-3">
                                <small class="font-weight-bold text-uppercase text-muted">{{__('Flight arrival')}}</small> <br>
                                <span class="font-weight-bold">{{$auction->date}}, {{ date('g:ia', strtotime($auction->arrival_time)) }}</span>
                            </div>
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
                        <h5>{{__('Return')}} </h5>
                        <div class="d-flex flex-row">
                            <div class="p-2 pr-3">
                                <small class="font-weight-bold text-uppercase text-muted">{{__('Flight arrival')}}</small> <br>
                                <span class="font-weight-bold">{{$auction->return_date}}, {{ date('g:ia', strtotime($auction->return_time)) }}</span>
                            </div>
            
                            <div class="p-2 pr-3">
                                <small class="font-weight-bold text-uppercase text-muted">{{__('Pickup Time')}}</small> <br>
                                <span class="font-weight-bold">{{ date('g:ia', strtotime($auction->pickup_time)) }}</span>
                            </div>
                            
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
                    @else
                        {{-- One way info --}}
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
                    @endif
                @endif
            @endif

            @if ($auction->status == 'Closed')
            <hr>
                <div class="text-center">
                    {{__('This Auction is closed, please')}} <a href="{{url('suppliers/index')}} " class="">{{__('click here')}}</a> {{__('to find open auctions.')}}
                </div>
            @endif
        </div>
        <div class="col-md-6 mb-5">
            @if ($auction->status == 'Closed')
                
            @else
            <form method="POST" class="needs-validation" action="{{ route('bids.bookingbid') }}" novalidate>
                {{ csrf_field() }}
                <input type="hidden" id="auction_id" name="auction_id" value="{{ $auction->id }} ">
                <div class="d-flex flex-row">
                    <div class="flex-fill">
                        @if ($auction->category->code == 'private')
                        <div class="input-group ">
                            <div class="input-group-prepend" style="display: block;">
                                <div class="input-group-text">{{ $auction->country->currency_symbol }}</div>
                            </div>
                            <input type="number" step=".01" min="{{ $min }}" max="{{ $max }}" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>
                            <br>
                            <div class="invalid-feedback">
                                {{ __('Your bid must be between') }} <strong>{{ $auction->country->currency_symbol }}{{ number_format($min, 0, '.', ',') }}</strong> {{ __('and') }} <strong>${{ number_format($max, 0, '.', ',') }}</strong>
                            </div>
                        </div>
                        @elseif ($auction->category->code == 'booking_auction')
                        <div class="input-group ">
                            <div class="input-group-prepend" style="display: block;">
                                <div class="input-group-text">{{ $auction->country->currency_symbol }}</div>
                            </div>
                            <input type="number" step=".01" min="{{ $min }}" max="{{ $max }}" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>
                            <br>
                            <div class="invalid-feedback">
                                {{ __('Your bid must be between') }} <strong>{{ $auction->country->currency_symbol }}{{ number_format($min, 0, '.', ',') }}</strong> {{ __('and') }} <strong>{{ $auction->country->currency_symbol }}{{ number_format($max, 0, '.', ',') }}</strong>
                            </div>
                        </div>
                        @elseif ($auction->category->code == 'shared')
                        <div class="d-flex flex-row bd-highlight">
                            <div class="input-group  mr-1 w-50">
                                <div class="input-group-prepend" style="display: block;">
                                <div class="input-group-text">{{ $auction->country->currency_symbol }}</div>
                                </div>
                                <input type="number" step=".01" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>
                                <div class="invalid-feedback">
                                    {{ __('Please enter your bid.') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}" id="seats" name="seats" value="{{ old('seats') }}" placeholder="{{ __('Seats')}}" aria-describedby="seatsErrors" required>
                                @if($errors->any())
                                    <small id="seatsErrors" class="form-text text-danger">{{ $errors->first('seats') }}</small>
                                @endif
                                <div class="invalid-feedback">
                                    {{ __('Required.') }}
                                </div>
                            </div>
                        </div>
                        @elseif ($auction->category->code == 'contract')
                            <input type="number" step=".01" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>
                            <br>
                            <div class="invalid-feedback">
                                {{ __('Please enter your bid.') }}
                            </div>
                        @endif

                    </div>
                    <div class="flex-fill pl-2">
                        
                            <div class="">
                                <button type="submit" class="btn btn-primary mr-2 d-none d-sm-block">{{ __('Make your bid')}}</button>
                                <button type="submit" class="btn btn-primary mr-2 d-block d-sm-none"><i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                            <div class="">
                                <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('Enter your Bid here')}}"></a>
                            </div>
                        

                    </div>
                </div>
            </form>
            @endif
        </div>

        @if ($auction->status == 'Closed')
        @else
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border"><h4>{{__('Bids')}} {{-- ({{ $auction->bids->count() }}) --}}</h4></div>
                <div class="box-body">
                    @if (auth()->check())

                    {{-- <h5>{{ __('Other users')}} </h5> --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >{{ __('Bid') }}</th>
                                    @if ($auction->category_id === 2)
                                    <th>{{ __('Seats') }} </th>
                                    @endif
                                    <th>
                                        {{ __('Amount')}}
                                    </th>
                                    @if ($auction->category_id === 2)
                                    <th>{{ __('Total') }} </th>
                                    @endif
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($bids as $key => $bid)
                                {{-- @if () --}}
                                <tr class="">
                                        
                                        @if ($bid->user->id == auth()->user()->id )
                                            <td>
                                                {{ $bid->user->name }}
                                            </td>
                                        @else
                                            <td>
                                                {{__('Bid')}} {{ $key+1}}
                                            </td>
                                        @endif

                                    @if ($auction->category_id === 2)
                                    <td>{{ $bid->seats }}</td>
                                    @endif
                                    <td>
                                        @if (Auth::user()->hasRole('admin') && $bid->user->name == 'Dominican Shuttles')
                                            <i class="fa fa-circle text-primary"></i>
                                        @endif
                                            {{ $auction->country->currency_symbol }}{{ number_format($bid->bid, 2, '.', ',') }}
                                        @if ($bid->user->id == auth()->user()->id )
                                            <span class="badge badge-primary">{{ __('My bid')}} </span>
                                        @endif
                                    </td>
                                    @if ($auction->category_id === 2)
                                    <td>{{ $auction->country->currency_symbol }}{{ number_format($bid->total, 2, '.', ',') }}</td>
                                    @endif
                                    <td>
                                        @if ($auction->status == 'Closed' and $bid->won === 1)
                                            <span class="badge badge-success">{{ __('Accepted')}} </span>
                                        @else
                                            @if ($bid->user_id === Auth::user()->id)
                                            <!-- <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash-o"></i></a> -->
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/bids', $bid->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'data-toggle'=>'tooltip',
                                                        'data-placement'=>'top',
                                                        'title'=>__('Delete Bid?'),
                                                        'class' => 'btn btn-danger btn-sm'
                                                        // 'title' => 'Delete Bid'
                                                        // 'onclick'=>'return confirm("Confirm?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

</div>
    </div>

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


