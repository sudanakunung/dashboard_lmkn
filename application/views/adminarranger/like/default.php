<h3 class="page-header">
	<b>Like</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('likeadminarranger/index'), 'keyword', 'Search Title'); ?>
			</div>
		</div>
	</div>

	<?php
    if($dataLike) {
       buka_tabel(array("Title", "Arranger", "Number of Likes"), $no_action = false);

		foreach ($dataLike as $like){

			$arranger_name = ($like->arranger_name == NULL || empty($like->arranger_name) ? "-" : $like->arranger_name);

			isi_tabel_admin(++$start, array($like->title, $arranger_name, $like->jumlah), "", "", $like->songId, false, false);
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


