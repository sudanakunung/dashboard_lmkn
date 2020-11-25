<h3 class="page-header">
    <b>User Lists</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('useradminarranger/index'), 'keyword', 'Search Name'); ?>
            </div>
        </div>
    </div>

    <?php
    if($dataUser) {
    	buka_tabel(array("E-mail", "Name", "BirthDay", "Gender"), $action = false);

	    foreach ($dataUser as $user){

	        isi_tabel_admin(++$start, array($user->email, $user->name, $user->birthday, $user->gender), "", "", $user->userId, false, false);
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

