<table class="table card-table">
    <thead>
        <tr>
            <th>Maintenance Type</th>
            <th>Vehicle Regi. No.</th>
            <th>Maintenance Date</th>
            <th>Maintenance Details</th>
            <th>Maintenance Next Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($datas as $data)
        <tr>
            <th>{{ $data->maintenance_type_name }}</th>
            <th>{{ $data->vehicle_plate_number }}</th>
            <th>{{ date('d/m/Y', strtotime($data->maintenance_date)) }}</th>
            <th>{{ $data->maintenance_details }}</th>
            <th>{{ date('d/m/Y', strtotime($data->maintenance_next_date)) }}</th>
        </tr>
        @empty
        <tr>
            <th colspan="5" class="text-center">Sorry No Data Found.</th>
        </tr>
        @endforelse
    </tbody>
</table>