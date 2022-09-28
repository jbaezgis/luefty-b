{{-- <p class="lead">{{__('Category')}}: <strong class="text-primary">{{__($item->category->name)}} </strong> </p> --}}
{{-- <p class="lead">{{__('Category')}}: <strong class="text-primary">{{__('Private')}} </strong> </p> --}}
<p>
    <span class=""># {{ $item->service_number }}</span> |
        <span class="mr-2"><strong>{{ date('l j, F Y', strtotime($item->date)) }}, {{ date('g:i A', strtotime($item->time)) }}</strong></span>
        {{-- <span class="text-danger"><strong>{{ $item->vehicle->name }}</strong></span> --}}

        @if ($item->passengers)
            {{ __('People') }}: <span class="text-danger"><strong>{{ $item->passengers }}</strong></span> |
        @endif


    {{-- Current bid --}}
        @if ($bids->where('auction_id', $item->id)->count() > 0)
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
        @else
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
        @endif
</p>