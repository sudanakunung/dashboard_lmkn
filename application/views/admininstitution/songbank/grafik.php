<?php

 foreach($informasiSong as $info): ?>

<div class="row">

    <div class="col-md-6 col-lg-6 hidden-sm hidden-xs pull-left">
        <img class="img img-responsive img-thumbnail" src="<?php echo $info->coverImage; ?>" width="50%">
    </div>

    <div class="col-sm-12 col-xs-12 hidden-lg hidden-md pull-left">
        <img class="img img-responsive img-thumbnail" src="<?php echo $info->coverImage; ?>">
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-music"></i>
                <span class="pull-right"><b><?php echo 'Title'; ?></b></span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold"><?php echo $info->title; ?></div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-open"></i>
                <span class="pull-right"><b><?php echo 'Upload Date'; ?></b></span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold"><?php echo $info->dateCreated; ?></div>
        </div>
    </div>

</div>
 <?php endforeach ?>

<div class="row">
             <span class="col-xs-12 col-sm-12 hidden-md hidden-lg">
                 <form class="form-search" method="post" action="" >
                     <div class="input-group">
                        <select class="form-control" name="tanggalsonguser" id="tanggal" required="#ada1">
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
                         <option value="homes" selected="selected"> INFO USER RECORDER </option>
                         <option value="menus1"> INFO USER LIKE </option>
                         <option value="menus2"> INFO USER VIEWER </option>
                     </select>
                 </form>

             </span>
</div>

<script type="text/javascript">
    $("#pilihan").change(function(){
        var pilihan = $("#pilihan").val();
        if(pilihan == "homes"){
            $("#homes").addClass("in active");
            $("#menus1").addClass("hidden-xs");
            $("#menus2").addClass("hidden-xs");
            $("#menus1").removeClass("in active");
            $("#menus2").removeClass("in active");
            $("#homes").removeClass("hidden-xs");
        }else if(pilihan == "menus1"){
            $("#menus1").addClass("in active");
            $("#homes").addClass("hidden-xs");
            $("#menus2").addClass("hidden-xs");
            $("#menus1").removeClass("hidden-xs");
            $("#menus2").removeClass("in active");
            $("#homes").removeClass("in active");
        }else if(pilihan == "menus2"){
            $("#menus2").addClass("in active");
            $("#homes").addClass("hidden-xs");
            $("#menus1").addClass("hidden-xs");
            $("#menus2").removeClass("hidden-xs");
            $("#homes").removeClass("in active");
            $("#menus1").removeClass("in active");
        }
    });
</script>
<hr align="center" width="100%" class="hidden-xs hidden-sm" style="border-width: 0.1px;border-color: black">
<div class="row">
    <ul class="nav nav-tabs hidden-xs hidden-sm">
        <li class="active"><a data-toggle="tab" href="#homes" style="color: black"><b>INFO USER RECORDER</b></a></li>
        <li><a data-toggle="tab" href="#menus1"  style="color: black"><b>INFO USER LIKE</b></a></li>
        <li><a data-toggle="tab" href="#menus2"  style="color: black"><b>INFO USER VIEWER</b></a></li>

        <form class="form-inline pull-right" method="post" action="">
            <select class="form-control" name="tanggalsonguser" id="tanggal" required="#ada1">
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
        <div id="homes" class="tab-pane fade in active">
            <br/>
            <?php $this->load->view('adminartist/songbank/grafiks/recorder'); ?>
        </div>
        <div id="menus1" class="tab-pane fade">
            <br/>
            <?php $this->load->view('adminartist/songbank/grafiks/liker'); ?>
        </div>
        <div id="menus2" class="tab-pane fade">
            <br/>
            <?php $this->load->view('adminartist/songbank/grafiks/viewer'); ?>
        </div>
    </div>
</div>