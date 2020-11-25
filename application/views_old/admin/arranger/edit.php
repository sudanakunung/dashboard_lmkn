<?php
if (!empty($this->session->flashdata('error_aksi_editarranger'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!! </b> <?= $this->session->flashdata('error_aksi_editarranger') ?></center> </div>
<?php endif;
$data   = array("id" => $dataEditArranger['arrangerId'], "arranger" => $dataEditArranger['arranger'], "referral" => $dataEditArranger['referral']);
$aksi   = "Edit";
echo '<h3 class="page-header"><b>'.$aksi.' Content Provider</b></h3>';
buka_form("arranger/aksiedit", $data['id'], strtolower($aksi));
buat_textbox("Content Provider Name", "arranger_name", $data['arranger'], "10","text", "Content Provider Name","required");
$typeAdmin = array(array("cap"=>"1","val"=>1),array("cap"=>"0","val"=>0));
buat_combobox("Referral", "referral", $typeAdmin, $data['referral'], $lebar = '4',"");
tutup_form("arranger/index");