@extends('layouts.app2')
@section('title', 'Tours')

@section('content')
<br>
<div class="container-fluid">
<div class="row">
	@include('account.sidebar')
	<div class="col-md-9">
			<h3>
					Mis Tours
					<small class="text-muted">All data</small>
				</h3>
				<div class="box box-solid">
					<div class="box-header with-border">
						
						<a href="{{ url('/tours/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar tour</a>
						<div class="pull-right box-tools">
								{!! Form::open(['method' => 'GET', 'url' => '/my-tours', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
								<div class="input-group">
									<input type="text" class="form-control" name="search" placeholder="Search...">
									<span class="input-group-append">
										<button class="btn btn-secondary" type="submit">
											<i class="fa fa-search"></i>
										</button>
									</span>
								</div>
								{!! Form::close() !!}
								
						</div>
					</div>
					<div class="box-body">
		
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Tour</th>
										<th>Ofertas</th>
										<th></th>
		
									</tr>
								</thead>
								<tbody>
								@foreach($tours as $item)
									<tr>
										<td>{{ $item->location }}</td>
										<td>{{ $item->bids->count() }} </td>
										
										<td>
											<a href="{{ url('/my-tours/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
											{{-- <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a> --}}
											{!! Form::open([
												'method' => 'DELETE',
												'url' => ['/tours', $item->id],
												'style' => 'display:inline'
											]) !!}
												{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
														'type' => 'submit',
														'class' => 'btn btn-danger btn-sm',
														'title' => 'Delete Tour',
														'onclick'=>'return confirm("Confirm delete?")'
												)) !!}
											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							<div class="pagination"> {!! $tours->appends(['search' => Request::get('search')])->render() !!} </div>
						</div>
		
					</div>
				</div>
    </div>
</div>
@endsection   