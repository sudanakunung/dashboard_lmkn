<?php
if (!empty($this->session->flashdata('error_aksi_editcomposer'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!! </b> <?= $this->session->flashdata('error_aksi_editcomposer') ?></center> </div>
<?php endif;
$data   = array("id" => $dataEditComposer['id'], "name" => $dataEditComposer['name'], "referral" => $dataEditComposer['referral']);
$aksi   = "Edit";
echo '<h3 class="page-header"><b>'.$aksi.' Composer</b></h3>';
buka_form("composer/aksiedit", $data['id'], strtolower($aksi));
buat_textbox("Composer Name", "name", $data['name'], "10","text", "Composer Name","required");
$typeAdmin = array(array("cap"=>"1","val"=>1),array("cap"=>"0","val"=>0));
buat_combobox("Referral", "referral", $typeAdmin, $data['referral'], $lebar = '4',"");
tutup_form("composer/index");