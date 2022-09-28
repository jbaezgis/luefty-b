@extends('layouts.app2')
@section('title', trans('bids.my_bids'))

@section('content')
{{-- <div class="container-title">
        <h2 class="page-title bg-primary"><i class="fa fa-money"></i> {{ trans('bids.my_bids') }} </h2>
</div> --}}
<br>
<div class="container-fluid">
{{-- <div class="row pl-3"> --}}
    {{-- <div class="col-md-12 d-none d-sm-block">
        <div class="btn-group" role="group" aria-label="Basic example">
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
        </div>
       {!! Form::open(['method' => 'GET', 'url' => '/mybids', 'class' => 'form-inline my-2 my-lg-0', 'role' => 'search'])  !!}
        
        &nbsp | &nbsp
            <div class="input-group">
                <input type="text" class="form-control" name="from" placeholder="Search...">
                <input type="text" class="form-control" name="status" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    
                </span>
                
            </div>
            &nbsp<a href="{{ url('/mybids') }}" class="btn btn-secondary"> Clear</a>
        {!! Form::close() !!}

    </div> --}}
    {{-- <div class="col-md-12 d-block d-sm-none">
        <div class="d-flex flex-row">            
            <div class="mr-2">
                <div class="dropdown">
                    <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('globals.filters')
                    </a>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/mybids') }}"><i class="fa fa-list text-primary" aria-hidden="true"></i> @lang('globals.see_all_bids')</a>
                        <a class="dropdown-item" href="{{ url('/mybids-won') }}"><i class="fa fa-check text-success" aria-hidden="true"></i> @lang('globals.winning_bids')</a>
                        <a class="dropdown-item" href="{{ url('/mybids-lost') }}"><i class="fa fa-times text-danger" aria-hidden="true"></i> @lang('globals.lost_bids')</a>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>
<hr> --}}

<div class="row">
    <div class="col-md-12">

        
    </div>
</div>
<br>
<div class="row">
<div class="col-md-12 d-none d-sm-block">
        <div class="box box-solid">
            
            <div class="box-body">
            
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@sortablelink('auction.from', trans('globals.from')) | @sortablelink('auction.to', trans('globals.to'))</th>
                                <th>@sortablelink('day_time', trans('globals.date'))</th>
                                <th>@lang('globals.my_bid')</th>
                                {{-- <th>@lang('globals.status')</th>
                                <th>@lang('globals.win')</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            @if ($bid->auction['deleted'] == 0)
                            <tr class="@if ($bid->won === 1) table-success @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed') table-danger @else @endif">
                                <td>
                                    @lang('globals.from') <strong>{{ $bid->auction['from'] }}</strong> @lang('globals.to') <strong>{{ $bid->auction['to'] }}</strong> 
                                </td>
                                <td>{{ date('F j, Y, g:i a', strtotime($bid->auction['day_time'])) }}</td>
                                <td>$ {{ number_format($bid->bid, 2, '.', ',') }}</td>
                                {{-- <td>
                                    @if ($bid->auction['status'] === 'Closed')
                                        <span class="badge badge-pill badge-success">@lang('globals.closed')</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">@lang('globals.open')</span>
                                    @endif

                                </td>
                                <td>
                                    @if ($bid->auction['status'] == 'Closed' )
                                        @if ($bid->won === 1)
                                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                                        @else
                                        <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                        @endif
                                    @endif
                                </td> --}}
                                <td>
                                    {{-- @if ($bid->auction_id) --}}
                                    <a href="{{ url('/mybids/showauction/' . $bid->auction_id) }}" title="View Auction"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> @lang('globals.see')</button></a> 
                                    {{-- @else  --}}
                                    {{-- <a href="{{ url('/my-tours/' . $bid->tour_id) }}" title="View User"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver tour</button></a>  --}}
                                    {{-- @endif --}}
                                </td>
                            </tr>
                            @else
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="pagination"> {!! $bids->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                </div>

            </div>
        </div>
    </div>
</div>
{{-- end row for table --}}

<div class="row d-block d-sm-none">

    @foreach($bids as $bid)
    @if ($bid->auction['deleted'] == 0)
    <div class="col-md-12">
            <div class="box @if ($bid->won === 1) box-success @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed') box-danger @else box-solid @endif">
                {{-- <div class="box-header"><h3 class="box-title">{{ $item->from }} a {{ $item->to }}</h3></div> --}}
                <div class="box-body">
                    <p>@lang('globals.from') <strong>{{ $bid->auction['from'] }}</strong> @lang('globals.to') <strong>{{ $bid->auction['to'] }}</strong> </p>
                    <p><i class="fa fa-calendar-o"></i> {{ date('F j, Y, g:i a', strtotime($bid->auction['day_time'])) }}</p>
                    <p><strong>@lang('globals.my_bid'):</strong> $ {{ number_format($bid->bid, 2, '.', ',') }} | 
                        {{-- <strong>@lang('globals.status'):</strong>  
                        @if ($bid->auction['status'] === 'Closed')
                            <span class="badge badge-pill badge-success">@lang('globals.closed')</span>
                        @else
                            <span class="badge badge-pill badge-warning">@lang('globals.open')</span>
                        @endif --}}
                    </p>
                        {{-- <p>
                        <strong>@lang('globals.win'):</strong> 
                        @if ($bid->auction['status'] == 'Closed' )
                            @if ($bid->won === 1)
                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            @endif
                        @endif </p> --}}
                    
                        <a href="{{ url('/mybids/showauction/' . $bid->auction_id) }}" title="View Auction"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> @lang('globals.see')</button></a> 
                </div>
            </div>
        <br>
    </div><!--/col-->
    @endif
    @endforeach
</div>
</div>
{{-- en row for mobile view --}}
</div>
@endsection