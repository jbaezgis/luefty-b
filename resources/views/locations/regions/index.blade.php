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
            <a href="{{ url('locations/'.$country->id.'/regions/create')}} " class="btn btn-primary btn-sm">{{__('Add Region')}} </a>
            <br>
            {{__('If you want to add new locations')}} <a href="{{ url('administration/content/locations')}} " class="btn btn-light btn-sm">{{__('Click here')}} </a>
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
                                <a href="{{ url('locations/regions/' .$item->id.'/show') }}" class="btn btn-light btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                {{-- <a href="{{ url('locations/' .$item->id.'/locations') }} " class="btn btn-primary btn-sm"><i class="fa fa-map-marker" aria-hidden="true"></i> {{__('Locations')}} </a> --}}
                                <a href="{{ url('locations/regions/' .$item->id.'/edit') }} " class="btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                {{-- {!! Form::open([
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
                                {!! Form::close() !!} --}}
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
