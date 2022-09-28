@extends('layouts.app2')

@section('content')
<br>
<div class="container">
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Edit User</h3>
    </div>
    <div class="box-body">

                    <a href="{{ url('users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($user, [
                        'method' => 'PATCH',
                        'url' => ['users', $user->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include ('users.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}

    </div>
</div>
</div>
@endsection
