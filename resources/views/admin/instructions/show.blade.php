@extends('layouts.admin.admin')

@section('content')
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">FAQ</h3>
                    </div>
                    <div class="box-body">

                        <a href="{{ url('/admin/faqs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/faqs/' . $faq->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/admin/faqs', $faq->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete FAQ',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <dl class="row">
                            <dt class="col-sm-12"><h4>English</h4></dt>
                            
                            <dt class="col-sm-3">{{ $faq->en_title }}</dt>
                            <dd class="col-sm-9">{!! $faq->en_text !!}</dd>
                            <hr>
                            <dt class="col-sm-12"><h4>Spanish</h4></dt>
                            <dt class="col-sm-3">{{ $faq->es_title }}</dt>
                            <dd class="col-sm-9">{!! $faq->es_text !!}</dd>
                        </dl>
                        {{-- <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID.</th> <th>Name</th><th>Label</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $faq->id }}</td> <td> {{ $role->name }} </td><td> {{ $role->label }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}

                    </div>
                </div>
@endsection
