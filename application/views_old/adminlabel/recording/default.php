<h3 class="page-header">
    <b>Recording</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('recordingadminlabel/index'), 'keyword', 'Search Title'); ?>
            </div>
        </div>
    </div>

    <?php
    buka_tabel(array("Song Id", "Song Title", "Artist", "Label", "Recording Id", "User Id", "Recording User", "Status"), $action = false);

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
        
        isi_tabel_admin(++$start, array($recording->songId, $recording->title, $artist_name, $label_name, $recording->recordingId, $recording->userId, $recording->name, $status), "", "", $recording->recordingId, false, false);
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