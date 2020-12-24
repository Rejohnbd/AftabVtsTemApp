<table class="table card-table">
    <thead>
        <tr>
            <th width="5%">Trip Date</th>
            <th width="10%">Driver Name</th>
            <th width="10%">Helper Name</th>
            <th width="15%">Trip Location</th>
            <th width="25%">Trip Details</th>
            <th width="10%">Start Time</th>
            <th width="5%">Start KM</th>
            <th width="10%">End Time</th>
            <th width="5%">End KM</th>
            <th width="5%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($datas as $data)
        <tr>
            <th>{{ date('d/m/Y', strtotime($data->trip_date)) }}</th>
            <th>{{$data->driver->driver_first_name}} {{ $data->driver->driver_last_name }}</th>
            {{-- <th>{{ findDriverNameForTripReport($data->driver_user_id) }}</th> --}}
            <th>@if($data->helper_id){{ findHelperNameForTripReport($data->helper_id) }} @endif</th>
            <th>{{ $data->trip_from }} to {{ $data->trip_to }}</th>
            <th>{{ $data->trip_details }}</th>
            <th>@if($data->trip_start_datetime){{ date('d/m/Y g:i a', strtotime($data->trip_start_datetime)) }}@endif</th>
            <th>{{ $data->trip_start_kilometer }}</th>
            <th>@if($data->trip_end_datetime){{ date('d/m/Y g:i a', strtotime($data->trip_end_datetime)) }}@endif</th>
            <th>{{ $data->trip_end_kilometer }}</th>
            <th>@if($data->trip_status == 1) Yet to Start @elseif($data->trip_status == 2) Started @else Completed @endif</th>
        </tr>
        @empty
        <tr>
            <th colspan="8" class="text-center">Sorry No Data Found.</th>
        </tr>
        @endforelse
    </tbody>
</table>