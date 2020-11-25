<?php
$data = array("artistId"=> $getData->artistId, "name"=>$getData->name, "referral"=>$getData->referral,"userId"=>$getData->userId);

$aksi = "Edit";
echo '<h3 class="page-header"><b>'.$aksi.' Artist</b></h3>';
buka_form("artistadmin/aksiedit", $data['artistId'], strtolower($aksi));
buat_textbox("Name", "name", $data['name'], "10","text", "Name","required");
//buat_textbox("Referral", "referral", $data['referral'], "10","text", "referal","required");
//buat_textbox("User Id", "userId", $data['userId'], "10","text","User Id", "required");
$typeAdmin = array(array("cap"=>"1","val"=>1),array("cap"=>"0","val"=>0));
buat_combobox("Referral", "referral", $typeAdmin, $data['referral'], $lebar = '4',"");
buat_textbox_readonly("User Id", "userId", $data['userId'], "10","text","User Id");
tutup_form("artistadmin/index");
/**
 * Created by PhpStorm.
 * User: subki
 * Date: 18/12/2017
 * Time: 10:58
 */