@extends('layouts.app2')

@section('content')
<div class="container-fluid">
{{-- <div class="container-title">
		<h2 class="page-title bg-primary"><i class="fa fa-car"></i> @lang('auctions.my_transfers')</h2>
	</div> --}}
	<br>
	<div class="row pl-3">
		<div class="col-md-12">
			
			<a href="{{ url('/myauctions') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('globals.go_back')</a> 
			{{-- <div class="btn-group" role="group" aria-label="Basic example">
				<a href="" class="btn btn-primary btn-sm"><i class="fa fa-list" aria-hidden="true"></i></a>    
				<a href="{{ url('/myauctions') }}" class="btn btn-light btn-sm"> @lang('auctions.see_all_transfers')</a>
			</div> --}}
		</div>
	</div>
	<hr>
</div>

<div class="container">
		@if( session()->has('updated') )
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{!! session('updated') !!}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif
		<br>
		<div class="row">
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">@lang('globals.edit_auction') </h3>
				</div>
				<div class="box-body">	
					<h4><span class="font-weight-light">@lang('globals.auction_type'):</span> {{ $auction->category->name }}	</h4>
					<p>{!! $auction->category->Description !!}</p>
					<br>
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
					{!! Form::model($auction, [
                        'method' => 'PATCH',
                        'url' => ['/myauctions', $auction->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include ('myauctions.form', ['formMode' => 'edit'])

                   
					
					{{-- <form method="PATCH" action="{{ route('myauctions.update') }}"> --}}
						
						{{-- @include('myauctions.form', ['account' => new App\Auction, 'formMode' => 'edit']) --}}
						
						
					
					<!-- End form -->
				</div>
				<div class="box-footer">
					{{-- <a href="{{ url('myauction/delete/' . $auction->id) }}" class="btn btn-danger">{{ __('Cancel and Delete') }} <i class="fa fa-times" aria-hidden="true"></i></a> --}}
					
					<button type="submit" class="btn btn-primary pull-right">
						{{ trans('globals.save') }} <i class="fa fa-floppy-o" aria-hidden="true"></i>
					</button>
					{!! Form::close() !!}
						<!-- End edit form -->

					{!! Form::open([
						'method' => 'DELETE',
						'url' => ['/myauctions', $auction->id],
						'style' => 'display:inline'
					]) !!}
						<button type="submit" class="btn btn-danger " title="{{ __('Cancel and Delete')}}">@lang('Cancel and Delete') <i class="fa fa-trash-o" aria-hidden="true"></i></button>
					{!! Form::close() !!}
					
					{{-- Cancel and go back button --}}
					@if ($auction->category->name === 'Sharing')
					<a href="{{ url('myauctions/sharing/index') }}" 
						class="btn btn-warning pull-right mr-2" 
						title="{{ __('Go back') }}"> 
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
						{{ __('Cancel and go back') }}
					</a>
					@elseif ($auction->category->name === 'Tour')
						<a href="{{ url('myauctions/tours/index') }}" 
							class="btn btn-warning pull-right mr-2" 
							title="{{ __('Go back') }}"> 
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
							{{ __('Cancel and go back') }}
						</a>
					@elseif ($auction->category->name === 'Empty Legs')
						<a href="{{ url('myauctions/empty-legs/index') }}" 
							class="btn btn-warning pull-right mr-2" 
							title="{{ __('Go back') }}"> 
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
							{{ __('Cancel and go back') }}
						</a>
					@else
						<a href="{{ url('myauctions') }}" 
							class="btn btn-warning pull-right mr-2" 
							title="{{ __('Go back') }}"> 
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
							{{ __('Cancel and go back') }}
						</a>
					@endif

				</div>
			</div>
		</div>
		</div>
</div>
@endsection