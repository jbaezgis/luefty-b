@extends('layouts.app2')

@section('content')
<br>
<div class="container">
<section class="content-header">
        <h1>@lang('globals.create') <small>@lang('globals.new')</small></h1>
        {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
        </ol> --}}
</section>
<br>
<div class="box box-solid">
    <div class="box-header with-border">
            <a class="btn btn-warning btn-sm" href="{{ url('tasks') }}" title="Back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    </div>
    <div class="box-body">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['url' => 'tasks', 'class' => 'form-horizontal']) !!}

        @include ('tasks.form', ['formMode' => 'create'])
       
        {!! Form::close() !!}

    </div>
</div>
</div>
@endsection
