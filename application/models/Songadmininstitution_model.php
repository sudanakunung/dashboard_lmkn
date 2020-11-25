<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Songadmininstitution_model extends MY_Model{

    public function getDataSong($offset, $dataPerPage, $keyword = null, $musiclangcode = null)
    {
        
        if(!empty($keyword) && !empty($musiclangcode)) {
            $where = "AND (song.title LIKE '%".$keyword."%' ESCAPE '!' OR artist_data.name LIKE '%".$keyword."%' ESCAPE '!') AND song.langCode = '".$musiclangcode."'";
        } 
        else if(!empty($keyword)) {
            $where = "AND (song.title LIKE '%".$keyword."%' ESCAPE '!' OR artist_data.name LIKE '%".$keyword."%' ESCAPE '!')";
        }
        else if(!empty($musiclangcode)){
            $where = "AND song.langCode = '".$musiclangcode."'";
        } else {
            if($this->session->userdata('admincountry') == 'ind'){
                $where = "AND song.langCode = 'ind'";
            } else {
                $where = "";
            }
        }

        if($this->session->userdata('lembaga') == 'SELMI'){

            $query = "SELECT song.songId, song.title, song.coverImage, artist_data.name, label_data.recordLabel, artist_data.lembaga AS lembaga_artist, label_data.lembaga AS lembaga_label
            FROM tsong song
            LEFT JOIN (
                SELECT artist.*, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            LEFT JOIN (
                SELECT label.*, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'SELMI' OR label_data.lembaga = 'SELMI') 
            ".$where."
            ORDER BY song.title ASC
            LIMIT ".$offset.", ".$dataPerPage."";
        }
        else if($this->session->userdata('lembaga') == 'KCI'){

            $query = "SELECT song.songId, song.title, song.coverImage, composer_data.name AS composer_name, composer_data.lembaga AS lembaga_composer
            FROM tsong song
            LEFT JOIN (
                SELECT composer.*, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = song.songId
            WHERE composer_data.lembaga = 'KCI'
            ".$where."
            ORDER BY song.title ASC
            LIMIT ".$offset.", ".$dataPerPage."";
        }
        else if($this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT song.songId, song.title, song.coverImage, composer_data.name AS composer_name, composer_data.lembaga AS lembaga_composer
            FROM tsong song
            LEFT JOIN (
                SELECT composer.*, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = song.songId
            WHERE composer_data.lembaga = 'RAI'
            ".$where."
            ORDER BY song.title ASC
            LIMIT ".$offset.", ".$dataPerPage."";
        }
        else if($this->session->userdata('lembaga') == 'WAMI'){
            $query = "SELECT song.songId, song.title, song.coverImage, artist_data.name, label_data.recordLabel, artist_data.lembaga AS lembaga_artist, label_data.lembaga AS lembaga_label
            FROM tsong song
            LEFT JOIN (
                SELECT artist.*, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            LEFT JOIN (
                SELECT label.*, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'WAMI' OR label_data.lembaga = 'WAMI') 
            ".$where."
            ORDER BY song.title ASC
            LIMIT ".$offset.", ".$dataPerPage."";
        } else {
            $query = "SELECT song.songId, song.title, song.coverImage, artist_data.name, artist_data.lembaga
            FROM tsong song
            LEFT JOIN tsongartist ON tsongartist.songId = song.songId
            LEFT JOIN tartist artist_data ON artist_data.artistId = tsongartist.artistId
            ".$where."
            ORDER BY song.title ASC 
            LIMIT ".$offset.", ".$dataPerPage."";
        }

        $sql = $this->db->query($query)->result();

        $datas = [];

        foreach ($sql as $key => $value) {
            
            $allsongs = array();

            $allsongs['songId'] = $value->songId;
            $allsongs['title'] = $value->title;
            $allsongs['coverImage'] = $value->coverImage;
            
            if($this->session->userdata('lembaga') == 'SELMI'){
                $allsongs['artist'] = $value->name;
                $allsongs['label'] = $value->recordLabel;
                $allsongs['composer'] = "";
                $allsongs['lembaga_artist'] = $value->lembaga_artist;
                $allsongs['lembaga_label'] = $value->lembaga_label;
                $allsongs['lembaga_composer'] = "";
            }
            else if($this->session->userdata('lembaga') == 'KCI' || $this->session->userdata('lembaga') == 'RAI'){
                $allsongs['artist'] = "";
                $allsongs['label'] = "";
                $allsongs['composer'] = $value->composer_name;
                $allsongs['lembaga_artist'] = "";
                $allsongs['lembaga_label'] = "";
                $allsongs['lembaga_composer'] = $value->lembaga_composer;
            }
            else if($this->session->userdata('lembaga') == 'WAMI'){
                $allsongs['artist'] = $value->name;
                $allsongs['label'] = $value->recordLabel;
                $allsongs['composer'] = "";
                $allsongs['lembaga_artist'] = $value->lembaga_artist;
                $allsongs['lembaga_label'] = $value->lembaga_label;
                $allsongs['lembaga_composer'] = "";
            } else {
                $allsongs['artist'] = $value->name;
                $allsongs['lembaga_artist'] = $value->lembaga;

                $sql_label = $this->db->select('trecordlabel.recordLabel')
                ->join('trecordlabel', 'trecordlabelsong.recordLabelId = trecordlabel.recordLabelId')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $value->songId))
                ->row();
                $label = ($sql_label ? $sql_label->recordLabel : '');
                $allsongs['label'] = $label;
                $allsongs['lembaga_label'] = $sql_label->lembaga;

                $sql_composer = $this->db->select('tcomposer.name')
                ->join('tcomposer', 'tsongcomposer.composerId = tcomposer.composerId')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $value->songId))
                ->row();
                $composer = ($sql_composer ? $sql_composer->name : '');
                $allsongs['composer'] = $composer;
                $allsongs['lembaga_composer'] = $sql_composer->lembaga;
            }

            $sql_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $value->songId))
                ->row();
            $arranger = ($sql_arranger ? $sql_arranger->arranger : '');
            $allsongs['arranger'] = $arranger;

            $datas[] = (object)$allsongs;
        }

        return $datas;
    }

    public function countDataSong($keyword = null)
    {
        if(!empty($keyword) && !empty($musiclangcode)) {
            $where = "AND (song.title LIKE '%".$keyword."%' ESCAPE '!' OR artist_data.name LIKE '%".$keyword."%' ESCAPE '!') AND song.langCode = '".$musiclangcode."'";
        } 
        else if(!empty($keyword)) {
            $where = "AND (song.title LIKE '%".$keyword."%' ESCAPE '!' OR artist_data.name LIKE '%".$keyword."%' ESCAPE '!')";
        }
        else if(!empty($musiclangcode)){
            $where = "AND song.langCode = '".$musiclangcode."'";
        } else {
            if($this->session->userdata('admincountry') == 'ind'){
                $where = "AND song.langCode = 'ind'";
            } else {
                $where = "";
            }
        }

        if($this->session->userdata('lembaga') == 'SELMI'){
            $query = "SELECT song.songId FROM tsong song
            LEFT JOIN (
                SELECT artist.*, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            LEFT JOIN (
                SELECT label.*, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'SELMI' OR label_data.lembaga = 'SELMI') 
            ".$where."";
        }
        else if($this->session->userdata('lembaga') == 'KCI'){
            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN (
                SELECT composer.*, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = song.songId
            WHERE composer_data.lembaga = 'KCI'
            ".$where."";
        }
        else if($this->session->userdata('lembaga') == 'RAI'){
            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN (
                SELECT composer.*, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = song.songId
            WHERE composer_data.lembaga = 'RAI'
            ".$where."";
        }
        else if($this->session->userdata('lembaga') == 'WAMI'){
            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN (
                SELECT artist.*, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            LEFT JOIN (
                SELECT label.*, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'WAMI' OR label_data.lembaga = 'WAMI') 
            ".$where."";
        } else {
            $query = "SELECT tsong.songId 
            FROM tsong 
            LEFT JOIN tsongartist ON tsongartist.songId = tsong.songId
            LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
            ".$where."";
        }

        $sql = $this->db->query($query)->num_rows();

        return $sql;
    }

    public function getLang()
    {
        $sql_lang = "SELECT * FROM tlang ORDER BY name ASC";
        $data_lang = $this->db->query($sql_lang)->result();

        return $data_lang;
    }

    public function getDataEditSong($songId){
        $sql_song = "SELECT songId, title, description, coverImage FROM tsong 
                WHERE songId = ?";
        $data_song = $this->db->query($sql_song, array($songId))->row();

        $sql_artist = $this->db->select('artistId')
                ->get_where('tsongartist', array('tsongartist.songId' => $data_song->songId))
                ->row();
        $artist = ($sql_artist ? $sql_artist->artistId : 0);

        $sql_label = $this->db->select('recordLabelId')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $data_song->songId))
                ->row();
        $label = ($sql_label ? $sql_label->recordLabelId : 0);

        $sql_arranger = $this->db->select('arrangerId')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $data_song->songId))
                ->row();
        $arranger = ($sql_arranger ? $sql_arranger->arrangerId : 0);

        $sql_composer = $this->db->select('composerId')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $data_song->songId))
                ->row();
        $composer = ($sql_composer ? $sql_composer->composerId : 0);

        $data = (object)[
            'songId' => $data_song->songId,
            'title' => $data_song->title,
            'description' => $data_song->description,
            'coverImage' => $data_song->coverImage,
            'artistId' => $artist,
            'recordLabelId' => $label,
            'arrangerId' => $arranger,
            'composerId' => $composer,
        ];

        return $data;
    }

    public function getDataArtist()
    {
        $query = $this->db->query("SELECT artistId, name FROM tartist ORDER BY name ASC")->result();

        return $query;
    }

    public function getDataLabel()
    {
        $query = $this->db->query("SELECT recordLabelId, recordLabel FROM trecordlabel ORDER BY recordLabel ASC")->result();

        return $query;
    }

    public function getDataArranger()
    {
        $query = $this->db->query("SELECT arrangerId, arranger FROM tarranger ORDER BY arranger ASC")->result();

        return $query;
    }

    public function getDataComposer()
    {
        $query = $this->db->query("SELECT composerId, name FROM tcomposer ORDER BY name ASC")->result();

        return $query;
    }

    public function editsong($judul, $artistId, $recordLabelId, $arrangerId, $composerId, $description, $namaFileAfterUpload, $songId)
    {

        if(!empty($recordLabelId)){
            $sql_update_artist = "UPDATE trecordlabelsong SET recordLabelId = ? WHERE songId = ?";
            $this->db->query($sql_update_artist, array($recordLabelId, $songId));
        }

        if(!empty($arrangerId)){
            $sql_update_artist = "UPDATE tsongarranger SET arrangerId = ? WHERE songId = ?";
            $this->db->query($sql_update_artist, array($arrangerId, $songId));
        }

        if(!empty($composerId)){
            $sql_update_artist = "UPDATE tsongcomposer SET composerId = ? WHERE songId = ?";
            $this->db->query($sql_update_artist, array($composerId, $songId));
        }

        // Disini dilakukan kondisi jika option artist dipilih atau tidak
        if(!empty($artistId)){
            $sql_update_artist = "UPDATE tsongartist SET artistId = ? WHERE songId = ?";
            
            $this->db->query($sql_update_artist, array($artistId, $songId));

            $artist = $this->db->query("SELECT name FROM tartist WHERE artistId = ".$artistId."")->row();

            $sql_update_song = "UPDATE `tsong` SET `title`= ?, `artistName` = ?, `description` = ?, `coverImage` = ? WHERE `songId` = ?";

            $data = $this->db->query($sql_update_song, array($judul, $artist->name, $description,$namaFileAfterUpload, $songId));
        } else {
            $sql_update_song = "UPDATE `tsong` SET `title`= ?, `description` = ?, `coverImage` = ? WHERE `songId` = ?";

            $data = $this->db->query($sql_update_song, array($judul, $description,$namaFileAfterUpload, $songId));
        }

        return $data;
    }

    public function getOldImage($songId)
    {
        $sql = "SELECT coverImage FROM tsong WHERE songId = ?";
        $data = $this->db->query($sql, array($songId))->row();
        return $data;
    }

    public function upload()
    {

    }
}