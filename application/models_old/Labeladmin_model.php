<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Labeladmin_model extends MY_Model {
    
    public function getDataLabel($offset, $dataPerPage, $keyword = null)
    {

        if(!empty($keyword)) {
            $where = "WHERE recordLabel LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT recordLabelId, recordLabel, createdDate FROM trecordlabel $where ORDER BY recordLabelId DESC LIMIT $offset, $dataPerPage")->result();

        return $query;
    }

    public function countDataLabel($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE recordLabel LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT recordLabelId FROM trecordlabel $where")->num_rows();

        return $query;
    }
    
    public function tambahlabel($recordLabel){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql    = "INSERT INTO trecordlabel (recordLabel) VALUES (?)";
        $data   = $this->db->query($sql,array($recordLabel));
        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function aksieditlabel($labelId,$recordLabel){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql    = "UPDATE trecordlabel SET recordLabel = ? WHERE recordLabelId = ?";
        $data   = $this->db->query($sql,array($recordLabel,$labelId));
        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function editlabel($labelId){
        $sql    = "SELECT recordLabelId, recordLabel FROM trecordlabel WHERE recordLabelId = ?";
        $data   = $this->db->query($sql,array($labelId))->row();
        return $data;
    }

    public function aksihapuslabel($labelId){
        $sql    = "DELETE FROM trecordlabel WHERE recordLabelId = ?";
        $data   = $this->db->query($sql,array($labelId));
        return $data;
    }
}