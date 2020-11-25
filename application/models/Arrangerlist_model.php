<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arrangerlist_model extends MY_Model
{

    public function getDataArranger($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "WHERE arranger LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT * FROM tarranger $where ORDER BY arrangerId DESC LIMIT $offset, $dataPerPage")->result();

        return $query;
    }

    public function countDataArranger($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE arranger LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT arrangerId FROM tarranger $where")->num_rows();

        return $query;
    }
}
?>