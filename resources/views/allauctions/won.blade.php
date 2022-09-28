@extends('layouts.app2')
@section('title', __('Auctions'))

@section('content')
<br>
<div class="container">
<div class="row">

        <hr>
        <div class="col-md-12">
            {!! Form::open(['method' => 'GET', 'url' => '/suppliers/won', 'class' => '', 'role' => 'search'])  !!}
                {{-- @lang('globals.filters'): --}}

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4>{{ __('Select what you are looking for')}}</h4>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    @include('auctions.search_form')
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                        <a class="btn btn-warning" href="{{ url('/suppliers/won') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> {{ __('Clear')}}</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            {{-- <label for="to">Hasta</label> --}}
                            {!! Form::select('asc_desc', array('ASC' => __('Date: Ascendant'), 'DESC' => __('Date: Descendant')),null, ['class' => 'form-control', 'placeholder'=>__('Sort by:'), 'onchange'=>'this.form.submit()']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

        {{-- Menu --}}
        <div class="col-md-12">
            <br>
                <div class="btn-group" role="group" aria-label="Basic example">
                   @include('allauctions.menu')
                </div>
            <p></p>

        </div>

    <div class="col-md-12">


        {{-- <div class="row">
            <div class="col-md-12">
                <p>{{ __('Filter by')}}:</p>
                @sortablelink('date', __('Date'), ['class' => '']) |
                @sortablelink('from_location', __('From'), ['class' => '']) |
                @sortablelink('to_location', __('To'), ['class' => ''])
            </div>

        </div> --}}

        {{-- <br>
            <div class="btn-group" role="group" aria-label="Basic example">
               @include('auctions.privatetransfers.menu')
            </div> --}}
        <p></p>

        {{-- @if( session()->has('winning') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('winning') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>
            </div>
        @endif --}}

        {{-- Auctions --}}
        <div id="auctions">
            @if($auctions->count() == 0)
                <hr>
                <h5>{{ __('Here are the auctions that are closed and that you won.') }} </h5>
            @endif
        @foreach($auctions as $item)

            @section('best_bid')
            {{ $bestbid = $bids->where('auction_id', $item->id)->min('bid') }}
            {{ $mybid2 = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->first() }}
            {{ $options = __('Example') . ': ' . __('If you select') . ' ' . '<b>' . '$5' . '</b>' . ' ' . __('and ') . '<b>' . __('Best bid') . ' = $' . $bestbid . '.00'.'</b>' . ', ' . __('your bid will be') . ' ' . '<b>' . '$' . ($bestbid - 5) . '.00' .'</b>' }}
            {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }}
            {{ $starting_bid = $item->starting_bid }}
            {{ $max = $starting_bid - 1 }}
            {{ $min = ($bestbid * 80)/100 }}

            @if ($bids->where('auction_id', $item->id)->count() > 0)
                {{ $max = $starting_bid - 1 }}
                {{ $min = ($bestbid * 80)/100 }}
            @else
                {{ $max = $starting_bid - 1 }}
                {{ $min = ($starting_bid * 80)/100 }}
            @endif

            @endsection

            <div id="auction{{$item->id}}" class="box box-solid box-success">
                    <div class="box-header with-border">
                        <h5 class="box-title">
                            {{-- <a href="{{ url('/auctions/' . $item->id) }}">@lang('globals.from') <strong><span class="text-capitalize">{{ $item->fromcity->name }}</span> - {{ $item->fromlocation['name'] }}</strong> @lang('globals.to') <strong><span class="text-capitalize">{{ $item->tocity->name }}</span> - {{ $item->tolocation['name'] }}</strong></a> --}}
                            {{-- <a href="{{ url('/auctions/' . $item->id) }}">
                            </a> --}}
                            {{__('From')}} <strong><span class="text-capitalize">{{ $item->fromcity->name }}</span></strong> {{__('to')}} <strong><span class="text-capitalize">{{ $item->tocity->name }}</span> </strong>
                        </h5>
                    </div>
                    <div class="box-body">
                        <div class="row d-none d-sm-block">
                            <div class="col-md-12">
                                    @if ($item->category->code == 'private')
                                        @include('allauctions.categories.private')
                                    @elseif ($item->category->code == 'booking')
                                    {{-- id: {{$item->id}} --}}
                                    @elseif ($item->category->code == 'booking_auction')
                                        @include('allauctions.categories.booking_auction')
                                    @endif

                                {{-- <p><a href="{{ url('/auctions/' . $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Click here to see the history of all the bids for this auction.') }}">{{ __('Bid history')}} </a></p> --}}
                            </div><!--/col-->

                        </div> {{-- end row --}}

                        {{-- More details --}}
                        @if ($item->bids->count() > 0 or $item->category->code == 'booking_auction')
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    {{-- <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#moredetails{{$item->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        {{__('More details')}}
                                    </a> --}}
                                    <a class="btn btn-warning" href="{{ url('suppliers/auction/' . $item->id) }}" data-toggle="tooltip" data-placement="top" title="{{__('Click to see more details')}}">
                                        {{__('More details')}}
                                    </a>
                                </p>
                                <div class="collapse" id="moredetails{{$item->id}}">
                                    <div class="card card-body">
                                        @if ($item->category->code == 'booking_auction')
                                            <div>
                                                <p>
                                                    <span>{{__('Arrival Airline')}}: <strong>{{$item->arrival_airline}}</strong></span> |
                                                    <span>{{__('Flight Number')}}: <strong>{{$item->arrival_airline}}</strong></span> |
                                                    
                                                    <span>{{__('Passengers')}}:
                                                        <strong>{{$item->adults}}
                                                            {{__('Adults')}}
                                                            @if ($item->infants or $item->babies)
                                                                , {{$item->infants + $item->babies}} {{__('Children')}}
                                                            @endif
                    
                                                        </strong>
                                                    </span>
                                                </p>
                                                @if ($item->extras->count())
                                                <span>{{__('Extras')}}: </span><br>
                                                    @foreach ($item->extras as $extra)
                                                        {{$extra->quantity}} <strong>{{$extra->name}}</strong><br>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <hr>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- mobile version --}}
                        <div class="row d-block d-sm-none">
                            <div class="col-md 12">
                                @if ($item->category->code == 'private')
                                    <span class=" mr-2 d-block d-sm-none"># {{ $item->service_number }}  <i class="fa fa-calendar text-muted" aria-hidden="true"></i> <strong>{{ date('j-M-Y', strtotime($item->date)) }}</strong>  <i class="fa fa-clock-o text-muted" aria-hidden="true"></i> <strong>{{ date('g:i A', strtotime($item->time)) }}</strong></span>
                                @elseif ($item->category->code == 'contract')
                                    <span class=" mr-2 d-block d-sm-none"># {{ $item->service_number }} <br>
                                    <span class="mr-2">{{__('Start date')}}: <strong>{{ date('l j, F Y', strtotime($item->start_date)) }}</strong> <br> {{__('End date')}}: <strong>{{ date('l j, F Y', strtotime($item->end_date)) }}</strong></span> <br>
                                @endif
                                {{-- @if ($item->category->code == 'private')
                                    <span class=""><i class="fa fa-car text-muted" aria-hidden="true"></i>  <strong class="text-danger">{{ $item->vehicle->name }}</strong></span>
                                @endif --}}
                                @if ($item->passengers)
                                    <span >{{ __('People') }}: <strong class="text-danger">{{ $item->passengers }}</strong></span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                @if ($item->category->code == 'private')
                                    @if ($bids->where('auction_id', $item->id)->count() > 0)
                                        <span>{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
                                    @else
                                        <span>{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
                                    @endif
                                @endif

                                @if ($item->category->code == 'contract' and $item->bids->count() > 0)
                                    <span>{{ __('Current Bid') }}: <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($item->bids->min('bid'), 2, '.', ',') }}</strong></span></span>
                                @endif

                                @if ($item->category->code == 'private' and $item->category->code == 'contract')
                                    @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count())
                                        <span>{{ __('My bid') }} : <span class=""><strong>{{ $item->country->currency_symbol }}{{ number_format($mybid, 2, '.', ',') }} </strong></span> </span>
                                    @endif
                                @endif

                            </div>
                        </div>

                        
                    </div> {{-- end box-body --}}

            </div> {{-- end box --}}

            @endforeach
        </div>{{-- End #auctions --}}

            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                    <div class="pagination">{!! $auctions->appends(['service_number' => Request::get('service_number'), 'from_city' => Request::get('from_city'), 'to_city' => Request::get('to_city'), 'date' => Request::get('date'), 'asc_desc' => Request::get('asc_desc')])->render() !!}</div>
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

<script>
// $(document).ready(function(){
//    var options="";
//    var numberOfItemsNeeded=5;
//    for(var i=8;i<=numberOfItemsNeeded;i++)
//    {
//      options+="<label class='btn btn-light'><input type='radio' name='options' id='option1' autocomplete='off' value='"+i+"' required>"$+i+"</label>";

//    }
//    $("#min-bids").html(options);

// });
// $(function(){
//    var options="";
//    var numberOfItemsNeeded=$("#passengers").val();
//    for(var i=1;i<=numberOfItemsNeeded;i++)
//    {
//      options+="<option value='"+i+"'>"+i+"</option>";
//    }
//    $("#cupcake-amt").html(options);
//    console.log(numberOfItemsNeeded);

// });
</script>

{{-- Besbid and bidcount json --}}
{{-- <script>
	$(document).ready(function(){

        var from_city = $(this).val();
        if(from_city){
            // console.log(from_city);
            $.ajax({
                url: '/from_locations/'+from_city,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    $('#from_location').empty();
                    $('#from_location').append('<option value="" disable="true" selected="true">Select Location</option>');

                    $.each(data, function(index, from_locationObj){
                        $('#from_location').append('<option value="'+ from_locationObj.id +'">' + from_locationObj.name + '</option>');
                    })
                    $("#bestbid"+element_id).html(data);
                }
            });
        }
	});
</script> --}}

<script>
    // var $loading = $('#auctions').hide();
    // $(document)
    // .ajaxStart(function () {
    //     $loading.show();
    // })
    // .ajaxStop(function () {
    //     $loading.hide();
    // });
</script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

@endsection
