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
            padding: 3px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 3px;
            padding-bottom: 3px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <h4 style="text-align: center; margin-bottom: 0px; padding-bottom: 0px;">Aftab Bahumukhi Farms Ltd</h4>
    <h5 style="text-align: center; margin-top: 0px; padding-top: 0px;">Vehicle Number: <?php echo $regiNumber;?>, &nbsp; Month: <?php echo $year.'-'.$month; ?></h5>
    <table id="customers">
        <tr>
            <th>Date &amp; Day</th>
            <th>Distance</th>
            <th>Fuel</th>
        </tr>
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
    </table>
</body>

</html>