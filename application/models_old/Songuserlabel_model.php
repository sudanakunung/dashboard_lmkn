<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Songuserlabel_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUser(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tuser";
        $data = $this->db->query($sql)->row();

        return $data;
    }

    public function getAllDataSongUser($id, $tanggal_awal, $tanggal_akhir, $offset, $dataPerPage, $keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!' AND";
        } else {
            $where = "WHERE";
        }

        $getsonguser = $this->db->query("SELECT tsong.songId AS songIds, 
            tsong.title,
            (SELECT COUNT(DISTINCT trecording.userId) FROM trecording WHERE trecording.songId = songIds AND trecording.uploadDate >= $tanggal_awal AND trecording.uploadDate < $tanggal_akhir) AS JUMLAH_RECORDING,
            (SELECT COUNT(DISTINCT tsonglike.userId) FROM tsonglike WHERE tsonglike.songId = songIds AND tsonglike.createDate >= $tanggal_awal AND tsonglike.createDate < $tanggal_akhir) AS JUMLAH_LIKE,
            (SELECT COUNT(DISTINCT tsongviewer.userId) FROM tsongviewer WHERE tsongviewer.songId = songIds AND tsongviewer.createdDate >= $tanggal_awal  AND tsongviewer.createdDate < $tanggal_akhir) AS JUMLAH_VIEW,
            (SELECT COUNT(DISTINCT tsongviewer.userId) FROM tsongviewer WHERE tsongviewer.songId = songIds AND tsongviewer.createdDate >= $tanggal_awal AND tsongviewer.createdDate < $tanggal_akhir) + (SELECT COUNT(DISTINCT tsonglike.userId) FROM tsonglike WHERE tsonglike.songId = songIds AND tsonglike.createDate >= $tanggal_awal AND tsonglike.createDate < $tanggal_akhir) AS jumlah
            FROM tsong                                     
            $where
            EXISTS (SELECT 1 FROM trecordlabelsong WHERE trecordlabelsong.songId = tsong.songId AND trecordlabelsong.recordLabelId = $id)
            ORDER BY tsong.title ASC LIMIT $offset, $dataPerPage")->result();

        $datasonguser = [];

        foreach($getsonguser as $key => $val){
            $datasonguser[$key]['songId'] = $val->songIds;
            $datasonguser[$key]['title'] = $val->title;
            $datasonguser[$key]['JUMLAH_RECORDING'] = $val->JUMLAH_RECORDING;
            $datasonguser[$key]['JUMLAH_LIKE'] = $val->JUMLAH_LIKE;
            $datasonguser[$key]['JUMLAH_VIEW'] = $val->JUMLAH_VIEW;
            $datasonguser[$key]['jumlah'] = $val->jumlah;

            $query_label = $this->db->select('recordLabel')
                ->get_where('trecordlabel', array('recordLabelId' => $id))
                ->row();
            $datasonguser[$key]['label_name'] = ($query_label ? $query_label->recordLabel : '');
        }

        // Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
        return result_object($datasonguser);
    }

    public function countDataSongUser($id, $keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!' AND";
        } else {
            $where = "WHERE";
        }

        $query = $this->db->query("SELECT tsong.songId FROM tsong
            $where
            EXISTS (SELECT 1 FROM trecordlabelsong WHERE trecordlabelsong.songId = tsong.songId AND trecordlabelsong.recordLabelId = $id)
            ORDER BY tsong.title ASC")->num_rows();

        return $query;
    }

    public function getDataSong($recordLabelId, $songId){
        $sql = "SELECT tsong.title, tsong.coverImage, tsong.dateCreated FROM tsong INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId WHERE trecordlabelsong.recordLabelId = ? AND tsong.songId = ?";
        $data = $this->db->query($sql, array($recordLabelId, $songId))->result();
        return $data;
    }

    public function getGrafikRecorder($songId, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender as gender, count(DISTINCT trecording.userId) as jumlah FROM trecording INNER JOIN tuser ON trecording.userId = tuser.userId WHERE trecording.songId = ? AND trecording.uploadDate >= ? AND trecording.uploadDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($songId, $tanggal_awal, $tanggal_akhir))->result();
        return $data;
    }

    public function getGrafikLike($songId, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender as gender, count(DISTINCT tsonglike.userId) as jumlah FROM tsonglike INNER JOIN tuser ON tsonglike.userId = tuser.userId WHERE tsonglike.songId = ? AND tsonglike.createDate >= ? AND tsonglike.createDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($songId, $tanggal_awal, $tanggal_akhir))->result();
        return $data;
    }

    public function getGrafikView($songId, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender as gender, count(DISTINCT tsongviewer.userId) as jumlah FROM tsongviewer INNER JOIN tuser ON tsongviewer.userId = tuser.userId WHERE tsongviewer.songId = ? AND tsongviewer.createdDate  >= ? AND tsongviewer.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($songId, $tanggal_awal, $tanggal_akhir))->result();
        return $data;
    }

    public function cekSong($recordLabelId, $songId){

        $sql = "SELECT songId, recordLabelId FROM trecordlabelsong WHERE recordLabelId = ? AND songId = ?";
        $data = $this->db->query($sql, array($recordLabelId, $songId))->result();
        if(empty($data)){
            return false;
        }
        else{
            return true;
        }
    }

    public function getDataSongUserToAdd($recordLabelId, $offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "AND (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tsong.artistName LIKE '%".$keyword."%')";
        } else {
            $where = "";
        }
        
        $sql = "SELECT tsong.songId, tsong.title, tsong.artistName FROM tsong 
                WHERE tsong.songId NOT IN (SELECT trecordlabelsong.songId FROM trecordlabelsong WHERE trecordlabelsong.recordLabelId = '$recordLabelId')
                AND tsong.songId NOT IN (SELECT tsongrequest.songId FROM tsongrequest WHERE tsongrequest.recordLabelId = '$recordLabelId')
                $where
                ORDER BY tsong.title ASC 
                LIMIT $offset, $dataPerPage";

        $data = $this->db->query($sql)->result();

        return $data;
    }

    public function countDataSongUserToAdd($recordLabelId, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "AND (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tsong.artistName LIKE '%".$keyword."%')";
        } else {
            $where = "";
        }
        
        $sql = "SELECT tsong.songId FROM tsong 
                WHERE tsong.songId NOT IN (SELECT trecordlabelsong.songId FROM trecordlabelsong WHERE trecordlabelsong.recordLabelId = '$recordLabelId')
                AND tsong.songId NOT IN (SELECT tsongrequest.songId FROM tsongrequest WHERE tsongrequest.recordLabelId = '$recordLabelId')
                $where";

        $data = $this->db->query($sql)->num_rows();

        return $data;
    }

    public function simpansonguser($recordLabelId, $songId)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $data = [
            'songId' => $songId,
            'artistId' => 0,
            'composerId' => 0,
            'recordLabelId' => $recordLabelId,
            'arrangerId' => 0
        ];

        $data = $this->db->insert('tsongrequest', $data);

        $this->db->db_debug = $db_debug;
        return $data;
    }
}



