<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 8px;
            padding-bottom: 8px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <table id="customers">
        <tr>
            <th>Day</th>
            <th>Distance</th>
            <th>Fuel</th>
        </tr>
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
    </table>
</body>

</html>