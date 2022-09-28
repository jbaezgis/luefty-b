@extends('layouts.admin.admin')

@section('content')
<p></p>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.admin.sidebar')
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Create New Page</div>
                    <div class="card-body">
                        <a href="{{ url('administration/content/pages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => 'administration/content/pages', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('admin.pages.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
