@extends('layouts.admin.admin')
@section('title', $user->name)
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<div class="container">
    
    <div class="box box-solid mt-5">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('User')}}</h3>
        </div>
        <div class="box-body">

            <a href="{{ url('/administration/users') }}" title="Back"><button class="btn btn-light btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Back to Users')}}</button></a>
            <a href="{{ url('/administration/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</button></a>
            {{-- {!! Form::open([
                'method' => 'DELETE',
                'url' => ['/admin/users', $user->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete User',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!} --}}
            {!! Form::open([
                'method' => 'PATCH',
                'url' => ['/manage/users/changepassword', $user->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-warning btn-sm',
                        'title' => 'Change password to 123456',
                        'onclick'=>'return confirm("Are you sure?")'
                )) !!}
            {!! Form::close() !!}
            <br/>
            <br/>


            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID.</th> <th>Name</th><th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->id }}</td> <td> {{ $user->name }} </td><td> {{ $user->email }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
