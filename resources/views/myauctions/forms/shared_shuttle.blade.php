

{{-- <p><i class="fa fa-asterisk text-warning" style="font-size: 12px;" aria-hidden="true"></i> {{__('Required fields')}}</p> --}}
{{-- <i class="fa fa-asterisk text-warning" style="font-size: 12px;" aria-hidden="true"></i> --}}

@csrf

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="title" class="mb-0">{{ __('Number')}} </label><br>
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="Enter your booking (service) number for easy search and change tracking."><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
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
            <label for="date" class="mb-0">{{__('Date')}}</label><br>
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('Date')}}"> <i class="fa fa-question-circle" aria-hidden="true"></i></a><br> --}}
            <small>{{__('Date of service.')}} </small>
            <input type="text" class="form-control datepicker2 {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{old('date', $auction->date)}}"  aria-describedby="dateErrors" required>
            <small id="dayErrors" class="form-text text-danger">{{ $errors->first('date') }}</small>
            <div class="invalid-feedback">
                {{ __('The date must from today') }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="from_time" class="mb-0">{{ __('Boarding Time and Departure Time') }}</label><br>
            <small>{{__('Boarding Time and Departure Time.')}} </small>
            <div class="d-flex flex-row bd-highlight mb-3">
                <input type="text" class="form-control timepicker mr-2 {{ $errors->has('from_time') ? 'is-invalid' : '' }}" id="from_time" name="from_time" value="{{old('from_time', $auction->from_time)}}"  aria-describedby="from_timeErrors" placeholder="{{ __('Time A') }}" required>
                <input type="text" class="form-control timepicker {{ $errors->has('to_time') ? 'is-invalid' : '' }}" id="to_time" name="to_time" value="{{old('to_time', $auction->to_time)}}"  aria-describedby="to_timeErrors" placeholder="{{ __('Time B') }}" required>
            </div>
            <div class="invalid-feedback">
                {{ __('Please enter the Boarding Time and Departue Time.') }}
            </div>
            <small id="from_timeErrors" class="form-text text-danger">{{ $errors->first('from_time') }}</small>
            <small id="to_timetimeErrors" class="form-text text-danger">{{ $errors->first('to_time') }}</small>
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
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br> --}}
            <small>{{__('Drop off location.')}} </small>
            {!! Form::select('to_city', App\Location::where('active', 1)->orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=>'', 'class'=>'form-control select2', 'required', 'required'  ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Main Location') }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="mb-0" for="starting_bid">{{ __('Starting bid') }}</label><br>
            <small>{{__('For one seat.')}} </small>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text">{{auth()->user()->country->currency_symbol}}</div>
                </div>
                <input type="number" step=".01" class="form-control bid {{ $errors->has('starintg_bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="starting_bid" name="starting_bid" value="{{old('starting_bid', $auction->starting_bid)}}" required>
                <small id="starting_bidErrors" class="form-text text-danger">{{ $errors->first('starting_bid') }}</small>
                <div class="invalid-feedback">
                    {{ __('Plesae enter Starting bid for one seat') }}
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="passengers" class="mb-0">{{ __('Seats') }}</label>
            <br>
            <small>{{__('Available seats.')}} </small>
            <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" value="{{old('passengers', $auction->passengers)}}"  aria-describedby="passengersErrors" placeholder="" required>
            <small id="passengersErrors" class="form-text text-danger">{{ $errors->first('passengers') }}</small>

            <div class="invalid-feedback">
                {{ __('Plesae enter how many Seats') }}
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="vehicle_size" class="mb-0">{{__('Select')}}</label><br>
            {{-- <a tabindex="0" class="" role="button" data-toggle="tooltip" data-placement="right" title="{{ __('Select')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a><br> --}}
            <small>{{__('For contract select -> Contract bids per person.')}} </small>
            {!! Form::select('vehicle_size', App\Vehicle_list::orderBy('order', 'asc')->pluck('name', 'id'), null, ['id'=>'vehicle_size', 'placeholder'=>'', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('vehicle_size') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select something') }}
            </div>
        </div>
    </div>
</div>{{-- end row --}}




