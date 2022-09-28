@extends('layouts.app2')
@section('title', __('Home'))

@section('content')

@if( session()->has('error') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
     </button>
</div>
@endif
<div class="jumbotron jumbotron-fluid slider mb-0">
    <div class="container">
        <div class="container-fluid">
            @if (auth()->guest())

            @endif

        <br>
        {{-- <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="" >{{ __("World's First Transfer & Tour Auction Marketplace") }} </h1>

                <h3 class="">{{ __('Fair Trade Tourism') }} </h3>
                <h3 class="">{{ __('Buy direct from local supplier who keeps 100% of his price') }} </h3>

            </div>
        </div>
        <br>
        <br> --}}

        <div class="container text-black">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            {!! Form::open(['method' => 'POST', 'url' => '/booking/store', 'class' => '', 'role' => 'search'])  !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h5>
                                            {{-- <label for="to">{{ __('From') }}</label> --}}
                                            {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from', 'placeholder'=> __('Click for list or type first letters'), 'class'=>'form-control select2']) !!}
                                            <small id="toErrors" class="form-text text-danger">{{ $errors->first('from') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>{{ __('TO - DROP OFF LOCATION') }} <small>(Details in booking form)</small></h5>
                                            {{-- <label for="to">{{ __('To') }}</label> --}}
                                            {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to', 'placeholder'=> __('Click for list or type first letters'), 'class'=>'form-control select2']) !!}
                                            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="{{ $errors->has('adults') ? ' has-error' : ''}}">
                                            {!! Form::label('adults', 'Adults ', ['class' => 'control-label']) !!}
                                            {!! Form::text('adults', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('adults', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="{{ $errors->has('adults') ? ' has-error' : ''}}">
                                            {!! Form::label('adults', 'Adults ', ['class' => 'control-label']) !!}
                                            {!! Form::text('adults', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('adults', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="{{ $errors->has('adults') ? ' has-error' : ''}}">
                                            {!! Form::label('adults', 'Adults ', ['class' => 'control-label']) !!}
                                            {!! Form::text('adults', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('adults', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="{{ $errors->has('adults') ? ' has-error' : ''}}">
                                            {!! Form::label('adults', 'Adults ', ['class' => 'control-label']) !!}
                                            {!! Form::text('adults', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('adults', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center pt-3">
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-block" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i> {{ __('Search')}} </button>
                                        {{-- <a class="btn btn-warning" href="{{ url('/') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> Clear</a> --}}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>{{-- /box-body --}}
                    </div>{{-- /box --}}
                </div>{{-- /col --}}
            </div>{{-- /row --}}
            {{-- end search box --}}
            <div class="row pt-5 justify-content-center">
                <div class="col-md-8 bg-primary pt-2 text-center">
                    <h4>{{__('World\'s First travel services auction platform')}}</h4>
                </div>
                {{-- <div class="col-md-12 text-center text-white">
                    <h3 class="">{{ __('* No agency saves you as much as 60%') }} </h3>
                </div> --}}
            </div>

            <div class="row pt-2 justify-content-center">
                <div class="col-md-8 bg-primary pt-2 text-center">
                    <h4>{{__('No agency fee, up to 60% less, fair trade tourism')}}</h4>
                </div>
            </div>

            <div class="row pt-2 justify-content-center">
                <div class="col-md-8 bg-primary pt-2 text-center">
                    <h4>{{__('Local suppliers keep 100% of their price')}}</h4>
                </div>
            </div>
        </div>{{-- /container --}}
        </div>
    </div>
</div>
{{-- <div class="container-fluid mb-0 text-center slider">
    <br>
    <br>
    <br>
    <br> --}}
    {{-- <h1 class="" style="text-shadow: 2px 2px 3px #555;">
        {{ __("World's First Transfer & Tour Auction Marketplace") }} </h1>
    <br>
    <div class="row justify-content-md-center text-center">
        <div class="col-md-3">
            <h3 style="text-shadow: 2px 2px 3px #555;">{{ __('I am an Agency') }} </h3>
            <a href="{{ route('pages.agency')}}" class="btn btn-primary">{{ __('Decrease costs, improve service, reduce hassle. Join Luefty!') }} </a>
        </div>

        <div class="col-md-3">
            <h3 style="text-shadow: 2px 2px 3px #555;">{{ __('I am a Supplier') }} </h3>
            <a href="{{ route('pages.operator')}}" class="btn btn-primary">{{ __('Fill Empty legs. Fill idle time. Fill empty places. Join Luefty!') }} </a>
        </div>

        <div class="col-md-3">
            <h3 style="text-shadow: 2px 2px 3px #555;">{{ __('I am a Hotel') }} </h3>
            <a href="{{ route('pages.hotel')}}" class="btn btn-primary">{{ __('Reduce hassle, decrease costs, improve service. Join Luefty!') }} </a>
        </div>
    </div> --}}
    {{-- <br>
    <br>
    <br>
    <br>
</div> --}}

{{-- <div class="container-fluid bg-warning p-5">
    <div class="row text-center">
        <div class="col-md-12">
            <h1 class="text-danger">{{ $auctions->count() }} {{ __('Auctions') }}  </h3>
            <a href="#" class="btn btn-light">{{ __('Bid now') }} </a>
            <h3 class="text-danger">{{ __('Bid now!') }}  </h3>

        </div>
    </div>
</div> --}}

<div class="container-fluid bg-primary">
    @if (auth()->guest())

    @endif

<br>
<div class="row">
    <div class="col-md-12 text-center">
        <h1 class="" >{{ __("World's First Transfer & Tour Auction Marketplace") }} </h1>
        {{-- <br> --}}
        <h3 class="">{{ __('Fair Trade Tourism') }} </h3>
        <h3 class="">{{ __('Buy direct from local supplier who keeps 100% of his price') }} </h3>

        {{-- <h5 class="font-weight-light">{{ __('Join Luefty Auction for 30 days at no charge*') }} </h5>
        <h5 class="font-weight-light">{{ __('Introductory offer: Plans start as low $19.50/month') }} </h5> --}}

        {{-- btn --}}
        {{-- <a href="/register" class="btn btn-warning btn-lg">{{ __('Sign Up' )}} </a> --}}
        {{-- <a href="{{ route('booknow') }}" class="btn btn-warning btn-lg">{{ __('Book Now' )}} </a> --}}
    </div>
</div>
<br>
<br>
{{-- <div class="row">
    <div class="col-md-12 text-center">
        <a href="" class="btn btn-primary">@lang('pages.learn_more')</a>
    </div>
</div> --}}

<div class="container text-black">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'url' => '/booking/store', 'class' => '', 'role' => 'search'])  !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h5>
                                    {{-- <label for="to">{{ __('From') }}</label> --}}
                                    {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from', 'placeholder'=> __('Click for list or type first letters'), 'class'=>'form-control select2']) !!}
                                    {{-- <select class="form-control {{ $errors->has('lang') ? 'has-error' : '' }} select2" id="from" name="from">
                                        @foreach ($services as $item)
                                            <option value="{{$item->from}}">{{$item->fromLocation->name}}</option>
                                        @endforeach
                                    </select> --}}
                                    <small id="toErrors" class="form-text text-danger">{{ $errors->first('from') }}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>{{ __('TO - DROP OFF LOCATION') }} <small>(Details in booking form)</small></h5>
                                    {{-- <label for="to">{{ __('To') }}</label> --}}
                                    {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to', 'placeholder'=> __('Click for list or type first letters'), 'class'=>'form-control select2', 'onchange'=>'this.form.submit()' ]) !!}
                                    {{-- <select class="form-control {{ $errors->has('lang') ? 'has-error' : '' }} select2" id="to" name="to">
                                        @foreach ($services as $item)
                                            <option value="{{$item->to}}">{{$item->toLocation->name}}</option>
                                        @endforeach
                                    </select> --}}
                                    <small id="toErrors" class="form-text text-danger">{{ $errors->first('to') }}</small>
                                </div>
                            </div>
                            {{-- <div class="col-md-2" style="margin-top: 25px;">
                                <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                                <a class="btn btn-warning" href="{{ url('/') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> Clear</a>
                            </div> --}}
                        </div>
                    {!! Form::close() !!}
                </div>{{-- /box-body --}}
            </div>{{-- /box --}}
        </div>{{-- /col --}}
    </div>{{-- /row --}}
    {{-- end search box --}}
    <div class="row pt-5">
        <div class="col-md-12 text-center text-white">
            <h3 class="">{{ __('* No agency saves you as much as 60%') }} </h3>
        </div>
    </div>
</div>{{-- /container --}}
</div>

<div class="home-divider">

</div>

<div class="row">

</div>
{{-- <div class="row text-center">

            <div class="col-md-4 text-center">
                <i class="fa fa-search fa-3x text-primary"></i>
                <p></p>
                <h5 class="font-weight-light text-primary">@lang('pages.find_auctions')</h5>

            </div>
            <div class="col-md-4 text-center text-warning">
                <i class="fa fa-gavel fa-3x"></i>
                <p></p>
                <h5 class="font-weight-light">@lang('pages.start_bidding')</h5>

            </div>
            <div class="col-md-4 text-center text-success">
                <i class="fa fa-check fa-3x"></i>
                <p></p>
                <h5 class="font-weight-light">@lang('pages.win_the_auction')</h5>

            </div>


        </div> --}}

<br>
<br>
{{-- @if (auth()->guest())
    Eres un invitado
@else
    @if (auth()->user()->email_verified_at)
    Esta verifidado
    @else
    No esta verificado
    @endif
@endif --}}

@endsection

@section('scripts')

<script>
    function fromValue(){
        $('select[name="from"]').on('change', function(){
            var inputVal = document.getElementById("from").value;
        });
    }
</script>

<script>
	$(document).ready(function(){

		// $('select[name="from"]').on('change', function(){

		// 	var from = $(this).val();
		// 	if(from){
		// 		// console.log(from_city);
		// 		$.ajax({
		// 			url: '/service-to/'+from,
		// 			type: 'GET',
		// 			dataType: 'json',
		// 			success: function(data){
		// 				// console.log(data);
		// 				$('#to').empty();
		// 				$('#to').append('<option value="" disable="true" selected="true">Select Location</option>');

		// 				$.each(data, function(index, to){
		// 					$('#to').append('<option value="'+ to.id +'">' + to.toLocation.name + '</option>');
		// 				})
		// 			}
		// 		});
		// 	}
		// });

		// $('select[name="to_city"]').on('change', function(){

		// 	var to_city = $(this).val();
		// 	if(to_city){
		// 		// console.log(to_city);
		// 		$.ajax({
		// 			url: '/to_locations/'+to_city,
		// 			type: 'GET',
		// 			dataType: 'json',
		// 			success: function(data){
		// 				// console.log(data);
		// 				$('#to_location').empty();
		// 				$('#to_location').append('<option value="" disable="true" selected="true">Select Location</option>');

		// 				$.each(data, function(index, to_locationObj){
		// 					$('#to_location').append('<option value="'+ to_locationObj.id +'">' + to_locationObj.name + '</option>');
		// 				})
		// 			}
		// 		});
		// 	}
		// });

	});
</script>
@endsection
