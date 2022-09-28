@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <a href="{{url('administration/content/tours')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}}</a>
    <a href="{{ url('administration/content/tours/' .$tour->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> {{__('Edit')}}</a>
    <hr>
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card">
                <img src="{{URL::asset('storage/images/tours/'. $tour->image)}}" class="card-img-top" alt="{{$tour->image}}">
                <div class="card-body">
                    <h2 class="">{{$tour->title}}</h2>
                    <small class="card-text"><span class="text-muted">{{$tour->locationid->name}}</span></small>
                    <hr>
                    {!! $tour->description !!}
                </div>
            </div>
        </div>
    </div>

</div>
{{-- /container --}}
@endsection