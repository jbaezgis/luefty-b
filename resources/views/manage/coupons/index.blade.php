@extends('layouts.admin.admin')
@section('title', __('Manage Auctions'))

@section('content')
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Coupons')}}</h2>
        </div>
    </div>
    
    {{-- auctions --}}
    <div class="row">
        <div class="col-md-12">
            
            <div class="d-flex flex-row mb-3">
                <div class="pl-0 pr-2 py-2">
                    <h5>{{__('Create new')}}: </h5>
                </div>
                <div class="pl-0 pr-2 py-2">
                    {!! Form::open(['method' => 'POST', 'url' => ['coupons/store']]) !!}
                    {{-- {!! Form::open(['method' => 'POST', 'url' => ['coupons/coupon']]) !!} --}}
                        {{-- hidden fields --}}
                        {{-- {{ Form::hidden('auction_id', $auction->id) }} --}}
                        {{ Form::hidden('discount', 5) }}
        
                        {!! Form::button(number_format(5, 2, '.', ','), array(
                                'type' => 'submit',
                                'class' => 'btn btn-secondary font-weight-bolder',
                                'title' => '5.00'
                        )) !!}
                        
                    {!! Form::close() !!}
                </div>
                <div class="p-2">
                    {!! Form::open(['method' => 'POST', 'url' => ['coupons/store']]) !!}
                        {{-- hidden fields --}}
                        {{ Form::hidden('discount', 10) }}
        
                        {!! Form::button(number_format(10, 2, '.', ','), array(
                                'type' => 'submit',
                                'class' => 'btn btn-secondary font-weight-bolder',
                                'title' => '10.00'
                        )) !!}
                        
                    {!! Form::close() !!}
                </div>
                <div class="p-2">
                    {!! Form::open(['method' => 'POST', 'url' => ['coupons/store']]) !!}
                        {{-- hidden fields --}}
                        {{-- {{ Form::hidden('auction_id', $auction->id) }} --}}
                        {{ Form::hidden('discount', 15) }}
        
                        {!! Form::button(number_format(15, 2, '.', ','), array(
                                'type' => 'submit',
                                'class' => 'btn btn-secondary font-weight-bolder',
                                'title' => '15.00'
                        )) !!}
                        
                    {!! Form::close() !!}
                </div>
            </div>
            <table id="transferslist" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>{{__('Coupon')}}</th>
                        <th>{{__('Discount')}}</th>
                        <th>{{__('Booking ID')}}</th>
                        <th>{{__('Status')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $item)
                        <tr>
                            <td><span id="code">{{$item->code}}</span> <button class="btn btn-primary btn-sm" onclick="copyToClipboard('#code')">{{__('Copy')}}</button></td>
                            <td>{{ number_format($item->discount, 2, '.', ',')}}</td>
                            <td>
                                {{-- <a href="{{ url('manageauctions/show/'. $item->auction['id']) }}" target="_blank">{{$item->auction['auction_id']}}</a> --}}
                            </td>
                            <td>{{$item->status}}</td>
                            <td>
                                @if($item->status == 'Active')
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['coupons', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Tour',
                                                'onclick'=>'return confirm("Are you sure you want to delete this Coupon?")'
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
    $('#transferslist').DataTable({
        "order": [],
        "columnDefs": [
            { "orderable": false, "targets": [] },
        ]
    });
} );
</script>
<script>
    function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
    }
</script>
@endsection
