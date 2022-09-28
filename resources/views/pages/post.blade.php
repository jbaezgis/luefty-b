@extends('layouts.app2')
@section('title', $post->title)
@section('keywords', $post->keywords)
@section('og-image', asset('storage/images/posts/'. $post->img))
@section('og-image-url', asset('storage/images/posts/'. $post->img))

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <small><a href="{{url('/')}}">{{__('Home')}}</a> / <a href="#">{{__('Posts')}} </a> / <span class="text-muted">{{$post->title}}</span></small> 
        </div>
    </div>
    <br>
    <div class="img-cropped rounded" 
    style="background-image: url('{{URL::asset('storage/images/posts/'. $post->img)}}');">
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            @foreach ($post->images as $item)
                <img src="{{URL::asset('storage/images/posts/'.$post->id.'/'.$item->file_name)}}" height="100" alt="{{$item->file_name}}">
            @endforeach
        </div>
    </div>

    <div class="row mt-4">
        {{-- <div class="col-md-6">
            <img src="{{URL::asset('storage/images/posts/'. $post->img)}}" class="img-fluid" alt="{{$post->title}}">
        </div> --}}
        <div class="col-md-12">
            <h1>{{$post->title}}</h1>
            <span class="text-muted">{{__('Location')}}: {{$post->locationid->name}}</span>
            

            {{-- <p>{{ $post->short_description }}</p> --}}
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 mb-5">
            {!! $post->description !!}
        </div>
    </div>

</div>
{{-- /container --}}
@endsection