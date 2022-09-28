@extends('layouts.app2')
@section('title', __('Favorites'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

<br>

<div class="container">

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">
        @include('auth.leftbar')
      </div>

      <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('My favorites users') }}</h3>

            </div>
            <div class="box-body">
                <table class="table">
                    <tbody>
                        @foreach ($users as $item)
                            @if (auth()->user()->following->contains($item->profile->id))
                                <tr>
                                    <td scope="row">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <a class="text-decoration-none" href="{{ url('/users/' . $item->id) }}"><strong><span class="text-capitalize">{{ $item->name }}</span></strong></a>
                                        </div>
                                        <div class="col-md-12">
                                            <small class="text-muted">

                                            <strong>{{ __('Company')}}</strong>: <span class="text-primary">{{ $item->company_name}}</span> |
                                            <strong>{{ __('User Type')}}</strong>: <span class="text-primary">{{ $item->userType->name}}</span>

                                            @if ($auctions->where('user_id', $item->id)->count())
                                            |
                                                <strong>{{ __('Auctions')}}</strong>: <span class="text-primary">{{ $auctions->where('user_id', $item->id)->count() }}</span>
                                            @endif

                                            </small>
                                        </div>
                                        </div>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
</div>
@endsection

