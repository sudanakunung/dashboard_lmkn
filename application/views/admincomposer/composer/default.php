<h3 class="page-header">
    <b>Composer List</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('composerlist/index'), 'keyword', 'Search Name'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataComposer) {
        buka_tabel(array("Composer Id", "Name", "Referral"), $action = false);

        foreach ($dataComposer as $composer){

            if($composer->referral == "1" or $composer->referral == 1){
                $ikon = "<i class='glyphicon glyphicon-ok' style='color: green'></i>";
            }
            else{
                $ikon = "<i class='glyphicon glyphicon-remove' style='color: red'></i>";
            }

            isi_tabel_admin(++$start, array($composer->composerId, $composer->name, $ikon), "", "", $composer->composerId, false, false);
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