@extends('layouts.app2')
@section('title', __('My Bids'))

@section('content')
<div class="container-title">
        <h1 class="page-title bg-primary">{{ __('My Bids') }} </h1>
</div>
<br>

<div class="container-fluid">
    <div class="box box-solid">
        <div class="box-header with-border">
            <div class="">
                <a href="{{ route('mybids.index') }}" class="btn {{ request()->is('mybids') ? 'btn-secondary' : 'btn-light' }} mr-1"> {{ __('All') }} </a>
                <a href="{{ route('mybids.won') }}" class="btn {{ request()->is('mybids/won/index') ? 'btn-secondary' : 'btn-light' }} mr-1 ">{{ __('Won')}}</a>
                <a href="{{ route('mybids.lost') }}" class="btn {{ request()->is('mybids/lost/index') ? 'btn-secondary' : 'btn-light' }} mr-1">{{ __('Lost') }}</a>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['method' => 'GET', 'url' => 'mybids', 'class' => ' my-2 my-lg-0', 'role' => 'search'])  !!}
                {{-- <hr> --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">

                            {!! Form::select('from', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['placeholder'=> __('From location'), 'id'=>'from', 'class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            {!! Form::select('to', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['placeholder'=> __('To location'), 'id'=>'to', 'class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <button class="btn btn-primary" type="submit">{{--<i class="fa fa-search"></i>--}} {{ __('Select') }} </button>
                        <a href="{{ url('mybids') }}" class="btn btn-warning">{{ __('Clear filters')}} </a>
                    </div>

                </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>

<div class="container-fluid">

{{-- Main Table --}}
    <div class="box box-solid d-none d-sm-block">
        <div class="box-header with-border">
        {{-- <a href="{{ route('myauctions.createprivate') }}" class="btn btn-primary">{{ __('Add new') }}</a> --}}
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="table-responsive">
                        <table id="auctions" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>{{ __('From') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('From location') }}"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                    <th>{{ __('To') }} <span><a href="#" data-toggle="tooltip" title="{{ __('To location') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                    {{-- <th>{{ __('Number') }} <span><a href="#" data-toggle="tooltip" title="{{ __('Your Service Number') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th> --}}
                                    <th>{{ __('Date') }} <span><a href="#" data-toggle="tooltip" title="{{ __('Date of service') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                    <th>{{ __('My bid') }}</th>
                                    <th>{{ __('Status') }} </th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auctions as $item)
                                {{-- @if ($item->from_location) --}}
                                {{-- querys --}}

                                @section('best_bid')
                                    {{ $bestbid = App\Bid::where('auction_id', $item->id)->min('bid') }}
                                    {{ $mybid = $bids2->where('auction_id', $item->id)->min('bid') }}
                                    {{ $bid = $bids2->where('auction_id', $item->id)->first() }}
                                @endsection

                                {{-- end querys --}}
                                    <tr>
                                        <td scope="row">{{ $item->fromcity->name }}</td>
                                        <td>{{ $item->tocity->name }}</td>
                                        {{-- <td>{{ $item->service_number }} </td> --}}
                                        <td>{{ date('F j, Y', strtotime($item->date)) }}, {{ date('g:i a', strtotime($item->time)) }} </td>
                                        {{-- <td>${{ number_format($item->starting_bid, 2, '.', ',') }}</td> --}}
                                        <td>
                                            <span><strong>${{ number_format($mybid, 2, '.', ',') }}</strong></span>
                                            @if ($item->status == 'Open')
                                                @if ($mybid == $bestbid)
                                                    <span class="badge badge-success" data-toggle="tooltip" title="{{ __('You are winning because this is the best bid') }}" data-placement="top">{{ __('Winning')}} </span>
                                                @else
                                                    <span class="badge badge-danger" data-toggle="tooltip" title="{{ __('You are losing because other supplier made a lower bid') }}" data-placement="top">{{ __('Losing')}}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bid->canceled === 1)
                                            <div class="badge badge-light">{{__('Canceled')}} </div>
                                            @else
                                                @if ($bid->won === 1)
                                                    <div class="badge badge-success">{{__('You won')}} </div>
                                                @elseif ($bid->won === 0 & $item->status == 'Closed')
                                                    <div class="badge badge-danger">{{__('You lost')}} </div>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 'Closed')
                                                <a href="{{ url('/mybids/showauction/' . $item->id) }}" class="btn btn-primary btn-sm" title="{{ __('See Auction') }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{ url('/auctions/' . $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Go to this Auction') }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'url' => ['/bids', $bid->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                            'type' => 'submit',
                                                            'data-toggle'=>'tooltip',
                                                            'data-placement'=>'top',
                                                            'title'=>__('Delete Bid?'),
                                                            'class' => 'btn btn-danger btn-sm'
                                                            // 'title' => 'Delete Bid'
                                                            // 'onclick'=>'return confirm("Confirm?")'
                                                    )) !!}
                                                {!! Form::close() !!}
                                            @endif

                                        </td>
                                    </tr>

                                    {{-- @endif --}}
                                @endforeach
                            </tbody>

                        </table>{{-- end table --}}

                    </div>{{-- end table-responsive --}}

                </div> {{-- end col-md-12 --}}
            </div>{{-- end row --}}


        </div>
    </div>
