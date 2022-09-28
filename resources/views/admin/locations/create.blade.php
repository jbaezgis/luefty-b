@extends('layouts.admin.admin')

@section('content')
<div class="row">
        <div class="col-lg-4" id="map" style="height: 400px;"></div>
    </div>
@endsection

@section('scripts')
<script>
    $('#map').locationpicker({
        location: {
            latitude: 18.47975127296976,
            longitude: -69.96209715078737
        },
        radius: 0,
        inputBinding: {
            latitudeInput: $('#appointment_latitude'),
            longitudeInput: $('#appointment_longitude'),
            locationNameInput: $('#appointment_address')
        },
        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
        }
    });
</script>
@endsection