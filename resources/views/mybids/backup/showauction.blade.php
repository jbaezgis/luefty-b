@extends('layouts.app2')

@section('content')

{{-- <div class="container-title">
        <h2 class="page-title bg-primary"><i class="fa fa-money"></i> {{ trans('bids.my_bids') }} </h2>
</div> --}}
<br>
<div class="container-fluid">
<div class="row pl-3">
    <div class="col-md-12">
         
        <a href="{{ url('/mybids') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('globals.back')</a>
                
        {{-- <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-list" aria-hidden="true"></i></a>    
                <a href="{{ url('/mybids') }}" class="btn btn-light btn-sm"> @lang('globals.see_all_bids')</a>
            </div>
        
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>    
                <a href="{{ url('/mybids-won') }}" class="btn btn-light btn-sm"> @lang('globals.winning_bids')</a>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></a>    
                <a href="{{ url('/mybids-lost') }}" class="btn btn-light btn-sm"> @lang('globals.lost_bids')</a>
            </div> --}}
       {{-- {!! Form::open(['method' => 'GET', 'url' => '/mybids', 'class' => 'form-inline my-2 my-lg-0', 'role' => 'search'])  !!}
        
        &nbsp | &nbsp
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    
                </span>
                
            </div>
            &nbsp<a href="{{ url('/mybids') }}" class="btn btn-secondary"> Clear</a>
        {!! Form::close() !!} --}}

    </div>
</div>
</div>
<hr>

<div class="container">
        <div class="row">
            <div class="col-md-8">
                    <h3>@lang('globals.from') <strong>{{ $auction->from }}</strong> @lang('globals.to') <strong>{{ $auction->to }}</strong>
                        {{-- <small class=" {{ ($auction->status === 'Closed') ? 'text-success' : 'text-warning' }}"> - ({{ $auction->status }})</small> --}}
                        <span class="badge {{ ($auction->status === 'Closed') ? 'badge-success' : 'badge-warning' }}">{{ $auction->status }}</span>
                    </h3>
                    {{-- <h6 class="card-title text-muted">
                        @lang('globals.rating'): 
                        @if ($auction->user->rating == 1)
                        <a data-toggle="tooltip" data-placement="top" title="Small agency">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                        </a>
                        @elseif ($auction->user->rating == 2)
                        <a data-toggle="tooltip" data-placement="top" title="Small agency with a good reputation">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                        </a>
                        @elseif ($auction->user->rating == 3)
                        <a data-toggle="tooltip" data-placement="top" title="Well respected agency but with limited experience">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                        </a>
                        @elseif ($auction->user->rating == 4)
                        <a data-toggle="tooltip" data-placement="top" title="Well respected agency with years of experience">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-o text-warning"></i>
                        </a>
                        @elseif ($auction->user->rating == 5)
                        <a data-toggle="tooltip" data-placement="top" title="Highest class agency in the market">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                        </a>
                        @endif
                    </h6> --}}
                    
                    <p><strong>@lang('globals.date'):</strong> {{ date('F j, Y', strtotime($auction->date)) }}</p> 
                    <p><strong>@lang('globals.time'):</strong> {{ date('g:i a', strtotime($auction->time)) }}</p>
                    {{-- <p><strong>@lang('globals.pax'):</strong> {{ $auction->passengers }} | <strong>@lang('globals.min_seats'):</strong> {{ $auction->min_seats }}</p> --}}
                    <p><strong>@lang('globals.starting_bid'):</strong> ${{ number_format($auction->starting_bid, 2, '.', ',') }}</p>
                    <p><strong>@lang('globals.pax'):</strong> {{ $auction->passengers }} 
                    | <strong>@lang('globals.min_seats'):</strong> {{ $auction->min_seats }} | <strong>@lang('globals.child_seats'):</strong> {{ $auction->child_seats }}</p>
                    {{-- <p><strong>@lang('globals.details'):</strong> <br />
                        {!! $auction->description !!}</p> --}}
                    <p><strong>Extras:</strong> <br/>
                        @foreach ($auction->extras as $extra)
                            <i class="fa fa-check text-primary"></i> {{ $extra->name }}&nbsp;
                        @endforeach
                    </p>

                    

               
            </div>
            
            <div class="col-md-4">
                <!-- @if (auth()->check()) 
                    @if ($auction->user_id === Auth::user()->id)
                        No puedes ofertar en una subasta creada por ti.
                    @endif
                @else 
                    @if (auth()->check())
                        <form method="POST" action="{{ route('bids.store', $auction->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                
                                <input type="number" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" id="bid" name="bid" value="" aria-describedby="bidErrors">
                                
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block" data-submit-value="Please wait...">
                                Hacer una oferta
                            </button>
                        </form>
                    @else
                        <p>Debes iniciar sección para hacer una oferta.</p>
                        <p>
                            <a href="/login">Inicia sección</a> o
                            <a href="/register">Regístrate</a>
                        </p>
                    @endif

                @endif
 -->
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
                                <td>${{ number_format($bid->bid, 2, '.', ',') }} </td>
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