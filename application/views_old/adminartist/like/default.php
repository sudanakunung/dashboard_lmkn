<h3 class="page-header">
	<b>Like</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('likeadminartist/index'), 'keyword', 'Search Title or Artist'); ?>
			</div>
		</div>
	</div>

	<?php
    if($dataLike) {
      	/* buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Number of Likes"), $no_action = false);

		foreach ($dataLike as $like){

			$artist_name = ($like->artist_name == NULL || empty($like->artist_name) ? "-" : $like->artist_name);
			$label_name = ($like->label_name == NULL || empty($like->label_name) ? "-" : $like->label_name);
			$composer_name = ($like->composer_name == NULL || empty($like->composer_name) ? "-" : $like->composer_name);
			$arranger_name = ($like->arranger_name == NULL || empty($like->arranger_name) ? "-" : $like->arranger_name);

			isi_tabel_admin(++$start, array($like->title, $artist_name, $label_name, $composer_name, $arranger_name, $like->jumlah), "", "", $like->songId, false, false);
		}

		tutup_tabel(); */
		
		if($this->session->userdata('lembaga') == 'SELMI'){
			buka_tabel(array("Title", "Artist", "Label", "Content Provider", "Number of Likes"), $action = false);

			foreach ($dataLike as $like){

				$artist_name = ($like->artist_name == NULL || empty($like->artist_name) ? "-" : $like->artist_name);
				$label_name = ($like->label_name == NULL || empty($like->label_name) ? "-" : $like->label_name);
				$composer_name = ($like->composer_name == NULL || empty($like->composer_name) ? "-" : $like->composer_name);
				$arranger_name = ($like->arranger_name == NULL || empty($like->arranger_name) ? "-" : $like->arranger_name);

				isi_tabel_admin(++$start, array($like->title, $artist_name, $label_name, $arranger_name, $like->jumlah), "", "", $like->songId, false, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'KCI' || $this->session->userdata('lembaga') == 'RAI'){
			buka_tabel(array("Title", "Composer", "Number of Likes"), $action = false);

			foreach ($dataLike as $like){

				$artist_name = ($like->artist_name == NULL || empty($like->artist_name) ? "-" : $like->artist_name);
				$label_name = ($like->label_name == NULL || empty($like->label_name) ? "-" : $like->label_name);
				$composer_name = ($like->composer_name == NULL || empty($like->composer_name) ? "-" : $like->composer_name);
				$arranger_name = ($like->arranger_name == NULL || empty($like->arranger_name) ? "-" : $like->arranger_name);

				isi_tabel_admin(++$start, array($like->title, $composer_name, $like->jumlah), "", "", $like->songId, false, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'WAMI'){
			buka_tabel(array("Title", "Artist", "Label", "Number of Likes"), $action = false);

			foreach ($dataLike as $like){

				$artist_name = ($like->artist_name == NULL || empty($like->artist_name) ? "-" : $like->artist_name);
				$label_name = ($like->label_name == NULL || empty($like->label_name) ? "-" : $like->label_name);
				$composer_name = ($like->composer_name == NULL || empty($like->composer_name) ? "-" : $like->composer_name);
				$arranger_name = ($like->arranger_name == NULL || empty($like->arranger_name) ? "-" : $like->arranger_name);

				isi_tabel_admin(++$start, array($like->title, $artist_name, $label_name, $like->jumlah), "", "", $like->songId, false, false);
			}
		} else {
			buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Number of Likes"), $action = false);

			foreach ($dataLike as $like){

				$artist_name = ($like->artist_name == NULL || empty($like->artist_name) ? "-" : $like->artist_name);
				$label_name = ($like->label_name == NULL || empty($like->label_name) ? "-" : $like->label_name);
				$composer_name = ($like->composer_name == NULL || empty($like->composer_name) ? "-" : $like->composer_name);
				$arranger_name = ($like->arranger_name == NULL || empty($like->arranger_name) ? "-" : $like->arranger_name);

				isi_tabel_admin(++$start, array($like->title, $artist_name, $label_name, $composer_name, $arranger_name, $like->jumlah), "", "", $like->songId, false, false);
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