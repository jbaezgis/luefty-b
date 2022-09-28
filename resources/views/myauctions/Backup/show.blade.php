@extends('layouts.app2')

@section('content')
<br>
<div class="row pl-3">
    <div class="col-md-12">
        
        <a href="{{ url('/myauctions') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('globals.go_back')</a> 
    </div>
</div>
<hr>

<div class="container">
        <div class="row">
            <div class="col-md-8">
                    <h3>@lang('globals.from') <strong>{{ $auction->from }}</strong> @lang('globals.to') <strong>{{ $auction->to }}</strong>
                        <span class="badge {{ ($auction->status === 'Closed') ? 'badge-success' : 'badge-warning' }}">{{ $auction->status }}</span>
                    </h3>
                    <p><strong>@lang('globals.date'):</strong> {{ date('F j, Y', strtotime($auction->date)) }}</p> 
                    <p><strong>@lang('globals.time'):</strong> {{ date('g:i a', strtotime($auction->time)) }}</p>
                    <p><strong>@lang('globals.starting_bid'):</strong> ${{ number_format($auction->starting_bid, 2, '.', ',') }}</p>
                    <p><strong>@lang('globals.pax'):</strong> {{ $auction->passengers }} 
                    | <strong>@lang('globals.min_seats'):</strong> {{ $auction->min_seats }} | <strong>@lang('globals.child_seats'):</strong> {{ $auction->child_seats }}</p>
                    <p><strong>@lang('globals.details'):</strong> <br />
                        {!! $auction->description !!}</p>
                    <p><strong>Extras:</strong> <br/>
                        @foreach ($auction->extras as $extra)
                            <i class="fa fa-check text-primary"></i> {{ $extra->name }}&nbsp;
                        @endforeach
                    </p>
                    

               
            </div>
        
        </div>
        <hr>

<br>
<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border"><h4>@lang('globals.bids')</h4></div>
            <div class="box-body">
                @if (auth()->check())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                {{-- <th>User</th> --}}
                                <th>@lang('globals.rating')</th>
                                <th>@lang('globals.bids')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- won: {{ $bid_won }} --}}
                            @foreach ($auction->bids as $bid)
                            <tr class="{{ ($bid->won === 1) ? 'table-success' : '' }}">
                                {{-- <td>{{ $bid->user->name }}</td> --}}
                                <td>
                                        @if ($bid->user->rating == 1)
                                        <a data-toggle="tooltip" data-placement="top" title="Bidder with older vehicles">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                        </a>
                                        @elseif ($bid->user->rating == 2)
                                        <a data-toggle="tooltip" data-placement="top" title="Bidder with older vehicles that are in good condition">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                        </a>
                                        @elseif ($bid->user->rating == 3)
                                        <a data-toggle="tooltip" data-placement="top" title="Bidder with new vehicles but has a medium market reputation">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                        </a>
                                        @elseif ($bid->user->rating == 4)
                                        <a data-toggle="tooltip" data-placement="top" title="Bidder with new vehicles and a good reputation">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star-o text-warning"></i>
                                        </a>
                                        @elseif ($bid->user->rating == 5)
                                        <a data-toggle="tooltip" data-placement="top" title="Highest class provider in the market">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </a>
                                        @endif    
                                </td>
                                <td>
                                     @if (Auth::user()->hasRole('admin') && $bid->user->name == 'Dominican Shuttles')
                                        <i class="fa fa-circle text-primary"></i>
                                    @endif
                                    ${{ number_format($bid->bid, 2, '.', ',') }} 
                                </td>
                                <td>
                                    {{-- <a class="btn btn-success btn-sm" href="#"><i class="fa fa-check"></i> Aceptar</a> --}}
                                    @if ($bid_won)

                                    @else
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