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
            <th>Time</th>
            <th>Hours</th>
            <th>Distance</th>
            <th>Fuel</th>
        </tr>
        <?php
        $oldLat = null;
        $oldLng = null;
        $totalKm = 0;
        $i = 0;
        $hour = 0;
        $subTotalKm = array();
        $subTotalKmIndex = 0;
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
                            // echo date('G:i', mktime($hour, 0, 0));
                            // echo '<br/>';
                            // echo date('G:i', strtotime($datas[$i]->created_at)) . '-' . $i;
                            // echo '<br/>';

                            if (($i % 2 == 0) || $i == 0) {
                                $oldLat = $datas[$i]->latitude;
                                $oldLng = $datas[$i]->longitude;
                                // echo $oldLat . '-' . $oldLng;
                                // echo '----------------';
                                // echo "<br/>";
                            } else {
                                // echo 'oldLat=' . $oldLat . ', oldLng=' . $oldLng . ', newLat =' . $datas[$i]->latitude . ', newLng=' . $datas[$i]->longitude;
                                // echo '<br/>';
                                // if($oldLat != null && $oldLat != 0 && $oldLng != null && $oldLng != 0 && $ )
                                $totalKm +=  calculateDistance($oldLat, $oldLng, $datas[$i]->latitude, $datas[$i]->longitude);
                            }
                        } else {
                            echo  round($totalKm, 2) . ' KM';
                            $subTotalKm[$subTotalKmIndex] = round($totalKm, 2);
                            $subTotalKmIndex++;
                            $totalKm = 0;
                            break;
                        }
                    }
                    ?>
                </td>
                <td></td>
            </tr>
        <?php
            $hour++;
        }
        ?>
        <tr>
            <th colspan="2">Total</th>
            <th><?php echo array_sum($subTotalKm); ?></th>
            <th></th>
        </tr>
    </table>
</body>

</html>