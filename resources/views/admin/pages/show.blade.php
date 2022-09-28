@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            
        <div class="col-md-3">
            @include('layouts.admin.sidebar')
        </div>

        <div class="col-md-9">
                <br>
                <h3>
                    {{ $page->title }}
                    <small class="text-muted"> - {{ __('Code')}}: {{ $page->code }}</small>
                </h3>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ url('administration/content/pages') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('administration/content/pages/' . $page->id . '/edit') }}" title="Edit Page"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {{-- {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/pages', $page->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Page',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!} --}}

                    </div>
                </div>
                <br>
                <div class="card">
                    {{-- <div class="card-header">{{ _('Content')}}</div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! $page->content !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
