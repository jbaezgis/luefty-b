@extends('layouts.admin.admin')
@section('title', __('Manage Tours'))

@section('content')
<p> </p>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{__('Tours')}} </h1>
        </div>
    </div>
    {{-- Tours --}}
    <div class="row">
        <div class="col-md-3">
            @include('layouts.admin.sidebar')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <h1>{{__('Tours')}} </h1>
                </div>
                <div class="col-md-6 text-right">
                    
                    <a href="{{url('administration/content/tours/create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> {{__('Add Tour')}} </a>
                </div>
            </div>
            
            @foreach($tours as $item)
                <div class="card mb-2">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <img class="card-img" src="{{URL::asset('storage/images/tours/'. $item->image)}}" alt="{{$item->image}}">
                        </div>

                        <div class="col-md-10">

                            <div class="card-body">
                                <div class="d-flex flex-row mb-1">
                                    <div class="px-1">
                                        <small class="text-muted">{{__('ID')}}: <span class="text-primary">{{$item->id}}</span></small>
                                    </div>
                                    <div class="px-1">
                                        <small class="text-muted">{{__('Location')}}: <span class="text-primary">{{$item->location->name}}</span></small><br>
                                    </div>
                                    <div class="px-1">
                                        <small class="text-muted">{{__('Attraction')}}: <span class="text-primary">{{$item->attraction->title }}</span></small><br>
                                    </div>
                                </div>
                                
                                <h4>{{$item->title}}</h4>
                                {{-- <span>{!!$item->description!!}</span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                        <a class="btn btn-light btn-sm" href="{{ url('/administration/content/tours/' . $item->id) }}" title="{{__('Open Tour')}}"><i class="fa fa-eye" aria-hidden="true"></i> {{__('Open')}}</a>
                        <a class="btn btn-light btn-sm" href="{{ url('/administration/content/tours/' . $item->id . '/edit') }}" title="{{__('Edit Tour')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</a>
                        @if (auth()->user()->isAdmin == true)
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['administration/content/tours', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . __('Delete'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-light btn-sm text-danger',
                                    'title' => 'Delete Tour',
                                    'onclick'=>'return confirm("Are you sure you want to delete this Tour?")'
                            )) !!}
                        {!! Form::close() !!}
                        @endif
                    </div>
                    
                </div>
            @endforeach
            <div class="pagination"> {!! $tours->appends(['search' => Request::get('search')])->render() !!} </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var myCollapse = document.getElementById('multiCollapseExample1')
    var bsCollapse = new bootstrap.Collapse(myCollapse, {
    toggle: false
    })
</script>
@endsection
