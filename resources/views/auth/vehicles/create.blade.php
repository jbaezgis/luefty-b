@extends('layouts.app2')
@section('title', __('Add vehicle'))

@section('content')

<br>

<div class="container">

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-3">
        @include('auth.leftbar')
      </div>

      <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Add vehicle') }}</h3>

            </div>
            <div class="box-body">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::open(['url' => '/profile/vehicles', 'class' => 'form-horizontal needs-validation']) !!}

                    @include ('auth.vehicles.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
          </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
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
