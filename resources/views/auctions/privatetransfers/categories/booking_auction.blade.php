<p class="lead">{{__('Category')}}: <strong class="text-primary">{{__('Private')}} </strong> </p>
<p>
    <span class=""># {{ $item->auction_id }}</span> |
    <span class="mr-2">{{__('Date')}}: <strong>{{ date('l j, F Y', strtotime($item->date)) }}</strong>, {{__('Arrival time')}}: <strong>{{ date('g:i A', strtotime($item->arrival_time)) }}</strong></span> |
    
    <span class="">{{ __('Starting bid') }}: <strong>$ {{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span> 


    {{-- Current bid --}}
    @if ($item->category->code == 'private')
        @if ($bids->where('auction_id', $item->id)->count() > 0)
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>$ {{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
        @else
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>$ {{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
        @endif
    @endif

    @if ($item->bids->count() > 0)
    |
        <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>$ {{ number_format($item->bids->min('bid'), 2, '.', ',') }}</strong></span></span>
    @endif
</p>