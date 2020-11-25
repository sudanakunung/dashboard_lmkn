<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mainscreen_model extends MY_Model{
    public function totalUserMYDIO(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tuser";

        return $this->db->query($sql)->row();
    }
    public function jumlahSong($id){
        $sql = "SELECT count(songId) as jumlah FROM tsongartist WHERE artistId = ?";
        return $this->db->query($sql, array($id))->row();
    }

    public function statistikRecorder($id){
        $tanggalawal = date('Y-m-01');
        $now = strtotime(date("Y-m-01"));
        $tanggalakhir = date('Y-m-d', strtotime('+1 month', $now));

        $genders = array();
        $jumlahuserids = array();
        $item = array();

//        $sql = "SELECT vrecordingstat.gender as gender, count(vrecordingstat.userId) as jumlahuserid FROM vrecordingstat
//                                        INNER JOIN tsongartist ON vrecordingstat.songId = tsongartist.songId
//                                        WHERE  vrecordingstat.uploadDate >= ? AND vrecordingstat.uploadDate < ? AND tsongartist.artistId = ? GROUP BY vrecordingstat.gender";
        $sql = "SELECT tuser.gender as gender, count(trecording.userId) as jumlahuserid FROM trecording INNER JOIN tsongartist ON tsongartist.songId = trecording.songId INNER JOIN tuser ON trecording.userId = tuser.userId WHERE  trecording.uploadDate >= ? AND trecording.uploadDate < ? AND tsongartist.artistId = ? GROUP BY gender";
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

        $sql = "SELECT tuser.gender as gender, count(tsonglike.userId) as jumlahuserid FROM tsonglike INNER JOIN tsongartist ON tsongartist.songId = tsonglike.songId INNER JOIN tuser ON tsonglike.userId = tuser.userId WHERE  tsonglike.createDate >= ? AND tsonglike.createDate < ? AND tsongartist.artistId = ? GROUP BY gender";
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

        $sql = "SELECT tuser.gender as gender, count(tsongviewer.userId) as jumlahuserid FROM tsongviewer INNER JOIN tsongartist ON tsongartist.songId = tsongviewer.songId INNER JOIN tuser ON tsongviewer.userId = tuser.userId WHERE  tsongviewer.createdDate  >= ? AND tsongviewer.createdDate < ? AND tsongartist.artistId = ? GROUP BY gender";
        $data = $this->db->query($sql, array($tanggalawal,$tanggalakhir,$id))->result();
        foreach ($data as $d){
            $genders[] = $d->gender;
            $jumlahuserids[] = $d->jumlahuserid;
        }
        $item = array($genders,$jumlahuserids);
        return $item;
    }

}
