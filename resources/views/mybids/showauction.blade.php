@extends('layouts.app2')

@section('content')

{{-- <div class="container-title">
        <h2 class="page-title bg-primary"><i class="fa fa-money"></i> {{ trans('bids.my_bids') }} </h2>
</div> --}}
<br>
{{-- <div class="container-fluid">
<div class="row pl-3">
    <div class="col-md-12">

        <a href="{{ url('/mybids') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('globals.back')</a>


    </div>
</div>
</div>
<hr> --}}

<div class="container">
        @section('best_bid')
        {{ $bestbid = $bids->where('auction_id', $auction->id)->min('bid') }}
        {{ $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid') }}
        @endsection
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
                                                <span class="badge badge-success">{{ __('Closed')}}</span>
                                            @else
                                                <span class="badge badge-warning">{{ __('Open')}}</span>
                                            @endif
                                        </h5>
                            </div>
                        </div>

                        {{-- <strong>{{ __('Starting bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($auction->starting_bid, 2, '.', ',') }}</span> | --}}
                            <p><strong>{{ __('Best bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($bids->where('auction_id', $auction->id)->min('bid'), 2, '.', ',') }}</span> |
                                <strong> {{ __('Service')}}</strong>:  <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($auction->date)) }}, {{ date('g:i a', strtotime($auction->time)) }}</span> |
                                <strong>{{ __('Details') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $auction->vehicle->name}}</span>

                                @if ($bids->where('auction_id', $auction->id)->count())
                                <strong>{{ __('Current bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $bids->where('auction_id', $auction->id)->min('bid') }}</span> |
                                <strong>{{ __('Bidders')}}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $bids->where('auction_id', $auction->id)->count() }}</span>
                                @endif

                                @if ($auction->passengers)
                                    |
                                    <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $auction->passengers }}</span>
                                 @endif
                        </p>
                        {{-- <p>
                            @if ($auction->category_id == 1)
                                <strong> {{ __('Service')}}</strong>:  <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($auction->date)) }}, {{ date('g:i a', strtotime($auction->time)) }}</span>
                            @else
                                <strong>{{__('Date')}}</strong>:
                                    <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($auction->date)) }}</span> |
                                <strong> {{ __('Boarding Time')}}</strong>:
                                    <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($auction->from_time)) }}</span>
                                <strong> {{ __('Departue Time')}}</strong>:
                                <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($auction->to_time)) }}</span>
                            @endif
                        </p> --}}
            </div>

            <div class="col-md-12">
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
            </div>
        </div>
        <hr>

<br>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border"><h4>{{__('Bids')}}</h4></div>
            <div class="box-body">
                @if (auth()->check())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                    <th>
                                        {{ __('Bid')}}
                                    </th>

                                    <th>{{ __('Amount') }} </th>

                                    <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- won: {{ $bid_won }} --}}
                            @foreach ($auction->bids as  $key => $bid)
                            <tr class="">
                                {{-- <td>{{ $bid->user->name }}</td> --}}

                                @if ($bid->user->id == auth()->user()->id )
                                    <td>
                                        {{ $bid->user->name }}
                                    </td>
                                @else
                                    <td>
                                        {{__('Bid')}} {{ $key+1}}
                                    </td>
                                @endif


                                <td>
                                    @if (Auth::user()->hasRole('admin') && $bid->user->name == 'Dominican Shuttles')
                                        <i class="fa fa-circle text-primary"></i>
                                    @endif
                                    ${{ number_format($bid->bid, 2, '.', ',') }}
                                    @if ($bid->user->id == auth()->user()->id )
                                        <span class="badge badge-primary">{{ __('My bid')}} </span>
                                    @endif
                                </td>
                                    @if ($auction->category_id === 2)
                                    <td>${{ number_format($bid->total, 2, '.', ',') }}</td>
                                    @endif
                                <td>
                                    @if ($bid->canceled === 1)
                                        <div class="badge badge-danger">{{__('Canceled')}} </div>
                                    @elseif ($bid->won === 1)
                                        <div class="badge badge-success">{{__('Accepted')}} </div>
                                    @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed')
                                        {{-- <div class="badge badge-warning">{{__('Lost')}} </div> --}}
                                    @endif
                                </td>
                            </tr>
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
    </div>
</div>

</div>
    </div>


@endsection
