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
                $loopDatedArray[$dateArrayIndex] = [$datas[$i]->latitude, $datas[$i]->longitude];
                $dateArrayIndex++;
                if ($i == (count($datas) - 1)) {
                    showRow($loopDate, $loopDatedArray);
                }
            } else {
                showRow($loopDate, $loopDatedArray);
                $loopDate = date('Y-m-d', strtotime($datas[$i]->created_at));
                $dateArrayIndex = 0;
                $loopDatedArray[$dateArrayIndex] = [$datas[$i]->latitude, $datas[$i]->longitude];
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
                        if (($dataIndex % 2 == 0) || $dataIndex == 0) {
                            $oldLat = $data[$dataIndex][0];
                            $oldLng = $data[$dataIndex][1];
                        } else {
                            $totalKm +=  calculateDistance($oldLat, $oldLng, $data[$dataIndex][0], $data[$dataIndex][1]);
                        }
                    }
                    echo  round($totalKm, 2) . ' KM';
                    $totalKm = 0;
                    ?>
                </td>
                <td></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>