<table class="table card-table table-vcenter text-nowrap">
    <thead>
        <tr>
            <th>Day</th>
            <th>Distance</th>
            <th>Fuel</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $loopDate = date('Y-m-d', strtotime($datas[0]->created_at));
        $loopDatedArray = array();
        $dateArrayIndex = 0;
        $subTotal = 0;
        $subTotalFuel = 0;
        for ($i = 0; $i < count($datas); $i++) {
            if ($loopDate == date('Y-m-d', strtotime($datas[$i]->created_at))) {
                $loopDatedArray[$dateArrayIndex] = [$datas[$i]->distance, $datas[$i]->status, $datas[$i]->speed, $datas[$i]->fuel_use];
                if ($i == (count($datas) - 1)) {
                    $returnedValue = showRow($loopDate, $loopDatedArray);
                    $subTotal = $subTotal + $returnedValue[0];
                    $subTotalFuel = $subTotalFuel + $returnedValue[1];
                }
                $dateArrayIndex++;
            } else {
                $returnedValue = showRow($loopDate, $loopDatedArray);
                $subTotal = $subTotal + $returnedValue[0];
                $subTotalFuel = $subTotalFuel + $returnedValue[1];
                $loopDate = date('Y-m-d', strtotime($datas[$i]->created_at));
                $loopDatedArray = null;
                $dateArrayIndex = 0;
                $loopDatedArray[$dateArrayIndex] = [$datas[$i]->distance, $datas[$i]->status, $datas[$i]->speed, $datas[$i]->fuel_use];
                $dateArrayIndex++;
            }
        }

        function showRow($date, $data)
        {
        ?>
            <tr>
                <th scope="row"><?php echo date('j-M-Y, l', strtotime($date)); ?></th>
                <td>
                    <?php
                    $oldLat = null;
                    $oldLng = null;
                    $totalKm = 0;
                    $totalFuel = 0;
                    $dataIndex = 0;
                    for ($dataIndex; $dataIndex < count($data); $dataIndex++) {
                        if ($data[$dataIndex][1] == 0 && $data[$dataIndex][2] <= 1) {
                            $totalKm += $data[$dataIndex][0];
                            $totalFuel += $data[$dataIndex][3]; 
                        } else if ($data[$dataIndex][1] == 1) {
                            $totalKm += $data[$dataIndex][0];
                            $totalFuel += $data[$dataIndex][3]; 
                        }
                    }
                    echo  round($totalKm, 2) . ' KM';
                    $retotalKm = round($totalKm, 2);
                    $totalKm = 0;
                    $dataIndex = 0;
                    ?>
                </td>
                <td>
                    <?php
                        echo round($totalFuel, 2) . ' Ltr';
                        $retotalFuel = round($totalFuel, 2);
                        $totalFuel = 0;
                    ?>
                </td>
            </tr>
        <?php
        return array($retotalKm, $retotalFuel);
        }
        ?>
        <tr>
            <th>Total</th>
            <th><?php echo $subTotal . ' Km'; ?></th>
            <th><?php echo $subTotalFuel . ' Ltr'; ?></th>
        </tr>
    </tbody>
</table>