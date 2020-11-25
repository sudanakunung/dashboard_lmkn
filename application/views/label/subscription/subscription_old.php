<?php
echo '<h3 class="page-header"><b>Daftar Lagu</b></h3>';
buka_tabel(array("Nama Artist", "Jumlah Lagu"));
$no = 1;
foreach ($data as $d) {
    isi_tabel_for_label($no, array($d->name, $d->jumlah), base_url('subscriptionlabel/grafik'), $d->artisId, true);
    $no++;
}

tutup_tabel();