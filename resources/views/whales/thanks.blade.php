@extends('layouts.app2', ['title' => 'RINCON BEACH', 'hidesidebar' => true,])

@section('content')
<p></p>
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                    <h1 class="display-3">Thank you for your booking information</h1>
                    <p class="lead">We will reply within 24 hours but welcome you call or chat right now if you prefer!</p>
                    <hr>
                    <p class="lead">
                    Having trouble? <a href="{{url('contact-us')}}">Contact Us</a>
                    </p>
                    <a class="btn btn-primary btn-lg" href="{{ URL::to('whales') }}">Continue booking</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

