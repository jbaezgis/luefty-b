@extends('layouts.app2')
@section('title', trans('pages.home_title'))

@section('content')
<p></p>
<p></p>
<div class="container">
    <div class="row text-center">
        {{-- <div class="col-md-12">
            <img src="{{URL::asset('images/logo.svg')}}" height="100">
        </div> --}}
        <div class="col-md-12 py-5">
            <h1 class="display-2">Oops!</h1>
            <h2 class=""><span class="text-primary">404</span> - {{ __('PAGE NOT FOUND')}} </h2>
            <P>{{ __('The page you are looking for might have been removed')}} <br/> {{ __('had its name changed or is temporarily unavailable')}}</P>
            {{-- <a href="/" class="btn btn-primary">{{ __('GO TO HOMEPAGE')}} </a> --}}
        </div>
    </div>
</div>
@endsection