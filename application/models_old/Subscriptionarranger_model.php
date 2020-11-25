<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptionarranger_model extends MY_Model {
    
    function getAllReferAll($arrangerId,$tanggalawal,$tanggalakhir){
        $sql = "SELECT COUNT(tuserpayment.userId) as jumlah, 
                tsubscription.subscription as subscription FROM tuserpayment 
                RIGHT JOIN tsubscription ON tuserpayment.subscriptionId = tsubscription.subscriptionId
                LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
                LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
                LEFT JOIN tsong ON tartist.artistId = tsong.artistId
                LEFT JOIN tsongarranger ON tsong.songId = tsongarranger.songId

                WHERE tsongarranger.arrangerId = ?  AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tsubscription.subscription";

        $data = $this->db->query($sql, array($arrangerId,$tanggalawal,$tanggalakhir))->result();
        
        return $data;
    }

    function getTypeSubscription(){
        $sql = "SELECT tsubscription.subscription FROM tsubscription";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    function typeFree($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
       $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
                LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
                LEFT JOIN tsong ON tartist.artistId = tsong.artistId
                LEFT JOIN tsongarranger ON tsong.songId = tsongarranger.songId

                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeSeminggu($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongarranger ON tsong.songId = tsongarranger.songId 

                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeGuest($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 

                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongarranger ON tsong.songId = tsongarranger.songId 

                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeHappy($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongarranger ON tsong.songId = tsongarranger.songId

                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeHappyplus($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongarranger ON tsong.songId = tsongarranger.songId 

                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        
        return $data;
    }

    function typeSebulan($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongarranger ON tsong.songId = tsongarranger.songId 
                
                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function typeSetahun($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongarranger ON tsong.songId = tsongarranger.songId 
                
                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function typeTriwulan($arrangerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongarranger ON tsong.songId = tsongarranger.songId 

                WHERE tsongarranger.arrangerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($arrangerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        
        return $data;
    }
}