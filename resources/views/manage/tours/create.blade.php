@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="{{url('administration/content/tours')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Back')}}</a>
		</div>
	</div>
		<div class="row">
		<div class="col-md-12">
				{{-- <h3>{{__('Tours')}} <small class="text-muted">{{__('Create new')}}</small></h3> --}}
				<p></p>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{__('Tours')}} <small class="text-muted">{{__('Create new')}}</small></h3>
				</div>
				<div class="card-body">	
					@if( session()->has('info') )
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{!! session('info') !!}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif

					@if($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Oopps!</strong> {{ trans('pages.message_error') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							@foreach ($errors->all() as $error)
									<small id="nameErrors" class="form-text">{{ $error }}</small>
								
							@endforeach
						</div>
					@endif

					<!-- Start form -->
					{!! Form::open(['url' => 'administration/content/tours', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                        {{-- @include ('manage.tours.form') --}}
						<div class="form-group">
							<label for="from" class="">{{__('Attraction')}}</label><br>
							{{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br> --}}
							{{-- <small>{{__('Pick up location.')}} </small> --}}
							{!! Form::select('attraction_id', App\Attraction::orderBy('title', 'asc')->pluck('title', 'id'), null, ['id'=>'attraction_id', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
							<small id="fromErrors" class="form-text text-danger">{{ $errors->first('attraction_id') }}</small>
							<div class="invalid-feedback">
								{{ __('Please select an Attraction') }}
							</div>
						</div>

						<div class="form-group">
							<div class="{{ $errors->has('title') ? ' has-error' : ''}}">
								{!! Form::label('title', __('Title'), ['class' => 'control-label']) !!}
								{!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
								{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
							</div>
						</div>

						<br>
						<button type="submit" class="btn btn-primary pull-right" data-submit-value="Please wait...">{{__('Continue')}}</button>
					{!! Form::close() !!}
					
					{{-- <form method="POST" action="{{ route('account.store') }}">
						
						@include('manage.tours.form', ['account' => new App\Auction])
				
					</form> --}}
					<!-- End form -->
					<!-- End form -->
				</div>
			</div>
		</div>
		</div>
</div>
@endsection

@section('scripts')
<script>
	function AvoidSpace(event) {
		var k = event ? event.which : window.event.keyCode;
		if (k == 32) return false;
	}
</script>
@endsection