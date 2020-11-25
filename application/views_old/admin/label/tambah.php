<?php
if (!empty($this->session->flashdata('error_aksi_tambahlabel'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!!</b> <?= $this->session->flashdata('error_aksi_tambahlabel') ?></center> </div>
<?php endif;
$data   = array("recordLabelId" => "", "recordLabel" => "");
$aksi   = "Tambah";
echo '<h3 class="page-header"><b>'.$aksi.' Label</b></h3>';
buka_form("labeladmin/aksitambah", $data['recordLabelId'], strtolower($aksi));
buat_textbox("Record Label", "recordLabel", $data['recordLabel'], "10","text", "Recorder Label","required");
tutup_form("labeladmin/index");