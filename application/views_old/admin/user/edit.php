<?php
foreach ($data as $d){
    $datas = array("userId"=>$d->userId,"email"=>$d->email,"nama"=>$d->name,"birthday"=>$d->birthday,"gender"=>$d->gender);
}
$nilaiGender = array(array("cap"=>"Male","val"=>"M"),array("cap"=>"FEMALE","val"=>"F"));

if (!empty($this->session->flashdata('error_aksi_useradmin'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!</b> <?= $this->session->flashdata('error_aksi_useradmin') ?></center> </div>
<?php endif;


$aksi = "Edit";
echo '<h3 class="page-header"><b>'.$aksi.' User</b></h3>';
buka_form("useradmin/aksi", $datas['userId'], strtolower($aksi));
buat_textbox("E-Mail", "email", $datas['email'], "10","text", "E-mail","required");
buat_textbox("Nama", "nama", $datas['nama'], "10","text","Nama", "required");
buat_textbox("BirthDay", "birthday", $datas['birthday'], "4","date","", "");
buat_combobox("Gender", "gender", $nilaiGender, $datas['gender'], $lebar = '4',"");
tutup_form("useradmin/index");