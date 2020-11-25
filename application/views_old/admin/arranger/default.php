<?= $this->session->flashdata('sukses_aksi_tambaharranger'); ?>

<?= $this->session->flashdata('sukses_aksi_editarranger'); ?>

<?= $this->session->flashdata('sukses_aksi_hapusarranger'); ?>

<?= $this->session->flashdata('error_aksi_hapusarranger'); ?>

<h3 class="page-header">
	<b>Content Provider</b>
	<a href="<?= base_url('arranger/tambah') ?>" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Add a Content Provider </a>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('arranger/index'), 'keyword', 'Search Name'); ?>
			</div>
		</div>
	</div>

	<?php
	if($dataArranger){
		buka_tabel(array("Content Provider ID", "Content Provider", "Referral"), $action = true);

		foreach ($dataArranger as $arranger){

			if($arranger->referral == "1" or $arranger->referral == 1){
		        $ikon = "<i class='glyphicon glyphicon-ok' style='color: green'></i>";
		    }
		    else{
		        $ikon = "<i class='glyphicon glyphicon-remove' style='color: red'></i>";
		    }

			isi_tabel_admin(++$start, array($arranger->arrangerId, $arranger->arranger, $ikon), base_url('arranger/edit'), base_url('arranger/hapus_arranger'), $arranger->arrangerId, true, true);
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