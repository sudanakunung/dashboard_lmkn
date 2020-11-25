<h3 class="page-header">
	<b>Music</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('songadminarranger/index'), 'keyword', 'Search Title'); ?>
			</div>
		</div>
	</div>

	<?php
    if($dataSong) {
      	buka_tabel(array("Title", "Artist Name", "Description","Cover Image"), $action = false);

		foreach ($dataSong as $song){

			isi_tabel_admin(++$start, array($song->title, $song->artistName, $song->description, substr($song->coverImage, 0,30)), "", "", $song->songId, false, false);
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