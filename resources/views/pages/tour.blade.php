@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{url('/')}} " class="btn btn-light"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Back to home')}}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="">{{$tour->title}}</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card">
                <img src="{{URL::asset('storage/images/tours/'. $tour->image)}}" class="card-img-top" alt="{{$tour->image}}">
                <div class="card-body">
                    {{-- <h2 class="">{{$post->title}}</h2> --}}
                    {{-- <small class="card-text"><span class="text-muted">{{$post->locationid->name}}</span></small> --}}
                    {{-- <hr> --}}
                    {!! $tour->description !!}
                </div>
            </div>
        </div>
    </div>

</div>
{{-- /container --}}
@endsection