@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
    <a href="{{url('locations/'.$region->country_id.'/regions')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}}</a>
    <a href="{{ url('locations/regions/' .$region->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> {{__('Edit')}}</a>
    <a href="{{ url('locations/' .$region->id.'/locations') }} " class="btn btn-primary btn-sm"><i class="fa fa-map-marker" aria-hidden="true"></i> {{__('Locations')}} </a>
    <hr>
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card">
                <img src="{{URL::asset('storage/images/regions/'.$region->image)}}" class="card-img-top" alt="{{$region->image}}">
                <div class="card-body">
                    <h2 class="">{{$region->name}}</h2>
                    <small class="card-text"><span class="text-muted">{{$region->country->en_name}}</span></small>
                    <hr>
                    {!! $region->description !!}
                </div>
            </div>
        </div>
    </div>

</div>
{{-- /container --}}

@endsection
