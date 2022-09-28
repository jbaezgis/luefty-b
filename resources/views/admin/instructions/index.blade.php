@extends('layouts.admin.admin')

@section('content')
<section class="content-header">
    <h1>{{ __('Instructions') }}<small>{{ __('All data') }}</small></h1>
</section>
<br>
<div class="box box-primary">
    <div class="box-header with-border">
        <a href="{{ url('/administration/instructions/create') }}" class="btn btn-primary btn-sm" title="Add New Role">
            <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
        </a>
    </div>
    <div class="box-body">
    
        {!! Form::open(['method' => 'GET', 'url' => '/administration/instructions', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                        <th>{{ __('Title EN') }}</th>
                        <th>{{ __('Title ES') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($instructions as $item)
                    <tr>
                        <td><a href="{{ url('/administration/instructions', $item->id) }}">{{ $item->title_en }}</a></td>
                        <td><a href="{{ url('/administration/instructions', $item->id) }}">{{ $item->title_es }}</a></td>
                        
                        <td>
                            <a href="{{ url('/administration/instructions/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/administration/instructions/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/administration/instructions', $item->id],
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
            <div class="pagination"> {!! $instructions->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
</div>

@endsection
