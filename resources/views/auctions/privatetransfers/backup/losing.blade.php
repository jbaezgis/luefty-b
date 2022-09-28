@extends('layouts.app2')
@section('title', __('Losing'))

@section('content')
<br>
<div class="container">
<div class="row">
    @if (App\Module::where('name', 'Shared Shuttles')->active()->first())
    <div class="col-md-12 text-center">
        <h4>{{ __('Select Category') }} </h4>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('auctions.privatetransfers') }}" class="btn {{ request()->is('auctions/privatetransfers/*') ? 'btn-primary' : 'btn-light' }}">{{ __('Private Transfers') }}</a>
            <a href="{{ route('auctions.sharedshuttles') }}" class="btn {{ request()->is('auctions/sharedshuttles/index') ? 'btn-primary' : 'btn-light' }}">{{ __('Shared Shuttles') }}</a>
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <hr>
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['method' => 'GET', 'url' => '/auctions/privatetransfers/losing', 'class' => '', 'role' => 'search'])  !!}
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>{{ __('Select what you are looking for')}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        @include('auctions.search_form')
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                            <a class="btn btn-warning" href="{{ url('/auctions/privatetransfers/losing') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i></a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p>{{ __('Sort Options')}}:</p>
                @sortablelink('date', trans('globals.date'), ['class' => '']) |
                @sortablelink('from_location', trans('globals.from'), ['class' => '']) |
                @sortablelink('to_location', trans('globals.to'), ['class' => ''])

            </div>

        </div>
        <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                @include('auctions.privatetransfers.menu')
            </div>
        <p></p>

        @if( session()->has('winning') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('winning') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @foreach($auctions as $item)

            @section('best_bid')
            {{ $bestbid = $bids->where('auction_id', $item->id)->min('bid') }}
            {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }}
            {{ $options = __('Example') . ': ' . __('If you select') . ' ' . '<b>' . '$5' . '</b>' . ' ' . __('and ') . '<b>' . __('Best bid') . ' = $' . $bestbid . '.00'.'</b>' . ', ' . __('your bid will be') . ' ' . '<b>' . '$' . ($bestbid - 5) . '.00' .'</b>' }}
            @endsection

            @if ($mybid > $bestbid)

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
                    box-warning
                @endif
                {{ Auth::user()->hasRole('admin') && $item->user->name == 'Dominican Shuttles' ? 'box-primary' : '' }}">
                    <div class="box-header with-border">
                        <h5 class="box-title"><a href="{{ url('/auctions/' . $item->id) }}">@lang('globals.from') <strong><span class="text-capitalize">{{ $item->fromcity->name }}</span></strong> @lang('globals.to') <strong><span class="text-capitalize">{{ $item->tocity->name }}</span> </strong></a></h5>
                        {{-- <div class="box-tools pull-right">
                            <a href="{{ url('/transfers/' . $item->id) }}" class="btn btn-outline-primary btn-sm">@lang('globals.make_a_bid')</a>
                        </div> --}}
                    </div>
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span >
                                @if (Config::get('app.locale') == 'en')
                                    <h5><span class="badge badge-secondary" data-toggle="tooltip" data-placement="top" title="{{ __('Auction type') }}">{{ $item->category['name'] }}</span></h5>
                                @else
                                    <h5><span class="badge badge-primary" data-toggle="tooltip" data-placement="top" title="{{ __('Auction type') }}">{{ $item->category['es_name'] }}</span></h5>
                                @endif
                            </span>
                            <p>
                                {{-- <strong>{{ __('Starting bid') }}</strong>: <span class="text-primary">$ {{ number_format($item->starting_bid, 2, '.', ',') }}</span> |  --}}

                                <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}"><strong>{{ __('Best bid') }}</strong>: <span class="text-primary">$ {{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</span></span> |
                                @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count())
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is your bid that you have made in this auction') }}"><strong>{{ __('My bid') }} </strong>: <span class="text-primary">${{ number_format($mybid, 2, '.', ',') }} </span> </span>{{-- <i class="fa fa-circle {{ $mybid == $bestbid ? 'text-success' : 'text-danger'}} " aria-hidden="true"></i> --}}
                                    @if ($mybid == $bestbid)
                                    <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{ __('This mean you have made the best bid but it has not been Accepted yet. Keep an eye on this auction so you can bid again if someone else makes a better offer.') }}">{{ __('Winning')}}</span>
                                    @else
                                    <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ __('Text here') }}">{{ __('Losing')}}</span>
                                    @endif |
                                @endif

                                <strong>{{ __('Bid')}}s</strong>: <span class="text-primary">{{ $bids->where('auction_id', $item->id)->count() }}</span> |
                                @if ($item->passengers)
                                    <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $item->passengers }}</span> |
                                @endif
                                <strong>{{ __('Details') }}:</strong>
                                <span id="passengers" class="text-primary">{{ $item->vehicle->name }}</span>
                            |
                                <strong> {{ __('Service')}}</strong>: <span class="text-primary">{{ date('l j, F Y', strtotime($item->date)) }}, {{ date('g:i A', strtotime($item->time)) }}</span>
                            </p>
                            @if (Auth::user()->hasRole('admin') && $item->user->name == 'Dominican Shuttles')
                                <p><strong>@lang('globals.created_by')</strong>: {{ $item->user->name }}</p>
                            @endif
                            </p>
                            <p><a href="{{ url('/auctions/' . $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Click here to see the history of all the bids for this auction.') }}">{{ __('Bid history')}} </a></p>
                        </div><!--/col-->
                    </div> {{-- end row --}}
                </div> {{-- end box-body --}}
                <div class="box-footer">
                        @if ($mybid)
                        {{-- @if ($mybid == $bestbid)
                          <h5><span class="badge badge-success">{{ __('Winning')}}</span> </h5>
                        @elseif ($mybid > $bestbid) --}}
                            <form method="POST" action="{{ route('bids.storefromtransfers2', $item->id) }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span data-toggle="tooltip" data-placement="top" data-html="true" title="{{ $options }}">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-light">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" value="1" required > $1
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
                                        </span>
                                        </div>
                                        <div class="col">
                                            <button type="submit"
                                                class="btn
                                                @if ($mybid == $bestbid)
                                                btn-success
                                                @elseif ($mybid > $bestbid)
                                                btn-danger
                                                @else
                                                btn-primary
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

                    @else {{-- if for $mybid--}}
                    <form method="POST" action="{{ route('bids.storefromtransfers2', $item->id) }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="input-group  mr-1 w-100">
                                        <div class="input-group-prepend" style="display: block;">
                                        <div class="input-group-text">US$</div>
                                        </div>
                                        <input type="number" step=".01" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>

                                    </div>
                                    {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-light">
                                            <input type="radio" name="options" id="option1" autocomplete="off" value="1" required> $1
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
                                    </div> --}}
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mr-2" data-submit-value="Please wait...">
                                        {{ __('Make your bid')}}
                                    </button>
                                    <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('You have not bid on this auction. Are you sure you do not want to bid on this auction?')}}"> <i class="fa fa-question-circle fa-lg text-muted" aria-hidden="true"></i></a>
                                    {{-- <a href=""><i class="fa fa-question-circle fa-lg text-muted" aria-hidden="true"></i></a> --}}
                                </div>
                            </div>
                    </form>
                    @endif {{-- for mybid --}}
                </div>
            </div> {{-- end box --}}
            @endif {{-- endif for if mybid < bestbid --}}
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                    <div class="pagination">{!! $auctions->links() !!}</div>
                </div>
            </div>

    </div>
