@extends('layouts.app2')
@section('title', trans('globals.auctions'))

@section('content')
<br>
<div class="container">
<div class="row">
    <div class="col-md-12 text-center">
        <h4>{{ __('Select Category') }} </h4>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('auctions.transfers') }}" class="btn {{ request()->is('transfers') ? 'btn-primary' : 'btn-light' }}">{{ __('Private Transfers') }}</a>
            <a href="{{ route('auctions.sharedshuttles') }}" class="btn {{ request()->is('auctions/sharedshuttles/*') ? 'btn-primary' : 'btn-light' }}">{{ __('Shared Shuttles') }}</a>
        </div>
    </div>
    <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['method' => 'GET', 'url' => '/auctions/sharedshuttles/bidded', 'class' => '', 'role' => 'search'])  !!}
                        @lang('globals.filters'):
                        
                        <div class="row">
                            @include('auctions.search_form')
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                                <a class="btn btn-warning" href="{{ url('/auctions/sharedshuttles/bidded') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i></a>
                            </div>
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
        
        <br> 
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('auctions.sharedshuttles') }}" class="btn {{ request()->is('auctions/sharedshuttles/index') ? 'btn-primary' : 'btn-light' }}">{{ __('All') }}</a>
                <a href="{{ route('auctions.sharednobidded') }}" class="btn {{ request()->is('auctions/sharedshuttles/nobidded') ? 'btn-primary' : 'btn-light' }}">{{ __('No bid by me') }}</a>
                <a href="{{ route('auctions.sharedbidded') }}" class="btn {{ request()->is('auctions/sharedshuttles/bidded') ? 'btn-primary' : 'btn-light' }}">{{ __('Bid by me') }}</a>
                <a href="{{ route('auctions.sharedaccepted') }}" class="btn {{ request()->is('auctions/sharedshuttles/accepted') ? 'btn-primary' : 'btn-light' }}">{{ __('Accepted bids') }}</a>
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
    
            <div id="auction{{$item->id}}" class="box box-solid box-default">
                    <div class="box-header with-border">
                        <h5 class="box-title"><a href="{{ url('/auctions/' . $item->id) }}">@lang('globals.from') <strong>{{ $item->fromlocation['name'] }}</strong> @lang('globals.to') <strong>{{ $item->tolocation['name'] }}</strong></a></h5>
                        {{-- <div class="box-tools pull-right">
                            <a href="{{ url('/transfers/' . $item->id) }}" class="btn btn-outline-primary btn-sm">@lang('globals.make_a_bid')</a>
                        </div> --}}
                    </div>
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (Config::get('app.locale') == 'en')	
                                <h5><span class="badge badge-success">{{ $item->category['name'] }}</span></h5>
                            @else
                                <h5><span class="badge badge-success">{{ $item->category['es_name'] }}</span></h5>
                            @endif

                            <p><strong>{{ __('Starting bid') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">$ {{ number_format($item->starting_bid, 2, '.', ',') }}</span> | 
                                <strong>{{ __('Seats available') }}:</strong> 
                                <span class="text-success">{{ $item->passengers }}</span>
                                |
                                <strong>{{ __('Original') }}:</strong> 
                                <span class="text-success ">{{ $item->shared_seats }}</span>
                            </p>
                            
                            <p> 
                                <strong>{{__('Date')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('l, F j - Y', strtotime($item->date)) }}</span> | <strong> {{ __('Boarding Time')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($item->from_time)) }}</span> <strong> {{ __('Departue Time')}}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i A', strtotime($item->to_time)) }}</span>  
                            </p>
                            @if (Auth::user()->hasRole('admin') && $item->user->name == 'Dominican Shuttles')
                            <p><strong>@lang('globals.created_by')</strong>: {{ $item->user->name }}</p>
                            @endif
                            </p>
                        </div><!--/col-->
                        
                        @if ($item->bids->where('user_id', Auth::user()->id)->count())
                            <div class="col-md-6">
                                {{-- <hr> --}}
                                <h5>{{ __('My bids') }} </h5>
                                <table class="table table-sm">
                                    <thead>
                                        
                                        
                                        <tr>
                                            <th>{{ __('Seats') }} </th>
                                            <th>{{ __('Bid per seat')}}</th>
                                            <th>{{ __('Total') }} </th>
                                            <th>{{ __('Status') }} </th>                                                
                                        </tr>
                                    </thead>      
                                    <tbody>
                                        @foreach ($item->bids as $bid)
                                            @if ($bid->user_id == Auth::user()->id)
                                            <tr>
                                                <td>{{ $bid->seats}}</td>
                                                <td>${{ number_format($bid->bid, 2, '.', ',') }}</td>
                                                <td>${{ number_format($bid->total, 2, '.', ',') }}</td>
                                                <td>
                                                    @if ($bid->won == 1)
                                                        <span class="badge badge-success">{{ __('Accepted') }}</span>
                                                    @else
                                                        <span class="badge badge-warning">{{ __('Pending')}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> {{-- end col-md-12 --}}
                        @endif {{-- endif for count--}}
                        
                    </div> {{-- end row --}}
                </div> {{-- end box-body --}}
                <div class="box-footer">
                    
                    <form method="POST" action="{{ route('bids.storefromtransfers2', $item->id) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group  mr-1">
                                    <div class="btn-group btn-group-toggle" id="min-bids" data-toggle="buttons">
                                        
                                        <?php  
                                        $x = $item->starting_bid;
                                            
                                        while($x <= $item->starting_bid + 4) {
                                            echo "<label class='btn btn-light'>
                                                <input type='radio' name='options' id='option1' autocomplete='off' value='$x' required> $$x
                                            </label>";
                                            $x++;
                                        } 
                                        ?> 
                                    </div>
                                    @if($errors->any())
                                        <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                                    @endif
                                </div>

                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                        <select id="cupcake-amt" name="seats" class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}" >
                                            {{-- <option value="1">1</option> --}}
                                            {{-- @foreach (range(0, $item->passengers) as $i)    
                                                <option value='{{ $i++ }}'>{{ $i}}</option>
                                            @endforeach --}}
                                            @for ($i = 1; $i <= $item->passengers; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    {{-- <input type="number" class="form-control {{ $errors->has('seats') ? 'is-invalid' : '' }}" id="seats" name="seats" value="{{ old('seats') }}" placeholder="{{ __('Seats')}}" aria-describedby="seatsErrors"> --}}
                                    @if($errors->any())
                                        <small id="seatsErrors" class="form-text text-danger">{{ $errors->first('seats') }}</small>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" data-submit-value="Please wait...">
                                    {{ __('Make bid')}}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                    
                    
                </div>
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
@endsection