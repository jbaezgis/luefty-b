@extends('layouts.app2')

@section('content')
<br>

<div class="container">
    @section('best_bid')
    {{ $bestbid = $bids->where('auction_id', $auction->id)->min('bid') }}
    {{ $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid') }}
    @endsection
        {{-- <a class="btn btn-secondary" href="/transfers"><i class="fa fa-chevron-circle-left"></i> @lang('globals.go_back')</a>
            <hr> --}}
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-weight-light">@lang('globals.from') <strong>{{ $auction->fromcity->name }}</strong> @lang('globals.to') <strong>{{ $auction->tocity->name }}</strong></h3>
                <p>
                    <strong> {{ __('Service')}}</strong>: <span class=" {{$auction->category_id === 1 ? 'text-primary' : 'text-success'}}">{{ date('l, F j - Y', strtotime($auction->date)) }}, {{ date('g:i A', strtotime($auction->time)) }}</span>
                    |
                    <strong>{{ __('Current bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($bids->where('auction_id', $auction->id)->min('bid'), 2, '.', ',') }}</span> |

                    <strong>{{ __('Bid')}}s</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $bids->where('auction_id', $auction->id)->count() }}</span> |
                    @if ( $bids->where('auction_id', $auction->id)->count() )
                    @endif
                    @if ($auction->passengers)
                        <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $auction->passengers }}</span> |
                    @endif
                    <strong>{{ __('Details') }}: </strong> <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $auction->vehicle->name}}</span>
                </p>

            </div>


        </div>
        {{-- @if ($auction->category_id === 1)
        <hr>
        <p><strong>Extras:</strong> <br/>
            @foreach ($auction->extras as $extra)
                <i class="fa fa-check text-primary"></i> {{ $extra->name }}&nbsp;
            @endforeach
        </p>
        @endif --}}
<hr>
<div class="row">

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border"><h4>@lang('globals.bids') {{-- ({{ $auction->bids->count() }}) --}}</h4></div>
            <div class="box-body">
                @if (auth()->check())

                {{-- <h5>{{ __('Other users')}} </h5> --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th >{{ __('Supplier') }}</th>
                                <th >{{ __('Email') }}</th>
                                <th >{{ __('Phone') }}</th>
                                <th>{{ __('Bid')}}</th>
                                <th>{{ __('Bidded at')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($bids as $key => $bid)
                            {{-- @if () --}}
                            <tr class="">
                                <td><a class="text-decoration-none" href="{{ url('/users/' . $bid->user->id) }}" target="_blank"><strong><span class="text-capitalize" >{{ $bid->user->name }}</span></strong></a></td>
                                <td>{{ $bid->user->email }}</td>
                                <td>{{ $bid->user->phone }}</td>
                                <td><strong>${{ number_format($bid->bid, 2, '.', ',') }}</strong></td>
                                <td>{{ $bid->updated_at->diffForHumans() }}</td>

                                <td>
                                    @if ($bid->won === 1)
                                        <span class="badge badge-success">{{ __('Accepted')}} </span>
                                    {{-- @else
                                        @if ($bid->user_id === Auth::user()->id)
                                        <!-- <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash-o"></i></a> -->
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/bids', $bid->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'data-toggle'=>'tooltip',
                                                    'data-placement'=>'top',
                                                    'title'=>__('Delete Bid?'),
                                                    'class' => 'btn btn-danger btn-sm'
                                                    // 'title' => 'Delete Bid'
                                                    // 'onclick'=>'return confirm("Confirm?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                        @endif --}}
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
