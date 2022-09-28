@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a href="{{url('administration/content/locations')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Back')}} </a>
		<p></p>
		</div>
	</div>
		<div class="row">
			{{-- <div class="col-md-3">
				@include('layouts.admin.sidebar')
			</div> --}}
		<div class="col-md-12">
				{{-- <h3>{{__('Tours')}} <small class="text-muted">{{__('Create new')}}</small></h3> --}}
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{__('Locations')}} <small class="text-muted">{{__('Edit')}}</small></h3>
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
					
					{{-- <img class="" src="{{URL::asset('storage/images/posts/'. $post->img)}}" height="150" alt="{{$post->img}}"> --}}
					<p></p>
					<!-- Start form -->
					{{-- {!! Form::open(['url' => 'administration/posts', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!} --}}
					{!! Form::model($location, ['method' => 'PATCH', 
					'url' => ['administration/content/locations', $location->id], 
					'id' => 'locations_form',
					'class' => 'form-horizontal needs-validation','novalidate',
					'enctype' => 'multipart/form-data'
					]) !!}
                        @include ('manage.locations.form')

						<br>
						<button type="submit" class="btn btn-primary" data-submit-value="Please wait...">{{__('Update')}}</button>
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

<script>
    $(function () {
        $('#post-image').fileinput({
        theme: 'fa',
        // showPreview: false,
        showUpload: false,
        showRemove: false,
        showClose: false,
		maxFileCount: 1,
        initialPreview: [
			"<img src='{{URL::asset('storage/images/locations/'. $location->image)}}' class='file-preview-image' alt='{{$location->name}}' title='{{$location->name}}'>",
		],
        });

        $('#post-multiple-images').fileinput({
        theme: 'fa',
        showUpload: false,
        showRemove: true,
        showClose: false,
		maxFileCount: 4,
        });
    });
</script>

@endsection