<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Songlabel_model extends MY_Model{
    function getData($recordLabelId){
        $sql = "SELECT DISTINCT tsongartist.artistId as artistIds, tartist.`name`, (SELECT Count(tsongartist.songId) FROM tsongartist INNER JOIN trecordlabelsong ON tsongartist.songId = trecordlabelsong.songId WHERE tsongartist.artistId = artistIds AND trecordlabelsong.recordLabelId = ?) as jumlahlagu, trecordlabel.recordLabel FROM tartist INNER JOIN tsongartist ON tartist.artistId = tsongartist.artistId INNER JOIN trecordlabelsong ON tsongartist.songId = trecordlabelsong.songId INNER JOIN trecordlabel ON trecordlabel.recordLabelId = trecordlabelsong.recordLabelId WHERE trecordlabel.recordLabelId = ?";
        $data = $this->db->query($sql, array($recordLabelId, $recordLabelId))->result();
        return $data;
    }

    function cekArtist($recordLabelId, $artistId){
        $sql = "SELECT DISTINCT tartist.artistId FROM trecordlabel INNER JOIN trecordlabelsong ON trecordlabel.recordLabelId = trecordlabelsong.recordLabelId INNER JOIN tsongartist ON trecordlabelsong.songId = tsongartist.songId INNER JOIN tartist ON tartist.artistId = tsongartist.artistId WHERE tartist.artistId = ? AND trecordlabel.recordLabelId = ?";
        $data = $this->db->query($sql, array($artistId, $recordLabelId))->result();
        if(empty($data)){
            return false;
        }
        else{
            return true;
        }
    }

    function getDataLagu($artistId,$recordLabelId){
        $sql = "SELECT DISTINCT tsong.songId, tsong.title, tsong.coverImage, tsong.dateCreated FROM tsongartist
                                          INNER JOIN tsong ON tsongartist.songId = tsong.songId
                                          INNER JOIN trecordlabelsong ON trecordlabelsong.songId = tsongartist.songId
                                          WHERE tsongartist.artistId = ? AND trecordlabelsong.recordLabelId = ?";
        $data = $this->db->query($sql, array($artistId,$recordLabelId))->result();
        return $data;
    }

    function cekLagu($recordLabelId, $laguId){
        $sql = "SELECT recordLabelId FROM trecordlabelsong WHERE songId = ? AND recordLabelId = ?";
        $data = $this->db->query($sql, array($laguId, $recordLabelId))->result();
        if(empty($data)){
            return false;
        }
        else{
            return true;
        }
    }

    function getDetailLagu($laguId){
        $sql = "SELECT DISTINCT tsong.songId AS songsId, tsong.title, tsong.coverImage, tartist.`name`, tsong.dateCreated,
                                      (SELECT count(DISTINCT tsonglike.userId) FROM tsonglike WHERE tsonglike.songId = songsId) AS LIKEE,
                                      (SELECT count(DISTINCT tsongviewer.userId) FROM tsongviewer WHERE tsongviewer.songId = songsId) AS VIEWER,
                                      (SELECT count(DISTINCT vrecordingstat.userId) FROM vrecordingstat WHERE vrecordingstat.songId = songsId) AS RECORDERED
                                       FROM tsongartist
                                        INNER JOIN tsong ON tsongartist.songId = tsong.songId
                                        INNER JOIN tartist ON tartist.artistId = tsongartist.artistId
                                        WHERE tsong.songId = ?";
        $data = $this->db->query($sql, array($laguId))->result();
        return $data;

    }

    function recorder($laguId,$tanggal_awal,$tanggal_akhir){
        $sql = "SELECT tuser.gender as gender, count(DISTINCT trecording.userId) as jumlah FROM trecording INNER JOIN tuser ON trecording.userId = tuser.userId WHERE trecording.songId = ? AND trecording.uploadDate >= ? AND trecording.uploadDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($laguId,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function liker($laguId,$tanggal_awal,$tanggal_akhir){
        $sql = "SELECT tuser.gender,count(DISTINCT tsonglike.userId) as jumlah FROM tsonglike LEFT JOIN tuser ON tsonglike.userId = tuser.userId WHERE tsonglike.songId = ? AND tsonglike.createDate >= ? AND tsonglike.createDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($laguId,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function viewer($laguId,$tanggal_awal,$tanggal_akhir){
        $sql = "SELECT tuser.gender, count(DISTINCT tsongviewer.userId) as jumlah FROM tsongviewer LEFT JOIN tuser ON tsongviewer.userId = tuser.userId WHERE tsongviewer.songId = ? AND tsongviewer.createdDate >= ? AND tsongviewer.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($laguId,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function subscription($laguId,$tanggal_awal,$tanggal_akhir){
        $sql = "SELECT tuser.gender, count(DISTINCT tsongviewer.userId) as jumlah FROM tsongviewer INNER JOIN tuser ON tsongviewer.userId = tuser.userId WHERE tsongviewer.songId = ? AND tsongviewer.createdDate  BETWEEN ? AND ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($laguId,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
}
