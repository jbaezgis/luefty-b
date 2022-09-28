@extends('layouts.app2')

@section('content')
<div class="container">
		@if( session()->has('updated') )
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{!! session('updated') !!}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		@endif
		<br>
		<div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-body">
                        @if (Config::get('app.locale') == 'en')
                        <h4><span class="font-weight-light">{{__('Auction type')}}:</span> {{ $auction->category->name }}	<a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </a></h4>
                        {{-- <p>{!! $auction->category->Description !!}</p> --}}
                        @else
                        <h4><span class="font-weight-light">{{__('Auction type')}}:</span> {{ $auction->category->es_name }}	<a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </a></h4>
                        {{-- <p>{!! $auction->category->es_description !!}</p> --}}
                        @endif

                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                        @if (Config::get('app.locale') == 'en')
                                        {!! $auction->category->Description !!}
                                        @else
                                        {!! $auction->category->es_description !!}
                                        @endif
                                </div>
                            </div>

                        <br>
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oopps!</strong> {{ trans('pages.message_error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                @foreach ($errors->all() as $error)
                                        <small id="nameErrors" class="form-text">{{ $error }}</small>
                                @endforeach
                            </div>
                        @endif

                        <div class="alert alert-success d-none" id="msg_div">
                            <span id="res_message"></span>
                        </div>

                        <!-- Start form -->
                        {!! Form::model($auction, [
                            'method' => 'PATCH',
                            'url' => ['/myauctions', $auction->id],
                            'id' => 'main_form',
                            'class' => 'form-horizontal needs-validation',
                            'novalidate'

                        ]) !!}

                        {{-- Private transfer --}}
                        @if ($auction->category->code == 'private')
                            @include ('myauctions.forms.private_transfer', ['formMode' => 'edit'])

                        {{-- Shared Shuttle --}}
                        @elseif ($auction->category->code == 'shared')
                            @include ('myauctions.forms.shared_shuttle', ['formMode' => 'edit'])

                        {{-- Contract transfer --}}
                        @elseif ($auction->category->code == 'contract')
                            @include ('myauctions.forms.contract_transfer', ['formMode' => 'edit'])

                        {{-- Tours and Excursions --}}
                        @elseif ($auction->category->code == 'tours')

                        {{-- Hotels and Apartments --}}
                        @elseif ($auction->category->code == 'hotels')

                        {{-- Charter Airplanes --}}
                        @elseif ($auction->category->code == 'charter')

                        @endif

                    </div>{{-- end box-body --}}
                    <div class="box-footer">
                        <a href="{{ url('myauctions/'.$auction->id.'/first_step') }}" class="btn btn-light"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>

                        <button type="submit" id="save" class="btn btn-primary pull-right ml-1">
                            {{__('Save')}}
                        </button>

                    {!! Form::close() !!}
                        <!-- End edit form -->

                        {{-- Cancel button --}}
                        {{-- {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/myauctions', $auction->id],
                            'style' => 'display:inline',
                            'id' => 'auction'
                        ]) !!}
                            <button id="send_form" type="submit" class="btn btn-light" title="{{ __('Cancel')}}">{{__('Cancel')}}</button>
                        {!! Form::close() !!} --}}

                    </div>{{-- end box-footer --}}
                </div> {{-- end box --}}
            </div>{{-- end col-md-12 --}}
        </div>{{-- end row --}}
</div>

@endsection

@section('scripts')

{{-- Scripts for From and To --}}
{{-- <script>
	$(document).ready(function(){

		$('select[name="from_city"]').on('change', function(){

			var from_city = $(this).val();
			if(from_city){
				// console.log(from_city);
				$.ajax({
					url: '/from_locations/'+from_city,
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// console.log(data);
						$('#from_location').empty();
						$('#from_location').append('<option value="" disable="true" selected="true">Select Location</option>');

						$.each(data, function(index, from_locationObj){
							$('#from_location').append('<option value="'+ from_locationObj.id +'">' + from_locationObj.name + '</option>');
						})
					}
				});
			}
		});

		$('select[name="to_city"]').on('change', function(){

			var to_city = $(this).val();
			if(to_city){
				// console.log(to_city);
				$.ajax({
					url: '/to_locations/'+to_city,
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// console.log(data);
						$('#to_location').empty();
						$('#to_location').append('<option value="" disable="true" selected="true">Select Location</option>');

						$.each(data, function(index, to_locationObj){
							$('#to_location').append('<option value="'+ to_locationObj.id +'">' + to_locationObj.name + '</option>');
						})
					}
				});
			}
		});

	});
</script> --}}

{{-- Scripts for form validation --}}
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
