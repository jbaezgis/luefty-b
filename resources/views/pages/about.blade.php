@extends('layouts.app2')
@section('title', __('About Us'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<br>
<div class="container py-5">
  <div class="">
      <h1 class="display-4">{{ $page->title}}</h1>
      <p></p>
      {{-- <h4>Decrease Costs, Improve Service. Join Luefty Auctions.</h4> --}}
      <!--<p class="lead">Benefit from really fantastic prices and new offers.</p>-->
  </div>
  {!! $page->content !!}
</div>
@endsection
