<?php
$total_user_recorder = array_sum($statistikRecorder[1]);
$genders = $statistikRecorder[0];
$jumlahuserids = $statistikRecorder[1];
?>
<div class="row">
    <div class="hidden-xs hidden-sm col-md-6 col-lg-6">
        <div class="panel panel-info dashboard-panel">
            <div class="panel-heading" style="font-size: 70px; line-height: 70px">
                <i class="glyphicon glyphicon-list"></i>
                <span class="pull-right"><?php echo $total_user_recorder; ?></span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">Jumlah User Recorder Lagu Anda<br/></br/>
                <div class="col-md-12">
                    <?php for ($a=0;$a<count($genders) AND $a<count($jumlahuserids);$a++){

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
                                <span class="pull-right" > '.$jumlahuserids[$a].'</span>
                            </div>
                            </div>'; }?>

                </div>
            </div>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
        <div class="panel panel-info dashboard-panel">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i>
                <span class="pull-right"><?php echo $total_user_recorder; ?></span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">Jumlah User Recorder Lagu Anda<br/></br/>
                <div class="col-md-12">
                    <?php for ($a=0;$a<count($genders) AND $a<count($jumlahuserids);$a++){

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
                                <span class="pull-right" > '.$jumlahuserids[$a].'</span>
                            </div>
                            </div>'; }?>

                </div>
            </div>
        </div>

    </div>

    <!--    buat chart-->
    <div class="col-md-6">
        <canvas id="myChartRecorder" style="width: 20px; height: 50px; margin-bottom: 20px; margin-top: 40px"></canvas>
    </div>
</div>

<!--buat grafiknya di sini-->

<?php
$nol = 0;
if(empty($genders)){ ?>
    <script type="text/javascript">
        var ctx = document.getElementById("myChartRecorder");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [ <?php echo '"Data Kosong",'; ?>],
                datasets: [{
                    label: 'Users',
                    data: [
                        <?php echo '"' . $nol . '",';?>],
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

<?php  } else{ ?>

    <script>
        var ctx = document.getElementById("myChartRecorder");
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
                    data: [<?php for($i=0;$i<count($jumlahuserids);$i++){
                        echo '"' . number_format(($jumlahuserids[$i]/$total_user_recorder) * 100, 2) . '",';}?>],
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