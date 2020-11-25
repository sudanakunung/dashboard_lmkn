<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Songbankadminlabel_model extends MY_Model
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

    public function getAllDataSongbank($tanggal_awal, $tanggal_akhir, $offset, $dataPerPage, $keyword = null)
        {

        if(!empty($keyword)) {
            $where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!' AND";
        } else {
            $where = "WHERE";
        }

        $getsongbank = $this->db->query("SELECT tsong.songId AS songIds, 
            tsong.title,
            (SELECT count(DISTINCT trecording.userId) FROM trecording WHERE trecording.songId = songIds AND trecording.uploadDate >= $tanggal_awal AND trecording.uploadDate < $tanggal_akhir) AS JUMLAH_RECORDING,
            (SELECT count(DISTINCT tsonglike.userId) FROM tsonglike WHERE tsonglike.songId = songIds AND tsonglike.createDate >= $tanggal_awal AND tsonglike.createDate < $tanggal_akhir) AS JUMLAH_LIKE,
            (SELECT count(DISTINCT tsongviewer.userId) FROM tsongviewer WHERE tsongviewer.songId = songIds AND tsongviewer.createdDate >= $tanggal_awal  AND tsongviewer.createdDate < $tanggal_akhir) AS JUMLAH_VIEW,
            (SELECT count(DISTINCT tsongviewer.userId) FROM tsongviewer WHERE tsongviewer.songId = songIds AND tsongviewer.createdDate >= $tanggal_awal AND tsongviewer.createdDate < $tanggal_akhir) + (SELECT count(DISTINCT tsonglike.userId) FROM tsonglike WHERE tsonglike.songId = songIds AND tsonglike.createDate >= $tanggal_awal AND tsonglike.createDate < $tanggal_akhir) AS jumlah
            FROM tsong 
            $where
            EXISTS (SELECT 1  FROM trecordlabelsong WHERE trecordlabelsong.songId = tsong.songId)
            ORDER BY tsong.title ASC LIMIT $offset, $dataPerPage")->result();

        $datasongbank = [];

        foreach($getsongbank as $key => $val){
            $datasongbank[$key]['songId'] = $val->songIds;
            $datasongbank[$key]['title'] = $val->title;
            $datasongbank[$key]['JUMLAH_RECORDING'] = $val->JUMLAH_RECORDING;
            $datasongbank[$key]['JUMLAH_LIKE'] = $val->JUMLAH_LIKE;
            $datasongbank[$key]['JUMLAH_VIEW'] = $val->JUMLAH_VIEW;
            $datasongbank[$key]['jumlah'] = $val->jumlah;

            $query_label = $this->db->select('trecordlabel.recordLabel')
                ->join('trecordlabel', 'trecordlabel.recordLabelId = trecordlabelsong.recordLabelId', 'left')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $val->songIds))
                ->row();
            $datasongbank[$key]['label_name'] = ($query_label ? $query_label->recordLabel : '');
        }

        // Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
        return result_object($datasongbank);
        
    }

    public function countDataSongbank($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!' AND";
        } else {
            $where = "WHERE";
        }

        $query = $this->db->query("SELECT tsong.songId FROM tsong 
            $where
            EXISTS (SELECT 1  FROM trecordlabelsong WHERE trecordlabelsong.songId = tsong.songId)
            ORDER BY tsong.title ASC")->num_rows();

        return $query;
    }

    public function getDataSong($songId){
        $sql = "SELECT tsong.title, tsong.coverImage, tsong.dateCreated FROM tsong 
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId 
                WHERE tsong.songId = ?";
        $data = $this->db->query($sql, array($songId))->result();
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

    public function getLabelData()
    {
        $sql = "SELECT trecordlabel.recordLabelId, trecordlabel.recordLabel FROM trecordlabel ORDER BY trecordlabel.recordLabel ASC";

        $data = $this->db->query($sql)->result();

        return $data;
    }

    public function getSongData()
    {
        $sql = "SELECT tsong.songId, tsong.title, tsong.artistName FROM tsong 
                WHERE tsong.songId NOT IN (SELECT trecordlabelsong.songId FROM trecordlabelsong)";

        $data = $this->db->query($sql)->result();

        return $data;
    }

    public function simpansongrequest()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $recordLabelId = $this->input->post('LabelName');
        $songdata = $this->input->post('song_checkbox');
        $lembagaAdminLogin = $this->session->userdata('lembaga');

        $json->admin = "adminlabel";
        $json->lembaga = $lembagaAdminLogin;
        $requested_by = json_encode($json);

        foreach ($songdata as $song){

            $data = [
                'songId' => $song,
                'recordLabelId' => $recordLabelId
            ];

            $data = $this->db->insert('trecordlabelsong', $data);
        }

        $this->db->db_debug = $db_debug;
        return $data;
    }

    // public function simpansongrequest()
    // {
    //     $db_debug = $this->db->db_debug;
    //     $this->db->db_debug = FALSE;

    //     $recordLabelId = $this->input->post('LabelName');
    //     $songdata = $this->input->post('song_checkbox');
    //     $lembagaAdminLogin = $this->session->userdata('lembaga');

    //     $json->admin = "adminlabel";
    //     $json->lembaga = $lembagaAdminLogin;
    //     $requested_by = json_encode($json);

    //     foreach ($songdata as $song){

    //         $data = [
    //             'songId' => $song,
    //             'artistId' => '0',
    //             'recordLabelId' => $recordLabelId,
    //             'composerId' => '0',
    //             'requested_by' => $requested_by,
    //             'approve' => 'N'
    //         ];

    //         $data = $this->db->insert('tsongrequest', $data);
    //     }

    //     $this->db->db_debug = $db_debug;
    //     return $data;
    // }
}



