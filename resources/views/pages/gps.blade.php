@extends('layouts.app2')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('images/luefty-gps.svg') }}" height="70" alt="Luefty GPS">
        </div>
        <div class="col-md-12 text-center">
            <a href="{{ asset('apk/luefty-gps-release.apk') }} " class="btn btn-primary"><i class="fa fa-android" aria-hidden="true"></i> Download Client APK</a>
            <a href="{{ asset('apk/luefty-gps-admin-release.apk') }} " class="btn btn-light"><i class="fa fa-android" aria-hidden="true"></i> Download Admin APK</a>
        </div>
    </div>
</div>

@endsection
