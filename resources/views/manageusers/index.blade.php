@extends('layouts.app2')
@section('title', __('Users'))

@section('content')
<p></p>
<div class="container-fluid">
<section class="content-header">
    <h1>{{__('Users')}}</h1>
</section>
<hr>
<div class="row">
    <div class="col-md-12">
        {!! Form::open(['method' => 'GET', 'url' => '/manage/users', 'class' => '', 'role' => 'search'])  !!}
           @include('manageusers.search_form')
        {!! Form::close() !!}
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if (session()->has('flash_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>{!! session('flash_message') !!}</strong>
            </div>

            <script>
              $(".alert").alert();
            </script>
        @endif
    </div>
</div>
<div class="box box-primary d-none d-lg-block d-xl-block">
    <div class="box-header with-border">
        <a href="{{ url('/manage/users/create') }}" class="btn btn-primary" title="Add New User">
            <i class="fa fa-plus" aria-hidden="true"></i> {{__('Add new user')}}
        </a>
    </div>
    <div class="box-body">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Company')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('User Type')}}</th>
                        {{-- <th>{{ __('Registration date') }}</th> --}}
                        {{-- <th>{{ __('Next payment') }}</th> --}}
                        {{-- <th></th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ url('/manage/users', $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->company_name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->userType->name }}</td>
                        {{-- <td>{{ date('l j, F Y', strtotime($item->registration_date)) }}</td> --}}
                        {{-- <td>{{ date('l j, F Y', strtotime($item->next_payment)) }}</td> --}}
                        {{-- <td>
                            @if ($item->trial == 1)
                                <span class="badge bg-yellow">{{ __('Trial period')}} </span>
                            @else
                                <span class="badge bg-green">{{ __('Other')}} </span>
                            @endif
                        </td> --}}

                        <td>
                            {!! Form::open([
                                'method' => 'PATCH',
                                'url' => ['/manage/users/changepassword', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-warning btn-sm',
                                        'title' => 'Change password to default',
                                        'onclick'=>'return confirm("Are you sure?")'
                                )) !!}
                            {!! Form::close() !!}
                            <a href="{{ url('/manage/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/manage/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            {{-- {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/manage/users', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete User',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}

                            {!! Form::close() !!} --}}


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {!! $users->appends(['name' => Request::get('name'), 'email' => Request::get('email'), 'company_name' => Request::get('company_name')])->render() !!} </div>
        </div>

    </div>
</div>

{{-- Mobile version --}}
<div class="row d-none d-block d-sm-block d-md-none">
    <hr>
    <div class="col-md-12">
        <a href="{{ url('/manage/users/create') }}" class="btn btn-primary btn-sm" title="Add New User">
            <i class="fa fa-plus" aria-hidden="true"></i> {{__('Add new user')}}
        </a>
    </div>
    <p></p>
    @foreach($users as $item)
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="badge badge-secondary">ID: {{ $item->id }}</span> <strong>{{ $item->name }} </strong> ({{ $item->email }})
                    </div>
                    <div class="card-body">
                        <span>{{ __('Company name') }}: <strong>{{ $item->company_name }} </strong></span>
                        <br>
                        <span>{{ __('Phone') }}: <strong>{{ $item->phone }} </strong></span>
                        <br>
                        <span>{{ __('User type') }}: <strong>{{ $item->userType->name }}</strong></span>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/manage/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        <a href="{{ url('/manage/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/manage/users', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
        </div>
        <br>
    @endforeach
    <div class="col-md-12">
        <div class="pagination"> {!! $users->appends(['name' => Request::get('name'), 'email' => Request::get('email'), 'company_name' => Request::get('company_name')])->render() !!} </div>
    </div>
</div>
</div>
@endsection
