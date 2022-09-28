@extends('layouts.app2')
@section('title', trans('auctions.my_auctions'))

@section('content')
{{-- <div class="container-title">
    <h2 class="page-title bg-primary"><i class="fa fa-car"></i> {{ trans('auctions.my_auctions') }} </h2>
</div> --}}

<div class="continer-fluid">
<br>
<div class="box box-solid">
    <div class="box-body">

        <div class="row pl-3">
            <div class="col-md-12 d-none d-sm-block">
                
                {{-- <a href="{{ url('/myauctions/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> @lang('auctions.add_new')</a> 
                &nbsp | &nbsp --}}
                {{-- <a href="{{ url('/myauctions') }}" class="btn btn-light btn-sm mr-1"><i class="fa fa-list text-primary" aria-hidden="true"></i> @lang('globals.status_of_my_auctions')</a> --}}
                <a href="{{ route('myauctions.index') }}" class="btn {{ request()->is('myauctions') ? 'btn-secondary' : 'btn-light' }} mr-1"> {{ __('Private transfers') }} <span class="badge badge-light border">{{ $privatecount }}</span></a>
                <a href="{{ route('myauctions.sharing') }}" class="btn {{ request()->is('myauctions/sharing/index') ? 'btn-secondary' : 'btn-light' }} mr-1">{{ __('Shared transfers') }} <span class="badge badge-light border">{{ $sharingcount }}</span></a>
                <a href="{{ route('myauctions.tours') }}" class="btn {{ request()->is('myauctions/tours/index') ? 'btn-secondary' : 'btn-light' }} mr-1"> {{ __('Tours') }} <span class="badge badge-light border">{{ $tourscount }}</span></a>
                <a href="{{ route('myauctions.emptylegs') }}" class="btn {{ request()->is('myauctions/empty-legs/index') ? 'btn-secondary' : 'btn-light' }} mr-1">{{ __('Empty Legs') }} <span class="badge badge-light border">{{ $emptylegscount }}</span></a>

                <a href="{{ route('myauctions.trash') }}" class="btn {{ request()->is('myauctions/trash/index') ? 'btn-secondary' : 'btn-light' }} mr-1 pull-right"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('Trash')}} <span class="badge badge-light">{{ $trashcount }}</span></a>
                
                {{-- {!! Form::open(['method' => 'GET', 'url' => '/myauctions', 'class' => 'form-inline my-2 my-lg-0', 'role' => 'search'])  !!}
                &nbsp | &nbsp
                    <div class="input-group">
                        <input type="text" class="form-control" name="from" placeholder="@lang('globals.from')">
                        <input type="text" class="form-control" name="to" placeholder="@lang('globals.to')">
                        <input type="text" class="form-control" name="status" placeholder="@lang('globals.search')">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            
                        </span>
                        
                    </div>
                    &nbsp<a href="{{ url('/myauctions') }}" class="btn btn-secondary"> @lang('globals.clear')</a>
                {!! Form::close() !!} --}}
            </div>
            <div class="col-md-12 d-xl-none">
                <div class="d-flex flex-row">
                    <div class="mr-2">
                            <a href="{{ url('/myauctions/create') }}" class="btn btn-warning btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> @lang('auctions.add_new')</a> 
                    </div>
                    
                    <div class="mr-2">
                        <div class="dropdown">
                            <a class="btn btn-outline-dark btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('globals.filters')
                            </a>
                            
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/myauctions') }}"><i class="fa fa-list text-primary" aria-hidden="true"></i> @lang('globals.all')</a>
                                <a class="dropdown-item" href="myauctions?from=&to=&status=Closed"><i class="fa fa-check-square-o text-success" aria-hidden="true"></i> @lang('globals.accepted')</a>
                                <a class="dropdown-item" href="myauctions?from=&to=&status=Open"><i class="fa fa-square-o text-warning" aria-hidden="true"></i> @lang('globals.open')</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        {{-- <hr> --}}
        <div class="col-md-12 d-block d-sm-none">
            {!! Form::open(['method' => 'GET', 'url' => '/myauctions', 'class' => 'd-flex flex-row my-2 my-lg-0', 'role' => 'search'])  !!}
            
                <div class="input-group">
                    <input type="text" class="form-control" name="from" placeholder="@lang('globals.from')">
                    <input type="text" class="form-control" name="to" placeholder="@lang('globals.to')">
                    {{-- <input type="text" class="form-control" name="status" placeholder="@lang('globals.search')"> --}}
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        
                    </span>
                    
                </div>
                &nbsp<a href="{{ url('/myauctions') }}" class="btn btn-secondary"> @lang('globals.clear')</a>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
{{-- Imcomplete auctions alert --}}
<div class="alert alert-warning" role="alert">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 
    {{ __('These auctions will be permanently eliminated after 24 hours.') }}.
