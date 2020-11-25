
<h3 class="page-header"><b>Daftar Artis & Lagu</b></h3>


<?php

buka_tabel(array("Artist","jumlah Lagu"));
$no = 1;
foreach ($data as $d){
    isi_tabel_lagu_label($no, array($d->name, $d->jumlahlagu),base_url('songlabel/daftarlagu'), $d->artistIds, true);
    $no++;
}
tutup_tabel();