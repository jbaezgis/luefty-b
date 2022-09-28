@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
    <a href="{{url('locations/'.$region->country_id.'/regions')}}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}}</a>

    <hr>
        <div class="col-md-12">
            <h1>{{$region->name}}</h1>
        </div>
    <hr>

    {{-- Service Variation --}}

    <div class="card">
        <div class="card-header">
            {{__('Locations')}}
        </div>
        <div class="card-body">
            {!! Form::open(['url' => ['/locations/locations/newlocation'], 'id' => 'create_form', 'class' => 'form-horizontal needs-validation','novalidate']) !!}
            <div class="row">
                {{-- Hiddend fields --}}
                {{ Form::hidden('region_id', $region->id) }}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <div class="invalid-feedback">
                            {{ __('Name is required') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div> {{-- /col --}}
                {{-- <div class="col-md-2">
                    <div class="form-group">
                        <label for="order">{{__('Order')}}</label>
                        {!! Form::number('order', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small id="nameError" class="form-text text-danger">{{ $errors->first('order') }} </small>
                        <div class="invalid-feedback">
                            {{ __('Order is required') }}
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-2">
                    <div class="form-group">
                        {{-- <h4>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h4> --}}
                        <label for="to">{{ __('Is Airport?') }}</label>
                        {!! Form::select('is_airport', array('0' => 'No', '1' => 'Yes' ), null, ['class' => 'form-control']) !!}
                        <small id="toErrors" class="form-text text-danger">{{ $errors->first('is_airport') }}</small>
                    </div>{{-- /form-group --}}
                </div> {{-- /col --}}

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
                        <th>{{__('Name')}}</th>
                        {{-- <th>{{__('Order')}}</th> --}}
                        <th>{{__('Is Airport')}}</th>
                        {{-- <th>{{ __('Places')}} </th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            {{-- <td>{{$item->order}} </td> --}}
                            <td>
                                @if ($item->is_airport == 1)
                                    <span class="badge badge-primary">{{__('Yes')}} </span>
                                @endif
                            </td>
                            {{-- <td>{{ $item->places->count() }} </td> --}}
                            <td>
                                {{-- {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/locations/locations/delete', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Delete Location'),
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!} --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="pagination"> {!! $locations->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
    </div>

</div>

@endsection
