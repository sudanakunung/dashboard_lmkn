<?php
if (!empty($this->session->flashdata('error_aksi_uploadbanner'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center> <?= $this->session->flashdata('error_aksi_uploadbanner') ?></center> </div>
<?php endif;
if (!empty($this->session->flashdata('error_aksi_editbanner'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center> <?= $this->session->flashdata('error_aksi_editbanner') ?></center> </div>
<?php endif;

$data = array("bannerId"=> $dataEdit->bannerId, "title"=>$dataEdit->title, "urlImage"=>$dataEdit->urlImage,"url"=>$dataEdit->url,"createdDate"=>$dataEdit->createdDate,"showDate"=>$dataEdit->showDate,"expDate"=>$dataEdit->expDate);
$showDate = date('Y-m-d',strtotime($dataEdit->showDate));
$expDate = date('Y-m-d',strtotime($dataEdit->expDate));
$aksi = "Edit";
echo '<h3 class="page-header"><b>'.$aksi.' Banner</b></h3>';
buka_form("banneradmin/aksiedit", $data['bannerId'], strtolower($aksi));
buat_textbox("Title", "title", $data['title'], "10","text", "Title","required");
buat_textbox("Image Lama", "image", $data['urlImage'], "10","file", "Image","");

//buat_textbox_readonly("Image Baru", "image1", $data['urlImage'], "10","text", "Image","");
echo '<div class="form-group" id="gambarlama"> 
		<label for="gambarlama" class="col-sm-2 control-label">Gambar Lama</label>
			<div class="col-sm-4">
				<img src="'.$data['urlImage'].'" alt="Smiley face" width="100" height="80">
			</div>
		</div>';

buat_textbox("Url Content", "url", $data['url'], "10","text", "Url Content","");

buat_textbox("Show Date", "showDate", $showDate, "4","date", "","required");
buat_textbox("Expired Date", "expDate", $expDate, "4","date", "","required");
tutup_form("banneradmin/index");

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 15/02/2018
 * Time: 12:52
 */
/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/02/2018
 * Time: 14:16
 */