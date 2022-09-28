@csrf

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="date">@lang('globals.date')</label>
            <input type="text" class="form-control datepicker {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{old('date', $auction->date)}}"  aria-describedby="dateErrors" required>
            <small id="dayErrors" class="form-text text-danger">{{ $errors->first('date') }}</small>
        </div>
    </div>
    @if ($auction->category_id === 1)
    <div class="col-md-3">
        <div class="form-group">
            <label for="time">@lang('globals.time')</label>
            <input type="text" class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" id="time" name="time" value="{{old('time', $auction->time)}}"  aria-describedby="timeErrors">
            <small id="timeErrors" class="form-text text-danger">{{ $errors->first('time') }}</small>
        </div>
    </div>
    @endif
    @if ($auction->category_id === 2)
    <div class="col-md-6">
        <div class="form-group">
            <label for="from_time">{{ __('Pick up between time A and time B') }}</label>
            <div class="d-flex flex-row bd-highlight mb-3">
            <input type="text" class="form-control timepicker mr-2 {{ $errors->has('from_time') ? 'is-invalid' : '' }}" id="from_time" name="from_time" value="{{old('from_time', $auction->from_time)}}"  aria-describedby="from_timeErrors" placeholder="{{ __('Time A') }}" required>
                <input type="text" class="form-control timepicker {{ $errors->has('to_time') ? 'is-invalid' : '' }}" id="to_time" name="to_time" value="{{old('to_time', $auction->to_time)}}"  aria-describedby="to_timeErrors" placeholder="{{ __('Time B') }}" required>
            </div>
            <small id="from_timeErrors" class="form-text text-danger">{{ $errors->first('from_time') }}</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{-- <label for="time">@lang('globals.time')</label> --}}
            
            <small id="to_timetimeErrors" class="form-text text-danger">{{ $errors->first('to_time') }}</small>
        </div>
    </div>
    @endif
</div> {{-- end row --}}

