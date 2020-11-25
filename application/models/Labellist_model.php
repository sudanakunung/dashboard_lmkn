<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Labellist_model extends MY_Model
{

    public function getDataLabel($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "WHERE recordLabel LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT * FROM trecordlabel $where ORDER BY recordLabelId DESC LIMIT $offset, $dataPerPage")->result();

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
}
?>