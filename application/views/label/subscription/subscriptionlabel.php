<?php
$jumlahReferall = array();
$jumlahReferalls = 0;
foreach ($getAllReferall as $referall){
    $jumlahReferall[] = $referall->jumlah;
    $jumlahReferalls = array_sum($jumlahReferall);
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-4 col-lg-4 hidden-xs hidden-sm">
            <div class="panel panel-info dashboard-panel">
                <div class="panel-heading" style="font-size: 70px; line-height: 70px">
                    <i class="glyphicon glyphicon-user"></i>
                    <span class="pull-right"><?= $jumlahReferalls; ?> </span>
                </div>
                <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                    Jumlah Referall
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
            <div class="panel panel-info dashboard-panel">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-user"></i>
                    <span class="pull-right"><b><?= $jumlahReferalls; ?></b></span>
                </div>
                <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                    Jumlah Referall
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
             <span class="col-xs-12 col-sm-12 col-md-12 hidden-lg">
                 <form class="form-search" method="post" action="">
                     <div class="input-group">
                        <select class="form-control" name="tanggalsubscriptionartist" id="tanggal" required="#ada1">
                            <option value=""><center>Filter By Date</center></option>
                            <?php
                            $nama_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            for($i = 0; $i<50;$i++ ){
                                $tgl = mktime(0, 0, 0, date('m')-$i, date('d', 1), date('Y'));
                                $tgl = date('Y-m',$tgl);
                                $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
                                $tahun = substr($tgl ,0,4);
                                $hasilbulan = $bulan.' '.$tahun;
                                ?>
                                <option id="ada1" value="<?php echo $tgl;?>"> <center><?php echo $hasilbulan; ?></center> </option>
                                <?php
                            }?>
                         </select>
                         <span class="input-group-btn">
                             <button class="btn btn-info" type="submit" name="submit">  Filter  </button>
                         </span>
                     </div>

                 </form>
                 <br/>
                 <form action="" method="post">
                     <select name="slct" id="pilihan" class="form-control">
                         <option>Select</option>
                         <?php
                         foreach ($getTypeSubscription as $subscription){
                             echo '<option value="'.str_replace(' ','',$subscription->subscription).'"> INFO '.$subscription->subscription.' </option>';
                         }
                         ?>

                     </select>
                 </form>

             </span>
</div>
<script type="text/javascript">
    $("#pilihan").change(function(){
        var pilihan = $("#pilihan").val();
        if(pilihan == "FREE"){
            $("#FREE").addClass("in active");
            $("#GUEST").removeClass("in active");
            $("#HAPPY").removeClass("in active");
            $("#HAPPYPLUS").removeClass("in active");
            $("#SEMINGGU").removeClass("in active");
            $("#SEBULAN").removeClass("in active");
            $("#TRIWULAN").removeClass("in active");
        }else if(pilihan == "GUEST"){
            $("#GUEST").addClass("in active");
            $("#FREE").removeClass("in active");
            $("#HAPPY").removeClass("in active");
            $("#HAPPYPLUS").removeClass("in active");
            $("#SEMINGGU").removeClass("in active");
            $("#SEBULAN").removeClass("in active");
            $("#TRIWULAN").removeClass("in active");
        }else if(pilihan == "HAPPY"){
            $("#HAPPY").addClass("in active");
            $("#FREE").removeClass("in active");
            $("#GUEST").removeClass("in active");
            $("#HAPPYPLUS").removeClass("in active");
            $("#SEMINGGU").removeClass("in active");
            $("#SEBULAN").removeClass("in active");
            $("#TRIWULAN").removeClass("in active");
        }else if(pilihan == "HAPPYPLUS"){
            $("#HAPPYPLUS").addClass("in active");
            $("#FREE").removeClass("in active");
            $("#HAPPY").removeClass("in active");
            $("#GUEST").removeClass("in active");
            $("#SEMINGGU").removeClass("in active");
            $("#SEBULAN").removeClass("in active");
            $("#TRIWULAN").removeClass("in active");
        }else if(pilihan == "SEMINGGU"){
            $("#SEMINGGU").addClass("in active");
            $("#FREE").removeClass("in active");
            $("#HAPPY").removeClass("in active");
            $("#HAPPYPLUS").removeClass("in active");
            $("#GUEST").removeClass("in active");
            $("#SEBULAN").removeClass("in active");
            $("#TRIWULAN").removeClass("in active");
        }else if(pilihan == "SEBULAN"){
            $("#SEBULAN").addClass("in active");
            $("#FREE").removeClass("in active");
            $("#HAPPY").removeClass("in active");
            $("#HAPPYPLUS").removeClass("in active");
            $("#SEMINGGU").removeClass("in active");
            $("#GUEST").removeClass("in active");
            $("#TRIWULAN").removeClass("in active");
        }else if(pilihan == "TRIWULAN"){
            $("#TRIWULAN").addClass("in active");
            $("#FREE").removeClass("in active");
            $("#HAPPY").removeClass("in active");
            $("#HAPPYPLUS").removeClass("in active");
            $("#SEMINGGU").removeClass("in active");
            $("#SEBULAN").removeClass("in active");
            $("#GUEST").removeClass("in active");
        }
    });

</script>

    <ul class="nav nav-tabs hidden-xs hidden-sm hidden-md">
        <?php
        foreach ($getTypeSubscription as $subscription){
            if($subscription->subscription == "FREE"){
                echo '<li class="active"><a data-toggle="tab" href="#'.str_replace(" ","",$subscription->subscription).'" style="color: black"><b>'.$subscription->subscription.'</b></a></li>';
            }
            else{
                echo '<li><a data-toggle="tab" href="#'.str_replace(" ","",$subscription->subscription).'" style="color: black"><b>'.$subscription->subscription.'</b></a></li>';
            }
        }
        ?>
        <form class="form-inline pull-right" method="post" action="">
            <select class="form-control" name="tanggalsubscriptionartist" id="tanggal" required="#ada1">
                <option value="">Filter By Date</option>
                <?php
                $nama_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                for($i = 0; $i<50;$i++ ){
                    $tgl = mktime(0, 0, 0, date('m')-$i, date('d', 1), date('Y'));
                    $tgl = date('Y-m',$tgl);
                    $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
                    $tahun = substr($tgl ,0,4);
                    $hasilbulan = $bulan.' '.$tahun;
                    ?>
                    <option id="ada1" value="<?php echo $tgl;?>"> <center><?php echo $hasilbulan; ?></center> </option>
                    <?php
                }?>
            </select>
            <button type="submit" class="btn btn-default btn-large" name="submit">Filter</button>
        </form>
    </ul>

    <div class="tab-content">
<?php
foreach ($getTypeSubscription as $subscription){
    if($subscription->subscription == "FREE"){
        echo '<div id="'.str_replace(' ','',$subscription->subscription).'" class="tab-pane fade in active"><br/>';

        $this->load->view('artist/subscription/grafiks/'.str_replace(' ','',$subscription->subscription));

        echo '</div>';
    }
    else{
        echo '<div id="'.str_replace(' ','',$subscription->subscription).'" class="tab-pane fade "><br/>';

        $this->load->view('artist/subscription/grafiks/'.str_replace(' ','',$subscription->subscription));

        echo '</div>';
    }
}
echo '</div>';