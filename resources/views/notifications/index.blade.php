@extends('layouts.app2')
@section('title', trans('globals.notifications'))

@section('content')
<br>
<div class="container">
    <h3>
        @lang('globals.notifications')
        <small class="text-muted">
            @if ($count = Auth::user()->unreadNotifications->count())
            (@lang('globals.unread')
            <span class="badge badge-primary">
                {{ $count }}
            </span>)
            @endif
        </small>
    </h3>
    <hr>
    <ul class="list-group list-group-flush">
            @foreach ($notifications as $notification)
                <li class="list-group-item {{ $notification->read_at === null ? 'list-group-item-primary' : ''}}">
                   @lang('globals.has_won_auction'): @lang('globals.from') <strong>{{ $notification->data['auction_from']}}</strong>  @lang('globals.to') <strong>{{ $notification->data['auction_to']}}</strong> 
                   @if ($notification->read_at === null) 
                        <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}" class="pull-right">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="@lang('globals.delete')"><i class="fa fa-times"></i></button>
                        </form>
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="pull-right">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <button class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="@lang('globals.see')"><i class="fa fa-check"></i></button>
                        </form>
                        
                    @else
                        
                        <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}" class="pull-right">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="@lang('globals.delete')"><i class="fa fa-times"></i></button>
                        </form>
                        
                        <a class="btn btn-primary btn-sm pull-right mr-1" href="{{ route('notifications.show', $notification->data['id']) }}" data-toggle="tooltip" data-placement="top" title="@lang('globals.see')"><i class="fa fa-check"></i></a> 
                    @endif
                </li>
            @endforeach
            
        </ul>
</div>
@endsection