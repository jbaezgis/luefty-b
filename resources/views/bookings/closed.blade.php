@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <h2>{{__('Hi')}}, {{$auction->full_name}} </h1>
    <p class="lead">
        {{__('This booking was closed at')}} <strong>{{ date('l j, F Y, g:i A', strtotime($auction->paid_date)) }}</strong>

        {{-- {{ date('l j, F Y', strtotime($item->date)) }}</strong>, {{__('Arrival time')}}: <strong>{{ date('g:i A', strtotime($item->arrival_time)) }} --}}
    </p>
</div>
@endsection