</div>
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        @if( session()->has('info') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {!! session('info') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
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
                    'url' => ['/recover', session('auction_id')],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-repeat" aria-hidden="true"></i> Recuperar', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Recuperar',
                            // 'onclick'=>'return confirm("Seguro que desea eliminar?")'
                    )) !!}
                {!! Form::close() !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        @if( session()->has('recover') )
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              {!! session('recover') !!}
              
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
    </div>
</div>
<br>
<div class="row">
<div class="col-md-12 d-none d-sm-block">
        <div class="box box-solid">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="auctions" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Item') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auctions as $item)
                                <tr class="">
                                    @if ($item->from_location)
                                    <td scope="row">
                                        {{ __('Category') }}: <strong>{{ $item->category->name }}</strong>, 
                                        {{ __('Auction') }}: {{ __('From') }} <strong>{{ $item->fromlocation->name }}</strong> {{ __('To') }} <strong>{{ $item->tolocation->name }}</strong></td>
                                    </td>

                                    @elseif ($item->title)
                                    <td scope="row">
                                        {{ __('Category') }}: <strong>{{ $item->category->name }}</strong>, 
                                        {{ __('Auction') }}: {{ __('Tour name') }} <strong>{{ $item->title }}</strong>
                                    </td>
                                    @else
                                    <td scope="row">
                                        {{ __('Category') }}: <strong>{{ $item->category->name }}</strong>, 
                                        {{ __('This auction is incomplete') }}
                                    </td>
                                    @endif
                                    
                                    <td>
                                        <a class="btn btn-secondary btn-sm" 
                                            href="{{ url('/myauctions/' . $item->id . '/edit') }}" 
                                            title="{{ __('Complete data') }}"
                                            data-toggle="tooltip" 
                                            data-placement="top"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            {{ __('Complete data') }}
                                        </a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/myauctions', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'onclick' => 'return confirm("Surely you want to delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                        
                                                  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                

            </div>
        </div>
    </div>
    {{-- end col-md-12 --}}

    <div class="container-fluid">
    <div class="d-flex flex-row d-xl-none">
        @lang('globals.order_by'): &nbsp
        @sortablelink('from', trans('globals.from'), ['filter' => 'active, visible'], ['class' => 'btn btn-outline-secondary btn-sm' , 'rel' => 'nofollow']) &nbsp |
        &nbsp @sortablelink('to', trans('globals.to'), ['filter' => 'active, visible'], ['class' => 'btn btn-outline-secondary btn-sm' , 'rel' => 'nofollow']) &nbsp | 
        &nbsp @sortablelink('day_time', trans('globals.date'), ['filter' => 'active, visible'], ['class' => 'btn btn-outline-secondary btn-sm' , 'rel' => 'nofollow'])
    </div>
    <br>
    <div class="row d-xl-none">

            @foreach($auctions as $item)
            <div class="col-md-12">
                    <div class="box box-solid">
                        {{-- <div class="box-header"><h3 class="box-title">{{ $item->from }} a {{ $item->to }}</h3></div> --}}
                        <div class="box-body">
                            <p>@lang('globals.from') <strong>{{ $item->from }}</strong> @lang('globals.to') <strong>{{ $item->to }}</strong></p>
                            <p><i class="fa fa-calendar-o"></i> {{ date('F j, Y', strtotime($item->date)) }}, {{ date('g:i a', strtotime($item->time)) }}</p>
                            <p>
                                <strong>@lang('globals.status'):</strong>  
                                @if ($item->status == 'Closed')
                                    <span class="badge badge-pill badge-success">@lang('globals.accepted')</span>
                                @else
                                    <span class="badge badge-pill badge-warning">@lang('globals.open')</span>
                                @endif
                                |
                                <strong>@lang('globals.bids'):</strong> {{ $item->bids->count() }} </p>
                            
                            <a href="{{ url('/myauctions/' . $item->id) }}" title="View User"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    {{-- <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a> --}}
                                    @if ($item->status == 'Closed')
                                    @else
                                        {!! Form::open([
                                            'method' => 'PATCH',
                                            'url' => ['/myauctions', $item->id],
                                            'style' => 'display:inline',
                                            'class' => 'form',
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Elimnar',
                                                    'onclick'=>'return confirm("Seguro que desea eliminar")'
                                            )) !!}
                                        {!! Form::close() !!}
                                        {{-- {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/auctions', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete User',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!} --}}

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
{{-- <button type="button" id="alert" class="btn btn-primary">Primary</button> --}}
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
        $('#auctions').DataTable();
    } );
</script>
@endsection