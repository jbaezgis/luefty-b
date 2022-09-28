@extends('layouts.admin.admin')

@section('header')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB50fxBrVikNVJVUy_TpP1nsGpPhiSZVAs&libraries=geometry,places">
</script>
<script src="{{URL::asset('js/locationpicker.jquery.js')}}"></script>
@endsection

@section('content')
<div class="row">
        <div class="col-lg-4" id="map" style="height: 400px;"></div>
    </div>
@endsection

@section('scripts')
<script>
        $(function () {
                    $('#appointment_start_time').datetimepicker();
                });
    
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