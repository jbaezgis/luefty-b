@extends('layouts.app2')

@section('content')

{{-- <div class="container-title">
        <h2 class="page-title bg-primary"><i class="fa fa-money"></i> {{ trans('bids.my_bids') }} </h2>
</div> --}}
<br>
{{-- <div class="container-fluid">
<div class="row pl-3">
    <div class="col-md-12">
         
        <a href="{{ url('/mybids') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('globals.back')</a>
            

    </div>
</div>
</div>
<hr> --}}

<div class="container">
        <div class="row">
            <div class="col-md-8">
                    <h3>
                            @lang('globals.from') <strong>{{ $auction->fromlocation->name }}</strong> 
                            @lang('globals.to') <strong>{{ $auction->tolocation->name }}</strong>
                        </h3>
    
                        <div class="d-flex flex-row bd-highlight mb-3">
                            <div class="mr-3">
                                @if ($auction->category_id == 1)
                                <h5><span class="badge badge-primary">{{ $auction->category['name'] }}</span></h5>
                                @else
                                <h5><span class="badge badge-success">{{ $auction->category['name'] }}</span></h5>
                                @endif 
                            </div>
                            
                        </div>
                        
                        <p><strong>{{ __('Starting bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $auction->starting_bid}}</span> | 
                            <strong>{{ __('Best bid') }}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $auction->bids->min('bid') }}</span> |
                            <strong>
                                    @if ($auction->category_id === 1) 
                                    {{ __('Passengers') }} 
                                    @else 
                                    {{ __('Seats available') }}
                                    @endif:
                                </strong> 
                                <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">
                                    @if ($auction->category_id === 2) 
                                    {{ $auction->passengers }} / {{ $auction->shared_seats }}
                                    @else
                                    {{ $auction->passengers }}
                                    @endif
                                
                                </span>
                        </p>
                        <p>
                            @if ($auction->category_id == 1)
                                <strong> {{ __('Service')}}</strong>:  <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('F j, Y', strtotime($auction->date)) }}, {{ date('g:i a', strtotime($auction->time)) }}</span>
                            @else
                                <strong>{{__('Date')}}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('F j, Y', strtotime($auction->date)) }}</span> | 
                                <strong> {{ __('Boarding Time')}}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i a', strtotime($auction->from_time)) }}</span> 
                                <strong> {{ __('Departue Time')}}</strong>: <span class="{{ $auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ date('g:i a', strtotime($auction->to_time)) }}</span>    
                            @endif
                        </p>
            </div>
            
        </div>
        <hr>
        <p><i class="fa fa-asterisk text-danger" aria-hidden="true"></i> {{ __('This auctions was changed...')}} </p>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('auctions/' . $auction->id )}} " class="btn btn-primary">{{ __('Go to the Auction to make a bid') }} </a>
            </div>
        </div>
</div>


@endsection