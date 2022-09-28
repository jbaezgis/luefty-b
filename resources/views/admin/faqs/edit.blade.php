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
        <a href="{{ url('/admin/faqs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
    </div>
    <div class="box-body">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::model($faq, [
            'method' => 'PATCH',
            'url' => ['/admin/faqs', $faq->id],
            'class' => 'form-horizontal'
        ]) !!}

        @include ('admin.faqs.form', ['formMode' => 'edit'])

        {!! Form::close() !!}

    </div>
</div>

@endsection
