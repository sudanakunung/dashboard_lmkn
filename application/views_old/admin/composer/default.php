<?= $this->session->flashdata('sukses_aksi_tambahcomposer'); ?>

<?= $this->session->flashdata('sukses_aksi_editcomposer'); ?>

<?= $this->session->flashdata('sukses_aksi_hapuscomposer'); ?>

<?= $this->session->flashdata('error_aksi_hapuscomposer'); ?>

<h3 class="page-header">
	<b>Composer</b>
	<a href="<?= base_url('composer/tambah') ?>" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Add a Composer </a>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('composer/index'), 'keyword', 'Search Name'); ?>
			</div>
		</div>
	</div>

	<?php
	buka_tabel(array("Composer ID", "Composer Name", "Referral"), $action = true);

	foreach ($dataComposer as $composer){

		if($composer->referral == "1" or $composer->referral == 1){
	        $ikon = "<i class='glyphicon glyphicon-ok' style='color: green'></i>";
	    }
	    else{
	        $ikon = "<i class='glyphicon glyphicon-remove' style='color: red'></i>";
	    }

		isi_tabel_admin(++$start, array($composer->composerId, $composer->name, $ikon), base_url('composer/edit'), base_url('composer/hapus_composer'), $composer->composerId, true, true);
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