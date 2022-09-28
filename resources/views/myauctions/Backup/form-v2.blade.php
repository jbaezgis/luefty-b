

{{-- <p><i class="fa fa-asterisk text-warning" style="font-size: 12px;" aria-hidden="true"></i> {{__('Required fields')}}</p> --}}
{{-- <i class="fa fa-asterisk text-warning" style="font-size: 12px;" aria-hidden="true"></i> --}}

@csrf

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="title">{{ __('Number')}} </label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="Enter your booking (service) number for easy search and change tracking."><i class="fa fa-question-circle" aria-hidden="true"></i></a>
            <input type="text" class="form-control {{ $errors->has('service_number') ? 'is-invalid' : '' }}" id="service_number" name="service_number" value="{{old('service_number', $auction->service_number)}}"  aria-describedby="service_numberErrors" required {{ $auction->changed === 1 ? 'readonly' : '' }}>
            <small id="service_numberErrors" class="form-text text-danger">{{ $errors->first('service_number') }}</small>
            <div class="invalid-feedback">
                {{ __('Service Number is required') }}
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="date">@lang('globals.date')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('Date')}}"> <i class="fa fa-question-circle" aria-hidden="true"></i></a>
            <input type="text" class="form-control datepicker2 {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{old('date', $auction->date)}}"  aria-describedby="dateErrors" required>
            <small id="dayErrors" class="form-text text-danger">{{ $errors->first('date') }}</small>
            <div class="invalid-feedback">
                {{ __('The date must from today') }}
            </div>
        </div>
    </div>
    @if ($auction->category_id === 1)
    <div class="col-md-3">
        <div class="form-group">
            <label for="time">@lang('globals.time')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('Time')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
            <input type="text" class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" id="time" name="time" value="{{old('time', $auction->time)}}"  aria-describedby="timeErrors">
            <small id="timeErrors" class="form-text text-danger">{{ $errors->first('time') }}</small>
        </div>
    </div>
    @endif
    @if ($auction->category_id === 2)
    <div class="col-md-6">
        <div class="form-group">
            <label for="from_time">{{ __('Boarding Time and Departue Time') }}</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('Pick up between time A and time B')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
            <div class="d-flex flex-row bd-highlight mb-3">
            <input type="text" class="form-control timepicker mr-2 {{ $errors->has('from_time') ? 'is-invalid' : '' }}" id="from_time" name="from_time" value="{{old('from_time', $auction->from_time)}}"  aria-describedby="from_timeErrors" placeholder="{{ __('Time A') }}" required>
            <input type="text" class="form-control timepicker {{ $errors->has('to_time') ? 'is-invalid' : '' }}" id="to_time" name="to_time" value="{{old('to_time', $auction->to_time)}}"  aria-describedby="to_timeErrors" placeholder="{{ __('Time B') }}" required>
            </div>
            <small id="from_timeErrors" class="form-text text-danger">{{ $errors->first('from_time') }}</small>
            <small id="to_timetimeErrors" class="form-text text-danger">{{ $errors->first('to_time') }}</small>
        </div>
    </div>

    @endif
</div> {{-- end row --}}

