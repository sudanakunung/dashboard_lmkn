<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Songrequestadmininstitution_model extends MY_Model{

    public function totalrequest(){

        if($this->session->userdata('lembaga') == 'SELMI'){
            
            $query = "SELECT COUNT(tsongrequest.tsongrequestId) as jumlah 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE (tartist.lembaga = 'SELMI' OR trecordlabel.lembaga = 'SELMI')";

        }
        else if($this->session->userdata('lembaga') == 'KCI'){

            $query = "SELECT COUNT(tsongrequest.tsongrequestId) as jumlah
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE tcomposer.lembaga = 'KCI'";

        }
        else if($this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT COUNT(tsongrequest.tsongrequestId) as jumlah
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE tcomposer.lembaga = 'RAI'";

        }
        else if($this->session->userdata('lembaga') == 'WAMI'){

            $query = "SELECT COUNT(tsongrequest.tsongrequestId) as jumlah
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE (tartist.lembaga = 'WAMI' OR trecordlabel.lembaga = 'WAMI')";

        } else {

            $query = "SELECT COUNT(tsongrequest.tsongrequestId) as jumlah
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId";
        }

        return $this->db->query($query)->row();
    }

    public function totalsongbank(){
        if($this->session->userdata('lembaga') == 'SELMI'){

            $query = "SELECT song.songId
            FROM tsong song
            JOIN (
                SELECT artist.lembaga, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            JOIN (
                SELECT label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'SELMI' OR label_data.lembaga = 'SELMI')";
        }
        else if($this->session->userdata('lembaga') == 'KCI' || $this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT song.songId
            FROM tsong song
            JOIN (
                SELECT composer.lembaga, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = song.songId
            WHERE (composer_data.lembaga = 'KCI' OR composer_data.lembaga = 'RAI')";
        }
        else if($this->session->userdata('lembaga') == 'WAMI'){
            $query = "SELECT song.songId
            FROM tsong song
            JOIN (
                SELECT artist.lembaga, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            JOIN (
                SELECT label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'WAMI' OR label_data.lembaga = 'WAMI')";
        } else {
            $query = "SELECT song.songId
            FROM tsong song
            JOIN tsongartist ON tsongartist.songId = song.songId
            JOIN tartist artist_data ON artist_data.artistId = tsongartist.artistId";
        }

        $sql = $this->db->query($query)->num_rows();

        return $sql;
    }

    public function datasongrequest($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "AND tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        if($this->session->userdata('lembaga') == 'SELMI'){
            
            $query = "SELECT tsongrequest.*, tsong.title 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE (tartist.lembaga = 'SELMI' OR trecordlabel.lembaga = 'SELMI') 
            ".$where." 
            ORDER BY tsong.title DESC LIMIT ".$offset.", ".$dataPerPage."";

        }
        else if($this->session->userdata('lembaga') == 'KCI'){

            $query = "SELECT tsongrequest.*, tsong.title 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE tcomposer.lembaga = 'KCI'
            ".$where." 
            ORDER BY tsong.title DESC LIMIT ".$offset.", ".$dataPerPage."";

        }
        else if($this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT tsongrequest.*, tsong.title 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE tcomposer.lembaga = 'RAI'
            ".$where." 
            ORDER BY tsong.title DESC LIMIT ".$offset.", ".$dataPerPage."";

        }
        else if($this->session->userdata('lembaga') == 'WAMI'){

            $query = "SELECT tsongrequest.*, tsong.title 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE (tartist.lembaga = 'WAMI' OR trecordlabel.lembaga = 'WAMI') 
            ".$where." 
            ORDER BY tsong.title DESC LIMIT ".$offset.", ".$dataPerPage."";

        } else {

            $query = "SELECT tsongrequest.*, tsong.title 
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            WHERE tsongrequest.artistId <> 0 ".$where." 
            ORDER BY tsong.title DESC LIMIT ".$offset.", ".$dataPerPage."";
        }

        $getsongrequest = $this->db->query($query)->result();

        $datasongrequest = [];

        foreach($getsongrequest as $key => $val){
            $datasongrequest[$key]['tsongrequestId'] = $val->tsongrequestId;
            $datasongrequest[$key]['songId'] = $val->songId;
            $datasongrequest[$key]['artistId'] = $val->artistId;
            $datasongrequest[$key]['approve'] = $val->approve;
            // $datasongrequest[$key]['requested_by'] = $val->requested_by;
            $datasongrequest[$key]['title'] = $val->title;

            if($val->artistId > 0){
                $sql_artist = $this->db->select('name')
                ->get_where('tartist', array('artistId' => $val->artistId))
                ->row();

                $datasongrequest[$key]['requested_by'] = $sql_artist->name.'<br /><small>Artist</small>';
            }
            else if($val->composerId > 0){
                $sql_composer = $this->db->select('name')
                ->get_where('tcomposer', array('composerId' => $val->composerId))
                ->row();

                $datasongrequest[$key]['requested_by'] = $sql_composer->name.'<br /><small>Composer</small>';
            }
            else if($val->recordLabelId > 0){
                $sql_label = $this->db->select('recordLabel')
                ->get_where('trecordlabel', array('recordLabelId' => $val->recordLabelId))
                ->row();

                $datasongrequest[$key]['requested_by'] = $sql_label->recordLabel.'<br /><small>Label/Publisher</small>';
            }
            else if($val->arrangerId > 0){
                $sql_label = $this->db->select('arranger')
                ->get_where('tarranger', array('arrangerId' => $val->recordLabelId))
                ->row();

                $datasongrequest[$key]['requested_by'] = $sql_label->arranger.'<br /><small>Arranger</small>';
            } else {
                $datasongrequest[$key]['requested_by'] = "";
            }

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

        if($this->session->userdata('lembaga') == 'SELMI'){
            
            $query = "SELECT tsongrequestId
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE (tartist.lembaga = 'SELMI' OR trecordlabel.lembaga = 'SELMI') 
            ".$where."";

        }
        else if($this->session->userdata('lembaga') == 'KCI'){

            $query = "SELECT tsongrequestId
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE tcomposer.lembaga = 'KCI'
            ".$where."";
            
        }
        else if($this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT tsongrequestId
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE tcomposer.lembaga = 'RAI'
            ".$where."";
            
        }
        else if($this->session->userdata('lembaga') == 'WAMI'){

            $query = "SELECT tsongrequestId
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            JOIN tartist ON tartist.artistId = tsongrequest.artistId
            JOIN trecordlabel ON trecordlabel.recordLabelId = tsongrequest.recordLabelId 
            JOIN tcomposer ON tcomposer.composerId = tsongrequest.composerId 
            JOIN tarranger ON tarranger.arrangerId = tsongrequest.arrangerId 
            WHERE (tartist.lembaga = 'WAMI' OR trecordlabel.lembaga = 'WAMI') 
            ".$where."";

        } else {

            $query = "SELECT tsongrequestId
            FROM tsongrequest 
            INNER JOIN tsong ON tsong.songId = tsongrequest.songId 
            WHERE tsongrequest.artistId <> 0 
            ".$where."";
        }

        $sql = $this->db->query($query)->num_rows();

        return $sql;
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
