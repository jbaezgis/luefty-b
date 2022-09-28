@extends('layouts.app2')

@section('content')
<br>
<div class="container mb-5">
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                <a class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                <a class="btn btn-light text-primary">{{__('Complete Form')}}</a>
                <a class="btn btn-light">{{__('Extras')}}</a>
            </div>
        </div>
    </div>
    <p></p>
    @include('bookings.top_texts') --}}
    <div class="row">
        
        @include('bookings.left_column')
        
        <div class="col-md-8">
            {{-- Form info --}}
            @if( session()->has('passengers_error') )
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="lead">{{ __('You selected a') }} <strong>{{$auction->vehicleType->type}}</strong> {{__('for a maximum of')}} <strong>{{$auction->vehicleType->max_passengers}}</strong> {{__('passengers')}}</p>
                    <hr>
                    <p>{{__('Select a different vehicle size or change the number of passengers')}}</p>
                    <a href="{{url('select_vehicle/'.$auction->key.'/edit')}} " class="btn btn-warning btn-sm">{{__('Vehicle List')}} </a> <br>
                    
                </div>
            @endif
            
            {!! Form::model($auction, ['method' => 'PATCH', 'url' => ['/booking/save', $auction->id], 'id' => 'main_form',
                'class' => 'form-horizontal needs-validation', 'novalidate']) !!}


                @include ('bookings.forms.airport_to_airport')
                @include ('bookings.forms.extras')
                {{-- <hr>
                @if ($extras->count() > 0)
                @else
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <div class="alert alert-primary" role="alert">
                            {{__('DON’T FORGET YOUR EXTRAS')}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                @endif --}}

                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <button class="btn btn-warning btn-block font-weight-bolder" type="submit" title="{{ __('Buy now at current bid')}}">{{ __('Continue')}} <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        {{-- <div class="card">
                            <div class="card-body text-center">
                                <h3 class="text-primary"> $ {{ number_format($total, 2, '.', ',') }}</h3>
                            </div>
                        </div> --}}
                    </div> {{-- /col --}}
                </div> {{-- /row --}}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->

    </div>

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
