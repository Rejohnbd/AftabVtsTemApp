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
        for ($i = 0; $i < count($datas); $i++) {
            if ($loopDate == date('Y-m-d', strtotime($datas[$i]->created_at))) {
                $loopDatedArray[$dateArrayIndex] = [$datas[$i]->distance, $datas[$i]->status, $datas[$i]->speed];
                if ($i == (count($datas) - 1)) {
                    showRow($loopDate, $loopDatedArray);
                }
                $dateArrayIndex++;
            } else {
                showRow($loopDate, $loopDatedArray);
                $loopDate = date('Y-m-d', strtotime($datas[$i]->created_at));
                $loopDatedArray = null;
                $dateArrayIndex = 0;
                $loopDatedArray[$dateArrayIndex] = [$datas[$i]->distance, $datas[$i]->status, $datas[$i]->speed];
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
                    $dataIndex = 0;
                    for ($dataIndex; $dataIndex < count($data); $dataIndex++) {
                        if ($data[$dataIndex][1] == 0 && $data[$dataIndex][2] <= 1) {
                            $totalKm += $data[$dataIndex][0];
                        } else if ($data[$dataIndex][1] == 1) {
                            $totalKm += $data[$dataIndex][0];
                        }
                    }
                    echo  round($totalKm, 2) . ' KM';
                    $totalKm = 0;
                    $dataIndex = 0;
                    ?>
                </td>
                <td></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>