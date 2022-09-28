@extends('layouts.admin.admin')

@section('content')
<section class="content-header">
    <h1>Roles<small>All data</small></h1>
    {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol> --}}
</section>
<br>
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/administration/roles/create') }}" class="btn btn-primary btn-sm" title="Add New Role">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
    </div>
    <div class="box-body">
    
        {!! Form::open(['method' => 'GET', 'url' => '/administration/roles', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        {!! Form::close() !!}

        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th><th>Name</th><th>Label</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($roles as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ url('/administration/roles', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->label }}</td>
                        <td>
                            <a href="{{ url('/administration/roles/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/administration/roles/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/administration/roles', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete Role',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {!! $roles->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
</div>

@endsection
