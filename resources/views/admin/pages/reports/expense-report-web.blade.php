<table class="table card-table table-vcenter text-nowrap">
    <thead>
        <tr>
            <th>Company</th>
            <th>Vehicle</th>
            <th>Trip Details</th>
            <th>Expense Type</th>
            <th>Expense Date</th>
            <th>Expense Details</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalAmount = 0;
        ?>
        @forelse($datas as $data)
        <tr>
            <th>{{ $data->company_name }}</th>
            <th>{{ $data->vehicle_plate_number }}</th>
            <th>{{ $data->trip_details }}</th>
            <th>{{ $data->expense_type_name }}</th>
            <th>{{ date('d/m/Y', strtotime($data->expense_date)) }}</th>
            <th>{{ $data->expense_description }}</th>
            <th>{{ $data->expense_amount }} <?php $totalAmount = $totalAmount + $data->expense_amount; ?></th>
        </tr>
        @empty
        <tr>
            <th colspan="7" class="text-center">Sorry No Data Found.</th>
        </tr>
        @endforelse
        <?php
        if (!$totalAmount == 0) {
        ?>
            <tr>
                <th colspan="6" class="text-right">Total:</th>
                <th class="text-center"><?php echo $totalAmount . 'Tk'; ?></th>
            </tr>
        <?php } ?>
    </tbody>
</table>