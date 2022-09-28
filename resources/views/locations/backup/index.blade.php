@extends('layouts.admin.admin')

@section('content')
<br>
<div class="container">
    <a href="{{route('countries.index')}} " class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}}</a>

    <hr>
        <div class="col-md-12">
            <h1>{{__('Regions')}} <small>({{$country->en_name}})</small></h1>
        </div>
    <hr>

    {{-- Service Variation --}}

    <div class="card">
        {{-- <div class="card-header">
            {{__('Regions')}}
        </div> --}}
        <div class="card-body">
            <a href="{{ route('countries.create')}} " class="btn btn-primary btn-sm">{{__('Add Region')}} </a>
            <hr>
            {!! Form::open(['url' => ['/countries/region/store'], 'id' => 'create_form', 'class' => 'form-horizontal needs-validation','novalidate']) !!}
            <div class="row">
                {{-- Hiddend fields --}}
                {{ Form::hidden('country_id', $country->id) }}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <div class="invalid-feedback">
                            {{ __('Name is required') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div> {{-- /col --}}

                <div class="col-md-2" style="padding-top: 35px;">
                    <button type="submit" id="save" class="btn btn-primary btn-block btn-sm">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{__('Add')}}
                    </button>
                </div> {{-- /col --}}
            </div>{{-- /row --}}
            {!! Form::close() !!}
            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        {{-- <th>{{__('Order')}}</th>
                        <th>{{__('Is Airport')}}</th> --}}
                        {{-- <th>{{ __('Places')}} </th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regions as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            {{-- <td>{{$item->order}} </td> --}}
                            {{-- <td>
                                @if ($item->is_airport == 1)
                                    <span class="badge badge-primary">{{__('Yes')}} </span>
                                @endif
                            </td> --}}
                            {{-- <td>{{ $item->places->count() }} </td> --}}
                            <td>
                                <a href="{{ url('countries/' .$item->id.'/locations') }} " class="btn btn-primary btn-sm"><i class="fa fa-map-marker" aria-hidden="true"></i> {{__('Locations')}} </a>
                                <a href="{{ url('countries/' .$item->id.'/edit') }} " class="btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/countries/region/delete', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Delete Region'),
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="pagination"> {!! $regions->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
    </div>

</div>

@endsection