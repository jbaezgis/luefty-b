@extends('layouts.app2')
@section('title', trans('auctions.my_auctions'))

@section('content')
<div class="container-fluid">
<br>
<div class="row">
        <div class="col-md-12 text-center">
            <h4>{{ __('Select Category') }} </h4>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('privatetransfers.index') }}" class="btn {{ request()->is('myauctions/privatetransfers*') ? 'btn-primary' : 'btn-light' }}">{{ __('Private Transfers') }}</a>
                <a href="{{ route('sharedshuttles.index') }}" class="btn {{ request()->is('myauctions/sharedshuttles*') ? 'btn-primary' : 'btn-light' }}">{{ __('Shared Shuttles') }}</a>
            </div>
        </div>
</div>
<p></p>
    {{-- <h1>{{ __('Shared Shuttle Seats') }} 
        
    </h1> --}}

    <!-- Modal -->
	  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ __('Status')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    @include('myauctions.help_content')
                </div>
              </div>
            </div>
          </div>
    {{-- <hr> --}}
</div>

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
            @if( session()->has('info') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! session('info') !!}
              <button type="button" class="btn btn-light btn-sm" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">{{__('Confirm')}}</span>
              </button>
            </div>
        @endif
        @if( session()->has('deleted') )
        <script>
                swal({!! session('deleted') !!});
            </script>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {!! session('deleted') !!} | 
              {!! Form::open([
                    'method' => 'PATCH',
                    'url' => ['myauctions/recover', session('auction_id')],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-repeat" aria-hidden="true"></i> Recuperar', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Recuperar',
                            // 'onclick'=>'return confirm("Seguro que desea eliminar?")'
                    )) !!}
                {!! Form::close() !!}
              <button type="button" class="btn btn-light btn-sm" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">{{__('Close')}}</span>
              </button>
            </div>
        @endif
        @if( session()->has('recover') )
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              {!! session('recover') !!}
              
              <button type="button" class="btn btn-light btn-sm" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">{{__('Close')}}</span>
              </button>
            </div>
        @endif
    </div>
</div>

