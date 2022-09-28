@extends('layouts.admin.admin')
@section('title', $user->name)
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<div class="container">
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">{{__('Edit User')}}</h3>
    </div>
    <div class="box-body">

                    <a href="{{ url('/administration/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
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
                        'url' => ['/administration/users', $user->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include ('admin.users.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}

    </div>
</div>
</div>
@endsection
