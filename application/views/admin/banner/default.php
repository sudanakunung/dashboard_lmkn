<?php
if (!empty($this->session->flashdata('sukses_aksi_tambahbanner'))) : ?>
    <div class="alert alert-success login-alert" role="alert"><center> <?= $this->session->flashdata('sukses_aksi_tambahbanner') ?></center> </div>
<?php endif;
if (!empty($this->session->flashdata('sukses_aksi_editbanner'))) : ?>
    <div class="alert alert-success login-alert" role="alert"><center> <?= $this->session->flashdata('sukses_aksi_editbanner') ?></center> </div>
<?php endif;
if (!empty($this->session->flashdata('sukses_aksi_hapusbanner'))) : ?>
    <div class="alert alert-success login-alert" role="alert"><center> <?= $this->session->flashdata('sukses_aksi_hapusbanner') ?></center> </div>
<?php endif;
if (!empty($this->session->flashdata('error_aksi_hapusbanner'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center> <?= $this->session->flashdata('error_aksi_hapusbanner') ?></center> </div>
<?php endif; ?>

<h3 class="page-header">
    <b>Banner</b>
    <a href="<?= base_url('banneradmin/tambah') ?>" class="btn btn-primary btn-sm pull-right top-button">
        <i class="glyphicon glyphicon-plus-sign"></i> Add 
    </a>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('banneradmin/index'), 'keyword', 'Search Title'); ?>
            </div>
        </div>
    </div>

    <?php
    buka_tabel(array("title", "urlImage", "urlContent", "createDate", "showDate", "expDate"), $action = true);

    foreach ($dataBanner as $banner){

        isi_tabel_admin(++$start, array($banner->title, '<img src="'.$banner->urlImage.'" alt="Smiley face" width="100" height="80">', substr($banner->url,0,10), $banner->createdDate, $banner->showDate, $banner->expDate), base_url('banneradmin/edit'), base_url('banneradmin/hapus'), $banner->bannerId, true, true);
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