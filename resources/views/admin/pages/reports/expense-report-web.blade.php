<table class="table card-table">
    <thead>
        <tr>
            <th width="10%">Company</th>
            <th width="10%">Vehicle</th>
            <th width="20%">Trip Details</th>
            <th width="10%">Expense Type</th>
            <th width="10%">Expense Date</th>
            <th width="30%">Expense Details</th>
            <th width="10%">Amount</th>
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