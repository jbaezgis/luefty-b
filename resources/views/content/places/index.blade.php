@extends('layouts.admin')

@section('content')

    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Proyectos</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/projects/create') }}" class="btn btn-success btn-sm" title="Agregar Integrante">
                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar Proyecto
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/projects', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imagen</th>
                                        <th>Título</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><img src="{{URL::asset('storage/images/projects/'. $item->image)}}" height="60"></td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            {{-- <a href="{{ url('/admin/projects/' . $item->id) }}" title="Ver"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                            <a href="{{ url('/admin/projects/' . $item->id . '/edit') }}" title="Editar"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/projects', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Eliminar',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination"> {!! $projects->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
