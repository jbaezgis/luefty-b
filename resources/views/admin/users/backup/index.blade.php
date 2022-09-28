@extends('layouts.admin.admin')
@section('title', __('Users'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Users')}}</h2>
        </div>
    </div>
    <hr>
    <span>{{__('All users')}}: <strong></strong></span>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <table id="users" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Country')}}</th>
                        <th>{{__('Region')}}</th>
                        <th>{{__('Agreement')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                        <tr>
                            <td>{{$item->id }}</td>
                            <td>{{$item->name }}</td>
                            <td>{{$item->email }}</td>
                            <td>{{$item->phone }}</td>
                            <td>{{$item->country->en_name}}</td>
                            <td>{{$item->region->name}}</td>
                            <td>
                                @if ($item->contract == 1)
                                    <span class="badge badge-success">
                                        <small>{{__('Signed')}} <i class="fa fa-check" aria-hidden="true"></i></small>
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <small>{{__('Unsigned')}} <i class="fa fa-times" aria-hidden="true"></i></small>
                                    </span>
                                    
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Country')}}</th>
                        <th>{{__('Region')}}</th>
                        <th>{{__('Agreement')}}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-2">
        <h2>{{__('Users')}} </h2>
    </div>
    @foreach ($users as $item)
        <div class="card mb-2">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        
                        <h4>{{$item->name}}</h4>

                        <div class="d-flex flex-row mb-1">
                            <div class="px-1">
                                <small class="text-muted">{{__('ID')}}: <span class="text-primary">{{$item->id}}</span></small>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Registration date')}}: <span class="text-primary">{{ date('l j, F Y', strtotime($item->registration_date)) }}</span></small><br>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Email')}}: <span class="text-primary">{{$item->email}}</span></small>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Company')}}: <span class="text-primary">{{ $item->company_name }}</span></small><br>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Phone')}}: <span class="text-primary">{{ $item->phone }}</span></small><br>
                            </div>
                           
                        </div>
                        <div class="d-flex flex-row mb-1">
                            <div class="px-1">
                                <small class="text-muted">{{__('Country')}}: 
                                    @if($item->country_id)
                                        <span class="text-primary">{{$item->country->en_name}}</span>
                                    @else
                                        <span class="text-danger">{{__('Does not have')}}</span>
                                    @endif
                                </small>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Region')}}: 
                                    @if($item->region_id)
                                        {{-- <span class="text-primary">{{$item->region->name}}</span> --}}
                                        <span class="text-success">{{__('Has region')}}</span>
                                    @else
                                        <span class="text-danger">{{__('Does not have')}}</span>
                                    @endif
                                </small><br>
                            </div>
                            <div class="px-1">
                                <small class="text-muted">{{__('Location')}}: 
                                    @if($item->location_id)
                                        {{-- <span class="text-primary">{{ $item->location->name }}</span> --}}
                                        <span class="text-success">{{__('Has location')}}</span>
                                    @else
                                        <span class="text-danger">{{__('Does not have')}}</span>
                                    @endif
                                </small><br>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                @if ($item->contract == 1)
                                    <div class="alert alert-success py-1 px-2" role="alert">
                                        <small>{{__('Signed agreement')}} <i class="fa fa-check" aria-hidden="true"></i></small>
                                    </div>
                                @else
                                    <div class="alert alert-danger py-1 px-2" role="alert">
                                        <small>{{__('Unsigned agreement')}} <i class="fa fa-times" aria-hidden="true"></i></small>
                                    </div>
                                    
                                @endif
                            </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="card-footer p-1">
                <a class="btn btn-light btn-sm" href="{{ url('/administration/users/' . $item->id) }}" title="{{__('Open Tour')}}"><i class="fa fa-eye" aria-hidden="true"></i> {{__('Open')}}</a>
                <a class="btn btn-light btn-sm" href="{{ url('/administration/users/' . $item->id . '/edit') }}" title="{{__('Edit Tour')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</a>
                @if (auth()->user()->isAdmin == true)
                {!! Form::open([
                    'method' => 'DELETE',
                    'url' => ['administration/users', $item->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . __('Delete'), array(
                            'type' => 'submit',
                            'class' => 'btn btn-light btn-sm text-danger',
                            'title' => 'Delete Tour',
                            'onclick'=>'return confirm("Are you sure you want to delete this User?")'
                    )) !!}
                {!! Form::close() !!}
                @endif
            </div>
            
        </div>
        
    @endforeach

    <div class="pagination"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>

</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#users').DataTable();
} );
</script>
@endsection
