{{-- desktop version --}}
<div class="d-none d-sm-block">
    <a href="{{ route('suppliers.index') }}" class="btn {{ request()->is('suppliers/index') ? 'btn-primary' : 'btn-secondary' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions')}}">{{ __('All auctions') }}</a>
    <a href="{{ route('suppliers.open') }}" class="btn {{ request()->is('suppliers/open') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all open auctions')}}">{{ __('Open') }}</a>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('suppliers.mybids') }}" class="btn {{ request()->is('suppliers/mybids') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions in which you made a bid')}}">{{ __('My bids') }}</a>
        {{-- <a href="{{ route('suppliers.privatewinning') }}" class="btn {{ request()->is('suppliers/winning') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See the auctions where you made bids and are winning')}}">{{ __('Winning') }}</a> --}}
        {{-- <a href="{{ route('suppliers.privatelosing') }}" class="btn {{ request()->is('suppliers/losing') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See the auctions where you made bids and are losing')}}">{{ __('Losing') }}</a> --}}
        <a href="{{ route('suppliers.won') }}" class="btn {{ request()->is('suppliers/won') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions in which you made a bid')}}">{{ __('Won') }}</a>
        <a href="{{ route('suppliers.lost') }}" class="btn {{ request()->is('suppliers/lost') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions in which you made a bid')}}">{{ __('Lost') }}</a>
    </div>
    {{-- <a href="{{ route('auctions.privateaccepted') }}" class="btn {{ request()->is('auctions/privatetransfers/accepted') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See the auctions I have won')}}">{{ __('Accepted') }}</a> --}}
</div>

{{-- mobile version --}}
<div class="d-block d-sm-none">
    <a href="{{ route('suppliers.index') }}" class="btn btn-sm {{ request()->is('suppliers/index') ? 'btn-primary' : 'btn-secondary' }}">{{ __('All') }}</a>
    <a href="{{ route('suppliers.open') }}" class="btn btn-sm {{ request()->is('suppliers/open') ? 'btn-primary' : 'btn-light' }}">{{ __('Open') }}</a>
    <hr>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('suppliers.mybids') }}" class="btn btn-sm {{ request()->is('suppliers/mybids') ? 'btn-primary' : 'btn-light' }}">{{ __('My bids') }}</a>
        {{-- <a href="{{ route('suppliers.privatewinning') }}" class="btn btn-sm {{ request()->is('suppliers/winning') ? 'btn-primary' : 'btn-light' }}">{{ __('Winning') }}</a> --}}
        {{-- <a href="{{ route('suppliers.privatelosing') }}" class="btn btn-sm {{ request()->is('suppliers/losing') ? 'btn-primary' : 'btn-light' }}" >{{ __('Losing') }}</a> --}}
        <a href="{{ route('suppliers.won') }}" class="btn btn-sm {{ request()->is('suppliers/won') ? 'btn-primary' : 'btn-light' }}">{{ __('Won') }}</a>
        <a href="{{ route('suppliers.lost') }}" class="btn btn-sm {{ request()->is('suppliers/lost') ? 'btn-primary' : 'btn-light' }}">{{ __('Lost') }}</a>
    </div>
</div>
