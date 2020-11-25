<?php
$data = array("username" => "", "name" => "", "email"=>"", "password"=>"","artistIdTuser"=>"","artistIdTadmin"=>"");
$aksi = "Tambah";
echo '<h3 class="page-header"><b>'.$aksi.' Login Artist</b></h3>';
buka_form("Loginartistadmin/aksitambah", $data['artistIdTadmin'], strtolower($aksi));
buat_textbox("Username", "username", $data['username'], "10","text", "Username", "required");
buat_textbox("Name", "name", $data['name'], "10","text", "Nama", "required");
buat_textbox("Email", "email", $data['email'], "10", "email","E-mail", "required");
buat_textbox_readonly("Password", "password", 1234, "10");

$list = array("cap" => "", "val" => "");
foreach ($listCombobox as $l){
    $list[] = array("cap" => $l->name, "val" => $l->artistId);
}
buat_combobox_To_Artist("ARTIST ID", "artistId", $list, $data['artistIdTadmin'], '4');
tutup_form("Loginartistadmin/index");
?>

<script type="text/javascript">
    $('document').ready(function(){
        $(".artistId").chosen({no_results_text: "Tidak ditemukan....!"});
    });
</script>
