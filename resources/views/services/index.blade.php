@extends('layouts.app2')
@section('title', __('Services'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<p></p>
<div class="container">
    <h1>Services</h1>
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['method' => 'GET', 'url' => '/services', 'class' => '', 'role' => 'search'])  !!}
                {{-- @lang('globals.filters'): --}}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            {{-- <label for="from">@lang('globals.from')</label> --}}
                            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
                            {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=>__('--From location--'), 'class'=>'form-control select2' ]) !!}
                            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            {{-- <label for="from">@lang('globals.to')</label> --}}
                            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('To location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
                            {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=>__('--To location--'), 'class'=>'form-control select2' ]) !!}
                            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                        <a class="btn btn-warning" href="{{ url('/services') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> {{ __('Clear')}}</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('services.create')}} " class="btn btn-primary">{{__('Create new service')}} </a>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('Booked')}}</th>
                        <th>{{__('Featured?')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $item)
                        <tr>
                            <td scope="row">{{ $item->id }} </td>
                            <td>{{ $item->fromLocation['name'] }}</td>
                            <td>{{ $item->toLocation['name'] }}</td>
                            <td>{{__('Used on')}} <strong>{{$item->auctions->count()}}</strong> {{__('auctions')}} </td>
                            <td>{!! $item->featured ? '<span class="badge badge-primary">Yes</span>' : '' !!}</td>
                            <td>
                                {{-- <a href="" class="btn btn-secondary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                <a href="{{ url('services/' .$item->id.'/edit') }} " class="btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/services', $item->id],
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

        <div class="card-footer">
            <div class="pagination"> {!! $services->appends(['from' => Request::get('from'), 'to' => Request::get('to')])->render() !!} </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>Duplicates</h4>
            {{-- {{$duplicates}} --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($duplicates as $item)
                        <tr>
                            <td>{{ $item->fromLocation['name'] }}</td>
                            <td>{{ $item->toLocation['name'] }}</td>                    
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
