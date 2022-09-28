@extends('layouts.admin.admin')
@section('title', __('Manage Auctions'))

@section('content')
<div class="container-fluid">
    <br>
    @include('manage.auctions.select_categories')
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Agencies Auctions')}}</h2>
        </div>
    </div>
    <hr>
    <span>{{__('All')}}: <strong>{{$auctions->count()}}</strong></span> |
    <span>{{__('No bid yet')}}: <strong>{{$auctions_nobidyet}}</strong></span> |
    <span>{{__('Open with bids')}}: <strong>{{$auctions_openbid}}</strong></span> |
    <span>{{__('Closed')}}: <strong>{{$auctions_accepted}}</strong></span> 
    <hr>
    {{-- auctions --}}
    <div class="row">
        <div class="col-md-12">
            <table id="agencies" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>{{__('Booking ID')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
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
                            <td>{{ date('Y-m-d', strtotime($item->date)) }}, {{ date('g:ia', strtotime($item->time)) }}</td>
                            <td>{{$item->country['currency_symbol']}}{{ number_format($item->starting_bid, 2, '.', ',') }}</td>
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
                                <a class="btn btn-secondary btn-sm" href="{{ url('/manageauctions/agency-auction/' . $item->id) }}" title="{{__('Open Auction')}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                {{-- <a class="btn btn-light btn-sm" href="{{ url('auctions/' . $item->id . '/edit') }}" title="{{__('Edit Auction')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</a> --}}
                                @if (auth()->user()->isAdmin == true)
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/auctions', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Auction',
                                                'onclick'=>'return confirm("Are you sure you want to delete this auction?")'
                                        )) !!}
                                    {!! Form::close() !!} 
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#agencies').DataTable();
});
</script>
@endsection
