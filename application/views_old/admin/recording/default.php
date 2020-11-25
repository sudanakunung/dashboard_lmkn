<?php
if (!empty($this->session->flashdata('sukses_aksi_edit'))){ ?>
    <div class="alert alert-success login-alert" role="alert">
        <center><b>Yap!! </b> <?= $this->session->flashdata('sukses_aksi_edit'); ?></center>
    </div>
<?php
}
?>

<h3 class="page-header">
    <b>Recording</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('recordingadmin/index'), 'keyword', 'Search Title or Artist'); ?>
            </div>
        </div>
    </div>

    <?php
    buka_tabel(array("Song Id", "Song Title","Artist", "Label", "Composer", "Content Provider", "Recording Id", "User Id", "Status"), $action = true);

    foreach ($dataRecording as $recording){

        if($recording->status == "X"){
            $status = "Block";
        }
        elseif($recording->status == "A"){
            $status = "Record";
        }
        elseif($recording->status == "P"){
            $status = "Proccess";

        }
        elseif ($recording->status == "N"){
            $status = "New";
        }

        $artist_name = ($recording->artist_name == NULL || empty($recording->artist_name) ? "-" : $recording->artist_name);
        $label_name = ($recording->label_name == NULL || empty($recording->label_name) ? "-" : $recording->label_name);
        $composer_name = ($recording->composer_name == NULL || empty($recording->composer_name) ? "-" : $recording->composer_name);
        $arranger_name = ($recording->arranger_name == NULL || empty($recording->arranger_name) ? "-" : $recording->arranger_name);

        isi_tabel_admin(++$start, array($recording->songId, $recording->title, $artist_name, $label_name, $composer_name, $arranger_name, $recording->recordingId, $recording->userId, $status),base_url("recordingadmin/edit"), "", $recording->recordingId, true, false);
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