<?= $this->session->flashdata('sukses_aksi_tambahsonguser'); ?>

<?= $this->session->flashdata('error_aksi_tambahsonguser'); ?>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-info dashboard-panel">
            <div class="panel-heading" style="font-size: 30px; line-height: 40px">
                <i class="glyphicon glyphicon-user"></i>
                <span class="pull-right">
                    <?php echo $totalUser->jumlah; ?>
                </span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                Total User MYDIOSING
            </div>
        </div>
    </div>
    <br/>
    <div class="col-md-offset-3 col-md-3 col-sm-12 col-xs-12">
        <form class="form-search" method="post" action="<?php echo base_url('songbankadminartist/index')?>">
            <div class="input-group">
                <select class="form-control" name="tanggalsonguser"  id="bulan" required="#ada">
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
    </div>
</div>

<h3 class="page-header">
    <b>Song Bank</b>
    <a href="<?= base_url('songbankadmincomposer/tambah') ?>" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Add a song </a>
</h3>

<div class="card mb-20" style="background: #eee;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('songbankadmincomposer/index'), 'keyword', 'Search Title'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataSongbank) {
       buka_tabel(array("Title", "Composer", "Recording", "Like", "View", "Total"), $action = true, 'Chart');

        foreach ($dataSongbank as $songbank){
            
            $composer_name = ($songbank->composer_name == NULL || empty($songbank->composer_name) ? "-" : $songbank->composer_name);

            isi_tabel(++$start, array($songbank->title,$composer_name,$songbank->JUMLAH_RECORDING, $songbank->JUMLAH_LIKE, $songbank->JUMLAH_VIEW, $songbank->jumlah), base_url('songbankadmincomposer/grafik'),$songbank->songId,$awal,$akhir,true);
        }

        tutup_tabel();
    } else { ?>
        <div class="row">
            <div class="col-md-12 text-center mb-10">
                <h3>The data you are looking for was not found</h3>
            </div>
        </div>
    <?php
    }
    ?>

    <div class="card-footer">
        <div class="col-md-6">
            <p class="total-data">Total : <?= $total_data; ?></p>
        </div>
        <div class="col-md-6">
            <?= $this->pagination->create_links(); ?>
        </div>
        <div class="clearfix"></div>
    </div>

</div>