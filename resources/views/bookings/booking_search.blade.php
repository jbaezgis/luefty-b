@extends('layouts.app2')

@section('content')
<br>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    {!! Form::open(['method' => 'GET', 'url' => '/booking/search', 'class' => '', 'role' => 'search'])  !!}
                        <div class="row justify-content-center">
                            {{-- <div class="col-md-5">
                                <div class="form-group">
                                    <label for="auction_id">{{__('Code')}}</label>
                                    <input type="text" class="form-control {{ $errors->has('auction_id') ? 'is-invalid' : '' }}" id="auction_id" name="auction_id" value="{{old('auction_id')}}" aria-describedby="nameErrors" required>
                                    <small id="nameError" class="form-text text-danger">{{ $errors->first('auction_id') }} </small>
                                    <div class="invalid-feedback">
                                        {{ __('Code is required') }}
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="email">{{__('Email')}}</label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" email="email" value="{{ old('email') }}" aria-describedby="emailErrors" required>
                                    <small id="emailError" class="form-text text-danger">{{ $errors->first('email') }} </small>
                                    <div class="invalid-feedback">
                                        {{ __('Enter a valid email please') }}
                                    </div>
                                </div>{{-- /form-group --}}
                            </div>
                            <div class="col-md-2" style="margin-top: 32px;">
                                <button class="btn btn-primary btn-block" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i> Search</button>
                                {{-- <a class="btn btn-warning" href="{{ url('/') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> Clear</a> --}}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>{{-- /box-body --}}
            </div>{{-- /box --}}
        </div>{{-- /col --}}
    </div>{{-- /row --}}

    @if ($request->email)
    <div class="row mt-3">
        @foreach ($auctions as $item)    
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{__('Booking')}}: {{$item->auction_id}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <span style="font-size: 20px;">{{__('From')}}: <strong>{{$item->fromcity->name}}</strong> {{__('To')}}: <strong>{{$item->tocity->name}}</strong></span>
                        <br>
                        <span class="mr-2">{{__('Date')}}: <strong>{{ date('l j, F Y', strtotime($item->date)) }}</strong>, {{__('Arrival time')}}: <strong>{{ date('g:i A', strtotime($item->arrival_time)) }}</strong></span> 
                        <p>
                            <span>{{__('Arrival Airline')}}: <strong>{{$item->arrival_airline}}</strong></span> |
                            <span>{{__('Flight Number')}}: <strong>{{$item->arrival_airline}}</strong></span> |
                            @section('passengers')
                                    {{ $childrend = $item->infants + $item->babies}}
                            @endsection
                            <span>{{__('Passengers')}}:
                                <strong>{{$item->adults}}
                                    @if ($item->adults == 1)
                                        {{__('Adult')}}
                                    @else
                                        {{__('Adults')}}
                                    @endif
                                    @if ($item->infants or $item->babies)
                                        , {{ $childrend }} 
                                        @if ($childrend == 1)
                                            {{__('Child')}}
                                        @else
                                            {{__('Children')}}
                                        @endif
                                    @endif

                                </strong>
                            </span>
                        </p>
                        @if ($item->extras->count())
                        <span>{{__('Extras')}}: </span><br>
                            @foreach ($item->extras as $extra)
                                {{$extra->quantity}} - <strong>{{$extra->name}}</strong><br>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/booking/mybooking/'.$item->auction_id)}} " class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> {{__('See')}} </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
