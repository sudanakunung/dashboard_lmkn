<h3 class="page-header">
	<b>Viewer</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('vieweradminarranger/index'), 'keyword', 'Search Title'); ?>
			</div>
		</div>
	</div>

	<?php
    if($dataViewer) {
       buka_tabel(array("Title", "Arranger", "Number of Views"), $no_action = false);

		foreach ($dataViewer as $viewer){

			$arranger_name = ($viewer->arranger_name == NULL || empty($viewer->arranger_name) ? "-" : $viewer->arranger_name);

			isi_tabel_admin(++$start, array($viewer->title, $arranger_name, $viewer->jumlah), "", "", $viewer->songId, false, false);
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