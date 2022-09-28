@extends('layouts.app2')
@section('title', __('Users'))

@section('content')
<br>
<div class="container">
<section class="content-header">
    <h1>{{__('Members')}}</h1>
</section>
<br>
{!! Form::open(['method' => 'GET', 'url' => 'users', 'class' => '', 'role' => 'search'])  !!}
    <div class="input-group">
        <input type="text" name="search" class="form-control pull-right" placeholder="{{__('Search')}}">

        <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
    </div>
{!! Form::close() !!}
<p></p>
<table class="table">
        <tbody>
            @foreach ($users as $item)
              <tr>
                <td scope="row">
                  <div class="row">
                    <div class="col-md-12">
                      <a class="text-decoration-none" href="{{ url('/users/' . $item->id) }}"><strong><span class="text-capitalize">{{ $item->name }}</span></strong></a>
                    </div>
                    <div class="col-md-12">
                      <small class="text-muted">

                        <strong>{{ __('Company')}}</strong>: <span class="text-primary">{{ $item->company_name}}</span>
                        |
                        <strong>{{ __('User Type')}}</strong>: <span class="text-primary">{{ $item->userType->name}}</span>

                        @if ($item->vehicles->count() > 0)
                        |
                            <strong>{{ __('Vehicles')}}</strong>: <span class="text-primary">{{ $item->vehicles->count() }}</span>
                        @endif

                        @if ($auctions->where('user_id', $item->id)->count())
                        |
                            <strong>{{ __('Auctions')}}</strong>: <span class="text-primary">{{ $auctions->where('user_id', $item->id)->count() }}</span>
                        @endif

                        @if (auth()->user()->following->contains($item->profile->id))
                        |
                        <span class="text-danger"><i class="fa fa-heart" aria-hidden="true"></i> {{ __('Added to my favorites')}} </span>

                        @endif

                      </small>
                    </div>
                  </div>

                </td>
              </tr>
            @endforeach
        </tbody>
      </table>

<div class="pagination"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
</div>
@endsection
