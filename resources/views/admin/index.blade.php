@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
  <h2>{{__('Welcome')}} {{auth()->user()->name}} </h2>
</div>
@endsection