@extends('layouts.app2')

@section('content')
{{-- <div class="container-title">
        <h2 class="page-title bg-primary"><i class="fa fa-car"></i> @lang('auctions.my_transfers')</h2>
    </div> --}}

    <div class="container">
            <br>
            <div class="row pl-3">
                <div class="col-md-12">
                    @if ($auction->category_id == 1)
                        <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> {{ __('Go back')}}</a>
                    @elseif ($auction->category_id == 2)
                        <a href="{{ url('/myauctions/sharedshuttles/index') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> {{ __('Go back')}}</a>
                    @endif
                </div>
            </div>
            <hr>


        <div class="row">
            <div class="col-md-12">
                    <h3>
                        {{__('From')}} <strong>{{ $auction->fromcity->name }}</strong>
                        {{__('To')}} <strong>{{ $auction->tocity->name }}</strong>
                    </h3>

                    <div class="d-flex flex-row bd-highlight mb-3">
                        {{-- <div class="mr-3">
                            @if ($auction->category_id == 1)
                            <h5><span class="badge badge-primary">{{ $auction->category['name'] }}</span></h5>
                            @else
                            <h5><span class="badge badge-success">{{ $auction->category['name'] }}</span></h5>
                            @endif
                        </div> --}}
                        <div class="">
                            <h5>{{ __('Status')}}:
                                @if ($auction->status === 'Closed')
                                    <span class="badge badge-success">{{ __('Accepted')}}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Open')}}</span>
                                @endif
                            </h5>
                                {{-- <span class="badge {{ ($auction->status === 'Closed') ? 'badge-success' : 'badge-warning' }}">{{ $auction->status }}</span> --}}
                        </div>
                    </div>

                    <p> {{--<strong>{{ __('Starting bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $auction->starting_bid}}</span> | --}}
                        <strong> {{ __('Service')}}</strong>:  <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($auction->date)) }}, {{ date('g:i a', strtotime($auction->time)) }}</span> |
                        <strong>{{ __('Details') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $auction->vehicle->name}}</span>

                        @if ($bids->where('auction_id', $auction->id)->count())
                        <strong>{{ __('Current bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $bids->where('auction_id', $auction->id)->min('bid') }}</span> |
                        <strong>{{ __('Bid')}}s</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $bids->where('auction_id', $auction->id)->count() }}</span>
                        @endif

                        @if ($auction->passengers)
                            |
                            <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $auction->passengers }}</span>
                         @endif
                    </p>
                    <hr>
                    @if ($auction->status == 'Closed')
                        <h5 class="text-success">{{ __('Winner') }}: </h5>
                        <h5>{{ $won_user->user->name}} <small>( {{ __('Bid')}}: <span class="text-success">${{ number_format($won_user->bid, 2, '.', ',') }} )</small></span></h5>
                        <div class="d-flex flex-row mb-3">
                            <div class="p-2"><strong>{{ __('Email') }}: </strong> <span class="text-success">{{ $won_user->user->email}}</span></div>
                            <div class="p-2"><strong>{{ __('Phone') }}: </strong> <span class="text-success phone">{{ $won_user->user->phone}}</span></div>
                            <div class="p-2"><strong>{{ __('Company name') }}: </strong> <span class="text-success">{{ $won_user->user->company_name}}</span></div>
                          </div>
                    @endif
            </div>
        </div>

        @if ($auction->category_id === 1)
        {{-- <hr> --}}
        {{-- <div class="row">
            <div class="col-md-6">
                <h5>Extras for provider</h5>
                @foreach ($extraspro as $item)
                    <i class="fa fa-check-circle text-primary" aria-hidden="true"></i> <strong> {{ $item->quantity }}</strong> {{ $item->extra->name }}<br>
                @endforeach
            </div>
            <div class="col-md-6">
                <h5>Extras for passengers</h5>
                @foreach ($extraspass as $item)
                    <i class="fa fa-check-circle text-primary" aria-hidden="true"></i> <strong> {{ $item->quantity }}</strong> {{ $item->extra->name }}<br>
                @endforeach
            </div>
        </div> --}}
        {{-- <p><strong>Extras:</strong> <br/>
            @foreach ($auction->extras as $extra)
                <i class="fa fa-check text-primary"></i> {{ $extra->name }}&nbsp;
            @endforeach
        </p> --}}
        @endif

<hr>
@if( session()->has('error') )
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! session('error') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border"><h4>@lang('globals.bids')</h4></div>
            <div class="box-body">
                @if (auth()->check())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            {{-- <tr>
                                    <th >{{ __('Bid') }}</th>
                                    <th>
                                        @if ($auction->category_id === 1)
                                        {{ __('Amount')}}
                                        @else
                                        {{ __('Bid per seat')}}
                                        @endif
                                    </th>
                                    @if ($auction->category_id === 2)
                                    <th>{{ __('Total') }} </th>
                                    @endif
                                    <th></th>
                                    @if ($auction->status === "Closed")

                                    @else
                                    <th>{{ __('Accept Bid')}} </th>
                                    @endif
                            </tr> --}}
                        </thead>
                        <tbody>
                            @for($i=0; $i < 1; $i++)
                            @endfor
                            {{-- Favorites --}}
                            @foreach ($bids->where('auction_id', $auction->id) as $key => $bid)

                            @if (auth()->user()->following->contains($bid->user->profile->id))
                                <tr class="">

                                        @if ($auction->status == 'Closed' and $bid->won == 1)
                                            <td>
                                            <span><a href="#" data-toggle="tooltip" title="{{ __('This user is in your favorites') }}" data-placement="top"><i class="fa fa-heart text-danger" aria-hidden="true"></i></a></span>
                                            {{ $bid->user->name }}
                                            </td>
                                        @else
                                        <td>
                                            <span><a href="#" data-toggle="tooltip" title="{{ __('This user is in your favorites') }}" data-placement="top"><i class="fa fa-heart text-danger" aria-hidden="true"></i></a></span>
                                            {{__('Bid')}} {{ $i++ }}

                                        </td>
                                        @endif

                                        <td>
                                            <strong>${{ number_format($bid->bid, 2, '.', ',') }} </strong>
                                        </td>

                                        @if ($bid->canceled === 1 & $bid->won === 0)
                                            <td><div class="badge badge-danger">{{__('Cancelled')}} </div></td>
                                        @else
                                        <td>
                                            @if ($bid->won === 1)
                                                <div class="badge badge-success">{{__('Accepted')}} </div>
                                            @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed')
                                                <div class="badge badge-light">{{__('Not accepted')}} </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($auction->status === "Closed")

                                            @else
                                                @if ($bid->won === 0)
                                                {!! Form::open([
                                                    'method' => 'PATCH',
                                                    'url' => ['/bids', $bid->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {{-- {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-success btn-sm',
                                                            'title' => 'Aceptar oferta',
                                                            'onclick'=>'sendLove(this);',
                                                            'id' => 'accept'
                                                            )) !!} --}}

                                                    <button type="submit" onclick="acceptFavorite(this);" class="btn btn-success btn-sm" data-toggle="tooltip" title="{{ __('Are you sure you want to accept this bid?') }}" data-placement="right"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                {!! Form::close() !!}
                                                @endif
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach

                            {{-- No favorites --}}
                            @foreach ($bids->where('auction_id', $auction->id) as $key => $bid)

                            @if (auth()->user()->following->contains($bid->user->profile->id) == false)
                            <tr class="">

                                @if ($auction->status == 'Closed' and $bid->won == 1)
                                    <td>
                                        {{ $bid->user->name }}
                                    </td>
                                @else
                                    <td>
                                        {{__('Bid')}} {{ $i++ }}
                                    </td>
                                @endif

                                <td>
                                    <strong>${{ number_format($bid->bid, 2, '.', ',') }} </strong>
                                </td>

                                @if ($bid->canceled === 1 & $bid->won === 0)
                                    <td><div class="badge badge-danger">{{__('Cancelled')}} </div></td>
                                @else
                                <td>
                                    @if ($bid->won === 1)
                                        <div class="badge badge-success">{{__('Accepted')}} </div>
                                    @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed')
                                        <div class="badge badge-light">{{__('Not accepted')}} </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($auction->status === "Closed")

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
                                </td>
                                @endif
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @endif
                @if (auth()->guest())
                <p>Debes iniciar sección para ver las ofertas.</p>
                <p>
                    <a href="/login">Inicia sección</a> o
                    <a href="/register">Regístrate</a>
                </p>
                @endif
            </div>
        </div>
        @if ($auction->category_id === 2)
        <h5>{{ __('Total') }}: <span class="text-success">${{ number_format($bid_won_sum, 2, '.', ',') }}</span></h5>
        @endif
    </div>
</div>

</div>
</div>

<br>

{{-- @if ($bids_canceled->where('auction_id', $auction->id)->count() & $auction->status === 'Open')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <span class="text-danger">{{ $bids_canceled->where('auction_id', $auction->id)->count() }} {{ _('cancelled bids after auctions changed') }} </span>
        </div>
    </div>
</div>
@endif --}}

@endsection


@section('scripts')

<script>
    function acceptBid(this1)
    {
        // confirm('If you accept this offer, the Auction will also close.');
        this1.form.submit();
        this1.disabled=true;
        this1.innerHTML='<i class="fa fa-spinner fa-spin"></i> Please wait…';
    }
</script>

<script>
    function acceptFavorite(this2)
    {
        // confirm('If you accept this offer, the Auction will also close.');
        this2.form.submit();
        this2.disabled=true;
        this2.innerHTML='<i class="fa fa-spinner fa-spin"></i> Please wait…';
    }
</script>

<script>
$(document).ready(function(){
    $('.phone').mask('(000) 000-0000');
});
</script>
@endsection
