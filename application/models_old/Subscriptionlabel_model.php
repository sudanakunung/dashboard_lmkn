<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptionlabel_model extends MY_Model {
    
    function getAllReferAll($recordLabelId,$tanggalawal,$tanggalakhir){
        $sql = "SELECT COUNT(tuserpayment.userId) as jumlah, 
                tsubscription.subscription as subscription FROM tuserpayment 
                RIGHT JOIN tsubscription ON tuserpayment.subscriptionId = tsubscription.subscriptionId
                LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
                LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
                LEFT JOIN tsong ON tartist.artistId = tsong.artistId
                LEFT JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId

                WHERE trecordlabelsong.recordLabelId = ?  AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tsubscription.subscription";

        $data = $this->db->query($sql, array($recordLabelId,$tanggalawal,$tanggalakhir))->result();
        
        return $data;
    }

    function getTypeSubscription(){
        $sql = "SELECT tsubscription.subscription FROM tsubscription";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    function typeFree($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
       $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
                LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
                LEFT JOIN tsong ON tartist.artistId = tsong.artistId
                LEFT JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId

                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeSeminggu($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId 

                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeGuest($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 

                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId 

                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";

        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeHappy($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId

                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();

        return $data;
    }

    function typeHappyplus($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId 

                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();
        
        return $data;
    }

    function typeSebulan($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId 
                
                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function typeSetahun($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId 
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId 
                
                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();
        return $data;
    }

    function typeTriwulan($recordLabelId, $type, $tanggal_awal, $tanggal_akhir){
        $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription 
                
                INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId 
                INNER JOIN tuser ON tuser.userId = tuserpayment.userId 
                INNER JOIN tartist ON tartist.artistId = tuser.refArtistId
                INNER JOIN tsong ON tartist.artistId = tsong.artistId
                INNER JOIN trecordlabelsong ON tsong.songId = trecordlabelsong.songId 

                WHERE trecordlabelsong.recordLabelId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
        
        $data = $this->db->query($sql, array($recordLabelId,$type,$tanggal_awal,$tanggal_akhir))->result();
        
        return $data;
    }
}

// class Subscriptionlabel_model extends MY_Model {
//     function getDataArtist($recordLabelId){
//         $sql = "SELECT tartist.`name` as name, count(tsongartist.songId) as jumlah, tartist.artistId as artisId FROM trecordlabel
//                                         INNER JOIN trecordlabelsong ON trecordlabelsong.recordLabelId = trecordlabel.recordLabelId
//                                         INNER JOIN tsongartist ON tsongartist.songId = trecordlabelsong.songId
//                                         INNER JOIN tartist ON tsongartist.artistId = tartist.artistId
//                                         WHERE tartist.referral = 1 AND  trecordlabel.recordLabelId = ?  GROUP BY tartist.`name`";
//         $data = $this->db->query($sql, array($recordLabelId))->result();
//         return $data;
//     }

//     function getAllReferall($artistId, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT Count(tuserpayment.userId) as jumlah, tsubscription.subscription as subscription FROM tuserpayment 
//                                        RIGHT JOIN tsubscription ON tuserpayment.subscriptionId = tsubscription.subscriptionId 
//                                        LEFT JOIN tuser ON tuser.userId = tuserpayment.userId
//                                        LEFT JOIN tartist ON tuser.refArtistId = tartist.artistId
//                                        WHERE tartist.artistId = ?  AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tsubscription.subscription";
//         $data = $this->db->query($sql, array($artistId, $tanggal_awal, $tanggal_akhir))->result();
//         return $data;
//     }

//     function getTypeSubscription(){
//         $sql = "SELECT tsubscription.subscription FROM tsubscription";
//         $data = $this->db->query($sql, array())->result();
//         return $data;
//     }

//     function cekArtist($recordLabelId, $artistId){
//         $sql = "SELECT DISTINCT tartist.artistId FROM trecordlabel INNER JOIN trecordlabelsong ON trecordlabel.recordLabelId = trecordlabelsong.recordLabelId INNER JOIN tsongartist ON trecordlabelsong.songId = tsongartist.songId INNER JOIN tartist ON tartist.artistId = tsongartist.artistId WHERE tartist.artistId = ? AND trecordlabel.recordLabelId = ?";
//         $data = $this->db->query($sql, array($artistId, $recordLabelId))->result();
//         if(empty($data)){
//             return false;
//         }
//         else{
//             return true;
//         }
//     }

//     function typeFree($artistId, $type, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
//         $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
//         return $data;
//     }
//     function typeSeminggu($artistId, $type, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
//         $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
//         return $data;
//     }
//     function typeGuest($artistId, $type, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
//         $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
//         return $data;
//     }
//     function typeHappy($artistId, $type, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
//         $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
//         return $data;
//     }
//     function typeHappyplus($artistId, $type, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
//         $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
//         return $data;
//     }
//     function typeSebulan($artistId, $type, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
//         $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
//         return $data;
//     }
//     function typeTriwulan($artistId, $type, $tanggal_awal, $tanggal_akhir){
//         $sql = "SELECT tuser.gender,COUNT(tuserpayment.userId) AS jumlah FROM tsubscription INNER JOIN tuserpayment ON tsubscription.subscriptionId = tuserpayment.subscriptionId INNER JOIN tuser ON tuser.userId = tuserpayment.userId INNER JOIN tartist ON tartist.artistId = tuser.refArtistId WHERE tartist.artistId = ? AND tsubscription.subscription = ? AND tuserpayment.createdDate >= ? AND tuserpayment.createdDate < ? GROUP BY tuser.gender";
//         $data = $this->db->query($sql, array($artistId,$type,$tanggal_awal,$tanggal_akhir))->result();
//         return $data;
//     }
// }