<?php
if (!empty($this->session->flashdata('error_aksi_tambahcomposer'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!!</b> <?= $this->session->flashdata('error_aksi_tambahcomposer') ?></center> </div>
<?php endif;
$data   = array("composerId" => "", "name" => "", "lembaga" => "", "referral" => "");
$aksi   = "Add";

echo '<h3 class="page-header"><b>'.$aksi.' Composer</b></h3>';

buka_form("composer/aksitambah", $data['composerId'], strtolower($aksi));

buat_textbox("Name", "name", $data['name'], "10","text", "Recorder Composer","required");

$sessionLangCode = $this->session->userdata('langCode');
if($sessionLangCode <> 'phi'){
	$selectInstitution = array(array("cap"=>"SELMI","val"=>"SELMI"),array("cap"=>"KCI","val"=>"KCI"),array("cap"=>"RAI","val"=>"RAI"),array("cap"=>"WAMI","val"=>"WAMI"));
	buat_combobox("Institution", "lembaga", $selectInstitution, $data['lembaga'], $lebar = '4',"");
}

$typeAdmin = array(array("cap"=>"1","val"=>1),array("cap"=>"0","val"=>0));
buat_combobox("Referral", "referral", $typeAdmin, $data['referral'], $lebar = '4',"");

tutup_form("composer/index");