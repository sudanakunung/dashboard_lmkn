<?php
if (!empty($this->session->flashdata('error_aksi_editlabel'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!! </b> <?= $this->session->flashdata('error_aksi_editlabel') ?></center> </div>
<?php endif;

$data   = array("recordLabelId" => $dataEditLabel->recordLabelId, "lembaga" => $dataEditLabel->lembaga, "recordLabel" => $dataEditLabel->recordLabel);

$aksi   = "Edit";

echo '<h3 class="page-header"><b>'.$aksi.' Label</b></h3>';

buka_form("labeladmin/aksiedit", $data['recordLabelId'], strtolower($aksi));

buat_textbox("Record Label", "recordLabel", $data['recordLabel'], "10","text", "Recorder Label","required");

$sessionLangCode = $this->session->userdata('langCode');
if($sessionLangCode <> 'phi'){
	$selectInstitution = array(array("cap"=>"SELMI","val"=>"SELMI"),array("cap"=>"KCI","val"=>"KCI"),array("cap"=>"RAI","val"=>"RAI"),array("cap"=>"WAMI","val"=>"WAMI"));
	buat_combobox("Institution", "lembaga", $selectInstitution, $data['lembaga'], $lebar = '4',"");
}

tutup_form("labeladmin/index");