@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
    <a href="{{route('countries.index')}} " class="btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}} </a>
    <hr>
    {!! Form::model($country, ['method' => 'PATCH', 
    'url' => ['locations/countries', $country->id], 
    'id' => 'locations_form',
    'class' => 'form-horizontal needs-validation','novalidate',
    'enctype' => 'multipart/form-data'
    ]) !!}
        <div class="card">
            <div class="card-body">
                @if($country->image)
                <img src="{{asset('storage/images/countries/'.$country->id.'/'.$country->image)}}" height="250"alt="{{$country->image}}">
                {{-- <img src="{{URL::asset('storage/images/countries/'. $country->image)}}" height="150"> --}}
                <hr>
                @endif
                @include('locations.countries.form')
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
