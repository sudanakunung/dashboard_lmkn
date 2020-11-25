<h3 class="page-header">
    <b>Banner</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('banneradminlabel/index'), 'keyword', 'Search Title'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataBanner) {
        buka_tabel(array("title", "urlImage", "urlContent", "createDate", "showDate", "expDate"), $action = false);

        foreach ($dataBanner as $banner){

            isi_tabel_admin(++$start, array($banner->title, '<img src="'.$banner->urlImage.'" alt="Smiley face" width="100" height="80">', substr($banner->url,0,10), $banner->createdDate, $banner->showDate, $banner->expDate), "", "", $banner->bannerId, false, false);
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