@extends('layouts.admin.admin')

@section('content')
                <div class="box box-solid">
                    <div class="box-header">
                            <h3 class="box-title">Create Permission</h3>
                    </div>
                    <div class="box-body">
                        <a href="{{ url('/administration/permissions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/administration/permissions', 'class' => 'form-horizontal']) !!}

                        @include ('admin.permissions.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>

@endsection