<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Likeadmininstitution_model extends MY_Model {
	
	public function getAllDataLike($offset, $dataPerPage, $keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "AND (song.title LIKE '%".$keyword."%' ESCAPE '!' OR artist_data.name LIKE '%".$keyword."%' ESCAPE '!')";
		} else {
			$where = "";
		}

		if($this->session->userdata('lembaga') == 'SELMI'){

            $query = "SELECT likesong.songId, song.title, artist_data.name, label_data.recordLabel, artist_data.lembaga AS lembaga_artist, label_data.lembaga AS lembaga_label, COUNT(likesong.songId) AS jumlah
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT artist.name, artist.lembaga, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = likesong.songId
            JOIN (
                SELECT label.recordLabel, label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = likesong.songId
            WHERE (artist_data.lembaga = 'SELMI' OR label_data.lembaga = 'SELMI') 
            ".$where."
            GROUP BY likesong.songId ORDER BY jumlah DESC
            LIMIT ".$offset.", ".$dataPerPage."";
        }
        else if($this->session->userdata('lembaga') == 'KCI'){

            $query = "SELECT likesong.songId, song.title, composer_data.name AS composer_name, composer_data.lembaga AS lembaga_composer, COUNT(likesong.songId) AS jumlah
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT composer.name, composer.lembaga, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = likesong.songId
            WHERE composer_data.lembaga = 'KCI'
            ".$where."
            GROUP BY likesong.songId ORDER BY jumlah DESC
            LIMIT ".$offset.", ".$dataPerPage."";
        }
        else if($this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT likesong.songId, song.title, composer_data.name AS composer_name, composer_data.lembaga AS lembaga_composer, COUNT(likesong.songId) AS jumlah
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT composer.name, composer.lembaga, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = likesong.songId
            WHERE composer_data.lembaga = 'RAI'
            ".$where."
            GROUP BY likesong.songId ORDER BY jumlah DESC
            LIMIT ".$offset.", ".$dataPerPage."";
        }
        else if($this->session->userdata('lembaga') == 'WAMI'){
            
            $query = "SELECT likesong.songId, song.title, artist_data.name, label_data.recordLabel, artist_data.lembaga AS lembaga_artist, label_data.lembaga AS lembaga_label, COUNT(likesong.songId) AS jumlah
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT artist.name, artist.lembaga, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = likesong.songId
            JOIN (
                SELECT label.recordLabel, label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = likesong.songId
            WHERE (artist_data.lembaga = 'WAMI' OR label_data.lembaga = 'WAMI') 
            ".$where."
            GROUP BY likesong.songId ORDER BY jumlah DESC
            LIMIT ".$offset.", ".$dataPerPage."";

        } else {
            
            $query = "SELECT likesong.songId, tsong.title, COUNT(likesong.songId) AS jumlah, tartist.name
			FROM tsonglike likesong
			INNER JOIN tsong song ON tsong.songId = likesong.songId 
			LEFT JOIN tsongartist ON tsongartist.songId = likesong.songId
			LEFT JOIN tartist artist_data ON artist_data.artistId = tsongartist.artistId
			".$where." 
			GROUP BY likesong.songId ORDER BY jumlah DESC LIMIT ".$offset.", ".$dataPerPage."";
        }
		
		$getsonglike = $this->db->query($query)->result();

		$datas = [];

		foreach($getsonglike as $key => $value){

			$allsongs = array();

			$allsongs['songId'] = $value->songId;
			$allsongs['jumlah'] = $value->jumlah;
			$allsongs['title'] = $value->title;

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

			$query_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $value->songId))
                ->row();
            $arranger = ($query_arranger ? $query_arranger->arranger : '');
            $allsongs['arranger_name'] = $arranger;

			$datas[] = (object)$allsongs;
		}

		return $datas;
	}

	public function countDataLike($keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "AND (song.title LIKE '%".$keyword."%' ESCAPE '!' OR artist_data.name LIKE '%".$keyword."%' ESCAPE '!')";
		} else {
			$where = "";
		}

        if($this->session->userdata('lembaga') == 'SELMI'){

            $query = "SELECT likesong.songId
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT artist.lembaga, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = likesong.songId
            JOIN (
                SELECT label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = likesong.songId
            WHERE (artist_data.lembaga = 'SELMI' OR label_data.lembaga = 'SELMI') 
            ".$where."
            GROUP BY likesong.songId";
        }
        else if($this->session->userdata('lembaga') == 'KCI'){

            $query = "SELECT likesong.songId
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT composer.lembaga, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = likesong.songId
            WHERE composer_data.lembaga = 'KCI'
            ".$where."
            GROUP BY likesong.songId";
        }
        else if($this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT likesong.songId
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT composer.lembaga, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = likesong.songId
            WHERE composer_data.lembaga = 'RAI'
            ".$where."
            GROUP BY likesong.songId";
        }
        else if($this->session->userdata('lembaga') == 'WAMI'){
            
            $query = "SELECT likesong.songId
            FROM tsonglike likesong
            INNER JOIN tsong song ON song.songId = likesong.songId
            JOIN (
                SELECT artist.lembaga, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = likesong.songId
            JOIN (
                SELECT label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = likesong.songId
            WHERE (artist_data.lembaga = 'WAMI' OR label_data.lembaga = 'WAMI') 
            ".$where."
            GROUP BY likesong.songId";

        } else {
            
            $query = "SELECT likesong.songId
            FROM tsonglike likesong
            INNER JOIN tsong song ON tsong.songId = likesong.songId 
            LEFT JOIN tsongartist ON tsongartist.songId = likesong.songId
            LEFT JOIN tartist artist_data ON artist_data.artistId = tsongartist.artistId
            ".$where." 
            GROUP BY likesong.songId";
        }
		
		$sql = $this->db->query($query)->num_rows();
		
		return $sql;
	}
}