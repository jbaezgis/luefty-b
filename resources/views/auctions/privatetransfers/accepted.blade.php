@extends('layouts.app2')
@section('title', __('Accepted'))

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
                {!! Form::open(['method' => 'GET', 'url' => '/auctions/privatetransfers/accepted', 'class' => '', 'role' => 'search'])  !!}
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>{{ __('Select what you are looking for')}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        @include('auctions.search_form')
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                            <a class="btn btn-warning" href="{{ url('/auctions/privatetransfers/accepted') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i></a>
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



            <div id="auction{{$item->id}}" class="box box-solid box-success

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

                                {{-- <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}"><strong>{{ __('Best bid') }}</strong>: <span class="text-primary">$ {{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</span></span> | --}}
                                <span data-toggle="tooltip" data-placement="top" title="{{ __('This is your bid that you have made in this auction') }}"><strong>{{ __('My bid') }} </strong>: <span class="text-primary">${{ number_format($mybid, 2, '.', ',') }} </span> </span>{{-- <i class="fa fa-circle {{ $mybid == $bestbid ? 'text-success' : 'text-danger'}} " aria-hidden="true"></i> --}}
                                <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{ __('You won this auction.') }}">{{ __('You won')}}</span>


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
                            <p><a href="{{ url('/mybids/showauction/' . $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Click to see more details.') }}">{{ __('More details')}} </a></p>
                        </div><!--/col-->
                    </div> {{-- end row --}}
                </div> {{-- end box-body --}}
                {{-- <div class="box-footer">

                </div> --}}
            </div> {{-- end box --}}

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
