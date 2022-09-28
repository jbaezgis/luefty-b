@extends('layouts.admin.admin')

@section('content')
<section class="content-header">
        <h1>Roles<small>Agregar nuevo</small></h1>
        {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
        </ol> --}}
</section>
<br>
<div class="box box-solid">
    <div class="box-header with-border">
            <a href="{{ url('/administration/roles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    </div>
    <div class="box-body">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['url' => '/administration/roles', 'class' => 'form-horizontal']) !!}

        @include ('admin.roles.form', ['formMode' => 'create'])

        {!! Form::close() !!}

    </div>
</div>
@endsection
