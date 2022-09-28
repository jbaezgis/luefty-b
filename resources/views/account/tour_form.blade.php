@csrf


<div class="form-group">
    <label for="name">Start Date</label>
    <input type="text" class="form-control datetimepicker1 {{ $errors->has('start_date') ? 'is-invalid' : '' }}" id="start_date" name="start_date" value="{{ old('start_date') }}" aria-describedby="startdateErrors">
    <small id="startdateError" class="form-text text-danger">{{ $errors->first('start_date') }} </small>
</div>

<div class="form-group">
    <label for="email">End Date</label>
    <input type="text" class="form-control datetimepicker2 {{ $errors->has('end_date') ? 'is-invalid' : '' }}" id="end_date" name="end_date" value="{{ old('end_date') }}"  aria-describedby="enddateErrors">
    <small id="emailErrors" class="form-text text-danger">{{ $errors->first('end_date') }}</small>
</div>

<div class="form-group">
    <label for="email">Days</label>
    <input type="text" class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}" id="days" name="days" value="{{ old('days') }}"  aria-describedby="daysErrors">
    <small id="daysErrors" class="form-text text-danger">{{ $errors->first('days') }}</small>
</div>

<div class="form-group">
    <label for="email">Localizacion</label>
    <input type="text" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" id="location" name="location" value="{{ old('location') }}"  aria-describedby="locationErrors">
    <small id="locationErrors" class="form-text text-danger">{{ $errors->first('location') }}</small>
</div>

<div class="form-group">
    <label for="message">Description</label>
    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="3" value="{{ old('description') }}"  aria-describedby="descriptionErrors"></textarea>
    <small id="descriptionErrors" class="form-text text-danger">{{ $errors->first('description') }}</small>
</div>


