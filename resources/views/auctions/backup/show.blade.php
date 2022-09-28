@extends('layouts.app2')

@section('content')
<br>

<div class="container">
                        
            <a class="btn btn-secondary" href="/transfers"><i class="fa fa-chevron-circle-left"></i> @lang('globals.go_back')</a>
            <hr>
        <div class="row">
            <div class="col-md-8">
                    <h3 class="font-weight-light">@lang('globals.from') <strong>{{ $auction->from }}</strong> @lang('globals.to') <strong>{{ $auction->to }}</strong></h3>
                    {{-- <h6 class="card-title text-muted">
                        @if ($auction->user_id === auth()->user()->id)
                            {{$auction->user->name}}
                        @else
                        @lang('globals.rating'): 
                        @endif
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
                    
                    <p><strong>@lang('globals.date'):</strong> {{ date('F j, Y', strtotime($auction->date)) }} | <strong>@lang('globals.time'):</strong> {{ date('g:i a', strtotime($auction->time)) }}</p>
                    {{-- <p><strong>@lang('globals.ends'):</strong> {{ date('j F, Y', strtotime($auction->end_date)) }}, <strong>@lang('globals.time'):</strong> {{ date('g:i a', strtotime($auction->end_date)) }}</p> --}}
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
            
            
        </div>
        <hr>

<br>
<div class="row">
        <div class="col-md-4 mb-5">
            <form method="POST" action="{{ route('bids.store', $auction->id) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    
                    <input type="number" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" id="bid" name="bid" value="" aria-describedby="bidErrors">
                    @if($errors->any())
                        <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                    @endif
                    
                </div>
                
                <button type="submit" class="btn btn-primary btn-block" data-submit-value="Please wait...">
                    @lang('globals.make_a_bid')
                </button>
            </form>
        </div>
            
    <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-header with-border"><h4>@lang('globals.bids')</h4></div>
            <div class="box-body">
                @if (auth()->check())
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              
                                <th >@lang('globals.rating')</th>
                                <th>@lang('globals.bids')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bids as $bid)
                            <tr class="{{ ($bid->user_id === Auth::user()->id) ? 'table-light' : '' }}">
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
                                    @if ($bid->user_id === Auth::user()->id)
                                    <!-- <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash-o"></i></a> -->
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/bids', $bid->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Bid',
                                                'onclick'=>'return confirm("Confirm delete?")'
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