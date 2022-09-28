@extends('layouts.app2')

@section('content')

<br>
<div class="container">
{!! Form::open(['method' => 'GET', 'url' => '/viewall', 'class' => 'form-inline my-2 my-lg-0', 'role' => 'search'])  !!}
<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="Search...">
    <span class="input-group-append">
        <button class="btn btn-secondary" type="submit">
            <i class="fa fa-search"></i>
        </button>
    </span>
</div>
{!! Form::close() !!}
<hr>
<div class="row">
    <div class="row">
        @foreach($auctions as $item)
        <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header"><h3 class="box-title">{{ $item->from }} a {{ $item->to }}</h3></div>
                    <div class="box-body">
                        <p><strong>Fecha:</strong> {{ date('j F, Y', strtotime($item->day_time)) }} </p>
                        <p><strong>Hora:</strong> {{ date('g:i a', strtotime($item->day_time)) }}</p>
                        <p><strong>Pax:</strong> {{ $item->passengers }}</p>
                    </div>
                    <div class="box-footer">
                        <a href="{{ url('/auctions/' . $item->id) }}" class="btn btn-outline-primary btn-sm btn-block"><i class="fa fa-eye"></i> Ver más</a>
                    </div>
                </div>
            <br>
        </div><!--/col-->
        @endforeach
    </div><!--/row-->
</div><!--/row-->
@endsection