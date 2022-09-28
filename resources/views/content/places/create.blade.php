@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Agregar</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/projects') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/projects', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                            @include ('admin.projects.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function save(this1)
    {
        // confirm('If you accept this offer, the Auction will also close.');
        this1.form.submit();
        this1.disabled=true;
        this1.value='Guardando…';
    }
</script>
@endsection
