@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<div class="page-title ">
    <div class="container">
      <h1 class="">{{ trans('pages.contact_title') }}</h1>
    </div>
</div>

<div class="container">
<p>Enviado por: {{ $message->name }} - {{ $message->email }}</p>
<p>Mensaje: {{ $message->message }}</p>
</div>
@endsection