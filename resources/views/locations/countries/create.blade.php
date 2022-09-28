@extends('layouts.admin.admin')

@section('content')
<div class="container">
    <br>
    <a href="{{route('countries.index')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}} </a>
    <hr>
    <h3>{{__('Add new Country')}}</h3>
    {!! Form::open(['url' => ['/locations/countries/store'], 'id' => 'create_form', 'class' => 'form-horizontal needs-validation','novalidate']) !!}
        <div class="card">
            <div class="card-body">
                @include('locations.countries.form')
            </div>
            <div class="card-footer text-center">
                <button type="submit" id="save" class="btn btn-primary">
                    {{__('Save')}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    {!! Form::close() !!}
</div>

@endsection
