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

        $query = $this->db->query("SELECT recordLabelId, recordLabel, lembaga, createdDate FROM trecordlabel $where ORDER BY recordLabelId DESC LIMIT $offset, $dataPerPage")->result();

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
    
    public function tambahlabel(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        //Fungsi 'true' pada bagian input untuk melindungi post dari sql injection dengan mengamankan html special karakter
        $input = [
            'recordLabel' => $this->input->post('recordLabel', true),
            'lembaga' => $this->input->post('lembaga', true),
        ];

        $data = $this->db->insert('trecordlabel', $input);

        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function aksieditlabel(){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $input = [
            'recordLabel' => $this->input->post('recordLabel', true),
            'lembaga' => $this->input->post('lembaga', true)
        ];

        $this->db->where('recordLabelId', $this->input->post('id'));
        $data = $this->db->update('trecordlabel', $input);
        
        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function editlabel($labelId){
        $sql    = "SELECT recordLabelId, recordLabel, lembaga FROM trecordlabel WHERE recordLabelId = ?";
        $data   = $this->db->query($sql,array($labelId))->row();
        return $data;
    }

    public function aksihapuslabel($labelId){
        $sql    = "DELETE FROM trecordlabel WHERE recordLabelId = ?";
        $data   = $this->db->query($sql,array($labelId));
        return $data;
    }
}