@if ($auction->category->name != 'Tour')
@endif
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="from">@lang('globals.from')</label>
            {{-- <input type="text" class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" id="from" name="from" value="{{old('from', $auction->from)}}"  aria-describedby="fromErrors"> --}}
            {!! Form::select('from_location', App\Place::pluck('name', 'id'), null, ['placeholder'=>'Select a Location', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from_location') }}</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="to">@lang('globals.to')</label>
            {{-- <input type="text" class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" id="to" name="to" value="{{old('to', $auction->to)}}"  aria-describedby="toErrors"> --}}
            {!! Form::select('to_location', App\Place::pluck('name', 'id'), null, ['placeholder'=>'Select a Location', 'class'=>'form-control select2', 'required' ]) !!}
            <small id="toErrors" class="form-text text-danger">{{ $errors->first('to_location') }}</small>
        </div>
    </div>
    @if ($auction->category_id === 1)
    <div class="col-md-12">
        <p id="emailHelp" class="form-text text-muted">{{ __('If address enter into More information field.') }}</p>
    </div>
    @endif
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
            <label for="pickup_from_location">{{ __('Pickup from location')}}</label>
            {!! Form::select('pickup_from_location', App\Place::pluck('name', 'id'), null, ['placeholder'=>'Select a Location', 'class'=>'form-control select2']) !!}
            <small id="pickup_from_locationErrors" class="form-text text-danger">{{ $errors->first('pickup_from_location') }}</small>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="starting_bid">
                @if ($auction->category_id === 1)
                {{ __('Starting bid') }}
                @else
                {{ __('Starting bid for one seat') }}
                @endif 
            </label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text">US$</div>
                </div>
                <input type="number" class="form-control {{ $errors->has('starintg_bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="starting_bid" name="starting_bid" value="{{old('starting_bid', $auction->starting_bid)}}">
                <small id="starting_bidErrors" class="form-text text-danger">{{ $errors->first('starting_bid') }}</small>
            </div>
            
        </div>
    </div>

    @if ($auction->category_id === 2)
    <div class="form-group">
        <label for="passengers">{{ __('Available seats') }}</label>
        <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" value="{{old('passengers', $auction->passengers)}}"  aria-describedby="passengersErrors">
        <small id="passengersErrors" class="form-text text-danger">{{ $errors->first('passengers') }}</small>
    </div>
        @endif
    
</div>{{-- end row --}}

@if ($auction->category_id === 1)
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="passengers">{{ __('Passengers') }}</label>
            <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" value="{{old('passengers', $auction->passengers)}}"  aria-describedby="passengersErrors">
            <small id="passengersErrors" class="form-text text-danger">{{ $errors->first('passengers') }}</small>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="min_seats">{{ __('My prefered vehicle size') }}</label>
            <input type="number" class="form-control {{ $errors->has('min_seats') ? 'is-invalid' : '' }}" id="min_seats" name="min_seats" value="{{old('min_seats', $auction->min_seats)}}"  aria-describedby="min_seatsErrors" placeholder="@lang('globals.seats')">
            <small id="min_seatsErrors" class="form-text text-danger">{{ $errors->first('min_seats') }}</small>
        </div>
    </div>
    
    {{-- <div class="col-md-3">
        <div class="form-group">
            <label for="child_seats">@lang('globals.child_seats')</label>
            <input type="number" class="form-control {{ $errors->has('child_seats') ? 'is-invalid' : '' }}" id="child_seats" name="child_seats" value="{{old('child_seats', $auction->child_seats)}}"  aria-describedby="child_seatsErrors">
            <small id="child_seatsErrors" class="form-text text-danger">{{ $errors->first('child_seats') }}</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="baby_seats">@lang('globals.baby_seats')</label>
            <input type="number" class="form-control {{ $errors->has('baby_seats') ? 'is-invalid' : '' }}" id="baby_seats" name="baby_seats" value="{{old('baby_seats', $auction->baby_seats)}}"  aria-describedby="baby_seatsErrors">
            <small id="baby_seatsErrors" class="form-text text-danger">{{ $errors->first('baby_seats') }}</small>
        </div>
    </div>
     --}}
</div>
@endif
@if ($auction->category_id === 1)
{{-- <div class="row"> 
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
    
</div> --}}
<hr>

{{-- Extras --}}
<div class="row">
    <div class="col-md-6">
        <h4>{{ __('Requirements for provider') }}</h4>
        <form method="POST" action="{{ route('extraspro.store', $auction->id) }}">
            {{ csrf_field() }}
            
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 w-100 bd-highlight">
                    <div class="form-group">
                        <label for="extra_id">{{ __('Extra') }}</label>
                        {!! Form::select('extra_id', App\Extra::pluck('name', 'id'), null, ['placeholder'=>'Select one', 'class'=>'form-control select2', 'required' ]) !!}
                        @if($errors->any())
                            <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                        @endif
                    </div> {{-- end form-group--}}
                </div>{{-- end flex item--}}
                <div class="p-2 bd-highlight">
                    <div class="form-group">
                        <label for="quantity">{{ __('Quantity') }}</label>
                        <input type="number" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" id="quantity" name="quantity" value="" aria-describedby="quantityErrors">
                        @if($errors->any())
                            <small id="quantityErrors" class="form-text text-danger">{{ $errors->first('quantity') }}</small>
                        @endif
                    </div> {{-- end form-group--}}
                </div>{{-- end flex item--}}
                <div class="p-2 bd-highlight">
                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 32px" data-submit-value="Please wait...">
                        {{ __('Add') }}
                    </button>
                </div>{{-- end flex item--}}
            </div>{{-- end flex row--}}
            
        </form>

        {{-- Extras providers --}}

        <table class="table">
                <tbody>
                    @foreach ($extraspro as $item)
                        <tr>
                            <td scope="row">{{ $item->quantity }} {{ $item->extra->name }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div class="col-md-6">
        <h4>{{ __('Passengers') }}</h4>
        <form method="POST" action="{{ route('extraspass.store', $auction->id) }}">
            {{ csrf_field() }}
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 w-100 bd-highlight">
                    <div class="form-group"> 
                        <label for="extra_id">{{ __('Extra') }}</label>
                        {!! Form::select('extra_id', App\Extra::pluck('name', 'id'), null, ['placeholder'=>'Select one', 'class'=>'form-control select2', 'required' ]) !!}
                        @if($errors->any())
                            <small id="bidErrors" class="form-text text-danger">{{ $errors->first('bid') }}</small>
                        @endif
                    </div> {{-- end form-group--}}
                </div>{{-- end flex item--}}
                <div class="p-2 bd-highlight">
                    <div class="form-group">
                        <label for="quantity">{{ __('Quantity') }}</label>
                        <input type="number" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" id="quantity" name="quantity" value="" aria-describedby="quantityErrors">
                        @if($errors->any())
                            <small id="quantityErrors" class="form-text text-danger">{{ $errors->first('quantity') }}</small>
                        @endif
                    </div> {{-- end form-group--}}
                </div>{{-- end flex item--}}
                <div class="p-2 bd-highlight">
                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 32px" data-submit-value="Please wait...">
                        {{ __('Add') }}
                    </button>
                </div>{{-- end flex item--}}
            </div>{{-- end flex row--}}
        </form>

        {{-- Extras passenger --}}

        <table class="table">
            <tbody>
                @foreach ($extraspass as $item)
                    <tr>
                        <td scope="row">{{ $item->quantity }} {{ $item->extra->name }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="message">{{ __('More information') }}</label>
            <textarea class="form-control textarea {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="3"  aria-describedby="descriptionErrors">{{old('description', $auction->description)}}</textarea>
            <small id="descriptionErrors" class="form-text text-danger">{{ $errors->first('description') }}</small>
        </div>
    </div>
</div>{{-- end row --}}
@endif



