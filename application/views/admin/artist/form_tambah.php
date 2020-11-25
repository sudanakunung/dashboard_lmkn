<?php
$this->session->flashdata('error_aksi');

$data = array("artistId"=> "", "name"=>"", "referral"=>"","userId"=>"", "lembaga"=>"");

$aksi = "Tambah";

echo '<h3 class="page-header"><b>'.$aksi.' Artist</b></h3>';

buka_form("artistadmin/aksitambah", $data['artistId'], strtolower($aksi));

buat_textbox("Name", "name", $data['name'], "10","text", "Name","required");

//buat_textbox("Referral", "referral", $data['referral'], "10","text", "referal","required");
//buat_textbox("User Id", "userId", $data['userId'], "10","text","User Id", "required");

$typeAdmin = array(array("cap"=>"1","val"=>1),array("cap"=>"0","val"=>0));

$sessionLangCode = $this->session->userdata('langCode');
if($sessionLangCode <> 'phi'){
	$selectInstitution = array(array("cap"=>"SELMI","val"=>"SELMI"),array("cap"=>"KCI","val"=>"KCI"),array("cap"=>"RAI","val"=>"RAI"),array("cap"=>"WAMI","val"=>"WAMI"));
	buat_combobox("Institution", "lembaga", $selectInstitution, $data['lembaga'], $lebar = '4',"");
}

buat_combobox("Referral", "referral", $typeAdmin, $data['referral'], $lebar = '4',"");

buat_textbox_readonly("User Id", "userId", $data['userId'], "10","text","User Id");

tutup_form("artistadmin/index");