@extends('layouts.admin.admin')
@section('title', __('Posts'))
@section('keywords', 'Auctions, Travel, Tourism, Tours')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<p> </p>
<div class="container">
    {{-- Posts --}}
    <div class="row">

        <div class="col-md-3">
            @include('layouts.admin.sidebar')
        </div>

        <div class="col-md-9">
            
            <div class="row">
                <div class="col-md-6">
                    <h1>{{__('Sliders')}} </h1>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{url('administration/content/sliders/create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> {{__('Add slider')}} </a>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body py-3">
                            {!! Form::open(['method' => 'GET', 'url' => 'administration/content/sliders/', 'role' => 'search'])  !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="{{ $errors->has('search') ? ' has-error' : ''}}">
                                        {{-- {!! Form::label('search', __('search'), ['class' => 'control-label']) !!} --}}
                                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
                                        {!! $errors->first('search', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-5">
                                    {!! Form::select('location_id', App\Location::where('active', 1)->where('is_airport', NULL)->orderBy('name', 'asc')->pluck('name', 'id'), null, ['id'=>'location_id', 'placeholder'=>'Location', 'class'=>'form-control select2' ]) !!}
                                </div> --}}
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary ml-1" data-submit-value="Please wait...">{{__('Search')}}</button>
                                    <a href="{{url('administration/content/sliders/')}}" class="btn btn-warning ml-1"><i class="fa fa-repeat" aria-hidden="true"></i></a>
                                </div>
                            </div>    
        
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            @foreach($sliders as $item)
                <div class="card mb-2">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <img class="card-img" src="{{URL::asset('storage/images/sliders/'. $item->image)}}" alt="{{$item->image}}">
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
                                
                                <h4>{{$item->title}}</h4>
                                <span>{!!$item->description!!}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                        <a class="btn btn-light btn-sm" href="{{ url('/administration/content/sliders/' . $item->id) }}" title="{{__('Open Post')}}"><i class="fa fa-eye" aria-hidden="true"></i> {{__('Open')}}</a>
                        <a class="btn btn-light btn-sm" href="{{ url('/administration/content/sliders/' . $item->id . '/edit') }}" title="{{__('Edit Post')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('Edit')}}</a>
                        @if (auth()->user()->isAdmin == true)
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['administration/content/sliders', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ' . __('Delete'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-light btn-sm text-danger',
                                    'title' => 'Delete Post',
                                    'onclick'=>'return confirm("Are you sure you want to delete this Post?")'
                            )) !!}
                        {!! Form::close() !!}
                        @endif
                    </div>
                    
                </div>
            @endforeach
            <div class="pagination"> {!! $sliders->appends(['search' => Request::get('search')])->render() !!} </div>
            
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
