<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistadmin_model extends MY_Model
{

    public function getDataArtist($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT artistId, name, referral, userId, lembaga FROM tartist $where ORDER BY artistId DESC LIMIT $offset, $dataPerPage")->result();

        return $query;
    }

    public function countDataArtist($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT artistId FROM tartist $where")->num_rows();

        return $query;
    }

    public function getDataEdit($artistId){
        $sql = "SELECT artistId, name, referral, userId, lembaga FROM tartist WHERE artistId = ?";
        $data = $this->db->query($sql, array($artistId))->row();
        return $data;
    }

    public function inputData($name,$referral,$userId,$lembaga){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql = "INSERT INTO tartist (name,referral,userId,lembaga) VALUES (?,?,?,?)";
        $data = $this->db->query($sql, array($name,$referral,$userId,$lembaga));
        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function editData($artistId,$name,$referral,$userId,$lembaga){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql = "UPDATE tartist SET name = ?, referral = ?, userId = ?, lembaga = ? WHERE artistId = ?";
        $data = $this->db->query($sql, array($name,$referral,$userId,$lembaga,$artistId));
        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function hapus($artistId){
        $sql = "DELETE FROM tartist WHERE artistId = ?";
        $data = $this->db->query($sql, array($artistId));
        return $data;
    }
}
?>