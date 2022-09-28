@extends('layouts.app2')

@section('content')
{{-- <div class="container-title">
        <h2 class="page-title bg-primary"><i class="fa fa-car"></i> @lang('auctions.my_transfers')</h2>
    </div> --}}

    <div class="container">
        <br>
        <div class="row pl-3">
            <div class="col-md-12">

                <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}}</a>
                {{-- <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="" class="btn btn-primary btn-sm"><i class="fa fa-list" aria-hidden="true"></i></a>
                    <a href="{{ url('/myauctions') }}" class="btn btn-light btn-sm"> @lang('auctions.see_all_transfers')</a>
                </div> --}}
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-md-12">
                {{-- <a href="{{ url('/myauctions/changed/' . $auction->id) }}" class="btn btn-primary btn-lg">{{ __('Edit auction')}} </a> --}}
                    {!! Form::open([
                        'method' => 'PATCH',
                        'url' => ['/myauctions/changed', $auction->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {{-- {!! Form::button('<i class="fa fa-pencil" aria-hidden="true"></i>' . ' ' . __('Edit auction'), array(
                                'type' => 'submit',
                                'class' => 'btn btn-primary btn-lg'
                        )) !!} --}}
                        <button type="submit" onclick="editAuction(this);" class="btn btn-primary btn-lg" title="{{ __('Accept bid') }} "><i class="fa fa-pencil" aria-hidden="true"></i> {{__('Edit auction')}}</button>
                    {!! Form::close() !!}
            </div>
            <br>
            <div class="col-md-12 mt-2">
                <p class="lead"><i class="fa fa-asterisk text-danger" aria-hidden="true"></i> {{ __('If you make changes to this auction, all bids will be canceled and suppliers will be notified via email in case they want to make bids again.') }}</p>
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
                        {{-- <strong>{{ __('Details') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $auction->vehicle->name}}</span> --}}

                        @if ($auction->bids->count())
                            <strong>{{ __('Current bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $auction->bids->min('bid') }}</span> |
                            <strong>{{ __('Bid')}}s</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $auction->bids->count() }}</span>
                        @endif

                        @if ($auction->passengers)
                            |
                            <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $auction->passengers }}</span>
                         @endif
                    </p>



            </div>
        </div>

        @if ($auction->category_id === 1)
        <hr>
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
        <p><strong>Extras:</strong> <br/>
            @foreach ($auction->extras as $extra)
                <i class="fa fa-check text-primary"></i> {{ $extra->name }}&nbsp;
            @endforeach
        </p>
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
            <div class="box-header with-border"><h4>{{__('Bids')}}</h4></div>
            <div class="box-body">
                @if (auth()->check())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                    <th >{{ __('Bid') }}</th>
                                    @if ($auction->category_id === 2)
                                    <th>{{ __('Seats') }} </th>
                                    @endif
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
                            </tr>
                        </thead>
                        <tbody>
                            {{-- won: {{ $bid_won }} --}}
                            @foreach ($bids as $bid)
                            <tr class="">
                                {{-- <td>{{ $bid->user->name }}</td> --}}
                                <td>
                                    {{__('Bid')}}
                                </td>
                                @if ($auction->category_id === 2)
                                <td>{{ $bid->seats }}</td>
                                @endif
                                <td>
                                    @if (Auth::user()->hasRole('admin') && $bid->user->name == 'Dominican Shuttles')
                                        <i class="fa fa-circle text-primary"></i>
                                    @endif
                                    ${{ number_format($bid->bid, 2, '.', ',') }}
                                </td>
                                @if ($auction->category_id === 2)
                                <td>${{ number_format($bid->total, 2, '.', ',') }}</td>
                                @endif
                                @if ($bid->canceled === 1 & $bid->won === 0)
                                    <td><div class="badge badge-danger">{{__('Cancelled')}} </div></td>
                                @else
                                <td>
                                    @if ($bid->won === 1)
                                        <div class="badge badge-success">{{__('Accepted')}} </div>
                                    @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed')
                                        <div class="badge badge-warning">{{__('Lost')}} </div>
                                    @endif
                                </td>
                                @endif
                                {{-- <td>
                                    @if ($auction->status === "Closed")

                                    @else
                                        @if ($bid->won === 0)
                                        {!! Form::open([
                                            'method' => 'PATCH',
                                            'url' => ['/bids', $bid->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-success btn-sm',
                                                    'title' => 'Aceptar oferta',
                                                    'onclick'=>'return confirm("Seguro que desea aceptar esta oferta?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                        @endif
                                    @endif
                                </td> --}}
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
        @if ($auction->category_id === 2)
        <h5>{{ __('Total') }}: <span class="text-success">${{ number_format($bid_won_sum, 2, '.', ',') }}</span></h5>
        @endif
    </div>
</div>

</div>
    </div>


@endsection

@section('scripts')
<script>
    function editAuction(this1)
    {
    //alert('asdasd');
    this1.disabled=true;
    this1.innerHTML='<i class="fa fa-spinner fa-spin"></i> Please wait…';
    this1.form.submit();
    }
</script>
@endsection
