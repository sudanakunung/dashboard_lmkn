<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songadminarranger_model extends MY_Model{

    function getDataSong($offset, $dataPerPage, $keyword = null){
        if(!empty($keyword)) {
            $where = "WHERE title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT songId, title, artistName, description, coverImage FROM tsong $where ORDER BY title ASC LIMIT $offset, $dataPerPage")->result();

        return $query;
    }

    public function countDataSong($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT songId, title, artistName, description, coverImage FROM tsong $where ORDER BY title ASC")->num_rows();

        return $query;
    }
}