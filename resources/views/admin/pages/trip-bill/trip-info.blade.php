<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Driver Name</label>
        <input type="text" class="form-control"  value="{{ findDriverNameForTripReport($data->driver_user_id) }}" required disabled>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Vehicle Regi. No.</label>
        <input type="text" class="form-control"  value="{{ findVehicleById($data->vehicle_id) }}" required disabled>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Helper Name</label>
        <input type="text" class="form-control"  value="{{ findHelperNameForTripReport($data->helper_id) }}" required disabled>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Trip Start Date &amp; Time</label>
        <input type="text" class="form-control"  value="{{ date('d/m/Y H:i:s A', strtotime($data->trip_start_datetime)) }}" required disabled> 
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Trip End Date &amp; Time</label>
        <input type="text" class="form-control"  value="{{ date('d/m/Y H:i:s A', strtotime($data->trip_end_datetime)) }}" required disabled> 
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Meter Start Km</label>
        <input type="text" class="form-control"  value="{{ $data->trip_start_kilometer }}" required disabled>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Meter End Km</label>
        <input type="text" class="form-control"  value="{{ $data->trip_end_kilometer }}" required disabled>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="form-label">Total Distance</label>
        <input type="text" id="totalDistance" class="form-control"  value="{{ ($data->trip_end_kilometer - $data->trip_start_kilometer) }}" required disabled>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label class="form-label">Delivery From</label>
        <input type="text" class="form-control"  value="{{ $data->trip_from }}" required disabled>
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label class="form-label">Delivery To</label>
        <input type="text" class="form-control"  value="{{ $data->trip_to }}" required disabled>
    </div>
</div>