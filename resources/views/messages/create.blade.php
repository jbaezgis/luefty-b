@extends('layouts.app2')
@section('title', 'Contact Us')

@section('content')
{{-- <div class="page-title ">
    <div class="container">
      <h1 class="">{{ trans('pages.contact_title') }}</h1>
    </div>
</div> --}}
<p></p>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			{{-- <h5 class="text-primary">{{ __('Phone:')}} </h5> --}}
			{{-- <p class="lead">954 889-6784</p> --}}
			<p></p>
			<h5 class="text-primary">{{ __('Email')}}: </h5>
			<p class="lead">info@luefty.com</p>
		</div>
		<div class="col-md-8">
			<h2>{{ __('Contact Us') }}</h2>
			<p class="lead">{{__('Reach out to us for any inquiry.')}} </p>
			<hr>
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
				  <strong>Oopps!</strong> {{ __('Error') }}
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				  <!-- @foreach ($errors->all() as $error)
				  		<small id="nameErrors" class="form-text">{{ $error }}</small>

					@endforeach  -->
				</div>
			@endif

			<!-- Start form -->

			<form method="POST" class="form-message" action="{{ route('messages.store') }}">
				@csrf
				<div class="form-group">
				    <label for="name">{{ __('Full name') }}</label>
				    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" aria-describedby="nameErrors">
				    <small id="nameErrors" class="form-text text-danger">{{ $errors->first('name') }} </small>
				</div>
				<div class="form-group">
				    <label for="email">{{ __('Email') }}</label>
				    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}"  aria-describedby="emailErrors">
				    <small id="emailErrors" class="form-text text-danger">{{ $errors->first('email') }}</small>
				</div>
				<div class="form-group">
				    <label for="message">{{ __('Message') }}</label>
				    <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" id="message" name="message" rows="3" value="{{ old('message') }}"  aria-describedby="messajeErrors"></textarea>
				    <small id="messajeErrors" class="form-text text-danger">{{ $errors->first('message') }}</small>
				</div>

				<button type="submit" class="btn btn-primary" data-submit-value="Please wait...">{{ __('Submit') }}</button>
			</form>
			<!-- End form -->

		</div>
	</div>

</div>
@endsection
