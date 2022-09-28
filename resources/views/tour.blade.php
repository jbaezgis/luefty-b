@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{url('/')}} " class="btn btn-light"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Back')}}</a>
        </div>
    </div>
    <br>

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="mb-2 shadow">
                <img src="{{URL::asset('storage/images/tours/'. $tour->image)}}" class="img-fluid" alt="{{$tour->image}}">
            </div>
        </div>
        <div class="col-md-6">
            {{-- <div class="d-flex">
                <div class="p-2 flex-fill"><span class="badge badge-primary"> {{$tour->type}} </span></div>
                <div class="p-2 flex-fill">
                </div>
            </div> --}}
            <a href="#" class="btn btn-light btn-sm"><i class="fa fa-share" aria-hidden="true"></i> {{__('Share Tour')}} </a>
            <h2 class="">{{$tour->title}}</h2>
            <small class="text-muted"><i class="fa fa-globe" aria-hidden="true"></i> {{ $tour->attraction->title }}, {{ $tour->location->country->en_name }}</small>
            <hr>
                <div class="d-flex">
                    <div class="p-2 flex-fill">
                        <small class="text-muted">{{__('DURATION')}}</small><br>
                        <span>{{$tour->duration}}</span>
                    </div>
                    <div class="p-2 flex-fill">
                        <small class="text-muted">{{__('AVAILABILITY')}}</small><br>
                        <span>{{__('All Months')}}</span>
                    </div>
                    <div class="p-2 flex-fill">
                        <small class="text-muted">{{__('DEPARTURE LOCATION')}}</small><br>
                        <span>{{$tour->depLocation->name}}</span>
                    </div>
                    <div class="p-2 flex-fill">
                        <small class="text-muted">{{__('DEPARTURE TIME')}}</small><br>
                        <span>{{ date('g:i A', strtotime($tour->departure_time)) }}</span>
                    </div>
                </div>
            <hr>
            <div class="d-flex">
                <div class="p-2 mr-4">
                    <span class="text-muted">{{__('Adults')}}</span><br>
                    <h2 class="">${{ number_format($tour->adults_price, 2, '.', ',') }}</h2>
                </div>
                <div class="p-2">
                    <span class="text-muted">{{__('Children')}}</span><br>
                    <h2 class="">${{ number_format($tour->children_price, 2, '.', ',') }}</h2>
                </div>
                {{-- <div class="p-2 flex-fill">
                    <a href="#" class="btn btn-warning pull-right"><i class="fa fa-phone" aria-hidden="true"></i> {{__('CALL FOR PRICE')}} </a>
                </div> --}}
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 text-center bg-light py-3 border-bottom mb-3">
            <div class="images">
                @foreach ($tour->images as $image)

                    <a class="" data-toggle="modal" data-target="#photo{{$image->id}}">
                        <img src="{{URL::asset('storage/images/tours/'. $tour->id .'/'. $image->file_name)}}" width="100" class="rounded" alt="{{$image->file_name}}">
                    </a>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="photo{{$image->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <img src="{{URL::asset('storage/images/tours/'. $tour->id .'/'. $image->file_name)}}" class="img-fluid" alt="{{$image->file_name}}">
                            {{-- <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div> --}}
                            {{-- <div class="modal-body">
                                ...
                            </div> --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <small class="card-text"><span class="text-muted">{{$post->locationid->name}}</span></small> --}}

    {{-- <hr> --}}
    <div class="row">
        <div class="col-md-8">
            {!! $tour->description !!}
        </div>

        <div class="col-md-4">
            <div class="bg-light border">
                <div class="mb-2">
                    <div class="mb-3 bg-primary">
                        <h4 class="p-2">{{__('Booking form')}} </h4>
                    </div>
                    <div class="p-2">
                        <!-- Start form -->
                        {!! Form::open(['url' => 'tours/reservation', 'class' => 'form-horizontal']) !!}

                            {{ Form::hidden('tour_id', $tour->id) }}

                            <div class="form-group">
                                <div class="{{ $errors->has('name') ? ' has-error' : ''}}">
                                    {!! Form::label('name', __('Name'), ['class' => 'control-label']) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="{{ $errors->has('email') ? ' has-error' : ''}}">
                                    {!! Form::label('email', __('email'), ['class' => 'control-label']) !!}
                                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="{{ $errors->has('phone') ? ' has-error' : ''}}">
                                    {!! Form::label('phone', __('Phone'), ['class' => 'control-label']) !!}
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary" data-submit-value="Please wait...">{{__('Submit')}}</button>
                        {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>
{{-- /container --}}
@endsection

@section('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();
    </script>
@endsection