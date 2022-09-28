
@csrf

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="title" class="mb-0">{{ __('Number')}} </label><br>
            <small>{{__('Service number.')}} </small>
            <input type="text" class="form-control {{ $errors->has('service_number') ? 'is-invalid' : '' }}" id="service_number" name="service_number" value="{{old('service_number', $auction->service_number)}}"  aria-describedby="service_numberErrors" required {{ $auction->changed === 1 ? 'readonly' : '' }}>
            <small id="service_numberErrors" class="form-text text-danger">{{ $errors->first('service_number') }}</small>
            <div class="invalid-feedback">
                {{ __('Service Number is required') }}
            </div>
        </div>

    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="date" class="mb-0">{{__('Start Date')}}</label><br>
            <small>{{__('Biginning of contract.')}} </small>
            <input type="text" class="form-control datepicker2 {{ $errors->has('start_date') ? 'is-invalid' : '' }}" id="start_date" name="start_date" value="{{old('start_date', $auction->start_date)}}"  aria-describedby="dateErrors" required>
            <small id="dayErrors" class="form-text text-danger">{{ $errors->first('start_date') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select Start of Date') }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="date" class="mb-0">{{__('End Date')}}</label><br>
            <small>{{__('End of contract.')}} </small>
            <input type="text" class="form-control datepicker2 {{ $errors->has('end_date') ? 'is-invalid' : '' }}" id="end_date" name="end_date" value="{{old('end_date', $auction->end_date)}}"  aria-describedby="end_dateErrors" required>
            <small id="dayErrors" class="form-text text-danger">{{ $errors->first('end_date') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select End of Date') }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="passengers" class="mb-0">{{ __('Passengers') }}</label>
            <br>
            <small>{{__('Estimate # of people.')}} </small>
            <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" value="{{old('passengers', $auction->passengers)}}"  aria-describedby="passengersErrors" placeholder="" required>
            <small id="passengersErrors" class="form-text text-danger">{{ $errors->first('passengers') }}</small>
            <div class="invalid-feedback">
                {{ __('Please enter # of people.') }}
            </div>
        </div>
    </div>
</div> {{-- end row --}}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="from" class="mb-0">{{__('From')}}</label><br>
            <small>{{__('Pick up location.')}} </small>
            {!! Form::select('from_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Main Location') }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="from" class="mb-0">{{__('To')}}</label><br>
            <small>{{__('Drop off location.')}} </small>
            {!! Form::select('to_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=>'', 'class'=>'form-control select2', 'required', 'required'  ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Main Location') }}
            </div>
        </div>
    </div>
</div>{{-- end row --}}




