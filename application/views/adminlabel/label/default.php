<h3 class="page-header">
    <b>Label List</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('labellist/index'), 'keyword', 'Search Name'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataLabel) {
    	buka_tabel(array("Record Label ID", "Name", "Create Date"), $action = false);

	    foreach ($dataLabel as $label){

	        if(empty($label->createdDate)){
				$date = $label->createdDate;
			}
			else{
				$dates = DateTime::createFromFormat('Y-m-d H:i:s', $label->createdDate);
		    	$date = $dates->format('d-m-Y');
			}

	        isi_tabel_admin(++$start, array($label->recordLabelId, $label->recordLabel, $date), "", "", $label->recordLabelId, false, false);
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