@extends('layouts.app2')

@section('content')
{{-- <div class="container-title">
		<h2 class="page-title bg-primary"><i class="fa fa-car"></i> @lang('auctions.my_transfers')</h2>
	</div> --}}
    <br>
    <div class="container">
        {{-- Go back button --}}
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__('Go back')}}</a>
            </div>
        </div>
        <hr>

        {{-- Alerts --}}
        @if( session()->has('info') )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('info') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

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

        {{-- Form box --}}
		<div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Create new auction')}} </h3>
                    </div>
                    <form method="POST" action="{{ route('myauctions.store') }}" class="needs-validation" novalidate>
                        <div class="box-body">
                            @include('myauctions.forms.first_step')
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">
                                {{__('Continue')}} <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                            <a href="{{ url('/myauctions/privatetransfers/index') }}" class="btn btn-light">{{__('Cancel')}} </a>
                        </div>{{-- end box-footer --}}
                    </form>{{-- End form --}}
                </div>{{-- end box--}}
            </div>{{-- end col-md-12 --}}
		</div>{{-- end row--}}
</div>
@endsection

{{-- Scripts --}}
@section('scripts')
<script>
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
