@extends('layouts.app2')
@section('title', __('Edit Profile'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

<p></p>
<div class="container">
    <a href="{{ route('user.profile')}} " class="btn btn-light"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('Go back to Profile')}} </a>
    <p></p>
  @if (session()->has('info'))
    <div class="alert alert-success">
      {{ session('info') }}
    </div>
  @endif

  @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
  <!-- Main content -->
  <section class="content">

    <div class="row">      
      <div class="col-md-12">        
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Edit Profile') }}</h3>
              {{-- <div class="box-tools pull-right">
                <a href="#" class="btn btn-primary btn-sm">{{ __('Edit your profile')}} </a>  
              </div> --}}
            </div>
            <div class="box-body">
              <form action="post"></form>
              <div class="row">
                <div class="col-md-12">

                    <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data" >
                        {{ csrf_field()}}
                        @include ('auth.form')
                    </form>
                        
                        {{-- {!! Form::model( [
                            'method' => 'PATCH',
                            'url' => ['/profile/update', auth()->user()->id],
                            'class' => 'form-horizontal'
                        ]) !!}
                        
                
                        
                
                        {!! Form::close() !!} --}}
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
</div>
@endsection