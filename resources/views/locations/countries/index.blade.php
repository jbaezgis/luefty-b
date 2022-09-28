@extends('layouts.admin.admin')

@section('content')
<p></p>
<div class="container">
    <h1>{{__('Countries')}}</h1>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('countries.create')}} " class="btn btn-primary btn-sm">{{__('Add Country')}} </a>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{__('Image')}}</th>
                        {{-- <th>{{__('Code')}}</th> --}}
                        <th>{{__('Name')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $item)
                        <tr>
                            <td scope="row">
                                <img src="{{asset('storage/images/countries/'.$item->id.'/thumb/'.$item->image)}}" height="50"alt="{{$item->image}}">
                            </td>
                            {{-- <td>{{ $item->code }}</td> --}}
                            <td>{{ $item->en_name }}</td>
                            {{-- <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1"></label>
                                </div>
                            </td> --}}
                            <td>
                                <a href="{{ url('locations/countries/' .$item->id.'/show') }}" class="btn btn-light btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{ url('locations/countries/' .$item->id.'/edit') }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="{{ url('locations/' .$item->id.'/regions') }} " class="btn btn-primary btn-sm"><i class="fa fa-map-marker" aria-hidden="true"></i> {{__('Regions')}} </a>
                                {{-- {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/countries', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => __('Delete Price'),
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
            <div class="pagination"> {!! $countries->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
    </div>

</div>

@endsection
