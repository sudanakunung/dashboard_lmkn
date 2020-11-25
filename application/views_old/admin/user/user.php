<h3 class="page-header">
    <b>User Lists</b>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('useradmin/index'), 'keyword', 'Search Name'); ?>
            </div>
        </div>
    </div>

    <?php
    buka_tabel(array("E-mail", "Name", "BirthDay", "Gender"), $action = true);

    foreach ($dataUser as $user){

        isi_tabel_admin(++$start, array($user->email, $user->name, $user->birthday, $user->gender), base_url('useradmin/edit'), "", $user->userId, true, false);
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
