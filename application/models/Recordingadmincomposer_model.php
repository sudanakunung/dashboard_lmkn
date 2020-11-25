<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recordingadmincomposer_model extends MY_Model {
    
    public function getAllDataRecording($offset, $dataPerPage, $keyword = null)
    {

        if(!empty($keyword)) {
            $where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }
        
        $getsonglike = $this->db->query("SELECT trecording.*, tsong.title FROM trecording INNER JOIN tsong ON tsong.songId = trecording.songId $where GROUP BY trecording.recordingId ORDER BY trecording.recordingId DESC LIMIT $offset, $dataPerPage")->result();

        $datasonglike = [];

        foreach($getsonglike as $key => $val){
            
            $datasonglike[$key]['recordingId'] = $val->recordingId;
            $datasonglike[$key]['songId'] = $val->songId;
            $datasonglike[$key]['userId'] = $val->userId;
            $datasonglike[$key]['uploadDate'] = $val->uploadDate;
            $datasonglike[$key]['urlRecording'] = $val->urlRecording;
            $datasonglike[$key]['urlRecordingFull'] = $val->urlRecordingFull;
            $datasonglike[$key]['status'] = $val->status;
            $datasonglike[$key]['title'] = $val->title;

            $query_user = $this->db->select('tuser.name')
                ->get_where('tuser', array('tuser.userId' => $val->userId))
                ->row();
            $user = ($query_user ? $query_user->name : '');
            $datasonglike[$key]['name'] = $user;

            $query_artist = $this->db->select('tartist.name')
                ->join('tartist', 'tsongartist.artistId = tartist.artistId', 'left')
                ->get_where('tsongartist', array('tsongartist.songId' => $val->songId))
                ->row();
            $artist = ($query_artist ? $query_artist->name : '');
            $datasonglike[$key]['artist_name'] = $artist;

            $query_composer = $this->db->select('tcomposer.name')
                ->join('tcomposer', 'tsongcomposer.composerId = tcomposer.composerId', 'left')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $val->songId))
                ->row();
            $composer = ($query_composer ? $query_composer->name : '');
            $datasonglike[$key]['composer_name'] = $composer;
        }

        // Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
        return result_object($datasonglike);
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