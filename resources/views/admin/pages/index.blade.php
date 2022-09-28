@extends('layouts.admin.admin')

@section('content')

    <div class="container">
        <div class="row">
            
        <div class="col-md-3">
            @include('layouts.admin.sidebar')
        </div>

        <div class="col-md-9">
                <br>
                <h3>{{__('Page') }}s</h3>
                <br>
                {!! Form::open(['method' => 'GET', 'url' => 'administration/content/pages/', 'class' => 'form-inline ', 'role' => 'search'])  !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                {!! Form::close() !!}
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                {{-- <th>{{ __('Code') }}</th> --}}
                                <th>{{ __('Title') }}</th>
                                {{-- <th>{{ __('Location') }}</th> --}}
                                <th>{{ __('Lang') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $item)
                            <tr>
                                {{-- <td>{{ $item->code }}</td> --}}
                                <td>{{ $item->title }}</td>
                                {{-- <td>Location</td> --}}
                                    <td>
                                        @if ($item->lang == 'en')
                                            <span class="flag-icon flag-icon-us"></span> EN
                                        @elseif ($item->lang == 'es')
                                            <span class="flag-icon flag-icon-es"></span> ES
                                        @endif
                                    </td>
                                <td>
                                    <a href="{{ url('administration/content/pages/' . $item->id) }}" title="View Page"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('administration/content/pages/' . $item->id . '/edit') }}" title="Edit Page"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    {{-- {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/pages', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Page',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!} --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $pages->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
    </div>
@endsection
