@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Integrante</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/services') }}" title="Atrás"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ url('/admin/services/' . $service->id . '/edit') }}" title="Editar Integrante"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/admin/services', $service->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Eliminar Integrante',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID.</th>
                                        <th>Title</th>
                                        <th>Content</th>

                                        <th>Orden</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td> {{ $service->title }} </td>
                                        <td> {{ $service->content }} </td>
                                        <td> {{ $service->order }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
