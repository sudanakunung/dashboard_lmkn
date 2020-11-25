<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Composerlist_model extends MY_Model
{

    public function getData()
    {
        $sql = "SELECT composerId, name, referral FROM tcomposer";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    public function getDataComposer($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT * FROM tcomposer $where ORDER BY composerId DESC LIMIT $offset, $dataPerPage")->result();

        return $query;
    }

    public function countDataComposer($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT composerId FROM tcomposer $where")->num_rows();

        return $query;
    }
}
?>