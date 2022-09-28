<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{-- <h4>{{ __('FROM - PICK UP LOCATION') }} <small>(Details in booking form)</small></h4> --}}
            <label for="to">{{ __('From') }}</label>
            {!! Form::select('from_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=> __('Select location'), 'class'=>'form-control select2 border-blue', 'required' ]) !!}
            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Location') }}
            </div>
        </div>{{-- /form-group --}}
    </div> {{-- /col --}}
    <div class="col-md-6">
        <div class="form-group">
            {{-- <h4>{{ __('TO - DROP OFF LOCATION') }} <small>(Details in booking form)</small></h4> --}}
            <label for="to">{{ __('To') }}</label>
            {!! Form::select('to_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=> __('Select location'), 'class'=>'form-control select2', 'onchange'=>'this.form.submit()' ]) !!}
            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Location') }}
            </div>
        </div>{{-- /form-group --}}
    </div> {{-- /col --}}
</div>{{-- /row --}}

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="driving_time">{{__('Driving Time')}}</label>
            <input type="number" class="form-control {{ $errors->has('driving_time') ? 'is-invalid' : '' }}" id="driving_time" name="driving_time" value="{{old('driving_time', $auction->driving_time)}}" aria-describedby="nameErrors" required>
            <small id="nameError" class="form-text text-danger">{{ $errors->first('driving_time') }} </small>
            <div class="invalid-feedback">
                {{ __('Driving time is required') }}
            </div>
        </div>{{-- /form-group --}}
    </div> {{-- /col --}}
    <div class="col-md-3">
        {!! Form::label('featured', __('Featured'), ['class' => 'control-label']) !!}
        {!! Form::select('featured', array('1' => 'Yes', '0' => 'No'), null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div> {{-- /row --}}
