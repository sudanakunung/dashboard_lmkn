<?php
if (!empty($this->session->flashdata('error_aksi_editlabel'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!! </b> <?= $this->session->flashdata('error_aksi_editlabel') ?></center> </div>
<?php endif;
$data   = array("recordLabelId" => $dataEditLabel->recordLabelId, "recordLabel" => $dataEditLabel->recordLabel);
$aksi   = "Edit";
echo '<h3 class="page-header"><b>'.$aksi.' Label</b></h3>';
buka_form("labeladmin/aksiedit", $data['recordLabelId'], strtolower($aksi));
buat_textbox("Record Label", "recordLabel", $data['recordLabel'], "10","text", "Recorder Label","required");
tutup_form("labeladmin/index");