<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="name">Last/First name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'has-error' : 'has-success' }}" id="name" name="name" value="{{ old('name') }}" aria-describedby="titleErrors" required>
            <small id="nameError" class="form-text text-danger">{{ $errors->first('name') }} </small>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="email">Email</label>
            <input type="email" class="form-control " id="email" name="email" value="{{ old('email') }}"  aria-describedby="emailErrors" required>
            <small id="emailErrors" class="form-text text-danger">{{ $errors->first('email') }}</small>
        </div>
    </div>
</div> {{-- end row--}}
<?php if(isset($person)){?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('phone') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"  aria-describedby="slugErrors" required>
            <small id="phoneErrors" class="form-text text-danger">{{ $errors->first('phone') }}</small>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('adult') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="adult">Adult</label>
            <select class="form-control {{ $errors->has('adult') ? 'has-error' : '' }}" id="adult" name="adult" value="{{ old('adult') }}">
                <option value="1">1 Adult</option>
                <option value="2">2 Adult</option>
                <option value="3">3 Adult</option>
                <option value="4">4 Adult</option>
                <option value="5">5 Adult</option>
                <option value="6">6 Adult</option>
                <option value="7">7 Adult</option>
            </select>
            <small id="adultErrors" class="form-text text-danger">{{ $errors->first('adult') }}</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('kids') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="kids">Kids</label>
            <select class="form-control {{ $errors->has('kids') ? 'has-error' : '' }}" id="kids" name="kids" value="{{ old('kids') }}">
                <option value=""></option>
                <option value="1">1 Kid</option>
                <option value="2">2 Kids</option>
                <option value="3">3 Kids</option>
                <option value="4">4 Kids</option>
                <option value="5">5 Kids</option>
                <option value="6">6 Kids</option>
                <option value="7">7 Kids</option>
            </select>
            <small id="kidsErrors" class="form-text text-danger">{{ $errors->first('kids') }}</small>
        </div>
    </div>

</div>{{-- end row--}}
<?php }
    else{
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"  aria-describedby="slugErrors">
            <small id="phoneErrors" class="form-text text-danger">{{ $errors->first('phone') }}</small>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('persons') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="persons">Persons</label>
            <select class="form-control {{ $errors->has('persons') ? 'has-error' : '' }}" id="persons" name="persons" value="{{ old('persons') }}">
                <option value="1">1 Person</option>
                <option value="2">2 Persons</option>
                <option value="3">3 Persons</option>
                <option value="4">4 Persons</option>
                <option value="5">5 Persons</option>
                <option value="6">6 Persons</option>
                <option value="7">7 Persons</option>
            </select>
            <small id="personsErrors" class="form-text text-danger">{{ $errors->first('persons') }}</small>
        </div>
    </div>

</div>{{-- end row--}}
    <?php }?>
<?php if(isset($hotel)){ ?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('date') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="date">Date</label>
            <input type="text" class="form-control datepicker2 {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{ old('date') }}"  aria-describedby="dateErrors">
            <small id="dateErrors" class="form-text text-danger">{{ $errors->first('date') }}</small>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('hotel_location') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="hotel_location">Hotel And Location</label>
            <input type="text" class="form-control {{ $errors->has('hotel_location') ? 'is-invalid' : '' }}" id="hotel_location" name="hotel_location" value="{{ old('hotel_location') }}"  aria-describedby="hotel_locationErrors">
            <small id="hotel_locationErrors" class="form-text text-danger">{{ $errors->first('hotel_location') }}</small>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('room_number') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="room_number">Room number</label>
            <input type="text" class="form-control {{ $errors->has('room_number') ? 'is-invalid' : '' }}" id="room_number" name="room_number" value="{{ old('room_number') }}"  aria-describedby="room_numberErrors">
            <small id="room_numberErrors" class="form-text text-danger">{{ $errors->first('room_number') }}</small>
        </div>
    </div>

</div> {{-- end row--}}

<?php } 
elseif(isset($location)){
    ?>
    <div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('date') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="date">Date</label>
            <input type="text" class="form-control datepicker2 {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{ old('date') }}"  aria-describedby="dateErrors">
            <small id="dateErrors" class="form-text text-danger">{{ $errors->first('date') }}</small>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('hotel') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="hotel">Hotel</label>
            <input type="text" class="form-control {{ $errors->has('hotel') ? 'is-invalid' : '' }}" id="hotel" name="hotel" value="{{ old('hotel') }}"  aria-describedby="hotelErrors">
            <small id="hotelErrors" class="form-text text-danger">{{ $errors->first('hotel') }}</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('location') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="location">Location</label>
            <input type="text" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" id="location" name="location" value="{{ old('location') }}"  aria-describedby="locationErrors">
            <small id="locationErrors" class="form-text text-danger">{{ $errors->first('location') }}</small>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('room_number') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="room_number">Room number</label>
            <input type="text" class="form-control {{ $errors->has('room_number') ? 'is-invalid' : '' }}" id="room_number" name="room_number" value="{{ old('room_number') }}"  aria-describedby="room_numberErrors">
            <small id="room_numberErrors" class="form-text text-danger">{{ $errors->first('room_number') }}</small>
        </div>
    </div>

</div> {{-- end row--}}

<?php } else { ?>
    <div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('date') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="date">Date</label>
            <input type="text" class="form-control datepicker2 {{ $errors->has('date') ? 'is-invalid' : '' }}" id="date" name="date" value="{{ old('date') }}"  aria-describedby="dateErrors">
            <small id="dateErrors" class="form-text text-danger">{{ $errors->first('date') }}</small>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('hotel') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="hotel">Hotel</label>
            <input type="text" class="form-control {{ $errors->has('hotel') ? 'is-invalid' : '' }}" id="hotel" name="hotel" value="{{ old('hotel') }}"  aria-describedby="hotelErrors">
            <small id="hotelErrors" class="form-text text-danger">{{ $errors->first('hotel') }}</small>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('room_number') ? 'has-error has-feedback' : '' }}">
            <label class="control-label" for="room_number">Room number</label>
            <input type="text" class="form-control {{ $errors->has('room_number') ? 'is-invalid' : '' }}" id="room_number" name="room_number" value="{{ old('room_number') }}"  aria-describedby="room_numberErrors">
            <small id="room_numberErrors" class="form-text text-danger">{{ $errors->first('room_number') }}</small>
        </div>
    </div>

</div> {{-- end row--}}



<?php }?>

