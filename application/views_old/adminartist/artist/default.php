<h3 class="page-header">
    <b>Artists List</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('artistlist/index'), 'keyword', 'Search Name'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataArtist) {
        buka_tabel(array("Artist ID", "Name", "Referral","Admin ID"), $action = false);

        foreach ($dataArtist as $artist){

            if($artist->referral == "1" or $artist->referral == 1){
                $ikon = "<i class='glyphicon glyphicon-ok' style='color: green'></i>";
            }
            else{
                $ikon = "<i class='glyphicon glyphicon-remove' style='color: red'></i>";
            }

            isi_tabel_admin(++$start, array($artist->artistId, $artist->name, $ikon, $artist->adminId), "", "", $artist->artistId, false, false);
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