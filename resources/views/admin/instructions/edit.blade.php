@extends('layouts.admin.admin')

@section('content')
<section class="content-header">
        <h1>{{ __('Instructions') }} <small>{{ __('Edit') }}</small></h1>
</section>
<br>
<div class="box box-solid">
    <div class="box-header with-border">
        <a href="{{ url('/administration/instructions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Go back') }}</button></a>
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

        @include ('admin.instructions.form', ['formMode' => 'edit'])

        {!! Form::close() !!}

    </div>
</div>

@endsection
