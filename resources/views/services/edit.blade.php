@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <a href="{{route('services.index')}} " class="btn btn-secondary">{{__('Go back to Services')}} </a>
    <hr>
    {!! Form::model($service, ['method' => 'PATCH', 'url' => ['/services', $service->id], 'id' => 'locations_form',
    'class' => 'form-horizontal needs-validation','novalidate']) !!}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <h4>{{ __('TO - DROP OFF LOCATION') }} <small>(Details in booking form)</small></h4> --}}
                            <label for="to">{{ __('To') }}</label>
                            {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=> __('Select location'), 'class'=>'form-control select2', 'onchange'=>'this.form.submit()' ]) !!}
                            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
                            <div class="invalid-feedback">
                                {{ __('Please select a Location') }}
                            </div>
                        </div>{{-- /form-group --}}
                    </div> {{-- /col --}}
                </div>{{-- /row --}}

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">{{__('Driving Time')}}</label>
                            <input type="number" class="form-control {{ $errors->has('driving_time') ? 'is-invalid' : '' }}" id="driving_time" name="driving_time" value="{{old('driving_time', $service->driving_time)}}" aria-describedby="nameErrors" required>
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
                </div> {{-- /row --}}
            </div>

            <div class="card-footer">
                <button type="submit" id="save" class="btn btn-primary">
                    {{__('Save')}}
                </button>
            </div>
        </div>
    {!! Form::close() !!}
    <hr>

    {{-- Service Variation --}}

    <div class="card">
        <div class="card-header">
            {{__('Service Variation')}}
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['/services/price/store'], 'id' => 'create_form', 'class' => 'form-horizontal needs-validation','novalidate']) !!}
            <div class="row">
                {{-- Hiddend fields --}}
                {{ Form::hidden('service_id', $service->id) }}

                <div class="col-md-3">
                    <div class="form-group">
                        {{-- <h4>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h4> --}}
                        <label for="vehicle_type">{{ __('Vehicle type') }}</label>
                        {!! Form::select('vehicle_type', App\VehicleType::pluck('type', 'id'), null, ['id'=>'vehicle_type', 'placeholder'=> __('Select vehicle type'), 'class'=>'form-control select2 border-blue', 'required' => 'required']) !!}
                        @if ($errors->has('vehicle_type'))
                            <small id="toErrors" class="form-text text-danger">{{__('Required field')}} </small>
                        @endif
                        <div class="invalid-feedback">
                            {{ __('Please select a Location') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div> {{-- /col --}}

                <div class="col-md-3">
                    <div class="form-group">
                        {{-- <h4>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h4> --}}
                        <label for="to">{{ __('Options') }}</label>
                        {!! Form::select('price_option_id', App\PriceOption::pluck('name', 'id'), null, ['id'=>'price_option_id', 'placeholder'=> __('Select option'), 'class'=>'form-control select2 border-blue', 'required' => 'required']) !!}
                        @if ($errors->has('price_option_id'))
                            <small id="toErrors" class="form-text text-danger">{{__('Required field')}} </small>
                        @endif
                        <div class="invalid-feedback">
                            {{ __('Please select a Location') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div> {{-- /col --}}

                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('oneway_price', __('One Way Price'), ['class' => 'control-label']) !!}
                        {!! Form::number('oneway_price', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        @if ($errors->has('oneway_price'))
                            <small id="toErrors" class="form-text text-danger">{{__('Required field')}} </small>
                        @endif
                        <div class="invalid-feedback">
                            {{ __('One way price is requerid') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div> {{-- /col --}}
                {{-- <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('starting_bid', __('Starting bid'), ['class' => 'control-label']) !!}
                        {!! Form::number('starting_bid', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <div class="invalid-feedback">
                            {{ __('Starting bid is required') }}
                        </div>
                    </div>
                </div>  --}}
                <div class="col-md-2" style="padding-top: 35px;">
                    <button type="submit" id="save" class="btn btn-primary btn-block btn-sm">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{__('Add')}}
                    </button>
                </div> {{-- /col --}}
            </div>{{-- /row --}}
            {!! Form::close() !!}
            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Vehicle Type')}}</th>
                        <th>{{__('Option')}}</th>
                        <th>{{__('Price')}}</th>
                        {{-- <th>{{__('Starting bid')}}</th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services_price as $item)
                        <tr>
                            <td scope="row">{{ $item->id }}</td>
                            <td>{{ $item->vehicle->type }}</td>
                            <td>{{ $item->priceOption->name }}</td>
                            <td>${{ number_format($item->oneway_price, 2, '.', ',') }}</td>
                            {{-- <td>{{ $item->starting_bid }}</td> --}}
                            <td>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/services/price/delete', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Delete Price'),
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
