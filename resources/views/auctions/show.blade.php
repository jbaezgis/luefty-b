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
                @if ($auction->category_id == 1)
                    @if (Config::get('app.locale') == 'en')
                    <h5><span class="badge badge-primary">{{ $auction->category['name'] }}</span></h5>
                    @else
                    <h5><span class="badge badge-primary">{{ $auction->category['es_name'] }}</span></h5>
                    @endif
                @else
                    @if (Config::get('app.locale') == 'en')
                    <h5><span class="badge badge-success">{{ $auction->category['name'] }}</span></h5>
                    @else
                    <h5><span class="badge badge-success">{{ $auction->category['es_name'] }}</span></h5>
                    @endif

                @endif
                <p>
                @if ($auction->category_id === 2)
                <strong>{{ __('Starting bid per seat') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($auction->starting_bid, 2, '.', ',') }}</span> |
                @endif
                @if ($auction->category_id === 1)
                <strong>{{ __('Best bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($bids->where('auction_id', $auction->id)->min('bid'), 2, '.', ',') }}</span> |
                        @if ($bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->count())
                            <strong>{{ __('My bid') }} </strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">${{ number_format($mybid, 2, '.', ',') }} </span> {{-- <i class="fa fa-circle {{ $mybid == $bestbid ? 'text-success' : 'text-danger'}} " aria-hidden="true"></i> --}}
                            @if ($mybid == $bestbid)
                            <span class="badge badge-success">{{ __('Winning')}}</span>
                            @else
                            <span class="badge badge-danger">{{ __('Losing')}}</span>
                            @endif |
                        @endif
                    @endif
                    <strong>{{ __('Bid')}}s</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $bids->where('auction_id', $auction->id)->count() }}</span> |
                    @if ( $bids->where('auction_id', $auction->id)->count() )
                    @endif
                    @if ($auction->passengers)
                        <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $auction->passengers }}</span> |
                    @endif
                    <strong>
                        @if ($auction->category_id === 1)
                        {{ __('Details') }}
                        @else
                        {{ __('Seats available') }}
                        @endif:
                    </strong>
                    <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">
                        @if ($auction->category_id === 2)
                        {{ $auction->passengers }} / {{ $auction->shared_seats }}
                        @else
                        {{-- {{ $auction->passengers }} --}}
                        {{ $auction->vehicle->name}}
                        @endif

                    </span>
                </p>
                <p>
                    @if ($auction->category_id == 1)
                        <strong> {{ __('Service')}}</strong>: <span class=" {{$auction->category_id === 1 ? 'text-primary' : 'text-success'}}">{{ date('l, F j - Y', strtotime($auction->date)) }}, {{ date('g:i A', strtotime($auction->time)) }}</span>
                    @else
                        <strong>{{__('Date')}}</strong>: <span class=" {{$auction->category_id === 1 ? 'text-primary' : 'text-success'}}">{{ date('l, F j - Y', strtotime($auction->date)) }}</span> | <strong> {{ __('Boarding Time')}}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($auction->from_time)) }}</span> | <strong> {{ __('Departue Time')}}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($auction->to_time)) }}</span>
                    @endif
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
        <div class="col-md-4 mb-5">
            <form method="POST" action="{{ route('bids.store', $auction->id) }}">
                {{ csrf_field() }}
                <div class="d-flex flex-row bd-highlight mb-3">
                    {{-- <div class="form-group  mr-1 w-100">
                        <input type="number" step=".01" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" id="bid" name="bid" value="{{ old('seats') }}" placeholder="{{ __('Bid per seat')}}" aria-describedby="bidErrors">
                        @if($errors->any())
                            <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                        @endif
                    </div> --}}
                    <div class="input-group  mr-1 w-100">
                        <div class="input-group-prepend" style="display: block;">
                        <div class="input-group-text">US$</div>
                        </div>
                        <input type="number" step=".01" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>

                    </div>
                    @if ($auction->category_id === 6)
                    <div class="form-group">
                        <input type="number" class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}" id="seats" name="seats" value="{{ old('seats') }}" placeholder="{{ __('Seats')}}" aria-describedby="seatsErrors">
                        @if($errors->any())
                            <small id="seatsErrors" class="form-text text-danger">{{ $errors->first('seats') }}</small>
                        @endif
                    </div>
                    @endif
                </div>
                @if($errors->any())
                    @if ($bids->where('auction_id', $auction->id)->count() > 0)
                        <p id="bidErrors" class="form-text text-danger mb-1 mt-n3">{{ __('Your bid must be between') }} <strong>${{ $min }}</strong> {{ __('and') }} <strong>${{ $max }}</strong> </p>
                    @else
                        <p id="bidErrors" class="form-text text-danger mb-1 mt-n3">{{ __('Your bid must be') }} <strong>$1.00</strong> {{ __('or higher')}}. </p>
                    @endif
                @else
                    {{-- <small id="bidErrors" class="form-text mb-1 mt-n3">{{ __('Your bid must be') }} <strong>{{ $min }}</strong> {{ __('or less') }}. </small> --}}
                @endif
                <button type="submit" class="btn btn-primary btn-block" data-submit-value="Please wait...">
                    {{ __('Make bid')}}
                </button>

            </form>
        </div>

    <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-header with-border"><h4>@lang('globals.bids') {{-- ({{ $auction->bids->count() }}) --}}</h4></div>
            <div class="box-body">
                @if (auth()->check())

                {{-- <h5>{{ __('Other users')}} </h5> --}}
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

                            @foreach ($bids as $key => $bid)
                            {{-- @if () --}}
                            <tr class="">
                                    @if ($bid->user->id == auth()->user()->id )
                                        <td>
                                            {{ $bid->user->name }}
                                        </td>
                                    @else
                                        <td>
                                            {{__('Bid')}} {{ $key+1}}
                                        </td>
                                    @endif

                                @if ($auction->category_id === 2)
                                <td>{{ $bid->seats }}</td>
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
                                    @if ($bid->won === 1)
                                        <span class="badge badge-success">{{ __('Accepted')}} </span>
                                    @else
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
                                        @endif
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
