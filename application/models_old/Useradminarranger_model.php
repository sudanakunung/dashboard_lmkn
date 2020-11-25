<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useradminarranger_model extends MY_Model
{
    
    public function getDataUser($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "AND name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT userId, email, name, gender, birthday FROM tuser WHERE artistId = 0 $where ORDER BY userId DESC LIMIT $offset, $dataPerPage")->result();

        return $query;
    }

    public function countDataUser($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }
		
		$sql = "SELECT userId FROM tuser ".$where."";
        $data = $this->db->query($sql)->num_rows();

        return $data;
    }
}
