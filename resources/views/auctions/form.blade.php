@csrf


<div class="form-group">
    <label for="name">Start Date</label>
    <input type="text" class="form-control datetimepicker1 {{ $errors->has('start_date') ? 'is-invalid' : '' }}" id="start_date" name="start_date" value="{{ $auction->start_date.@ old('start_date') }}" aria-describedby="startdateErrors">
    <small id="startdateError" class="form-text text-danger">{{ $errors->first('start_date') }} </small>
</div>

<div class="form-group">
    <label for="email">End Date</label>
    <input type="text" class="form-control datetimepicker2 {{ $errors->has('end_date') ? 'is-invalid' : '' }}" id="end_date" name="end_date" value="{{ $auction->end_date.@ old('end_date') }}"  aria-describedby="enddateErrors">
    <small id="emailErrors" class="form-text text-danger">{{ $errors->first('end_date') }}</small>
</div>

<div class="form-group">
    <label for="email">Service Date</label>
    <input type="text" class="form-control datetimepicker3 {{ $errors->has('day_time') ? 'is-invalid' : '' }}" id="day_time" name="day_time" value="{{ $auction->day_time.@ old('day_time') }}"  aria-describedby="datetimeErrors">
    <small id="daytimeErrors" class="form-text text-danger">{{ $errors->first('day_time') }}</small>
</div>

<div class="form-group">
    <label for="email">From</label>
    <input type="text" class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" id="from" name="from" value="{{ $auction->from.@ old('from') }}"  aria-describedby="fromErrors">
    <small id="fromErrors" class="form-text text-danger">{{ $errors->first('from') }}</small>
</div>

<div class="form-group">
    <label for="email">To</label>
    <input type="text" class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" id="to" name="to" value="{{ $auction->to.@ old('to') }}"  aria-describedby="toErrors">
    <small id="toErrors" class="form-text text-danger">{{ $errors->first('to') }}</small>
</div>

<div class="form-group">
    <label for="message">Description</label>
    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="3" value="{{ $auction->description.@ old('description') }}"  aria-describedby="descriptionErrors"></textarea>
    <small id="descriptionErrors" class="form-text text-danger">{{ $errors->first('description') }}</small>
</div>

<div class="form-group">
    <label for="email">Passengers</label>
    <input type="number" class="form-control {{ $errors->has('passengers') ? 'is-invalid' : '' }}" id="passengers" name="passengers" value="{{ $auction->passengers.@ old('passengers') }}"  aria-describedby="passengersErrors">
    <small id="passengersErrors" class="form-text text-danger">{{ $errors->first('passengers') }}</small>
</div>

<div class="form-group">
    <label for="email">Min Seats</label>
    <input type="number" class="form-control {{ $errors->has('min_seats') ? 'is-invalid' : '' }}" id="min_seats" name="min_seats" value="{{ $auction->min_seats.@ old('min_seats') }}"  aria-describedby="min_seatsErrors">
    <small id="min_seatsErrors" class="form-text text-danger">{{ $errors->first('mean_seats') }}</small>
</div>

<div class="form-group">
    <label for="email">More Details</label>
    <input type="text" class="form-control {{ $errors->has('more_details') ? 'is-invalid' : '' }}" id="more_details" name="more_details" value="{{ $auction->more_details.@ old('more_details') }}"  aria-describedby="more_detailsErrors">
    <small id="more_detailsErrors" class="form-text text-danger">{{ $errors->first('more_details') }}</small>
</div>

