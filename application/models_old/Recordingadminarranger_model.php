<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recordingadminarranger_model extends MY_Model {
    
    public function getAllDataRecording($offset, $dataPerPage, $keyword = null)
    {

        if(!empty($keyword)) {
            $where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }
        
        $getrecording = $this->db->query("SELECT trecording.*, tsong.title FROM trecording INNER JOIN tsong ON tsong.songId = trecording.songId $where GROUP BY trecording.recordingId ORDER BY trecording.recordingId DESC LIMIT $offset, $dataPerPage")->result();

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

            $query_user = $this->db->select('tuser.name')
                ->get_where('tuser', array('tuser.userId' => $val->userId))
                ->row();
            $user = ($query_user ? $query_user->name : '');
            $datarecording[$key]['name'] = $user;

            $query_artist = $this->db->select('tartist.name')
                ->join('tartist', 'tsongartist.artistId = tartist.artistId', 'left')
                ->get_where('tsongartist', array('tsongartist.songId' => $val->songId))
                ->row();
            $artist = ($query_artist ? $query_artist->name : '');
            $datarecording[$key]['artist_name'] = $artist;

            $query_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $val->songId))
                ->row();
            $arranger = ($query_arranger ? $query_arranger->arranger : '');
            $datarecording[$key]['arranger_name'] = $arranger;
        }

        // Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
        return result_object($datarecording);
    }

    public function countDataRecording($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT trecording.recordingId FROM trecording INNER JOIN tsong ON tsong.songId = trecording.songId ".$where." ORDER BY trecording.recordingId DESC")->num_rows();

        return $query;
    }
}