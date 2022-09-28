@extends('layouts.admin.admin')
@section('title', __('Users'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')

<div class="container-fluid">
    @if (Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }}
            </div>
        </div>
    @endif 
    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>{{__('Users')}}</h2>
        </div>
    </div>
    <hr>
    <span>{{__('All users')}}: <strong>{{$users->count()}}</strong></span> |
    <span class="badge badge-success">{{__('Agreement Signed ')}}: <strong>{{$signed}}</strong></span> |
    <span class="badge badge-warning">{{__('Agreement Unsigned')}}: <strong>{{$unsigned}}</strong></span>
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
                        <th>{{__('Company')}}</th>
                        <th>{{__('Country')}}</th>
                        <th>{{__('Region')}}</th>
                        <th>{{__('Verified at')}}</th>
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
                            <td>{{$item->company_name }}</td>
                            <td>{{$item->country['en_name']}}</td>
                            <td>{{$item->region['name']}}</td>
                            <td>{{ date('Y-m-j', strtotime($item->email_verified_at)) }}</td>
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
                            <td>
                                <a class="btn btn-secondary btn-sm" href="{{ url('/administration/users/' . $item->id) }}" title="{{__('Open User')}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                {!! Form::open([
                                    'method' => 'PATCH',
                                    'url' => ['/manage/users/changepassword', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-warning btn-sm',
                                            'title' => 'Change password to 123456',
                                            'onclick'=>'return confirm("Are you sure?")'
                                    )) !!}
                                {!! Form::close() !!}
                                @if($item->email_verified_at == NULL)
                                    {!! Form::open([
                                        'method' => 'PATCH',
                                        'url' => ['/manage/users/verificate', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-success btn-sm',
                                                'title' => 'Verificate User',
                                                'onclick'=>'return confirm("Are you sure?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                @endif
                                {{-- <a class="btn btn-primary btn-sm" href="{{ url('/administration/users/' . $item->id . '/edit') }}" title="{{__('Edit Tour')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @if (auth()->user()->isAdmin == true)
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['administration/users', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Tour',
                                            'onclick'=>'return confirm("Are you sure you want to delete this User?")'
                                    )) !!}
                                {!! Form::close() !!}
                                @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>{{__('ID')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Company')}}</th>
                        <th>{{__('Country')}}</th>
                        <th>{{__('Region')}}</th>
                        <th>{{__('Agreement')}}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#users').DataTable();
} );
</script>
@endsection
