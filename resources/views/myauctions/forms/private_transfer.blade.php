

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
    <div class="col-md-4">
        <div class="form-group">
            <label for="date" class="mb-0">{{__('Date')}}</label><br>
            <small>{{__('Date of service.')}} </small>
            <input type="text" class="form-control datepicker2 {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{old('date', $auction->date)}}"  aria-describedby="dateErrors" required>
            <small id="dayErrors" class="form-text text-danger">{{ $errors->first('date') }}</small>
            <div class="invalid-feedback">
                {{ __('The date must from today') }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="time" class="mb-0">{{__('Time')}}</label><br>
            <small>{{__('Pick up time.')}} </small>
            <input type="text" class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" id="time" name="time" value="{{old('time', $auction->time)}}"  aria-describedby="timeErrors" placeholder="">
            <div class="valid-feedback">
                {{ __('This field is optional.') }}
            </div>
        </div>
    </div>
</div> {{-- end row --}}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="from" class="mb-0">{{__('From')}}</label><br>
            <small>{{__('Pick up location.')}} </small>
            {!! Form::select('from_city', App\Location::where('country_id', auth()->user()->country_id)->where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
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
            {!! Form::select('to_city', App\Location::where('country_id', auth()->user()->country_id)->where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=>'', 'class'=>'form-control select2', 'required', 'required'  ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Main Location') }}
            </div>
        </div>
    </div>
</div>{{-- end row --}}

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="mb-0" for="starting_bid">{{ __('Starting bid') }}</label><br>
            <small>{{__('Per vehicle.')}} </small>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text">{{auth()->user()->country->currency_symbol}}</div>
                </div>
                <input type="number" class="form-control {{ $errors->has('starintg_bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="starting_bid" name="starting_bid" value="{{old('starting_bid', $auction->starting_bid)}}" required>
                <small id="starting_bidErrors" class="form-text text-danger">{{ $errors->first('starting_bid') }}</small>
                <div class="invalid-feedback">
                   {{ __('Plesae enter a Starting bid') }}
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="passengers" class="mb-0">{{ __('How many people?') }}</label>
            <br>
            <small>{{__('How many passengers?')}} </small>
            <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" value="{{old('passengers', $auction->passengers)}}"  aria-describedby="passengersErrors" placeholder="{{__('Optional')}} ">
            <small id="passengersErrors" class="form-text text-danger">{{ $errors->first('passengers') }}</small>
            <div class="valid-feedback">
                {{ __('This field is optional.') }}
            </div>
        </div>
    </div>

    {{-- <div class="col-md-5">
        <div class="form-group">
            <label for="vehicle_size" class="mb-0">{{__('Select')}}</label><br>
            <small>{{__('Vehicle.')}} </small>
            {!! Form::select('vehicle_size', App\Vehicle_list::orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'vehicle_size', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('vehicle_size') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select something') }}
            </div>
        </div>
    </div> --}}
</div>{{-- end row --}}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="more_information">{{ __('Enter flight data, vehicle size, pick up and drop off details, special needs, etc.')}}</label>
            <textarea class="form-control {{ $errors->has('more_information') ? 'is-invalid' : '' }}" id="more_information" name="more_information" aria-describedby="more_informationErrors">{{ old('more_information', $auction->more_information) }}</textarea>
            <small id="more_informationError" class="form-text text-danger">{{ $errors->first('more_information') }} </small>
            <div class="valid-feedback">
                {{ __('This field is optional') }}
            </div>
        </div>
    </div>
</div>



