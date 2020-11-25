<?= $this->session->flashdata('sukses_aksi_tambahsonguser'); ?>
<?= $this->session->flashdata('error_aksi_tambahsonguser'); ?>

<h3 class="page-header">
    <b>Please choose your song</b>
</h3>

<div class="card mb-20" style="background: #eee;">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('songusercomposer/tambah'), 'keyword', 'Search Title or Artist'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataSongUserToAdd) {
       buka_tabel(array("ID", "Name", "Artist"), $action = true, "Add to Request");

        foreach ($dataSongUserToAdd as $lagu){

            isi_tabel_admin(++$start, array($lagu->songId,$lagu->title, $lagu->artistName), "", "", $lagu->songId, false, false, '<a href="'.base_url('songusercomposer/aksitambah').'/'.$this->session->userdata('composerId').'/'.$lagu->songId.'" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add to Request</a>');
        }

        tutup_tabel();
    } else { ?>
        <div class="row">
            <div class="col-md-12 text-center mb-10">
                <?php 
                $msg = (isset($_GET['keyword']) ? 'The data you are looking for was not found' : 'Data is still empty');
                ?>
                <h3><?= $msg; ?></h3>
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