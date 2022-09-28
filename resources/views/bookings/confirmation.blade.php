@extends('layouts.app2')
@section('title', __('Booking confirmation'))
@section('description', __('Details and Payment'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

{{-- Head code --}}
@section('head')
    
@endsection

@section('content')
<div class="pt-5" style="background-image: url('/images/slide.png');">
    <div class="container mb-5">
        {{-- Success message --}}
        @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif
    
        {{-- Error message --}}
        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        {{-- Payment method --}}
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
        {{-- End payment method --}}
        <div class="row ">
    
            <div class="col-md-4">
                @include('bookings.left_column.left_column')
            </div>
    
            <div class="col-md-6">
                <div class="card border-primary">
                    <div class="card-header bg-primary">
                        <h4 class=" card-title d-flex justify-content-between align-items-center">
                            <span class="text-white">{{__('Your cart')}}</span>
                            {{-- <span class="badge badge-light badge-pill">3</span> --}}
                        </h4>
                    </div>
                    @section('starting_bid')
                        {{ $percentage = $auction->servicePrice->starting_bid * 0.10 }}
                        {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                        {{ $total_booking = $auction->order_total + $extras->sum('total')}}
                        {{ $total_auction = $auction->order_total + $extras->sum('total')}}
                        {{ $extras_total = $extras->sum('total')}}
                        {{ $total = $total_auction - $auction->discount}}
                        @if (App\Bid::where('auction_id', $auction->id)->where('won', 1)->count())
                            {{$bid = App\Bid::where('auction_id', $auction->id)->where('won', 1)->first() }}
                            {{$bid_won_percentage = $bid->bid * 0.10}}
                            {{$bid_won = $bid->bid + $bid_won_percentage}}
                        @endif
                    @endsection
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                {{-- <h5 class="my-0">{{__('Vehicle')}}</h5> --}}
                                <h5>{{$auction->servicePrice->vehicle->type}}</h5>
                                <span class="text-muted">Max <strong>{{ $auction->servicePrice->priceOption->max_passengers }}</strong> {{__('passengers')}} </span>
                                {{-- <span class="text-muted">Vehicle details</span> --}}
                            </div>
                            <h5 class="text-muted">
                                @if ($auction->category_id == 7)
                                    {{$auction->country->currency_symbol}}{{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                @else
                                    {{$auction->country->currency_symbol}}{{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                @endif
                                
                            </h5>
                        </li>
                        @if ($extras->count() > 0)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h5 class="my-0">{{__('Extras')}}</h5>
                                @foreach ($extras as $extra)
                                    <span class="text-muted">{{ $extra->quantity }} - {{ $extra->name }} = {{$auction->country->currency_symbol}}{{ number_format($extra->total, 2, '.', ',') }}</span> <br>
                                @endforeach
                            </div>
                            <h5 class="text-muted">{{$auction->country->currency_symbol}}{{ number_format($extras_total, 2, '.', ',') }}</span>
                        </li>
                        @endif
                        
                        @if($auction->discount)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{__('Coupon')}}: {{$coupon->code}}</small></span>
                                <h4>- {{$auction->country->currency_symbol}}{{ number_format($auction->discount, 2, '.', ',') }}</h4>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between">
                            <h5 >Total</span>
                            <h4>{{$auction->country->currency_symbol}}{{ number_format($total, 2, '.', ',') }}</h4>
                            {{-- @if ($auction->category_id == 7)
                                <h4>{{$auction->country->currency_symbol}}{{ number_format($total_booking, 2, '.', ',') }}</h4>
                            @else
                            @endif --}}
                        </li>
                    </ul>
                </div>
                <br>
                  
                {{-- <div class="card border-info">
                    <div class="card-header bg-info">
                        <h4 class="card-title text-white">{{__('Your cart')}} </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="p-2 bd-highlight"><i class="fa fa-money fa-2x text-info" aria-hidden="true"></i></div>
                            <div class="p-2 bd-highlight">
                                @section('starting_bid')
                                    {{ $percentage = $auction->servicePrice->starting_bid * 0.25 }}
                                    {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
                                    {{ $total_booking = $auction->order_total + $extras->sum('total')}}
                                    {{ $total_auction = $auction->order_total + $extras->sum('total')}}
                                    {{ $extras_total = $extras->sum('total')}}
                                    @if (App\Bid::where('auction_id', $auction->id)->where('won', 1)->count())
                                        {{$bid = App\Bid::where('auction_id', $auction->id)->where('won', 1)->first() }}
                                        {{$bid_won_percentage = $bid->bid * 0.25}}
                                        {{$bid_won = $bid->bid + $bid_won_percentage}}
                                    @endif
    
    
                                @endsection
    
                                <small class="text-muted">{{__('Vehicle price:')}}</small><br>
                                @if ($auction->category_id == 7)
                                    <strong>$ {{ number_format($auction->order_total, 2, '.', ',') }}</strong><br>
                                @else
                                    <strong>$ {{ number_format($auction->order_total, 2, '.', ',') }}</strong><br>
                                @endif
    
                                @if ($extras->count() > 0)
                                    <small class="text-muted">{{__('Extras:')}}</small><br>
                                    @foreach ($extras as $extra)
                                        <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }} <br>
                                    @endforeach
                                    <hr>
                                    <h5><small>{{__('Extras total')}}:</small> $ {{ number_format($extras_total, 2, '.', ',') }}</h5>
                                    
                                @endif
                                <hr>
                                @if ($auction->category_id == 7)
                                    <h4><small>{{__('Total')}}:</small> $ {{ number_format($total_booking, 2, '.', ',') }}</h4>
                                @else
                                    <h4><small>{{__('Total')}}:</small> $ {{ number_format($total_auction, 2, '.', ',') }}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> --}}
    
                @if($auction->coupon_id)
    
                    {{-- <div class="spacer"></div>
                    <div class="alert alert-success">
                        {{__('Your discount was applied correctly')}}
                    </div> --}}
                @else
                <div class="card mb-3">
                    <div class="card-body">
                        @if (session()->has('coupon_error'))
                            <div class="spacer"></div>
                            <div class="alert alert-warning">
                                {{ session()->get('coupon_error') }}
                            </div>
                        @endif
                        <h5>{{__('If you have a coupon, please use here')}} </h5>
                       
                        {!! Form::open(['method' => 'PATCH', 'url' => ['booking/apply/coupon', $auction->id], 'class' => 'form-inline needs-validation', 'novalidate']) !!}
                            <div class="form-group mr-2">
                                {{-- <label for="return_airline">{{ __('Departure Airline')}}</label> --}}
                                <input type="text" class="form-control " id="coupon" name="coupon" value="{{ old('coupon') }}" aria-describedby="airlineErrors" required>
                                {{-- <div class="invalid-feedback">
                                    {{ __('Please enter your coupon code') }}
                                </div> --}}
                            </div>{{-- /form-group --}}
                            {{-- hidden fields --}}
                            {{-- {{ Form::hidden('auction_id', $auction->id) }} --}}
    
                            {{-- Button --}}
                            <div class="form-group">
                            {!! Form::button(__('Apply coupon'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary font-weight-bolder',
                                    'title' => __('Apply coupon')
                            )) !!}
                            </div>
                            
                        {!! Form::close() !!}
                    </div>
                </div>
                @endif
                
                <div class="box box-solid box-primary">
                    <div class="box-header">
                        <h4 class="box-title"><i class="fa fa-credit-card" aria-hidden="true"></i> <i class="fa fa-cc-stripe" aria-hidden="true"></i> {{ __('Credit Card') }} </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('payment.stripe') }}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" id="auctionid" name="auctionid" value="{{$auction->id}}">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name_on_card">{{__('Name on card')}}</label>
                                    <input type="text" class="form-control" id="name_on_card" name="name_on_card" aria-describedby="emailHelp">
                                </div>
                                <label for="card-element">
                                    {{__('Credit or debit card')}}
                                </label>
                                <div id="card-element">
                                   
                                </div>
    
                                
                                <div id="card-errors" role="alert"></div>
                            </div>
    
                            <button class="btn btn-primary" id="complete-order">{{__('Submit Payment')}}</button>
                        </form>
                    </div>
                </div>
    
                {{-- <div class="box box-warning box-solid">
                    <div class="box-body">
                        
                        {!! Form::open(['method' => 'POST', 'url' => '/request-payment', 'class' => ''])  !!}
                            <input type="hidden" name="auction_type" value="{{$auction->type}}">
                            <input type="hidden" name="auction_id" value="{{$auction->auction_id}}">
                            <input type="hidden" name="full_name" value="{{$auction->full_name}}">
                            <input type="hidden" name="phone" value="{{$auction->phone}}">
                            <input type="hidden" name="email" value="{{$auction->email}}">
                            <input type="hidden" name="currency" value="{{$auction->country->currency_symbol}}">
                            <input type="hidden" name="total_auction" value="{{$total_auction}}">
    
                            <div class="text-center">
                            {!! Form::button(__('Click for Payment Link'), array(
                                'type' => 'submit',
                                'class' => 'btn btn-primary',
                                'title' => __('Click for Payment Link')
                            )) !!}
    
                            </div>
    
                        {!! Form::close() !!}
                        <br>
                        <div class="text-center">
                            <span><i class="fa fa-phone text-warning" aria-hidden="true"></i> (829) 820-5200</span> | 
                            <span><i class="fa fa-envelope text-warning" aria-hidden="true"></i> info@luefty.com</span>
    
                        </div>
                    </div>
    
                </div> --}}
                {{-- <div class="card">
                    <div class="card-body">
                        <p>If you want a pick up within 36 hours please send a confirmation email to <span class="text-primary">info@luefty.com</span></p>
                    </div>
                </div> --}}
    
                @if( session()->has('info') )
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="lead">{!! session('info') !!}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>{{-- /col --}}
        </div>{{-- /row --}}
    
        
    
        
    </div> {{-- /container --}}
</div>

@endsection

@section('scripts')
<script>
    (function(){
        // Create a Stripe client.
        // var stripe = Stripe('pk_test_oAgmCsXMh2sSvan4psdOX3Qf00tRRvwUDY');
        //var stripe = Stripe('pk_live_tjBT0QVYwjgf2fxCCx7MVjf8'); //DS Stripe
        // var stripe = Stripe('pk_live_51IEEiqISek0g1phCqIb5dSRbxMK6lL3ABuEY5LlPuli573JmzrrZzdvDW2RI5qv1RIrCxu3MemT5eEDP0wlSrzOv00o5389e4h'); //Luefty Stripe 
        var stripe = Stripe('{{env('STRIPE_KEY')}}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true,
            });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Disable the submit button to prevent repeated clicks
        document.getElementById('complete-order').disabled = true;

        var options = {
            name: document.getElementById('name_on_card').value,
            auctionid: document.getElementById('auctionid').value,
            // address_city: document.getElementById('city').value,
            // address_state: document.getElementById('province').value,
            // address_zip: document.getElementById('postalcode').value,
        }

        stripe.createToken(card, options).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            // Enable the submit button
            document.getElementById('complete-order').disabled = false;

            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
    })();
</script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection
