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
            padding: 6px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 6px;
            padding-bottom: 6px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <h4 style="text-align: center; margin-bottom: 0px; padding-bottom: 0px;">Aftab Bahumukhi Farms Ltd</h4>
    <h5 style="text-align: center; margin-top: 0px; padding-top: 0px;">Vehicle Number: <?php echo $regiNumber;?>, &nbsp; Date: <?php echo $downloaddate; ?></h5>
    <table id="customers">
        <tr>
            <th>Time</th>
            <th>Hours</th>
            <th>Distance</th>
            <th>Fuel</th>
        </tr>
        <?php
        $oldLat = null;
        $oldLng = null;
        $totalKm = 0;
        $totalFuel = 0;
        $i = 0;
        $hour = 0;
        $subTotalKm = array();
        $subTotalKmIndex = 0;
        $subTotalFuel = array();
        $subTotalFuelIndex = 0;
        while ($hour < 24) {
        ?>
            <tr>
                <th scope="row"><?php echo date('G:iA', mktime($hour, 0, 0)) . '-' . date('G:iA', mktime($hour + 1, 0, 0)); ?></th>
                <td>
                    <?= $hour + 1 ?>
                    <?php
                    if ($hour + 1 == 1 || $hour + 1  == 11 || $hour + 1  == 21) echo '<sup>st</sup> Hour';
                    else if ($hour + 1  == 2 || $hour + 1  == 12 || $hour + 1  == 22) echo '<sup>nd</sup> Hour';
                    else if ($hour + 1  == 3 || $hour + 1  == 13 || $hour + 1  == 23) echo '<sup>rd</sup> Hour';
                    else echo '<sup>th</sup> Hour';
                    ?>
                </td>
                <td>
                    <?php
                    for ($i; $i < count($datas); $i++) {
                        if (strtotime(date('G:i', mktime($hour, 0, 0))) <= strtotime(date('G:i', strtotime($datas[$i]->created_at))) && strtotime(date('G:i', strtotime($datas[$i]->created_at))) < strtotime(date('G:i', mktime($hour + 1, 0, 0)))) {
                            if ($datas[$i]->status == 0 && $datas[$i]->speed <= 1) {
                                $totalKm += $datas[$i]->distance;
                                $totalFuel += $datas[$i]->fuel_use; 
                            } else if ($datas[$i]->status == 1) {
                                $totalKm += $datas[$i]->distance;
                                $totalFuel += $datas[$i]->fuel_use; 
                            }
                        } else {
                            echo  round($totalKm, 2) . ' KM';
                            $subTotalKm[$subTotalKmIndex] = $totalKm;
                            $subTotalKmIndex++;
                            $totalKm = 0;
                            break;
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                        echo round($totalFuel, 2) . ' Ltr';
                        $subTotalFuel[$subTotalFuelIndex] = $totalFuel;
                        $subTotalFuelIndex++;
                        $totalFuel = 0;
                    ?>
                </td>
            </tr>
        <?php
            $hour++;
        }
        ?>
        <tr>
            <th colspan="2">Total</th>
            <th><?php echo array_sum($subTotalKm) . ' Km'; ?></th>
            <th><?php echo array_sum($subTotalFuel) . ' Ltr'; ?></th>
        </tr>
    </table>
</body>

</html>