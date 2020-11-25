<h3 class="page-header">
    <b>Daftar Lagu</b>
    <a href="<?php echo base_url('songlabel')?>" class="btn btn-danger btn-sm pull-right top-button">
        <i class="glyphicon glyphicon-arrow-left"></i> Kembali
    </a>
</h3>
<?php
buka_tabel(array("SONG ID", "JUDUL", "COVER", "UPLOAD"));
$no = 1;
foreach ($data as $d){
    isi_tabel_label($no,array($d->songId, $d->title, '<img src="'.$d->coverImage.'" width="20%" height="15%">', $d->dateCreated),base_url('songlabel/content'), $d->songId, $lihat = true);
    $no++;
}
tutup_tabel();