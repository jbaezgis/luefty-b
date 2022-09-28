@extends('layouts.app2')
@section('title', __('Trash'))

@section('content')
<div class="container-title">
    <h1 class="page-title bg-primary">{{ __('Trash') }} (<small>{{ __('List of all deleted auctions')}}</small>)</h1>
</div>
<br>
{{-- Imcomplete auctions alert --}}
{{-- @if ($auctions->count() > 0)
<div class="alert alert-warning" role="alert">
    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
    {{ __('These auctions will be permanently eliminated automaticaly 2 hours after creation') }}.
</div>
@endif --}}
<div class="container-fluid">
    @include('myauctions.privatetransfers.menu')
    <hr>
    {{-- Search form --}}
    {!! Form::open(['method' => 'GET', 'url' => '/myauctions/privatetransfers/index', 'class' => ' my-2 my-lg-0', 'role' => 'search'])  !!}

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">

                        {!! Form::text('service_number', null, ['class' => 'form-control', 'placeholder'=> __('Service number')]) !!}
                    </div>
                </div>
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
                <div class="col-md-3 d-none d-lg-block d-xl-block" >
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> {{ __('Search') }} </button>
                    <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="{{ __('Clean fields and show all auctions.') }}">{{ __('Clear filters')}} </a>
                </div>
                {{-- btns for mobile --}}
                <div class="col-md-3 d-none d-block d-sm-block d-md-none" >
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i> {{ __('Search') }} </button>
                    <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-warning btn-sm ">{{ __('Clear filters')}} </a>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        {{-- <label for="to">Hasta</label> --}}
                        {!! Form::select('asc_desc', array('ASC' => __('Date: Ascendant'), 'DESC' => __('Date: Descendant')),null, ['class' => 'form-control', 'placeholder'=>__('Sort by:'), 'onchange'=>'this.form.submit()']) !!}
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::select('from', array('Open', 'Closed'), null, ['placeholder'=> __('--Select Status--'), 'id'=>'from', 'class'=>'form-control select2']) !!}
                    </div>
                </div>

                <div class="col-md-3" >
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    <a href="{{ url('/myauctions') }}" class="btn btn-warning">{{ __('See all')}} </a>
                </div>

            </div> --}}
            {!! Form::close() !!}

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
                                <th>
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('From location') }}">
                                        {{ __('From') }}
                                        {{-- @sortablelink('from', __('From')) --}}
                                    </span>
                                </th>
                                <th><span data-toggle="tooltip" data-placement="top" title="{{ __('To location') }}">{{ __('To') }}</span></th>
                                <th><span data-toggle="tooltip" data-placement="top" title="{{ __('Your service number') }}">{{ __('Number') }}</span></th>
                                <th>
                                    <span data-toggle="tooltip" data-placement="top" title="{{ __('Date of service') }}">
                                        @sortablelink('end_date', __('Date'))
                                    </span>
                                </th>
                                <th><span><a class="text-dark" href="#" data-toggle="modal" data-target="#exampleModal" title="{{ __('Status') }}">{{ __('Status') }} <span class="text-primary"><i class="fa fa-question-circle" aria-hidden="true"></i></span></a></span></th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auctions as $item)
                                @section('best_bid')
                                    {{ $bestbid = $bids->where('auction_id', $item->id)->min('bid') }}
                                    {{-- {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }} --}}
                                    {{-- {{ $favoritebid = $bids->where('auction_id', $item->id)->where('bid', $bestbid)->last() }} --}}
                                    {{ $favoritebid = $bids->where('bid', $bids->min('bid'))->first() }}
                                    @if ($bids->where('auction_id', $item->id)->count())
                                        {{ $profile = App\Profile::where('user_id', $favoritebid->user_id)->first() }}
                                    @endif
                                    {{ $won_user = App\Bid::where('auction_id', $item->id)->won()->first() }}
                                @endsection
                                <tr data-toggle="collapse" data-target="#auction{{$item->id}}" class="clickable">
                                    <td scope="row">
                                        @if ($item->from_city)
                                            {{ $item->fromcity->name }}</td>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td scope="row">
                                        @if ($item->to_city)
                                            {{ $item->tocity->name }}</td>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    {{-- <td>{{ $item->tolocation['name'] }}</td> --}}
                                    <td>{{ $item->service_number }} </td>
                                    <td>
                                        @if ($item->from_city)
                                        {{ date('F j, Y', strtotime($item->date)) }}, {{ date('g:i a', strtotime($item->time)) }}
                                        @endif
                                    </td>

                                    <td><span class="badge badge-danger">{{ __('Deleted') }} </span></td>

                                    <td>

                                        {{-- {!! Form::open([
                                            'method' => 'PATCH',
                                            'url' => ['myauctions/recover', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}

                                            <button type="submit" class="btn btn-info btn-sm" title="{{ __('Recover')}}" data-toggle="tooltip" data-placement="top"> <i class="fa fa-repeat" aria-hidden="true"></i></button>
                                        {!! Form::close() !!} --}}

                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/auctions', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'title' => __('Delete permanently'),
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}


                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="p-0">
                                        <div class="collapse" id="auction{{$item->id}}">
                                            <div class="card m-1">
                                            <div class="d-flex flex-row">
                                                <div class="p-2">
                                                    <strong>{{ __('Details') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $item->vehicle['name']}}</span>
                                                </div>
                                                <div class="p-2">
                                                    <strong>{{ __('Starting bid') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $item->starting_bid }}</span>
                                                </div>
                                                @if ($item->bids->count())
                                                    <div class="p-2">
                                                        <strong>{{ __('Current bid') }}</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">US$ {{ $item->bids->min('bid') }}</span>
                                                    </div>
                                                    <div class="p-2">
                                                        <strong>{{ __('Bid')}}s</strong>: <span class="{{ $item->category_id === 1 ? 'text-primary' : 'text-success'}} ">{{ $item->bids->count() }}</span>
                                                    </div>
                                                @endif

                                                @if ($item->passengers)
                                                    <div class="p-2">
                                                        <strong>{{ __('People') }}: </strong> <span class="text-primary">{{ $item->passengers }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                            <div class="pagination">{!! $auctions->appends(['service_number' => Request::get('service_number'), 'from' => Request::get('from'), 'to' => Request::get('to'), 'asc_desc' => Request::get('asc_desc'), 'sort' => Request::get('sort'), 'direction' => Request::get('direction')])->render() !!}</div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    {{-- end col-md-12 --}}

    <div class="container-fluid">

        <div class="row d-none d-block d-sm-block d-md-none">
            <div class="col-md-12">
                <a href="{{ route('myauctions.createprivate') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Create new auction') }}</a>
            </div>
            <br>
            @foreach($auctions as $item)
                @section('best_bid')
                    {{ $bestbid = $bids->where('auction_id', $item->id)->min('bid') }}
                    {{-- {{ $mybid = $bids->where('auction_id', $item->id)->where('user_id', auth()->user()->id)->min('bid') }} --}}
                    {{-- {{ $favoritebid = $bids->where('auction_id', $item->id)->where('bid', $bestbid)->last() }} --}}
                    {{ $favoritebid = $bids->where('bid', $bids->min('bid'))->first() }}
                    @if ($bids->where('auction_id', $item->id)->count())
                        {{ $profile = App\Profile::where('user_id', $favoritebid->user_id)->first() }}
                    @endif
                @endsection
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Service Number') }}: <strong>{{ $item->service_number }} </strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{__('From')}}<strong>{{ $item->fromcity['name'] }}</strong> {{__('To')}} <strong>{{ $item->tocity['name'] }}</strong></h5>
                            <span><i class="fa fa-calendar" aria-hidden="true"></i> {{ date('F j, Y', strtotime($item->date)) }}, {{ date('g:i a', strtotime($item->time)) }}</span><br>
                            <span><strong>{{ __('Starting bid') }}:</strong> </span>
                            <span>$ {{ $item->starting_bid }}</span>
                            |
                            <span><strong>{{ __('Status') }}:</strong> </span>
                            <span class="badge badge-pill badge-danger">{{ __('Deleted')}}</span>

                        </div>
                        {{-- footer --}}
                        <div class="card-footer text-muted">
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/auctions', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => __('Delete permanently'),
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <br>
                </div><!--/col-->

                @endforeach
            </div>
                <div class="row d-none d-block d-sm-block d-md-none">
                    <div class="col-md-12">
                        {{-- <div class="pagination">{!! $auctions->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                        <div class="pagination">{!! $auctions->appends(['service_number' => Request::get('service_number'), 'from' => Request::get('from'), 'to' => Request::get('to'), 'asc_desc' => Request::get('asc_desc')])->render() !!}</div>
                    </div>
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

@endsection
