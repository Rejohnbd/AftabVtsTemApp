<table class="table card-table table-vcenter text-nowrap">
    <thead>
        <tr>
            <th>Time</th>
            <th>Hours</th>
            <th>Distance</th>
            <th>Fuel</th>
        </tr>
    </thead>
    <tbody>
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
                            if (($i % 2 == 0) || $i == 0) {
                                $oldLat = $datas[$i]->latitude;
                                $oldLng = $datas[$i]->longitude;
                                if ($i != 0) {
                                    $totalKm +=  calculateDistance($datas[$i - 1]->latitude, $datas[$i - 1]->longitude, $oldLat, $oldLng,);
                                }
                            } else {
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
            <th><?php echo array_sum($subTotalKm) . ' Km'; ?></th>
            <th></th>
        </tr>
    </tbody>
</table>