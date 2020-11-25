<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_model extends MY_Model {
    
    function getAllReferAll($artistId,$tanggalawal,$tanggalakhir){
        $sql = "SELECT Count(tuserpayment.userId) as jumlah, tsubscription.subscription as subscription FROM tuserpayment 
                                       RIGHT JOIN tsubscription ON tuserpayment.subscriptionId = tsubscription.subscriptionId 
                                       LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
                                       LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
                                       WHERE tartist.artistId = ?  AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tsubscription.subscription";
        $data = $this->db->query($sql, array($artistId,$tanggalawal,$tanggalakhir))->result();
        return $data;

    }

    function getTypeSubscription(){
        $sql = "SELECT tsubscription.subscription FROM tsubscription";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    function typeFree($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
    function typeSeminggu($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
    function typeGuest($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
    function typeHappy($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
    function typeHappyplus($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
    function typeSebulan($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
    function typeSetahun($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
    
    function typeTriwulan($artistId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }
}