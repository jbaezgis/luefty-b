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
            <small><a href="{{url('/')}}">{{__('Home')}}</a> / <a href="{{url($attraction->location->slug)}}">{{__('Things to do in')}} {{$attraction->location->name}}</a> / <span class="text-muted">{{__('Things to do in')}} {{$attraction->location->name}}</span></small> 
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <a class="" data-toggle="collapse" href="" role="button" aria-expanded="false" aria-controls="collapseExample">
                <h5>{{$attraction->location->name}} {{__('Tours')}} <small><i class="fa fa-angle-down" aria-hidden="true"></i></small></h5>
            </a>
            <p></p>
            <p></p>
            <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <h5>{{$attraction->location->name}} {{__('Attractions')}}  <small><i class="fa fa-angle-down" aria-hidden="true"></i></small></h5>
            </a>
            
            <div class="collapse show" id="collapseExample">
                <ul class="nav flex-column">
                    @foreach ($attractions as $item)
                        <li class="nav-item">
                            <a class="nav-link {{$item->id == $attraction->id ? 'font-weight-bold text-black' : ''}} " href="{{url('attraction/'. $item->slug)}}">{{$item->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="">{{$attraction->title}}</h1>
                    {!!$attraction->description!!}
                </div>
                <div class="col-md-6">
                    <img src="{{URL::asset('storage/images/attractions/'. $attraction->image)}}" class="img-fluid" alt="{{$attraction->image_alt}}">
                </div>
            </div>
        </div>
    </div>
    

</div>
{{-- /container --}}
@endsection