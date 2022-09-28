@extends('layouts.app2')
@section('title', trans('menu.home'))

@section('content')

<div class="container-fluid mb-0 text-center slider">
    <br>
    <br>
    <br>
    <br>
    <h1>{{ __("World's First Transfer & Tour Auction Marketplace") }} </h1>
    <br>
    <div class="row justify-content-md-center text-center">
        <div class="col-md-3">
            <h3>{{ __('Hotel') }} </h3>
            <a href="#" class="btn btn-primary">{{ __('I am a hotel, resort, property manager or company' )}} </a>
        </div>
        <div class="col-md-3">
            <h3>{{ __('Agency') }} </h3>
            <a href="#" class="btn btn-primary">{{ __('I am an agency, broker or aggregator' )}} </a>
        </div>
        <div class="col-md-3">
            <h3>{{ __('Operator') }} </h3>
            <a href="#" class="btn btn-primary">{{ __('I operate transfers, small arcraft or tours' )}} </a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>


<div class="container-fluid bg-primary">
    @if (auth()->guest())

    @endif

<br>
<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="">{{ __('Place your Auctions or Make your Bids') }} </h3>
        <h3 class="">{{ __('Lower Cost or Fill Empty Legs, Empty Seats, Idle Capacity') }} </h3>
        <h5 class="font-weight-light">{{ __('Join Luefty Auction for 30 day at no charge*') }} </h5>
        <h5 class="font-weight-light">{{ __('Plans start as low $19.50/month') }} </h5>
        <a href="#" class="btn btn-warning btn-lg">{{ __('Sign Up' )}} </a>
    </div>
</div>
<br>
<br>
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
{{-- <div class="row">
        <div class="col-md-12 text-center"> 
            <a href="" class="btn btn-primary">@lang('pages.learn_more')</a>
        </div>
    </div> --}}



</div>  

<div class="home-divider">

</div>

<br>
<br>
{{-- <div class="container-fluid">
<div class="row">
    <div class="col-md-6 text-light text-center" style="background-color: #00bf6f;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <br>
                    <i class="fa fa-bus fa-3x"></i>  <i class="fa fa-car fa-3x"></i>
                    <h3>@lang('pages.transfer_provider')</h3>
                    <br>
                    <p>@lang('pages.transfer_provider_text')</p>
                    
                    <br>
                    <br>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-6 text-light text-center" style="background-color: #05467e;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <br>
                    <i class="fa fa-building-o fa-3x"></i>
                    <h3>@lang('pages.agency_or_hotel')</h3>
                    <br>
                    <p>@lang('pages.agency_or_hotel_text')</p>
                    
                    <br>
                    <br>
                </div> 
            </div>
        </div>
    </div>
</div>
</div> --}}
@endsection