</div><!--/row-->
</div>
@endsection

@section('scripts')
<script>
        $(document).ready(function(){

            // $('select[name="from_city"]').on('change', function(){

            //     var from_city = $(this).val();
            //     if(from_city){
            //         // console.log(from_city);
            //         $.ajax({
            //             url: '/from_locations/'+from_city,
            //             type: 'GET',
            //             dataType: 'json',
            //             success: function(data){
            //                 // console.log(data);
            //                 $('#from_location').empty();
            //                 $('#from_location').append('<option value="0" disable="true" selected="true">Select Location</option>');


            //                 $.each(data, function(index, from_locationObj){

            //                     $('#from_location').append('<option value="'+ from_locationObj.id +'">' + from_locationObj.name + '</option>');
            //                 })

            //             }
            //         });
            //     }
            // });

            $('select[name="to_city"]').on('change', function(){

                var to_city = $(this).val();
                if(to_city){
                    // console.log(to_city);
                    $.ajax({
                        url: '/to_locations/'+to_city,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            // console.log(data);
                            $('#to_location').empty();
                            $('#to_location').append('<option value="0" disable="true" selected="true">--Sub location--</option>');

                            $.each(data, function(index, to_locationObj){
                                $('#to_location').append('<option value="'+ to_locationObj.id +'">' + to_locationObj.name + '</option>');
                            })
                        }
                    });
                }
            });

        });
    </script>

<script type="text/javascript">
$(document).ready(function(){
    $('select[name="from_city"]').on('change', function(e){
      console.log(e);
      var from_city = e.target.value;
      $.get('/json-from?from_city=' + from_city,function(data) {
        console.log(data);
        $('#from_location').empty();
        $('#from_location').append('<option value="0" disable="true" selected="true">--Sub location--</option>');

        $.each(data, function(index, from_locationObj){
          $('#from_location').append('<option value="'+ from_locationObj.id +'">'+ from_locationObj.name +'</option>');
        })
      });
    });
});
  </script>
@endsection
