@extends('layouts.app2')
@section('title', __('Sorry!'))

@section('content')
<p></p>
<p></p>
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <img class="img-grayscale" src="{{URL::asset('images/under_construction.png')}}" height="300">
        </div>
        <div class="col-md-12 py-5">
            {{-- <h1 class="display-2">Oops!</h1> --}}
            {{-- <h1 class=""><span class="text-primary">500</span></h1> --}}
            <P class="lead">{{ __('Please excuse our look but we are updating information.')}} <br/> {{ __('Come back soon.')}}</P>
            {{-- <a href="/" class="btn btn-primary">{{ __('GO TO HOMEPAGE')}} </a> --}}
        </div>
    </div>
</div>
@endsection