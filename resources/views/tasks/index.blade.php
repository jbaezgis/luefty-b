@extends('layouts.app2')
@section('title', trans('auctions.tasks'))

@section('content')
<br>
<div class="container-fluid">
<section class="content-header">
    <h1>@lang('globals.tasks')</h1>
    {{-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
    </ol> --}}
</section>
<br>
<div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-clipboard"></i>

          <h3 class="box-title ">@lang('globals.tasks') </h3>

          <div class="box-tools pull-right">
            <a href="{{ url('tasks/create') }}" class="btn btn-primary btn-sm" title="Add New Role">
                <i class="fa fa-plus" aria-hidden="true"></i> @lang('globals.add_new')
            </a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('globals.task')</th>
                            <th>@lang('globals.status')</th>
                            <th width="30%"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $item)
                        <tr>
                            <td><span class="badge badge-pill badge-secondary "><i class="fa fa-clock-o"></i> {{ $item->created_at->diffForHumans() }}</span> <strong>@lang('globals.module'):</strong> {{ $item->module }}, 
                                <strong>@lang('globals.tasks'):</strong> {{ $item->name }}
                            </td>
                            
                            <td><span class="badge badge-pill {{ $item->status === 'Closed' ? 'badge-success' : 'badge-warning' }}">{{ $item->status }}</span></td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar {{ $item->status === 'Closed' ? 'bg-success' : '' }}" role="progressbar" style="width: {{ $item->progress }}%;" aria-valuenow="{{ $item->progress }}" aria-valuemin="0" aria-valuemax="100">{{ $item->progress }}%</div>
                                </div>
                            </td>
                            
                            <td>
                                <a href="{{ url('tasks/' . $item->id) }}" title="View Task"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                <a href="{{ url('tasks/' . $item->id . '/edit') }}" title="Edit Task"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['tasks', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Task',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
          <div class="pagination pull-right"> {!! $tasks->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
      </div>

</div>
@endsection
