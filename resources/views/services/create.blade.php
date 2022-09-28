@extends('layouts.app2')

@section('content')
<div class="container">
    <br>
    <h3>{{__('Add new service')}}</h3>
    <a href="{{route('services.index')}} " class="btn btn-secondary">{{__('Go back to Services')}} </a>
    <hr>
    {!! Form::open(['url' => ['/services/store'], 'id' => 'create_form', 'class' => 'form-horizontal needs-validation','novalidate']) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            {{-- <h4>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h4> --}}
                            <label for="to">{{ __('From') }}</label>
                            {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=> __('Select location'), 'class'=>'form-control select2 border-blue', 'required' ]) !!}
                            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
                            <div class="invalid-feedback">
                                {{ __('Please select a Location') }}
                            </div>
                        </div>{{-- /form-group --}}
                    </div> {{-- /col --}}
                    <div class="col-md-5">
                        <div class="form-group">
                            {{-- <h4>{{ __('TO - DROP OFF LOCATION') }} <small>(Details in booking form)</small></h4> --}}
                            <label for="to">{{ __('To') }}</label>
                            {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=> __('Select location'), 'class'=>'form-control select2', 'required' => 'required']) !!}
                            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
                            <div class="invalid-feedback">
                                {{ __('Please select a Location') }}
                            </div>
                        </div>{{-- /form-group --}}
                    </div> {{-- /col --}}
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="name">{{__('Driving Time')}}</label>
                            <input type="number" class="form-control {{ $errors->has('driving_time') ? 'is-invalid' : '' }}" id="driving_time" name="driving_time" value="{{old('driving_time')}}" aria-describedby="nameErrors" required>
                            <small id="nameError" class="form-text text-danger">{{ $errors->first('name') }} </small>
                            <div class="invalid-feedback">
                                {{ __('Full name is required') }}
                            </div>
                        </div>{{-- /form-group --}}
                    </div> {{-- /col --}}
                    <div class="col-md-3">
                        {!! Form::label('featured', __('Featured'), ['class' => 'control-label']) !!}
                        {!! Form::select('featured', array('0' => 'No', '1' => 'Yes'), null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>

                </div>{{-- /row --}}

            </div>
            <div class="card-footer text-center">
                <button type="submit" id="save" class="btn btn-primary">
                    {{__('Continue')}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    {!! Form::close() !!}
</div>

@endsection
