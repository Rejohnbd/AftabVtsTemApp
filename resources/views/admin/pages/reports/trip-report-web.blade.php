<table class="table card-table">
    <thead>
        <tr>
            <th width="10%">Trip Date</th>
            <th width="10%">Driver Name</th>
            <th width="10%">Helper Name</th>
            <th width="20%">Trip Location</th>
            <th width="20%">Trip Details</th>
            <th width="10%">Start Time</th>
            <th width="10%">End Time</th>
            <th width="10%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($datas as $data)
        <tr>
            <th>{{ date('d/m/Y', strtotime($data->trip_date)) }}</th>
            <th>{{ $data->driver_user_id }}</th>
            <th>{{ $data->helper_id }}</th>
            <th>{{ $data->trip_from }} to {{ $data->trip_to }}</th>
            <th>{{ $data->trip_details }}</th>
            <th>{{ date('g:i a', strtotime($data->trip_start_datetime)) }}</th>
            <th>{{ date('g:i a', strtotime($data->trip_end_datetime)) }}</th>
            <th>@if($data->trip_status == 1) Yet to Start @elseif($data->trip_status == 2) Started @else Completed @endif</th>
        </tr>
        @empty
        <tr>
            <th colspan="8" class="text-center">Sorry No Data Found.</th>
        </tr>
        @endforelse
    </tbody>
</table>