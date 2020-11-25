<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Banneradmincomposer_model extends MY_Model
{

    public function getDataBanner($offset, $dataPerPage, $keyword)
    {
        if(!empty($keyword)) {
            $where = "WHERE title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT bannerId, title, urlImage, url, createdDate, showDate, expDate FROM tbanner $where ORDER BY title ASC LIMIT $offset, $dataPerPage")->result();

        return $query;
    }

    public function countDataBanner($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE (UPPER(title) LIKE UPPER('%".$keyword."%') ESCAPE '!' OR LOWER(title) LIKE LOWER('%".$keyword."%') ESCAPE '!' OR title LIKE '%".$keyword."%' ESCAPE '!')";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT bannerId, title, urlImage, url, createdDate, showDate, expDate FROM tbanner $where ORDER BY title ASC")->num_rows();

        return $query;
    }
}
/**
 * Created by PhpStorm.
 * User: subki
 * Date: 15/02/2018
 * Time: 12:40
 */