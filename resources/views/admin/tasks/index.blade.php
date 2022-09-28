@extends('layouts.admin.admin')
@section('title', trans('auctions.tasks'))

@section('content')
<section class="content-header">
    <h1>Tasks</h1>
    {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol> --}}
</section>
<br>
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/admin/extras/create') }}" class="btn btn-primary btn-sm" title="Add New Role">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
    </div>
    <div class="box-body">
        <br/>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tasks as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        
                        <td>
                            {{-- <a href="{{ url('/admin/faqs/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                            <a href="{{ url('/admin/extras/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/admin/extras', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete Extra',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination"> {!! $extras->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
</div>

@endsection
