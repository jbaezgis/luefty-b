{{-- <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="{{ $errors->has('lang') ? ' has-error' : ''}}">
                    {!! Form::label('service_price_id', 'Service Price: ', ['class' => 'control-label']) !!}
                    <select class="form-control {{ $errors->has('lang') ? 'has-error' : '' }} select2" id="service_price_id" name="service_price_id">
                        @foreach ($services_prices as $item)
                            <option value="{{$item->id}}" {{ $auction->service_price_id == $item->id ? 'selected' : '' }}>{{$item->priceOption->name}} - {{$item->oneway_price}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>
<br> --}}

{{-- Basic info --}}
<div class="box box-solid box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">{{ __('Contact Details')}} </h4>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{__('Full name')}}</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="full_name" value="{{old('full_name', $auction->full_name)}}" aria-describedby="nameErrors" required>
                    <small id="nameError" class="form-text text-danger">{{ $errors->first('name') }} </small>
                    <div class="invalid-feedback">
                        {{ __('Full name is required') }}
                    </div>
                </div>{{-- /form-group --}}
            </div> {{-- /col --}}

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{__('Email')}}</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" email="email" value="{{ old('email', $auction->email) }}" aria-describedby="emailErrors" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    <small id="emailError" class="form-text text-danger">{{ $errors->first('email') }} </small>
                    <div class="invalid-feedback">
                        {{ __('Enter a valid email please') }}
                    </div>
                </div>{{-- /form-group --}}
            </div> {{-- /col --}}

        </div> {{-- /row --}}

        <div class="row">
            <div class="col-md-8">
                <label for="inputEmail4">{{ __('Phone') }}</label>
                <div class="input-group">
                    {{-- <div class="input-group-prepend">
                      <span class="input-group-text">{{__('Phone')}}</span>
                    </div> --}}
                    {{-- <input type="text" aria-label="First name" class="form-control"> --}}
                    {{-- <input type="text" aria-label="Last name" class="form-control"> --}}
                    <select class="form-control" id="country_code" name="country_code" value="{{ old('country_code', $auction->country_code) }}" required>
                        <option value="" selected="selected" disabled="disabled">{{__('Country code')}}</option>
                        {{-- @include('bookings.forms.country_codes') --}}
                        @foreach (App\Countrycode::whereNotNull('phonecode')->get(); as $item)
                            <option value="+{{$item->phonecode}}">{{$item->nicename}} (+{{$item->phonecode}})</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ __('Country code is required') }}
                    </div>
                    <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" phone="phone" value="{{ old('phone', $auction->phone) }}" aria-describedby="phoneErrors" required>
                    <small id="phoneError" class="form-text text-danger">{{ $errors->first('phone') }} </small>
                    <div class="invalid-feedback">
                        {{ __('Phone is required') }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4">{{ __('Language') }}</label>
                    <select class="form-control select2 { $errors->has('lang') ? 'has-error' : '' }}" id="language" name="language" value="{{ old('language', $auction->language) }}">
                        <option value="en" {{ $auction->language == 'en' ? 'selected' : '' }}>English</option>
                        <option value="es" {{ $auction->language == 'es' ? 'selected' : '' }}>Español</option>
                    </select>
    
                    @if ($errors->has('lang'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lang') }}</strong>
                        </span>
                    @endif
    
                </div>
            </div>
        </div>

    </div> {{-- /box-body --}}
</div> {{-- /box --}}

{{-- Conditions --}}
<div class="box box-solid box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">{{ __('Transfer Details')}} </h4>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="date">{{ __('Departure Date')}}</label>
                    <input type="text" class="form-control datepicker2 {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{ old('date', $auction->date) }}" aria-describedby="dateErrors" {{ $auction->date ? 'disabled' : ''}}>
                    <small id="dateError" class="form-text text-danger">{{ $errors->first('date') }} </small>
                    <div class="invalid-feedback">
                        {{ __('Departure Date is required') }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="airline">{{ __('Departure Airline')}}</label>
                    <input type="text" class="form-control {{ $errors->has('arrival_airline') ? 'is-invalid' : '' }}" id="arrival_airline" name="arrival_airline" airline="arrival_airline" value="{{ old('arrival_airline', $auction->arrival_airline) }}" aria-describedby="airlineErrors" required>
                    <small id="airlineError" class="form-text text-danger">{{ $errors->first('arrival_airline') }} </small>
                    <div class="invalid-feedback">
                        {{ __('Departure Airline is required') }}
                    </div>
                </div>{{-- /form-group --}}
            </div>{{-- /col --}}

            <div class="col-md-3">
                <div class="form-group">
                    <label for="flight_number">{{ __('Flight Number')}}</label>
                    <input type="text" class="form-control {{ $errors->has('flight_number') ? 'is-invalid' : '' }}" id="flight_number" name="flight_number" flight_number="flight_number" value="{{ old('flight_number', $auction->flight_number) }}" aria-describedby="flight_numberErrors" required>
                    <small id="flight_numberError" class="form-text text-danger">{{ $errors->first('flight_number') }} </small>
                    <div class="invalid-feedback">
                        {{ __('Flight Number is required') }}
                    </div>
                </div>{{-- /form-group --}}
            </div>{{-- /col --}}

            <div class="col-md-3">
                <div class="form-group">
                    <label for="arrival_time">{{ __('Departure Time')}}</label>
                    <input type="text" class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" id="arrival_time" name="arrival_time" arrival_time="arrival_time" value="{{ old('arrival_time', $auction->arrival_time) }}" aria-describedby="timeErrors" required>
                    <small id="timeError" class="form-text text-danger">{{ $errors->first('arrival_time') }} </small>
                    <div class="valid-feedback">
                        {{ __('Looks good!') }}
                    </div>
                </div>{{-- /form-group --}}
            </div>{{-- /col --}}
        </div>{{-- /row --}}

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4">{{ __('I would like to be at the airport') }}</label>
                    <select class="form-control {{ $errors->has('want_to_arrive') ? 'has-error' : '' }}" id="want_to_arrive" name="want_to_arrive" value="{{ old('want_to_arrive', $auction->want_to_arrive) }}">
                        {{-- <option value="90" {{ $auction->want_to_arrive == '90' ? 'selected' : '' }}>1 hour 30 min</option> --}}
                        <option value="60" {{ $auction->want_to_arrive == '60' ? 'selected' : '' }}>1 hour 00 min</option>
                        <option value="90" {{ $auction->want_to_arrive == '90' ? 'selected' : '' }}>1 hour 30 min</option>
                        <option value="120" {{ $auction->want_to_arrive == '120' ? 'selected' : 'selected' }}>2 hours 00 min</option>
                        <option value="150" {{ $auction->want_to_arrive == '150' ? 'selected' : '' }}>2 hours 30 min</option>
                        <option value="180" {{ $auction->want_to_arrive == '180' ? 'selected' : '' }}>3 hours 00 min</option>
                        <option value="210" {{ $auction->want_to_arrive == '210' ? 'selected' : '' }}>3 hours 30 min</option>
                    </select>
                    <span>{{__('before the flight departure time')}} </span>
                    @if ($errors->has('want_to_arrive'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('want_to_arrive') }}</strong>
                        </span>
                    @endif

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="arrival_time">{{ __('Pick-up time')}}</label>
                    <input type="text" class="form-control timepicker2 {{ $errors->has('time') ? 'is-invalid' : '' }}" id="pickup_time2" name="pickup_time2" value="{{ old('pickup_time2', $auction->pickup_time) }}" aria-describedby="timeErrors" required>
                    <span class="">
                        Please enter your desired pick-up time if you would like to override the suggested pick-up time.    
                    </span>
                    <div class="valid-feedback">
                        {{ __('Looks good!') }}
                    </div>
                </div>{{-- /form-group --}}
            </div>{{-- /col --}}
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="more_information">{{ __('Enter name of hotel or address, and other additional Information of pick up location')}}</label>
                    <textarea class="form-control {{ $errors->has('more_information') ? 'is-invalid' : '' }}" id="more_information" name="more_information" aria-describedby="more_informationErrors" required>{{ old('more_information', $auction->more_information) }}</textarea>
                    <small id="more_informationError" class="form-text text-danger">{{ $errors->first('more_information') }} </small>
                    <div class="invalid-feedback">
                        {{ __('This field is required') }}
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- /box-body --}}
</div>{{-- /box --}}

@if ($auction->type == 'roundtrip')
    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">{{ __('Arrival')}} </h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="return_date">{{ __('Arrival Date')}}</label>
                        <input type="text" class="form-control datepicker2 {{ $errors->has('return_date') ? 'is-invalid' : '' }}" id="return_date" name="return_date" value="{{ old('return_date', $auction->return_date) }}" aria-describedby="dateErrors" {{ $auction->return_date ? 'disabled' : ''}}>
                        <small id="dateError" class="form-text text-danger">{{ $errors->first('return_date') }} </small>
                        <div class="invalid-feedback">
                            {{ __('Arrival Date is required') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="return_airline">{{ __('Arrival Airline')}}</label>
                        <input type="text" class="form-control {{ $errors->has('return_airline') ? 'is-invalid' : '' }}" id="return_airline" name="return_airline" airline="return_airline" value="{{ old('return_airline', $auction->return_airline) }}" aria-describedby="airlineErrors" required>
                        <small id="airlineError" class="form-text text-danger">{{ $errors->first('return_airline') }} </small>
                        <div class="invalid-feedback">
                            {{ __('Arrival Airline is required') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div>{{-- /col --}}

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="return_flight_number">{{ __('Flight Number')}}</label>
                        <input type="text" class="form-control {{ $errors->has('return_flight_number') ? 'is-invalid' : '' }}" id="return_flight_number" name="return_flight_number" value="{{ old('return_flight_number', $auction->return_flight_number) }}" aria-describedby="return_flight_numberErrors" required>
                        <small id="return_flight_numberError" class="form-text text-danger">{{ $errors->first('return_flight_number') }} </small>
                        <div class="invalid-feedback">
                            {{ __('Flight Number is required') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div>{{-- /col --}}

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="return_time">{{ __('Arrival Time')}}</label>
                        <input type="text" class="form-control timepicker {{ $errors->has('return_time') ? 'is-invalid' : '' }}" id="return_time" name="return_time" value="{{ old('return_time', $auction->return_time) }}" aria-describedby="timeErrors" required>
                        <small id="timeError" class="form-text text-danger">{{ $errors->first('return_time') }} </small>
                        <div class="valid-feedback">
                            {{ __('Looks good!') }}
                        </div>
                    </div>{{-- /form-group --}}
                </div>{{-- /col --}}
            </div>{{-- /row --}}


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="return_more_information">{{ __('Enter name of hotel or address of drop off location, and other details if different from departure pick up information')}}</label>
                        <textarea class="form-control {{ $errors->has('return_more_information') ? 'is-invalid' : '' }}" id="return_more_information" name="return_more_information" aria-describedby="return_more_informationErrors" required>{{ old('return_more_information', $auction->return_more_information) }}</textarea>
                        <small id="return_more_informationError" class="form-text text-danger">{{ $errors->first('return_more_information') }} </small>
                        <div class="invalid-feedback">
                            {{ __('This field is required') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- /box-body --}}
    </div>{{-- /box --}}
@endif

{{-- <div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="passengers">{{ __('Passengers')}}</label>
                    <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" passengers="passengers" value="{{ old('passengers', $auction->passengers) }}" aria-describedby="passengersErrors" required>
                    <small id="passengersError" class="form-text text-danger">{{ $errors->first('passengers') }} </small>
                    <div class="invalid-feedback">
                        {{ __('Please enter how many passengers') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- Service list --}}

@section('scripts')
<script>
    //Timepicker2
    $('.timepicker2').timepicker({
    showInputs: false,
    snapToStep: true,
    minuteStep: 5,
    defaultTime: false,
    // defaultTime: 'current',
    icons: {
        up: 'fa fa-arrow-up',
        down: 'fa fa-arrow-down'
    }
    })

</script>
@endsection