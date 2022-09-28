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

<br>
<div class="container mb-5">
    {{-- <div class="col-md-12 text-center">
        <div class="card">
            <div class="card-body">
                <h4>{{$auction->full_name}}</h4>
                <p class="text-muted">{{__('Email')}}: <span class="text-primary">{{$auction->email}}</span> | {{__('Phone')}}: <span class="text-primary">{{$auction->phone}}</span></p>
                <p class="text-muted">
                    
                    <span class="text-primary">{{url('booking/mybooking/'.$auction->auction_id)}}</span> <br>
                    <small class="text-muted">{{__('This is your Booking Url, please copy and save this url.')}} </small>
                </p>
            </div>
        </div>
    </div>
    <p></p> --}}
    @if ($request->auction_id)
    {{-- PC Version --}}
    {{-- <hr> --}}
    <div class="row ">
        @include('bookings.left_column.left_column')

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

                <div class="box box-solid box-warning">
                    <div class="box-header with-border">
                        <h4 class="box-title">{{ __('Buy Now or see Supplier Offers')}} </h4>
                    </div>
                    <div class="box-body">
                        
                        {{-- <span class="text-muted">{{__('Bids drop nearer the auction close date because drivers want to fill empty legs and idle time. You receive an email with each lower bid.')}}</span> --}}
                        @for($i=0; $i < 1; $i++)
                        @endfor
                        @foreach ($bids as $bid)
                        @section('bid')
                            {{ $bid_per = $bid->bid * 0.1 }}
                            {{ $bid_total = $bid->bid + $bid_per }}
                        @endsection

                        {{-- <h4>{{$bid->user->name}}</h4> --}}
                        <div class="row border-top py-2 mt-2">
                            <div class="col-md-3">
                                {{-- <span class="text-muted">{{__('Name')}}</span><br>
                                <span>{{$bid->user->name}}</span> --}}
                                
                                <span class="text-muted">{{__('Bid')}}</span><br>
                                <span>{{__('Bid')}} {{ $i++ }}</span>
                            </div>

                            {{-- <div class="col-md-3">
                                <span class="text-muted">{{__('Bid')}}</span><br>
                                <span>{{$bid->created_at->diffForHumans()}}</span>
                            </div> --}}

                            <div class="col-md-3">
                                <span class="text-muted">{{__('Amount')}}</span><br>
                                <h5>{{$auction->country->currency_symbol}}{{ number_format($bid_total , 2, '.', ',') }}</h5>
                            </div>

                            <div class="col-md-3 pt-3">
                                {!! Form::open(['method' => 'PATCH', 'url' => ['booking/accept-bid', $bid->id], 'style' => 'display:inline']) !!}
                                    {{-- hidden fields --}}
                                    {{ Form::hidden('auctionid', $auction->id) }}

                                    {{-- Button --}}
                                    {!! Form::button(__('Accept offer'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-block font-weight-bolder',
                                            'title' => __('Accept Bid'),
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => __('Accept offer or wait for better bid')
                                    )) !!}
                                    
                                {!! Form::close() !!}
                            </div>
                        </div>

                       
                        {{-- <div class="d-flex flex-row">
                            <div class="flex-fill pr-4">
                                <small class="text-muted">{{__('Name')}}</small><br>
                                <span>{{$bid->user->name}}</span>
                            </div>
                            
                            <div class="flex-fill px-4">
                                <small class="text-muted">{{__('Bid')}}</small><br>
                                <span>{{$bid->created_at->diffForHumans()}}</span>
                            </div>
                            <div class=" flex-fillpx-4">
                                <small class="text-muted">{{__('Amount')}}</small><br>
                                <h5>${{ number_format($bid_total , 2, '.', ',') }}</h5>
                            </div>
                            <div class="flex-fill pt-3">
                                {!! Form::open(['method' => 'PATCH', 'url' => ['booking/accept-bid', $bid->id], 'style' => 'display:inline']) !!}
                                    
                                    {{ Form::hidden('auctionid', $auction->id) }}

                                    
                                    {!! Form::button(__('Accept offer'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-block btn-sm',
                                            'title' => __('Accept Bid'),
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => __('Accept offer or wait for better bid')
                                    )) !!}
                                    
                                {!! Form::close() !!}
                            </div>
                        </div> --}}
                        
                        @endforeach

                        
                    </div>
                    <div class="card-footer">
                        {{-- Starting bid --}}
                        @section('starting_bid2')
                            {{ $rt_percentage = $auction->starting_bid * 0.10 }}
                            {{ $starting_bid2 = $auction->servicePrice->oneway_price + $rt_percentage }}
                            {{ $rt_starting_bid = $auction->starting_bid + $rt_percentage }}
                        @endsection

                        <div class="row">
                            <div class="col-md-3">
                                <span class="text-muted">{{__('Name')}}</span><br>
                                <span>{{__('Pre-Auction Price')}}</span>
                            </div>

                            {{-- <div class="col-md-3">
                                <span class="text-muted">{{__('Bid')}}</span><br>
                                <span>{{$auction->created_at->diffForHumans()}}</span>
                            </div> --}}

                            <div class="col-md-3">
                                <span class="text-muted">{{__('Amount')}}</span><br>
                                <h5>{{$auction->country->currency_symbol}}{{ number_format($rt_starting_bid, 2, '.', ',') }}</h5>
                            </div>

                            <div class="col-md-3 pt-3">
                                {!! Form::open(['method' => 'PATCH', 'url' => ['booking/acceptsb', $auction->id], 'style' => 'display:inline']) !!}
                                    {{-- hidden fields --}}
                                    {{-- {{ Form::hidden('auction_id', $auction->id) }} --}}
    
                                    {{-- Button --}}
                                    {!! Form::button(__('Buy Now'), array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-block font-weight-bolder',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top'
                                    )) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>{{-- /card-footer --}}
                    

                    </div>
                </div>

            </div>{{-- /col --}}



    </div>{{-- /row --}}
    @endif
    {{-- End PC version --}}

    
   
@endsection
