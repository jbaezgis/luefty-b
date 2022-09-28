@extends('layouts.app2')
@section('title', $location->name)
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 50%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('head')


@endsection

@section('content')
<?php function active($url){
    return request()->is($url) ? 'active' : '';
  }?>

@if( session()->has('error') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
{{-- <div class="position-relative overflow-hidden p-md-5 bg-light slider">
    <div class="row">
        <div class="col-md-12 p-5">
            <div class="row">
                <div class="col-md-12 text-center text-white custom-text-shaddow">
                    <h1 class="" >{{ __('WORLD\'S FIRST FAIR TRADE TOURISM AUCTIONS') }} </h1>
                    <p></p>
                    <h3 class="">{{ __('BIDS CAN BE 60% LESS BECAUSE OF EMPTY LEGS, EMPTY SEATS AND IDLE TIME') }} </h3>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="py-5 country-image " style="{{$request->has('to') ? 'min-height: 450px;' : 'min-height: 800px;'}} background-image: url('/images/home/locations/{{$region->slug}}.png');"> --}}
    <div class="py-5 country-image " style="background-image: url('/images/slide.png');">
    <div class="container"> 
        <div class="">
            <div class="parrot-flying d-none d-sm-none d-md-block"></div>
            <div class="row justify-content-center">
                @if ($request->has('to'))
                    <div class="col-md-8 d-none d-sm-none d-md-block">
                        <img src="{{asset('images/parrot/country_region_auctions_active.png')}}" height="300" alt="Luefty Parrot">
                    </div>

                    <div class="col-md-8 d-block d-sm-block d-md-none">
                        <img class="img-fluid" src="{{asset('images/parrot/country_region_auctions_active.png')}}" alt="Luefty Parrot">
                    </div>
                @else
                    <div class="col-md-12">
                        <h1 class="display-4 text-center text-white custom-text-shaddow-2">{{ $location->name }}</h1>
                        <div class="btn-group btn-block">
                            <a href="#" class="btn btn-lg font-weight-bold btn-primary" aria-current="page">{{_('Transfers')}}</a>
                            {{-- <a href="{{url('country/'.$country->slug.'/transfers')}}" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/transfers') ? 'btn-warning' : 'btn-light'}}" aria-current="page">{{_('Transfers')}}</a> --}}
                            @if ($request->location == 'Dominican Republic')
                                <a href="https://tours.luefty.com/destination/{{$location->country->slug}}" target="_blank" class="btn btn-lg font-weight-bold blue-border {{request()->is('country/'.$location->slug.'/tours') ? 'btn-primary' : 'btn-light'}}" aria-current="page">{{_('Tours')}}</a>
                            @else
                                <a href="https://tours.luefty.com/destination/{{$location->slug}}" target="_blank" class="btn btn-lg font-weight-bold blue-border {{request()->is('country/'.$location->slug.'/tours') ? 'btn-primary' : 'btn-light'}}" aria-current="page">{{_('Tours')}}</a>
                            @endif
                            {{-- <a href="#" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/flights') ? 'btn-primary' : 'btn-light'}}" aria-current="page">{{_('Charter Flights')}}</a> --}}
                        </div>

                        <div class="p-3 rounded mt-4">
                            {!! Form::open(['method' => 'GET', 'url' => 'country/'.$location->country->slug.'/'.'location/'.$location->slug.'/transfers', 'role' => 'search'])  !!}
                            {{-- {!! Form::open(['method' => 'POST', 'url' => '/booking/store', 'class' => '', 'role' => 'search'])  !!} --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control select2" id="from" name="from" required>
                                                <option value="" disabled selected class="font-weight-bolder">{{__('Pick up Location')}}</option>
                                                @foreach ($services_from_airports as $item)
                                                    <option value="{{$item->id}}" data-description="">{{$item->fromLocation->name}}</option>
                                                @endforeach
                                                @foreach ($services_from as $item)
                                                    <option value="{{$item->id}}" data-description="">{{$item->fromLocation->name}}</option>
                                                @endforeach
                                            </select>
                                            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
                                            <select class="form-control select2" id="to" name="to" disabled required>
                                                <option value="" disabled selected>{{__('Drop off Location')}}</option>
                                                
                                                @foreach ($services_to_airports as $item)
                                                    <option value="{{$item->id}}" data-description="">{{$item->toLocation->name}}</option>
                                                @endforeach
                                                @foreach ($services_to as $item)
                                                    <option value="{{$item->id}}" data-description="">{{$item->toLocation->name}}</option>
                                                @endforeach
                                            </select>
                                            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control datepicker2" id="date" name="date" aria-describedby="dateErrors" placeholder="{{ __('Pick up date')}}" required>
                                            <small id="dateError" class="form-text text-danger">{{ $errors->first('date') }} </small>
                                            <div class="invalid-feedback">
                                                {{ __('Arrival Date is required') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control datepicker2" id="return_date" name="return_date" aria-describedby="dateErrors" placeholder="{{ __('Add return')}}">
                                            <small id="dateError" class="form-text text-danger">{{ $errors->first('return_date') }} </small>
                                            <div class="invalid-feedback">
                                                {{ __('Departure Date is required') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control" id="passengers" name="passengers" value="{{ old('passengers') }}">
                                                <option value="1">1 {{__('Passenger')}}</option>
                                                <option value="2">2 {{__('Passengers')}}</option>
                                                <option value="3">3 {{__('Passengers')}}</option>
                                                <option value="4">4 {{__('Passengers')}}</option>
                                                <option value="5">5 {{__('Passengers')}}</option>
                                                <option value="6">6 {{__('Passengers')}}</option>
                                                <option value="7">7 {{__('Passengers')}}</option>
                                                <option value="8">8 {{__('Passengers')}}</option>
                                                <option value="9">9 {{__('Passengers')}}</option>
                                                <option value="10">10 {{__('Passengers')}}</option>
                                            </select>
                        
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-block font-weight-bolder" type="submit" title="{{ __('Search')}}">{{ __('Start Auction')}}</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="col-md-8 d-none d-sm-none d-md-block">
                        <img src="{{asset('images/parrot/country_region.png')}}" height="300" alt="Luefty Parrot">
                    </div>
    
                    <div class="col-md-8 d-block d-sm-block d-md-none">
                        <img class="img-fluid" src="{{asset('images/parrot/country_region.png')}}" alt="Luefty Parrot">
                    </div>
                @endif


                
            </div>
        </div>
    </div>
</div>



{{-- Transfers --}}
<div class="container">
    @if ($request->has('to'))

   {{-- PC --}}
   <div class="d-none d-sm-none d-md-block">

        <div class="d-flex flex-row">
                <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('From')}}:</span>
                    <span class="font-weight-bold">{{$service->fromLocation->name}} </span>
                </div>

                <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('To')}}:</span>
                    <span class="font-weight-bold">{{$service->toLocation->name}} </span>
                </div>

                <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('Pick up date')}}:</span>
                    <span class="font-weight-bold">{{$request->date}} </span>
                </div>
                @if($request->return_date)
                <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('Return date')}}:</span>
                    <span class="font-weight-bold">{{$request->return_date}} </span>
                </div>
                @endif
                <div class="p-2 pr-3 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('Passengers')}}:</span>
                    <span class="font-weight-bold">{{$request->passengers}} </span>
                </div>
            </div>
        </div>

        {{-- Mobile --}}
        <div class="d-block d-sm-block d-md-none">
            <div class="d-flex flex-row mb-2 ">
                <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('From')}}:</span>
                    <span class="font-weight-bold">{{$service->fromLocation->name}} </span>
                </div>

                <div class="p-2 pr-3 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('To')}}:</span>
                    <span class="font-weight-bold">{{$service->toLocation->name}} </span>
                </div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('Pick up date')}}:</span>
                    <span class="font-weight-bold">{{$request->date}} </span>
                </div>
                @if($request->return_date)
                <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('Return date')}}:</span>
                    <span class="font-weight-bold">{{$request->return_date}} </span>
                </div>
                @endif
                <div class="p-2 pr-3 flex-fill blue-border border-rounded">
                    <span class="text-primary font-weight-bolder">{{__('Passengers')}}:</span>
                    <span class="font-weight-bold">{{$request->passengers}} </span>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-4 d-none d-sm-none d-md-block">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="" data-toggle="modal" data-target="#exampleModal">
                            <img class="img-fluid" src="{{asset('images/video_thumb.png')}}" alt="Live Auction">
                        </a>
                    </div>
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        See Live Auctions
                    </button> --}}
                </div>
                <br>
                <!-- Button trigger modal -->
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Live Auction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                            <div class="modal-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    {{-- <iframe src="https://www.youtube.com/embed/iRVP57tl0U0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                    <video src="{{asset('videos/live_auctions.mp4')}}" controls autoplay loop></video>
                                </div>
                            </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>

                <a href="" data-toggle="modal" data-target="#exampleModal">
                    <img class="img-fluid" src="{{asset('images/parrot/left.png')}}" alt="Luefty Parrot">
                </a>
            </div>
            <div class="col-md-8">
                @foreach ($services_options as $item)
                <div class="shadow-sm vehicle-li mb-3 p-3">

                    <div class="d-flex">
                        <div class="p-2 mr-2 flex-fill blue-border border-rounded">
                            <span class="text-primary font-weight-bolder">{{__('Vehicle type')}}: </span> <span class="font-weight-bolder">{{ $item->vehicle->type }}</span>
                        </div>
                        <div class="p-2 mr-2 flex-fill blue-border border-rounded">
                            <span class="text-primary font-weight-bolder">{{__('Max passengers')}}: </span> <span class="font-weight-bolder">{{ $item->vehicle->max_passengers }}</span>
                        </div>
                        <div class="p-2 flex-fill blue-border border-rounded">
                            <span class="text-primary font-weight-bolder">{{__('Driving time')}}: </span> 
                            <span class="font-weight-bolder">
                                @if ($item->service->driving_time > 60)
                                    {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                @else
                                    {{date('i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center my-3">
                            <h5 class="text-primary">{{__('BOOK NOW TO SEE FIRST BID(S), 50% PRICE DROPS ARE NOT UNUSUAL!')}}</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 text-center">
                            @if ( $item->vehicle->type == 'Sedan')
                                <img class="" src="{{ asset('images/vehicles/Sedan.jpeg') }}" height="100" alt="Vehicle">
                            @elseif ($item->vehicle->type == 'Minivan')
                                <img class="" src="{{ asset('images/vehicles/Minivan.jpeg') }}" height="100" alt="Vehicle2">
                            @elseif ($item->vehicle->type == 'Minibus')
                                <img class="" src="{{ asset('images/vehicles/Minibus.jpeg') }}" height="100" alt="Vehicle3">
                            @elseif ($item->vehicle->type == 'Small Bus')
                                <img class="" src="{{ asset('images/vehicles/LargeVan.jpeg') }}" height="100" alt="Vehicle4">
                            @endif
                        </div>

                        <div class="col-md-6 pt-4">
                            @section('price')
                                {{ $percentaje = $item->oneway_price * 0.10}}
                                {{ $price = $item->oneway_price + $percentaje }}
                                {{ $rt_price = $price * 2 }}
                            @endsection
                            {!! Form::open(['method' => 'POST', 'url' => '/booking/store'])  !!}
                            {{-- {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!} --}}
            
                                {{ Form::hidden('service_id', $service->id) }}
                                {{ Form::hidden('from', $service->fromLocation->id) }}
                                {{ Form::hidden('to', $service->toLocation->id) }}
                                {{ Form::hidden('date', $request->date) }}
                                @if($request->return_date)
                                {{ Form::hidden('return_date', $request->return_date) }}
                                @endif
                                {{ Form::hidden('passengers', $request->passengers) }}
                                {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                {{ Form::hidden('service_price_id', $item->id) }}
            
                                {!! Form::button(__('CONTINUE!'), array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-primary btn-block btn-lg green-border font-weight-bolder',
                                        'title' => __('CONTINUE')
                                )) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>{{-- car option box --}}
                @endforeach
                {{-- end options results --}}

            </div>

            {{-- mobile --}}
            <div class="col-md-4 d-block d-sm-block d-md-none text-center">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="" data-toggle="modal" data-target="#modalmobile">
                            <img class="img-fluid" src="{{asset('images/video_thumb.png')}}" alt="Live Auction">
                        </a>
                    </div>
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalmobile">
                        See Live Auctions
                    </button> --}}
                </div>
                <br>
                <div class="modal fade" id="modalmobile" tabindex="-1" aria-labelledby="modalmobileLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalmobileLabel">Live Auction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                            <div class="modal-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    {{-- <iframe src="https://www.youtube.com/embed/iRVP57tl0U0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                    <video src="{{asset('videos/live_auctions.mp4')}}" controls autoplay loop></video>
                                </div>
                            </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                <a href="" data-toggle="modal" data-target="#modalmobile">
                    <img class="" src="{{asset('images/parrot/left.png')}}" height="350" alt="Luefty Parrot">
                </a>
            </div>
        </div>
    
    @else
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h2>{{__('MOST POPULAR TRANSFER OFFERS')}}</h2>
                <div class="divider my-3"></div>
            </div>
        </div>

        <div class="row">
            @foreach ($services_by_country as $item)
                <div class="col-md-4">
                    <div class="border rounded mb-4">
                        <img class="img-fluid" src="{{ asset('storage/images/locations/'.$item->toLocation->image) }}"alt="Vehicle"> <br>
                        <small class="text-muted pl-2"><i class="fa fa-globe" aria-hidden="true"></i> {{ $item->toLocation->name }}, {{ $item->toLocation->country->en_name }}</small>
                        <div class="body p-2 ">
                            <h5>
                                <span class="text-muted">{{__('From')}}</span> <span>{{ $item->fromLocation->name }}</span> <span class="text-muted">{{__('To')}}</span> <span>{{ $item->toLocation->name }}</span>
                            </h5>
                            {{-- <p></p> --}}
                            <div class="mb-2">
                                <span>
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    @if ($item->driving_time > 60)
                                        {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$item->driving_time))}}
                                    @else
                                        {{date('i'.' \m\i\n\s', mktime(0,$item->driving_time))}}
                                    @endif    
                                </span>
                            </div>
        
                            {{-- <div class="btn-group btn-group-toggle btn-block mb-2" data-toggle="buttons">
                                <label class="btn btn-light">
                                    <input type="radio" name="options" id="option1"> 
                                    <img class="img-fluid" src="{{ asset('images/vehicles/Sedan.jpeg') }}" width="80" alt="Vehicle"> <br>
                                    Max 3 passengers
                                </label>
                                <label class="btn btn-light">
                                    <input type="radio" name="options" id="option2"> 
                                    <img class="img-fluid" src="{{ asset('images/vehicles/Minivan.jpeg') }}" width="80" alt="Vehicle2"> <br>
                                    Max 7 passengers
                                </label>
                                <label class="btn btn-light">
                                    <input type="radio" name="options" id="option3"> 
                                    <img class="img-fluid" src="{{ asset('images/vehicles/Minibus.jpeg') }}" width="80" alt="Vehicle3"> <br>
                                    Max 14 passengers
                                </label>
                            </div> --}}
    
                            {{-- @section('starting_bid')
                                {{ $starting_bid = $services_prices->where('service_id', $item->s_id)->min('oneway_price')}}
                            @endsection
                            <div class="mb-2">
                                <span>starting bid</span>
                                <span class="starting-bid">${{ number_format($starting_bid, 2, '.', ',') }}</span>
                            </div> --}}
                            {{-- <br> --}}
        
                            {{-- <div class="text-center">
                                <a href="#" class="btn btn-primary">{{__('One Way')}}</a>
                                <a href="#" class="btn btn-primary">{{__('Round Trip')}}</a>
                            </div> --}}
                            {!! Form::open(['method' => 'GET', 'url' => 'country/dominican-republic/transfers', 'role' => 'search'])  !!}
                            {{-- {!! Form::open(['method' => 'POST', 'url' => '/booking/transfer', 'class' => '', 'role' => 'search'])  !!} --}}
                            
                                {{ Form::hidden('service_id', $item->s_id) }}
                                {{ Form::hidden('from', $item->fromLocation->id) }}
                                {{ Form::hidden('to', $item->toLocation->id) }}
                                {{-- {{ Form::hidden('service_price_id', $item->id) }} --}}
                                
                                <div class="d-flex">
                                    <div class="pt-1"><span class="">{{ __('Select passengers') }}:</span></div>
                                    <div class="pl-1">
                                        <select class="form-control" id="passengers" name="passengers" value="{{ old('passengers') }}">
                                            <option value="1">1 {{__('Passenger')}}</option>
                                            <option value="2">2 {{__('Passengers')}}</option>
                                            <option value="3">3 {{__('Passengers')}}</option>
                                            <option value="4">4 {{__('Passengers')}}</option>
                                            <option value="5">5 {{__('Passengers')}}</option>
                                            <option value="6">6 {{__('Passengers')}}</option>
                                            <option value="7">7 {{__('Passengers')}}</option>
                                            <option value="8">8 {{__('Passengers')}}</option>
                                            <option value="9">9 {{__('Passengers')}}</option>
                                            <option value="10">10 {{__('Passengers')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-block font-weight-bolder" type="submit" title="{{ __('Search')}}">{{ __('Start Auction')}}</button>
                                    {{-- <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-warning">
                                            <input type="checkbox" name="type" value="oneway" onchange="this.form.submit()"> {{ __('One-Way' ) }}
                                        </label>
                                        <label class="btn btn-warning">
                                            <input type="checkbox" name="type" value="roundtrip" onchange="this.form.submit()"> {{ __('Round-Trip') }}
                                        </label>
                                    </div> --}}
                                </div>
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    
    @endif
</div>

@endsection

@section('scripts')
<script>
    //  $('.input-number').inputSpinner()
    // $("input[type='number']").inputSpinner()

    $("#from").change(function() {
        $('#button').removeClass("desabled");
    });
</script>

<script>
    function fromValue(){
        $('select[name="from"]').on('change', function(){
            var inputVal = document.getElementById("from").value;
        });
    }
</script>

<script>
    function undisable_to() {
        var to = document.getElementById("to");
        to.removeAttr("disabled");
    }

    function undisable() {
        var oneway_btn = document.getElementById("oneway-btn");
        var roundtrip_btn = document.getElementById("roundtrip-btn");

        oneway_btn.classList.remove("disabled");
        roundtrip_btn.classList.remove("disabled");

        document.getElementById("oneway").disabled = false;
        document.getElementById("roundtrip").disabled = false;
    }

	// $(document).ready(function(){
    //     var oneway = document.getElementById("oneway").disabled = true;
    //     var roundtrip = document.getElementById("roundtrip").disabled = true;

	// 	$('select[name="to"]').on('change', function(){
    //         var oneway = document.getElementById("oneway").disabled = false;
    //         var roundtrip = document.getElementById("roundtrip").disabled = false;
	// 	});
	// });
</script>
<script>
	// $(document).ready(function(){

		$('select[name="from"]').on('change', function(){
            
            // $( "#to" ).prop( "disabled", false );
            //To enable 
            $('#to').removeAttr('disabled');

			var from = $(this).val();
            var APP_URL = $('meta[name="_base_url"]').attr('content');

			// if(from){
			// 	console.log(from);
			// 	$.ajax({
			// 		url: APP_URL+'/servicestoairports/' + from,
			// 		type: 'GET',
			// 		dataType: 'json',
			// 		success: function(data){
			// 			// console.log(data);
			// 			$('#to').empty();
			// 			$('#to').append('<option value="" disable="true" selected="true">Drop off Location</option>');

			// 			$.each(data, function(index, toObj){
			// 				$('#to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
			// 				// $('#tail-select-to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
            //                 // newAddItem.push({ key: toObj.id, value: toObj.name, description: "" })
			// 			})
			// 		}
			// 	});

            //     $.ajax({
			// 		url: APP_URL+'/servicesto/' + from,
			// 		type: 'GET',
			// 		dataType: 'json',
			// 		success: function(data){
            //             // $('#to').append('<option value="" disable="true" selected="true">Drop off Location</option>');
			// 			$.each(data, function(index, toObj){
			// 				$('#to').append('<option value="'+ toObj.id +'">' + toObj.name +'</option>');
			// 				// $('#tail-select-to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
            //                 // newAddItem.push({ key: toObj.id, value: toObj.name, description: "" })
			// 			})
			// 		}
			// 	});
			//}
		});

	// });
</script>

<script>
    // $(document).ready(function(){
    //     $('select[name="from"]').on('change', function(){
    //         let id = $(this).val();
    //         $('select[name="to"]').empty();
    //         $('select[name="to"]').append(`<option value="0" disabled selected>Processing...</option>`);
    //         $.ajax({
    //         type: 'GET',
    //         url: 'servicesto/' + id,
    //         success: function (response) {
    //         var response = JSON.parse(response);
    //         console.log(response);   
    //         $('select[name="to"]').empty();
    //         $('select[name="to"]').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
    //         response.forEach(toObj => {
    //             $('select[name="to"]').append(`<option value="${toObj['id']}">${toObj['name']}</option>`);
    //             });
    //         }
    //         });
    //     });
    // });
</script>

@endsection
