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
