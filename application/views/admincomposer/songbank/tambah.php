<?php 
echo $this->session->flashdata('sukses_aksi_tambahsonguser');
echo $this->session->flashdata('error_aksi_tambahsonguser');
?>

<form method="post" action="<?= base_url('songbankadmincomposer/aksitambah'); ?>">
    <h3 class="page-header">
        <b>Please choose your song</b>
        <button type="submit" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Save song </button>
    </h3>

    <div class="row mb-15">
        <?php
        $composername = array();
        foreach ($getComposerData as $composer) {
                $composername[] = array("cap" => $composer->name, "val" => $composer->composerId);
        }
        buat_combobox("Please choose a composer", "ComposerName", $composername, "", $lebar = '4');
        ?>
    </div>

    <div class="card mb-20" style="background: #eee;">
        <?php 
        buka_tabel_datatable(array("Select", "ID", "Name", "Artist"), $action = false);

        $no = 1;
        foreach ($getSongData as $songdata){
            isi_tabel_admin($no, array('<input type="checkbox" class="song_checkbox" value="'.$songdata->songId.'" name="song_checkbox[]">', $songdata->songId, $songdata->title, $songdata->artistName), "", "", $songdata->songId, false, false);

            $no++;
        }

        tutup_tabel();
        ?>
    </div>
</form>

<script type="text/javascript">
    $("#ComposerName").chosen({no_results_text: "Tidak ditemukan....!"});
    $(document).ready( function () {
        var table = $('.table-data').DataTable();
        table.columns([4, 5]).search($(this).val()).draw();
    });
</script>