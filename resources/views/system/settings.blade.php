@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if( session()->has('updated') )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('updated') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        {{ __('Settings') }}
                    </h4>
                </div>
                {!! Form::open(['method' => 'POST','url' => ['/system/update']]) !!}
                @csrf
                <div class="box-body">
                    <div class="custom-control custom-switch">
                        <input name="active" value="1" type="checkbox" class="custom-control-input" id="active" {{ $shared->active == 1 ? 'checked' : ''}}>
                        <label class="custom-control-label" for="active">{{ __('Shared Shuttles') }}</label>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" id="save" class="btn btn-primary">{{ __('Update') }} <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
