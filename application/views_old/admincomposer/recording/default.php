<h3 class="page-header">
    <b>Recording</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('recordingadmincomposer/index'), 'keyword', 'Search Title'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataRecording) {
       buka_tabel(array("Song Id", "Song Title", "Artist", "Composer", "Recording Id", "User Id", "Recording User", "Status"), $action = false);

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
            
            $composer_name = ($recording->composer_name == NULL || empty($recording->composer_name) ? "-" : $recording->composer_name);

            isi_tabel_admin(++$start, array($recording->songId, $recording->title, $artist_name, $composer_name, $recording->recordingId, $recording->userId, $recording->name, $status), "", "", $recording->recordingId, false, false);
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