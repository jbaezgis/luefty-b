@extends('layouts.admin.admin')
@section('title', __('Manage Auctions'))

@section('content')
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Tourist Auctions')}}</h2>
        </div>
    </div>
    {{-- auctions --}}
    <div class="row">
        <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>{{__('Booking ID')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Starting bid')}}</th>
                        <th>{{__('Bids')}}</th>
                        <th>{{__('Status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auctions as $item)
                        <tr>
                            <td>{{$item->service_number ? $item->service_number : $item->auction_id }}</td>
                            <td>{{$item->fromcity['name']}}</td>
                            <td>{{$item->tocity['name']}}</td>
                            <td>{{$item->type == 'oneway' ? 'One way' : 'Round-Trip'}}</td>
                            <td>{{ date('j-M-Y', strtotime($item->date)) }}, {{ date('g:ia', strtotime($item->time)) }}</td>
                            <td>{{$item->country->currency_symbol}}{{ number_format($item->starting_bid, 2, '.', ',') }}</td>
                            <td>{{$item->bids->count()}}</td>
                            <td>
                                @if ($item->changed === 1 & $item->status === 'Closed')
                                    <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                @elseif ($item->changed === 1)
                                    <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is Changed because you updated its info') }}" data-placement="top">{{ __('Changed')}} </span>
                                @else
                                    @if ($item->status == 'Closed')
                                        <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                    @else
                                        @if ($item->bids->count() > 0)
                                            <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ __('This Auction is Open because has one bid or more.') }}" data-placement="top">{{ __('Open') }}</span>
                                        @else
                                            <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is do not have bids.') }}" data-placement="top">{{ __('No bid yet') }}</span>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($item->category_id == 8)
                                <a class="btn btn-light btn-sm" href="{{ url('/manageauctions/show/' . $item->id) }}" title="{{__('Open Auction')}}"><i class="fa fa-eye" aria-hidden="true"></i> {{__('Open')}}</a>
                                @endif
                                {{-- <a class="btn btn-light btn-sm" href="{{ url('auctions/' . $item->id . '/edit') }}" title="{{__('Edit Auction')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</a> --}}
                                @if (auth()->user()->isAdmin == true)
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/auctions', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . __('Delete'), array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-light btn-sm text-danger',
                                                'title' => 'Delete Auction',
                                                'onclick'=>'return confirm("Are you sure you want to delete this auction?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>{{__('Booking ID')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Starting bid')}}</th>
                        <th>{{__('Bids')}}</th>
                        <th>{{__('Status')}}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="col-md-12">
            @foreach($auctions as $item)
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex flex-row mb-1">
                            <div class="pr-2">
                                @if ($item->changed === 1 & $item->status === 'Closed')
                                    <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                @elseif ($item->changed === 1)
                                    <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is Changed because you updated its info') }}" data-placement="top">{{ __('Changed')}} </span>
                                @else
                                    @if ($item->status == 'Closed')
                                        <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
                                    @else
                                        @if ($item->bids->count() > 0)
                                            <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ __('This Auction is Open because has one bid or more.') }}" data-placement="top">{{ __('Open') }}</span>
                                        @else
                                            <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is do not have bids.') }}" data-placement="top">{{ __('No bid yet') }}</span>
                                        @endif
                                    @endif
                                @endif
                            </div>
                            
                            <div class="px-1">
                                <small class="text-muted">{{__('ID')}}: <span class="text-primary">{{$item->id}}</span></small>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Type')}}: <span class="text-primary">{{$item->type == 'oneway' ? 'One way' : 'Round-Trip'}}</span></small><br>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Booking ID')}}: <span class="text-primary">{{$item->service_number ? $item->service_number : $item->auction_id }}</span></small><br>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">
                                    {{__('Category')}}: 
                                    <span class="text-primary">
                                        @if ($item->category->code == 'private')
                                            {{_('Agency Auction')}}
                                        @elseif ($item->category->code == 'booking_auction')
                                            {{_('Tourist Auction')}}
                                        @endif
                                    </span>
                                </small>
                            </div>
                        </div>

                        <div class="d-flex flex-row">
                            <div class="pr-1">
                                {{-- <small class="text-muted">{{__('From')}}</small><br> --}}
                                <span>{{$item->fromcity['name']}}</span>
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </div>
                            <div class="">
                                {{-- <small class="text-muted">{{__('To')}}</small><br> --}}
                                <span>{{$item->tocity['name']}}</span>
                            </div>
                        </div>

                        <div class="d-flex flex-row">
                            @if ($item->user_id)
                                <div class="pr-3">
                                    <small class="text-muted">{{__('Created by')}}: <span class="text-primary">{{$item->user->name}} ({{ $item->created_at->diffForHumans() }})</span></small>
                                </div>
                            @endif
                            <div class="pr-3">
                                <small class="text-muted">{{__('Date')}}: <span class="text-primary">{{ date('j-M-Y', strtotime($item->date)) }}  - {{ date('g:i A', strtotime($item->time)) }}</span></small>
                            </div>
                            <div class="pr-3">
                                <small class="text-muted">{{__('Starting bid')}}: <span class="text-primary">${{ number_format($item->starting_bid, 2, '.', ',') }}</span></small>
                            </div>
                            @if ($item->bids->count())
                                <div class="pr-3">
                                    <small class="text-muted">{{__('Bids')}}: <span class="text-primary">{{$item->bids->count()}}</span></small>
                                </div>
                            @endif
                        </div>

                        @if ($item->category->code == 'booking_auction')
                        <hr>
                        <strong>{{__('Booking Details')}}</strong><br>
                        <div class="d-flex flex-row">
                            <div class="pr-3">
                                <small class="text-muted">{{__('Name')}}: <span class="text-primary">{{$item->full_name}}</span></small>
                            </div>
                            <div class="pr-3">
                                <small class="text-muted">{{__('Email')}}: <span class="text-primary">{{$item->email}}</span></small>
                            </div>
                            <div class="pr-3">
                                <small class="text-muted">{{__('Phone')}}: <span class="text-primary">{{$item->phone}}</span></small>
                            </div>
                        </div>
                        @endif
                        @if($item->category_id == 8)
                        <hr>
                        <span><strong>URL:</strong> {{url('booking/mybooking/'.$item->auction_id)}}</span>
                        @endif
                    </div>
                    <div class="card-footer p-1">
                        @if($item->category_id == 8)
                            <a class="btn btn-light btn-sm" href="{{ url('/manageauctions/show/' . $item->id) }}" title="{{__('Open Auction')}}"><i class="fa fa-eye" aria-hidden="true"></i> {{__('Open')}}</a>
                        @endif
                        {{-- <a class="btn btn-light btn-sm" href="{{ url('auctions/' . $item->id . '/edit') }}" title="{{__('Edit Auction')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</a> --}}
                        @if (auth()->user()->isAdmin == true)
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/auctions', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . __('Delete'), array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-light btn-sm text-danger',
                                        'title' => 'Delete Auction',
                                        'onclick'=>'return confirm("Are you sure you want to delete this auction?")'
                                )) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="pagination"> {!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var myCollapse = document.getElementById('multiCollapseExample1')
    var bsCollapse = new bootstrap.Collapse(myCollapse, {
    toggle: false
    })
</script>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection
