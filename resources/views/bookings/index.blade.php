@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Start form -->
            {!! Form::open(['url' => ['/booking/store'], 'id' => 'booking_form', 'class' => 'form-horizontal needs-validation', 'novalidate']) !!}
                @include ('bookings.form')
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
