@extends('layouts.app2')
@section('title', __('Booking: ') . $auction->auction_id)
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<br>

<div class="container">
    {{-- @section('best_bid')
    {{ $bestbid = $bids->where('auction_id', $auction->id)->min('bid') }}
    {{ $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid') }}
    @endsection --}}
    @section('best_bid')
    {{ $bestbid = $bids->where('auction_id', $auction->id)->min('bid') }}
    {{ $mybid2 = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->first() }}
    {{ $options = __('Example') . ': ' . __('If you select') . ' ' . '<b>' . '$5' . '</b>' . ' ' . __('and ') . '<b>' . __('Best bid') . ' = $' . $bestbid . '.00'.'</b>' . ', ' . __('your bid will be') . ' ' . '<b>' . '$' . ($bestbid - 5) . '.00' .'</b>' }}
    {{ $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid') }}
    {{ $starting_bid = $auction->starting_bid }}
    {{ $max = $starting_bid - 1 }}
    {{ $min = ($bestbid * 80)/100 }}

    @if ($bids->where('auction_id', $auction->id)->count() > 0)
        {{ $max = $starting_bid - 1 }}
        {{ $min = ($bestbid * 80)/100 }}
    @else
        {{ $max = $starting_bid - 1 }}
        {{ $min = ($starting_bid * 80)/100 }}
    @endif
@endsection

<div class="row">
    <div class="col-md-12 text-right">
        <span class="text-primary" id="p1">{{url('booking/confirmation/'.$auction->key)}}</span>
        <button class="btn btn-primary btn-sm" onclick="copyToClipboard('#p1')">{{__('Copy URL')}}</button>
        |
        @if ($auction->checked_by)
            <span><i class="fa fa-check text-success" aria-hidden="true"></i> {{__('Checked by')}}: <strong>{{$auction->checkedBy->name}}</strong></span>
        @else
            {!! Form::open([
                'method' => 'PATCH',
                'url' => ['manageauctions/checked', $auction->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button(__('Check Auction'), array(
                        'type' => 'submit',
                        'class' => 'btn btn-success btn-sm',
                        'title' => 'Check Auction'
                )) !!}
            {!! Form::close() !!}
        @endif
    </div>
</div>
<hr>

{{-- <h3>{{__('Booking details')}}</h3> --}}

@if ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == 1)
    @include('manage.auctions.categories.airport_to_location')

{{-- Airport to Location --}}
@elseif ($auction->fromcity->is_airport == 1 && $auction->tocity->is_airport == NULL)
    @include('manage.auctions.categories.airport_to_location')

{{-- Location to Location --}}
@elseif ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == NULL)
    @include('manage.auctions.categories.airport_to_location')

{{-- Location to Airport --}}
@elseif ($auction->fromcity->is_airport == NULL && $auction->tocity->is_airport == 1)
    @include('manage.auctions.categories.airport_to_location')
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @section('starting_bid')
                    {{ $five = $auction->order_total * 0.05 }}
                    {{ $ten = $auction->order_total * 0.1 }}
                    {{ $fifteen = $auction->order_total * 0.15 }}
                @endsection

                @if($auction->discount)
                    <h5>{{__('Discount appied')}}: {{$auction->country->currency_symbol . number_format($auction->discount, 2, '.', ',') }} </h5>
                @else
                    @if (session()->has('coupon_error'))
                        <div class="spacer"></div>
                        <div class="alert alert-warning">
                            {{ session()->get('coupon_error') }}
                        </div>
                    @endif
                    <h5>{{__('Apply discount')}} </h5>
                    <div class="d-flex flex-row bd-highlight mb-3">
                        <div class="pl-0 pr-2 py-2 bd-highlight">
                            {!! Form::open(['method' => 'PATCH', 'url' => ['coupons/coupon', $auction->id]]) !!}
                            {{-- {!! Form::open(['method' => 'POST', 'url' => ['coupons/coupon']]) !!} --}}
                                {{-- hidden fields --}}
                                {{ Form::hidden('auction_id', $auction->id) }}
                                {{ Form::hidden('discount', $five) }}
                
                                {!! Form::button($auction->country->currency_symbol . number_format($five, 2, '.', ',') . ' (5%)', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-light font-weight-bolder',
                                        'title' => '5%'
                                )) !!}
                                
                            {!! Form::close() !!}
                        </div>
                        <div class="p-2 bd-highlight">
                            {!! Form::open(['method' => 'PATCH', 'url' => ['coupons/coupon', $auction->id]]) !!}
                                {{-- hidden fields --}}
                                {{ Form::hidden('auction_id', $auction->id) }}
                                {{ Form::hidden('discount', $ten) }}
                
                                {!! Form::button($auction->country->currency_symbol . number_format($ten, 2, '.', ',') . ' (10%)', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-light font-weight-bolder',
                                        'title' => '10%'
                                )) !!}
                                
                            {!! Form::close() !!}
                        </div>
                        <div class="p-2 bd-highlight">
                            {!! Form::open(['method' => 'PATCH', 'url' => ['coupons/coupon', $auction->id]]) !!}
                                {{-- hidden fields --}}
                                {{ Form::hidden('auction_id', $auction->id) }}
                                {{ Form::hidden('discount', $fifteen) }}
                
                                {!! Form::button($auction->country->currency_symbol . number_format($fifteen, 2, '.', ',') . ' (15%)', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-light font-weight-bolder',
                                        'title' => '10%'
                                )) !!}
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h4>{{__('Bids')}} <small>({{ $auction->bids->count() }})</small></h4>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th >{{ __('Supplier') }}</th>
                                <th >{{ __('Email') }}</th>
                                <th >{{ __('Phone') }}</th>
                                <th>{{ __('Bid')}}</th>
                                <th>{{ __('Bidded at')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
            
                            @foreach ($bids as $key => $bid)
                            {{-- @if () --}}
                            <tr class="">
                                <td>{{ $bid->user->name }}</td>
                                <td>{{ $bid->user->email }}</td>
                                <td>{{ $bid->user->phone }}</td>
                                <td><strong>{{$auction->country->currency_symbol}}{{ number_format($bid->bid, 2, '.', ',') }}</strong></td>
                                <td>{{ $bid->updated_at->diffForHumans() }}</td>
            
                                <td>
                                    @if($bid->won == 1)
                                        <span class="badge badge-success">{{__('Accepted')}} </span>
                                    @endif

                                    @if ($auction->status == "Open")
                                        {!! Form::open([
                                            'method' => 'PATCH',
                                            'url' => ['booking/accept-bid', $bid->id],
                                            'style' => 'display:inline',
                                            'class' => 'accept'
                                            // 'onsubmit' => 'return ConfirmDelete()'
                                        ]) !!}
                                            {{ Form::hidden('auction_id', $auction->id) }}
                                            {{ Form::hidden('discount', $fifteen) }}

                                            <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="{{ __('Do you want to accept this bid?') }}" data-placement="right"><i class="fa fa-check" aria-hidden="true" ></i></button>
                                        {!! Form::close() !!}
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection

@section('scripts')
    <script>
        function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("url");
    
        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
    
        /* Copy the text inside the text field */
        document.execCommand("copy");
    
        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
    }
    </script>

    <script>
        function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        }
    </script>
@endsection
