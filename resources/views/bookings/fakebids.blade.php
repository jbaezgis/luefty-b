@extends('layouts.app2')
@section('title', $auction->full_name . ' - ' .__('Booking Details'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

@section('variables')
    {{ $percentage = $auction->servicePrice->starting_bid * 0.10 }}
    {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
    {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
    {{ $extras_total = $extras->sum('total')}}
@endsection
<div class="bids">
<div class="pt-5" style="background-image: url('/images/slide.png');">
    <div class="container">
        <div class="row ">
            <div class="col-md-4 d-none d-sm-none d-md-block">
                @include('bookings.left_column.left_column')
            </div>
    
                <div class="col-md-8 ">
    
                    {{-- Cannot edit alert --}}
                    @if( session()->has('cannot_edit') )
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">{{ __('Sorry!') }} <small>{{ session('cannot_edit') }}</small></h4>
                            <hr>
                            {{__('If you want to cancel this auction and create another one, please click cancel!')}} <br>
                            <p></p>
                            {{-- <a href="#" class="btn btn-warning">{{__('Cancel')}} </a> --}}
                            {!! Form::open(['method' => 'DELETE', 'url' => ['/booking/cancel', $auction->id], 'style' => 'display:inline']) !!}
                                {!! Form::button(__('Cancel'), array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-warning',
                                        'title' => __('Do you want to cancel this auction?')
                                )) !!}
                            {!! Form::close() !!}
                        </div>
                    @endif
    
                    {{-- Contact info --}}
    
                    {{-- <div class="card">
                        <div class="card-header">
                            {{__('Contact info')}}
                        </div>
    
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="pr-4">
                                    <small class="text-muted">{{__('Name')}}</small><br>
                                    <span>{{$auction->full_name}}</span>
                                </div>
                                <div class="pr-4">
                                    <small class="text-muted">{{__('Email')}}</small><br>
                                    <span>{{$auction->email}}</span>
                                </div>
                                <div class="pr-4">
                                    <small class="text-muted">{{__('Phone')}}</small><br>
                                    <span>{{$auction->phone}}</span>
                                </div>
                                <div class="pr-4">
                                    <small class="text-muted">{{__('Language')}}</small><br>
                                    <span>{{$auction->language}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p></p> --}} 
    
                    @section('starting_bid')
                        {{ $percentage = $auction->servicePrice->oneway_price * 0.10 }}
                        {{ $starting_bid = $auction->servicePrice->oneway_price + $percentage }}
                        {{ $date_remaining = \Carbon\Carbon::parse($auction->date) }}
                        {{ $date_time = $auction->date . ' ' .$auction->arrival_time}}
                        {{ $date_r=strtotime($date_time)}}
                        {{ $diff=$date_r-time() }}
                        {{ $days=floor($diff/(60*60*24)) }}
                        {{ $hours=round(($diff-$days*60*60*24)/(60*60)) }}
                    @endsection

                    <div class="row justify-content-center parrot-pooping">
                        @if($fakebids->count() < 4)
                            <div class="col-md-12 text-center d-none d-sm-none d-md-block">
                                <img src="{{asset('images/parrot/parrot_poop.gif')}}" height="350" alt="Best bid">
                            </div>
                            
                            <div class="col-md-12 text-center d-block d-sm-block d-md-none">
                                <img src="{{asset('images/parrot/parrot_poop.gif')}}" height="250" alt="Best bid">
                            </div>
                        @endif

                </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <div class="blue-border border-rounded bg-white p-3">
                                @if($fakebids->count() < 4)
                                    <h5 class="bg-primary py-2 px-5 border-rounded">{{__('Current Offer')}} </h5>
                                @else
                                <h4 class="bg-primary py-2 px-5 border-rounded">{{__('Last auction price!')}} </h4>
                                @endif
                                <h1 class="display-4 py-3 {{$fakebids->count() == 4 ? 'text-success' : 'text-primary'}} ">{{$auction->country->currency_symbol}}{{ number_format($fakebid->bid, 2, '.', ',') }}</h1>
                                
                                {{-- @if($fakebids->count() < 4)
                                    <span class="font-weight-bolder">{{__('Buy Now or wait for better bid')}}</span>
                                @endif --}}
                                
                                {!! Form::open(['method' => 'PATCH', 'url' => ['fakebids', $fakebid->id], 'style' => 'display:inline']) !!}
                                    {{-- hidden fields --}}
                                    {{ Form::hidden('auction_id', $auction->id) }}

                                    {{-- Button --}}
                                    {!! Form::button(__('ACCEPT THIS OFFER'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-primary green-border btn-block btn-lg font-weight-bolder',
                                            'id' => 'buynow',
                                            'title' => __('Buy Now'),
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => $fakebids->count() < 4 ? __('ACCEPT THIS OFFER (or see more bids)') : __('ACCEPT BID')
                                            
                                    )) !!}
                                    
                                {!! Form::close() !!}
                                {{-- @if($fakebids->count() == 4)
                                @else
                                    
                                        {!! Form::open(['method' => 'POST', 'url' => 'fakebids'])  !!}
                                            
                                            {{ Form::hidden('auction_id', $auction->id) }}
            
                                            
                                            {!! Form::button(__('See next offer'), array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-primary btn-block btn-lg font-weight-bolder',
                                                    'title' => __('See next offer'),
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top'
                                            )) !!}
                                            
                                        {!! Form::close() !!}
                                    
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    <br>
                    {{-- <div class="box box-solid box-warning">
                        <div class="box-header with-border">
                            <h4 class="box-title">{{ __('Buy Now or see Supplier Offers')}} </h4>
                        </div>
                        <div class="box-body">
                            <p>Text for bids</p>
                            
                            @for($i=0; $i < 1; $i++)
                            @endfor
                            @foreach ($fakebids as $bid)
                            @section('bid')
                                {{ $bid_per = $bid->bid * 0.1 }}
                                {{ $bid_total = $bid->bid + $bid_per }}
                            @endsection
    
                            
                            <div class="row border-top py-2 mt-2">
                                <div class="col-md-3">
                                
                                    
                                    <span class="text-muted">{{__('Bid')}}</span><br>
                                    <span>{{__('Bid')}} {{ $i++ }}</span>
                                </div>
    
                        
    
                                <div class="col-md-3">
                                    <span class="text-muted">{{__('Amount')}}</span><br>
                                    <h5>{{$auction->country->currency_symbol}}{{ number_format($bid->bid , 2, '.', ',') }}</h5>
                                </div>
    
                                <div class="col-md-3 pt-3">
    
                                    {!! Form::open(['method' => 'PATCH', 'url' => ['fakebids', $bid->id], 'style' => 'display:inline']) !!}
                                        
                                        {{ Form::hidden('auction_id', $auction->id) }}
    
                                        
                                        {!! Form::button(__('Buy now'), array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-warning btn-block font-weight-bolder',
                                                'title' => __('Accept Bid'),
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'top',
                                                'title' => __('Buy now or wait for better bid')
                                        )) !!}
                                        
                                    {!! Form::close() !!}
                                    
                                </div>
                            </div>
                            
                            @endforeach
                        </div>
                    </div> --}}
                    <div class="row justify-content-center">
                        @if($fakebids->count() == 4)
                         
                        @else
                            <div class="col-md-3">
                                <div class="mb-3 mallet" id="loading"> 
                                    <img src="{{asset('images/mallet.svg')}}" height="70" alt="Mallet">
                                </div>
                                {!! Form::open(['method' => 'POST', 'url' => 'fakebids', 'id' => 'nextofferform'])  !!}
                                    
                                    {{ Form::hidden('auction_id', $auction->id) }}
    
                                    
                                    {{-- {!! Form::button(__('See next offer'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-primary btn-block btn-lg font-weight-bolder',
                                            'id' => 'nextoffer'
                                    )) !!} --}}
                                    {{-- <button class="btn btn-primary btn-block btn-lg font-weight-bolder" id="nextoffer">{{__('See next offer')}}</button> --}}
                                {!! Form::close() !!}
                                <button class="btn btn-primary btn-block btn-lg font-weight-bolder" id="nextoffer">{{__('SEE NEXT BID')}}</button>
                            </div>
                        @endif
                    </div>
    
                    <div class="row justify-content-center text-center">
                        
                        {{-- PC --}}
                        <div class="d-none d-sm-none d-md-block">
                            @if($fakebids->count() == 4)
                                <div class="col-md-12">
                                    <img src="{{asset('images/parrot/best_bid.gif')}}" height="450" alt="Best bid">
                                </div>
                            @else
                                <div class="col-md-12">
                                    <img src="{{asset('images/parrot/parrot_fakebids.png')}}" height="450" alt="Parrot Thinking">
                                </div>
                            @endif
                        </div>
                        
                        {{-- mobile --}}
                        <div class="d-block d-sm-block d-md-none">
                            @if($fakebids->count() == 4)
                                <div class="col-md-12">
                                    <img src="{{asset('images/parrot/best_bid.gif')}}" height="250" alt="Best bid">
                                </div>
                            @else
                                <div class="col-md-12">
                                    <img src="{{asset('images/parrot/parrot_fakebids.png')}}" height="250" alt="Parrot Thinking">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Details for mobile --}}
                    <div class="col-md-4  d-block d-sm-block d-md-none mt-3">
                        @include('bookings.left_column.left_column')
                    </div>
                </div>{{-- /col --}}
    
    </div>
</div>
{{-- <div class="modal-loading"></div> --}}
</div> {{-- Bids --}}
@endsection

@section('scripts')

<script>
    $("#loading").hide();
    $(document).ready(function(){
        $("#nextoffer").click(function(){
            $("#loading").fadeIn();
            $('#nextoffer').attr('disabled', true);
            $('#buynow').attr('disabled', true);
        });

        @if($fakebids->count() == 1)
            $("#nextoffer").click(function(){
                setTimeout(function () {
                    $("#nextofferform").submit();
                }, 2000);
                // $("#nextofferform").delay(8000).submit();
            });
        @elseif($fakebids->count() == 2)
            $("#nextoffer").click(function(){
                setTimeout(function () {
                    $("#nextofferform").submit();
                }, 4000);
                // $("#nextofferform").delay(8000).submit();
            });
        @elseif($fakebids->count() == 3)
            $("#nextoffer").click(function(){
                setTimeout(function () {
                    $("#nextofferform").submit();
                }, 6000);
                // $("#nextofferform").delay(8000).submit();
            });
        @endif
    });
</script>
    
@endsection