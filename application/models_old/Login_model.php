<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model{
	
    public $table = 'tadmin';

    function Login($username, $password){

        $hash = genHash($username,$password);
        
        // $sql = "SELECT username, artistId, roleId, recordLabelId FROM tadmin WHERE username = ? AND password = ? ";
        // $user = $this->db->query($sql, array($usernameHash, $hash))->limit(1)->row();

        $user = $this->db->where('username', $username)
            ->where('password', $hash)
            //->where('password', $password)
            ->limit(1)
            ->get($this->table)
            ->row();

        if($user){
            if($user->langCode <> ''){
                if($user->langCode == $this->session->userdata('langCode')){
                    $lanjut = true;
                } else {
                    $lanjut = false;
                }
            } else {
                $lanjut = true;
            }
        } else {
            $lanjut = false;
        }
		
        if($lanjut){

            if($user->recordLabelId > 0){
                $sql = "SELECT recordLabel FROM trecordlabel WHERE recordLabelId = ?";
                $recordeLabel = $this->db->query($sql, array($user->recordLabelId))->row();
                $data = [
                    "username"=>$user->username,
                    "level"=>"label",
                    "roleId"=>$user->roleId,
                    "artistId"=>$user->artistId,
                    "recordLabelId"=>$user->recordLabelId,
                    "arrangerId"=>$user->arrangerId,
                    "composerId"=>$user->composerId,
                    "timeout" => time() + 1000,
                    "login" => 1,
                    "labelname"=> $recordeLabel->recordLabel,
                    "admincountry"=>$user->langCode
                ];
            }

            if($user->artistId > 0){
                $sql = "SELECT count(DISTINCT tsongartist.songId) as JumlahLagu,  tsong.coverImage as coverImage, tartist.`name` as name FROM tsong
                                                          INNER JOIN tsongartist ON tsongartist.songId = tsong.songId
                                                          INNER JOIN tartist ON tsongartist.artistId = tartist.artistId 
                                                          WHERE tartist.artistId = ?";
                $dataArtist = $this->db->query($sql, array($user->artistId))->row();

                $data = [
                    "username"=>$user->username,
                    "level"=>"artist",
                    "roleId"=>$user->roleId,
                    "artistId"=>$user->artistId,
                    "recordLabelId"=>$user->recordLabelId,
                    "arrangerId"=>$user->arrangerId,
                    "composerId"=>$user->composerId,
                    "timeout" => time() + 1000,
                    "login" => 1,
                    "labelname"=> NULL,
                    "nameArtist"=>$dataArtist->name,
                    "cover"=>$dataArtist->coverImage,
                    "admincountry"=>$user->langCode
                ];
            }

            if($user->composerId > 0){
                $sql = "SELECT name FROM tcomposer WHERE composerId = ?";
                $recordComposer = $this->db->query($sql, array($user->composerId))->row();

                $data = [
                    "username"=>$user->username,
                    "level"=>"composer",
                    "roleId"=>$user->roleId,
                    "artistId"=>$user->artistId,
                    "recordLabelId"=>$user->recordLabelId,
                    "arrangerId"=>$user->arrangerId,
                    "composerId"=>$user->composerId,
                    "timeout" => time() + 1000,
                    "login" => 1,
                    "labelname"=> NULL,
                    "nameComposer"=>$recordComposer->name,
                    "admincountry"=>$user->langCode
                ];
            }

            if($user->arrangerId > 0){
                $sql = "SELECT arranger FROM tarranger WHERE arrangerId = ?";
                $recordArranger = $this->db->query($sql, array($user->arrangerId))->row();

                $data = [
                    "username"=>$user->username,
                    "level"=>"arranger",
                    "roleId"=>$user->roleId,
                    "artistId"=>$user->artistId,
                    "recordLabelId"=>$user->recordLabelId,
                    "arrangerId"=>$user->arrangerId,
                    "composerId"=>$user->composerId,
                    "timeout" => time() + 1000,
                    "login" => 1,
                    "labelname"=> NULL,
                    "nameArranger"=>$recordArranger->arranger,
                    "admincountry"=>$user->langCode
                ];
            }

            if($user->artistId <= 0 AND $user->recordLabelId <= 0 AND $user->composerId <= 0 AND $user->arrangerId <= 0){
                
                if($user->roleId == 1){
                    $data = [
                        "username"=>$user->username,
                        //"artistId"=>$user->artistId,
                        "level"=>"admin",
                        "roleId"=>$user->roleId,
                        "lembaga"=>$user->lembaga,
                        //"recordLabelId"=>$user->recordLabelId,
                        "timeout" => time() + 1000,
                        "login" => 1,
                        "labelname"=> NULL,
                        "admincountry"=>$user->langCode
                    ];
                }
                else if($user->roleId == 4){
                    $data = [
                        "username"=>$user->username,
                        //"artistId"=>$user->artistId,
                        "level"=>"adminartist",
                        "roleId"=>$user->roleId,
                        "lembaga"=>$user->lembaga,
                        //"recordLabelId"=>$user->recordLabelId,
                        "timeout" => time() + 1000,
                        "login" => 1,
                        "labelname"=> NULL,
                        "admincountry"=>$user->langCode
                    ];
                }
                else if($user->roleId == 5){
                    $data = [
                        "username"=>$user->username,
                        //"artistId"=>$user->artistId,
                        "level"=>"adminlabel",
                        "roleId"=>$user->roleId,
                        "lembaga"=>$user->lembaga,
                        //"recordLabelId"=>$user->recordLabelId,
                        "timeout" => time() + 1000,
                        "login" => 1,
                        "labelname"=> NULL,
                        "admincountry"=>$user->langCode
                    ];
                }
                else if($user->roleId == 8){
                    $data = [
                        "username"=>$user->username,
                        //"artistId"=>$user->artistId,
                        "level"=>"adminarranger",
                        "roleId"=>$user->roleId,
                        "lembaga"=>$user->lembaga,
                        //"recordLabelId"=>$user->recordLabelId,
                        "timeout" => time() + 1000,
                        "login" => 1,
                        "labelname"=> NULL,
                        "admincountry"=>$user->langCode
                    ];
                }
                else{
                    $data = [
                        "username"=>$user->username,
                        //"artistId"=>$user->artistId,
                        "level"=>"admincomposer",
                        "roleId"=>$user->roleId,
                        "lembaga"=>$user->lembaga,
                        //"recordLabelId"=>$user->recordLabelId,
                        "timeout" => time() + 1000,
                        "login" => 1,
                        "labelname"=> NULL,
                        "admincountry"=>$user->langCode
                    ];
                }
            }

            $this->session->set_userdata($data);
            return true;
        }
        else{
            return false;
        }
    }

    function logout(){
        $data = [
            "username"=>null,
            "artistId"=>null,
            "level"=>null,
            "roleId"=>null,
            "recordLabelId"=>null,
            "timeout" =>null,
            "login" => null,
            "labelname"=> null,
            "nameArtist"=>null,
            "cover"=>null,
            "langCode"=>null,
            "admincountry"=>null
        ];

        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
    }
}
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 19/11/2017
 * Time: 10:32
 */