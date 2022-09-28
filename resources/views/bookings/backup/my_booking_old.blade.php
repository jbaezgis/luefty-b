@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <h1>{{$auction->full_name}} </h1>
                </div>{{-- /box-body --}}
            </div>{{-- /box --}}
        </div>{{-- /col --}}
    </div>{{-- /row --}}
</div>
@endsection
