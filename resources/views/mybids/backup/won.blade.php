@extends('layouts.app2')
@section('title', trans('bids.my_bids'))

@section('content')
{{-- <div class="container-title">
        <h2 class="page-title bg-primary"><i class="fa fa-money"></i> {{ trans('bids.my_bids') }} </h2>
</div> --}}
{{-- <br>
<div class="row pl-3">

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">


    </div>
</div> --}}
<div class="container-fluid">
<br>
{{-- Main Table --}}
<div class="row">
    <div class="col-md-12 d-none d-lg-block d-xl-block">
            <div class="box box-solid">
                <div class="box-header with-border">
                {{-- <a href="{{ route('myauctions.createprivate') }}" class="btn btn-primary">{{ __('Add new') }}</a> --}}
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="auctions" class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                    <th>{{ __('From') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('From which Location') }}"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                    <th>{{ __('To') }} <span><a href="#" data-toggle="tooltip" title="{{ __('To which Location') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                    {{-- <th>{{ __('Number') }} <span><a href="#" data-toggle="tooltip" title="{{ __('Your Service Number') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th> --}}
                                    <th>{{ __('Date') }} <span><a href="#" data-toggle="tooltip" title="{{ __('Date of the service') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                    <th>{{ __('Best bid') }}</th>
                                    <th>{{ __('Status') }} </th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auctions as $item)
                                {{-- @if ($item->from_location) --}}
                                {{-- querys --}}
                                @section('best_bid')
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
                                            {{-- {{ $bids2->where('auction_id', $item->id)->min('bid')}} --}}
                                        </td>
                                        <td>
                                            @if ($bid->canceled === 1)
                                            <div class="badge badge-light">{{__('Canceled')}} </div>
                                            @else
                                                @if ($bid->won === 1)
                                                    <div class="badge badge-success">{{__('Accepted')}} </div>
                                                @elseif ($bid->won === 0 & $item->status == 'Closed')
                                                    <div class="badge badge-light">{{__('Lost bid')}} </div>
                                                @elseif ($bid->won === 0)
                                                    <div class="badge badge-light">{{__('Open bid')}} </div>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{-- @if ($bid->canceled === 1)
                                                <a href="{{ url('/mybids/changedauction/' . $item->id) }}" title="{{ __('See Auction') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            @else
                                            @endif --}}
                                            <a href="{{ url('/mybids/showauction/' . $item->id) }}" title="{{ __('See Auction') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        </td>
                                    </tr>

                                    {{-- @endif --}}
                                @endforeach
                            </tbody>

                        </table>

                    </div>



                </div>
            </div>
        </div>
        {{-- end col-md-12 --}}
    </div>
