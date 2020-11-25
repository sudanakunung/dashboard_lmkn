<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Songrequestadmin_model extends MY_Model{

    public function totalrequest(){
        $sql = "SELECT COUNT(tsongrequestId) as jumlah 
        FROM tsongrequest
        INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
        WHERE tsongrequest.approve = 'N'
        AND tsong.langCode = '".$this->session->userdata('admincountry')."'";
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

        $getsongrequest = $this->db->query("SELECT tsongrequest.*, tsong.title 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            WHERE tsong.langCode = '".$this->session->userdata('admincountry')."'
            $where 
            ORDER BY tsong.title DESC 
            LIMIT $offset, $dataPerPage")->result();

        $datasongrequest = [];

        foreach($getsongrequest as $key => $val){
            $datasongrequest[$key]['tsongrequestId'] = $val->tsongrequestId;
            $datasongrequest[$key]['songId'] = $val->songId;
            $datasongrequest[$key]['artistId'] = $val->artistId;
            $datasongrequest[$key]['composerId'] = $val->composerId;
            $datasongrequest[$key]['recordLabelId'] = $val->recordLabelId;
            $datasongrequest[$key]['arrangerId'] = $val->arrangerId;
            $datasongrequest[$key]['approve'] = $val->approve;
            $datasongrequest[$key]['title'] = $val->title;            

            $query_artist = $this->db->select('name')
                ->get_where('tartist', array('artistId' => $val->artistId))
                ->row();
            $datasongrequest[$key]['artist'] = ($query_artist ? $query_artist->name : '');

            $query_label = $this->db->select('recordLabel')
                ->get_where('trecordlabel', array('recordLabelId' => $val->recordLabelId))
                ->row();
            $datasongrequest[$key]['label'] = ($query_label ? $query_label->recordLabel : '');

            $query_arranger = $this->db->select('arranger')
                ->get_where('tarranger', array('arrangerId' => $val->arrangerId))
                ->row();
            $datasongrequest[$key]['arranger'] = ($query_arranger ? $query_arranger->arranger : '');

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

        $query = $this->db->query("SELECT tsongrequest.tsongrequestId 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            WHERE tsong.langCode = '".$this->session->userdata('admincountry')."'
            $where")->num_rows();

        return $query;
    }


    public function approvesong($id)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $sql = "SELECT * FROM tsongrequest WHERE tsongrequestId = ?";
        $request = $this->db->query($sql, array($id))->row();

        if($request->artistId > 0){
            $sql = "INSERT INTO tsongartist (songId, artistId) VALUES (?,?)";
            $data = $this->db->query($sql, array($request->songId,$request->artistId));
        }
        elseif($request->recordLabelId > 0){
            $sql = "INSERT INTO trecordlabelsong (songId, recordLabelId) VALUES (?,?)";
            $data = $this->db->query($sql, array($request->songId,$request->recordLabelId));
        }
        elseif($request->arrangerId > 0){
            $sql = "INSERT INTO tsongarranger (songId, arrangerId) VALUES (?,?)";
            $data = $this->db->query($sql, array($request->songId,$request->arrangerId));
        } else {
            $sql = "INSERT INTO tsongcomposer (songId, composerId) VALUES (?,?)";
            $data = $this->db->query($sql, array($request->songId,$request->composerId));
        }

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
