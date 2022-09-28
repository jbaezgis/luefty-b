@extends('layouts.app2')
@section('title', trans('auctions.tasks'))

@section('content')
<br>
<div class="container">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Task</h3>
                    </div>
                    <div class="box-body">

                        <a href="{{ url('tasks') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('tasks/' . $task->id . '/edit') }}" title="Edit Task"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['users', $task->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>
                        

                        <div class="table-responsive">
                    
                            <table class="table">
                               
                                <tbody>
                                    <tr>
                                        <td><strong>@lang('globals.module'): </strong> {{ $task->module }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>@lang('globals.task'): </strong> {{ $task->name }} </td>
                                    </tr>
                                    <tr>
                                        <td><strong>@lang('globals.description'): </strong> {{ $task->description }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
</div>
@endsection
