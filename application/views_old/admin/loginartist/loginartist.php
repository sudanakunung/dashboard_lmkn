<h3 class="page-header"><b>Daftar Login Artist</b>
    <a href="<?php echo base_url('loginartistadmin/tambah')?>" class="btn btn-primary btn-sm pull-right top-button">
        <i class="glyphicon glyphicon-plus-sign"></i> Tambah
    </a>
</h3>
<?php
buka_tabel(array("Username", "Nama Artist", "Email"));
$no = 1;
foreach ($data as $d) {
    isi_tabel_admin($no, array($d->username, $d->name, $d->email), "","", $d->artistId, false, false);
    $no++;
}
tutup_tabel();