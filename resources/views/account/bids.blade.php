@extends('layouts.app2')
@section('title', 'Bids')

@section('content')
<br>
<div class="container-fluid">
<div class="row">
@include('account.sidebar')
<div class="col-md-9">
        <div class="card">
            <div class="card-header">Bids</div>
            <div class="card-body">
                
                {!! Form::open(['method' => 'GET', 'url' => '/my-bids', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                <th>Subasta</th>
                                <th>Mi oferta</th>
                                <th>Estado</th>
                                <th>Ganaste?</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            <tr>
                                <td>
                                    @if ($bid->auction_id)
                                        <strong>Traslado:</strong> {{ $bid->auction['from'] }} a {{ $bid->auction['to'] }}
                                    @else
                                    <strong>Tour:</strong> {{ $bid->tour['location'] }}
                                    @endif
                                </td>
                                <td>$ {{ number_format($bid->bid, 2, '.', ',') }}</td>
                                <td>
                                    @if ($bid->auction_id)
                                        @if ($bid->auction['status'] === 'Closed')
                                        <span class="badge badge-pill badge-success">Closed</span>
                                        @endif
                                    @else
                                        @if ($bid->tour['status'] === 'Closed')
                                        <span class="badge badge-pill badge-success">Closed</span>
                                        @endif
                                    @endif

                                </td>
                                <td>
                                    @if ($bid->won === 1)
                                    <span class="text-success">Ganaste</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($bid->auction_id)
                                        <a href="{{ url('/my-auctions/' . $bid->auction_id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver traslado</button></a> 
                                    @else 
                                    <a href="{{ url('/my-tours/' . $bid->tour_id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver tour</button></a> 
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination"> {!! $bids->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection