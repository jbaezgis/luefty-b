@extends('layouts.app2')
@section('title', __('My Auctions'))

@section('content')
<div class="container-title">
    <h1 class="page-title bg-primary">{{ __('My Auctions') }} - {{__('Open')}} (<small>{{ __('List of all auctions that you have created that have bids')}}</small>)</h1>
</div>
<div class="container-fluid">
<br>
@if (App\Module::where('name', 'Shared Shuttles')->active()->first())
<div class="row">
        <div class="col-md-12 text-center">
            <h4>{{ __('Select Category') }} </h4>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('privatetransfers.index') }}" class="btn {{ request()->is('myauctions/privatetransfers*') ? 'btn-primary' : 'btn-light' }}">{{ __('Private Transfers') }}</a>
                <a href="{{ route('sharedshuttles.index') }}" class="btn {{ request()->is('myauctions/sharedshuttles/index') ? 'btn-primary' : 'btn-light' }}">{{ __('Shared Shuttles') }}</a>
            </div>
        </div>
</div>
@endif
<p></p>
    {{-- <h1>{{ __('Private Transfers') }}
    </h1> --}}

        <!-- Modal -->
	  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ __('Status')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    @include('myauctions.help_content')
                </div>
              </div>
            </div>
          </div>

</div>

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        @if( session()->has('info') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! session('info') !!}
              <button type="button" class="btn btn-light btn-sm" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">{{__('Confirm')}}</span>
              </button>
            </div>
        @endif
        @if( session()->has('deleted') )
        <script>
                swal({!! session('deleted') !!});
            </script>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {!! session('deleted') !!} |
              {!! Form::open([
                    'method' => 'PATCH',
                    'url' => ['myauctions/recover', session('auction_id')],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-repeat" aria-hidden="true"></i> Recuperar', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Recuperar',
                            // 'onclick'=>'return confirm("Seguro que desea eliminar?")'
                    )) !!}
                {!! Form::close() !!}
              <button type="button" class="btn btn-light btn-sm" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">{{__('Close')}}</span>
              </button>
            </div>
        @endif
        @if( session()->has('recover') )
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              {!! session('recover') !!}

              <button type="button" class="btn btn-light btn-sm" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">{{__('Close')}}</span>
              </button>
            </div>
        @endif
    </div>
</div>

{{-- Search box --}}
{{-- @if ($auctions->count() > 10) --}}
            @include('myauctions.privatetransfers.menu')
                    <p></p>
            {!! Form::open(['method' => 'GET', 'url' => '/myauctions/privatetransfers/openbid', 'class' => ' my-2 my-lg-0', 'role' => 'search'])  !!}
            <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">

                            {!! Form::text('service_number', null, ['class' => 'form-control', 'placeholder'=> __('Service number')]) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['placeholder'=> __('From location'), 'id'=>'from', 'class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['placeholder'=> __('To location'), 'id'=>'to', 'class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="col-md-3 d-none d-lg-block d-xl-block" >
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> {{ __('Search') }} </button>
                        <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="{{ __('Clear fields and show all auctions.') }}">{{ __('Clear filters')}} </a>
                    </div>

                    <div class="col-md-3 d-none d-block d-sm-block d-md-none" >
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> {{ __('Search') }} </button>
                        <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-warning btn-sm" data-toggle="tooltip">{{ __('Clear filters')}} </a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- <label for="to">Hasta</label> --}}
                            {!! Form::select('asc_desc', array('ASC' => __('Date: Ascendant'), 'DESC' => __('Date: Descendant')),null, ['class' => 'form-control', 'placeholder'=>__('Sort by:'), 'onchange'=>'this.form.submit()']) !!}
                        </div>
                    </div>
                </div>

            {!! Form::close() !!}

{{-- @endif --}}

{{-- Main Table --}}
<div class="row">
<div class="col-md-12 d-none d-lg-block d-xl-block">
        <div class="box box-solid">
            <div class="box-header with-border">
            <a href="{{ route('myauctions.createprivate') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ __('Click to enter transfer data that you want to post as an Auction.') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Create new auction') }}</a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="auctions" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th> <span data-toggle="tooltip" data-placement="top" title="{{ __('From location') }}">{{ __('From') }}</span></th>
                                <th><span data-toggle="tooltip" data-placement="top" title="{{ __('To location') }}">{{ __('To') }}</span></th>
                                <th><span data-toggle="tooltip" data-placement="top" title="{{ __('Your service number') }}">{{ __('Number') }}</span></th>
                                <th><span data-toggle="tooltip" data-placement="top" title="{{ __('Date of service') }}">{{ __('Date') }}</span></th>
                                {{-- <th>{{ __('Starting bid') }}</th> --}}
                                <th><span data-toggle="tooltip" data-placement="top" title="{{ __('This is how many bids each auction has.') }}">{{ __('Bidders') }}</span></th>
                                <th><span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best bid for each auction. If there is a Heart next to the offer then the Offer is from one of your Favortie Suppliers.') }}">{{ __('Best bid') }}</span></th>
                                <th><span><a class="text-dark" href="#" data-toggle="modal" data-target="#exampleModal" title="{{ __('Status') }}">{{ __('Status') }} <span class="text-primary"><i class="fa fa-question-circle" aria-hidden="true"></i></span></a></span></th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auctions as $item)
                            {{-- @if ($item->from_location) --}}
                            @section('best_bid')
                                {{ $bestbid = $bids->where('auction_id', $item->id)->min('bid') }}
                                {{-- {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }} --}}
                                {{-- {{ $favoritebid = $bids->where('auction_id', $item->id)->where('bid', $bestbid)->last() }} --}}
                                {{ $favoritebid = $bids->where('bid', $bestbid)->first() }}
                                @if ($bids->where('auction_id', $item->id)->count())
                                    {{ $profile = App\Profile::where('user_id', $favoritebid->user_id)->first() }}
                                @endif
                            @endsection
                            <tr data-toggle="collapse" data-target="#auction{{$item->id}}" class="clickable">
                                <td scope="row">{{ $item->fromcity->name }}</td>
                                <td>{{ $item->tocity->name }}</td>
                                <td>{{ $item->service_number }} </td>
                                <td>{{ date('F j, Y', strtotime($item->date)) }}, {{ date('g:i a', strtotime($item->time)) }} </td>
                                {{-- <td>${{ number_format($item->starting_bid, 2, '.', ',') }}</td> --}}

                                <td class="text-center">{{ $bids->where('auction_id', $item->id)->count() }}</td>
                                <td>
                                    @if ($bids->where('auction_id', $item->id)->count())

                                    <span><a href="#" data-toggle="tooltip" title="{{ __('The best bid') }}" data-placement="top">{{auth()->user()->country->currency_symbol}}{{ number_format($bestbid, 2, '.', ',') }}</a></span>

                                    {{-- {{ $profile }} --}}
                                        {{-- @if (auth()->user()->following->contains($profile->id))
                                            <span><a href="#" data-toggle="tooltip" title="{{ __('This user is in your favorites') }}" data-placement="top"><i class="fa fa-heart text-danger" aria-hidden="true"></i></a></span>
                                        @endif --}}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->changed === 1 & $item->status === 'Closed')
                                        <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                    @elseif ($item->changed === 1)
                                        <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is Changed because you updated its info') }}" data-placement="top">{{ __('Changed')}} </span>
                                    @else
                                        @if ($item->status == 'Closed')
                                            <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                        @else
                                            @if ($bids->where('auction_id', $item->id)->count() > 0)
                                                <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ __('This Auction is Open because has one bid or more.') }}" data-placement="top">{{ __('Open') }}</span>
                                            @else
                                                <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is do not have bids.') }}" data-placement="top">{{ __('No bid yet') }}</span>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                <td>

                                        {{-- <a class="btn btn-secondary btn-sm"
                                                href="{{ url('/myauctions/' . $item->id) }}"
                                                title="{{ __('View') }}"
                                                data-toggle="tooltip"
                                                data-placement="top"><i class="fa fa-eye" aria-hidden="true"></i>
                                            </a> --}}

                                        @if ($item->changed === 0 & $item->bids->count() > 0 & $item->status === 'Open')
                                            <a class="btn btn-secondary btn-sm"
                                                href="{{ url('/myauctions/change/' . $item->id) }}"
                                                title="{{ __('Edit – If you make changes all bids will be lost.') }}"
                                                data-toggle="tooltip"
                                                data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        @if ($item->changed === 1 & $item->bids->count() > 0)
                                        <a class="btn btn-secondary btn-sm"
                                                href="{{ url('/myauctions/change/' . $item->id) }}"
                                                title="{{ __('Edit – If you make changes all bids will be lost.') }}"
                                                data-toggle="tooltip"
                                                data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        {{-- <div class="badge badge-danger">{{__('Changed')}} </div> --}}
                                        @endif

                                        {{-- @if ($item->status == 'Closed') --}}
                                        @if ($item->status == 'Closed')
                                        @else
                                            @if ($item->bids->count() === 0)
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ url('/myauctions/' . $item->id . '/edit') }}"
                                                    title="{{ __('Edit') }}"
                                                    data-toggle="tooltip"
                                                    data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            @endif

                                            {!! Form::open([
                                                'method' => 'PATCH',
                                                'url' => ['/myauctions/destroy2', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => __('Delete'),
                                                        'data-toggle' => 'tooltip',
                                                        'data-placement' => 'top',
                                                        'onclick' => 'return confirm("Are you sure you want to delete?")'
                                                )) !!}
                                            {!! Form::close() !!}

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="p-0">
                                        <div class="collapse" id="auction{{$item->id}}">
                                            <div class="card m-1">
                                            <div class="d-flex flex-row">
                                                {{-- <div class="p-2">
                                                    <strong>{{ __('Details') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $item->vehicle->name}}</span>
                                                </div> --}}

                                                @if ($item->bids->count())
                                                    <div class="p-2">
                                                        <strong>{{ __('Current bid') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $item->bids->min('bid') }}</span> |
                                                        <strong>{{ __('Bid')}}s</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $item->bids->count() }}</span>

                                                    </div>
                                                @endif

                                                @if ($item->passengers)
                                                    <div class="p-2">
                                                        <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $item->passengers }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Bids --}}
                                            @if ($item->bids->count())
                                            <h5 class="ml-2">{{ __('Bids') }}: </h5>
                                            @endif
                                            @for($i=0; $i < 1; $i++)
                                            @endfor
                                            @foreach ($bids->where('auction_id', $item->id) as $key => $bid)
                                            <div class="d-flex flex-row mb-3 border-bottom">
                                                <div class="p-2">
                                                    <a class="text-decoration-none" href="{{ url('/users/' . $bid->user['id']) }}" target="_blank">{{$bid->user['company_name']}}</a>

                                                    {{-- @if ($item->status == 'Closed' and $bid->won == 1)
                                                        {{ $bid->user->name }}
                                                    @else
                                                        {{__('Bid')}} {{ $i++ }}
                                                    @endif --}}
                                                </div>

                                                {{-- Red heart --}}
                                                <div class="p-2">
                                                    {{-- {{ $bid->user->id }} --}}
                                                @if (auth()->user()->following->contains($bid->user->profile->id)) 
                                                    <span><a href="#" data-toggle="tooltip" title="{{ __('This user is in your favorites') }}" data-placement="top"><i class="fa fa-heart text-danger" aria-hidden="true"></i></a></span>
                                                @endif
                                                </div>
                                                    
                                                <div class="p-2">
                                                    <strong>{{auth()->user()->country->currency_symbol}}{{ number_format($bid->bid, 2, '.', ',') }} </strong>
                                                    @if ($bestbid == $bid->bid)
                                                        <span class="badge badge-primary">{{__('Best bid')}} </span>
                                                    @endif
                                                </div>
                                                <div class="p-2">
                                                    @if ($bid->canceled === 1 & $bid->won === 0)
                                                        <span class="badge badge-danger">{{__('Cancelled')}} </span>
                                                    @else

                                                        @if ($bid->won === 1)
                                                            <span class="badge badge-success">{{__('Accepted')}} </span>
                                                        @elseif ($bid->won === 0 & $item->status == 'Closed')
                                                            <span class="badge badge-light">{{__('Not accepted')}} </span>
                                                        @endif

                                                        @if ($item->status === "Closed")

                                                        @else
                                                            @if ($bid->won === 0)
                                                            {!! Form::open([
                                                                'method' => 'PATCH',
                                                                'url' => ['/bids', $bid->id],
                                                                'style' => 'display:inline',
                                                                'class' => 'accept'
                                                                // 'onsubmit' => 'return ConfirmDelete()'
                                                            ]) !!}
                                                                {{-- {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', array(
                                                                        'type' => 'submit',
                                                                        'class' => 'btn btn-success btn-sm',
                                                                        'title' => 'Aceptar oferta',
                                                                        'onclick'=>'sendLove(this);',
                                                                        'id' => 'accept'
                                                                        )) !!} --}}

                                                                <button type="submit" onclick="acceptBid(this);" class="btn btn-success btn-sm" data-toggle="tooltip" title="{{ __('Are you sure you want to accept this bid?') }}" data-placement="right"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                                {{-- <a href="#" onclick="acceptBid(this);" class="btn btn-success btn-sm" title="{{ __('Accept bid') }}">
                                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                                </a> --}}
                                                            {!! Form::close() !!}
                                                            @endif
                                                        @endif

                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                        </tbody>

                    </table>

                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                            <div class="pagination">{!! $auctions->appends(['service_number' => Request::get('service_number'), 'from' => Request::get('from'), 'to' => Request::get('to'), 'asc_desc' => Request::get('asc_desc')])->render() !!}</div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    {{-- end col-md-12 --}}
</div>

{{-- Mobile version --}}

<div class="row d-none d-block d-sm-block d-md-none">
    <div class="col-md-12">
        <a href="{{ route('myauctions.createprivate') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Create new auction') }}</a>
    </div>
    <br>
    @foreach($auctions as $item)
        @section('best_bid')
            {{ $bestbid = $bids->where('auction_id', $item->id)->min('bid') }}
            {{-- {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }} --}}
            {{-- {{ $favoritebid = $bids->where('auction_id', $item->id)->where('bid', $bestbid)->last() }} --}}
            {{ $favoritebid = $bids->where('bid', $bids->min('bid'))->first() }}
            @if ($bids->where('auction_id', $item->id)->count())
                {{ $profile = App\Profile::where('user_id', $favoritebid->user_id)->first() }}
            @endif
        @endsection
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Service Number') }}: <strong>{{ $item->service_number }} </strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">@lang('globals.from') <strong>{{ $item->fromcity['name'] }}</strong> @lang('globals.to') <strong>{{ $item->tocity['name'] }}</strong></h5>
                    <span><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('F j, Y', strtotime($item->date)) }}, {{ date('g:i a', strtotime($item->time)) }}</span><br>
                    <span><strong>{{ __('Bids') }}:</strong> {{ $bids->where('auction_id', $item->id)->count() }}</span>
                    |
                    <span>
                        <strong>{{ __('Current bid') }}:</strong>
                        @if ($bids->where('auction_id', $item->id)->count())
                            <span><a href="#" data-toggle="tooltip" title="{{ __('The best bid') }}" data-placement="top">{{auth()->user()->country->currency_symbol}}{{ number_format($bestbid, 2, '.', ',') }}</a></span>

                            {{-- {{ $profile }} --}}
                            @if (auth()->user()->following->contains($profile->id))
                                <span><a href="#" data-toggle="tooltip" title="{{ __('This user is in your favorites') }}" data-placement="top"><i class="fa fa-heart text-danger" aria-hidden="true"></i></a></span>
                            @endif
                        @endif
                    </span> <br>

                    <span><strong>{{ __('Status') }}:</strong> </span>
                    @if ($item->changed === 1 & $item->status === 'Closed')
                        <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                    @elseif ($item->changed === 1)
                        <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is Changed because you updated its info') }}" data-placement="top">{{ __('Changed')}} </span>
                    @else
                        @if ($item->status == 'Closed')
                            <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                        @else
                            @if ($bids->where('auction_id', $item->id)->count() > 0)
                                <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ __('This Auction is Open because has one bid or more.') }}" data-placement="top">{{ __('Open') }}</span>
                            @else
                                <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is do not have bids.') }}" data-placement="top">{{ __('No bid yet') }}</span>
                            @endif
                        @endif
                    @endif

                </div>
                {{-- footer --}}
                <div class="card-footer text-muted">
                    {{-- <a class="btn btn-secondary btn-sm"
                            href="{{ url('/myauctions/' . $item->id) }}"
                            title="{{ __('View') }}"
                            data-toggle="tooltip"
                            data-placement="top"><i class="fa fa-eye" aria-hidden="true"></i>
                        </a> --}}

                        @if ($item->changed === 0 & $item->bids->count() > 0 & $item->status === 'Open')
                            {{-- <a class="btn btn-secondary btn-sm"
                                href="{{ url('/myauctions/change/' . $item->id) }}"
                                title="{{ __('Edit') }}"
                                data-toggle="tooltip"
                                data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a> --}}
                        @endif
                        @if ($item->changed === 1 & $item->status === 'Open')
                        <a class="btn btn-secondary btn-sm"
                                href="{{ url('/myauctions/' . $item->id . '/edit') }}"
                                title="{{ __('Edit') }}"
                                data-toggle="tooltip"
                                data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        {{-- <div class="badge badge-danger">{{__('Changed')}} </div> --}}
                        @endif

                        {{-- @if ($item->status == 'Closed') --}}
                        @if ($item->status == 'Closed')
                        @else
                        <a class="btn btn-secondary btn-sm"
                            href="{{ url('/myauctions/' . $item->id . '/edit') }}"
                            title="{{ __('Edit') }}"
                            data-toggle="tooltip"
                            data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/myauctions/destroy2', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => __('Delete'),
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'onclick' => 'return confirm("Surely you want to delete?")'
                                )) !!}
                            {!! Form::close() !!}

                        @endif


                </div>
            </div>

            <br>
        </div><!--/col-->

        @endforeach
    </div>

    <div class="row d-none d-block d-sm-block d-md-none">
        <div class="col-md-12">
            {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
            <div class="pagination">{!! $auctions->appends(['service_number' => Request::get('service_number'), 'from' => Request::get('from'), 'to' => Request::get('to'), 'asc_desc' => Request::get('asc_desc')])->render() !!}</div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $('#alert').click(function(){
        swal("Hello world!");
    });

    $(document).on('submit', '[id^=form]', function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    swal({
        title: "Are you sure?",
        text: "Do you want to Send this email",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, send it!",
        cancelButtonText: "No, cancel pls!",
    }).then(function () {
        $('#form').submit();
    });
    return false;
    });
</script>

<script>
    $(document).ready(function() {
        $('#auctions-mobile').DataTable({
            dom: 'tp'
        });
        // DataTable
        @if (Config::get('app.locale') == 'es')
        var table = $('#auctions').DataTable({
            dom: 'tpi',
            "aaSorting": [],
            columnDefs: [{ orderable: false, "targets": [5]}],
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
        @else
        var table = $('#').DataTable({
            dom: 'tpi',
            "aaSorting": [],
            columnDefs: [{ orderable: false, "targets": [5]}]
        });

        @endif

        // $('#from_search').on( 'change', function () {
        //     table
        //         .columns( 0 )
        //         .search( this.value )
        //         .draw();
        // } );
        // $('#to_search').on( 'change', function () {
        //     table
        //         .columns( 1 )
        //         .search( this.value )
        //         .draw();
        // } );

        // $('#number_search').bind( 'keyup', function () {
        //     table
        //         .columns( 2 )
        //         .search( this.value )
        //         .draw();
        // } );

    } );
</script>
@endsection
