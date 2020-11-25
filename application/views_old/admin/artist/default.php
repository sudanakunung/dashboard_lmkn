<h3 class="page-header">
    <b>Artist Refferal</b>
    <a href="<?= base_url('artistadmin/tambah') ?>" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Add a Artist </a>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('artistadmin/index'), 'keyword', 'Search Name'); ?>
            </div>
        </div>
    </div>

    <?php
    buka_tabel(array("ArtistId", "Name", "Referral","User Id"), $action = true);

    foreach ($dataArtist as $artist){

        if($artist->referral == "1" or $artist->referral == 1){
            $ikon = "<i class='glyphicon glyphicon-ok' style='color: green'></i>";
        }
        else{
            $ikon = "<i class='glyphicon glyphicon-remove' style='color: red'></i>";
        }

        isi_tabel_admin(++$start, array($artist->artistId, $artist->name, $ikon, $artist->userId), base_url('artistadmin/edit'), base_url('artistadmin/hapus'), $artist->artistId, true, true);
    }

    tutup_tabel();
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