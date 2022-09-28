@extends('layouts.app2')
@section('title', __('My Vehicles'))

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
        @if (session()->has('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
        @endif
        @if (session()->has('deleted'))
            <div class="alert alert-warning">
            {{ session('deleted') }}
            </div>
        @endif
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('My Vehicles') }}</h3>
              <div class="box-tools pull-right">
                <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-sm">{{ __('Add vehicle')}} </a>
              </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <tbody>
                        @foreach ($vehicles as $item)
                            <tr>
                                <td scope="row">
                                    <div class="row">
                                    <div class="col-md-12">
                                        <p class="lead mb-1">
                                            <strong>{{ $item->brand }}</strong> {{ $item->model}}
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <small class="text-muted">
                                            <strong>{{ __('Type')}}</strong>: <span class="text-primary">{{ $item->type}}</span> |
                                            <strong>{{ __('Year')}}</strong>: <span class="text-primary">{{ $item->year}}</span> |
                                            <strong>{{ __('Seats')}}</strong>: <span class="text-primary">{{ $item->seats}}</span> |
                                            <strong>{{ __('Condition')}}</strong>: <span class="text-primary">{{ $item->condition}}</span> |
                                            <strong>{{ __('GPS Installed?')}}</strong>:
                                            @if($item->gps_installed === 1)
                                                <span class="text-primary">{{__('Yes')}}</span>
                                            @else
                                                <span class="text-primary">{{__('No')}}</span>
                                            @endif
                                        </small>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- <a href="{{ url('/admin/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                            <a href="{{ url('/profile/vehicles/' . $item->id . '/edit') }}" title="{{__('Edit Vehicle')}}"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/profile/vehicles', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => __('Delete Vehicle'),
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </td>
                            </tr>

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

