
    <!-- /.box-header -->
        {{-- <div class="row">
            <div class="col-md-12 text-center">
                <h4>{{__('If you want you can choise another locations')}} </h4>
            </div>
        </div>
        <hr> --}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h4>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h4>
                    {{-- <label for="to">{{ __('From') }}</label> --}}
                    {!! Form::select('from_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=> __('Click for list or type first letters'), 'class'=>'form-control select2 border-blue', 'required' ]) !!}
                    <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
                    <div class="invalid-feedback">
                        {{ __('Please select a Location') }}
                    </div>
                </div>{{-- /form-group --}}
            </div> {{-- /col --}}
            <div class="col-md-6">
                <div class="form-group">
                    <h4>{{ __('TO - DROP OFF LOCATION') }} <small>(Details in booking form)</small></h4>
                    {{-- <label for="to">{{ __('To') }}</label> --}}
                    {!! Form::select('to_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=> __('Click for list or type first letters'), 'class'=>'form-control select2', 'onchange'=>'this.form.submit()' ]) !!}
                    <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
                    <div class="invalid-feedback">
                        {{ __('Please select a Location') }}
                    </div>
                </div>{{-- /form-group --}}
            </div> {{-- /col --}}
        </div>{{-- /row --}}
