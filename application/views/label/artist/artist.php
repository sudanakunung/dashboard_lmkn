<?php

echo '<h3 class="page-header"><b>Daftar Artist</b>';

    //        if($canCreate == true) {
    //            echo '	<a href="' . $link . '&show=form" class="btn btn-primary btn-sm pull-right top-button">
        //						<i class="glyphicon glyphicon-plus-sign"></i> Tambah
        //					</a>';
    //        }

    echo '</h3>';

buka_tabel(array( "Username","Nama Artist", "Nama Label", "Jumlah Lagu"));
$no = 1;
foreach ($data as $d){
    if($d->adminIds == NULL or empty($d->adminIds) or $d->adminIds == ""){
//                    jikas admin id kosong maka buat nama artis jadi merah
            isi_tabel_for_label($no, array($d->usernames, '<b style="color: red">'.$d->name.'</b>', $d->recordLabel, $d->jumlahlagu), "", $d->adminIds, NULL);
    }
    else {
//                    jika artis sudah terdaftar maka tulisan username akan menebal
            isi_tabel_for_label($no, array('<b>'.$d->usernames.'</b>', $d->name, $d->recordLabel, $d->jumlahlagu), "", $d->adminIds, NULL);
    }
    $no++;
}
tutup_tabel();