<br>
<div class="row">
<div class="col-md-12 d-none d-sm-block">
        <div class="box box-solid">

            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="bids">
                        <thead>
                            <tr>
                                <th>{{ __('Auction') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('Auction') }}"><i class="fa fa-question-circle-o text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Category') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('Category') }}"><i class="fa fa-question-circle-o text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Date') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('Date') }}"><i class="fa fa-question-circle-o text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Starting bid') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('Starting bid') }}"><i class="fa fa-question-circle-o text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Bid') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('Bid') }}"><i class="fa fa-question-circle-o text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bids as $bid)
                            @if ($bid->auction['deleted'] == 0 & $bid->won === 1)
                            <tr class="">
                                    <td>{{ __('From') }}: <strong>{{ $bid->auction->fromlocation->name }}</strong> {{ __('To') }}: <strong>{{ $bid->auction->tolocation->name }}</strong></td>
                                    <td>{{ $bid->auction->category->name }}
                                        {{-- @if ($bid->auction->category_id == 1)
                                        <h6><span class="badge badge-primary">{{ $bid->auction->category->name }}</span></h6>
                                        @else
                                        <h6><span class="badge badge-success">{{ $bid->auction->category->name }}</span></h6>
                                        @endif  --}}

                                    </td>
                                    <td>
                                        @if ($bid->auction->category_id == 1)
                                            {{ date('F j, Y', strtotime($bid->auction['date'])) }}, {{ date('g:i a', strtotime($bid->auction['time'])) }}
                                        @else
                                            {{ date('F j, Y', strtotime($bid->auction['date'])) }}, {{ __('Pick up')}} {{ date('g:i a', strtotime($bid->auction['from_time'])) }} {{ __('to') }} {{ date('g:i a', strtotime($bid->auction['to_time'])) }}
                                        @endif
                                    </td>
                                    <td>${{ number_format($bid->auction->starting_bid, 2, '.', ',') }}</td>
                                    @if ($bid->auction->category_id == 1)
                                    <td><strong>${{ number_format($bid->bid, 2, '.', ',') }}</strong></td>
                                    @else

                                    <td>{{ __('Seats') }}: <strong>{{ $bid->seats }}</strong> | {{ __('Bid by seat') }}: <strong>${{ number_format($bid->bid, 2, '.', ',') }}</strong> | {{ _('Total') }}: <strong>${{ number_format($bid->total, 2, '.', ',') }}</strong></td>
                                    @endif

                                    <td>
                                        @if ($bid->canceled === 1)
                                            <div class="badge badge-light">{{__('Canceled')}} </div>
                                        @else
                                            @if ($bid->won === 1)
                                                <div class="badge badge-success">{{__('Accepted')}} </div>
                                            @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed')
                                                <div class="badge badge-light">{{__('Lost bid')}} </div>
                                            @elseif ($bid->won === 0)
                                                <div class="badge badge-light">{{__('Open bid')}} </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bid->canceled === 1)
                                            <a href="{{ url('/mybids/changedauction/' . $bid->auction_id) }}" title="{{ __('See Auction') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        @else
                                        <a href="{{ url('/mybids/showauction/' . $bid->auction_id) }}" title="{{ __('See Auction') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        @endif
                                    </td>
                            </tr>
                            @else
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination"> {!! $bids->appends(['search' => Request::get('search')])->render() !!} </div>
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
            <div class="box box-solid">
                {{-- <div class="box-header"><h3 class="box-title">{{ $item->from }} a {{ $item->to }}</h3></div> --}}
                <div class="box-body">
                        <p>@lang('globals.from') <strong>{{ $bid->auction->fromlocation->name }}</strong> @lang('globals.to') <strong>{{ $bid->auction->tolocation->name }}</strong> </p>
                        <p>
                            @if ($bid->auction->category_id == 1)
                            <h6><span class="badge badge-primary">{{ $bid->auction->category->name }}</span></h6>
                            @else
                            <h6><span class="badge badge-success">{{ $bid->auction->category->name }}</span></h6>
                            @endif
                        </p>

                        <p><strong>{{ __('Service date') }}: </strong>
                            @if ($bid->auction->category_id == 1)
                                {{ date('F j, Y', strtotime($bid->auction['date'])) }}, {{ date('g:i a', strtotime($bid->auction['time'])) }}
                            @else
                                {{ date('F j, Y', strtotime($bid->auction['date'])) }}, {{ __('Between')}} {{ date('g:i a', strtotime($bid->auction['from_time'])) }} {{ __('and') }} {{ date('g:i a', strtotime($bid->auction['to_time'])) }}
                            @endif
                        </p>
                        <p><strong>{{ __('Starting bid') }}</strong>:
                            ${{ number_format($bid->auction->starting_bid, 2, '.', ',') }} {{ $bid->auction->category_id == 2 ? 'by seat' : ''}}

                        </p>
                        <p><strong>{{ __('Bid') }}: </strong>
                            @if ($bid->auction->category_id == 1)
                            ${{ number_format($bid->bid, 2, '.', ',') }}
                            @else

                            {{ __('Seats') }}: <strong>{{ $bid->seats }}</strong> | {{ __('Bid by seat') }}: <strong>${{ number_format($bid->bid, 2, '.', ',') }}</strong> | {{ _('Total') }}: <strong>${{ number_format($bid->total, 2, '.', ',') }}</strong>
                            @endif
                        </p>
                        <p><strong>{{ __('Status') }}</strong>:
                            @if ($bid->canceled === 1)
                                <span class="badge badge-danger">{{__('Canceled')}} </span>
                            @else
                                @if ($bid->won === 1)
                                    <span class="badge badge-success">{{__('Accepted')}} </span>
                                @elseif ($bid->won === 0 & $bid->auction['status'] == 'Closed')
                                    <span class="badge badge-warning">{{__('Lost bid')}} </span>
                                @endif
                            @endif
                        </p>

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
