<h3 class="page-header">
	<b>Music</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('songadmininstitution/index'), 'keyword', 'Search Title or Artist'); ?>
			</div>
		</div>
	</div>

	<?php
    if($dataSong) {
      	/* buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Cover Image"), $action = true);

		foreach ($dataSong as $song){

			isi_tabel_admin(++$start, array($song->title, $song->artist, $song->label, $song->composer, $song->arranger, substr($song->coverImage, 0,30)), base_url('songadmininstitution/edit'), "", $song->songId, true, false);
		}

		tutup_tabel(); */
		
		if($this->session->userdata('lembaga') == 'SELMI'){
			
			buka_tabel(array("Title", "Artist", "Label", "Content Provider", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				if(!empty($song->lembaga_label)){
					if($song->lembaga_label <> 'SELMI'){
						$label = '';
					} else {
						$label = $song->label;
					}
				} else {
					$label = '';
				}

				isi_tabel_admin(++$start, array($song->title, $song->artist, $label, $song->arranger, substr($song->coverImage, 0,30)), base_url('songadmininstitution/edit'), "", $song->songId, true, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'KCI'){
			
			buka_tabel(array("Title", "Composer", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				if(!empty($song->lembaga_composer)){
					if($song->lembaga_composer <> 'KCI'){
						$composer = '';
					} else {
						$composer = $song->composer;
					}
				} else {
					$composer = '';
				}

				isi_tabel_admin(++$start, array($song->title, $composer, substr($song->coverImage, 0,30)), base_url('songadmininstitution/edit'), "", $song->songId, true, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'RAI'){
			
			buka_tabel(array("Title", "Composer", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				if(!empty($song->lembaga_composer)){
					if($song->lembaga_composer <> 'RAI'){
						$composer = '';
					} else {
						$composer = $song->composer;
					}
				} else {
					$composer = '';
				}

				isi_tabel_admin(++$start, array($song->title, $composer, substr($song->coverImage, 0,30)), base_url('songadmininstitution/edit'), "", $song->songId, true, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'WAMI'){
			
			buka_tabel(array("Title", "Artist", "Label", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				if(!empty($song->lembaga_label)){
					if($song->lembaga_label <> 'WAMI'){
						$label = '';
					} else {
						$label = $song->label;
					}
				} else {
					$label = '';
				}

				isi_tabel_admin(++$start, array($song->title, $song->artist, $label, substr($song->coverImage, 0,30)), base_url('songadmininstitution/edit'), "", $song->songId, true, false);
			}
		} else {
			
			buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Cover Image"), $action = true);

			foreach ($dataSong as $song){

				isi_tabel_admin(++$start, array($song->title, $song->artist, $song->label, $song->composer, $song->arranger, substr($song->coverImage, 0,30)), base_url('songadmininstitution/edit'), "", $song->songId, true, false);
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