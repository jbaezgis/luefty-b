@extends('layouts.app2')
@section('title', __('Home'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
{{-- Slider --}}
{{-- <div id="carouselExampleCaptions" class="carousel slide carousel-fade d-none d-sm-block" data-ride="carousel">
    <div class="row mx-0 justify-content-center">
        <div class="col-md-8 text-center text-white custom-text-shaddow">
            <div class="carousel-text py-3">
                <h1 class="" >{{ __('WORLD\'S FIRST FAIR TRADE TOURISM AUCTIONS') }} </h1>
                <p></p>
                <h3 class="">{{ __('BIDS CAN BE 60% LESS BECAUSE OF EMPTY LEGS, EMPTY SEATS AND IDLE TIME') }} </h3>

            </div>
        </div>
    </div>

    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        @foreach ($sliders as $key => $item)
            <li data-target="#carouselExampleCaptions" data-slide-to="{{$key+1}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{URL::asset('storage/images/sliders/'. $first_slider->image)}}" class="d-block w-100" alt="{{$first_slider->title}}">
            <div class="carousel-caption d-none d-md-block">
                
            </div>
        </div>

        @foreach ($sliders as $item)
            <div class="carousel-item">
                <img src="{{URL::asset('storage/images/sliders/'. $item->image)}}" class="d-block w-100" alt="{{$item->title}}">
                <div class="carousel-caption d-none d-md-block">
                    
                </div>
            </div>
            
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div> --}}

{{-- Slider for mobile --}}
{{-- <div id="carouselExampleCaptions" class="carousel slide d-block d-sm-none" data-ride="carousel">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center text-white custom-text-shaddow">
            <div class="carousel-text py-3">
                <h3 class="" >{{ __('WORLD\'S FIRST FAIR TRADE TOURISM AUCTIONS') }} </h3>
                <p></p>
                <h5 class="">{{ __('BIDS CAN BE 60% LESS BECAUSE OF EMPTY LEGS, EMPTY SEATS AND IDLE TIME') }} </h5>

            </div>
        </div>
    </div>

    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        @foreach ($sliders as $key => $item)
            <li data-target="#carouselExampleCaptions" data-slide-to="{{$key+1}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{URL::asset('storage/images/sliders/mobile/'. $first_slider->image)}}" class="d-block w-100" alt="{{$first_slider->title}}">
            <div class="carousel-caption d-none d-md-block">
               
            </div>
        </div>

        @foreach ($sliders as $item)
            <div class="carousel-item">
                <img src="{{URL::asset('storage/images/sliders/mobile/'. $item->image)}}" class="d-block w-100" alt="{{$item->title}}">
                <div class="carousel-caption d-none d-md-block">
                    
                </div>
            </div>
            
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div> --}}

@if( session()->has('error') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="position-relative overflow-hidden p-md-5 bg-light slider">
    {{-- <div class="row">
        <div class="col-md-12 p-5">
            <div class="row">
                <div class="col-md-12 text-center text-white custom-text-shaddow">
                    <h1 class="" >{{ __('WORLD\'S FIRST FAIR TRADE TOURISM AUCTIONS') }} </h1>
                    <p></p>
                    <h3 class="">{{ __('BIDS CAN BE 60% LESS BECAUSE OF EMPTY LEGS, EMPTY SEATS AND IDLE TIME') }} </h3>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<div class="row mb-4">
    <div class="col-md-12 text-center py-4 bg-warning">
        <h4>{{__('Only the best suppliers referenced by the largest companies are invited to bid on our auctions for your bookings')}}</h4>
        {{-- <p>{{__('You\'ll receive a full refund if you cancel at least 24 hours in advance of most experiences.')}}</p> --}}
    </div>
</div>

{{-- <div class="py-4 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="transfers-tab" data-toggle="tab" href="#transfers" role="tab" aria-controls="transfers" aria-selected="true">
                            <h5 class="mb-0">{{__('Transfers')}}</h5>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tours-tab" data-toggle="tab" href="#tours" role="tab" aria-controls="tours" aria-selected="false">
                            <h5 class="mb-0">{{__('Tours')}}</h5>
                        </a>
                    </li>
                </ul>
                <div class="tab-content bg-info-light " id="myTabContent">
                    <div class="tab-pane fade show active" id="transfers" role="tabpanel" aria-labelledby="home-tab">
                       
                        <div class="bg-info-light py-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center py-2">
                                        <h3 class="" >{{__('YOUR BOOKING IS BID ON BY MANY SUPPLIERS. OFTEN BIDS ARE 60% LESS')}}</h3>
                                    </div>
                                </div>
                                {!! Form::open(['method' => 'POST', 'url' => '/booking/store', 'class' => '', 'role' => 'search'])  !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="form-control select2" id="from" name="from" required>
                                                    <option value="" disabled selected>{{__('Pick up Location')}}</option>
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
                                            <button class="btn btn-warning btn-block font-weight-bolder" type="submit" title="{{ __('Search')}}">{{ __('Search')}} <i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tours" role="tabpanel" aria-labelledby="profile-tab">Trous</div>
                </div>
            </div>
        </div>
        
    </div>
</div> --}}

<div class="container mb-5">
    <div class="row">
        <div class="col-md-3 text-center">
            <div class="p-2"><img class="img-fluid" src="{{asset('images/home/hombre.svg')}} " width="40" alt="man"></div>
            <span>{{__('Meet & greet')}}</span>
            {{-- <small class="text-muted">
                {{__('You are dealing directly with your supplier. There simply is no better service!')}}
            </small> --}}
        </div>
        <div class="col-md-3 text-center">
            <div class="p-2"><img class="img-fluid" src="{{asset('images/home/dinero.svg')}} " width="40" alt="money"></div>
            <span>{{__('No contest pricing')}}</span>
            {{-- <small class="text-muted">
                {{__('There is no value in the travel business that can beat Luefty. We guarantee that!')}}
            </small> --}}
        </div>
        <div class="col-md-3 text-center">
            <div class="p-2"><img class="img-fluid" src="{{asset('images/home/hora.svg')}} " width="40" alt="time"></div>
            <span>{{__('Fastest Booking')}}</span>
            {{-- <small class="text-muted">
                {{__('If you have booked with Luefty you know how quick and simple it is. Transparent prices. No hidden fees, and by far the lowest prices in the market.')}}
            </small> --}}
        </div>
        <div class="col-md-3 text-center">
            <div class="p-2"><img class="img-fluid" src="{{asset('images/home/playa.svg')}} " width="40" alt="playa"></div>
            <span>{{__('Home to Vacation')}}</span>
            {{-- <small class="text-muted">
                {{__('From your home to your hotel or apartment. You book with the local supplier, you chat with the local supplier and they care for you on your vacation.')}}
            </small> --}}
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-4 justify-content-center">
        <div class="col-md-9 text-center">
            <div class="bg-warning p-2 rounded">
                <h3 class="text-primary">{{__('Popular destinations, tours and transfers')}}</h3>
            </div>
            {{-- <h2>{{__('Popular')}} <span class="text-yellow-luefty">{{__('Destinations')}} </span></h2> --}}
            {{-- <div class="divider my-3"></div> --}}
            {{-- <span class="text-muted">{{__('World\'s best tourist destinations')}}</span> --}}
        </div>
    </div>
    <div class="row mb-4">
        {{-- <div class="col-md-4">
        </div> --}}
        <div class="col-md-12">
            <div class="row">
                @foreach ($countries as $item)
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/'.$item->slug.'/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('storage/images/countries/'.$item->id.'/thumb/'.$item->image)}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2 text-yellow-luefty">{{$item->en_name}}</h4>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Whales options --}}
{{-- <div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <img class="rounded img-fluid" src="{{URL::asset('img/whales/whales_siteRecurso_6image_.png')}}" alt=""> <br>
                    <h4>{{(__('Humpback Whales of Samana'))}}</h4>
                    <span class="text-muted">Every year around the 15th of January, like clockwork, the famous Humpback whales of Samana arrive, having traveled all the way from the North Atlantic to relax and frolic in the warm waters of the Caribbean, a bit like you and me!</span>
                    <p></p>
                    <a href="{{url('whales')}} " class="btn btn-primary">{{__('More details')}}</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                @foreach ($whales as $item)
                    <div class="col-md-4 mb-2">
                        <div class="card">
                                <a href="{{url('whales/'.$item->slug)}}">
                                    <img src="{{asset('storage/images/whales/'.$item->image)}}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                <h5 class="card-title ">{{$item->title}}</h5><br>
                                <small>{{__('from')}}</small> <strong>${{ number_format($item->price, 2, '.', ',') }}</strong>
                                </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-ticket fa-lg" aria-hidden="true"></i> <br>
            345,000+ Things to Do
        </div>
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i> <br>
            Millions of Reviews
        </div>
        <div class="col-md-3 text-center text-muted py-4">
            <i class="fa fa-tag fa-lg" aria-hidden="true"></i> <br>
            Lowest Price Guarantee
        </div>
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> <br>
            24/7 Global Support
        </div>
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-tripadvisor fa-lg" aria-hidden="true"></i> <br>
            A Tripadvisor Company
        </div>
    </div>
</div> --}}

{{-- <div class="row my-4">
    <div class="col-md-12 text-center py-4 bg-info-light">
        <h2>{{__('WORLD\'S FIRST FAIR TRADE TOURISM AUCTIONS')}}</h2>
        <p class="lead text-muted">{{__('Bids can be 60% less because of empty legs, empty seats and idle time.')}}</p>
    </div>
</div> --}}

<div class="container">
    <div class="row py-5">
        <div class="col-md-12 text-center">
            <div class="bg-warning p-2 rounded">
                <h3 class="text-primary">{{__('Recomendated Tours')}}</h3>
            </div>
            {{-- <h2>{{__('Dominican Republic')}} <span class="text-yellow-luefty">{{__('Attractions')}} </span></h2>
            <div class="divider my-3"></div> --}}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        {{-- <div class="col-md-5">
            <div class="p2">
                <a href="{{url('attraction/'. $last_attraction->slug)}}">
                    <img src="{{URL::asset('storage/images/attractions/'. $last_attraction->image)}}" class="rounded-lg img-fluid" alt="{{$last_attraction->image}}">
                </a>
                <div class="py-1 ">
                    <div class="text-truncate">
                        <span class="">{{$last_attraction->title}}</span>
                    </div>
                    <small class="text-muted">{{$last_attraction->tours->count()}} {{__('Tours and Activity')}}</small><br>
                </div>
            </div>
        </div> --}}
        <div class="col-md-7">
        </div>
        <div class="row">
            @foreach($attractions as $item)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <a href="{{url('country/'.$item->country->slug.'/'. $item->slug.'/attraction')}}">
                            <img src="{{URL::asset('storage/images/attractions/'. $item->image)}}" class="img-fluid" alt="{{$item->image}}">
                        </a>
                        {{-- <div class="attraction-count bg-warning px-2 rounded-left">
                            <span >{{$item->tours->count()}} {{__('Tours and Activity')}}</span><br>
                        </div> --}}
                        <div class="attraction-body pl-2">
                            {{-- <h5 class="text-white">{{$item->title}}</h5> --}}
                            <h5 class="custom-text-shaddow-2 text-yellow-luefty">{{$item->title}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="#" class="btn btn-light btn-block btn-lg"> {{__('SEE MORE')}}</a>
        </div>
    </div> --}}
    
</div>

{{-- Why book your transfers with Luefty? --}}
{{-- <div class="py-2">
    <div class="container">
        <div class="row pb-3">
            <div class="col-md-12 text-center">
                <h3 class="">{{__('Why book your transfers with Luefty?')}}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="p-2"><img class="img-fluid" src="{{asset('images/home/pagar.svg')}} " width="60" alt="pay"></div>
                <div class="p-2">
                    <span class="text-info">{{__('Direct Sale')}}</span><br>
                    <small class="text-muted">{{__('You are buying direct from the carefully selected local suppliers. Your saving will be up to 60% because there are no intermediaries.')}}</small>
                </div>

            </div>
            <div class="col-md">
                <div class="p-2"><img class="img-fluid" src="{{asset('images/home/cerdo.svg')}} " width="60" alt="pork"></div>
                <div class="p-2">
                    <span class="text-info">{{__('Auction Pricing')}}</span><br>
                    <small class="text-muted">{{__('You can Buy Now or Join the Luefty Auctions and save tons of money. In the Auctions suppliers are happy to offer incredible prices because that is better than driving home empty or standing idle.')}}</small>
                </div>
            </div>
            <div class="col-md">
                <div class="p-2"><img class="img-fluid" src="{{asset('images/home/descuento.svg')}} " width="60" alt="desc"></div>
                <span class="text-info">{{__('Fair Trade')}}</span><br>
                <small class="text-muted">{{__('The drivers and suppliers in our auction keep 100% of their price and drive when they want to. No more huge margins going to intermediariesl You win, the local business wins and Luefty wins. This is Fair Trade.')}}</small>
                
            </div>
        </div>
        <hr>
    </div>
</div> --}}

{{-- <div class="container">
    <div class="row py-4">
        <div class="col-md-12 text-center">
            <h3>{{__('Top Destinations')}}</h3>
        </div>
    </div>
</div> --}}

{{-- <div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="row">
                @foreach ($locations as $item)
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url($item->slug)}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('storage/images/locations/'.$item->image)}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay text-center">
                            <h5 class=" pt-5 custom-text-shaddow">{{$item->name}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div> --}}

<div class="row my-4">
    <div class="col-md-12 text-center py-4 bg-warning">
        <h2>{{__('World\'s First Fair Trade Tourism Auctions')}}</h2>
        <p>{{__('Prices as low at 40% with the very best suppliers because you buy DIRECT with us! No agency fees.')}}</p>
    </div>
</div>

{{-- Transfers --}}
<div class="container">
    {{-- <div class="row my-5">
        <div class="col-md-12 text-center">
            <div class="bg-warning p-2 rounded">
                <h3 class="text-primary">{{__('Private Transfers')}}</h3>
            </div>
            <h2>{{__('Private')}} <span class="text-yellow-luefty">{{__('Transfers')}} </span></h2>
            <div class="divider my-3"></div>
            <span class="text-muted">{{__('World\'s best tourist destinations')}}</span>
        </div>
    </div> --}}

    {{-- <div class="row">
        @foreach ($services_by_country as $item)
            <div class="col-md-4">
                <div class="border rounded mb-4">
                    <img class="img-fluid" src="{{ asset('storage/images/locations/'.$item->toLocation->image) }}"alt="Vehicle"> <br>
                    <small class="text-muted pl-2"><i class="fa fa-globe" aria-hidden="true"></i> {{ $item->toLocation->name }}, {{ $item->toLocation->country->en_name }}</small>
                    <div class="body p-2 ">
                        <span class="text-muted">{{__('From')}}</span> <span>{{ $item->fromLocation->name }}</span> <span class="text-muted">{{__('To')}}</span> <span>{{ $item->toLocation->name }}</span>
                        <p></p>
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

                        {!! Form::open(['method' => 'POST', 'url' => '/booking/transfer', 'class' => '', 'role' => 'search'])  !!}
                        
                            {{ Form::hidden('service_id', $item->s_id) }}
                            {{ Form::hidden('from', $item->fromLocation->id) }}
                            {{ Form::hidden('to', $item->toLocation->id) }}

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
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-warning">
                                        <input type="checkbox" name="type" value="oneway" onchange="this.form.submit()"> {{ __('One-Way' ) }}
                                    </label>
                                    <label class="btn btn-warning">
                                        <input type="checkbox" name="type" value="roundtrip" onchange="this.form.submit()"> {{ __('Round-Trip') }}
                                    </label>
                                </div>
                            </div>
                            
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}

</div>

{{-- <div class="row my-5">
    <div class="col-md-12 text-center">
        <h2>{{__('Top')}} <span class="text-yellow-luefty">{{__('Tours')}}</h2>
        <div class="divider my-3"></div>
    </div>
</div> --}}

<div class="container">

    <div class="row">
        {{-- Last Tour --}}
        <div class="col-md-8">
            <div class="card shadow">
                <div class="row">
                    <div class="col-md-5 pr-0">
                        <img src="{{URL::asset('storage/images/tours/thumbs/'. $last_tour->image)}}" class="img-fluid" alt="{{$last_tour->image}}">
                        {{-- <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{asset('storage/images/tours/thumbs/'. $last_tour->image)}}" class="d-block w-100" alt="...">
                                </div>
                                @foreach ($last_tour->images as $image)
                                    <div class="carousel-item">
                                        <img src="{{asset('storage/images/tours/'. $last_tour->id .'/'. $image->file_name)}}" class="d-block w-100" alt="...">
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-7 pl-0">
                        <div class="p-2 flex-fill bd-highlight">
                            {{-- <a href="#" class="btn btn-light btn-sm"><i class="fa fa-share" aria-hidden="true"></i> {{__('Share Tour')}} </a> --}}
                            <h2 class="">{{$last_tour->title}}</h2>
                            <small class="text-muted"><i class="fa fa-globe" aria-hidden="true"></i> {{ $last_tour->attraction->title }}, {{ $last_tour->location->country->en_name }}</small>
                            <div class="d-flex border-top mt-2 mb-2">
                                <div class="p-2 mr-3">
                                    <small class="text-muted">{{__('DURATION')}}</small><br>
                                    <span>{{$last_tour->duration}}</span>
                                </div>
                                <div class="p-2">
                                    <small class="text-muted">{{__('AVAILABILITY')}}</small><br>
                                    <span>{{__('All Months')}}</span>
                                </div>
                                {{-- <div class="p-2">
                                    <small class="text-muted">{{__('DEPARTURE')}}</small><br>
                                    <span>{{$last_tour->depLocation->name}} {{__('at')}} {{ date('g:i A', strtotime($last_tour->departure_time)) }}</span>
                                </div> --}}
                            </div>

                            <div class="d-flex border-bottom mt-2 mb-2">
                                <div class="p-2 mr-3">
                                    <small class="text-muted">{{__('DEPARTURE')}}</small><br>
                                    <span>{{$last_tour->depLocation->name}}</span>
                                </div>
                                <div class="p-2">
                                    <small class="text-muted">{{__('DEPARTURE TIME')}}</small><br>
                                    <span>{{__('at')}} {{ date('g:i A', strtotime($last_tour->departure_time)) }}</span>
                                </div>
                            </div>

                            {{-- <h5>{{__('Overview')}}</h5> --}}
                            {{-- <span>{{$last_tour->short_description}}</span> --}}

                            <div class="d-flex">
                                <div class="p-2 mr-4">
                                    <span class="text-muted">{{__('Adults')}}</span><br>
                                    <h2 class="">${{ number_format($last_tour->adults_price, 2, '.', ',') }}</h2>
                                </div>
                                <div class="p-2">
                                    <span class="text-muted">{{__('Children')}}</span><br>
                                    <h2 class="">${{ number_format($last_tour->children_price, 2, '.', ',') }}</h2>
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{url('country/'.$last_tour->country->slug.'/'. $last_tour->slug.'/tour')}}" class="btn btn-warning">{{__('BOOK NOW')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex bd-highlight">
                    <div class="p-2 flex-fill bd-highlight">
                    </div>
                    
                </div> --}}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                
            </div>
        </div>
        @foreach($tours as $item)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="tour-image">
                        <div class="tour-photos-count px-3 py-1 bg-light"><small>{{$item->images->count()}} {{__('photos')}}</small></div>
                        <div class="tour-image">
                            <a href="{{url('country/'.$item->country->slug.'/'. $item->slug.'/tour')}}">
                                <img src="{{URL::asset('storage/images/tours/thumbs/'. $item->image)}}" class="card-img-top" alt="{{$item->image}}">
                            </a>
                        </div>
                    </div>
                    
                    <div class="tour-body p-2">
                        <h4 class="text-white custom-text-shaddow">{{$item->title}}</h4>
                        <small class="text-white text-shadow "><i class="fa fa-globe" aria-hidden="true"></i> {{ $item->attraction->title }}, {{ $item->location->country->en_name }}</small>
                        <br>
                        <div class="text-warning text-shadow ">
                            <h4><small>{{__('from')}}</small> ${{ number_format($item->adults_price, 2, '.', ',') }}</h4>
                        </div>
                        {{-- <span class="text-white"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$item->duration}} </span> <br> --}}
                        {{-- <span>{{__('Departure')}}: {{$item->depLocation->name}}</span>, {{$item->departure_time}} <br> --}}

                        <div class="p-2 text-center">
                            <a href="{{url('country/'.$item->country->slug.'/'. $item->slug.'/tour')}}" class="btn btn-warning">{{__('BOOK NOW')}} </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
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
	$(document).ready(function(){

		$('select[name="from"]').on('change', function(){
            
            // $( "#to" ).prop( "disabled", false );
            //To enable 
            $('#to').removeAttr('disabled');

			var from = $(this).val();

			if(from){
				console.log(from);
				$.ajax({
					url: 'servicesto/' + from,
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// console.log(data);
						$('#to').empty();
						$('#to').append('<option value="" disable="true" selected="true">Drop off Location</option>');

						$.each(data, function(index, toObj){
							$('#to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
							// $('#tail-select-to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
                            // newAddItem.push({ key: toObj.id, value: toObj.name, description: "" })
						})
					}
				});
			}
		});

	});
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
