@extends('layouts.app2')
@section('title', trans('auctions.my_transfers'))

@section('content')
<div class="container-title">
    <h2 class="page-title bg-primary"><i class="fa fa-car"></i> {{ trans('auctions.my_transfers') }} </h2>
</div>
<br>
<div class="row pl-3">
    <div class="col-md-12">
        <a href="{{ url('/account/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar traslado</a> |
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-list" aria-hidden="true"></i></a>    
            <a href="{{ url('/myauctions') }}" class="btn btn-secondary btn-sm"> See All Transfers</a>
        </div>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="" class="btn btn-success btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>    
            <a href="{{ url('/myauctions-closed') }}" class="btn btn-secondary btn-sm"> See Closed Transfers</a>
        </div>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="" class="btn btn-warning btn-sm"><i class="fa fa-square-o" aria-hidden="true"></i></a>    
            <a href="{{ url('/myauctions-open') }}" class="btn btn-secondary btn-sm"> See Open Transfers</a>
        </div>
    </div>
</div>
<hr>

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        {!! Form::open(['method' => 'GET', 'url' => '/myauctions-open', 'class' => 'form-inline my-2 my-lg-0', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    
                </span>
                
            </div>
            &nbsp<a href="{{ url('/myauctions') }}" class="btn btn-secondary"> Clear</a>
        {!! Form::close() !!}
        
    </div>
</div>
<br>
<div class="row">
<div class="col-md-12">

        <div class="box box-solid">
            {{-- <div class="box-header with-border">
                <div class="pull-right box-tools">
                        
                        
                </div>
            </div> --}}
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Subasta</th>
                                <th>Status</th>
                                <th>Ofertas</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($auctions as $item)
                            <tr>
                                <td>{{ $item->from }} a {{ $item->to }}</td>
                                <td>
                                    @if ($item->status == 'Closed')
                                        <span class="badge badge-pill badge-success">Closed</span>
                                    @else
                                    <span class="badge badge-pill badge-warning">Open</span>
                                    @endif
                                </td>
                                <td>{{ $item->bids->count() }} </td>
                                
                                <td>
                                    <a href="{{ url('/my-auctions/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    {{-- <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a> --}}
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/auctions', $item->id],
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
                    <div class="pagination"> {!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection