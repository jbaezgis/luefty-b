@extends('layouts.app2')

@section('content')
@section('starting_bid')
    {{ $percentage = $auction->servicePrice->starting_bid * 0.10 }}
    {{ $starting_bid = $auction->servicePrice->starting_bid + $percentage }}
    {{ $total = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
    {{ $total_booking = $auction->order_total + $extras->sum('total')}}
    {{ $total_auction = $auction->servicePrice->starting_bid + $percentage + $extras->sum('total')}}
    {{ $extras_total = $extras->sum('total')}}
@endsection
<br>
<div class="container">
    <p></p> 
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                <a class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                <a class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                <a class="btn btn-light text-primary">{{__('Extras')}}</a>
            </div>
        </div>
    </div>
    <p></p>

    <div class="col-md-12 text-center">
        <div class="card">
            <div class="card-body">
                <h4>{{$auction->full_name}}</h4>
                <p class="text-muted">{{__('Email')}}: <span class="text-primary">{{$auction->email}}</span> | {{__('Phone')}}: <span class="text-primary">{{$auction->phone}}</span></p>
            </div>
        </div>
    </div>
    <p></p>
    {{-- Function for driving time --}}
    
    {{-- @include('bookings.top_texts') --}}
    
    <div class="row">
        
        @include('bookings.left_column')

        {{-- Form --}}
        <div class="col-md-8">
            <div class="card border-primary">
                <div class="card-header bg-primary font-weight-bolder ">
                    <h4 class="card-title">{{__('Please add any extras')}}</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-wheelchair fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>Wheelchair <small>(folding type only)</small></h5>
                            <span class="text-info">€ 7.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Plase note that disabled passengers must be able to board the vehicle independently or with the assistance of those in their party.
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="Wheelchair">
                                        <input type="hidden" name="price" value="7">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-clock-o fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>5 min extra stop in same town</h5>
                            <span class="text-info">€ 15.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Ideal if you need to collect/drop off keys or if your group will be staying at more than one accommodation address.
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="5 min extra">
                                        <input type="hidden" name="price" value="15">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-child fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>Child seat</h5>
                            <span class="text-info">€ 7.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Suitable for toddlers weighing 9-18 kg (approx 1 to 6 years)
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="Child seat">
                                        <input type="hidden" name="price" value="7">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row">
                        <div class="p-2"><i class="fa fa-child fa-lg text-info" aria-hidden="true"></i></div>
                        <div class="p-2">
                            <h5>Booster seat</h5>
                            <span class="text-info">€ 7.00 each way</span>

                            <div class="d-flex flex-row">
                                <div class="p-2 flex-grow-1">
                                    <small>
                                        Suitable for children weighing 15-36 kg (approx 4 to 12 years)
                                    </small>
                                </div>
                                <div class="p-2 flex-grow-2">
                                    {{-- <small>{{ __('Outward')}} </small> --}}
                                    {!! Form::open(['method' => 'POST', 'url' => '/extras', 'class' => ''])  !!}
                                        <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                        <input type="hidden" name="name" value="Booster seat">
                                        <input type="hidden" name="price" value="7">
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" onchange="this.form.submit()">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- card-body -->
                <div class="card-footer d-sm-none mb-3 bg-white">
                    
                    {{-- <div class="d-flex flex-row">
                        
                        <div class="p-2 bd-highlight">

                            @if ($auction->category_id == 7)
                                <small class="text-muted">{{__('Vehicle price:')}}</small><br>
                                <strong>$ {{ number_format($auction->order_total, 2, '.', ',') }}</strong><br>
                            @endif

                            @if ($extras->count() > 0)
                                <small class="text-muted">{{__('Extras:')}}</small><br>
                                @foreach ($extras as $extra)
                                    <strong>{{ $extra->name }}</strong>: $ {{ number_format($extra->total, 2, '.', ',') }}
                                    {!! Form::open(['method' => 'DELETE', 'url' => ['/extras', $extra->id], 'style' => 'display:inline']) !!}
                                        
                                        {!! Form::button('<i class="fa fa-times text-danger" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn',
                                                'title' => __('Delete extra'),
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'top'
                                        )) !!}
                                    {!! Form::close() !!}
                                    <br>
                                @endforeach
                            @endif

                            @if ($auction->category_id == 7)
                                <hr>
                                <h4><small>{{__('Total')}}:</small> $ {{ number_format($total_booking, 2, '.', ',') }}</h4>
                            @elseif ($auction->extras->count())
                                <hr>
                                <h4><small>{{__('Total extras')}}:</small> $ {{ number_format($extras_total, 2, '.', ',') }}</h4>
                            @endif

                            
                        </div>
                    </div> --}}

                    <ul class="list-group list-group-flush">
                        @if ($auction->category_id == 7)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h5 class="my-0">{{__('Vehicle')}}</h5>
                                <span class="text-muted">Vehicle details</span>
                            </div>
                            <h5 class="text-muted">
                                ${{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                {{-- @if ($auction->category_id == 7)
                                @else
                                    ${{ number_format($auction->order_total, 2, '.', ',') }}<br>
                                @endif --}}
                            </h5>
                        </li>
                        @endif
                        @if ($extras->count() > 0)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h5 class="my-0">{{__('Extras')}}</h5>
                                @foreach ($extras as $extra)
                                    <span class="text-muted">{{ $extra->quantity }} - {{ $extra->name }} = ${{ number_format($extra->total, 2, '.', ',') }}</span> 
                                    {!! Form::open(['method' => 'DELETE', 'url' => ['/extras', $extra->id], 'style' => 'display:inline']) !!}
                                        
                                        {!! Form::button('<i class="fa fa-times text-danger" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn',
                                                'title' => __('Delete extra'),
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'top'
                                        )) !!}
                                    {!! Form::close() !!}
                                    <br>
                                @endforeach
                            </div>
                            @if ($auction->category_id == 7)
                            <h5 class="text-muted">${{ number_format($extras_total, 2, '.', ',') }}</span>
                            @endif
                        </li>
                        @endif
                        
                        <li class="list-group-item d-flex justify-content-between">
                            @if ($auction->category_id == 7)
                                <h5 >Total (USD)</span>
                                <h4>${{ number_format($total_booking, 2, '.', ',') }}</h4>
                            @else
                                @if ($extras->count() > 0)
                                <h5 >Total (USD)</span>
                                <h4>${{ number_format($extras_total, 2, '.', ',') }}</h4>
                                @endif
                            @endif
                        </li>
                      </ul>
                </div>
            </div><!-- card -->

            <div class="row justify-content-center">
                <div class="col-md-6 text-center pt-3">
                    @if ($auction->category_id == 7)
                        <a href="{{ url('booking/confirmation/'. $auction->key )}}" class="btn btn-primary">{{__('Save and continue')}} </a>

                        @if ($auction->extras->count())
                        @else
                            {{-- <a href="{{ url('booking/confirmation/'. $auction->key )}}" class="btn btn-warning">{{__('Skip and continue')}} </a> --}}
                        @endif
                    @else
                        {!! Form::open([
                            'method' => 'PATCH',
                            'url' => ['booking/assign/status', $auction->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button(__('Save and continue'), array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary',
                                    'title' => __('Save and continue')
                            )) !!}
                        {!! Form::close() !!}
                        {{-- <a href="{{ url('booking/assign/status/'.$auction->id)}}" class="btn btn-primary">{{__('Save and continue')}} </a> --}}
                        @if ($auction->extras->count())
                        @else
                            {{-- <a href="{{ url('booking/mybooking?'.'auction_id='.$auction->auction_id.'&email='.$auction->email)}}" class="btn btn-warning">{{__('Skip and continue')}} </a> --}}
                        @endif
                    @endif
                </div>
            </div>
        </div>

        
    </div>{{-- /row --}}


</div>

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
