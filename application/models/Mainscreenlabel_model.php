<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainscreenlabel_model extends MY_Model {

    public function totalUserMYDIO(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tuser";

        return $this->db->query($sql)->row();
    }

    public function jumlahSong($id){
        $sql = "SELECT COUNT(songId) AS jumlah FROM trecordlabelsong WHERE recordLabelId = ?";
        return $this->db->query($sql, array($id))->row();
    }

    public function statistikRecorder($id){
        $tanggalawal = date('Y-m-01');
        $now = strtotime(date("Y-m-01"));
        $tanggalakhir = date('Y-m-d', strtotime('+1 month', $now));

        $genders = array();
        $jumlahuserids = array();
        $item = array();
        
        $sql = "SELECT tuser.gender AS gender, count(trecording.userId) AS jumlahuserid FROM trecording INNER JOIN trecordlabelsong ON trecordlabelsong.songId = trecording.songId INNER JOIN tuser ON trecording.userId = tuser.userId WHERE  trecording.uploadDate >= ? AND trecording.uploadDate < ? AND trecordlabelsong.recordLabelId = ? GROUP BY gender";
        
        $data = $this->db->query($sql, array($tanggalawal,$tanggalakhir,$id))->result();
        
        foreach ($data as $d){
            $genders[] = $d->gender;
            $jumlahuserids[] = $d->jumlahuserid;
        
        }
        
        $item = array($genders,$jumlahuserids);
        return $item;
    }


    public function statistikLiker($id){
        $tanggalawal = date('Y-m-01');
        $now = strtotime(date("Y-m-01"));
        $tanggalakhir = date('Y-m-d', strtotime('+1 month', $now));

        $genders = array();
        $jumlahuserids = array();
        $item = array();

        $sql = "SELECT tuser.gender as gender, count(tsonglike.userId) as jumlahuserid FROM tsonglike INNER JOIN trecordlabelsong ON trecordlabelsong.songId = tsonglike.songId INNER JOIN tuser ON tsonglike.userId = tuser.userId WHERE  tsonglike.createDate >= ? AND tsonglike.createDate < ? AND trecordlabelsong.recordLabelId = ? GROUP BY gender";
        $data = $this->db->query($sql, array($tanggalawal,$tanggalakhir,$id))->result();
        foreach ($data as $d){
            $genders[] = $d->gender;
            $jumlahuserids[] = $d->jumlahuserid;
        }
        $item = array($genders,$jumlahuserids);
        return $item;
    }

    public function statistikViewer($id){
        $tanggalawal = date('Y-m-01');
        $now = strtotime(date("Y-m-01"));
        $tanggalakhir = date('Y-m-d', strtotime('+1 month', $now));

        $genders = array();
        $jumlahuserids = array();
        $item = array();

        $sql = "SELECT tuser.gender as gender, count(tsongviewer.userId) as jumlahuserid FROM tsongviewer INNER JOIN trecordlabelsong ON trecordlabelsong.songId = tsongviewer.songId INNER JOIN tuser ON tsongviewer.userId = tuser.userId WHERE  tsongviewer.createdDate  >= ? AND tsongviewer.createdDate < ? AND trecordlabelsong.recordLabelId = ? GROUP BY gender";
        $data = $this->db->query($sql, array($tanggalawal,$tanggalakhir,$id))->result();
        foreach ($data as $d){
            $genders[] = $d->gender;
            $jumlahuserids[] = $d->jumlahuserid;
        }
        $item = array($genders,$jumlahuserids);
        return $item;
    }

    // public function getTotalSong($labelId){
    //     $sql = "SELECT count(DISTINCT tsong.songId) as jumlah FROM tsong JOIN trecordlabelsong ON trecordlabelsong.songId = tsong.songId AND trecordlabelsong.recordLabelId = ?";
    //     $data = $this->db->query($sql, array($labelId))->row();

    //     return $data;
    // }

    // public function getTotalArtist($labelId){
    //     $sql = "SELECT count(DISTINCT artistId) as jumlah FROM tadmin WHERE recordLabelId = ? AND artistId != 0";
    //     $data = $this->db->query($sql, array($labelId))->row();

    //     return $data;
    // }

    // public function getTopSong($tanggal_awal, $tanggal_akhir, $labelId){
    //     $sql = "SELECT tsong.songId AS songIds, tsong.title, tsong.coverImage, 
    //             (SELECT count(DISTINCT tsongviewer.userId) FROM tsongviewer WHERE tsongviewer.songId = songIds AND tsongviewer.createdDate >= ? AND tsongviewer.createdDate < ?) AS viewer, 
    //             (SELECT count(DISTINCT tsonglike.userId) FROM tsonglike WHERE tsonglike.songId = songIds AND tsonglike.createDate  >= ? AND tsonglike.createDate < ?) AS liker, 
    //             (SELECT count(DISTINCT trecording.userId) FROM trecording WHERE trecording.songId = songIds AND trecording.uploadDate  >= ? AND trecording.uploadDate < ?) AS recorder, 
    //             (SELECT tsongartist.artistId FROM tsongartist WHERE tsongartist.songId = songIds LIMIT 1) AS artistIds, 
    //             (SELECT tartist.name FROM tartist WHERE tartist.artistId = artistIds) AS name, trecordlabelsong.recordLabelId, 
    //             (SELECT count(DISTINCT tsongviewer.userId) FROM tsongviewer WHERE tsongviewer.songId = songIds AND tsongviewer.createdDate >= ? AND tsongviewer.createdDate < ?) 
    //               + (SELECT count(DISTINCT tsonglike.userId) FROM tsonglike WHERE tsonglike.songId = songIds AND tsonglike.createDate  >= ? AND tsonglike.createDate < ?) 
    //               + (SELECT count(DISTINCT trecording.userId) FROM trecording WHERE trecording.songId = songIds AND trecording.uploadDate  >= ? AND trecording.uploadDate < ?) AS jumlah FROM tsong 
    //               INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId WHERE trecordlabelsong.recordLabelId = ? ORDER BY jumlah DESC LIMIT 5";
    //     $data = $this->db->query($sql, array($tanggal_awal,$tanggal_akhir,$tanggal_awal,$tanggal_akhir,$tanggal_awal,$tanggal_akhir,$tanggal_awal,$tanggal_akhir,$tanggal_awal,$tanggal_akhir,$tanggal_awal,$tanggal_akhir,$labelId))->result();

    //     return $data;
    // }
}