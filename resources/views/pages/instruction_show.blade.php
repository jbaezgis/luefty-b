@extends('layouts.app2')

@section('content')
<div class="container">
    <p></p>
    <a class="btn btn-light btn-sm" href="{{ route('pages.instructions') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Go back to How to?') }} </a>
    <div class="row justify-content-md-center pt-5">
        <div class="col-md-12">
            <h2 class="font-weight-light">{{ $instruction->title_en}}</h2>
            {{-- <p class="text-muted"></p> --}}
            {{-- <small class="text-muted">{{ __('Published') }} {{ $instruction->created_at->diffForHumans() }}</small> &ensp;  --}}
            <small class="text-muted"><i class="fa fa-eye" aria-hidden="true"></i> {{ $instruction->views }} {{ __('Views')}} </small>
        </div>

    </div>
    <hr>
</div>
@endsection
