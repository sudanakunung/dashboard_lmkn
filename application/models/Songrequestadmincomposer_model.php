<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Songrequestadmincomposer_model extends MY_Model{

    public function totalrequest(){
        $sql = "SELECT COUNT(*) as jumlah FROM tsongrequest WHERE composerId <> 0 AND approve = 'N'";
        return $this->db->query($sql)->row();
    }

    public function totalsongbank(){
        $query = $this->db->query("SELECT tsong.songId FROM tsong")->num_rows();

        return $query;
    }

    public function datasongrequest($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "AND tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $getsongrequest = $this->db->query("SELECT tsongrequest.*, tsong.title FROM tsongrequest INNER JOIN tsong ON tsong.songId = tsongrequest.songId WHERE tsongrequest.composerId <> 0 $where ORDER BY tsong.title DESC LIMIT $offset, $dataPerPage")->result();

        $datasongrequest = [];

        foreach($getsongrequest as $key => $val){
            $datasongrequest[$key]['tsongrequestId'] = $val->tsongrequestId;
            $datasongrequest[$key]['songId'] = $val->songId;
            $datasongrequest[$key]['composerId'] = $val->composerId;
            $datasongrequest[$key]['approve'] = $val->approve;
            $datasongrequest[$key]['requested_by'] = $val->requested_by;
            $datasongrequest[$key]['title'] = $val->title;            

            $query_composer = $this->db->select('name')
                ->get_where('tcomposer', array('composerId' => $val->composerId))
                ->row();
            $datasongrequest[$key]['composer'] = ($query_composer ? $query_composer->name : '');
        }

        // Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php

        return result_object($datasongrequest);
    }

    public function countDataSongRequest()
    {
        if(!empty($keyword)) {
            $where = "AND tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT tsongrequest.tsongrequestId FROM tsongrequest INNER JOIN tsong ON tsong.songId = tsongrequest.songId WHERE tsongrequest.composerId <> 0 $where")->num_rows();

        return $query;
    }


    public function approvesong($id)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $sql = "SELECT * FROM tsongrequest WHERE tsongrequestId = ?";
        $request = $this->db->query($sql, array($id))->row();

        $sql = "INSERT INTO tsongcomposer (songId, composerId) VALUES (?,?)";
            $data = $this->db->query($sql, array($request->songId,$request->composerId));

        $sql = "DELETE FROM tsongrequest WHERE tsongrequestId = ?";
        $data = $this->db->query($sql, array($id));

        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function declinesong($id)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql    = "DELETE FROM tsongrequest WHERE tsongrequestId = ?";
        $data   = $this->db->query($sql,array($id));
        $this->db->db_debug = $db_debug;
        return $data;
    }
}
