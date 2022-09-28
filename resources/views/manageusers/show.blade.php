@extends('layouts.app2')

@section('content')
<p></p>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/manage/users') }}" title="Back"><button class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/manage/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            {{-- {!! Form::open([
                'method' => 'PATCH',
                'url' => ['/manage/users/deactivate', $user->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>'.' '.__('Deactivate'), array(
                        'type' => 'submit',
                        'class' => 'btn btn-warning btn-sm',
                        'title' => __('Deactivate')
            
                ))!!}
            {!! Form::close() !!} --}}
            
            {!! Form::open([
                'method' => 'DELETE',
                'url' => ['/manage/users', $user->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete User',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
    
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    {{-- <img class="profile-user-img img-responsive rounded-circle" src="/uploads/avatars/{{ $user->avatar }}" alt="User profile picture"> --}}

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ __('User Type') }}: <strong>{{ $user->userType->name }} </strong> </p>

                    <p class="text-muted text-center">{{ __('Company') }}: <strong>{{ $user->company_name }} </strong></p>

                </div>
                <!-- /.box-body -->

                <div class="box-footer text-center">
                    @if ($user->public == 1 )
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Profile is Public. Other people can see your Profile.')}} "><small class="text-success">{{ __('Public')}} <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a></small>
                    @else
                        <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Profile is Private. Other users can not see your Profile')}} "><small class="text-primary">{{ __('Private')}} <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a></small>
                    @endif
                </div>
              </div>
              <!-- /.box -->

                <div class="list-group">
                    <li class="list-group-item list-group-item-action" data-toggle="tooltip" data-placement="right" title="{{ __('Your prifle information')}} ">{{ __('Profile')}} </li>
                    <li class="list-group-item list-group-item-action" data-toggle="tooltip" data-placement="right" title="{{ __('See the information of your vehicles')}} ">
                      {{ __('Vehicles')}}
                      <span class="badge badge-light badge-pill pull-right">{{ $user->vehicles->count() }}</span>
                    </li>
                    <li class="list-group-item list-group-item-action" data-toggle="tooltip" data-placement="right" title="{{ __('Suppliers and Agencies you added as favorites')}} ">
                        {{ __('Favorites')}}
                        <span class="badge badge-light badge-pill pull-right">{{ $user->following->count() }}</span>
                    </li>
                    <li class="list-group-item list-group-item-action " data-toggle="tooltip" data-placement="right" title="{{ __('Suppliers and Agencies that added you to their favorites')}}" >
                      {{ __('Followers')}}
                      <span class="badge badge-light badge-pill pull-right">{{ $user->profile->followers->count() }}</span>
                    </a>


                </div>
                <p></p>

              <!-- About Me Box -->
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-body">
                  
                  @if ($user->email_verified_at)
                  <h5 class="text-success text-center">{{ __('Active') }} </h5>
                    <p class="text-center">
                        {{-- <i class="fa fa-circle text-primary" aria-hidden="true"></i> <br> --}}
                        {{ __('Free Trial')}} <br>
                        <small class="text-muted"><strong>{{ __('Expires') }}</strong>: {{ date('l j, F Y', strtotime($user->next_payment)) }}</small>
                    </p>
                  @else
                  <h5 class="text-danger text-center">{{ __('Pending verification') }} </h5>
                  @endif


                </div>
                <!-- /.box-body -->
            </div>
              <!-- /.box -->
        </div>

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                          <small class="text-muted">{{ __('Address') }}
                          @if ($user->address_ispublic == 1 )
                            <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Address is public')}} "> <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a>
                          @else
                            <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Address is private')}} "> <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a>
                          @endif
                          </small>
                          <p>{{ $user->address }}</p>
                        </div>
                        <div class="col-md-4">
                          <small class="text-muted">{{ __('Location') }}</small>
                          <p>{{ $user->location['name'] }}</p>
                        </div>
                        <div class="col-md-4">
                          <small class="text-muted">{{ __('Country') }}</small>
                          <p>{{ $user->country['en_name'] }}</p>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-4">
                          <small class="text-muted">{{ __('Email') }}</small>
                          <p>{{ $user->email }}</p>
                        </div>
                        <div class="col-md-4">
                          <small class="text-muted">{{ __('Phone') }}
                            @if ($user->phone_ispublic == 1 )
                              <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Phone number is public')}} "> <i class="fa fa-check-circle text-success" aria-hidden="true"></i> </a>
                            @else
                              <a data-toggle="tooltip" data-placement="top" title="{{ __('Your Phone number is private')}} "> <i class="fa fa-lock text-primary" aria-hidden="true"></i> </a>
                            @endif
                          </small>
                          <p>{{ $user->phone }}</p>
                        </div>
                        <div class="col-md-4">
                          <small class="text-muted">{{ __('Web site') }}</small>
                          <p>{{ $user->web_site }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
                
@endsection
