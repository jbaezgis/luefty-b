@extends('layouts.app2')
@section('title', $attraction->title)
@section('keywords', $attraction->keywords)
@section('og-image', asset('storage/images/attractions/'. $attraction->image))
@section('og-image-url', asset('storage/images/attractions/'. $attraction->image))

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <small><a href="{{url('/')}}">{{__('Home')}}</a> / <a href="{{url('country/'.$country->slug.'/tours')}}">{{$country->en_name}}</a> / <span class="text-muted">{{__('Things to do in')}} {{$attraction->location->name}}</span></small> 
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h1>{{$country->en_name}} <small>{{_('Tours')}}</small></h1>
        </div>
    
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="btn-group btn-block">
                <a href="{{url('country/'.$country->slug.'/transfers')}}" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/transfers') ? 'btn-warning' : 'btn-light'}}" aria-current="page">{{_('Transfers')}}</a>
                <a href="{{url('country/'.$country->slug.'/tours')}}" class="btn btn-lg font-weight-bold btn-warning" aria-current="page">{{_('Tours')}}</a>
                <a href="#" class="btn btn-lg font-weight-bold {{request()->is('country/'.$country->slug.'/flighs') ? 'btn-warning' : 'btn-light'}}" aria-current="page">{{_('Flight')}}</a>
            </div>
        </div>
    </div>
    <hr>   
    <div class="row">
        <div class="col-md-3">
            {{-- <a class="" data-toggle="collapse" href="" role="button" aria-expanded="false" aria-controls="collapseExample">
                <h5>{{$attraction->location->name}} {{__('Tours')}} <small><i class="fa fa-angle-down" aria-hidden="true"></i></small></h5>
            </a> --}}
            <p></p>
            <p></p>
            <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <h5>{{$attraction->location->name}} {{__('Attractions')}}  <small><i class="fa fa-angle-down" aria-hidden="true"></i></small></h5>
            </a>
            
            <div class="collapse show" id="collapseExample">
                <ul class="nav flex-column">
                    @foreach ($attractions as $item)
                        <li class="nav-item">
                            <a class="nav-link {{$item->id == $attraction->id ? 'font-weight-bold text-black' : ''}} " href="{{url('country/'.$country->slug.'/'. $item->slug.'/attraction')}}">{{$item->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="">{{$attraction->title}}</h1>
                    {!!$attraction->description!!}
                </div>
                <div class="col-md-4">
                    <img src="{{URL::asset('storage/images/attractions/'. $attraction->image)}}" class="img-fluid" alt="{{$attraction->image_alt}}">
                </div>
            </div>

            <hr>

            <div class="row">
                @foreach($tours as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="tour-image">
                                <div class="tour-price p-2 bg-primary"><small>{{__('from')}}</small> <span>${{ number_format($item->adults_price, 2, '.', ',') }}</span></div>
                                <div class="tour-image">
                                    <a href="{{url('country/'.$country->slug.'/'. $item->slug.'/tour')}}">
                                        <img src="{{URL::asset('storage/images/tours/thumbs/'. $item->image)}}" class="card-img-top" alt="{{$item->image}}">
                                    </a>
                                </div>
                                <small class="text-muted pt-2 pl-2"><i class="fa fa-globe" aria-hidden="true"></i> {{ $item->attraction->title }}, {{ $item->location->country->en_name }}</small>
                            </div>
        
                            <div class="card-body pl-2 py-1 ">
                                <strong class="text-truncate">
                                    <span class="">{{$item->title}}</span>
                                </strong>
                                <br>
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> {{$item->duration}} </span> <br>
                                {{-- <span>{{__('Departure')}}: {{$item->depLocation->name}}</span>, {{$item->departure_time}} <br> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    

</div>
{{-- /container --}}
@endsection