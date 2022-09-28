{{-- desktop version --}}
<div class="d-none d-sm-block">
    <a href="{{ route('auctions.privatetransfers') }}" class="btn {{ request()->is('auctions/privatetransfers/index') ? 'btn-primary' : 'btn-secondary' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions')}}">{{ __('All auctions') }}</a>
    <a href="{{ route('auctions.privateopen') }}" class="btn {{ request()->is('auctions/privatetransfers/open') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all open auctions')}}">{{ __('Open') }}</a>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('auctions.privatebidbyme') }}" class="btn {{ request()->is('auctions/privatetransfers/bidbyme') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions in which you made a bid')}}">{{ __('My bids') }}</a>
        <a href="{{ route('auctions.privatewinning') }}" class="btn {{ request()->is('auctions/privatetransfers/winning') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See the auctions where you made bids and are winning')}}">{{ __('Winning') }}</a>
        <a href="{{ route('auctions.privatelosing') }}" class="btn {{ request()->is('auctions/privatetransfers/losing') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See the auctions where you made bids and are losing')}}">{{ __('Losing') }}</a>
        <a href="{{ route('auctions.privatewon') }}" class="btn {{ request()->is('auctions/privatetransfers/won') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions in which you made a bid')}}">{{ __('Won') }}</a>
        <a href="{{ route('auctions.privatelost') }}" class="btn {{ request()->is('auctions/privatetransfers/lost') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See all auctions in which you made a bid')}}">{{ __('Lost') }}</a>
    </div>
    {{-- <a href="{{ route('auctions.privateaccepted') }}" class="btn {{ request()->is('auctions/privatetransfers/accepted') ? 'btn-primary' : 'btn-light' }}" data-toggle="tooltip" data-placement="right" title="{{ __('See the auctions I have won')}}">{{ __('Accepted') }}</a> --}}
</div>

{{-- mobile version --}}
<div class="d-block d-sm-none">
    <a href="{{ route('auctions.privatetransfers') }}" class="btn btn-sm {{ request()->is('auctions/privatetransfers/index') ? 'btn-primary' : 'btn-secondary' }}">{{ __('All') }}</a>
    <a href="{{ route('auctions.privateopen') }}" class="btn btn-sm {{ request()->is('auctions/privatetransfers/open') ? 'btn-primary' : 'btn-light' }}">{{ __('Open') }}</a>
    <hr>

    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('auctions.privatebidbyme') }}" class="btn btn-sm {{ request()->is('auctions/privatetransfers/bidbyme') ? 'btn-primary' : 'btn-light' }}">{{ __('My bids') }}</a>
        <a href="{{ route('auctions.privatewinning') }}" class="btn btn-sm {{ request()->is('auctions/privatetransfers/winning') ? 'btn-primary' : 'btn-light' }}">{{ __('Winning') }}</a>
        <a href="{{ route('auctions.privatelosing') }}" class="btn btn-sm {{ request()->is('auctions/privatetransfers/losing') ? 'btn-primary' : 'btn-light' }}" >{{ __('Losing') }}</a>
        <a href="{{ route('auctions.privatewon') }}" class="btn btn-sm {{ request()->is('auctions/privatetransfers/won') ? 'btn-primary' : 'btn-light' }}">{{ __('Won') }}</a>
        <a href="{{ route('auctions.privatelost') }}" class="btn btn-sm {{ request()->is('auctions/privatetransfers/lost') ? 'btn-primary' : 'btn-light' }}">{{ __('Lost') }}</a>
    </div>
</div>
