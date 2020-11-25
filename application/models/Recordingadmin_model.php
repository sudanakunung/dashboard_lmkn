<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recordingadmin_model extends MY_Model {

    public function getAllDataRecording($offset, $dataPerPage, $keyword = null)
    {

        if(!empty($keyword)) {
            $where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
        } else {
            $where = "";
        }
        
        $getrecording = $this->db->query("SELECT trecording.*, tsong.title, tartist.name 
            FROM trecording 
            INNER JOIN tsong ON tsong.songId = trecording.songId 
            LEFT JOIN tsongartist ON tsongartist.songId = trecording.songId
            LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
            $where 
            GROUP BY trecording.recordingId 
            ORDER BY trecording.recordingId DESC LIMIT $offset, $dataPerPage")->result();

        $datarecording = [];

        foreach($getrecording as $key => $val){
            
            $datarecording[$key]['recordingId'] = $val->recordingId;
            $datarecording[$key]['songId'] = $val->songId;
            $datarecording[$key]['userId'] = $val->userId;
            $datarecording[$key]['uploadDate'] = $val->uploadDate;
            $datarecording[$key]['urlRecording'] = $val->urlRecording;
            $datarecording[$key]['urlRecordingFull'] = $val->urlRecordingFull;
            $datarecording[$key]['status'] = $val->status;
            $datarecording[$key]['title'] = $val->title;
            $datarecording[$key]['artist_name'] = $val->name;

            // $query_user = $this->db->select('tuser.name')
            //     ->get_where('tuser', array('tuser.userId' => $val->userId))
            //     ->row();
            // $user = ($query_user ? $query_user->name : '');
            // $datarecording[$key]['name'] = $user;

            $query_label = $this->db->select('trecordlabel.recordLabel')
                ->join('trecordlabel', 'trecordlabelsong.recordLabelId = trecordlabel.recordLabelId', 'left')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $val->songId))
                ->row();
            $label = ($query_label ? $query_label->recordLabel : '');
            $datarecording[$key]['label_name'] = $label;

            $query_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $val->songId))
                ->row();
            $arranger = ($query_arranger ? $query_arranger->arranger : '');
            $datarecording[$key]['arranger_name'] = $arranger;

            $query_composer = $this->db->select('tcomposer.name')
                ->join('tcomposer', 'tsongcomposer.composerId = tcomposer.composerId', 'left')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $val->songId))
                ->row();
            $composer = ($query_composer ? $query_composer->name : '');
            $datarecording[$key]['composer_name'] = $composer;
        }

        // Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
        return result_object($datarecording);
    }

    public function countDataRecording($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
        } else {
            $where = "";
        }
        
        $query = $this->db->query("SELECT trecording.*, tsong.title, tartist.name 
            FROM trecording 
            INNER JOIN tsong ON tsong.songId = trecording.songId 
            LEFT JOIN tsongartist ON tsongartist.songId = trecording.songId
            LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
            $where 
            GROUP BY trecording.recordingId")->num_rows();

        return $query;
    }

    public function getDataRecordingEdit($recordingId){
        $sql    = "SELECT recordingId, userId, songId, uploadDate, urlRecording, urlRecordingFull, status FROM trecording where recordingId = ?";
        $data   = $this->db->query($sql, array($recordingId))->row();
        return $data;
    }

    public function aksiedit($recordingId, $status){
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $sql = "UPDATE trecording SET status = ? WHERE recordingId = ?";
        $data = $this->db->query($sql, array($status,$recordingId));
        $this->db->db_debug = $db_debug;
        return $data;
    }
}