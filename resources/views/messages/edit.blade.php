@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<div class="page-title ">
    <div class="container">
      <h1 class="">{{ trans('pages.contact_title') }}</h1>
    </div>
</div>
<div class="container">
	<h2>{{ trans('pages.get_in_touch') }}</h2>
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
				  <strong>Oopps!</strong> {{ trans('pages.message_error') }}
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				  <!-- @foreach ($errors->all() as $error)
				  		<small id="nameErrors" class="form-text">{{ $error }}</small>
					   
					@endforeach  -->
				</div>
			@endif

			<!-- Start form -->
			
			<form method="POST" action="{{ route('messages.update', $message->id) }}">
				{!! method_field('PUT') !!}
				@csrf
				<div class="form-group">
				    <label for="name">{{ trans('pages.contact_full_name') }}</label>
				    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ $message->name }}" aria-describedby="nameErrors" placeholder="Enter your name">
				    <small id="nameErrors" class="form-text text-danger">{{ $errors->first('name') }} </small>
				</div>
				<div class="form-group">
				    <label for="email">{{ trans('pages.contact_email') }}</label>
				    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" value="{{ $message->email }}"  aria-describedby="emailErrors" placeholder="Enter email">
				    <small id="emailErrors" class="form-text text-danger">{{ $errors->first('email') }}</small>
				</div>
				<div class="form-group">
				    <label for="message">{{ trans('pages.contact_message') }}</label>
				    <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" id="message" name="message" rows="3" aria-describedby="messajeErrors">{{ $message->message }}</textarea>
				    <small id="messajeErrors" class="form-text text-danger">{{ $errors->first('message') }}</small>
				</div>

				<button type="submit" class="btn btn-primary">{{ trans('pages.contact_send') }}</button>
			</form>
			<!-- End form -->
</div>
@endsection