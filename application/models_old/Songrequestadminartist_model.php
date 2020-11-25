<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Songrequestadminartist_model extends MY_Model{

    public function totalrequest(){
        $sql = "SELECT COUNT(*) as jumlah FROM tsongrequest WHERE artistId <> 0 AND approve = 'N'";
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

        $getsongrequest = $this->db->query("SELECT tsongrequest.*, tsong.title FROM tsongrequest INNER JOIN tsong ON tsong.songId = tsongrequest.songId WHERE tsongrequest.artistId <> 0 $where ORDER BY tsong.title DESC LIMIT $offset, $dataPerPage")->result();

        $datasongrequest = [];

        foreach($getsongrequest as $key => $val){
            $datasongrequest[$key]['tsongrequestId'] = $val->tsongrequestId;
            $datasongrequest[$key]['songId'] = $val->songId;
            $datasongrequest[$key]['artistId'] = $val->artistId;
            $datasongrequest[$key]['approve'] = $val->approve;
            $datasongrequest[$key]['requested_by'] = $val->requested_by;
            $datasongrequest[$key]['title'] = $val->title;            

            $query_artist = $this->db->select('name')
                ->get_where('tartist', array('artistId' => $val->artistId))
                ->row();
            $datasongrequest[$key]['artist'] = ($query_artist ? $query_artist->name : '');
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

        $query = $this->db->query("SELECT tsongrequest.tsongrequestId FROM tsongrequest INNER JOIN tsong ON tsong.songId = tsongrequest.songId WHERE tsongrequest.artistId <> 0 $where")->num_rows();

        return $query;
    }


    public function approvesong($id)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $sql = "SELECT * FROM tsongrequest WHERE tsongrequestId = ?";
        $request = $this->db->query($sql, array($id))->row();

        $sql = "INSERT INTO tsongartist (songId, artistId) VALUES (?,?)";
            $data = $this->db->query($sql, array($request->songId,$request->artistId));

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
