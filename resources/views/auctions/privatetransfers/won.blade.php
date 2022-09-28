@extends('layouts.app2')
@section('title', __('Auctions bid by me'))

@section('content')
<br>
<div class="container">
<div class="row">
    @if (App\Module::where('name', 'Shared Shuttles')->active()->first())
        <div class="col-md-12 text-center">
            <h4>{{ __('Select Category') }} </h4>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('auctions.privatetransfers') }}" class="btn {{ request()->is('auctions/privatetransfers/index') ? 'btn-primary' : 'btn-light' }}">{{ __('Private Transfers') }}</a>
                <a href="{{ route('auctions.sharedshuttles') }}" class="btn {{ request()->is('auctions/sharedshuttles/index') ? 'btn-primary' : 'btn-light' }}">{{ __('Shared Shuttles') }}</a>
            </div>
        </div>
    @endif

        <hr>
        <div class="col-md-12">
            {!! Form::open(['method' => 'GET', 'url' => '/auctions/privatetransfers/won', 'class' => '', 'role' => 'search'])  !!}
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
                        <a class="btn btn-warning" href="{{ url('/auctions/privatetransfers/index') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> {{ __('Clear')}}</a>
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

    <div class="col-md-12">


        {{-- <div class="row">
            <div class="col-md-12">
                <p>{{ __('Filter by')}}:</p>
                @sortablelink('date', __('Date'), ['class' => '']) |
                @sortablelink('from_location', __('From'), ['class' => '']) |
                @sortablelink('to_location', __('To'), ['class' => ''])
            </div>

        </div> --}}

        <br>
            <div class="btn-group" role="group" aria-label="Basic example">
               @include('auctions.privatetransfers.menu')
            </div>
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
            {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }}
            {{ $options = __('Example') . ': ' . __('If you select') . ' ' . '<b>' . '$5' . '</b>' . ' ' . __('and ') . '<b>' . __('Best bid') . ' = $' . $bestbid . '.00'.'</b>' . ', ' . __('your bid will be') . ' ' . '<b>' . '$' . ($bestbid - 5) . '.00' .'</b>' }}
            {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }}
            {{$starting_bid = $item->starting_bid}}

            @if ($bids->where('auction_id', $item->id)->count() > 0)
                @if ($bestbid >= 1 &&  $bestbid <= 49)
                    {{ $max = ($bestbid * 95)/100 }}
                    {{ $min = ($bestbid * 30)/100 }}
                @elseif ($bestbid >= 50 &&  $bestbid <= 99)
                    {{ $max = ($bestbid * 97)/100 }}
                    {{ $min = ($bestbid * 30)/100 }}
                @elseif ($bestbid >= 100 &&  $bestbid <= 199)
                    {{ $max = ($bestbid * 97.5)/100 }}
                    {{ $min = ($bestbid * 30)/100 }}
                @elseif ($bestbid >= 200 &&  $bestbid <= 299)
                    {{ $max = ($bestbid * 97.75)/100 }}
                    {{ $min = ($bestbid * 30)/100 }}
                @elseif ($bestbid >= 300)
                    {{ $max = ($bestbid * 98)/100 }}
                    {{ $min = ($bestbid * 30)/100 }}
                @endif
            @else
                @if ($starting_bid >= 1 &&  $starting_bid <= 49)
                    {{ $max = ($starting_bid * 95)/100 }}
                    {{ $min = ($starting_bid * 30)/100 }}
                @elseif ($starting_bid >= 50 &&  $starting_bid <= 99)
                    {{ $max = ($starting_bid * 97)/100 }}
                    {{ $min = ($starting_bid * 30)/100 }}
                @elseif ($starting_bid >= 100 &&  $starting_bid <= 199)
                    {{ $max = ($starting_bid * 97.5)/100 }}
                    {{ $min = ($starting_bid * 30)/100 }}
                @elseif ($starting_bid >= 200 &&  $starting_bid <= 299)
                    {{ $max = ($starting_bid * 97.75)/100 }}
                    {{ $min = ($starting_bid * 30)/100 }}
                @elseif ($starting_bid >= 300)
                    {{ $max = ($starting_bid * 98)/100 }}
                    {{ $min = ($starting_bid * 30)/100 }}
                @endif
            @endif

            @endsection

            <div id="auction{{$item->id}}" class="box box-solid box-success">
                    <div class="box-header with-border">
                        <h5 class="box-title">
                            {{-- <a href="{{ url('/auctions/' . $item->id) }}">@lang('globals.from') <strong><span class="text-capitalize">{{ $item->fromcity->name }}</span> - {{ $item->fromlocation['name'] }}</strong> @lang('globals.to') <strong><span class="text-capitalize">{{ $item->tocity->name }}</span> - {{ $item->tolocation['name'] }}</strong></a> --}}
                            {{-- <a href="{{ url('/auctions/' . $item->id) }}">
                            </a> --}}
                            {{__('From')}} <strong><span class="text-capitalize">{{ $item->fromcity->name }}</span></strong> {{(__('to'))}} <strong><span class="text-capitalize">{{ $item->tocity->name }}</span> </strong>
                        </h5>
                    </div>
                    <div class="box-body">
                        <div class="row d-none d-sm-block">
                            <div class="col-md-12">
                                <p class="lead">{{__('Category')}}: <strong class="text-primary">{{__($item->category->name)}} </strong> </p>
                                <p>
                                    <span class=""># {{ $item->service_number }}</span> |
                                    <span class=" mr-2"><strong>{{ date('l j, F Y', strtotime($item->date)) }}, {{ date('g:i A', strtotime($item->time)) }}</strong></span>
                                    |

                                    {{-- <strong>{{ __('Bid')}}s</strong>: <span class="">{{ $bids->where('auction_id', $item->id)->count() }}</span> | --}}
                                    {{-- <strong>{{ __('Details') }}:</strong> --}}
                                    <span class="text-danger"><strong>{{ $item->vehicle->name }}</strong></span>
                                    |
                                    @if ($item->passengers)
                                    {{ __('People') }}: <span class="text-danger"><strong>{{ $item->passengers }}</strong></span> |
                                    @endif

                                    {{-- Current bid --}}
                                    @if ($bids->where('auction_id', $item->id)->count() > 0)
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>$ {{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
                                    @else
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is the best current bid on this auction') }}">{{ __('Current Bid') }}: <span class=""><strong>$ {{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
                                    @endif

                                    @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count())
                                    |
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('This is your bid that you have made in this auction') }}">{{ __('My bid') }}: <span class=""><strong>${{ number_format($mybid, 2, '.', ',') }}</strong></span> </span>{{-- <i class="fa fa-circle {{ $mybid == $bestbid ? 'text-success' : 'text-danger'}} " aria-hidden="true"></i> --}}
                                        {{-- @if ($mybid == $bestbid)
                                        <span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="{{ __('This mean you have made the best bid but it has not been Accepted yet. Keep an eye on this auction so you can bid again if someone else makes a better offer.') }}">{{ __('Winning')}}</span>
                                        @else
                                        <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="{{ __('Text here') }}">{{ __('Losing')}}</span>
                                        @endif --}}
                                    @endif
                                </p>

                                {{-- <p><a href="{{ url('/auctions/' . $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Click here to see the history of all the bids for this auction.') }}">{{ __('Bid history')}} </a></p> --}}
                            </div><!--/col-->

                        </div> {{-- end row --}}

                        {{-- mobile version --}}
                        <div class="row d-block d-sm-none">
                            <div class="col-md 12">
                                <span class=" mr-2 d-block d-sm-none"># {{ $item->service_number }}  <i class="fa fa-calendar text-muted" aria-hidden="true"></i> <strong>{{ date('j-M-Y', strtotime($item->date)) }}</strong>  <i class="fa fa-clock-o text-muted" aria-hidden="true"></i> <strong>{{ date('g:i A', strtotime($item->time)) }}</strong></span>
                                <span class="text-danger"><i class="fa fa-car text-muted" aria-hidden="true"></i> <strong>{{ $item->vehicle->name }}</strong></span>
                                @if ($item->passengers)
                                    <span class="">{{ __('People') }}: <strong class="text-danger">{{ $item->passengers }}</strong></span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                @if ($bids->where('auction_id', $item->id)->count() > 0)
                                    <span>{{ __('Current Bid') }}: <span class=""><strong>${{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</strong></span></span>
                                @else
                                    <span>{{ __('Current Bid') }}: <span class=""><strong>${{ number_format($item->starting_bid, 2, '.', ',') }}</strong></span></span>
                                @endif

                                @if ($bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->count())
                                    <span>{{ __('My bid') }} : <span class=""><strong>${{ number_format($mybid, 2, '.', ',') }} </strong></span> </span>
                                @endif

                            </div>
                        </div>
                    </div> {{-- end box-body --}}

            </div> {{-- end box --}}

            @endforeach
        </div>{{-- End #auctions --}}

            <div class="row d-none d-block d-sm-block d-md-none">
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
