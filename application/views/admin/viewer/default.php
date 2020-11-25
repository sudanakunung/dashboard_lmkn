<h3 class="page-header">
	<b>Viewer</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('viewer/index'), 'keyword', 'Search Title or Artist'); ?>
			</div>
		</div>
	</div>

	<?php
	buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Number of Views"), $action = false);

	foreach ($dataViewer as $viewer){

		$artist_name = ($viewer->artist_name == NULL || empty($viewer->artist_name) ? "-" : $viewer->artist_name);
		$label_name = ($viewer->label_name == NULL || empty($viewer->label_name) ? "-" : $viewer->label_name);
		$composer_name = ($viewer->composer_name == NULL || empty($viewer->composer_name) ? "-" : $viewer->composer_name);
		$arranger_name = ($viewer->arranger_name == NULL || empty($viewer->arranger_name) ? "-" : $viewer->arranger_name);

		isi_tabel_admin(++$start, array($viewer->title, $artist_name, $label_name, $composer_name, $arranger_name, $viewer->jumlah), "", "", $viewer->songId, false, false);
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