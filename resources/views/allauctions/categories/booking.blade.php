<p>
    <span class=""># {{ $item->service_number }}</span> |
    @if ($item->category->code == 'private')
        <span class="mr-2"><strong>{{ date('l j, F Y', strtotime($item->date)) }}, {{ date('g:i A', strtotime($item->time)) }}</strong></span>
        |
    @elseif ($item->category->code == 'shared')
        <span class="mr-2"><strong>{{ date('F j, Y', strtotime($item->date)) }}</strong>, {{__('Boarding time')}}: <strong>{{ date('g:i a', strtotime($item->from_time)) }}</strong> - {{__('Departure time')}}: <strong>{{ date('g:i a', strtotime($item->to_time)) }}</strong></span>
    @elseif ($item->category->code == 'contract')
        <span class="mr-2">{{__('Start date')}}: <strong>{{ date('l j, F Y', strtotime($item->start_date)) }}</strong> - {{__('End date')}}: <strong>{{ date('l j, F Y', strtotime($item->end_date)) }}</strong></span>
        |
    @endif

    {{-- <strong>{{ __('Bid')}}s</strong>: <span class="text-primary">{{ $bids->where('auction_id', $item->id)->count() }}</span> | --}}
    {{-- <strong>{{ __('Details') }}:</strong> --}}
    @if ($item->category->code == 'private')
        <span class="text-danger"><strong>{{ $item->vehicle->name }}</strong></span>
        |
    @endif

    @if ($item->category->code == 'private' and $item->category->code == 'contract')
        @if ($item->passengers)
            {{ __('People') }}: <span class="text-danger"><strong>{{ $item->passengers }}</strong></span> |
        @endif
    @endif

    {{-- Current bid --}}
    @if ($item->category->code == 'private')
        @if ($bids->where('auction_id', $item->id)->count() > 0)
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
        @else
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
        @endif
    @endif

    @if ($item->category->code == 'shared')
    <p>
        <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the starting bid per seat') }}">{{ __('Starting bid per seat') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
        |
        <span data-toggle="tooltip" data-placement="top" title="{{ __('Available seats') }}">{{ __('Availabe seats') }}: <span class=""><strong>{{$item->passengers}}/{{$item->shared_seats}} </strong></span></span>
        @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count())
            |
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is your bid that you have made in this auction') }}">{{ __('My bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($mybid, 2, '.', ',') }}</strong> {{__('per')}} <strong>{{ $mybid2['seats']}}</strong> {{__('seats')}} </span> </span>
        @endif
    </p>
    @endif

    @if ($item->category->code == 'contract' and $item->bids->count() > 0)
        <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->bids->min('bid'), 2, '.', ',') }}</strong></span></span>
    @endif

    @if ($item->category->code == 'private' and $item->category->code == 'contract')
        @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count())
        |
            <span data-toggle="tooltip" data-placement="top" title="{{ __('This is your bid that you have made in this auction') }}">{{ __('My bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($mybid, 2, '.', ',') }}</strong></span> </span>{{-- <i class="fa fa-circle {{ $mybid == $bestbid ? 'text-success' : 'text-danger'}} " aria-hidden="true"></i> --}}
        @endif
    @endif
</p>