@extends('layouts.admin.admin')
@section('title', __('Manage Whales'))

@section('content')
<p> </p>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{__('Whales')}} </h1>
        </div>
    </div>
    {{-- Whales --}}
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{url('administration/whales/create')}}" class="btn btn-primary">{{__('Create Whale')}} </a>
        </div>
        <div class="col-md-12">
            @foreach($whales as $item)
                <div class="card mb-2">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <img class="card-img" src="{{URL::asset('storage/images/whales/'. $item->image)}}" alt="{{$item->image}}">
                        </div>

                        <div class="col-md-10">

                            <div class="card-body">
                                <div class="d-flex flex-row mb-1">
                                    <div class="px-1">
                                        <small class="text-muted">{{__('ID')}}: <span class="text-primary">{{$item->id}}</span></small>
                                    </div>
                                    {{-- <div class="px-1">
                                        <small class="text-muted">{{__('Location')}}: <span class="text-primary">{{$item->locationid->name}}</span></small><br>
                                    </div> --}}
                                    {{-- <div class="px-1">
                                        <small class="text-muted">{{__('Booking ID')}}: <span class="text-primary">{{$item->service_number ? $item->service_number : $item->auction_id }}</span></small><br>
                                    </div> --}}
                                </div>
                                
                                <h2>{{$item->title}}</h2>
                                <h4>{{$item->name}}</h4>
                                <span>{!!$item->description!!}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                        <a class="btn btn-light btn-sm" href="{{ url('/administration/whales/' . $item->id) }}" title="{{__('Open Whale')}}"><i class="fa fa-eye" aria-hidden="true"></i> {{__('Open')}}</a>
                        <a class="btn btn-light btn-sm" href="{{ url('/administration/whales/' . $item->id . '/edit') }}" title="{{__('Edit Whale')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</a>
                        @if (auth()->user()->isAdmin == true)
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['administration/whales', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . __('Delete'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-light btn-sm text-danger',
                                    'title' => 'Delete Whale',
                                    'onclick'=>'return confirm("Are you sure you want to delete this Whale?")'
                            )) !!}
                        {!! Form::close() !!}
                        @endif
                    </div>
                    
                </div>
            @endforeach
            <div class="pagination"> {!! $whales->appends(['search' => Request::get('search')])->render() !!} </div>
            
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
