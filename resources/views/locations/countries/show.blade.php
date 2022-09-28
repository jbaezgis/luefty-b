@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
    <a href="{{route('countries.index')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}}</a>
    <a href="{{ url('locations/countries/' .$country->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> {{__('Edit')}}</a>
    <a href="{{ url('locations/' .$country->id.'/regions') }} " class="btn btn-primary btn-sm"><i class="fa fa-map-marker" aria-hidden="true"></i> {{__('Regions')}} </a>
    <hr>
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card">
                <img src="{{asset('storage/images/countries/'.$country->id.'/'.$country->image)}}" class="card-img-top" alt="{{$country->image}}">
                
                <div class="card-body">
                    <h2 class="">{{$country->en_name}}</h2>
                    {{-- <small class="card-text"><span class="text-muted">Test</span></small> --}}
                    <hr>
                    {!! $country->description !!}
                </div>
            </div>
        </div>
    </div>

</div>
{{-- /container --}}

@endsection
