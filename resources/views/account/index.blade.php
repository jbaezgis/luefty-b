@extends('layouts.app2')
@section('title', 'Dashboard')

@section('content')
<br>
<div class="container-fluid">
<div class="row">
	@include('account.sidebar')
	<div class="col-md-9">
            {{-- <h3>
                Mi cuenta
                <small class="text-muted"></small>
            </h3> --}}
		<div class="row">
            {{-- <div class="col-md-12">
                <h4>Crear subastas</h4>
                <a href="{{ url('/account/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar traslado</a>
                <a href="{{ url('/tours/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar tour</a>
            </div> --}}

			{{-- <div class="col-md-3">
				<div class="box box-solid">
					<div class="box-body">
						<span class="info-box-text">Subastas</span>
						<span class="info-box-number">{{ $auctions->count() }}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div> --}}
		</div>
	
	{{-- <div class="row">
		@if ($bids->count() > 0)
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Mis ofertas en traslados</h3>
				</div>
				<div class="box-body">
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
                                <th>Traslado</th>
                                <th>Mi oferta</th>
                                <th>Estado</th>
                                <th>Ganaste?</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            <tr>
                                <td>{{ $bid->auction->from }} a {{ $bid->auction }}</td>
                                <td>$ {{ number_format($bid->bid, 2, '.', ',') }}</td>
                                <td>
                                    @if ($bid->auction()->status === 'Closed')
                                    <span class="badge badge-pill badge-success">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($bid->won === 1)
                                    <span class="text-success">Ganaste</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/my-auctions/' . $bid->auction_id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver subasta</button></a> 
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
		@endif
    </div> --}}
    
    {{-- <div class="row">
            @if ($bids->count() > 0)
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mis ofertas en tours</h3>
                    </div>
                    <div class="box-body">
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
                                    <th>Tour</th>
                                    <th>Mi oferta</th>
                                    <th>Estado</th>
                                    <th>Ganaste?</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($bids as $bid)
                                <tr>
                                    <td>{{ $bid->tour->location }}</td>
                                    <td>$ {{ number_format($bid->bid, 2, '.', ',') }}</td>
                                    <td>
                                        @if ($bid->tour['status'] === 'Closed')
                                        <span class="badge badge-pill badge-success">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bid->won === 1)
                                        <span class="text-success">Ganaste</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/my-tours/' . $bid->tour_id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver subasta</button></a> 
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
            @endif
        </div> --}}
</div>
</div>
</div>
@endsection