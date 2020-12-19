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
            <th>Status</th>
            <th>Time</th>
            <th>Duration</th>
            <th>Distance</th>
        </tr>
        <?php
        $i = 0;
        $engineOnStatusArray = array();
        $engineOffStatusArray = array();
        $onStatus = 0;
        $offStatus = 0;
        for ($i; $i < count($datas); $i++) {
            if ($datas[$i]->status == 1) {
                showRow($engineOffStatusArray, $datas, $i);
                $offStatus = 0;
                $engineOffStatusArray = array();
                $engineOnStatusArray[$onStatus] = ['ON', $datas[$i]->created_at, $datas[$i]->latitude, $datas[$i]->longitude];
                $onStatus++;
                if ($i == (count($datas) - 1)) {
                    showRow($engineOnStatusArray, $datas, $i);
                }
            } else {
                showRow($engineOnStatusArray, $datas, $i);
                $onStatus = 0;
                $engineOnStatusArray = array();
                $engineOffStatusArray[$offStatus] = ['OFF', $datas[$i]->created_at, $datas[$i]->latitude, $datas[$i]->longitude];
                $offStatus++;
                if ($i == (count($datas) - 1)) {
                    showRow($engineOffStatusArray, $datas, $i);
                }
            }
        }

        function showRow($data, $datas, $datasIndex)
        {
            if (!empty($data)) {
        ?>
                <tr>
                    <th scope="row"><?php echo $data[0][0]; ?></th>
                    <td><?php echo  date('G:i:sA', strtotime($data[0][1])) . ' To ' .  date('G:i:sA', strtotime($datas[$datasIndex]->created_at)); ?></td>
                    <td>
                        <?php
                        $firstTime = new DateTime(date('G:i:s', strtotime($data[0][1])));
                        $lastTime = new DateTime(date('G:i:s', strtotime($datas[$datasIndex]->created_at)));
                        $interval = $firstTime->diff($lastTime);
                        echo $interval->format('%h hr %i min %s sec')
                        ?>
                    </td>
                    <td>
                        <?php
                        $oldLat = null;
                        $oldLng = null;
                        $totalKm = 0;
                        $dataIndex = 0;
                        for ($dataIndex; $dataIndex < count($data); $dataIndex++) {
                            if (($dataIndex % 2 == 0) || $dataIndex == 0) {
                                $oldLat = $data[$dataIndex][2];
                                $oldLng = $data[$dataIndex][3];
                                if ($dataIndex != 0) {
                                    $totalKm +=  calculateDistance($data[$dataIndex - 1][2], $data[$dataIndex - 1][3], $oldLat, $oldLng);
                                }
                            } else {
                                $totalKm +=  calculateDistance($oldLat, $oldLng, $data[$dataIndex][2], $data[$dataIndex][3]);
                            }
                        }
                        echo  round($totalKm, 2) . ' KM';
                        $totalKm = 0;
                        ?>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>

</html>