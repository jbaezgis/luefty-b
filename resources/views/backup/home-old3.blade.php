@extends('layouts.app2')
@section('title', __('Home'))

@section('content')

@if( session()->has('error') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
     </button>
</div>
@endif
<div class="position-relative overflow-hidden p-md-5 bg-light slider">
    <div class="container p-lg-5 bg-light ">
        <div class="row">
            <div class="col-md-6">
                <h1 class="display-4 font-weight-normal" >{{__('Find amazing travel deals...')}} <br> {{__('Any time, anywhere.')}}</h1>
                <div class="">
                    {{-- <h1 class="display-4 font-weight-normal text-white text-center custom-text-shaddow" >{{__('World\'s First Travel Services Auctions')}}</h1> --}}
                    {{-- <h2 class="font-weight-normal text-white text-center custom-text-shaddow">{{__('The Only Fair Trade Tourism Services')}}</h2> --}}
                </div>

            </div>
        </div>
        {!! Form::open(['method' => 'POST', 'url' => '/booking/store', 'class' => '', 'role' => 'search'])  !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- <h5>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h5> --}}
                        {{-- <label for="to">{{ __('From') }}</label> --}}
                        {{-- {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from', 'placeholder'=> __('Pick up Location'), 'class'=>'form-control select2', 'required']) !!} --}}
                        <select class="form-control {{ $errors->has('lang') ? 'has-error' : '' }} select2" id="from" name="from">
                            <option value="" disabled selected>{{__('Select Airport')}}</option>
                            @foreach ($countries as $country)
                                <optgroup label="{{$country->en_name}}">
                                    @foreach (App\Location::where('country_id', $country->id)->where('active', 1)->where('is_airport', 1)->orderBy('order', 'asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}, {{$item->country->en_name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from') }}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- <h5>{{ __('TO - DROP OFF LOCATION') }} <small>(Details in booking form)</small></h5> --}}
                        {{-- <label for="to">{{ __('To') }}</label> --}}
                        {{-- {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to', 'placeholder'=> __('Drop off Location'), 'class'=>'form-control select2', 'required']) !!} --}}
                        <select class="form-control {{ $errors->has('lang') ? 'has-error' : '' }} select2" id="to" name="to">
                            <option value="" disabled selected>{{__('Drop off Location')}}</option>
                            @foreach ($countries as $country)
                                <optgroup label="{{$country->en_name}}">
                                    @foreach (App\Location::where('country_id', $country->id)->where('active', 1)->orderBy('order', 'asc')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}, {{$item->country->en_name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <small id="toErrors" class="form-text text-danger">{{ $errors->first('to') }}</small>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="{{ $errors->has('adults') ? ' has-error' : ''}}">
                        {!! Form::number('adults', null, ['class' => 'form-control input-number', 'placeholder'=> __('Adults'), 'required']) !!}
                        {!! $errors->first('adults', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="{{ $errors->has('infants') ? ' has-error' : ''}}">
                        {!! Form::number('infants', null, ['class' => 'form-control', 'placeholder'=> __('Infants')]) !!}
                        {!! $errors->first('infants', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="{{ $errors->has('babies') ? ' has-error' : ''}}">
                        {!! Form::number('babies', null, ['class' => 'form-control', 'placeholder'=> __('Babies')]) !!}
                        {!! $errors->first('babies', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="{{ $errors->has('date') ? ' has-error' : ''}}">
                        {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder'=> __('Date'), 'required']) !!}
                        {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div> --}}
            <div class="row justify-content-center pt-3">
                <div class="col-md-4 text-center">
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary btn-lg">
                            <input type="checkbox" name="type" value="oneway" onchange="this.form.submit()"> {{ __('One-Way' ) }}
                        </label>
                        <label class="btn btn-primary btn-lg">
                            <input type="checkbox" name="type" value="roundtrip" onchange="this.form.submit()"> {{ __('Round-Trip') }}
                        </label>
                    </div>
                    {{-- <button class="btn btn-primary btn-block btn-lg" type="submit" title="{{ __('Continue')}}">{{ __('CONTINUE')}} </button>
                    <button class="btn btn-primary btn-block btn-lg" type="submit" title="{{ __('Continue')}}">{{ __('CONTINUE')}} </button> --}}
                    {{-- <a class="btn btn-warning" href="{{ url('/') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> Clear</a> --}}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    
</div>

<div class="row">
    <div class="col-md-12 text-center py-4 bg-info-light">
        <h2>COVID-19</h2>
        <span class="text-muted">Learn what we’re doing to help keep you safe and your plans flexible as you discover amazing things to do. Before you book, make sure to check local travel restrictions.</span>
    </div>
</div>

<div class="container">
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
</div>

<div class="container">
    <div class="row py-4">
        <div class="col-md-12 text-center">
            <h3>Top attractions near Dominican Republic</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/damajagua.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/macao.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/indigenous.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/catalina.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/damajagua.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/macao.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/indigenous.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="card mb-3">
                    <img src="{{asset('images/places/catalina.jpg')}} " class="card-img-top" alt="damaja">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<div class="row my-4">
    <div class="col-md-12 text-center py-4 bg-info-light">
        <h1>Keep things flexible</h1>
        <p class="lead text-muted">Use Reserve Now & Pay Later to secure
            the activities you don’t want to miss without being locked in.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{asset('images/places/isla_saona.jpg')}} " class="img-fluid" alt="saona">
            <p class="lead">
                Saona Island (Isla Saona) <br>
                <small class="text-info">65 Tours and Activitis</small>
            </p>
            
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/places/macao.jpg')}} " class="img-fluid" alt="macao">
                    <p>
                        Macao Beach (Playa Macao) <br>
                        <small class="text-info">158 Tours and Activitis</small>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/places/indigenous.jpg')}} " class="img-fluid" alt="indigenous">
                    <p>
                        Indigenous Eyes Ecological<br>
                        <small class="text-info">6 Tours and Activitis</small>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/places/samana.jpg')}} " class="img-fluid" alt="samana">
                    <p>
                        Samaná Bay <br>
                        <small class="text-info">31 Tours and Activitis</small>
                    </p>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/places/catalina.jpg')}} " class="img-fluid" alt="catalina">
                    <p>
                        Catalina Islan (Isla Catalina) <br>
                        <small class="text-info">40 Tours and Activitis</small>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/places/coco_bongo.jpg')}} " class="img-fluid" alt="coco">
                    <p>
                        Coco Bongo Punta Cana<br>
                        <small class="text-info">8 Tours and Activitis</small>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset('images/places/damajagua.jpg')}} " class="img-fluid" alt="damajagua">
                    <p>
                        Damajagua Falls (27 Charcos) <br>
                        <small class="text-info">18 Tours and Activitis</small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row my-4">
    <div class="col-md-12 text-center py-4 bg-info-light">
        <h1>Free cancellation</h1>
        <p class="lead text-muted">You'll receive a full refund if you cancel at least 24 hours in advance of most experiences.</p>
    </div>
</div>


<div class="container">
    <div class="row py-4">
        <div class="col-md-12 text-center">
            <h3>Top Destinations</h3>
        </div>
    </div>
    <div class="row">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="{{asset('images/places/macao.jpg')}} " class="img-fluid" alt="macao">
                    <p>
                        Macao Beach (Playa Macao)
                    </p>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('images/places/indigenous.jpg')}} " class="img-fluid" alt="indigenous">
                    <p>
                        Indigenous Eyes Ecological
                    </p>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('images/places/samana.jpg')}} " class="img-fluid" alt="samana">
                    <p>
                        Samaná Bay
                    </p>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('images/places/catalina.jpg')}} " class="img-fluid" alt="catalina">
                    <p>
                        Catalina Islan (Isla Catalina) 
                    </p>
                </div>
            </div>

    </div>
</div>

<div class="container mt-5 text-center">
        {{-- <div class="row p-3">
            <div class="col-md-12">
                <h2 class="text-muted">{{__('The only Fair Trade Tourism service in the world')}} </h2>
            </div>
        </div> --}}
        <div class="row p-3 justify-content-center">
            <div class="col-md-6 bg-light py-5 shadow-sm">
                <h1 class="text-success">{{__('With Luefty you buy DIRECT')}} </h1>
                <h2 class="text-muted">{{__('SAVE up to')}} </h2>
                <h1 class="display-1 text-success">60%</h1>
            </div>
            <div class="col-md-6 py-5 shadow-sm">
                <h1 class="text-primary">{{__('We believe in giving back!')}} </h1>
                <h2 class="text-muted">{{__('Drivers keep their Price')}}</h2>
                <h1 class="display-1 text-primary">100%</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-12">
                <p class="lead text-muted">
                    Luefty connects you directly to the local supplier, without intermediaries. Luefty is the world's first travel services auction platform. Combine the auctions, direct booking and a free competitive market and you get up to 60% savings on your tranfers, tours and charter flights. You connect directly with the local supplier and get much better service. The local suppliers keeps 100% of their offer. You pay less and the local supplier earns more. This is Fair Trade Tourism!
                </p>
            </div>
        </div>
    </div>

<div class="container">
    <hr>
    <div class="row pt-5 pb-3 justify-content-center text-center">
        <div class="col-md-12 pb-3">
            <h1 class="text-info ">{{__('Driver extreme hygiene protocols')}}</h1>
        </div>
        <div class="col-md-3">
            <h2 class="display-5 text-muted">{{__('Always wear mask')}}</h2>
            <span><img src="{{asset('images/home/mask.svg')}} " width="140" alt="maks"></span>
        </div>
        <div class="col-md-3">
            <h2 class="display-5 text-muted">{{__('Sanitizer')}}</h2>
            <img src="{{asset('images/home/sanitizer.svg')}} " width="140" alt="sanitizer">
        </div>
        <div class="col-md-3">
            <h2 class="display-5 text-muted">{{__('Driver test')}}</h2>
            <img src="{{asset('images/home/temp.svg')}} " width="140" alt="temp">
        </div>
    </div>
</div>

<div class="container">
    {{-- <hr> --}}
    {{-- Why book a transfer --}}
    <div class="row mt-5">
        <div class="col-md-12">
            <h4>{{__('Luefty is your service for the future')}} </h4>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-6 pb-3">
                    <div class="d-flex flex-row mb-3">
                        <div class="p-2"><img class="img-fluid" src="{{asset('images/home/hombre.svg')}} " width="150" alt="man"></div>
                        <div class="p-2">
                            <h5>{{__('Meet & greet')}}</h5>
                            <small class="text-muted">
                                {{__('You are dealing directly with your supplier. There simply is no better service!')}}
                            </small>
                        </div>
                    </div>


                </div>
                <div class="col-md-6 pb-3">
                    <div class="d-flex flex-row mb-3">
                        <div class="p-2"><img class="img-fluid" src="{{asset('images/home/dinero.svg')}} " width="150" alt="money"></div>
                        <div class="p-2">
                            <h5>{{__('No contest pricing')}}</h5>
                            <small class="text-muted">
                                {{__('There is no value in the travel business that can beat Luefty. We guarantee that!')}}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pb-3">
                    <div class="d-flex flex-row mb-3">
                        <div class="p-2"><img class="img-fluid" src="{{asset('images/home/hora.svg')}} " width="300" alt="time"></div>
                        <div class="p-2">
                            <h5>{{__('Fastest Booking')}}</h5>
                            <small class="text-muted">
                                {{__('If you have booked with Luefty you know how quick and simple it is. Transparent prices. No hidden fees, and by far the lowest prices in the market.')}}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pb-3">
                    <div class="d-flex flex-row mb-3">
                        <div class="p-2"><img class="img-fluid" src="{{asset('images/home/playa.svg')}} " width="300" alt="playa"></div>
                        <div class="p-2">
                            <h5>{{__('Home to Vacation')}}</h5>
                            <small class="text-muted">
                                {{__('From your home to your hotel or apartment. You book with the local supplier, you chat with the local supplier and they care for you on your vacation.')}}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card border-0 shadow">
                {{-- <div class="card-header pt-3 text-center">
                    <h4 class="text-info">{{__('30 years of tourist service')}} </h4>
                </div> --}}
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="p-2 bd-highlight"><img class="img-fluid" src="{{asset('images/home/medio-ambiente.svg')}} " width="200" alt="CO2"></div>
                        <div class="p-2 bd-highlight">
                            <h5 class="text-success">{{__('Todays Vehicles')}}</h5>
                            <small class="text-muted">{{__('Carbon polluting vehicles are especially acute challenges in developing countries. Luefty is committed to helping local suppliers keep their engines clean and operating with best practices.')}}</small>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="p-2 bd-highlight"><img class="img-fluid" src="{{asset('images/home/coche-ecologico.png')}}" width="200" alt="eco"></div>
                        <div class="p-2 bd-highlight">
                            <h5 class="text-success">{{__('Electric Vehicles')}}</h5>
                            <small class="text-muted">{{__('Our platform will give prominence to e-vehicles. Vested interests, lack of charging
                                stations, resistance to change hold back carbon reduction. Luefty intends to work with local grass roots organizations.')}}</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="d-flex flex-row mb-3">
                <div class="p-2"><img src="{{asset('images/travellers_choice.png')}} " alt="" height="150"></div>
                
            </div>
        </div>
    </div> --}}

</div>

{{-- Why book your transfers with Luefty? --}}
<div class="bg-light py-5">
    <div class="container">
        <div class="row pb-3">
            <div class="col-md-12 text-center">
                <h3 class="text-muted">{{__('Why book your transfers with Luefty?')}}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="d-flex flex-row">
                    <div class="p-2 bd-highlight"><img class="img-fluid" src="{{asset('images/home/pagar.svg')}} " width="200" alt="pay"></div>
                    <div class="p-2 bd-highlight">
                        <h5 class="text-info">{{__('Direct Sale')}}</h5>
                        <span class="text-muted">{{__('You are buying direct from the carefully selected local suppliers. Your saving will be up to 60% because there are no intermediaries.')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="d-flex flex-row">
                    <div class="p-2 bd-highlight"><img class="img-fluid" src="{{asset('images/home/cerdo.svg')}} " width="300" alt="pork"></div>
                    <div class="p-2 bd-highlight">
                        <h5 class="text-info">{{__('Auction Pricing')}}</h5>
                        <span class="text-muted">{{__('You can Buy Now or Join the Luefty Auctions and save tons of money. In the Auctions suppliers are happy to offer incredible prices because that is better than driving home empty or standing idle.')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="d-flex flex-row">
                    <div class="p-2 bd-highlight"><img class="img-fluid" src="{{asset('images/home/descuento.svg')}} " width="300" alt="desc"></div>
                    <div class="p-2 bd-highlight">
                        <h5 class="text-info">{{__('Fair Trade')}}</h5>
                        <span class="text-muted">{{__('The drivers and suppliers in our auction keep 100% of their price and drive when they want to. No more huge margins going to intermediariesl You win, the local business wins and Luefty wins. This is Fair Trade.')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    //  $('.input-number').inputSpinner()
    // $("input[type='number']").inputSpinner()
</script>

<script>
    function fromValue(){
        $('select[name="from"]').on('change', function(){
            var inputVal = document.getElementById("from").value;
        });
    }
</script>

<script>
	$(document).ready(function(){

		// $('select[name="from"]').on('change', function(){

		// 	var from = $(this).val();
		// 	if(from){
		// 		// console.log(from_city);
		// 		$.ajax({
		// 			url: '/service-to/'+from,
		// 			type: 'GET',
		// 			dataType: 'json',
		// 			success: function(data){
		// 				// console.log(data);
		// 				$('#to').empty();
		// 				$('#to').append('<option value="" disable="true" selected="true">Select Location</option>');

		// 				$.each(data, function(index, to){
		// 					$('#to').append('<option value="'+ to.id +'">' + to.toLocation.name + '</option>');
		// 				})
		// 			}
		// 		});
		// 	}
		// });

		// $('select[name="to_city"]').on('change', function(){

		// 	var to_city = $(this).val();
		// 	if(to_city){
		// 		// console.log(to_city);
		// 		$.ajax({
		// 			url: '/to_locations/'+to_city,
		// 			type: 'GET',
		// 			dataType: 'json',
		// 			success: function(data){
		// 				// console.log(data);
		// 				$('#to_location').empty();
		// 				$('#to_location').append('<option value="" disable="true" selected="true">Select Location</option>');

		// 				$.each(data, function(index, to_locationObj){
		// 					$('#to_location').append('<option value="'+ to_locationObj.id +'">' + to_locationObj.name + '</option>');
		// 				})
		// 			}
		// 		});
		// 	}
		// });

	});
</script>
@endsection
