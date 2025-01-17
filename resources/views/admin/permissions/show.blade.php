@extends('layouts.admin.admin')

@section('content')
<div class="box box-solid">
    <div class="box-header with-border">
            <h3 class="box-title">Permission</h3>
        </div>
    <div class="box-body">

        <a href="{{ url('/administration/permissions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
        <a href="{{ url('/administration/permissions/' . $permission->id . '/edit') }}" title="Edit Permission"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
        {!! Form::open([
            'method' => 'DELETE',
            'url' => ['/administration/permissions', $permission->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Permission',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID.</th> <th>Name</th><th>Label</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $permission->id }}</td> <td> {{ $permission->name }} </td><td> {{ $permission->label }} </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection