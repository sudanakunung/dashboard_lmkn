<?php
buka_tabel(array("Song Id", "Title","Artis Id", "Artis Name", "Composer", "Label"), $action = true);
$no = 1;
foreach ($dataSongApproved as $approved){
    isi_tabel_admin($no, array($approved->songId, $approved->title, $approved->artistId, $approved->artist, $approved->composer, $approved->label),base_url('songuserrequest/edit'), "", $approved->songId, true, false);
    $no++;
}
tutup_tabel();