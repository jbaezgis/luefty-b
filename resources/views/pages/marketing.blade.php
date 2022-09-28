@extends('layouts.app2')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12 text-center">
            <img class="img-fluid" src="{{ asset('images/luefty-marketing.png') }}" alt="Luefty Marketing">
        </div>

        <div class="col-md-12 text-center mt-3">
            <a href="{{ asset('files/luefty_marketing_plan.pdf') }} " class="btn btn-outline-danger btn-lg"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF - Digital Maketing Plan</a>
        </div>
    </div>
</div>

@endsection