<br>
{{-- mobile version --}}
<div class="d-block d-sm-none">
    @foreach ($auctions as $item)
        @section('best_bid')
            {{ $bestbid = App\Bid::where('auction_id', $item->id)->min('bid') }}
            {{ $mybid = $bids2->where('auction_id', $item->id)->min('bid') }}
            {{ $bid = $bids2->where('auction_id', $item->id)->first() }}
        @endsection
        <div id="auction{{$item->id}}" class="box
            @if ($bid->won === 1)
                box-solid box-success
            @elseif ($item->status == 'Closed' and $bid->won === 0)
                box-solid box-success
            @else
                @if ($mybid)
                    @if ($mybid == $bestbid)
                        box-success
                    @elseif ($mybid > $bestbid)
                        box-danger
                    @else

                    @endif
                @else
                    box-default
                @endif
            @endif
        ">
                <div class="box-header with-border">
                    <h5 class="box-title">

                        @lang('globals.from') <strong><span class="text-capitalize">{{ $item->fromcity->name }}</span></strong> @lang('globals.to') <strong><span class="text-capitalize">{{ $item->tocity->name }}</span> </strong>
                    </h5>
                </div>
                <div class="box-body">
                    <div class="row d-block d-sm-none">
                        <div class="col-md 12">
                            <span class="text-primary mr-2 d-block d-sm-none"><i class="fa fa-calendar text-muted" aria-hidden="true"></i> {{ date('j-M-Y', strtotime($item->date)) }}  <i class="fa fa-clock-o text-muted" aria-hidden="true"></i> {{ date('g:i A', strtotime($item->time)) }}</span>
                            <span class="text-primary"><i class="fa fa-car text-muted" aria-hidden="true"></i>  {{ $item->vehicle->name }}</span>
                            @if ($item->passengers)
                                <span class="text-primary"><strong class="text-muted">{{ __('People') }}: </strong> {{ $item->passengers }}</span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            {{-- @if ($bids->where('auction_id', $item->id)->count() > 0)
                                <span><strong class="text-muted">{{ __('Current Bid') }}</strong>: <span class="text-primary">${{ number_format($bids->where('auction_id', $item->id)->min('bid'), 2, '.', ',') }}</span></span>
                            @else
                                <span><strong class="text-muted">{{ __('Current Bid') }}</strong>: <span class="text-primary">${{ number_format($item->starting_bid, 2, '.', ',') }}</span></span>
                            @endif --}}

                            @if ($bids2->where('auction_id', $item->id)->count())
                                <span><strong class="text-muted">{{ __('My bid') }} </strong>: <span class="text-primary">${{ number_format($mybid, 2, '.', ',') }} </span> </span>
                                @if ($item->status == 'Open')
                                    @if ($mybid == $bestbid)
                                        <span class="badge badge-success" data-toggle="tooltip" title="{{ __('You are winning because this is the best bid') }}" data-placement="top">{{ __('Winning')}} </span>
                                    @else
                                        <span class="badge badge-danger" data-toggle="tooltip" title="{{ __('You are losing because other supplier made a lower bid') }}" data-placement="top">{{ __('Losing')}}</span>
                                    @endif
                                @endif
                                @if ($bid->canceled === 1)
                                <div class="badge badge-light">{{__('Canceled')}} </div>
                                @else
                                    @if ($bid->won === 1)
                                        <div class="badge badge-success">{{__('You won')}} </div>
                                    @elseif ($bid->won === 0 & $item->status == 'Closed')
                                        <div class="badge badge-danger">{{__('You lost')}} </div>
                                    @endif
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    @if ($item->status == 'Closed')
                        <a href="{{ url('/mybids/showauction/' . $item->id) }}" class="btn btn-primary btn-sm" title="{{ __('See Auction') }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    @else
                        <a href="{{ url('/auctions/' . $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="{{ __('Go to this Auction') }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/bids', $bid->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                    'type' => 'submit',
                                    'data-toggle'=>'tooltip',
                                    'data-placement'=>'top',
                                    'title'=>__('Delete Bid?'),
                                    'class' => 'btn btn-danger btn-sm'
                                    // 'title' => 'Delete Bid'
                                    // 'onclick'=>'return confirm("Confirm?")'
                            )) !!}
                        {!! Form::close() !!}
                    @endif
                </div>
        </div>
    @endforeach
</div>

</div>
{{-- en row for mobile view --}}


</div> {{-- end global container-fluid --}}
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        // DataTable
        @if (Config::get('app.locale') == 'es')
        var table = $('#bids').DataTable({

            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando del _START_ al _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
        @else
        var table = $('#bids').DataTable();
        @endif

        $('#from_search').on( 'keyup', function () {
            table
                .columns( 0 )
                .search( this.value )
                .draw();
        } );
        $('#to_search').on( 'keyup', function () {
            table
                .columns( 1 )
                .search( this.value )
                .draw();
        } );
    } );
</script>
@endsection
