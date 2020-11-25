<?php
$songIds = array();
$nameArtists = array();
$titles = array();
$recorders = array();
$jumlahs  = array();
echo '<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><b>TOP SONG`S</b></div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="border-width: 0.1px">
                        <thead style="text-align: center; font-weight: bolder">
                        <tr>
                            <td>Warna Chart</td>
                            <td>Song Id</td>
                            <td>Artist</td>
                            <td>Judul</td>
                            <td>Recorder</td>
                            <td>Like</td>
                            <td>Viewer</td>
                            <td>Jumlah</td>
                        </tr>
                        </thead>
                        <tbody style="text-align: center;">';
                        $colors = array('black', 'green', 'blue', 'yellow', 'red', 'orange', 'purple', 'pink', 'brown', 'gray');
                        $color = 0;
                        foreach ($topSong as $data){
                        $songIds[] = $data->songIds;
                        $nameArtists[] = $data->name;
                        $titles[] = $data->title;
                        $recorders[] = $data->recorder;
                        $jumlahs[]  = $data->jumlah;
                        echo           '<tr>';

                            echo                '<td style="background-color: '.$colors[$color].'">          </td>';

                            echo                '<td>'.$data->songIds.'</td>';
                            echo                '<td>'.$data->name.'</td>';
                            echo                '<td>'.$data->title.'</td>';
                            echo                '<td>'.$data->recorder.'</td>';
                            echo                '<td>'.$data->liker.'</td>';
                            echo                '<td>'.$data->viewer.'</td>';
                            echo                '<td>'.$data->jumlah.'</td>';
                            echo           '</tr>';
                        $color++;
                        }
                        echo        '</tbody>
                    </table>
                </div>';
                echo '  <div class="col-lg-offset-3 col-md-offset-3 col-md-6 col-xs-12 col-sm-12">

                    <canvas id="myChart"></canvas>

                </div>';
                echo         '</div>
        </div>';
        echo '  </div>';


    if(array_sum($jumlahs) == 0) {
    $kosong = 0; ?>
    <script type="text/javascript">
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [ <?php echo '"Data Kosong",'; ?>],
                datasets: [{
                    label: 'Users',
                    data: [
                        <?php echo '"' . $kosong . '",';?>],
                    backgroundColor: [
                        'white',
                    ],
                    borderColor: [
                        'white',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
    </script>
    <?php
    }
    else{ ?>
    <script type="text/javascript">
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [<?php for($i=0;$i<count($songIds);$i++){
                    echo '"' . $songIds[$i] . '",';
                }?>],
                datasets: [{
                    label: 'Users',
                    data: [<?php for($i=0;$i<count($jumlahs);$i++){
                        echo '"' .$jumlahs[$i]. '",';}?>],
                    backgroundColor: [
                        'black',
                        'green',
                        'blue',
                        'yellow',
                        'red',
                        'orange',
                        'purple',
                        'pink',
                        'brown',
                        'gray'
                    ],
                    borderColor: [

                    ],
                    borderWidth: 0
                }]
            },
            options: {
            }
        });
    </script>
<?php

}
echo '</div>';