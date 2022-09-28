@extends('layouts.admin.admin')

@section('content')
<div class="container">
    <br>
    <a href="{{url('locations/'.$country->id.'/regions')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}} </a>
    <hr>
<h3>{{__('Add new region to')}} {{$country->en_name}}</h3>
    {!! Form::open(['url' => ['locations/regions/store'], 'id' => 'create_form', 'class' => 'form-horizontal needs-validation','novalidate']) !!}
    {{-- Hiddend fields --}}
    {{ Form::hidden('country_id', $country->id) }}    
    <div class="card">
            <div class="card-body">
                @include('locations.regions.form')
            </div>
            <div class="card-footer text-center">
                <button type="submit" id="save" class="btn btn-primary">
                    {{__('Save and continue')}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    {!! Form::close() !!}
</div>

@endsection
