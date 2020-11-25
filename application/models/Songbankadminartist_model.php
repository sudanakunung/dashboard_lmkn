<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Songbankadminartist_model extends MY_Model
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
            EXISTS (SELECT 1  FROM tsongartist WHERE tsongartist.songId = tsong.songId) 
            ORDER BY tsong.title ASC LIMIT $offset, $dataPerPage")->result();

        $datasongbank = [];

        foreach($getsongbank as $key => $val){
            $datasongbank[$key]['songId'] = $val->songIds;
            $datasongbank[$key]['title'] = $val->title;
            $datasongbank[$key]['JUMLAH_RECORDING'] = $val->JUMLAH_RECORDING;
            $datasongbank[$key]['JUMLAH_LIKE'] = $val->JUMLAH_LIKE;
            $datasongbank[$key]['JUMLAH_VIEW'] = $val->JUMLAH_VIEW;
            $datasongbank[$key]['jumlah'] = $val->jumlah;

            $query_artist = $this->db->select('tartist.name')
                ->join('tartist', 'tsongartist.artistId = tartist.artistId', 'left')
                ->get_where('tsongartist', array('tsongartist.songId' => $val->songIds))
                ->row();
            $datasongbank[$key]['artist_name'] = ($query_artist ? $query_artist->name : '');
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
            EXISTS (SELECT 1  FROM tsongartist WHERE tsongartist.songId = tsong.songId)
            ORDER BY tsong.title ASC")->num_rows();

        return $query;
    }

    public function getDataSong($songId){
        $sql = "SELECT tsong.title, tsong.coverImage, tsong.dateCreated FROM tsong 
                INNER JOIN tsongartist ON tsong.songId = tsongartist.songId 
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

    public function getArtistData(){
        $sql = "SELECT tartist.artistId,tartist.name FROM tartist ORDER BY tartist.name ASC";

        $data = $this->db->query($sql)->result();

        return $data;
    }

    public function getSongArtist($artistId)
    {
        $artist = $this->db->get_where('tartist', ['artistId ' => $artistId])->row_array();

        $artistName = '%'.$artist['name'].'%';
        
        $sql = "SELECT tsong.songId ,tsong.title, tsong.artistName FROM tsong 
                WHERE tsong.artistName LIKE ? AND tsong.songId NOT IN (SELECT tsongartist.songId FROM tsongartist)";

        $data = $this->db->query($sql, array($artistName))->result();

        return $data;
    }

    public function simpansongrequest()
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $artistId = $this->input->post('ArtistName');
        $songdata = $this->input->post('song_checkbox');
        $lembagaAdminLogin = $this->session->userdata('lembaga');
        
        $json->admin = "adminartist";
        $json->lembaga = $lembagaAdminLogin;
        $requested_by = json_encode($json);
        
        foreach ($songdata as $song){

           $data = [
                'songId' => $song,
                'artistId' => $artistId
            ];

            $data = $this->db->insert('tsongartist', $data);
        }

        $this->db->db_debug = $db_debug;
        return $data;
    }

    // fungsi song request ke table song request
    // public function simpansongrequest()
    // {
    //     $db_debug = $this->db->db_debug;
    //     $this->db->db_debug = FALSE;

    //     $artistId = $this->input->post('ArtistName');
    //     $songdata = $this->input->post('song_checkbox');
    //     $lembagaAdminLogin = $this->session->userdata('lembaga');
        
    //     $json->admin = "adminartist";
    //     $json->lembaga = $lembagaAdminLogin;
    //     $requested_by = json_encode($json);
        
    //     foreach ($songdata as $song){

    //        $data = [
    //             'songId' => $song,
    //             'artistId' => $artistId,
    //             'recordLabelId' => '0',
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



