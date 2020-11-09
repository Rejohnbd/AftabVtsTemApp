<table class="table card-table table-vcenter text-nowrap">
    <thead>
        <tr>
            <th>Temperature</th>
            <th>Humidity</th>
            <th>Status</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td>{{ $report->temperature	}}</td>
            <td>{{ $report->humidity}}</td>
            <td>@if($report->comp_status == 0) {{'OFF'}} @else {{'ON'}} @endif</td>
            <td>{{ $report->created_at->format('d/m/Y') }}</td>
            <td>{{ $report->created_at->format('H:i:s A') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-2">
    {!! $reports->links() !!}
</div>
<br />
<br />