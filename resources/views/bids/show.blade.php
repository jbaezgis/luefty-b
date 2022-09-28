@extends('layouts.app2')
@section('title', trans('globals.bid'))

@section('content')
<br>
<div class="container">
    <h1>@lang('globals.you_won_this_bid')</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
                id: {{ $bid->id }}
                <h3>@lang('globals.from') <strong>{{ $bid->auction->from }}</strong> @lang('globals.to') <strong>{{ $$bid->auction->to }}</strong>
                    {{-- <small class=" {{ ($auction->status === 'Closed') ? 'text-success' : 'text-warning' }}"> - ({{ $auction->status }})</small> --}}
                    <span class="badge {{ ($$bid->auction->status === 'Closed') ? 'badge-success' : 'badge-warning' }}">{{ $$bid->auction->status }}</span>
                </h3>
        </div>
    </div>
</div>
@endsection