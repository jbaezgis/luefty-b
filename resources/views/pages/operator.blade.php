@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">{{ $page->title}}</h1>
      {!! $page->content !!}

</div>

@endsection
