<h3 class="page-header">
	<b>Music</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('songadminartist/index'), 'keyword', 'Search Title or Artist'); ?>
			</div>
		</div>
	</div>

	<?php
    if($dataSong) {
      	/* buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Cover Image"), $action = true);

		foreach ($dataSong as $song){

			isi_tabel_admin(++$start, array($song->title, $song->artist, $song->label, $song->composer, $song->arranger, substr($song->coverImage, 0,30)), base_url('songadminartist/edit'), "", $song->songId, true, false);
		}

		tutup_tabel(); */
		
		if($this->session->userdata('lembaga') == 'SELMI'){
			buka_tabel(array("Title", "Artist", "Label", "Content Provider", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				isi_tabel_admin(++$start, array($song->title, $song->artist, $song->label, $song->arranger, substr($song->coverImage, 0,30)), base_url('songadminartist/edit'), "", $song->songId, true, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'KCI' || $this->session->userdata('lembaga') == 'RAI'){
			buka_tabel(array("Title", "Composer", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				isi_tabel_admin(++$start, array($song->title, $song->composer, substr($song->coverImage, 0,30)), base_url('songadminartist/edit'), "", $song->songId, true, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'WAMI'){
			buka_tabel(array("Title", "Artist", "Label", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				isi_tabel_admin(++$start, array($song->title, $song->artist, $song->label, substr($song->coverImage, 0,30)), base_url('songadminartist/edit'), "", $song->songId, true, false);
			}
		} else {
			buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				isi_tabel_admin(++$start, array($song->title, $song->artist, $song->label, $song->composer, $song->arranger, substr($song->coverImage, 0,30)), base_url('songadminartist/edit'), "", $song->songId, true, false);
			}
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