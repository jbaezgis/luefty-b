@extends('layouts.app2')

@section('content')
<div class="page-title ">
    <div class="container">
        <h1 class="">Subastas de tours</h1>
    </div>
</div>
<div class="container">
<div class="row">
    {{-- @include('auctions.search_sidebar')  --}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['method' => 'GET', 'url' => '/tours', 'class' => '', 'role' => 'search'])  !!}
                    Filtros:
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                {{-- <label for="from">Desde</label> --}}
                                <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}" placeholder="Localizacion">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <a class="btn btn-warning" href="/tours"><i class="fa fa-refresh"></i> Resetear</a>
                        </div>

                        {{-- <div class="col-md-2">
                           
                        </div> --}}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                Ordenar por:
                @sortablelink('location', 'Localizacion', ['filter' => 'active, visible'], ['class' => 'btn btn-outline-secondary' , 'rel' => 'nofollow']) |
                @sortablelink('end_time', 'Finaliza', ['filter' => 'active, visible'], ['class' => 'btn btn-outline-secondary' , 'rel' => 'nofollow'])
            </div>
             
        </div>
        <br> 
        <div class="row">

            @foreach($tours as $item)
            <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-header"><h3 class="box-title"><a href="{{ url('/tours/' . $item->id) }}">{{ $item->location }}</a></h3></div>
                        <div class="box-body">

                            <p><strong>Dias:</strong> {{ $item->days }} | <strong>Finaliza:</strong> {{ date('j F, Y', strtotime($item->end_date)) }} | 
                            <strong>A las:</strong>  {{ date('g:i a', strtotime($item->end_date)) }}</p>

                            <a href="{{ url('/tours/' . $item->id) }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i> Ver más</a>

                        </div>
                    </div>
                <br>
            </div><!--/col-->
            @endforeach
        </div>
    </div>
</div><!--/row-->
@endsection