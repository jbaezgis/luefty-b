@extends('layouts.admin.admin')
@section('content')
<p></p>
    <div class="container">
        <div class="row">
            
        <div class="col-md-3">
            @include('layouts.admin.sidebar')
        </div>

        <div class="col-md-9">
                <br>
                <h3>
                    {{ $page->title }}
                    <small class="text-muted"> - {{ __('Code')}}: {{ $page->code }}</small>
                </h3>
                <a href="{{ url('administration/content/pages/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                <hr>
                <div class="card">
                    <div class="card-header">{{ __('Content') }}</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($page, [
                            'method' => 'PATCH',
                            'url' => ['administration/content/pages', $page->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.pages.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    CKEDITOR.replace( 'content', {
        language: 'en'
    } );
</script>
@endsection
