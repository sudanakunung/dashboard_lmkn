<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Songbankadmin_model extends MY_Model
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
            (EXISTS (SELECT 1  FROM tsongartist WHERE tsongartist.songId = tsong.songId) 
            OR EXISTS (SELECT 1  FROM trecordlabelsong WHERE trecordlabelsong.songId = tsong.songId) 
            OR EXISTS (SELECT 1  FROM tsongcomposer WHERE tsongcomposer.songId = tsong.songId)
            OR EXISTS (SELECT 1  FROM tsongarranger WHERE tsongarranger.songId = tsong.songId)) 
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

            $query_label = $this->db->select('trecordlabel.recordLabel')
                ->join('trecordlabel', 'trecordlabelsong.recordLabelId = trecordlabel.recordLabelId', 'left')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $val->songIds))
                ->row();
            $datasongbank[$key]['label_name'] = ($query_label ? $query_label->recordLabel : '');

            $query_composer = $this->db->select('tcomposer.name')
                ->join('tcomposer', 'tsongcomposer.composerId = tcomposer.composerId', 'left')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $val->songIds))
                ->row();
            $datasongbank[$key]['composer_name'] = ($query_composer ? $query_composer->name : '');

             $query_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $val->songIds))
                ->row();
            $datasongbank[$key]['arranger_name'] = ($query_arranger ? $query_arranger->arranger : '');
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
            (EXISTS (SELECT 1  FROM tsongartist WHERE tsongartist.songId = tsong.songId) 
            OR EXISTS (SELECT 1  FROM trecordlabelsong WHERE trecordlabelsong.songId = tsong.songId) 
            OR EXISTS (SELECT 1  FROM tsongcomposer WHERE tsongcomposer.songId = tsong.songId)
            OR EXISTS (SELECT 1  FROM tsongarranger WHERE tsongarranger.songId = tsong.songId))
            ORDER BY tsong.title ASC")->num_rows();

        return $query;
    }

    public function getAtist(){
        $sql    = "SELECT DISTINCT artistId, name FROM tartist WHERE referral = 1 ORDER BY name ASC";
        $data   = $this->db->query($sql)->result();

        return $data;

    }

    public function getLabel(){
        $sql = "SELECT recordLabelId, recordLabel FROM trecordlabel";
        $data = $this->db->query($sql, array())->result();
        return $data;

    }

    public function getComposer(){
        $sql = "SELECT composerId, name FROM tcomposer";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    public function getArranger(){
        $sql = "SELECT arrangerId, arranger FROM tarranger";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    public function getDataEdit($songId){
        $data_song = $this->db->select('title,songId')->get_where('tsong', array('songId' => $songId))->row();

        $data_artist = $this->db->select('artistId')->get_where('tsongartist', array('songId' => $songId))->row();
        $artistId = ($data_artist ? $data_artist->artistId : null);

        $data_label = $this->db->select('recordLabelId')->get_where('trecordlabelsong', array('songId' => $songId))->row();
        $recordLabelId = ($data_label ? $data_label->recordLabelId : null);

        $data_composer = $this->db->select('composerId')->get_where('tsongcomposer', array('songId' => $songId))->row();
        $composerId = ($data_composer ? $data_composer->composerId : null);

        $data_arranger = $this->db->select('arrangerId')->get_where('tsongarranger', array('songId' => $songId))->row();
        $arrangerId = ($data_arranger ? $data_arranger->arrangerId : null);

        $data = array("songId" => $data_song->songId, "title" => $data_song->title, "artist" => $artistId, "label" => $recordLabelId, "composer"=> $composerId, "arranger"=> $arrangerId);

        return $data;
    }

    public function ubahDataSongBank(){
        $id = $this->input->post('id', true);
        $artistId = $this->input->post('artistId', true);
        $recordLabelId = $this->input->post('recordLabelId', true);
        $composerId = $this->input->post('composerId', true);
        $arrangerId = $this->input->post('arrangerId', true);

        if($artistId){
            $cari_artist = $this->db->get_where('tsongartist', array('artistId' => $artistId, 'songId' => $id))->num_rows();

            if($cari_artist > 0) {
                $this->db->where('songId', $id);
                $this->db->update('tsongartist', ['artistId' => $artistId]);
            } else {
                $data = [
                    'songId' => $id,
                    'artistId' => $artistId
                ];

                $this->db->insert('tsongartist', $data);
            }   
        }

        if($recordLabelId){
            $cari_label = $this->db->get_where('trecordlabelsong', array('recordLabelId' => $recordLabelId, 'songId' => $id))->num_rows();

            if($cari_label > 0) {
                $this->db->where('songId', $id);
                $this->db->update('trecordlabelsong', ['recordLabelId' => $recordLabelId]);
            } else {
                $data = [
                    'songId' => $id,
                    'recordLabelId' => $recordLabelId
                ];

                $this->db->insert('trecordlabelsong', $data);
            }
        }

        if($composerId){
            $cari_composer = $this->db->get_where('tsongcomposer', array('composerId' => $composerId, 'songId' => $id))->num_rows();

            if($cari_composer > 0) {
                $this->db->where('songId', $id);
                $this->db->update('tsongcomposer', ['composerId' => $composerId]);
            } else {
                $data = [
                    'songId' => $id,
                    'composerId' => $composerId
                ];

                $this->db->insert('tsongcomposer', $data);
            }
        }

        if($arrangerId){
            $cari_arranger = $this->db->get_where('tsongarranger', array('arrangerId' => $arrangerId, 'songId' => $id))->num_rows();

            if($cari_arranger > 0) {
                $this->db->where('songId', $id);
                $this->db->update('tsongarranger', ['arrangerId' => $arrangerId]);
            } else {
                $data = [
                    'songId' => $id,
                    'arrangerId' => $arrangerId
                ];

                $this->db->insert('tsongarranger', $data);
            }
        }
        
    }
}



