<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Loginartistadmin_model extends MY_Model
{
    public function getdata(){
        $sql = "SELECT tadmin.username,tartist.`name`,tuser.email,tuser.artistId,tadmin.artistId FROM tadmin
                                          inner JOIN tartist ON tadmin.artistId = tartist.artistId
                                          inner JOIN tuser ON tartist.artistId = tuser.artistId";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }
    public function getList(){
        $sql = "SELECT DISTINCT artistId, name FROM tartist WHERE  referral = 1 AND userId = 0 ORDER BY name ASC";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    public function cekUsername($username){
        $sql = "SELECT username FROM tadmin WHERE username = ?";
        $data = $this->db->query($sql, array($username))->row();
        return $data;
    }

    public function cekEmail($email){
        $sql = "SELECT email FROM tuser WHERE email = ?";
        $data = $this->db->query($sql, array($email))->row();
        return $data;
    }

    public function inputTadmin($username, $password, $artistId){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $data = array('username'=>$username,
                          'password'=>$password,
                          'artistId'=>$artistId);
        $hasil = $this->db->insert('tadmin', $data);
        $this->db->db_debug = $db_debug;
        return $hasil;
    }

    public function inputTuser($email, $name, $password, $artistId){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $data = array('email'=>$email,
            'name'=>$name,
            'password'=>$password,
            'artistId'=>$artistId,
            'emailVerified'=>1);
        $hasil = $this->db->insert('tuser', $data);
        $this->db->db_debug = $db_debug;
        if($hasil == true){
            return $this->db->insert_id();
        }
        else{
            return false;
        }
    }

    public function updateTartist($last_Id, $artistId){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $sql = "UPDATE `tartist` SET `userId` = ? WHERE `artistId` = ?";
        $data = $this->db->query($sql, array($last_Id, $artistId));
        $this->db->db_debug = $db_debug;

        return $data;
    }

    public function getUserId($email){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $sql = "SELECT `userId` as userId FROM `tuser` WHERE `email` = ?";
        $data = $this->db->query($sql, array($email))->row();
        $this->db->db_debug = $db_debug;

        return $data;
    }

    public function updateTuser($email, $name, $password, $artistId, $userId){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $sql = "UPDATE `tuser` SET `email` = ?,`name` = ?,`password` = ? ,`artistId` = ?, `emailVerified` = 1 WHERE `userId` = ?";
        $data = $this->db->query($sql, array($email, $name, $password, $artistId, $userId));
        $this->db->db_debug = $db_debug;

        if($data == true){
            return true;
        }
        else{
            return false;
        }
    }

    public function updateTartistIFFALSE($userId, $artistId){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $sql = "UPDATE `tartist` SET `userId` = ? WHERE `artistId` = ?";
        $data = $this->db->query($sql, array($userId, $artistId));
        $this->db->db_debug = $db_debug;

        if($data == true){
            return true;
        }
        else{
            return false;
        }
    }
}



