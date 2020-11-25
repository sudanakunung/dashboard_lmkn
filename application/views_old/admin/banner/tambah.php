<?php
if (!empty($this->session->flashdata('error_aksi_uploadbanner'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center> <?= $this->session->flashdata('error_aksi_uploadbanner') ?></center> </div>
<?php endif;
if (!empty($this->session->flashdata('error_aksi_tambahbanner'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center> <?= $this->session->flashdata('error_aksi_tambahbanner') ?></center> </div>
<?php endif;

$data = array("bannerId"=> "", "title"=>"", "urlImage"=>"","url"=>"","createdDate"=>"","showDate"=>"","expDate"=>"");

$aksi = "Tambah";
echo '<h3 class="page-header"><b>'.$aksi.' Banner</b></h3>';
buka_form("banneradmin/aksitambah", $data['bannerId'], strtolower($aksi));
buat_textbox("Title", "title", $data['title'], "10","text", "Title","required");
buat_textbox("Image", "image", $data['urlImage'], "10","file", "Image","required");
//buat_imagepicker_cimydiosing("Image", "image", $data['urlImage']);
buat_textbox("Url Content", "url", $data['url'], "10","text", "Url Content","");
//buat_file_cimydiosing("Url Content", "url", $data['url']);
buat_textbox("Show Date", "showDate", $data['showDate'], "4","date", "Show Date","required");
buat_textbox("Expired Date", "expDate", $data['expDate'], "4","date", "Expired Date","required");
tutup_form("banneradmin/index");?>