@if ($auction->category->name != 'Tour')
@endif
<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-n1">
            <label for="from">@lang('globals.from')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{-- <label for="from">@lang('globals.from')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
            {{-- <input type="text" class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" id="from" name="from" value="{{old('from', $auction->from)}}"  aria-describedby="fromErrors"> --}}
            {!! Form::select('from_city', App\Location::orderBy('name')->pluck('name', 'id'), null, ['id'=>'from_city', 'placeholder'=>'--Main location--', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Main Location') }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{-- <label for="to">@lang('globals.to')</label> --}}
            {{-- <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('To location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
            {{-- <input type="text" class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" id="to" name="to" value="{{old('to', $auction->to)}}"  aria-describedby="toErrors"> --}}
            {{-- {!! Form::select('to_location', App\Place::pluck('name', 'id'), null, ['placeholder'=>'Select a Place', 'class'=>'form-control select2', 'required' ]) !!} --}}
            {!! Form::select('from_location', App\Place::where('location_id', $auction->from_city)->orderBy('name')->pluck('name', 'id'), null, ['id'=>'from_location', 'placeholder'=>'--Sub location--', 'class'=>'form-control select2', 'required'  ]) !!}
            {{-- <select name="from_location" id="from_location" class="form-control select2">
                <option value="0" selected disable hidden>{{ __('From location') }}</option>
            </select> --}}
            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Sub location') }}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group mb-n1">
            <label for="from">@lang('globals.to')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{-- <label for="from">@lang('globals.to')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('From location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
            {{-- <input type="text" class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" id="from" name="from" value="{{old('from', $auction->from)}}"  aria-describedby="fromErrors"> --}}
            {!! Form::select('to_city', App\Location::orderBy('name')->pluck('name', 'id'), null, ['id'=>'to_city', 'placeholder'=>'--Main location--', 'class'=>'form-control select2', 'required', 'required'  ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Main Location') }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{-- <label for="to">@lang('globals.to')</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('To location')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a> --}}
            {{-- <input type="text" class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" id="to" name="to" value="{{old('to', $auction->to)}}"  aria-describedby="toErrors"> --}}
            {{-- {!! Form::select('to_location', App\Place::pluck('name', 'id'), null, ['placeholder'=>'Select a Place', 'class'=>'form-control select2', 'required' ]) !!} --}}
            {!! Form::select('to_location', App\Place::where('location_id', $auction->to_city)->orderBy('name')->pluck('name', 'id'), null, ['id'=>'to_location', 'placeholder'=>'--Sub location--', 'class'=>'form-control select2', 'required'  ]) !!}

            {{-- <select name="to_location" id="to_location" class="form-control select2">
                <option value="0" selected disable hidden>{{ __('To location') }}</option>
            </select> --}}
            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
            <div class="invalid-feedback">
                {{ __('Please select a Sub location') }}
            </div>
        </div>
    </div>
</div>
@if ($auction->category->name === 'Tour')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">{{ __('Tour name')}}</label>
            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" value="{{old('title', $auction->title)}}"  aria-describedby="titleErrors">
            <small id="titleErrors" class="form-text text-danger">{{ $errors->first('title') }}</small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="pickup_from_location">{{ __('Pickup from location')}} </label>
            {!! Form::select('pickup_from_location', App\Place::pluck('name', 'id'), null, ['placeholder'=>'Select a Location', 'class'=>'form-control select2']) !!}
            <small id="pickup_from_locationErrors" class="form-text text-danger">{{ $errors->first('pickup_from_location') }}</small>
        </div>
    </div>
</div>
@endif
<div class="row">
    @if ($auction->category_id === 2)
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="starting_bid">
                @if ($auction->category_id === 1)
                {{ __('Starting bid') }}
                @else
                {{ __('Starting bid for one seat') }}
                @endif

            </label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('Starting bid')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text">US$</div>
                </div>
                <input type="number" step=".01" class="form-control bid {{ $errors->has('starintg_bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="starting_bid" name="starting_bid" value="{{old('starting_bid', $auction->starting_bid)}}" required>
                <small id="starting_bidErrors" class="form-text text-danger">{{ $errors->first('starting_bid') }}</small>
                <div class="invalid-feedback">
                    @if ($auction->category_id === 1)
                        {{ __('Plesae enter Starting bid') }}
                    @else
                        {{ __('Plesae enter Starting bid for one seat') }}
                    @endif
                </div>
            </div>

        </div>
    </div>
    @endif
    <div class="col-md-3">
        <div class="form-group">
            <label for="passengers">
                @if ($auction->category_id === 1)
                    {{ __('Seats') }}
                @else
                    {{ __('Seats') }}
                @endif

            </label>
            @if ($auction->category_id === 1)
                <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('Seats')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
            @else
                <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('Available seats')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
            @endif

            <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" value="{{old('passengers', $auction->passengers)}}"  aria-describedby="passengersErrors" required>
            <small id="passengersErrors" class="form-text text-danger">{{ $errors->first('passengers') }}</small>


            <div class="invalid-feedback">
                @if ($auction->category_id === 1)
                    {{ __('Plesae enter how many Seats') }}
                @else
                    {{ __('Plesae enter how many Seats') }}
                @endif
            </div>
        </div>
    </div>
    @if ($auction->category_id === 1)
    <div class="col-md-3">
        <div class="form-group">
            <label for="min_seats">{{ __('Size') }}</label>
            <a tabindex="0" class="" role="button" data-toggle="popover" data-trigger="focus" data-content="{{ __('My prefered vehicle size')}}"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
            <input type="number" class="form-control {{ $errors->has('min_seats') ? 'is-invalid' : '' }}" id="min_seats" name="min_seats" value="{{old('min_seats', $auction->min_seats)}}"  aria-describedby="min_seatsErrors" placeholder="@lang('globals.seats')">
            <small id="min_seatsErrors" class="form-text text-danger">{{ $errors->first('min_seats') }}</small>
            <div class="valid-feedback">
                {{ __('This field is not required but....') }}
            </div>
        </div>
    </div>
    @endif
</div>{{-- end row --}}
{{-- @if ($auction->category_id === 1)
<div class="row">
    <div class="col-md-12">
        @lang('globals.extras'):<br/>

        <div class="checkbox">
            @foreach ($extras as $id => $name )
            <label>
                <input
                type="checkbox"
                {{ $auction->extras->pluck('id')->contains($id) ? 'checked' : '' }}
                value="{{ $id }}"
                name="extras[]">
                {{ $name }}&nbsp;
            </label>
            @endforeach
        </div>

    </div>

</div>
@endif --}}

{{-- @if ($auction->category_id === 1)
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="message">{{ __('More information') }}
                <a href="#" class="" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                </a>
            </label>
            <textarea class="form-control textarea {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="5"  aria-describedby="descriptionErrors">{{old('description', $auction->description)}}</textarea>
            <small id="descriptionErrors" class="form-text text-danger">{{ $errors->first('description') }}</small>
        </div>
    </div>
</div>
@endif --}}



