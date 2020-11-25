<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Songadminlabel_model extends MY_Model{

    function getDataSong($offset, $dataPerPage, $keyword = null){
        
        if(!empty($keyword)) {
            $where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT tsong.songId, tsong.title, tsong.coverImage, tartist.name
            FROM tsong 
            LEFT JOIN tsongartist ON tsongartist.songId = tsong.songId
            LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
            $where 
            ORDER BY title 
            ASC LIMIT $offset, $dataPerPage")->result();

        $datas = [];

        foreach ($query as $key => $value) {
            $allsongs = array();
            $allsongs['songId'] = $value->songId;
            $allsongs['title'] = $value->title;
            $allsongs['coverImage'] = $value->coverImage;
            $allsongs['artist'] = $value->name;

            $sql_label = $this->db->select('trecordlabel.recordLabel')
                ->join('trecordlabel', 'trecordlabelsong.recordLabelId = trecordlabel.recordLabelId')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $value->songId))
                ->row();
            $label = ($sql_label ? $sql_label->recordLabel : '');
            $allsongs['label'] = $label;

            $sql_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $value->songId))
                ->row();
            $arranger = ($sql_arranger ? $sql_arranger->arranger : '');
            $allsongs['arranger'] = $arranger;

            $sql_composer = $this->db->select('tcomposer.name')
                ->join('tcomposer', 'tsongcomposer.composerId = tcomposer.composerId')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $value->songId))
                ->row();
            $composer = ($sql_composer ? $sql_composer->name : '');
            $allsongs['composer'] = $composer;

            $datas[] = (object)$allsongs;
        }

        return $datas;
    }

    public function countDataSong($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT tsong.songId, tsong.title, tsong.coverImage, tartist.name
            FROM tsong 
            LEFT JOIN tsongartist ON tsongartist.songId = tsong.songId
            LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
            $where")->num_rows();

        return $query;
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

    public function editsong($judul, $artistId, $recordLabelId, $arrangerId, $composerId, $description, $namaFileAfterUpload, $songId)
    {
        // Disini dilakukan kondisi jika option dipilih atau tidak
        if(!empty($artistId) || !empty($recordLabelId) || !empty($composerId) || !empty($arrangerId)){
            if(!empty($artistId)){
				$queryCekData = "SELECT artistId FROM tsongartist WHERE songId = ?";

				$sqlCekData = $this->db->query($queryCekData, array($songId))->num_rows();

				if($sqlCekData > 0){
					$sql = "UPDATE tsongartist SET artistId = ? WHERE songId = ?";
					$this->db->query($sql, array($artistId, $songId));
				} else {
					$sql = "INSERT INTO tsongartist (artistId,songId) VALUES (?,?)";
					$data = $this->db->query($sql, array($artistId, $songId));
				}  

				$artist = $this->db->query("SELECT name FROM tartist WHERE artistId = ".$artistId."")->row();

				$sql_update_song = "UPDATE `tsong` SET `title`= ?, `artistName` = ?, `description` = ?, `coverImage` = ? WHERE `songId` = ?";

				$data = $this->db->query($sql_update_song, array($judul, $artist->name, $description,$namaFileAfterUpload, $songId));	
			}
			if(!empty($recordLabelId)){
				$queryCekData = "SELECT recordLabelId FROM trecordlabelsong WHERE songId = ?";

				$sqlCekData = $this->db->query($queryCekData, array($songId))->num_rows();

				if($sqlCekData > 0){
					$sql = "UPDATE trecordlabelsong SET recordLabelId = ? WHERE songId = ?";
					$this->db->query($sql, array($recordLabelId, $songId));
				} else {
					$sql = "INSERT INTO trecordlabelsong (recordLabelId,songId) VALUES (?,?)";
					$data = $this->db->query($sql, array($recordLabelId, $songId));
				}
			}
			if(!empty($composerId)){
				$queryCekData = "SELECT composerId FROM tsongcomposer WHERE songId = ?";

				$sqlCekData = $this->db->query($queryCekData, array($songId))->num_rows();

				if($sqlCekData > 0){
					$sql = "UPDATE tsongcomposer SET composerId = ? WHERE songId = ?";
					$this->db->query($sql, array($composerId, $songId));
				} else {
					$sql = "INSERT INTO tsongcomposer (composerId,songId) VALUES (?,?)";
					$data = $this->db->query($sql, array($composerId, $songId));
				}
			}
			if(!empty($arrangerId)){
				$queryCekData = "SELECT arrangerId FROM tsongarranger WHERE songId = ?";

				$sqlCekData = $this->db->query($queryCekData, array($songId))->num_rows();

				if($sqlCekData > 0){
					$sql = "UPDATE tsongarranger SET arrangerId = ? WHERE songId = ?";
					$this->db->query($sql, array($arrangerId, $songId));
				} else {
					$sql = "INSERT INTO tsongarranger (arrangerId,songId) VALUES (?,?)";
					$data = $this->db->query($sql, array($arrangerId, $songId));
				}
			}
        } else {
            $sql_update_song = "UPDATE `tsong` SET `title`= ?, `description` = ?, `coverImage` = ? WHERE `songId` = ?";

            $data = $this->db->query($sql_update_song, array($judul, $description,$namaFileAfterUpload, $songId));
        }

        return $data;
    }
}