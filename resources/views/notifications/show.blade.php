@extends('layouts.app2')
@section('title', trans('globals.bid'))

@section('content')
<br>
<div class="container">
    <a href="{{ route('notifications.index')}}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> @lang('globals.back')</a>
    <hr>
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('globals.has_won_auction')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                        <h3>@lang('globals.from') <strong>{{ $bid->auction->from }}</strong> @lang('globals.to') <strong>{{ $bid->auction->to }}</strong>
                        
                        </h3>
                        <p><strong>@lang('globals.date'):</strong> {{ date('F j, Y', strtotime($bid->auction->date)) }}</p> 
                        <p><strong>@lang('globals.time'):</strong> {{ date('g:i a', strtotime($bid->auction->time)) }}</p>
                        <p><strong>@lang('globals.pax'):</strong> {{ $bid->auction->passengers }} 
                        | <strong>@lang('globals.child_seats'):</strong> {{ $bid->auction->child_seats }}</p>
                        <p><strong>@lang('globals.details'):</strong> <br />
                            {!! $bid->auction->description !!}</p>
                        <p><strong>Extras:</strong> <br/>
                            @foreach ($bid->auction->extras as $extra)
                                <i class="fa fa-check text-primary"></i> {{ $extra->name }}&nbsp;
                            @endforeach
                        </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection