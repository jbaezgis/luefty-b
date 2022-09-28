@section('page')
    {{$lang = Config::get('app.locale')}}
    {{$rules = App\Page::where('code', 'privatetransfers_rules')->where('lang', $lang)->first()}}
@endsection

<div class="row">
    <div class="col-md-12 d-none d-lg-block d-xl-block">
        <a href="{{ route('privatetransfers.index') }}" class="btn {{ request()->is('myauctions/privatetransfers/index') ? 'btn-secondary' : 'btn-light' }} mr-1" data-toggle="tooltip" data-placement="right" title="{{ __('List of all auctions you have created')}}">
            {{ __('All') }}
            <span class="badge badge-light border">{{ $auctions_all }}</span>
        </a>
        <a href="{{ route('privatetransfers.nobidyet') }}" class="btn {{ request()->is('myauctions/privatetransfers/nobidyet') ? 'btn-secondary' : 'btn-light' }} mr-1" data-toggle="tooltip" data-placement="right" title="{{ __('List of all auctions that you have created but do not yet have bids')}}">
            {{ __('No bid yet') }}
            <span class="badge badge-light border">{{ $auctions_nobidyet }}</span>
        </a>
        <a href="{{ route('privatetransfers.openbid') }}" class="btn {{ request()->is('myauctions/privatetransfers/openbid') ? 'btn-secondary' : 'btn-light' }} mr-1 " data-toggle="tooltip" data-placement="right" title="{{ __('List of all auctions that you have created that have bids')}}">
            {{ __('Open')}}
            <span class="badge badge-light border">{{ $auctions_openbid }}</span>
        </a>
        <a href="{{ route('privatetransfers.accepted') }}" class="btn {{ request()->is('myauctions/privatetransfers/accepted') ? 'btn-secondary' : 'btn-light' }} mr-1 " data-toggle="tooltip" data-placement="right" title="{{ __('List of all auctions that you have created that are already closed because you accepted a bid')}}">
            {{ __('Accepted')}}
            <span class="badge badge-light border">{{ $auctions_accepted }}</span>
        </a>
        <a href="{{ route('privatetransfers.archived') }}" class="btn {{ request()->is('myauctions/privatetransfers/archived') ? 'btn-secondary' : 'btn-light' }} mr-1 " data-toggle="tooltip" data-placement="right" title="{{ __('List of all past auctions')}}">
            {{ __('Archived')}}
            <span class="badge badge-light border">{{ $auctions_inactive }}</span>
        </a>
        <a href="{{ route('myauctions.trash') }}" class="btn {{ request()->is('myauctions/trash/index') ? 'btn-danger' : 'btn-secondary' }} pull-right">
            <i class="fa fa-trash" aria-hidden="true"></i>  {{ __('Trash')}}
            <span class="badge badge-light border">{{ $trashcount }}</span>
        </a>

    </div>
    <div class="col-md-12 d-none d-block d-sm-block d-md-none">
        <a href="{{ route('privatetransfers.index') }}" class="btn {{ request()->is('myauctions/privatetransfers/index') ? 'btn-secondary' : 'btn-light' }} btn-sm">
            {{ __('All') }}
            <span class="badge badge-light border">{{ $auctions_all }}</span>
        </a>
        <a href="{{ route('privatetransfers.nobidyet') }}" class="btn {{ request()->is('myauctions/privatetransfers/nobidyet') ? 'btn-secondary' : 'btn-light' }} btn-sm">
            {{ __('No bid yet') }}
            <span class="badge badge-light border">{{ $auctions_nobidyet }}</span>
        </a>
        <a href="{{ route('privatetransfers.openbid') }}" class="btn {{ request()->is('myauctions/privatetransfers/openbid') ? 'btn-secondary' : 'btn-light' }} btn-sm ">
            {{ __('Open')}}
            <span class="badge badge-light border">{{ $auctions_openbid }}</span>
        </a>
        <a href="{{ route('privatetransfers.accepted') }}" class="btn {{ request()->is('myauctions/privatetransfers/accepted') ? 'btn-secondary' : 'btn-light' }} btn-sm ">
            {{ __('Accepted')}}
            <span class="badge badge-light border">{{ $auctions_accepted }}</span>
        </a>
        <a href="{{ route('privatetransfers.archived') }}" class="btn {{ request()->is('myauctions/privatetransfers/archived') ? 'btn-secondary' : 'btn-light' }} btn-sm">
            {{ __('Archived')}}
            <span class="badge badge-light border">{{ $auctions_inactive }}</span>
        </a>
        <a href="{{ route('myauctions.trash') }}" class="btn {{ request()->is('myauctions/trash/index') ? 'btn-secondary' : 'btn-light' }} btn-sm">
            <i class="fa fa-trash text-danger" aria-hidden="true"></i> {{ __('Trash')}}
            <span class="badge badge-light border">{{ $trashcount }}</span>
        </a>
    </div>
</div>


 {{-- Rules Modal --}}
  <!-- Modal -->
  <div class="modal fade" id="rules" tabindex="-1" role="dialog" aria-labelledby="rulesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rulesLabel">{{ __('Auction Rules') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>
                <h5 class=""><span class="badge badge-light">{{__('No bid yet')}}</span> <small class="text-muted">({{ __('This Auction does not have bids.') }})</small></h5>
                &emsp; - {{__('You can edit.')}} <br>
                &emsp; - {{__('You can delete.')}}
            </p>
            <p>
                <h5 class=""><span class="badge badge-warning">{{__('Open')}}</span> <small class="text-muted">({{ __('This Auction has one bid or more.') }})</small></h5>
                &emsp; - {{__('You can edit.')}} <br>
                &emsp; - {{__('You can delete.')}} <br>
                &emsp; - {{__('If you make changes all bids will be deleted.')}}
            </p>
            <p>
                <h5 class=""><span class="badge badge-secondary">{{__('Changed')}}</span> <small class="text-muted">({{ __('When an auction is changed all previous bids are deleted.') }})</small></h5>
                &emsp; - {{__('You can edit.')}} <br>
                &emsp; - {{__('You can delete.')}} <br>
                &emsp; - {{__('If you make changes all bids will be deleted.')}}
            </p>
            <p>
                <h5 class=""><span class="badge badge-success">{{__('Accepted')}}</span> <small class="text-muted">({{ __('You accepted a bid.') }})</small></h5>
                &emsp; - {{__('You cannot make changes.')}} <br>
                &emsp; - {{__('You cannot delete.')}}
            </p>
        </div>
      </div>
    </div>
  </div>
