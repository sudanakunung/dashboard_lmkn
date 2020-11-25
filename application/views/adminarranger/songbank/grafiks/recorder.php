<?php
if(empty($infoGrafikRecorder)){ ?>
    <div class="row">
        <div class="col-md-6 col-lg-6 hidden-xs hidden-sm">
            <div class="panel panel-danger dashboard-panel" style="background-color: transparent">
                <div class="panel-heading" style="font-size: 70px; line-height: 70px">
                    <i class="glyphicon glyphicon-list"></i>
                    <span class="pull-right">0</span>
                </div>
                <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">Jumlah User Recorder Lagu Anda</div>
            </div>
        </div>

        <div class="col-sm-12 col-xs-12 hidden-md hidden-lg">
            <div class="panel panel-danger dashboard-panel">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-list"></i>
                    <span class="pull-right">0</span>
                </div>
                <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">Jumlah User Recorder Lagu Anda</div>
            </div>
        </div>
        <div class="col-md-6">
            <canvas id="myChartlabel_recorder">

            </canvas>
        </div>
    </div>
    <script type="text/javascript">
        var ctx = document.getElementById("myChartlabel_recorder");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [ <?php echo '"Data Kosong",'; ?>],
                datasets: [{
                    label: 'Users',
                    data: [
                        <?php echo '"0",';?>],
                    backgroundColor: [
                        'red',
                    ],
                    borderColor: [
                        'red',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
<?php
}
else{
    foreach ($infoGrafikRecorder as $info) :
    $genders[] = $info->gender;
    $jumlahs[] = $info->jumlah;
    $jumlah_users = array_sum($jumlahs);

    endforeach;
    ?>

    <div class="row">
        <div class="col-md-6 col-lg-6 hidden-xs hidden-sm">
            <div class="row-md-12">
                <div class="panel panel-default dashboard-panel" style="background-color: transparent">
                    <div class="panel-heading" style="font-size: 70px; line-height: 70px">
                        <i class="glyphicon glyphicon-list"></i>
                        <span class="pull-right"><?php echo $jumlah_users; ?></span>
                    </div>
                    <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">Jumlah User Recorder Lagu Anda<br/><br/>
                        <div class="col-md-12">
                            <?php for ($a=0;$a<count($genders) AND $a<count($jumlahs);$a++){

                                echo '<div class="panel panel-info dashboard-panel">
                                    <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                                <span class="pull-left">';
                                if($genders[$a] == NULL){
                                    echo 'Unknow';
                                }
                                elseif($genders[$a]=='F' or $genders[$a] == 'f'){
                                    echo 'Female';
                                }
                                elseif($genders[$a]=='M' or $genders[$a] == 'm'){
                                    echo 'Male';
                                }

                                echo '</span>
                                <span class="pull-right" > '.$jumlahs[$a].'</span>
                            </div>
                            </div>'; }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xs-12 hidden-md hidden-lg">
            <div class="row-md-12">
                <div class="panel panel-default dashboard-panel" style="background-color: transparent">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-list"></i>
                        <span class="pull-right"><?php echo $jumlah_users; ?></span>
                    </div>
                    <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">Jumlah User Recorder Lagu Anda<br/><br/>
                        <div class="col-md-12">
                            <?php for ($a=0;$a<count($genders) AND $a<count($jumlahs);$a++){

                                echo '<div class="panel panel-info dashboard-panel">
                                    <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                                <span class="pull-left">';
                                if($genders[$a] == NULL){
                                    echo 'Unknow';
                                }
                                elseif($genders[$a]=='F' or $genders[$a] == 'f'){
                                    echo 'Female';
                                }
                                elseif($genders[$a]=='M' or $genders[$a] == 'm'){
                                    echo 'Male';
                                }

                                echo '</span>
                                <span class="pull-right" > '.$jumlahs[$a].'</span>
                            </div>
                            </div>'; }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--            akhir tag untuk menegtahui jumlah user-->

        <!--            tag untuk chart-->
        <div class="col-md-6">
            <canvas id="myChartlabel_recorder" style="width: 20px; height: 50px; margin-bottom: 20px; margin-top: 40px">

            </canvas>
        </div>

    </div>


    <script type="text/javascript">
        var ctx = document.getElementById("myChartlabel_recorder");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [<?php for($i=0;$i<count($genders);$i++){
                    if($genders[$i] == NULL){
                        echo '"Unknow",';
                    }
                    elseif($genders[$i] == 'M' or $genders[$i] == 'm')
                    {
                        echo '"MALE",';
                    }
                    elseif($genders[$i] == 'F' or $genders[$i] == 'f')
                    {
                        echo '"FEMALE",';
                    }
                }?>],
                datasets: [{
                    label: 'Users',
                    data: [<?php for($i=0;$i<count($jumlahs);$i++){
                        echo '"' . number_format(($jumlahs[$i]/$jumlah_users) * 100,2) . '",';}?>],
                    backgroundColor: [
                        <?php for($i=0;$i<count($genders);$i++){
                        if($genders[$i] == NULL){ ?>
                        'rgba(153, 102, 255, 100)',
                        <?php }
                        elseif($genders[$i] == 'M' or $genders[$i] == 'm')
                        { ?>
                        'rgba(255, 255, 0,100)',
                        <?php  }
                        elseif($genders[$i] == 'F' or $genders[$i] == 'f')
                        { ?>
                        'rgba(255, 105, 180,100)',
                        <?php  }
                        }?>

                    ],
                    borderColor: [
                        <?php for($i=0;$i<count($genders);$i++){
                        if($genders[$i] == NULL){ ?>
                        'rgba(153, 102, 255, 100)',
                        <?php }
                        elseif($genders[$i] == 'M' or $genders[$i] == 'm')
                        { ?>
                        'rgba(255, 255, 0,100)',
                        <?php  }
                        elseif($genders[$i] == 'F' or $genders[$i] == 'f')
                        { ?>
                        'rgba(255, 105, 180,100)',
                        <?php  }
                        }?>
                    ],
                    borderWidth: 1
                }]
            },
            options: {
            }
        });
    </script>
    <?php
}

