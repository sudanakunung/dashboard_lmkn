<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useradmin_model extends MY_Model
{

    public function getDataUser($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "AND name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT userId, email, name, gender, birthday FROM tuser WHERE artistId = 0 ".$where." ORDER BY userId DESC LIMIT ".$offset.", ".$dataPerPage."")->result();

        return $query;
    }

    public function countDataUser($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }
		
		$sql = "SELECT COUNT(userId) AS jumlah FROM tuser ".$where."";
        $data = $this->db->query($sql)->row();

        return $data->jumlah;
    }

    public function getEdit($userId){
        $sql = "SELECT userId, email, name, gender, birthday FROM tuser WHERE artistId = 0 AND userId = ?";
        $data = $this->db->query($sql, array($userId))->result();
        return $data;
    }

    public function getAksi($userId,$email,$nama,$birthday,$gender){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql = "UPDATE `tuser` SET `email`= ?, `name` = ?, `gender` = ?, `birthday` = ? WHERE `userId` = ?";
        $data = $this->db->query($sql, array($email, $nama, $gender, $birthday, $userId));
        $this->db->db_debug = $db_debug;
        return $data;
    }
}
