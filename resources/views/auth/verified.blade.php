@extends('layouts.app2')

@section('content')
<h1>{{ __('Hi') }} {{ auth()->user()->name }} {{ __('su correo fue verificado exitosamente') }}</h1>
@endsection