{{-- Search box --}}
{{-- @if ($auctions->count() > 10) --}}
<div class="box box-solid">
    <div class="box-header with-border">
        
        <div class="box-body">
                <div class="row">
                        <div class="col-md-12 d-none d-lg-block d-xl-block">
                            <a href="{{ route('sharedshuttles.index') }}" class="btn {{ request()->is('myauctions/sharedshuttles/index') ? 'btn-secondary' : 'btn-light' }} mr-1"> {{ __('All') }} <span class="badge badge-light border">{{ $auctions_all }}</span></a>
                            <a href="{{ route('sharedshuttles.nobidyet') }}" class="btn {{ request()->is('myauctions/sharedshuttles/nobidyet') ? 'btn-secondary' : 'btn-light' }} mr-1">{{ __('No bid yet') }} <span class="badge badge-light border">{{ $auctions_nobidyet }}</span></a>
                            <a href="{{ route('sharedshuttles.openbid') }}" class="btn {{ request()->is('myauctions/sharedshuttles/openbid') ? 'btn-secondary' : 'btn-light' }} mr-1 ">{{ __('Open bid')}} <span class="badge badge-light border">{{ $auctions_openbid }}</span></a>
                            <a href="{{ route('sharedshuttles.accepted') }}" class="btn {{ request()->is('myauctions/sharedshuttles/accepted') ? 'btn-secondary' : 'btn-light' }} mr-1 ">{{ __('Accepted')}} <span class="badge badge-light border">{{ $auctions_accepted }}</span></a>
                        </div>
                        <div class="col-md-12 d-none d-block d-sm-block d-md-none">
                            <a href="{{ route('sharedshuttles.index') }}" class="btn {{ request()->is('myauctions/sharedshuttles/index') ? 'btn-secondary' : 'btn-light' }} btn-sm mb-1"> {{ __('All') }} <span class="badge badge-light border">{{ $auctions_all }}</span></a>
                            <a href="{{ route('sharedshuttles.nobidyet') }}" class="btn {{ request()->is('myauctions/sharedshuttles/nobidyet') ? 'btn-secondary' : 'btn-light' }} btn-sm mb-1">{{ __('No bid yet') }} <span class="badge badge-light border">{{ $auctions_nobidyet }}</span></a>
                            <a href="{{ route('sharedshuttles.openbid') }}" class="btn {{ request()->is('myauctions/sharedshuttles/openbid') ? 'btn-secondary' : 'btn-light' }} btn-sm mb-1 pull-right">{{ __('Open bid')}} <span class="badge badge-danger">{{ $auctions_openbid }}</span></a>
                            <a href="{{ route('sharedshuttles.accepted') }}" class="btn {{ request()->is('myauctions/sharedshuttles/accepted') ? 'btn-secondary' : 'btn-light' }} btn-sm mb-1 pull-right">{{ __('Accepted')}} <span class="badge badge-danger">{{ $auctions_accepted }}</span></a>
                        </div>   
                    </div>
                    <p></p>
                {!! Form::open(['method' => 'GET', 'url' => 'myauctions/sharedshuttles/accepted', 'class' => ' my-2 my-lg-0', 'role' => 'search'])  !!}
                <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                               
                                {!! Form::text('service_number', null, ['class' => 'form-control', 'placeholder'=> __('Service Number')]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">{{ __('Selected')}}</button>
                                <a href="{{ url('myauctions/sharedshuttles/accepted') }}" class="btn btn-warning">{{ __('All') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                
                                {!! Form::select('from', App\Place::pluck('name', 'id'), null, ['placeholder'=> __('From location'), 'id'=>'from', 'class'=>'form-control select2']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                
                                {!! Form::select('to', App\Place::pluck('name', 'id'), null, ['placeholder'=> __('To location'), 'id'=>'to', 'class'=>'form-control select2']) !!}
                            </div>
                        </div>
                        <div class="col-md-3" >
                            <button class="btn btn-primary" type="submit">{{ __('Selected')}}</button>
                            <a href="{{ url('myauctions/sharedshuttles/accepted') }}" class="btn btn-warning">{{ __('All') }}</a>
                        </div>
                        
                    </div>
    
                {!! Form::close() !!}
        </div>
    </div>
</div>
{{-- @endif --}}

<div class="row">
<div class="col-md-12 d-none d-lg-block d-xl-block">
        <div class="box box-solid">
            <div class="box-header with-border">
                <a href="{{ route('myauctions.createsharing') }}" class="btn btn-primary">{{ __('Add new') }}</a>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="auctions" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('From') }} <span><a href="#" data-toggle="tooltip" data-placement="right" title="{{ __('From which Location') }}"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('To') }} <span><a href="#" data-toggle="tooltip" title="{{ __('To which Location') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Number') }} <span><a href="#" data-toggle="tooltip" title="{{ __('Your Service Number') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Date') }} <span><a href="#" data-toggle="tooltip" title="{{ __('Date of the service') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                {{-- <th>{{ __('Starting bid') }}</th> --}}
                                <th>{{ __('Seats') }} <span><a href="#" data-toggle="tooltip" title="{{ __('Available seats') }}" data-placement="right"><i class="fa fa-question-circle-o fa-lg text-secondary" aria-hidden="true"></i></a></span></th>
                                <th>{{ __('Status') }} <span><a class="text-secondary" href="#" data-toggle="modal" data-target="#exampleModal" title="{{ __('Status') }}"><i class="fa fa-question-circle-o fa-lg" aria-hidden="true"></i> (Click Here)</a></span></th>
                                {{-- <th>{{ __('Bid') }}</th> --}}
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auctions as $item)
                            @if ($item->from_location)
                                <tr>
                                    <td scope="row">{{ $item->fromlocation['name'] }}</td>
                                    <td>{{ $item->tolocation['name'] }}</td>
                                    <td>{{ $item->service_number }} </td>
                                    <td>{{ date('F j, Y', strtotime($item->date)) }}, {{ __('Pick Up')}} {{ date('g:i a', strtotime($item->from_time)) }} {{ __('to') }} {{ date('g:i a', strtotime($item->to_time)) }}</td>
                                    {{-- <td>${{ number_format($item->starting_bid, 2, '.', ',') }}</td> --}}
                                    <td>{{ $item->passengers }}</td>
                                    <td>
                                        @if ($item->changed === 1 & $item->status === 'Closed')
                                            <span class="badge badge-pill badge-light">@lang('globals.accepted')</span>
                                        @elseif ($item->changed === 1)
                                            <span class="badge badge-pill badge-light">{{ __('Changed')}} </span>   
                                        @else
                                            @if ($item->status == 'Closed')
                                                <span class="badge badge-pill badge-light">@lang('globals.accepted')</span>
                                            @else
                                                @if ($bids->where('auction_id', $item->id)->count() > 0)
                                                <span class="badge badge-pill badge-light">{{ __('Open bid') }}</span>
                                                @else 
                                                <span class="badge badge-pill badge-light">{{ __('No bid') }}</span>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    {{-- <td class="text-center text-primary"><strong>{{ $bids->where('auction_id', $item->id)->count() }}</strong></td> --}}
                                    <td>
                                            <a class="btn btn-secondary btn-sm" 
                                                href="{{ url('/myauctions/' . $item->id) }}" 
                                                title="{{ __('View') }}"
                                                data-toggle="tooltip" 
                                                data-placement="top"><i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @if ($item->changed === 0 & $item->bids->count() > 0 & $item->status === 'Open')
                                                <a class="btn btn-secondary btn-sm" 
                                                    href="{{ url('/myauctions/change/' . $item->id) }}" 
                                                    title="{{ __('Edit') }}"
                                                    data-toggle="tooltip" 
                                                    data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            @endif 
                                            @if ($item->changed === 1 & $item->status === 'Open')
                                            <a class="btn btn-secondary btn-sm" 
                                                    href="{{ url('/myauctions/' . $item->id . '/edit') }}" 
                                                    title="{{ __('Edit') }}"
                                                    data-toggle="tooltip" 
                                                    data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            
                                            @endif
                                            
                                            {{-- @if ($item->status == 'Closed') --}}
                                            @if ($item->bids->count() > 0 or $item->status == 'Closed')
                                            @else
                                            <a class="btn btn-secondary btn-sm" 
                                                href="{{ url('/myauctions/' . $item->id . '/edit') }}" 
                                                title="{{ __('Edit') }}"
                                                data-toggle="tooltip" 
                                                data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'url' => ['/myauctions', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-secondary btn-sm',
                                                            'title' => __('Delete'),
                                                            'data-toggle' => 'tooltip',
                                                            'data-placement' => 'top',
                                                            'onclick' => 'return confirm("Surely you want to delete?")'
                                                    )) !!}
                                                {!! Form::close() !!}
                                                
                                            @endif
                                        </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>

                

            </div>
        </div>
    </div>
    {{-- end col-md-12 --}}

    <div class="container-fluid">

    <div class="row d-none d-block d-sm-block d-md-none">
            <div class="col-md-12">
                    <a href="{{ route('myauctions.createsharing') }}" class="btn btn-secondary">{{ __('Add new') }}</a>
                </div>    
                <br>

            @foreach($auctions as $item)
            <div class="col-md-12">
                    <div class="box box-solid">
                        
                        <div class="box-body">
                                <p>@lang('globals.from') <strong>{{ $item->fromlocation['name'] }}</strong> @lang('globals.to') <strong>{{ $item->tolocation['name'] }}</strong></p>
                                <p><i class="fa fa-calendar-o"></i> {{ date('F j, Y', strtotime($item->date)) }}, {{ date('g:i a', strtotime($item->time)) }}</p>
                                <p><strong>{{ __('Starting bid') }}</strong> ${{ number_format($item->starting_bid, 2, '.', ',') }} | <strong>{{ __('Seats available')}}</strong>: {{ $item->passengers }}/{{ $item->shared_seats }} </p>
                                <p>
                                    <strong>@lang('globals.status'):</strong>  
                                    @if ($item->changed === 1 & $item->status === 'Closed')
                                        <span class="badge badge-pill badge-success">@lang('globals.accepted')</span>
                                    @elseif ($item->changed === 1)
                                        <span class="badge badge-pill badge-primary">{{ __('Changed')}} </span>   
                                    @else
                                        @if ($item->status == 'Closed')
                                            <span class="badge badge-pill badge-success">@lang('globals.accepted')</span>
                                        @else
                                            @if ($bids->where('auction_id', $item->id)->count() > 0)
                                            <span class="badge badge-pill badge-warning">{{ __('Open bid') }}</span>
                                            @else 
                                            <span class="badge badge-pill badge-secondary">{{ __('No bid') }}</span>
                                            @endif
                                        @endif
                                    @endif
                                    |
                                    <strong class="text-primary">@lang('globals.bids'):</strong> {{ $item->bids->count() }} </p>
                                
                                   
                                
                                {{-- @if ($item->status == 'Closed') --}}
                                <a class="btn btn-secondary btn-sm" 
                                    href="{{ url('/myauctions/' . $item->id) }}" 
                                    title="{{ __('View') }}"
                                    data-toggle="tooltip" 
                                    data-placement="top"><i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                @if ($item->changed === 0 & $item->bids->count() > 0 & $item->status === 'Open')
                                    <a class="btn btn-secondary btn-sm" 
                                        href="{{ url('/myauctions/change/' . $item->id) }}" 
                                        title="{{ __('Edit') }}"
                                        data-toggle="tooltip" 
                                        data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                @endif 
                                @if ($item->changed === 1 & $item->status === 'Open')
                                <a class="btn btn-secondary btn-sm" 
                                        href="{{ url('/myauctions/' . $item->id . '/edit') }}" 
                                        title="{{ __('Edit') }}"
                                        data-toggle="tooltip" 
                                        data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                
                                @endif
                                
                                {{-- @if ($item->status == 'Closed') --}}
                                @if ($item->bids->count() > 0 or $item->status == 'Closed')
                                @else
                                <a class="btn btn-secondary btn-sm" 
                                    href="{{ url('/myauctions/' . $item->id . '/edit') }}" 
                                    title="{{ __('Edit') }}"
                                    data-toggle="tooltip" 
                                    data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/myauctions', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Elimnar',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'top',
                                                'onclick' => 'return confirm("Surely you want to delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                    
                                @endif
                        </div>
                    </div>
                <br>
            </div><!--/col-->
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    $('#alert').click(function(){
        swal("Hello world!");
    }); 

    $(document).on('submit', '[id^=form]', function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    swal({
        title: "Are you sure?",
        text: "Do you want to Send this email",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, send it!",
        cancelButtonText: "No, cancel pls!",
    }).then(function () {
        $('#form').submit();
    });
    return false;
    });
</script>

<script>
        $(document).ready(function() {
            // DataTable
            @if (Config::get('app.locale') == 'es')
            var table = $('#auctions').DataTable({
                dom: 'tpi',
                "aaSorting": [],
                columnDefs: [{ orderable: false, "targets": [6]}],
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
            var table = $('#auctions').DataTable({
                dom: 'tpi',
                "aaSorting": [],
                columnDefs: [{ orderable: false, "targets": [6]}],
            });
            @endif
    
            $('#from_search').on( 'change', function () {
                table
                    .columns( 0 )
                    .search( this.value )
                    .draw();
            } );
            $('#to_search').on( 'change', function () {
                table
                    .columns( 1 )
                    .search( this.value )
                    .draw();
            } );
            $('#number_search').bind( 'keyup', function () {
            table
                .columns( 2 )
                .search( this.value )
                .draw();
            } );
        } );
    </script>
@endsection