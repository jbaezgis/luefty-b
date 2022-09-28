@extends('layouts.admin.admin')
@section('title', 'Usuarios')

@section('content')
<section class="content-header">
    <h1>Auctions<small>All data</small></h1>
    {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol> --}}
</section>
<br>
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/admin/users/create') }}" class="btn btn-primary" title="Add New User">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>

        <div class="box-tools">
        {!! Form::open(['method' => 'GET', 'url' => '/admin/users', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="input-group" style="width: 150px;">
                <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
    <div class="box-body">
        

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($auctions as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ url('/admin/users', $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->email }}</td>
                        <td></td>
                        <td>
                            <a href="{{ url('/admin/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/admin/users', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete User',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
</div>
@endsection
