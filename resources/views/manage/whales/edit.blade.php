@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="{{url('administration/whales')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Back')}} </a>
		<p></p>
		</div>
	</div>
		<div class="row">
		<div class="col-md-12">
				{{-- <h3>{{__('Tours')}} <small class="text-muted">{{__('Create new')}}</small></h3> --}}
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{__('Whales')}} <small class="text-muted">{{__('Edit')}}</small></h3>
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
					
					<img class="" src="{{URL::asset('storage/images/whales/'. $whale->image)}}" height="150" alt="{{$whale->image}}">
					<p></p>
					<!-- Start form -->
					{{-- {!! Form::open(['url' => 'administration/whales', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!} --}}
					{!! Form::model($whale, ['method' => 'PATCH', 
					'url' => ['administration/whales', $whale->id], 
					'id' => 'locations_form',
					'class' => 'form-horizontal needs-validation','novalidate',
					'enctype' => 'multipart/form-data'
					]) !!}
                        @include ('manage.whales.form')

						<br>
						<button type="submit" class="btn btn-primary" data-submit-value="Please wait...">{{__('Update')}}</button>
					{!! Form::close() !!}
					
					{{-- <form method="POST" action="{{ route('account.store') }}">
						
						@include('manage.whales.form', ['account' => new App\Auction])
				
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