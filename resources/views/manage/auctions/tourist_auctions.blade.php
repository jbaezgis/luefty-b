@extends('layouts.admin.admin')
@section('title', __('Manage Auctions'))

@section('content')
<div class="container-fluid">
    <br>
    @include('manage.auctions.select_categories')
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Tourist Auctions')}}</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-9">
            <span>{{__('All')}}: <strong>{{$auctions->count()}}</strong></span> |
            <span>{{__('No bid yet')}}: <strong>{{$auctions_nobidyet}}</strong></span> |
            <span>{{__('Open with bids')}}: <strong>{{$auctions_openbid}}</strong></span> |
            <span>{{__('Closed')}}: <strong>{{$auctions_accepted}}</strong></span> 
        </div>
        <div class="col-md-3">
            {!! Form::open(['method' => 'GET', 'url' => '/administration/auctions-tourist', 'class' => '', 'role' => 'search'])  !!}
                {{-- @lang('globals.filters'): --}}
                <div class="form-group">
                    {{-- <label for="to">Hasta</label> --}}
                    {!! Form::select('asc_desc', array('ASC' => __('Booking Date: Ascendant'), 'DESC' => __('Booking Date: Descendant')),null, ['class' => 'form-control', 'placeholder'=>__('Sort by:'), 'onchange'=>'this.form.submit()']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    {{-- auctions --}}
    <div class="row">
        <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>{{__('Booking ID')}}</th>
                        <th>{{__('Country')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('Type')}}</th>
                        {{-- <th>{{__('Created at')}}</th> --}}
                        <th>{{__('Booking Date')}}</th>
                        <th>{{__('Starting bid')}}</th>
                        <th>{{__('Bids')}}</th>
                        <th>{{__('Status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auctions as $item)
                        <tr class="{{$item->checked_by ? 'table-success' : ''}}">
                            <td>
                                {{-- @if ($item->checked_by)
                                    <span><i class="fa fa-check-circle text-success" aria-hidden="true"></i></span>
                                @endif --}}
                                <span>{{$item->service_number ? $item->service_number : $item->auction_id }}</span>
                            </td>
                            <td>{{$item->country_id}}</td>
                            <td>{{$item->from_city}}</td>
                            <td>{{$item->to_citt}}</td>
                            <td>{{$item->type == 'oneway' ? 'One way' : 'Round-Trip'}}</td>
                            {{-- <td>{{ date('j-M-Y', strtotime($item->created_at)) }}</td> --}}
                            <td>{{$item->date}}, {{ date('g:ia', strtotime($item->arrival_time)) }}</td>
                            <td></td>
                            {{-- <td>{{$item->country['currency_symbol']}}{{ number_format($item->starting_bid, 2, '.', ',') }}</td> --}}
                            <td>{{$item->bids->count()}}</td>
                            <td>
                                {{-- @if ($item->changed === 1 & $item->status === 'Closed')
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
                                @endif --}}

                                {{-- @if($item->paid_date)
                                <span class="text-success">{{__('Paid')}}</span> <span class=""><i class="fa fa-cc-stripe fa-lg stripe" aria-hidden="true"></i>  </span>
                                @else
                                    <span class="badge badge-warning"> {{__('Open')}}</span>
                                @endif --}}

                                @if($item->payment_method == 'Stripe')
                                    <span class=""><i class="fa fa-cc-stripe fa-2x stripe" aria-hidden="true"></i> </span>
                                @else
                                    <span class="badge badge-warning"> {{__('Open')}}</span>
                                @endif

                            </td>
                            <td>
                                @if($item->category_id == 8)
                                <a class="btn btn-secondary btn-sm" href="{{ url('/manageauctions/show/' . $item->id) }}" title="{{__('Open Auction')}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                @endif
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
$(document).ready(function() {
    $('#example').DataTable({
        "order": [],
        "columnDefs": [
            { "orderable": false, "targets": [0] },
            { "orderable": false, "targets": 4 },
            // { "orderable": false, "targets": 5 },
            { "orderable": false, "targets": 6 },
            { "orderable": false, "targets": 7 },
            { "orderable": false, "targets": 8 }
        ]
    });
} );
</script>

@endsection
