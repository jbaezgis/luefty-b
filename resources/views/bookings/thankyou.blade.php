@extends('layouts.app2')
@section('title', __('Thank You'))
@section('description', __('Thank You page'))

@section('head')
    
@endsection

@section('content')
    <br>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2>{{__('Thank you for Your Order!')}} </h2>
                <p class="lead">{{__('A confirmation email was sent')}} </p>
                <br>
                <a class="btn btn-primary" href="/">{{__('Back to Home Page')}} </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
