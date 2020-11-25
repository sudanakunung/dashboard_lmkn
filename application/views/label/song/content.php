<?php
foreach ($data as $d){
    $songIds = $d->songsId;
    $titles = $d->title;
    $coverImages = $d->coverImage;
    $names[] = $d->name;
    $dateCreateds = $d->dateCreated;
    $likes = $d->LIKEE;
    $viewer = $d->VIEWER;
    $recordered = $d->RECORDERED;
}
?>
<div class="row">
    <div class=" col-lg-12">
        <div class="panel panel-primary dashboard-panel" style="background-color: transparent">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-list"></i>
                <span class="pull-right"><b>DETAIL SONG</b></span>
            </div>
            <div class="panel-body" style="background-color: white">
                <div class="col-lg-4 pull-right">
                    <?php
                    if($coverImages == "" or empty($coverImages) or $coverImages == NULL){?>
                        <img src="image/user_placeholder.png" width="100%" height="50%" class="img-responsive img-thumbnail">
                        <?php
                    }
                    else { ?>
                        <img src="<?php echo $coverImages;?>" width="100%" height="50%" class="img-responsive img-thumbnail">
                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-8">
                    <div class="table-responsive" style="text-transform: uppercase;">
                        <table class="table table-hover" style="color: black">
                            <tr>
                                <td>Nama Artist</td>
                                <td><?php for($i = 0; $i < count($names); $i++){
                                        echo $names[$i].", ";
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Judul Lagu</td>
                                <td><?php echo $titles;?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Upload</td>
                                <td><?php echo $dateCreateds;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <span class="col-xs-12 col-sm-12 hidden-md hidden-lg">
        <form class="form-search" method="post" action="">
            <div class="input-group">
                <select class="form-control" name="tanggalcontent" id="tanggal" required="#ada1">
                        <option value=""><center>Filter By Date</center></option>
                    <?php
                    $nama_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                    for($i = 0; $i<50;$i++ ){
                        $tgl = mktime(0, 0, 0, date('m')-$i, date('d') + 1, date('Y'));
                        $tgl = date('Y-m',$tgl);
                        $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
                        $tahun = substr($tgl ,0,4);
                        $hasilbulan = $bulan.' '.$tahun;
                        ?>
                        <option id="ada1" value="<?php echo $tgl;?>"> <center><?php echo $hasilbulan; ?></center> </option>
                        <?php
                    }
                    ?>
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
            $("#home").addClass("in active");
            $("#menu1").addClass("hidden-xs");
            $("#menu2").addClass("hidden-xs");
            $("#menu1").removeClass("in active");
            $("#menu2").removeClass("in active");
            $("#home").removeClass("hidden-xs");
        }else if(pilihan == "menus1"){
            $("#menu1").addClass("in active");
            $("#home").addClass("hidden-xs");
            $("#menu2").addClass("hidden-xs");
            $("#menu1").removeClass("hidden-xs");
            $("#menu2").removeClass("in active");
            $("#home").removeClass("in active");
        }else if(pilihan == "menus2"){
            $("#menu2").addClass("in active");
            $("#home").addClass("hidden-xs");
            $("#menu1").addClass("hidden-xs");
            $("#menu2").removeClass("hidden-xs");
            $("#home").removeClass("in active");
            $("#menu1").removeClass("in active");
        }
    });
</script>
<ul class="nav nav-tabs hidden-xs hidden-sm">
    <li class="active"><a data-toggle="tab" href="#home" style="color: black"><b>INFO USER RECORDER</b></a></li>
    <li><a data-toggle="tab" href="#menu1"  style="color: black"><b>INFO USER LIKE</b></a></li>
    <li><a data-toggle="tab" href="#menu2"  style="color: black"><b>INFO USER VIEWER</b></a></li>
    <!--            <li><a data-toggle="tab" href="#menu3"  style="color: black"><b>INFO USER SUBSCRIPTION</b></a></li>-->
    <form class="form-inline pull-right" method="post" action="">
        <select class="form-control" name="tanggalcontent" id="tanggal" required="#ada1">
            <option value="">Filter By Date</option>
            <?php
            $nama_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            for($i = 0; $i<50;$i++ ){
                $tgl = mktime(0, 0, 0, date('m')-$i, date('d') + 1, date('Y'));
                $tgl = date('Y-m',$tgl);
                $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
                $tahun = substr($tgl ,0,4);
                $hasilbulan = $bulan.' '.$tahun;
                ?>
                <option id="ada1" value="<?php echo $tgl;?>"> <?php echo $hasilbulan; ?> </option>
                <?php
            }?>
        </select>
        <button type="submit" class="btn btn-default btn-large" name="submit">Filter</button>
    </form>
</ul>
<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <br/>
        <?php
        $this->load->view('label/song/recorder');
        ?>
    </div>
    <div id="menu1" class="tab-pane fade">
        <br/>
        <?php
        $this->load->view('label/song/like');
        ?>
    </div>
    <div id="menu2" class="tab-pane fade">
        <br/>
        <?php
        $this->load->view('label/song/viewer');
        ?>
    </div>
</div>