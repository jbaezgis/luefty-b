@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
    <a href="{{url('locations/'.$region->country_id.'/regions')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}} </a>
    <a href="{{ url('locations/regions/' .$region->id.'/show') }}" class="btn btn-light btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> {{__('See')}} </a>
    <hr>
    {!! Form::model($region, ['method' => 'PATCH', 
    'url' => ['locations/regions', $region->id], 
    'id' => 'locations_form',
    'class' => 'form-horizontal needs-validation','novalidate',
    'enctype' => 'multipart/form-data'
    ]) !!}
        <div class="card">
            <div class="card-body">
                @if($region->image)
                <img src="{{URL::asset('storage/images/regions/'. $region->image)}}" height="150">
                <hr>
                @endif
                @include('locations.regions.form')
            </div>

            <div class="card-footer">
                <button type="submit" id="save" class="btn btn-primary">
                    {{__('Save')}}
                </button>
            </div>
        </div>
    {!! Form::close() !!}
    <hr>

</div>

@endsection
