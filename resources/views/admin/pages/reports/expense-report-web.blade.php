<table class="table card-table table-vcenter text-nowrap">
    <thead>
        <tr>
            <th>Expenses Description</th>
            <th>Expeses Amount</th>
            <th>Expenses Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($datas as $data)
        <tr>
            <th>{{ $data->expense_description }}</th>
            <th>{{ $data->expense_amount }}</th>
            <th>{{ date('d/m/Y', strtotime($data->created_at)) }}</th>
        </tr>
        @empty
        <tr>
            <th colspan="3" class="text-center">Sorry No Data Found.</th>
        </tr>
        @endforelse
    </tbody>
</table>