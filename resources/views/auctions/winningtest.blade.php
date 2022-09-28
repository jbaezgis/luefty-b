@extends('layouts.app2')
@section('title', trans('globals.auctions'))

@section('content')
<br>
<div class="container">
<div class="row">
    {{-- @include('auctions.search_sidebar')  --}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['method' => 'GET', 'url' => '/transfers', 'class' => '', 'role' => 'search'])  !!}
                    @lang('globals.filters'):
                    <div class="row">
                        
                        <div class="col-md-4">
                            {{-- <div class="form-group">
                                {!! Form::select('from_location', App\Place::pluck('name', 'id'), null, ['placeholder'=> __('From location'), 'class'=>'form-control select2']) !!}
                            </div> --}}
                            <div class="form-group">
                            <select name="from_location" class="form-control select2">
                                <option value="0" selected disable hidden>{{ __('From location') }}</option>
                                @foreach (App\Place::get() as $place)
                                    <option value="{{ $place->id }}" {{ old('from_location')==$place->id ? 'selected' : ''  }}>{{ $place->location->name }}, {{ $place->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            {{-- <div class="form-group">
                                
                                {!! Form::select('to_location', App\Place::pluck('name', 'id'), null, ['placeholder'=> __('To location'), 'class'=>'form-control select2' ]) !!}
                            </div> --}}
                            <div class="form-group">
                            <select name="to_location" class="form-control select2">
                                <option value="0" selected disable hidden>{{ __('To location') }}</option>
                                @foreach (App\Place::get() as $place)
                                    <option value="{{ $place->id }}" {{ old('to_location')==$place->id ? 'selected' : ''  }}>{{ $place->location->name }}, {{ $place->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {{-- <label for="to">Hasta</label> --}}
                                {!! Form::select('category_id', App\Category::where('disable', 0)->pluck('name', 'id'), null, ['placeholder'=> __('Category'), 'class'=>'form-control select2']) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                {{-- <label for="to">Hasta</label> --}}
                                {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder'=> __('Date')]) !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                            <a class="btn btn-warning" href="/transfers" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i></a>
                        </div>

                        {{-- <div class="col-md-2">
                           
                        </div> --}}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p>@lang('globals.order_by'):</p>
                @sortablelink('date', trans('globals.date'), ['class' => '']) |
                @sortablelink('from_location', trans('globals.from'), ['class' => '']) |
                @sortablelink('to_location', trans('globals.to'), ['class' => ''])
                
            </div>
             
        </div>
        {{-- Open auctions: {{ $auctions->count() }} --}}
        <br> 
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('auctions.transfers') }}" class="btn {{ request()->is('transfers') ? 'btn-primary' : 'btn-light' }}">{{ __('All') }}</a>
                <a href="{{ route('auctions.openauctions') }}" class="btn {{ request()->is('transfers/open/index') ? 'btn-primary' : 'btn-light' }}">{{ __('Open') }}</a>
                <a href="{{ route('auctions.winning') }}" class="btn {{ request()->is('transfers/winning/index') ? 'btn-primary' : 'btn-light' }}">{{ __('Winning') }}</a>
                <a href="{{ route('auctions.losing') }}" class="btn {{ request()->is('transfers/losing/index') ? 'btn-primary' : 'btn-light' }}">{{ __('Losing') }}</a>
            </div>
        <p></p>
        
        @foreach($auctions as $item)
        
            @section('best_bid')
            {{ $bestbid = $bids->where('auction_id', $item->id)->min('bid') }}
            {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }}
            @endsection
            {{-- @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count() < 0 ) --}}
        
            <div id="auction{{$item->id}}" class="box box-solid
                {{-- classes for box --}}
                @if ($mybid)
                    @if ($mybid == $bestbid)
                        box-success
                    @elseif ($mybid > $bestbid)
                        box-danger
                    @else
                        
                    @endif
                @else
                    box-default
                @endif
                {{ Auth::user()->hasRole('admin') && $item->user->name == 'Dominican Shuttles' ? 'box-primary' : '' }}">
                    <div class="box-header with-border">
                        <h5 class="box-title"><a href="{{ url('/auctions/' . $item->id) }}">@lang('globals.from') <strong>{{ $item->fromlocation['name'] }}</strong> @lang('globals.to') <strong>{{ $item->tolocation['name'] }}</strong></a></h5>
                        {{-- <div class="box-tools pull-right">
                            <a href="{{ url('/transfers/' . $item->id) }}" class="btn btn-outline-primary btn-sm">@lang('globals.make_a_bid')</a>
                        </div> --}}
                    </div>
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($item->category_id == 1)
                                @if (Config::get('app.locale') == 'en')	
                                <h5><span class="badge badge-primary">{{ $item->category['name'] }}</span></h5>
                                @else
                                <h5><span class="badge badge-primary">{{ $item->category['es_name'] }}</span></h5>
                                @endif
                            @else
                                @if (Config::get('app.locale') == 'en')	
                                <h5><span class="badge badge-success">{{ $item->category['name'] }}</span></h5>
                                @else
                                <h5><span class="badge badge-success">{{ $item->category['es_name'] }}</span></h5>
                                @endif
                            
                            @endif 

                    
                            <p><strong>{{ __('Starting bid') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($item->starting_bid, 2, '.', ',') }}</span> | 
                                <strong>{{ __('Best bid') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</span> | 
                                @if ($item->category_id === 1)
                                    @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count())
                                        <strong>{{ __('My bid') }} </strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">${{ number_format($mybid, 2, '.', ',') }} </span> {{-- <i class="fa fa-circle {{ $mybid == $bestbid ? 'text-success' : 'text-danger'}} " aria-hidden="true"></i> --}} 
                                        @if ($mybid == $bestbid)
                                        <span class="badge badge-success">{{ __('Winning')}}</span> 
                                        @else 
                                        <span class="badge badge-danger">{{ __('Losing')}}</span>                                         
                                        @endif |
                                    @endif
                                @endif
                                <strong>{{ __('Bid')}}s</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $bids->where('auction_id', $item->id)->count() }}</span> |
                                @if ( $bids->where('auction_id', $item->id)->count() )
                                @endif
                                <strong>
                                        @if ($item->category_id === 1) 
                                        {{ __('Passengers') }} 
                                        @else 
                                        {{ __('Seats available') }}
                                        @endif:
                                    </strong> 
                                    <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">
                                        @if ($item->category_id === 2) 
                                        {{ $item->passengers }} / {{ $item->shared_seats }}
                                        @else
                                        {{ $item->passengers }}
                                        @endif
                                    
                                    </span>
                            </p>
                            
                            <p> @if ($item->category_id == 1)
                                    <strong> {{ __('Service')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($item->date)) }}, {{ date('g:i A', strtotime($item->time)) }}</span>
                                @else
                                    <strong>{{__('Date')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($item->date)) }}</span> | <strong> {{ __('Boarding Time')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($item->from_time)) }}</span> <strong> {{ __('Departue Time')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($item->to_time)) }}</span>    
                                @endif
                            </p>
                            @if (Auth::user()->hasRole('admin') && $item->user->name == 'Dominican Shuttles')
                            <p><strong>@lang('globals.created_by')</strong>: {{ $item->user->name }}</p>
                            @endif
                            </p>
                        </div><!--/col-->
                    </div> {{-- end row --}}
                </div> {{-- end box-body --}}
                <div class="box-footer">
                    {{-- <small class="text-muted">Testing</small> --}}
                    @if ($mybid)
                        
                            <form method="POST" action="{{ route('bids.storefromtransfers2', $item->id) }}">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-light">
                                                <input type="radio" name="options" id="option1" autocomplete="off" value="1"> $1
                                            </label>
                                            <label class="btn btn-light">
                                                <input type="radio" name="options" id="option2" autocomplete="off" value="5"> $5
                                            </label>
                                            <label class="btn btn-light">
                                                <input type="radio" name="options" id="option3" autocomplete="off" value="10"> $10
                                            </label>
                                            <label class="btn btn-light">
                                                <input type="radio" name="options" id="option3" autocomplete="off" value="15"> $15
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" 
                                            class="btn 
                                            @if ($mybid == $bestbid)
                                            btn-success
                                            @elseif ($mybid > $bestbid)
                                            btn-danger
                                            @endif
                                            mr-2">
                                            
                                            {{ __('Make your bid')}}
                                        </button>

                                        @if ($mybid == $bestbid)
                                            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('You are in the winning position for this auction but If you are anxious to win  you may want to increase your bid to get the auctioneer to accept quickly.')}}"> <i class="fa fa-question-circle fa-lg text-muted" aria-hidden="true"></i></a>
                                        @elseif ($mybid > $bestbid)
                                            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('You are in a losing position for this auction. If you want a chance to win you need to bid again.')}}"> <i class="fa fa-question-circle fa-lg text-muted" aria-hidden="true"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                       
                    @else
                    <form method="POST" action="{{ route('bids.storefromtransfers2', $item->id) }}">
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light">
                                        <input type="radio" name="options" id="option1" autocomplete="off" value="1"> $1
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="options" id="option2" autocomplete="off" value="5"> $5
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="options" id="option3" autocomplete="off" value="10"> $10
                                    </label>
                                    <label class="btn btn-light">
                                        <input type="radio" name="options" id="option3" autocomplete="off" value="15"> $15
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary" data-submit-value="Please wait...">
                                    {{ __('Make bid')}}
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- <form method="POST" action="{{ route('bids.storefromtransfers', $item->id) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group  mr-1">
                                    <div class="input-group-prepend" style="display: block;">
                                    <div class="input-group-text">US$</div>
                                    </div>
                                    <input type="number" step=".01" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>
                                    @if($errors->any())
                                        <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                                    @endif
                                </div>

                            </div>
                            @if ($item->category_id === 2)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}" id="seats" name="seats" value="{{ old('seats') }}" placeholder="{{ __('Seats')}}" aria-describedby="seatsErrors">
                                        @if($errors->any())
                                            <small id="seatsErrors" class="form-text text-danger">{{ $errors->first('seats') }}</small>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" data-submit-value="Please wait...">
                                    {{ __('Make bid')}}
                                </button>
                            </div>
                        </div>
                       
                        
                    </form> --}}
                    @endif
                </div>
            </div> {{-- end box --}}
            
           
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                    {{-- <div class="pagination">{!! $auctions->links() !!}</div> --}}
                </div>
            </div>
        
    </div>
</div><!--/row-->
</div>
@endsection