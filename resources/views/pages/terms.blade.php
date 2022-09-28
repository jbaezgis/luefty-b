@extends('layouts.app2')
@section('title', __('Terms and Conditions'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<div class="container">
    <div class="py-5">
      <h1 class="display-4">{{ $page->title}}</h1>
      <p></p>
      {!! $page->content !!}
    </div>

@endsection
