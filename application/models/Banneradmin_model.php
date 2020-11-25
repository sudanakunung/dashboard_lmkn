<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Banneradmin_model extends MY_Model
{

    public function getDataBanner($offset, $dataPerPage, $keyword = null)
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
            $where = "WHERE title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT bannerId, title, urlImage, url, createdDate, showDate, expDate FROM tbanner $where ORDER BY title ASC")->num_rows();

        return $query;
    }

    public function tambah($title,$urlImage,$urlklik,$createdDate,$showDate,$expDate)
    {
        $sql = "INSERT INTO tbanner (title, urlImage, url, createdDate, showDate, expDate) VALUES (?,?,?,?,?,?)";
        $data = $this->db->query($sql, array($title,$urlImage,$urlklik,$createdDate,$showDate,$expDate));
        return $data;
    }

    public function dataEdit($id){
        $sql = "SELECT bannerId, title, urlImage, url, createdDate, showDate, expDate FROM tbanner WHERE bannerId = ?";
        $data = $this->db->query($sql, array($id))->row();
        return $data;
    }

    public function editWithoutImage($title,$urlklik,$createdDate,$showDate,$expDate,$id){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql = "UPDATE tbanner SET title =  ?, url = ?, createdDate = ?, showDate = ?, expDate = ? WHERE bannerId = ?";
        $data = $this->db->query($sql, array($title,$urlklik,$createdDate,$showDate,$expDate,$id));
        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function editWithImage($title,$urlImage,$urlklik,$createdDate,$showDate,$expDate,$id){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql = "UPDATE tbanner SET title =  ?, urlImage = ?, url = ?, createdDate = ?, showDate = ?, expDate = ? WHERE bannerId = ?";
        $data = $this->db->query($sql, array($title,$urlImage,$urlklik,$createdDate,$showDate,$expDate,$id));
        $this->db->db_debug = $db_debug;
        return $data;

    }

    public function hapus($bannerId){
        $sql = "DELETE FROM tbanner WHERE bannerId = ?";
        $data = $this->db->query($sql, array($bannerId));
        return $data;
    }
}
/**
 * Created by PhpStorm.
 * User: subki
 * Date: 15/02/2018
 * Time: 12:40
 */