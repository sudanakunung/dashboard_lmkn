<h3 class="page-header">
	<b>Viewer</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('vieweradmininstitution/index'), 'keyword', 'Search Title or Artist'); ?>
			</div>
		</div>
	</div>

	<?php
	/* buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Number of Views"), $action = false);

	foreach ($dataViewer as $viewer){

		$artist_name = ($viewer->artist_name == NULL || empty($viewer->artist_name) ? "-" : $viewer->artist_name);
		$label_name = ($viewer->label_name == NULL || empty($viewer->label_name) ? "-" : $viewer->label_name);
		$composer_name = ($viewer->composer_name == NULL || empty($viewer->composer_name) ? "-" : $viewer->composer_name);
		$arranger_name = ($viewer->arranger_name == NULL || empty($viewer->arranger_name) ? "-" : $viewer->arranger_name);

		isi_tabel_admin(++$start, array($viewer->title, $artist_name, $label_name, $composer_name, $arranger_name, $viewer->jumlah), "", "", $viewer->songId, false, false);
	}

	tutup_tabel(); */
	
	if($dataViewer) {
		if($this->session->userdata('lembaga') == 'SELMI'){
			buka_tabel(array("Title", "Artist", "Label", "Content Provider", "Number of Views"), $action = false);

			foreach ($dataViewer as $viewer){

				if(!empty($viewer->lembaga_label)){
					if($viewer->lembaga_label <> 'SELMI'){
						$label = '';
					} else {
						$label = $viewer->label;
					}
				} else {
					$label = '';
				}

				isi_tabel_admin(++$start, array($viewer->title, $viewer->artist, $label, $viewer->arranger_name, $viewer->jumlah), "", "", $viewer->songId, false, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'KCI'){
			buka_tabel(array("Title", "Composer", "Number of Views"), $action = false);

			foreach ($dataViewer as $viewer){

				if(!empty($viewer->lembaga_composer)){
					if($viewer->lembaga_composer <> 'KCI'){
						$composer = '';
					} else {
						$composer = $viewer->composer;
					}
				} else {
					$composer = '';
				}

				isi_tabel_admin(++$start, array($viewer->title, $composer, $viewer->jumlah), "", "", $viewer->songId, false, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'RAI'){
			buka_tabel(array("Title", "Composer", "Number of Views"), $action = false);

			foreach ($dataViewer as $viewer){

				if(!empty($viewer->lembaga_composer)){
					if($viewer->lembaga_composer <> 'RAI'){
						$composer = '';
					} else {
						$composer = $viewer->composer;
					}
				} else {
					$composer = '';
				}

				isi_tabel_admin(++$start, array($viewer->title, $composer, $viewer->jumlah), "", "", $viewer->songId, false, false);
			}
		}
		else if($this->session->userdata('lembaga') == 'WAMI'){
			buka_tabel(array("Title", "Artist", "Label", "Number of Views"), $action = false);

			foreach ($dataViewer as $viewer){

				if(!empty($viewer->lembaga_label)){
					if($viewer->lembaga_label <> 'WAMI'){
						$label = '';
					} else {
						$label = $viewer->label;
					}
				} else {
					$label = '';
				}

				isi_tabel_admin(++$start, array($viewer->title, $viewer->artist, $label, $viewer->jumlah), "", "", $viewer->songId, false, false);
			}
		} else {
			buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Number of Views"), $action = false);

			foreach ($dataViewer as $viewer){

				isi_tabel_admin(++$start, array($viewer->title, $viewer->artist, $viewer->label, $viewer->composer, $viewer->arranger_name, $viewer->jumlah), "", "", $viewer->songId, false, false);
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