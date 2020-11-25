<h3 class="page-header">
	<b>Arranger List</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			<div class="col-md-4 pull-right">
				<?= form_search(base_url('arrangerlist/index'), 'keyword', 'Search Title'); ?>
			</div>
		</div>
	</div>

	<?php
    if($dataArranger) {
       buka_tabel(array("Arranger ID", "Arranger Name", "Referral"), $action = false);

		foreach ($dataArranger as $data){

			if($data->referral == "1" or $data->referral == 1){
		        $ikon = "<i class='glyphicon glyphicon-ok' style='color: green'></i>";
		    }
		    else{
		        $ikon = "<i class='glyphicon glyphicon-remove' style='color: red'></i>";
		    }

		    isi_tabel_admin(++$start, array($data->arrangerId, $data->arranger, $ikon), "", "", $data->arrangerId, false, false);
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


