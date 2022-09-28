@extends('layouts.admin.admin')
@section('title', __('Manage Auctions'))

@section('content')
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Transfers list')}}</h2>
        </div>
    </div>
    <hr>
        {!! Form::open(['method' => 'GET', 'url' => 'administration/transfers/list', 'class' => '', 'role' => 'search'])  !!}
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=>__('--From location--'), 'class'=>'form-control select2' ]) !!}
                        <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=>__('--To location--'), 'class'=>'form-control select2' ]) !!}
                        <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit" title="{{ __('Search')}}"><i class="fa fa-search"></i></button>
                    <a class="btn btn-warning" href="{{ url('administration/transfers/list') }}" title="{{ __('Clear filters')}}" data-togle> <i class="fa fa-refresh" aria-hidden="true"></i> {{ __('Clear')}}</a>
                </div>
            </div>
        {!! Form::close() !!}
    <hr>
    {{-- auctions --}}
    <div class="row">
        <div class="col-md-12">
            <table id="transferslist" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('URL')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->fromLocation->name}}</td>
                            <td>{{$item->toLocation->name}}</td>
                            <td>
                               {{-- <span id="url">{{ url('transfer/from='. $item->fromLocation['slug'] .'-to='. $item->toLocation['slug'] ) }}</span> --}}
                               <span id="url">{{ url('transfer/'. $item->fromLocation['slug'] .'/'. $item->toLocation['slug'] ) }}</span>
            
                            </td>
                            <td>
                                @if($item->fromLocation['slug'] and $item->toLocation['slug'])
                                <button class="btn btn-primary btn-sm" onclick="copyToClipboard('#url')">{{__('Copy URL')}}</button>
                                {{-- <a class="btn btn-secondary btn-sm" href="{{ url('transfer/from='. $item->fromLocation['slug']  .'-to='. $item->toLocation['slug'] ) }}" target="_blank">{{__('Open')}} </a> --}}
                                <a class="btn btn-secondary btn-sm" href="{{ url('transfer/'. $item->fromLocation['slug']  .'/'. $item->toLocation['slug'] ) }}" target="_blank">{{__('Open')}} </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('From')}}</th>
                        <th>{{__('To')}}</th>
                        <th>{{__('URL')}}</th>
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
