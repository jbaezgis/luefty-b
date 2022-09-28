@extends('layouts.app2')

@section('content')
<div class="page-title ">
    <div class="container">
      <h1 class="">Auctions</h1>
    </div>
</div>
<br>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Auctions</div>
                <div class="card-body">

                    {{-- <a href="{{ url('/auctions/create') }}" class="btn btn-success btn-sm" title="Add New Auction">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                     --}}


                    {!! Form::open(['method' => 'GET', 'url' => '/auctions', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                        <span class="input-group-append">
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
                                    <th>ID</th>
                                    <th>{{ __('SN') }}</th>
                                    <th>{{ __('Auction') }}</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Auctioneer') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>Bids</th>
                                    <th>{{ __('Published at') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($auctions as $item)

                                <tr class="{{ $item->deleted === 1 ? 'table-danger' : '' }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->service_number }}</td>
                                    <td>{{ $item->fromcity['name'] }} <strong>to</strong> {{ $item->tocity['name']}}</td>
                                    <td>{{ date('D, M j - Y, g:i A ', strtotime($item->end_date)) }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        @if ($item->changed === 1 & $item->status === 'Closed')
                                            <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                        @elseif ($item->changed === 1)
                                            <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is Changed because you updated its info') }}" data-placement="top">{{ __('Changed')}} </span>
                                        @else
                                            @if ($item->status == 'Closed')
                                                <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                            @else
                                                @if ($item->bids->count() > 0)
                                                    <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ __('This Auction is Open because has one bid or more.') }}" data-placement="top">{{ __('Open') }}</span>
                                                @else
                                                    <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is do not have bids.') }}" data-placement="top">{{ __('No bid yet') }}</span>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $item->bids->count() }} </td>
                                    <td>{{ date('D, M j - Y, g:i A', strtotime($item->created_at)) }} ({{ $item->created_at->diffForHumans() }})</td>

                                    <td>
                                        <a href="{{ url('/manageauctions/show/' . $item->id) }}" title="View Auctions"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        {{-- <a href="{{ url('/auctions/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a> --}}
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/auctions', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Auction',
                                                    'onclick'=>'return confirm("Are you sure you want to delete this auction?")'
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
