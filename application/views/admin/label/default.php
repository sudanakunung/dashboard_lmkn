<?php
if (!empty($this->session->flashdata('sukses_aksi_tambahlabel'))) : ?>
    <div class="alert alert-success login-alert" role="alert">
    	Successfully added data
   	</div>
<?php endif;

if (!empty($this->session->flashdata('sukses_aksi_editlabel'))) : ?>
    <div class="alert alert-success login-alert" role="alert">
    	Successfully updated data
	</div>
<?php endif;

if (!empty($this->session->flashdata('sukses_aksi_hapuslabel'))) : ?>
    <div class="alert alert-success login-alert" role="alert">
    	Data successfully deleted
    </div>
<?php endif;

if (!empty($this->session->flashdata('error_aksi_hapuslabel'))) : ?>
    <div class="alert alert-success login-alert" role="alert">
    	Data failed to delete
    </div>
<?php endif; ?>

<h3 class="page-header">
	<b>Label</b>
	<a href="<?= base_url('labeladmin/tambah') ?>" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Add a Publisher/Label </a>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('labeladmin/index'), 'keyword', 'Search Title'); ?>
			</div>
		</div>
	</div>

	<?php
	$sessionLangCode = $this->session->userdata('langCode');
	
	// Cek apakah admin berasal dari Indonesia apakah Filipina, karena proses tampil data yang berbeda
	if($sessionLangCode <> 'phi'){
		buka_tabel(array("Label ID", "Label Name", "Institution"), $action = true);

		foreach ($dataLabel as $label){

			isi_tabel_admin(++$start, array($label->recordLabelId, $label->recordLabel, $label->lembaga), base_url('labeladmin/edit'),base_url('labeladmin/aksihapus'), $label->recordLabelId, true, true);
		}

		tutup_tabel();
	} else {
		buka_tabel(array("Label ID", "Label Name"), $action = true);

		foreach ($dataLabel as $label){

			isi_tabel_admin(++$start, array($label->recordLabelId, $label->recordLabel), base_url('labeladmin/edit'),base_url('labeladmin/aksihapus'), $label->recordLabelId, true, true);
		}

		tutup_tabel();
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
