<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptioncomposer_model extends MY_Model {
    
    function getAllReferAll($composerId,$tanggalawal,$tanggalakhir){
        $sql = "SELECT Count(tuserpayment.userId) as jumlah, 
                tsubscription.subscription as subscription FROM tuserpayment 
                RIGHT JOIN tsubscription ON tuserpayment.subscriptionId = tsubscription.subscriptionId
                LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
                LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
                LEFT JOIN tsong ON tartist.artistId = tsong.artistId
                LEFT JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId

                WHERE tsongcomposer.composerId = ?  AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tsubscription.subscription";

        $data = $this->db->query($sql, array($composerId,$tanggalawal,$tanggalakhir))->result();
        
        return $data;
    }

    function getTypeSubscription(){
        $sql = "SELECT tsubscription.subscription FROM tsubscription";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    function typeFree($composerId, $type, $tanggal_awal, $tanggal_akhir){
       $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
                LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
                LEFT JOIN tsong ON tartist.artistId = tsong.artistId
                LEFT JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId

                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeSeminggu($composerId, $type, $tanggal_awal, $tanggal_akhir){
         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId 

                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeGuest($composerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 

                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId 

                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeHappy($composerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId

                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeHappyplus($composerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId 

                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        
        return $data;
    }

    function typeSebulan($composerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId 
                
                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function typeSetahun($composerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId 
                
                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function typeTriwulan($composerId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN tsongcomposer ON tsong.songId = tsongcomposer.songId 

                WHERE tsongcomposer.composerId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($composerId,$type,$tanggal_awal,$tanggal_akhir))->result();
        
        return $data;
    }
}