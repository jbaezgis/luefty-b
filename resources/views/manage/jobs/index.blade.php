@extends('layouts.app2')
@section('title', __('Jobs'))

@section('content')
<div class="container-fluid mt-5">

    {{-- Jobs --}}
    <div class="row">

        <div class="col-md-12">
            <a href="{{url('jobs/destroy150')}} " class="btn btn-danger"> Only > 150</a>
            <a href="{{url('jobs/destroyall')}} " class="btn btn-danger"> Delete all</a>
            <div class="card">
                {{-- <div class="card-header">Auctions</div> --}}
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Queue') }}</th>
                                    <th>{{ __('payload') }}</th>
                                    <th>{{ __('attempts') }}</th>
                                    <th>{{ __('reserved_at') }}</th>
                                    <th>{{ __('available_at') }}</th>
                                    <th>{{ __('created_at') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $item)

                                <tr class="{{ $item->deleted === 1 ? 'table-danger' : '' }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->queue }}</td>
                                    <td>{{ $item->payload }}</td>
                                    <td>{{ $item->attempts }}</td>
                                    <td>{{ $item->reserved_at }}</td>
                                    <td>{{ $item->available_at }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    <td>
                                        
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/jobs', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Auction',
                                                    'onclick'=>'return confirm("Are you sure?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>{{-- end card-body --}}
                <div class="card-footer">
                    <div class="pagination"> {!! $jobs->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>{{-- end card --}}
        </div>
    </div>
</div>
@endsection
