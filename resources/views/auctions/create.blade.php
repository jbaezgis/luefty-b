@extends('layouts.app2')

@section('content')
<div class="page-title ">
    <div class="container">
      <h1 class="">Auction - Create</h1>
    </div>
</div>
<div class="container">
	<div class="card">
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
			
			<form method="POST" action="{{ route('auctions.store') }}">
				
				@include('auctions.form', ['auction' => new App\Auction])
				
				<br>
				<button type="submit" class="btn btn-primary" data-submit-value="Please wait...">
					{{ trans('pages.contact_send') }}
				</button>
			</form>
			<!-- End form -->
			<!-- End form -->
		</div>
	</div>
</div>
@endsection